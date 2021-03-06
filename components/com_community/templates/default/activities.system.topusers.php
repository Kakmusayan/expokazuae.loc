<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
$model		= CFactory::getModel( 'user' );
$members		= $model->getPopularMember( 10 );
$html    = '';

$this->set( 'members'    , $members );
//Get Template Page
// $tmpl   =	new CTemplate();
// $html   =	$tmpl	->set( 'members'    , $members )->set()
// 		->fetch( 'activity.members.popular' );
// OR, we can just display it here directly
//echo $html;

$this->load('activity.members.popular');