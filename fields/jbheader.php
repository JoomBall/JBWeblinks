<?php
/**
 * 
 * @package			Joomla
 * @subpackage		Modules - jbmenu_accordion
 * 
 * @author			JoomBall! Project
 * @link			http://www.joomball.com
 * @copyright		Copyright © 2012 JoomBall! Project - All Rights Reserved
 * @license			license.txt (english) or licencia.txt (spanish) Proprietary License. This code belongs to JoomBall! Project
 * You are not allowed to distribute or sell this code. You bought only a license to use it for ONE virtuemart installation.
 * You are not allowed to modify this code.
 * 
 **/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldJbHeader extends JFormField {

    protected $type = 'JbHeader';

    public function getLabel() {
        return;
    }

    protected function getInput() {
    	
    	$lang = JFactory::getLanguage();
    	$languageTag = $lang->getTag();
    	
    	if ($languageTag == 'es-ES' or $languageTag == 'ca-ES') {
    		$linkCategory = $this->element['es_category'];
    		$linkVideoTutorial = $this->element['es_help'];
    	} else {
    		$linkCategory = $this->element['en_category'];
    		$linkVideoTutorial = $this->element['en_help'];
    	}
    	
    	$imageHeader = 'http://www.joomball.com/images/template/toolbar/'.$this->element['icon_48'].'.png';
    	// --> Comprovem si existeix arxiu
    	if (!strlen(@file_get_contents($imageHeader))) {
    		$imageHeader = $this->element['path'].$this->element['icon_48'].'.png';
    	}
    	
//		$AgetHeaders = @get_headers($imageJoomBall);
//		if (preg_match("|200|", $AgetHeaders[0])) {
//		file exists
//		}

    	
//    	$exist = @fopen($imageJoomBall, "r");

    	$imageJoomBall = 'http://www.joomball.com/images/template/toolbar/icon-32-joomball.png';
    	// --> Comprovem si existeix arxiu
    	if (!strlen(@file_get_contents($imageJoomBall))) {
    		$imageJoomBall = $this->element['path'].'icon-32-joomball.png';
    	}
		
    	$imageJoomla = 'http://www.joomball.com/images/template/toolbar/icon-32-joomla.png';
    	// --> Comprovem si existeix arxiu
    	if (!strlen(@file_get_contents($imageJoomla))) {
    		$imageJoomla = $this->element['path'].'icon-32-joomla.png';
    	}
    	
    	//echo $imageJoomBall;
    	$imageRssFile = 'http://www.joomball.com/images/template/toolbar/icon-32-rss-file.png';
    	// --> Comprovem si existeix arxiu
    	if (!strlen(@file_get_contents($imageRssFile))) {
    		$imageRssFile = $this->element['path'].'icon-32-rss-file.png';
    	}
    	
    	$document = JFactory::getDocument();
	
		$styleCss = '.'.$this->element['icon_48'].' {
						background-image: url("'.$imageHeader.'");
					}
					.icon-32-joomball {
						background-image: url("'.$imageJoomBall.'");
					}
					.icon-32-joomla {
						background-image: url("'.$imageJoomla.'");
					}
					.icon-32-rss-file {
						background-image: url("'.$imageRssFile.'");
					}';
	
    	
    	
		$document->addStyleDeclaration($styleCss);
	
		$document->addStyleSheet(JURI::root() . 'modules/mod_jbweblinks/assets/css/jbtoolbar.css');
	
        $html = '
        <div style="max-width: 500px; margin: 0; border:1px solid #CCCCCC; background-color: #F4F4F4; padding: 5px 10px; border-radius: 5px;">
			<div class="jbtoolbar-list">
			    <ul>
				    <li class="jbbutton">
				        <a class="jbtoolbar hasTip" title="JoomBall" rel="'.JText::_('JBJOOMBALL_TITLE').'" href="http://www.joomball.com/" target="_blank">
				        <span class="icon-32-joomball"></span>'.JText::_('JoomBall').'</a>
				    </li>
				    <li class="jbbutton">
				        <a class="jbtoolbar hasTip" title="'.JText::_('JBVOTE').'" rel="'.JText::_('JBVOTE_TITLE').'" href="'.$this->element['extension'].'" target="_blank">
				        <span class="icon-32-joomla"></span>'.JText::_('JBVOTE').'</a>
				    </li>
				    <li class="jbbutton">
				        <a class="jbtoolbar hasTip" title="'.JText::_('JBDOCUMENTATION').'" rel="'.JText::_('JBDOCUMENTATION_TITLE').'" href="http://www.joomball.com/'.$linkCategory.'" target="_blank">
				        <span class="icon-32-rss-file"></span>'.JText::_('JBDOCUMENTATION').'</a>
				    </li>
				    <li class="jbbutton">
				        <a class="jbtoolbar hasTip" title="'.JText::_('JHELP').'" rel="'.JText::_('JBHELP_TITLE').'" onclick="Joomla.popupWindow(\'http://www.joomball.com/'.$linkVideoTutorial.'?tmpl=component\', \'Documentation\', 700, 500, 1)" href="#">
				        <span class="icon-32-help"></span>'.JText::_('JHELP').'</a>
				    </li>
			    </ul>
			    <div class="clr"></div>
			</div>
			
			<div class="jbpagetitle '.$this->element['icon_48'].'">
				<h2>'.$this->element['pagetitle'].'</h2>
			</div>
			<div class="clr"></div>
		</div>';
		
        return $html;
    }
}