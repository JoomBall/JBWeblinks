<?php
/*
 * @author			JoomBall! Project
 * @link			http://www.joomball.com
 * @copyright		Copyright © 2012 JoomBall! Project All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

//require_once JPATH_SITE.DS.'components'.DS.'com_weblinks'.DS.'helpers'.DS.'route.php';
//JModel::addIncludePath(JPATH_SITE.DS.'components'.DS.'com_weblinks'.DS.'models', 'WeblinksModel');

require_once JPATH_SITE . '/components/com_weblinks/helpers/route.php';
JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_weblinks/models', 'WeblinksModel');

class modJbweblinksHelper
{
	public static function getList($params)
	{
		$webLinks = array();
		
		// Set application parameters in model
		$app = JFactory::getApplication();
		$appParams = $app->getParams();

		// --> Amb això agafem el codi de llenguage per fer més filtre
		$language = $app->input->getData('language');

		// Nomes categories que ens interessa
		$catsIds = $params->get('catid', array());
		JArrayHelper::toInteger($catsIds);
		$catsIds = implode(',', $catsIds);
		
		/**
		 * ---------------------
		 */
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select('cat.id, cat.title');
		$query->from('#__categories AS cat');
		
		$query->where('cat.language = '.$db->quote($language).' or cat.language = '.$db->quote('*'));
		$query->where('cat.extension = '.$db->quote('com_weblinks'));
		if ($catsIds) {
			$query->where('cat.id IN ('.$catsIds.')');
		}
		
		$query->where('cat.published = 1');
		$query->order('cat.lft');
		
		$db->setQuery($query);
		
		// execute the SQL query
		$categoriesWebLinks = $db->loadAssocList();
				
		for ($i=0; $i<count($categoriesWebLinks); $i++) {
		
			// Get an instance of the generic articles model
//			$model = JModel::getInstance('Category', 'WeblinksModel', array('ignore_request' => true));
			$model = JModelLegacy::getInstance('Category', 'WeblinksModel', array('ignore_request' => true));
			
			$model->setState('params', $appParams);

			// Set the filters based on the module params
			$model->setState('list.start', 0);
			$model->setState('list.limit', (int) $params->get('count', 5));
	
			$model->setState('filter.state', 1);
	
			// Access filter
			$access = !JComponentHelper::getParams('com_weblinks')->get('show_noauth');
			$model->setState('filter.access', $access);
	
			$ordering = $params->get('ordering', 'ordering');
			$model->setState('list.ordering', $ordering == 'order' ? 'ordering' : $ordering);
			$model->setState('list.direction', $params->get('direction', 'asc'));
	
			$catid	= (int) $categoriesWebLinks[$i]['id'];
				$model->setState('category.id', $catid);
	
			// Create query object
			$query = $db->getQuery(true);
	
			$case_when1 = ' CASE WHEN ';
			$case_when1 .= $query->charLength('a.alias', '!=', '0');
			$case_when1 .= ' THEN ';
			$a_id = $query->castAsChar('a.id');
			$case_when1 .= $query->concatenate(array($a_id, 'a.alias'), ':');
			$case_when1 .= ' ELSE ';
			$case_when1 .= $a_id.' END as slug';
	
			$case_when2 = ' CASE WHEN ';
			$case_when2 .= $query->charLength('c.alias', '!=', '0');
			$case_when2 .= ' THEN ';
			$c_id = $query->castAsChar('c.id');
			$case_when2 .= $query->concatenate(array($c_id, 'c.alias'), ':');
			$case_when2 .= ' ELSE ';
			$case_when2 .= $c_id.' END as catslug';
	
			$model->setState('list.select', 'a.*, c.published AS c_published,'.$case_when1.','.$case_when2.','.
			'DATE_FORMAT(a.created, "%Y-%m-%d") AS created');
		
			$model->setState('filter.c.published', 1);
	
			// Filter by language
			$model->setState('filter.language', $app->getLanguageFilter());

			$items = $model->getItems();
			
			// Asegurem que hi hagi contingut
			if (!empty($items)) {
				$webLinks[$i]['id'] = $categoriesWebLinks[$i]['id'];
				$webLinks[$i]['title'] = $categoriesWebLinks[$i]['title'];
				$webLinks[$i]['links'] = $items;
			
				for ($k =0; $k < count($webLinks[$i]['links']); $k++) {
					$item = &$webLinks[$i]['links'][$k];
					
					if ($item->params->get('count_clicks', $params->get('count_clicks')) == 1) {
						$item->link	= JRoute::_('index.php?option=com_weblinks&task=weblink.go&catid='.$item->catslug.'&id='. $item->slug);
					} else {
						$item->link = $item->url;
					}
				}
			}

		} // End For
		
		return $webLinks;
	}
}