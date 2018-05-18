<?php
/*
 * @author			JoomBall! Project
 * @link			http://www.joomball.com
 * @copyright		Copyright © 2012 JoomBall! Project All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;
?>
<ul class="weblinks">

<?php foreach ($list as $items) :	?>
	<li>
		<?php if ($items['links']) { ?>
			<strong><?php echo $items['title']; ?></strong>
		<?php } ?>
		<ul>
		<?php foreach ($items['links'] as $item) :	?>
			<li>
				<?php
				$link = $item->link;
				switch ($params->get('target', 3))
				{
					case 1:
						// open in a new window
						echo '<a href="'. $link .'" target="_blank" rel="'.$params->get('follow', 'no follow').'">'.
						htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8') .'</a>';
						break;
			
					case 2:
						// open in a popup window
						echo "<a href=\"#\" onclick=\"javascript: window.open('". $link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\">".
							htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8') .'</a>';
						break;
			
					default:
						// open in parent window
						echo '<a href="'. $link .'" rel="'.$params->get('follow', 'no follow').'">'.
							htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8') .'</a>';
						
						break;
				}
				
				if ($params->get('hits', 0)) :
					echo '<span>(' . $item->hits . ')</span>';
				endif;

				
				?>
				<?php if ($params->get('description', 0)) : ?>
					<?php echo nl2br($item->description); ?>
				<?php endif; ?>
			</li>
	<?php endforeach; ?>
		</ul>
	</li>
<?php endforeach; ?>
</ul>

<?php if ($params->get('view_link', NULL)) { ?>
	<div id="jbweblinks">
		<ul class="menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_weblinks&view=categories'); ?>">
					<?php echo JText::_('MOD_JBWEBLINKS_JGLOBAL_BOTON_LINK'); ?></a>
			</li>
		</ul>
	</div>
<?php } ?>