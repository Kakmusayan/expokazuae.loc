<?php
/**
 * @copyright	Copyright (C) 2009-2013 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

if(!@include_once(rtrim(JPATH_ADMINISTRATOR,DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_acymailing'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'helper.php')){
	return;
};

$_PLUGINS->registerFunction( 'onUserActive', 'userActivated','getAcyMailingTab' );
$_PLUGINS->registerFunction( 'onAfterDeleteUser', 'userDelete','getAcyMailingTab' );
$_PLUGINS->registerFunction( 'onBeforeUserBlocking', 'onBeforeUserBlocking','getAcyMailingTab' );

class getAcyMailingTab extends cbTabHandler {

	var $installed = true;
	var $errorMessage = 'This plugin can not work without the AcyMailing Component.<br/>Please download it from <a href="http://www.acyba.com">http://www.acyba.com</a> and install it.';

	function getAcyMailingTab(){
		if(!class_exists('acymailing')){
			$this->installed = false;
		}

		$this->cbTabHandler();
	}

	function getDisplayRegistration($tab, $user, $ui, $postdata) {
		$return = array();

		$visibleLists=$this->params->get('lists','All');
		$hiddenLists=$this->params->get('hiddenlists','None');
		$displayhtml=$this->params->get('display_html',1);

		if($displayhtml){
			$htmlValue = JHTML::_('select.booleanlist', "acymailing[user][html]" ,'',1,JText::_('HTML'),JText::_('JOOMEXT_TEXT').'&nbsp;&nbsp;');
			$return[] = cbTabs::_createPseudoField( $tab, JText::_('RECEIVE'), $htmlValue, '', 'acymailingReceiveField', false );
		}

		$listsClass = acymailing_get('class.list');
		$allLists = $listsClass->getLists('listid');
		if(acymailing_level(1)){
			$allLists = $listsClass->onlyCurrentLanguage($allLists);
		}

		if(empty($allLists)) return $return;

		$visibleListsArray = array();
		$hiddenListsArray = array();

		//Load the lists...
		if(strpos($visibleLists,',') OR is_numeric($visibleLists)){
			$allvisiblelists = explode(',',$visibleLists);
			foreach($allLists as $oneList){
				if($oneList->published AND in_array($oneList->listid,$allvisiblelists)){ $visibleListsArray[] = $oneList->listid; }
			}
		}elseif(strtolower($visibleLists) == 'all'){
			foreach($allLists as $oneList){
				if($oneList->published){$visibleListsArray[] = $oneList->listid;}
			}
		}

		if(strpos($hiddenLists,',') OR is_numeric($hiddenLists)){
			$hiddenListsArray = explode(',',$hiddenLists);
		}elseif(strtolower($hiddenLists) == 'all'){
			$visibleListsArray = array();
			foreach($allLists as $oneList){
				if($oneList->published){$hiddenListsArray[] = $oneList->listid;}
			}
		}

		if(!empty($visibleListsArray) AND !empty($hiddenListsArray)){
			$visibleListsArray =  array_diff($visibleListsArray, $hiddenListsArray);
		}

		//Check lists...
		$checkedLists = $this->params->get('listschecked','All');
		if(strtolower($checkedLists) == 'all'){ $checkedListsArray = $visibleListsArray;}
		elseif(strpos($checkedLists,',') OR is_numeric($checkedLists)){ $checkedListsArray = explode(',',$checkedLists);}
		else{ $checkedListsArray = array();}

		if($this->params->get('addoverlay',false)) JHTML::_('behavior.tooltip');

		$label = $this->params->get('subcaption');
		if(empty($label)) $label = JText::_('SUBSCRIPTION');
		$hiddenLists = implode(',',$hiddenListsArray);
		if(!empty($visibleListsArray)){
			$listsHtml = '<table style="border:0px;">';
			foreach($visibleListsArray as $oneList){
				$check = in_array($oneList,$checkedListsArray) ? 'checked="checked"' : '';
				$name = $this->params->get('addoverlay',false) ? acymailing_tooltip($allLists[$oneList]->description,$allLists[$oneList]->name, '', $allLists[$oneList]->name) : $allLists[$oneList]->name;
				$listsHtml .= '<tr style="border:0px;"><td style="border:0px;"><input type="checkbox" class="acymailing_checkbox" id="acy_'.$oneList.'" name="acymailing[subscription][]" '.$check.' value="'.$oneList.'"/></td><td style="border:0px;"><label for="acy_'.$oneList.'">'.$name.'</label></td></tr>';
			}
			$listsHtml .= '</table>';
			$return[] = cbTabs::_createPseudoField( $tab, $label, $listsHtml, '', 'acymailingLists', false );
		}

		return $return;
	}

	function getDisplayTab( $tab, $user, $ui) {
		if($_GET['id']=='subscribe'){
		$my = JFactory::getUser();

		if (empty($my->id) OR $my->id != $user->user_id) return;

		$userClass = acymailing_get('class.subscriber');
		$joomUser = $userClass->get($user->email);

		if(empty($joomUser->subid)) return;

		$doc = JFactory::getDocument();
		$config =& acymailing_config();
		$cssFrontend = $config->get('css_frontend','default');
		if(!empty($cssFrontend)){
			$doc->addStyleSheet( ACYMAILING_CSS.'component_'.$cssFrontend.'.css' );
		}

		$listsClass = acymailing_get('class.list');
		$allLists = $userClass->getSubscription($joomUser->subid,'listid');

		if(acymailing_level(1)){
			$allLists = $listsClass->onlyCurrentLanguage($allLists);
		}

		if(acymailing_level(3)){
			foreach($allLists as $listid => $oneList){
				if(!$allLists[$listid]->published) continue;
				if(!acymailing_isAllowed($oneList->access_sub)){
					$allLists[$listid]->published = false;
					 continue;
				}
			}
		}

		$lists=$this->params->get('listsprofile','All');

		$visibleListsArray = array();
		if(strpos($lists,',') OR is_numeric($lists)){
			$allvisiblelists = explode(',',$lists);
			foreach($allLists as $oneList){
				if($oneList->published AND in_array($oneList->listid,$allvisiblelists)) {$visibleListsArray[] = $oneList->listid;}
			}
		}elseif(strtolower($lists) == 'all'){
			foreach($allLists as $oneList){
				if($oneList->published){$visibleListsArray[] = $oneList->listid;}
			}
		}

		if(empty($visibleListsArray)) return;

		$return = '';
		$introText = $this->params->get('introtext');
		if(!empty($introText)){
			$return .= '<div class="acymailing_introtext" >'.$introText.'</div>';
		}

		if($this->params->get('display_htmlprofile',1)){
			$return .= '<table><tr><td class="titleCell">'.JText::_('RECEIVE').'</td><td class="fieldCell">'.JHTML::_('select.booleanlist', "acymailing[user][html]" ,'disabled="disabled"',empty($joomUser->subid) ? 1 : $joomUser->html,JText::_('HTML'),JText::_('JOOMEXT_TEXT').'&nbsp;&nbsp;').'</td></tr></table>';
		}

		$return .= '<a name="subscribe"></a><table class="acycbsubscription"><tr><th>'.JText::_('SUBSCRIPTION').'</th><th>'.JText::_('LIST').'</th></tr>';
		$k = 0;
		$i = 0;
		foreach($visibleListsArray as $oneListid){
			$return .= '<tr class="row'.$k.'"><td align="center" valign="top"  nowrap="nowrap" ><input type="checkbox" disabled="disabled"'.(($allLists[$oneListid]->status > 0) ? ' checked="checked" ' : '').'/></td>';
			$return .= '<td valign="top"><div class="list_name">'.$allLists[$oneListid]->name.'</div><div class="list_description">'.$allLists[$oneListid]->description.'</div></td></tr>';
			$k = 1-$k;
		}

		$return .= '</table>';

		return $return;					}
		}

	function saveRegistrationTab($tab, &$user, $ui, $postdata) {
		if(empty($user->user_id) OR !$this->installed) return;

		$subscriberClass = acymailing_get('class.subscriber');
		$subscriberClass->checkVisitor = false;
		$subscriberClass->sendConf = false;
		$subscriber = $subscriberClass->get($user->email);

		$subscriber->email = $user->email;
		if(!empty($user->name)) $subscriber->name = $user->name;
		if(!empty($user->user_id)) $subscriber->userid = $user->user_id;
		if(!empty($user->confirmed)) $subscriber->confirmed = $user->confirmed;
		if(!empty($user->block)) $subscriber->enabled = 0;

		if(!empty($postdata['acymailing']['user'])){
			$subscriberClass->checkFields($postdata['acymailing']['user'],$subscriber);
		}

		$subscriber->subid = $subscriberClass->save($subscriber);

		//Subscription...
		$config = acymailing_config();
		$statusAdd = (empty($user->confirmed) AND $config->get('require_confirmation',false)) ? 2 : 1;

		$allLists = $subscriberClass->getSubscriptionStatus($subscriber->subid);

		$hiddenLists = $this->params->get('hiddenlists');
		if(strpos($hiddenLists,',') OR is_numeric($hiddenLists)){
			$hiddenListsArray = explode(',',$hiddenLists);
		}elseif(strtolower($hiddenLists) == 'all'){
			$hiddenListsArray = array_keys($allLists);
		}

		$addlists = array();
		if(!empty($hiddenListsArray)){
			foreach($hiddenListsArray as $idOneList){
				if(empty($allLists[$idOneList]->status)) $addlists[$statusAdd][] = $idOneList;
			}
		}

		if(!empty($postdata['acymailing']['subscription'])){
			foreach($postdata['acymailing']['subscription'] as $idOneList){
				if(empty($allLists[$idOneList]->status)) $addlists[$statusAdd][] = $idOneList;
			}
		}

		$listsubClass = acymailing_get('class.listsub');
		if(!empty($user->gid)) $listsubClass->gid = $user->gid;
		if(!empty($addlists)){
			$listsubClass->addSubscription($subscriber->subid,$addlists);
		}

		return;
	}

	function userDelete($user, $success) {
		if(!$this->installed){ return $this->errorMessage;}

		if (!$success) return;

		$userClass = acymailing_get('class.subscriber');
		$subid = $userClass->subid($user->email);
		if(!empty($subid)){
			$userClass->delete($subid);
		}
	}

	function userActivated($user, $success) {
		if(!$this->installed){ return $this->errorMessage;}

		if (!$success) return;

		$userClass = acymailing_get('class.subscriber');
		$subid = $userClass->subid($user->email);
		if(!empty($subid)){
			if(empty($user->block)){
				$db = JFactory::getDBO();
				$db->setQuery('UPDATE `#__acymailing_subscriber` SET `enabled` = 1 WHERE `subid` = '.$subid.' LIMIT 1');
				$db->query();
			}
			$userClass->confirmSubscription($subid);
		}

		return;
	}

	function onBeforeUserBlocking($user,$block){
		$db =& JFactory::getDBO();
		$db->setQuery('UPDATE `#__acymailing_subscriber` SET `enabled` = '.(1-intval($block)).' WHERE `userid` = '.intval($user->id).' LIMIT 1');
		$db->query();
	}

	function getEditTab( $tab, $user, $ui) {
		if(!$this->installed){ return $this->errorMessage;}

		$app = JFactory::getApplication();

		$config =& acymailing_config();
		$cssFrontend = $config->get('css_frontend','default');
		$doc = JFactory::getDocument();
		if(!empty($cssFrontend)){
			$doc->addStyleSheet( ACYMAILING_CSS.'component_'.$cssFrontend.'.css' );
		}

		$return = '';

		$lists=$this->params->get('listsprofile','All');
		$displayhtml=$this->params->get('display_htmlprofile',1);

		$userClass = acymailing_get('class.subscriber');
		$joomUser = $userClass->get($user->email);

		$db = JFactory::getDBO();

		if(empty($joomUser->subid)){
			//User not inserted?? How is that possible...? well, if it's a new!
		}elseif(!empty($user->id) AND (int)$joomUser->userid != (int)$user->id){
			//Update the field so that it's linked to this user so during the update we can keep the same user.
			//Let's update the user Id...
			$db->setQuery('UPDATE '.acymailing_table('subscriber').' SET userid = '.(int) $user->id.' WHERE subid = '.(int) $joomUser->subid.' LIMIT 1');
			$db->query();
		}

		$listsClass = acymailing_get('class.list');
		if(!empty($joomUser->subid)){
			$allLists = $userClass->getSubscription($joomUser->subid,'listid');
		}else{
			$allLists = $listsClass->getLists('listid');
		}

		if(!$app->isAdmin() AND acymailing_level(1)){
			$allLists = $listsClass->onlyCurrentLanguage($allLists);
		}

		if(!$app->isAdmin() AND acymailing_level(3)){
			$my = JFactory::getUser();
			foreach($allLists as $listid => $oneList){
				if(!$allLists[$listid]->published) continue;
				if(!acymailing_isAllowed($oneList->access_sub)){
					$allLists[$listid]->published = false;
					 continue;
				}
			}
		}

		//If we come from the Admin interface, we display all the lists.
		if($app->isAdmin()){
			$visibleListsArray = array_keys($allLists);
		}else{
			$visibleListsArray = array();
			if(strpos($lists,',') OR is_numeric($lists)){
				$allvisiblelists = explode(',',$lists);
				foreach($allLists as $oneList){
					if($oneList->published AND in_array($oneList->listid,$allvisiblelists)) {$visibleListsArray[] = $oneList->listid;}
				}
			}elseif(strtolower($lists) == 'all'){
				foreach($allLists as $oneList){
					if($oneList->published){$visibleListsArray[] = $oneList->listid;}
				}
			}
		}


		if($displayhtml){
			//Add the receive text/html option
			$return .= '<table><tr><td class="titleCell">'.JText::_('RECEIVE').'</td><td class="fieldCell">'.JHTML::_('select.booleanlist', "acymailing[user][html]" ,'',empty($joomUser->subid) ? 1 : $joomUser->html,JText::_('HTML'),JText::_('JOOMEXT_TEXT').'&nbsp;&nbsp;').'</td></tr></table>';
		}

		if(!empty($visibleListsArray)){
			if($app->isAdmin()){
				$status = acymailing_get('type.status');
			}else{
				$status = acymailing_get('type.festatus');
			}


			$return .= '<table class="acycbsubscription"><tr><th>'.JText::_('SUBSCRIPTION').'</th><th>'.JText::_('LIST').'</th></tr>';
			$k = 0;
			foreach($visibleListsArray as $oneListid){
				$return .= '<tr class="row'.$k.'"><td align="center" valign="top" nowrap="nowrap" >'.$status->display("acymailing[listsub][".$oneListid."][status]",@$allLists[$oneListid]->status).'</td>';
				$return .= '<td valign="top"><div class="list_name">'.$allLists[$oneListid]->name.'</div><div class="list_description">'.$allLists[$oneListid]->description.'</div></td></tr>';
				$k = 1-$k;
			}

			$return .= '</table>';
		}

		return $return;
	}

	function saveEditTab($tab, &$user, $ui, $postdata) {

		$subscriberClass = acymailing_get('class.subscriber');
		$subscriberClass->triggerFilterBE = true;
		$subscriber = new stdClass();
		$subscriber->subid = $subscriberClass->subid($user->id);

		//We use the user->id to update the infos as we are sure it does exists.
		if(!empty($postdata['acymailing']['user'])){
			//Check the infos...
			$subscriberClass->checkFields($postdata['acymailing']['user'],$subscriber);
		}

		if(!empty($user->name)) $subscriber->name = $user->name;
		if(!empty($user->email)) $subscriber->email = $user->email;
		$subscriber->enabled = empty($user->block) ? 1 : 0;
		$subscriber->confirmed = $user->confirmed;
		$subscriber->userid = $user->id;
		$subscriber->subid = $subscriberClass->save($subscriber);

		if(empty($subscriber->subid)) return;

		if(!empty($postdata['acymailing']['listsub'])){
			$subscriberClass->saveSubscription($subscriber->subid,$postdata['acymailing']['listsub']);
		}

	}

	function help($name,$value,$control_name){

		if(!$this->installed){ return $this->errorMessage;}

		JHTML::_('behavior.modal');
		$config =& acymailing_config();
		$level = $config->get('level');

		$link = ACYMAILING_HELPURL.'cbplugin'.'&level='.$level;
		$text = '<a class="modal" title="'.JText::_('ACY_HELP',true).'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 800, y: 500}}"><button onclick="return false">'.JText::_('ACY_HELP').'</button></a>';

		return $text;
	}

	function lists($name,$value,$control_name){

		if(!$this->installed){ return $this->errorMessage;}

		JHTML::_('behavior.modal');
		$link = 'index.php?option=com_acymailing&amp;tmpl=component&amp;ctrl=chooselist&amp;task='.$name.'&amp;control='.$control_name.'&amp;values='.$value;
		$text = '<input class="inputbox" id="'.$control_name.$name.'" name="'.$control_name.'['.$name.']" type="text" size="20" value="'.$value.'">';
		$text .= '<a class="modal" id="link'.$control_name.$name.'" title="'.JText::_('Select one or several Lists').'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 650, y: 375}}"><button onclick="return false">'.JText::_('Select').'</button></a>';

		return $text;

	}
}

