<?php
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

class HTML_groupjiveCategoryGroups {

	/**
	 * render frontend category groups
	 *
	 * @param object $rows
	 * @param object $pageNav
	 * @param cbgjCategory $category
	 * @param moscomprofilerUser $user
	 * @param object $plugin
	 * @return string
	 */
	static function showGroups( $rows, $pageNav, $category, $user, $plugin ) {
		$categoryGroupsSearch		=	$plugin->params->get( 'category_groups_search', 1 );
		$categoryGroupsPaging		=	$plugin->params->get( 'category_groups_paging', 1 );
		$categoryGroupsLimitbox		=	$plugin->params->get( 'category_groups_limitbox', 1 );

		$return						=	'<form action="' . $category->getUrl() . '" method="post" name="gjForm" id="gjForm" class="gjForm">'
									.		( $categoryGroupsSearch && ( $pageNav->searching || $pageNav->total ) ? '<div class="gjTop gjTopRight">' . $pageNav->search . '</div>' : null );

		if ( $rows ) foreach ( $rows as $row ) {
			$authorized				=	cbgjClass::getAuthorization( $category, $row, $user );

			if ( $row->get( 'published' ) == 1 ) {
				$state				=	'<div><a href="javascript: void(0);" onclick="' . cbgjClass::getPluginURL( array( 'groups', 'unpublish', (int) $category->get( 'id' ), (int) $row->get( 'id' ) ), CBTxt::P( 'Are you sure you want to unpublish this [group]?', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ), true, false, null, true ) . '"><i class="icon-ban-circle"></i> ' . CBTxt::Th( 'Unpublish' ) . '</a></div>';
			} else {
				$state				=	'<div><a href="' . cbgjClass::getPluginURL( array( 'groups', 'publish', (int) $category->get( 'id' ), (int) $row->get( 'id' ) ), null, true, false, null, true ) . '"><i class="icon-ok"></i> ' . CBTxt::Th( 'Publish' ) . '</a></div>';
			}

			$beforeMenu				=	cbgjClass::getIntegrations( 'gj_onBeforeCategoryGroupMenu', array( $row, $category, $user, $plugin ) );
			$afterMenu				=	cbgjClass::getIntegrations( 'gj_onAfterCategoryGroupMenu', array( $row, $category, $user, $plugin ) );

			$return					.=		'<div class="gjContent row-fluid">'
									.			'<div class="gjContentLogo span2">' . $row->getLogo( true, true, true ) . '</div>'
									.			'<div class="gjContentBody mini-layout span10">'
									.				'<div class="gjContentBodyHeader row-fluid">'
									.					'<div class="gjContentBodyTitle span9"><h5>' . $row->getName( 0, true ) . '<small> ' . cbFormatDate( $row->get( 'date' ), 1, false ) . '</small></h5></div>'
									.					'<div class="gjContentBodyMenu span3">';

			if ( cbgjClass::hasAccess( 'grp_join', $authorized ) ) {
				$return				.=						'<input type="button" value="' . htmlspecialchars( ( cbgjClass::hasAccess( 'grp_invited', $authorized ) ? CBTxt::T( 'Accept Invite' ) : CBTxt::T( 'Join' ) ) ) . '" class="gjButton btn btn-success" onclick="' . cbgjClass::getPluginURL( array( 'groups', 'join', (int) $category->get( 'id' ), (int) $row->get( 'id' ) ), true, true, false, null, true ) . '" />';
			}

			if ( $beforeMenu || cbgjClass::hasAccess( array( 'grp_leave', 'mod_lvl2', 'mod_lvl3', 'grp_can_publish' ), $authorized ) || $afterMenu ) {
				$return				.=						'<div class="gjDropdown">'
									.							'<i class="icon-chevron-down"></i>'
									.							'<div class="gjDropdownItems">'
									.								$beforeMenu
									.								( cbgjClass::hasAccess( 'grp_leave', $authorized ) ? '<div><a href="javascript: void(0);" onclick="' . cbgjClass::getPluginURL( array( 'groups', 'leave', (int) $category->get( 'id' ), (int) $row->get( 'id' ) ), CBTxt::P( 'Are you sure you want to leave this [group]?', array( '[group]' => cbgjClass::getOverride( 'group' ) ) ), true, false, null, true ) . '"><i class="icon-minus"></i> ' . CBTxt::Th( 'Leave' ) . '</a></div>' : null )
									.								( cbgjClass::hasAccess( 'mod_lvl3', $authorized ) ? '<div><a href="' . cbgjClass::getPluginURL( array( 'groups', 'edit', (int) $category->get( 'id' ), (int) $row->get( 'id' ) ), null, true, false, null, true ) . '"><i class="icon-pencil"></i> ' . CBTxt::Th( 'Edit' ) . '</a></div>' : null )
									.								( cbgjClass::hasAccess( 'grp_can_publish', $authorized ) ? $state : null )
									.								( cbgjClass::hasAccess( 'mod_lvl2', $authorized ) ? '<div><a href="javascript: void(0);" onclick="' . cbgjClass::getPluginURL( array( 'groups', 'delete', (int) $category->get( 'id' ), (int) $row->get( 'id' ) ), CBTxt::P( 'Are you sure you want to delete this [group] and all its associated [users]?', array( '[group]' => cbgjClass::getOverride( 'group' ), '[users]' => cbgjClass::getOverride( 'user', true ) ) ), true, false, null, true ) . '"><i class="icon-remove"></i> ' . CBTxt::Th( 'Delete' ) . '</a></div>' : null )
									.								$afterMenu
									.							'</div>'
									.						'</div>';
			}

			$return					.=					'</div>'
									.				'</div>'
									.				'<div class="gjContentBodyInfo">' . ( $row->getDescription() ? '<div class="well well-small">' . $row->getDescription() . '</div>' : null ) . '</div>'
									.				'<div class="gjContentDivider"></div>'
									.				'<div class="gjContentBodyFooter">'
									.					cbgjClass::getIntegrations( 'gj_onBeforeCategoryGroupInfo', array( $row, $category, $user, $plugin ), null, 'span' )
									.					( ( ( ( ! $row->get( 'nested' ) ) && cbgjClass::hasAccess( 'mod_lvl2', $authorized ) ) || $row->get( 'nested' ) ) && $row->nestedCount() ? cbgjClass::getOverride( 'group', $row->nestedCount() ) . ' | ' : null )
									.					( $row->userCount() ? cbgjClass::getOverride( 'user', $row->userCount() ) . ' | ' : null )
									.					$row->getType()
									.					cbgjClass::getIntegrations( 'gj_onAfterCategoryGroupInfo', array( $row, $category, $user, $plugin ), null, 'span' )
									.				'</div>'
									.			'</div>'
									.		'</div>';
		} else {
			$return					.=		'<div class="gjContent">';

			if ( $categoryGroupsSearch && $pageNav->searching ) {
				$return				.=			CBTxt::Ph( 'No [group] search results found.', array( '[group]' => cbgjClass::getOverride( 'group' ) ) );
			} else {
				$return				.=			CBTxt::Ph( 'There are no [groups] available.', array( '[groups]' => cbgjClass::getOverride( 'group', true ) ) );
			}

			$return					.=		'</div>';
		}

		if ( $categoryGroupsPaging ) {
			$return					.=		'<div class="gjPaging pagination pagination-centered">'
									.			( $pageNav->total > $pageNav->limit ? $pageNav->pagelinks : null )
									.			( ! $categoryGroupsLimitbox ? $pageNav->getLimitBox( false ) : ( $pageNav->total ? '<div class="gjPagingLimitbox">' . $pageNav->limitbox . '</div>' : null ) )
									.		'</div>';
		}

		$return						.=		cbGetSpoofInputTag( 'plugin' )
									.	'</form>';

		return $return;
	}
}
?>