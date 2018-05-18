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
// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldJbinformation extends JFormField {

    protected $type = 'jbinformation';

    protected function getInput() {
    	
		$label = $this->element['label'] ? (string) $this->element['label'] : '';
    	
        $html = array();

        $html[] = '<div style="clear:left;"></div>';
		$html[] = '<div style="max-width: 500px; border: 1px solid #8bda8b; background-color: #cbfbcb; margin: 5px 0; padding: 5px 10px; border-radius: 5px; font-size:12px;">';
		$html[] = '<strong style="color:#303030;">';
		$html[] = JText::_('JBINFORMATION').': ';
		$html[] = '</strong>';
		$html[] = JText::_($label);
		$html[] = '</div>';
		
		return implode('', $html);
    }

    protected function getLabel() {}

}
