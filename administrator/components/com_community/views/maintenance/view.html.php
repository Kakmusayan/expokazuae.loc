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
class CommunityViewMaintenance extends JViewLegacy
{
	/**
	 * The default method that will display the output of this view which is called by
	 * Joomla
	 *
	 * @param	string template	Template file name
	 **/
	public function display( $tpl = null )
	{
		$groupsModel	=& $this->getModel( 'Groups' );
		$usersModel		=& $this->getModel( 'Users' , false );

		$groups			= $groupsModel->getAllGroups();

		$isLatest		= ($groupsModel->isLatestTable() && $usersModel->isLatestTable()) ? true : false;

		$this->assign( 'groups'		, $groups );
		$this->assign( 'isLatest'	, $isLatest );
		parent::display( $tpl );
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
		JToolBarHelper::title( JText::_( 'COM_COMMUNITY_MAINTENANCE' ), 'profiles' );

		// Add the necessary buttons
		JToolBarHelper::back( JText::_('COM_COMMUNITY_HOME') , 'index.php?option=com_community');
	}
}