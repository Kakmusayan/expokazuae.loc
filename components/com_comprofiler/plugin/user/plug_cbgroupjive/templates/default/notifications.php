<?php
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

class HTML_groupjiveNotifications {

	/**
	 * render frontend notifications
	 *
	 * @param array $input
	 * @param cbgjNotification $generalNotifications
	 * @param cbgjNotification $categoryNotifications
	 * @param cbgjNotification $groupNotifications
	 * @param cbgjCategory $category
	 * @param cbgjGroup $group
	 * @param moscomprofilerUser $user
	 * @param object $plugin
	 */
	static function showNotifications( $input, $generalNotifications, $categoryNotifications, $groupNotifications, $category, $group, $user, $plugin ) {
		global $_CB_framework;

		$generalTitle			=	$plugin->params->get( 'general_title', $plugin->name );
		$notificationsDesc		=	$plugin->params->get( 'notifications_desc', null );
		$notificationsDescGen	=	$plugin->params->get( 'notifications_desc_gen', null );
		$notificationsDescCat	=	$plugin->params->get( 'notifications_desc_cat', null );
		$notificationsDescGrp	=	$plugin->params->get( 'notifications_desc_grp', null );
		$categoryApprove		=	$plugin->params->get( 'category_approve', 0 );
		$groupApprove			=	$plugin->params->get( 'group_approve', 0 );
		$pageTitle				=	CBTxt::T( 'Notifications' );
		$pageUrl				=	cbgjClass::getPluginURL( array( 'notifications', 'show', (int) $category->get( 'id' ), (int) $group->get( 'id' ) ) );

		if ( $group->get( 'id' ) ) {
			$group->setPathway( $pageTitle, $pageUrl );
		} elseif ( $category->get( 'id' ) ) {
			$category->setPathway( $pageTitle, $pageUrl );
		} else {
			$_CB_framework->setPageTitle( htmlspecialchars( $pageTitle ) );

			if ( $generalTitle != '' ) {
				$_CB_framework->appendPathWay( htmlspecialchars( CBTxt::T( $generalTitle ) ), cbgjClass::getPluginURL() );
			}

			$_CB_framework->appendPathWay( htmlspecialchars( $pageTitle ), $pageUrl );
		}

		$authorized				=	cbgjClass::getAuthorization( $category, $group, $user );

		$tabs					=	new cbTabs( 0, 1 );

		$noNotifications		=	true;

		$return					=	null;

		if ( cbgjClass::hasAccess( 'gen_usr_notifications', $authorized ) ) {
			$return				.=					$tabs->startTab( null, htmlspecialchars( CBTxt::T( 'General' ) ), 'gjNotificationsGeneral' )
								.						( $notificationsDescGen ? '<div class="gjTop">' . CBTxt::Th( $notificationsDescGen ) . '</div>' : null )
								.						$tabs->startPane( 'gjNotificationsGeneralTabs' );

			if ( cbgjClass::hasAccess( 'usr_mod', $authorized ) ) {
				$return			.=							$tabs->startTab( null, cbgjClass::getOverride( 'category', true ), 'gjNotificationsGeneralCategories' )
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Create of new [category]', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['general_categorynew']
								.									'</div>'
								.								'</div>';

				if ( $categoryApprove ) {
					$return		.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'New [category] requires approval', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['general_categoryapprove']
								.									'</div>'
								.								'</div>';
				}

				$return			.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Update of existing [category]', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['general_categoryupdate']
								.									'</div>'
								.								'</div>'
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Delete of existing [category]', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['general_categorydelete']
								.									'</div>'
								.								'</div>'
								.							$tabs->endTab();
			}

			$return				.=							cbgjClass::getIntegrations( 'gj_onGeneralNotifications', array( $tabs, $generalNotifications, $user, $plugin ), null, null )
								.						$tabs->endPane()
								.					$tabs->endTab();

			$noNotifications	=	false;
		}

		if ( cbgjClass::hasAccess( 'cat_usr_notifications', $authorized ) ) {
			$return				.=					$tabs->startTab( null, cbgjClass::getOverride( 'category' ), 'gjNotificationsCategory' )
								.						( $notificationsDescCat ? '<div class="gjTop">' . CBTxt::Th( $notificationsDescCat ) . '</div>' : null )
								.						$tabs->startPane( 'gjNotificationsCategoryTabs' );

			if ( cbgjClass::hasAccess( 'mod_lvl1', $authorized ) ) {
				if ( cbgjClass::hasAccess( 'cat_nested', $authorized ) ) {
					$return		.=							$tabs->startTab( null, htmlspecialchars( CBTxt::P( 'Nested [categories]', array( '[categories]' => cbgjClass::getOverride( 'category', true ) ) ) ), 'gjNotificationsCategoryNestedCategories' )
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Create of new nested [category]', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['category_nestednew']
								.									'</div>'
								.								'</div>';

					if ( $categoryApprove ) {
						$return	.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'New nested [category] requires approval', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['category_nestedapprove']
								.									'</div>'
								.								'</div>';
					}

					$return		.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Update of existing nested [category]', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['category_nestedupdate']
								.									'</div>'
								.								'</div>'
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Delete of existing nested [category]', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['category_nesteddelete']
								.									'</div>'
								.								'</div>'
								.							$tabs->endTab();
				}

				if ( cbgjClass::hasAccess( 'grp_create', $authorized ) ) {
					$return		.=							$tabs->startTab( null, cbgjClass::getOverride( 'group', true ), 'gjNotificationsCategoryGroups' )
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Create of new [group]', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['category_groupnew']
								.									'</div>'
								.								'</div>';

					if ( $groupApprove ) {
						$return	.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'New [group] requires approval', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['category_groupapprove']
								.									'</div>'
								.								'</div>';
					}

					$return		.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Update of existing [group]', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['category_groupupdate']
								.									'</div>'
								.								'</div>'
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Delete of existing [group]', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['category_groupdelete']
								.									'</div>'
								.								'</div>'
								.							$tabs->endTab();
				}
			}

			$return				.=							cbgjClass::getIntegrations( 'gj_onCategoryNotifications', array( $tabs, $categoryNotifications, $category, $user, $plugin ), null, null )
								.						$tabs->endPane()
								.					$tabs->endTab();

			$noNotifications	=	false;
		}

		if ( cbgjClass::hasAccess( 'grp_usr_notifications', $authorized ) ) {
			$return				.=					$tabs->startTab( null, cbgjClass::getOverride( 'group' ), 'gjNotificationsGroup' )
								.						( $notificationsDescGrp ? '<div class="gjTop">' . CBTxt::Th( $notificationsDescGrp ) . '</div>' : null )
								.						$tabs->startPane( 'gjNotificationsGroupTabs' );

			if ( cbgjClass::hasAccess( 'mod_lvl2', $authorized ) && cbgjClass::hasAccess( 'grp_nested', $authorized ) ) {
				$return			.=							$tabs->startTab( null, htmlspecialchars( CBTxt::P( 'Nested [groups]', array( '[groups]' => cbgjClass::getOverride( 'group', true ) ) ) ), 'gjNotificationsGroupNestedGroups' )
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Create of new nested [group]', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_nestednew']
								.									'</div>'
								.								'</div>';

				if ( $groupApprove ) {
					$return		.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'New nested [group] requires approval', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_nestedapprove']
								.									'</div>'
								.								'</div>';
				}

				$return			.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Update of existing nested [group]', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_nestedupdate']
								.									'</div>'
								.								'</div>'
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Delete of existing nested [group]', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_nesteddelete']
								.									'</div>'
								.								'</div>'
								.							$tabs->endTab();
			}

			if ( cbgjClass::hasAccess( 'mod_lvl4', $authorized ) ) {
				$return			.=							$tabs->startTab( null, cbgjClass::getOverride( 'user', true ), 'gjNotificationsGroupUsers' )
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Join of new [user]', array( '[user]' => cbgjClass::getOverride( 'user' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_userjoin']
								.									'</div>'
								.								'</div>'
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Leave of existing [user]', array( '[user]' => cbgjClass::getOverride( 'user' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_userleave']
								.									'</div>'
								.								'</div>';

				if ( cbgjClass::hasAccess( 'mod_lvl2', $authorized ) ) {
					$return		.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'Invite of new [user]', array( '[user]' => cbgjClass::getOverride( 'user' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_userinvite']
								.									'</div>'
								.								'</div>';
				}

				$return			.=								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'New [user] requires approval', array( '[user]' => cbgjClass::getOverride( 'user' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_userapprove']
								.									'</div>'
								.								'</div>'
								.							$tabs->endTab();
			}

			if ( cbgjClass::hasAccess( 'grp_invite', $authorized ) ) {
				$return			.=							$tabs->startTab( null, htmlspecialchars( CBTxt::T( 'Invites' ) ), 'gjNotificationsGroupInvites' )
								.								'<div class="gjEditContentInput control-group">'
								.									'<label class="gjEditContentInputTitle control-label">' . CBTxt::Ph( 'My [group] invite requests accepted', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ) . '</label>'
								.									'<div class="gjEditContentInputField controls">'
								.										$input['group_inviteaccept']
								.									'</div>'
								.								'</div>'
								.							$tabs->endTab();
			}

			$return				.=							cbgjClass::getIntegrations( 'gj_onGroupNotifications', array( $tabs, $groupNotifications, $group, $category, $user, $plugin ), null, null )
								.						$tabs->endPane()
								.				$tabs->endTab();

			$noNotifications	=	false;
		}

		$header					=	'<div class="gjNotifications">'
								.		'<form action="' . cbgjClass::getPluginURL( array( 'notifications', 'save', (int) $category->get( 'id' ), (int) $group->get( 'id' ) ), null, true, false, null, 'current' ) . '" method="post" enctype="multipart/form-data" name="gjForm" id="gjForm" class="gjForm form-horizontal">';

		if ( $noNotifications ) {
			$return				=	$header
								.			'<div class="gjEditContent">' . CBTxt::T( 'There are no notifications to configure.' ) . '</div>';
		} else {
			$return				=	$header
								.			( $notificationsDesc ? '<div class="gjTop">' . CBTxt::Th( $notificationsDesc ) . '</div>' : null )
								.			$tabs->startPane( 'gjNotificationsTabs' )
								.				$return
								.			$tabs->endPane();
		}

		$return					.=			'<div class="gjButtonWrapper form-actions">'
								.				( ! $noNotifications ? '<input type="submit" value="' . htmlspecialchars( CBTxt::T( 'Update Notifications' ) ) . '" class="gjButton gjButtonSubmit btn btn-primary" />&nbsp;' : null )
								.				'<input type="button" value="' . htmlspecialchars( CBTxt::T( 'Back' ) ) . '" class="gjButton gjButtonCancel btn' . ( ! $noNotifications ? ' btn-mini' : null ) . '" onclick="' . cbgjClass::getPluginURL( ( $group->get( 'id' ) ? array( 'groups', 'show', (int) $category->get( 'id' ), (int) $group->get( 'id' ) ) : ( $category->get( 'id' ) ? array( 'categories', 'show', (int) $category->get( 'id' ) ) : array( 'overview' ) ) ), true, true, false, null, false, false, true ) . '" />'
								.			'</div>'
								.			cbGetSpoofInputTag( 'plugin' )
								.		'</form>'
								.	'</div>';

		echo $return;
	}
}
?>