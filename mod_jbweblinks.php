<?php
/*
 * @author			JoomBall! Project
 * @link			http://www.joomball.com
 * @copyright		Copyright © 2012 JoomBall! Project All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

// Include the weblinks functions only once
//define('DIRECTORY', null);
//defined ('DIRECTORY') or define ('DIRECTORY', dirname(__FILE__));
$dir = NULL;
if (defined('__DIR__')) { $dir = __DIR__; } else { $dir = dirname(__FILE__); }

require_once $dir . '/helper.php';
  					
$list = modJbweblinksHelper::getList($params);

if (!count($list)) { return; }


if ($params->get('style_css', 1)) :
	JHTML::stylesheet('modules/mod_jbweblinks/assets/css/jbweblinks.css');
endif;


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_jbweblinks',$params->get('layout', 'default'));