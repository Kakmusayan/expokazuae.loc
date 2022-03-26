<?php
/**
 * @copyright	Copyright (C) 2011 Simplify Your Web, Inc. All rights reserved.
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die;

/**
 * Script file of the jQuery Easy plugin
 */
class plgsystemjqueryeasyInstallerScript
{		
	/**
	 * Called before an install/update/uninstall method
	 *
	 * @param   string  $route  Which action is happening (install|uninstall|discover_install)
	 * @param   JAdapterInstance  $adapter  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function preflight($type, $parent) {
		
	}
	
	/**
	 * Called after an install/update/uninstall method
	 *
	 * @param   string  $route  Which action is happening (install|uninstall|discover_install)
	 * @param   JAdapterInstance  $adapter  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function postflight($type, $parent) 
	{	
		echo '<dl>';
		echo '    <dt>Change log</dt>';
		echo '    <dd>FIXED: Too much code stripped when removing noConflict script declarations</dd>';
		echo '    <dd>FIXED: preg_match errors in rare cases when looking for noConflict() instances</dd>';
		echo '    <dd>FIXED: noConflict() would not be removed if &gt; happened to be in the code separating &lt;script&gt; and noConflict()</dd>';
		echo '    <dd>FIXED: report interferes with popups</dd>';
		echo '    <dd>MODIFIED: the syntax to compare paths with \'*\' with the current URI in enable/disable/keep in pages</dd>';
		echo '    <dd>MODIFIED: the way jquery.noconflict.js (and all sorts of combinations) are found and deleted</dd>';
		echo '    <dd>MODIFIED: help references</dd>';
		echo '    <dd>ADDED: new section \'Other\'</dd>';
		echo '    <dd>ADDED: warning and backward compatibility option for paths in enable/disable/keep in pages</dd>';
		echo '    <dd>ADDED: intaller script to show change log upon install (useful when using automatic updates and not going through the website)</dd>';
		echo '    <dd>ADDED: link to documentation download in the help section</dd>';
		echo '    <dd>ADDED: examples of syntax for some fields</dd>';
		echo '    <dd>ADDED: disable plugin in template field (experimental)</dd>';
		echo '    <dd>ADDED: ignore scripts field to avoid removal of scripts mistakenly tagged as jQuery libraries</dd>';
		echo '    <dd>ADDED: new option to have ne protocol</dd>';
		echo '    <dd>ADDED: French translation</dd>';
		echo '</dl>';
		
		return true;
	}
	
	/**
	 * Called on installation
	 *
	 * @param   JAdapterInstance  $adapter  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function install($parent) {
		
	}
	
	/**
	 * Called on update
	 *
	 * @param   JAdapterInstance  $adapter  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function update($parent) {
		
	}
	
	/**
	 * Called on uninstallation
	 *
	 * @param   JAdapterInstance  $adapter  The object responsible for running this script
	 */
	public function uninstall($parent) {
		
	}
}
?>
