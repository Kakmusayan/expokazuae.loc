<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript" language="javascript">
/**
 * This function needs to be here because, Joomla toolbar calls it
 **/
Joomla.submitbutton = function(action){
	submitbutton( action );
}
function submitbutton( action )
{
	submitform( action );
}
</script>
<form action="index.php?option=com_community" method="post" name="adminForm" id="adminForm">
<div>
	<?php echo JText::_('COM_COMMUNITY_EVENTS_CREATION_FRONT_END'); ?>
</div>
<table class="adminform" cellpadding="3">
	<tr>
		<td width="95%">
			<?php echo JText::_('COM_COMMUNITY_SEARCH');?>
			<input type="text" onchange="document.adminForm.submit();" class="text_area" value="<?php echo ($this->search) ? $this->escape($this->search) : '';?>" id="search" name="search"/>
			<button onclick="this.form.submit();"><?php echo JText::_('COM_COMMUNITY_SEARCH');?></button>
		</td>
		<td nowrap="nowrap" align="right">
		<span style="font-weight: bold;"><?php echo JText::_('COM_COMMUNITY_EVENTS_VIEW_BY_CATEGORY'); ?>:
		<?php echo $this->categories;?>
		</td>
	</tr>
</table>

<table class="adminlist table table-striped" cellspacing="1">
	<thead>
		<tr class="title">
			<th width="1%">#</th>
			<th width="1%">
				<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
			</th>
			<th width="15%" style="text-align: left;">
				<?php echo JHTML::_('grid.sort', JText::_('COM_COMMUNITY_NAME'), 'a.title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th style="text-align: left;">
				<?php echo JText::_('COM_COMMUNITY_EVENTS_DESCRIPTION'); ?>
			</th>
			<th width="5%">
				<?php echo JHTML::_('grid.sort', JText::_('COM_COMMUNITY_PUBLISHED'), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="5%">
				<?php echo JHTML::_('grid.sort', JText::_('COM_COMMUNITY_EVENTS_INVITED_GUEST'), 'a.invitedcount', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="10%">
				<?php echo JHTML::_('grid.sort', JText::_('COM_COMMUNITY_EVENTS_CONFIRMED_GUEST'), 'a.confirmedcount', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<?php $i = 0; ?>
	<?php
		if( empty( $this->events ) )
		{
	?>
	<tr>
		<td colspan="7" align="center"><?php echo JText::_('COM_COMMUNITY_EVENTS_NOT_CREATED');?></td>
	</tr>
	<?php
		}
	?>
	<?php foreach( $this->events as $row ): ?>
	<tr>
		<td align="center">
			<?php echo ( $i + 1 ); ?>
		</td>
		<td>
			<?php echo JHTML::_('grid.id', $i++, $row->id); ?>
		</td>
		<td>
			<a href="javascript:void(0);" onclick="azcommunity.editEvent('<?php echo $row->id;?>');">
				<?php echo $row->title; ?>
			</a>
		</td>
		<td>
			<?php echo CStringHelper::escape($row->description); ?>
		</td>
		<td id="published<?php echo $row->id;?>" align="center" class='center'>
			<?php echo $this->getPublish( $row , 'published' , 'events,ajaxTogglePublish' );?>
		</td>
		<td align="center">
			<?php echo $row->invitedcount; ?>
		</td>
		<td align="center">
			<?php echo $row->confirmedcount; ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<tfoot>
	<tr>
		<td colspan="15">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tr>
	</tfoot>
</table>
<input type="hidden" name="view" value="events" />
<input type="hidden" name="option" value="com_community" />
<input type="hidden" name="task" value="events" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>
