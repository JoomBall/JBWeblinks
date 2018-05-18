<?php
/*
 * @author			JoomBall! Project
 * @link			http://www.joomball.com
 * @copyright		Copyright © 2012 JoomBall! Project All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldJbversion extends JFormField {

    protected $type = 'jbversion';

    protected function getInput() {
    	
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
    	
    	
        $html = array();

        $html[] = '<div style="clear:left;"></div>';
		$html[] = '<div style="max-width: 500px; border: 1px solid #effd08; background-color: #fbfecb; margin: 5px 0; padding: 5px 10px; border-radius: 5px; font-size:12px;">';
		$html[] = '<strong style="color:#303030;">';
		$html[] = JText::_('JBCURRENT_VERSION').': ';
		$html[] = '</strong>';
		$html[] = $this->element['extension_name'].' ';
		$html[] = $version;
		$html[] = '</div>';
		
		return implode('', $html);
    }

    protected function getLabel() {}

}
