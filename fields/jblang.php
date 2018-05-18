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

class JFormFieldJBLang extends JFormField {

    protected $type = 'JBLang';

    public function getLabel() {
        return;
    }

    protected function getInput() {
		$lang = JFactory::getLanguage();
		$lang->load('mod_weblinks', JPATH_SITE, null, false, false)
		||	$lang->load('mod_weblinks', JPATH_SITE, $lang->getDefault(), false, false);
	}
}