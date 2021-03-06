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
<fieldset class="adminform">
	<legend><?php echo JText::_( 'COM_COMMUNITY_CONFIGURATION_EMAIL' ); ?></legend>
	<table class="admintable" cellspacing="1">
		<tbody>
			<tr>
				<td width="300" class="key">
					<span class="hasTip" title="::<?php echo JText::_('COM_COMMUNITY_CONFIGURATION_EMAIL_HTML_EMAILS_TIPS'); ?>">
						<?php echo JText::_( 'COM_COMMUNITY_CONFIGURATION_EMAIL_HTML_EMAILS' ); ?>
					</span>
				</td>
				<td valign="top">
					<?php echo JHTML::_('select.booleanlist' , 'htmlemail' , null , $this->config->get('htmlemail') , JText::_('COM_COMMUNITY_YES_OPTION') , JText::_('COM_COMMUNITY_NO_OPTION') ); ?>
				</td>
			</tr>
			<tr>
				<td width="300" class="key">
					<span class="hasTip" title="::<?php echo JText::_('COM_COMMUNITY_CONFIGURATION_EMAIL_COPYRIGHT'); ?>">
						<?php echo JText::_( 'COM_COMMUNITY_CONFIGURATION_EMAIL_COPYRIGHT' ); ?>
					</span>
				</td>
				<td valign="top">
					<textarea name="copyrightemail" cols="30" rows="5"><?php echo $this->config->get('copyrightemail');?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>