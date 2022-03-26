<?php
/**
 * @version SVN: $Id$
 * @package    CBAuthorPlug
 * @subpackage Base
 * @author     Tony Korologos {@link http://www.tkserver.com}
 * @author     Created on 23-Feb-2010  updated 11-Sept-11
 */

//-- No direct access
defined('_JEXEC') or die('=;)');


jimport( 'joomla.plugin.plugin' );


class plgContentCBAuthorPlug extends JPlugin
{
    
	
	
    function plgContentCBAuthorPlug( &$subject, $params )
    {
        parent::__construct( $subject, $params );
		
			
    }
	
		 	
    function onPrepareContent( &$article, &$params, $limitstart )
	
    {
	
    }
	
	
    function onAfterDisplayTitle( &$article, &$params, $limitstart )
    {
			$plugin = & JPluginHelper::getPlugin('content', 'cbauthorplug');
			$pluginParams   = new JParameter( $plugin->params );
			
			$disablejauthor = $pluginParams->get('disablejauthor');
			
			$exclude_authors = explode(',',$pluginParams->get('exclude_authors',null));
			foreach ($exclude_authors as $id) {
				if ($article->created_by == (int)trim($id)) {
					return;
				}
			}
			
			$exclude_secs = explode(',',$pluginParams->get('exclude_secs',null));
			foreach ($exclude_secs as $id) {
				if ($article->sectionid == (int)trim($id)) {
					return;
				}
			}
			
			$exclude_cats = explode(',',$pluginParams->get('exclude_cats',null));
			foreach ($exclude_cats as $id) {
				if ($article->catid == (int)trim($id)) {
					return;
				}
			}
							if ($disablejauthor == "yes" ) {
							$article->author = "";
										
							}

    }
	
	
function onBeforeDisplayContent( &$row, &$article, $params)
    {

			
		$plugin = & JPluginHelper::getPlugin('content', 'cbauthorplug');
		$pluginParams   = new JParameter( $plugin->params );
		$displayposition = $pluginParams->get('displayposition');
	
		if 	($displayposition == 'After'){ return; }

			$showfrontpage = $pluginParams->get('showfrontpage');
			$showavatar = $pluginParams->get('showavatar');
			$avatarwidth = $pluginParams->get('avatarwidth');
			$avatarmarginleft = $pluginParams->get('avatarmarginleft');
			$avatarmarginright = $pluginParams->get('avatarmarginright');
			$avatarfloat = $pluginParams->get('avatarfloat');
			$introtext = $pluginParams->get('introtext', '');
			$outrotext = $pluginParams->get('outrotext', '');
			$showname = $pluginParams->get('showname', 'name');
			$textfloat = $pluginParams->get('textfloat');
			$fontsize = $pluginParams->get('fontsize');
			$textcolor = $pluginParams->get('textcolor');
			$linkcolor = $pluginParams->get('linkcolor');
			$disablejauthor = $pluginParams->get('disablejauthor');
			
			$exclude_authors = explode(',',$pluginParams->get('exclude_authors',null));
			foreach ($exclude_authors as $id) {
				if ($row->created_by == (int)trim($id)) {
					return;
				}
			}
			
			$exclude_secs = explode(',',$pluginParams->get('exclude_secs',null));
			foreach ($exclude_secs as $id) {
				if ($row->sectionid == (int)trim($id)) {
					return;
				}
			}
			
			$exclude_cats = explode(',',$pluginParams->get('exclude_cats',null));
			foreach ($exclude_cats as $id) {
				if ($row->catid == (int)trim($id)) {
					return;
				}
			}		
	
			if ($disablejauthor == "no" ) {
			
		$database = &JFactory::getDbo();
		$uri = & JFactory::getURI();
		$sql = "SELECT $showname from #__users where id = '$row->created_by' LIMIT 1";
		$database->setQuery($sql);
		$cbname = $database->loadResult();
		$sql2 = "SELECT avatar FROM #__comprofiler WHERE user_id = '$row->created_by' AND avatarapproved = 1 LIMIT 1";
		$database->setQuery($sql2);
		$avatar = $database->loadResult();	
		$sql4 = "SELECT * FROM #__content_frontpage WHERE content_id = '$row->id' LIMIT 1";
		$database->setQuery($sql4);
		$onfrontpage = $database->loadResult();		
		
		$tn = 'tn';
		
		if(($showfrontpage == 'no') && ($onfrontpage)) { return; }
				
		if($showavatar == 0) {$avatar = '';}
		if(strstr($avatar,'gallery'))
			{
			$tn = '';
			} 
	
		$createdbyauthor 	= $row->created_by_alias;
		$createdby_id = $row->created_by;
		
		return '<!-- CSS STYLES -->

				<style type="text/css">
				<!--

				div.idcbauthorplug {'. '
				font-size: ' . $fontsize . 'px;
				color: ' . $textcolor . ';
				float: ' . $textfloat . ';
				
				}
				
				div.idcbauthorplug a {'. '
				font-size: ' . $fontsize . 'px;
				color: ' . $linkcolor . ';
				
				}
			
				div.cbauthorplug img {
				border-style: none;
				width: ' . $avatarwidth . 'px;
				margin-right: ' . $avatarmarginright . 'px;
				margin-left: ' . $avatarmarginleft . 'px;
				float: ' . $avatarfloat . ';
			}
			
			--></style>'
			. '<div class="cbauthorplug"><a href="index.php?option=com_comprofiler&task=userProfile&user=' . $createdby_id 
			. '"><img src="images/comprofiler/' . $tn . $avatar . '"></a><div class="idcbauthorplug">' . $introtext 
			. '<a href="index.php?option=com_comprofiler&task=userProfile&user=' . $createdby_id . '"> '. $cbname . '</a> ' . $outrotext . '</div></div>';
		     
			 }
			 
			 // end if $disablejauthor no
			 
			 		if ($disablejauthor == "yes" ) {
					
		$parameter = new JParameter($row->attribs);
		
		global $mainframe;
		$global_page_show_author = $mainframe->getPageParameters()->get('show_author');
		$article_show_author = $parameter->get('show_author',null);
		if($global_page_show_author > 0 && $parameter->get('show_author') != '0' ){

		$database = &JFactory::getDbo();
		$uri = & JFactory::getURI();
		$sql = "SELECT $showname from #__users where id = '$row->created_by' LIMIT 1";
		$database->setQuery($sql);
		$cbname = $database->loadResult();
		$sql2 = "SELECT avatar FROM #__comprofiler WHERE user_id = '$row->created_by' AND avatarapproved = 1 LIMIT 1";
		$database->setQuery($sql2);
		$avatar = $database->loadResult();	
		$sql3 = "SELECT state FROM #__content WHERE id = '$row->id' LIMIT 1";
		$database->setQuery($sql3);
		$pubstate = $database->loadResult();
		$sql4 = "SELECT * FROM #__content_frontpage WHERE content_id = '$row->id' LIMIT 1";
		$database->setQuery($sql4);
		$onfrontpage = $database->loadResult();	
			
		$tn = 'tn';
				
		if(($showfrontpage == 'no') && ($onfrontpage)) {
		
		return; }
		
								
		if($showavatar == 0) {$avatar = '';}
		if(strstr($avatar,'gallery'))
			{
			$tn = '';
			} 
	
		$createdbyauthor 	= $row->created_by_alias;
		$createdby_id = $row->created_by;
		
		return '<!-- CSS STYLES -->

				<style type="text/css">
				<!--

				div.idcbauthorplug {'. '
				font-size: ' . $fontsize . 'px;
				color: ' . $textcolor . ';
				float: ' . $textfloat . ';
				
				}
				
				div.idcbauthorplug a {'. '
				font-size: ' . $fontsize . 'px;
				color: ' . $linkcolor . ';
				
				}
			
				div.cbauthorplug img {
				border-style: none;
				width: ' . $avatarwidth . 'px;
				margin-right: ' . $avatarmarginright . 'px;
				margin-left: ' . $avatarmarginleft . 'px;
				float: ' . $avatarfloat . ';
			}
			
			--></style>'
			. '<div class="cbauthorplug"><a href="index.php?option=com_comprofiler&task=userProfile&user=' . $createdby_id 
			. '"><img src="images/comprofiler/' . $tn . $avatar . '"></a><div class="idcbauthorplug">' . $introtext
			. '<a href="index.php?option=com_comprofiler&task=userProfile&user=' . $createdby_id . '"> '. $cbname . '</a> ' . $outrotext 
			.  '</div></div>';
	    }
			 }
			 
			    
   }
   
   
	  function onAfterDisplayContent( &$row, &$article, $params)
    {

			
		$plugin = & JPluginHelper::getPlugin('content', 'cbauthorplug');
		$pluginParams   = new JParameter( $plugin->params );
		$displayposition = $pluginParams->get('displayposition');
		
			if 	($displayposition == 'Before'){ return; }

			$showfrontpage = $pluginParams->get('showfrontpage');
			$showavatar = $pluginParams->get('showavatar');
			$avatarwidth = $pluginParams->get('avatarwidth');
			$avatarmarginleft = $pluginParams->get('avatarmarginleft');
			$avatarmarginright = $pluginParams->get('avatarmarginright');
			$avatarfloat = $pluginParams->get('avatarfloat');
			$introtext = $pluginParams->get('introtext', '');
			$outrotext = $pluginParams->get('outrotext', '');
			$showname = $pluginParams->get('showname', 'name');
			$textfloat = $pluginParams->get('textfloat');
			$fontsize = $pluginParams->get('fontsize');
			$textcolor = $pluginParams->get('textcolor');
			$linkcolor = $pluginParams->get('linkcolor');
			$disablejauthor = $pluginParams->get('disablejauthor');
			$exclude_authors = explode(',',$pluginParams->get('exclude_authors',null));
			foreach ($exclude_authors as $id) {
				if ($row->created_by == (int)trim($id)) {
					return;
				}
			}
			
			$exclude_secs = explode(',',$pluginParams->get('exclude_secs',null));
			foreach ($exclude_secs as $id) {
				if ($row->sectionid == (int)trim($id)) {
					return;
				}
			}
			
			$exclude_cats = explode(',',$pluginParams->get('exclude_cats',null));
			foreach ($exclude_cats as $id) {
				if ($row->catid == (int)trim($id)) {
					return;
				}
			}	
	
			if ($disablejauthor == "no" ) {
			
		$database = &JFactory::getDbo();
		$uri = & JFactory::getURI();
		$sql = "SELECT $showname from #__users where id = '$row->created_by' LIMIT 1";
		$database->setQuery($sql);
		$cbname = $database->loadResult();
		$sql2 = "SELECT avatar FROM #__comprofiler WHERE user_id = '$row->created_by' AND avatarapproved = 1 LIMIT 1";
		$database->setQuery($sql2);
		$avatar = $database->loadResult();	
		$sql4 = "SELECT * FROM #__content_frontpage WHERE content_id = '$row->id' LIMIT 1";
		$database->setQuery($sql4);
		$onfrontpage = $database->loadResult();		
		
		$tn = 'tn';
		
		if(($showfrontpage == 'no') && ($onfrontpage)) { return; }
				
		if($showavatar == 0) {$avatar = '';}
		if(strstr($avatar,'gallery'))
			{
			$tn = '';
			} 
	
		$createdbyauthor 	= $row->created_by_alias;
		$createdby_id = $row->created_by;
		
		return '<!-- CSS STYLES -->

				<style type="text/css">
				<!--

				div.idcbauthorplug {'. '
				font-size: ' . $fontsize . 'px;
				color: ' . $textcolor . ';
				float: ' . $textfloat . ';
				
				}
				
				div.idcbauthorplug a {'. '
				font-size: ' . $fontsize . 'px;
				color: ' . $linkcolor . ';
				
				}
			
				div.cbauthorplug img {
				border-style: none;
				width: ' . $avatarwidth . 'px;
				margin-right: ' . $avatarmarginright . 'px;
				margin-left: ' . $avatarmarginleft . 'px;
				float: ' . $avatarfloat . ';
			}
			
			--></style>'
			. '<div class="cbauthorplug"><a href="index.php?option=com_comprofiler&task=userProfile&user=' . $createdby_id 
			. '"><img src="images/comprofiler/' . $tn . $avatar . '"></a><div class="idcbauthorplug">' . $introtext
			. '<a href="index.php?option=com_comprofiler&task=userProfile&user=' . $createdby_id . '"> '. $cbname . '</a> ' . $outrotext . '</div></div>';
		     
			 }
			 
			 // end if $disablejauthor no
			 
			 		if ($disablejauthor == "yes" ) {
					
		$parameter = new JParameter($row->attribs);

		global $mainframe;
		$global_page_show_author = $mainframe->getPageParameters()->get('show_author');
		$article_show_author = $parameter->get('show_author',null);
		if($global_page_show_author > 0 && $parameter->get('show_author') != '0' ){
	
		$database = &JFactory::getDbo();
		$uri = & JFactory::getURI();
		$sql = "SELECT $showname from #__users where id = '$row->created_by' LIMIT 1";
		$database->setQuery($sql);
		$cbname = $database->loadResult();
		$sql2 = "SELECT avatar FROM #__comprofiler WHERE user_id = '$row->created_by' AND avatarapproved = 1 LIMIT 1";
		$database->setQuery($sql2);
		$avatar = $database->loadResult();	
		$sql3 = "SELECT state FROM #__content WHERE id = '$row->id' LIMIT 1";
		$database->setQuery($sql3);
		$pubstate = $database->loadResult();
		$sql4 = "SELECT * FROM #__content_frontpage WHERE content_id = '$row->id' LIMIT 1";
		$database->setQuery($sql4);
		$onfrontpage = $database->loadResult();	
			
		$tn = 'tn';
				
		if(($showfrontpage == 'no') && ($onfrontpage)) {
		
		return; }
		
								
		if($showavatar == 0) {$avatar = '';}
		if(strstr($avatar,'gallery'))
			{
			$tn = '';
			} 
	
		$createdbyauthor 	= $row->created_by_alias;
		$createdby_id = $row->created_by;
		
		return '<!-- CSS STYLES -->

				<style type="text/css">
				<!--

				div.idcbauthorplug {'. '
				font-size: ' . $fontsize . 'px;
				color: ' . $textcolor . ';
				float: ' . $textfloat . ';
				
				}
				
				div.idcbauthorplug a {'. '
				font-size: ' . $fontsize . 'px;
				color: ' . $linkcolor . ';
				
				}
			
				div.cbauthorplug img {
				border-style: none;
				width: ' . $avatarwidth . 'px;
				margin-right: ' . $avatarmarginright . 'px;
				margin-left: ' . $avatarmarginleft . 'px;
				float: ' . $avatarfloat . ';
			}
			
			--></style>'
			. '<div class="cbauthorplug"><a href="index.php?option=com_comprofiler&task=userProfile&user=' . $createdby_id 
			. '"><img src="images/comprofiler/' . $tn . $avatar . '"></a><div class="idcbauthorplug">' . $introtext 
			. '<a href="index.php?option=com_comprofiler&task=userProfile&user=' . $createdby_id . '"> '. $cbname . '</a> ' . $outrotext 
			.  '</div></div>';
	    }
			 }
			 
			    
   }
   
   
   
    function onContentSave( &$article, $isNew )
    {
        return true;
    }
	
	
    function onAfterContentSave( &$article, $isNew )
    {
        return true;
    }//function
	


}//class
