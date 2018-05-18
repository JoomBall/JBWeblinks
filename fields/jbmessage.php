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

class JFormFieldJbmessage extends JFormField {

    protected $type = 'jbmessage';

    protected function getInput() {
    	
    	$label = $this->element['label'] ? (string) $this->element['label'] : '';
    	$message = $this->element['message'] ? (string) $this->element['message'] : '';
    	
    	switch ($message) {
    		case 'space':
    			$style = 'border: 1px solid #BBBBBB; background-color: #F1F1F1; ';
    			$text_title = JText::_($label);
    			$text_message = '';
    			break;
    		case 'info':
    			$style = 'border: 1px solid #8bda8b; background-color: #cbfbcb; ';
    			$text_title = JText::_('JBINFORMATION').': ';
    			$text_message = JText::_($label);
    			break;
    		case 'version':
		    	$xml = $this->element['xml'];
		    	
		    	if ($xml) {
					$xml = JApplicationHelper::parseXMLInstallFile($this->element['path'].$xml);
					if ($xml && isset($xml['version'])) {
						$version = $xml['version'];
					}
				}
		
				if (!$version) {
					return '';
				}
				
				$style = 'border: 1px solid #effd08; background-color: #fbfecb; ';
    			$text_title = JText::_('JBCURRENT_VERSION').': ';
    			$text_message = $this->element['extension_name'].' ' . $version;
    			break;
    		default:
    			$style = 'border: 1px solid #BBBBBB; background-color: #F1F1F1; ';
    			$text_title = '';
    			$text_message = JText::_($label);
    			break;
    	}
    	
        $html = array();

        $html[] = '<div style="clear:left;"></div>';
		$html[] = '<div style="'.$style.'max-width: 500px; margin: 5px 0; padding: 5px 10px; border-radius: 5px; font-size:12px;">';
		$html[] = '<strong style="color:#303030;">';
		$html[] = $text_title;
		$html[] = '</strong>';
		$html[] = $text_message;
		$html[] = '</div>';
		
		return implode('', $html);
    }

    protected function getLabel() {}

}
