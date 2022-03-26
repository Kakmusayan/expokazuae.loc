<?php
/**
* Joomla Community Builder Module: mod_cbcontent
* @version $Id: mod_cbcontent.php 2629 2012-09-28 17:42:29Z kyle $
* @package mod_cbcontent
* @subpackage mod_cbcontent.php
* @author Beat
* @copyright (C) 2009 www.joomlapolis.com
* @license Limited http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/

if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }
global $_CB_framework, $_CB_database, $ueConfig, $mainframe;

if ( defined( 'JPATH_ADMINISTRATOR' ) ) {
	if ( ! file_exists( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' ) ) {
		echo 'CB not installed';
		return;
	}
	include_once( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' );
} else {
	if ( ! file_exists( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php' ) ) {
		echo 'CB not installed';
		return;
	}
	include_once( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php' );
}

cbimport( 'cb.html' );
cbimport( 'language.front' );

$class_sfx			=	$params->get( 'moduleclass_sfx' );
$maintext 			=	$params->get( 'maintext', null );
$maincss 			=	$params->get( 'maincss', null );
$mainjs 			=	$params->get( 'mainjs', null );
$mainjquery 		=	$params->get( 'mainjquery', null );
$mainjquery_plgs	=	$params->get( 'mainjquery_plgs', null );

$myId				=	$_CB_framework->myId();
$cbUser				=&	CBuser::getInstance( $myId );

if ( ! $cbUser ) {
	$cbUser			=&	CBuser::getInstance( null );
}

$result				=	null;

if ( $params->get( 'maincbtpl', 0 ) ) {
	outputCbTemplate( 1 );
}

if ( $params->get( 'maincbjs', 0 ) ) {
	outputCbJs();
}

if ( $maintext ) {
	$result			=	$cbUser->replaceUserVars( $maintext );
}

if ( $maincss ) {
	$_CB_framework->document->addHeadStyleInline( $maincss );
}

if ( $mainjs ) {
	$_CB_framework->document->addHeadScriptDeclaration( $mainjs );
}

if ( $mainjquery ) {
	if ( $mainjquery_plgs ) {
		$plgs		=	explode( ',', $mainjquery_plgs );
	} else {
		$plgs		=	null;
	}

	$_CB_framework->outputCbJQuery( $cbUser->replaceUserVars( $mainjquery ), $plgs );
}

echo $result;
?>
