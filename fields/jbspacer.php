<?php
/*
 * @author			JoomBall! Project
 * @link			http://www.joomball.com
 * @copyright		Copyright © 2012 JoomBall! Project All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldJbspacer extends JFormField {

    protected $type = 'jbspacer';

    protected function getInput() {
        $html = array();

        $html[] = '<div style="clear:left;"></div>';
		$html[] = '<div style="max-width: 500px; border: 1px solid #BBBBBB; background-color: #F1F1F1; margin: 5px 0; padding: 2px 10px; font-size:12px;">';
		$html[] = '<strong style="color:#303030;">';
		$html[] = JText::_($this->element['label']);
		$html[] = '</strong>';
		$html[] = '</div>';
		
		return implode('', $html);
    }

    protected function getLabel() {}

}
