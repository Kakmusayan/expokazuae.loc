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

jimport( 'joomla.application.component.view' );

/**
 * Configuration view for JomSocial
 */
class CommunityViewMailqueue extends JViewLegacy
{
	/**
	 * The default method that will display the output of this view which is called by
	 * Joomla
	 *
	 * @param	string template	Template file name
	 **/
	public function display( $tpl = null )
	{
		$queues		= $this->get( 'MailQueues' );
		$pagination	= $this->get( 'Pagination' );
		// Load tooltips
		JHTML::_('behavior.tooltip', '.hasTip');

 		$this->assignRef( 'mailqueues' 		, $queues );
 		$this->assignRef( 'pagination'	, $pagination );
		parent::display( $tpl );
	}

	public function getStatusText( $status )
	{
		$text = 'Unknown';
		switch($status){
			case '0':
				$text = JText::_('COM_COMMUNITY_PENDING') ; break;
			case '1':
				$text = '<img src="' . rtrim( JURI::root() , '/' ) . '/administrator/components/com_community/assets/icons/tick.png" />' ; break;
			case '2':
				$text = JText::_('COM_COMMUNITY_BLOCKED') ; break;
		}
		return $text;
	}

	/**
	 * Private method to set the toolbar for this view
	 *
	 * @access private
	 *
	 * @return null
	 **/
	public function setToolBar()
	{

		// Set the titlebar text
		JToolBarHelper::title( JText::_('COM_COMMUNITY_MAIL_QUEUE'), 'mailq' );

		// Add the necessary buttons
		JToolBarHelper::back( JText::_('COM_COMMUNITY_HOME'), 'index.php?option=com_community');
		JToolBarHelper::trash('purgequeue', JText::_('COM_COMMUNITY_MAILQUEUE_PURGE_SENT') , false );
		JToolBarHelper::divider();
		JToolBarHelper::trash('removequeue', JText::_('COM_COMMUNITY_DELETE'));
	}
}
