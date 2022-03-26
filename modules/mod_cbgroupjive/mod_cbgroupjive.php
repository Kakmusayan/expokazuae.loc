<?php
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

global $_CB_framework, $mainframe;

if ( defined( 'JPATH_ADMINISTRATOR' ) ) {
	if ( ! file_exists( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' ) ) {
		return;
	}

	require_once( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' );
} else {
	if ( ! file_exists( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php' ) ) {
		return;
	}

	require_once( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php' );
}

cbimport( 'cb.html' );

if ( ! file_exists( $_CB_framework->getCfg( 'absolute_path' ) . '/components/com_comprofiler/plugin/user/plug_cbgroupjive/cbgroupjive.class.php' ) ) {
	return;
}

require_once( $_CB_framework->getCfg( 'absolute_path' ) . '/components/com_comprofiler/plugin/user/plug_cbgroupjive/cbgroupjive.class.php' );

$class_sfx						=	$params->get( 'moduleclass_sfx', null );
$layout							=	(int) $params->get( 'gj_layout', 0 );
$display						=	(int) $params->get( 'gj_display', 5 );
$mode							=	(int) $params->get( 'gj_mode', 2 );
$name_length					=	(int) $params->get( 'gj_length', 8 );
$include						=	$params->get( 'gj_include', null );
$exclude						=	$params->get( 'gj_exclude', null );
$includecat						=	$params->get( 'gj_includecat', null );
$excludecat						=	$params->get( 'gj_excludecat', null );
$includegrp						=	$params->get( 'gj_includegrp', null );
$excludegrp						=	$params->get( 'gj_excludegrp', null );
$plugin							=	cbgjClass::getPlugin();
$user							=&	CBuser::getUserDataInstance( $_CB_framework->myId() );
$class_layout					=	( $layout ? 'H' : 'V' );
$return							=	'<div class="cbGroupJive cbGroupJiveModule">';

$include_exclude				=	array();

if ( in_array( $mode, array( 0, 1, 2, 3 ) ) ) {
	if ( $include ) {
		$include				=	explode( '|*|', $include );

		cbArrayToInts( $include );

		$include_exclude[]		=	array( 'id', 'IN', implode( ',', $include ) );
	}

	if ( $exclude ) {
		$exclude				=	explode( '|*|', $exclude );

		cbArrayToInts( $exclude );

		$include_exclude[]		=	array( 'id', '!IN', implode( ',', $exclude ) );
	}
}

if ( in_array( $mode, array( 2, 3, 8, 9 ) ) ) {
	if ( $includecat ) {
		$includecat				=	explode( '|*|', $includecat );

		cbArrayToInts( $includecat );

		$include_exclude[]		=	array( 'category', 'IN', implode( ',', $includecat ) );
	}

	if ( $excludecat ) {
		$excludecat				=	explode( '|*|', $excludecat );

		cbArrayToInts( $excludecat );

		$include_exclude[]		=	array( 'category', '!IN', implode( ',', $excludecat ) );
	}
}

if ( in_array( $mode, array( 11, 12, 13, 14, 15 ) ) ) {
	if ( $includegrp ) {
		$includegrp				=	explode( '|*|', $includegrp );

		cbArrayToInts( $includegrp );

		$include_exclude[]		=	array( 'group', 'IN', implode( ',', $includegrp ) );
	}

	if ( $excludegrp ) {
		$excludegrp				=	explode( '|*|', $excludegrp );

		cbArrayToInts( $excludegrp );

		$include_exclude[]		=	array( 'group', '!IN', implode( ',', $excludegrp ) );
	}
}

if ( checkJversion() < 1 ) {
	$_CB_framework->document->addHeadStyleSheet( $_CB_framework->getCfg( 'live_site' ) . '/modules/mod_cbgroupjive.css' );
} else {
	$_CB_framework->document->addHeadStyleSheet( $_CB_framework->getCfg( 'live_site' ) . '/modules/mod_cbgroupjive/mod_cbgroupjive.css' );
}

if ( $mode == 0 ) {
	cbgjClass::getTemplate();

	$rows						=	cbgjData::getCategories( array( array( 'cat_access', 'mod_lvl1' ), $user ), $include_exclude, array( 'date', 'DESC' ), $display );

	$return						.=		'<div class="gjLatestCategories' . $class_layout . $class_sfx . '">';

	if ( $rows ) foreach ( $rows as $row ) {
		$return					.=			'<div class="gjLatestCategory">'
								.				'<div class="gjLatestCategoryName">' . $row->getName( $name_length, true ) . '</div>'
								.				'<div class="gjLatestCategoryLogo">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjLatestCategoryInfo">' . cbFormatDate( $row->date, 1, false ) . '</div>'
								.			'</div>';
	} else {
		$return					.=			CBTxt::P( 'There are no [categories] available.', array( '[categories]' => cbgjClass::getOverride( 'category', true ) ) );
	}

	$return						.=		'</div>';
} elseif ( $mode == 1 ) {
	cbgjClass::getTemplate();

	$rows						=	cbgjData::getCategories( array( array( 'cat_access', 'mod_lvl1' ), $user ), $include_exclude, 'group_count', $display );

	$return						.=		'<div class="gjPopularCategories' . $class_layout . $class_sfx . '">';

	if ( $rows ) foreach ( $rows as $row ) {
		$return					.=			'<div class="gjPopularCategory">'
								.				'<div class="gjPopularCategoryName">' . $row->getName( $name_length, true ) . '</div>'
								.				'<div class="gjPopularCategoryLogo">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjPopularCategoryInfo">' . cbgjClass::getOverride( 'group', $row->groupCount() ) . '</div>'
								.			'</div>';
	} else {
		$return					.=			CBTxt::P( 'There are no [categories] available.', array( '[categories]' => cbgjClass::getOverride( 'category', true ) ) );
	}

	$return						.=		'</div>';
} elseif ( $mode == 2 ) {
	cbgjClass::getTemplate();

	$rows						=	cbgjData::getGroups( array( array( 'grp_access', 'mod_lvl2' ), $user ), $include_exclude, array( 'date', 'DESC' ), $display );

	$return						.=		'<div class="gjLatestGroups' . $class_layout . $class_sfx . '">';

	if ( $rows ) foreach ( $rows as $row ) {
		$return					.=			'<div class="gjLatestGroup">'
								.				'<div class="gjLatestGroupName">' . $row->getName( $name_length, true ) . '</div>'
								.				'<div class="gjLatestGroupLogo">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjLatestGroupInfo">' . cbFormatDate( $row->date, 1, false ) . '</div>'
								.			'</div>';
	} else {
		$return					.=			CBTxt::P( 'There are no [groups] available.', array( '[groups]' => cbgjClass::getOverride( 'group', true ) ) );
	}

	$return						.=		'</div>';
} elseif ( $mode == 3 ) {
	cbgjClass::getTemplate();

	$rows						=	cbgjData::getGroups( array( array( 'grp_access', 'mod_lvl2' ), $user ), $include_exclude, 'user_count', $display );

	$return						.=		'<div class="gjPopularGroups' . $class_layout . $class_sfx . '">';

	if ( $rows ) foreach ( $rows as $row ) {
		$return					.=			'<div class="gjPopularGroup">'
								.				'<div class="gjPopularGroupName">' . $row->getName( $name_length, true ) . '</div>'
								.				'<div class="gjPopularGroupLogo">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjPopularGroupInfo">' . cbgjClass::getOverride( 'user', $row->userCount() ) . '</div>'
								.			'</div>';
	} else {
		$return					.=			CBTxt::P( 'There are no [groups] available.', array( '[groups]' => cbgjClass::getOverride( 'group', true ) ) );
	}

	$return						.=		'</div>';
} elseif ( $mode == 4 ) {
	cbgjClass::getTemplate();

	$groups						=	cbgjData::getGroups( array( array( 'grp_access', 'mod_lvl2' ), $user ) );

	$user_count					=	0;

	if ( $groups ) foreach ( $groups as $group ) {
		$user_count				+=	$group->userCount();
	}

	$return						.=		'<div class="gjStatistics' . $class_sfx . '">'
								.			'<div class="gjStatisticsCategories">' . cbgjClass::getOverride( 'category', count( cbgjData::getCategories( array( array( 'cat_access', 'mod_lvl1' ), $user ) ) ) ) . '</div>'
								.			'<div class="gjStatisticsGroups">' . cbgjClass::getOverride( 'group', count( $groups ) ) . '</div>'
								.			'<div class="gjStatisticsUsers">' . cbgjClass::getOverride( 'user', $user_count ) . '</div>'
								.		'</div>';
} elseif ( $mode == 5 ) {
	$input_js					=	"var pane = $( '.gjPanes' ).detach();"
								.	"if ( pane ) {"
								.		"pane.appendTo( '#gjMenuJQ' );"
								.		"$( '.gjPanes' ).width( '100%' );"
								.		"$( '.gjMain' ).width( '100%' );"
								.	"}";

	$_CB_framework->outputCbJQuery( $input_js );

	$return						.=		'<div id="gjMenuJQ" class="gjMenuJQ' . $class_sfx . '"></div>';
} elseif ( $mode == 6 ) {
	$location					=	cbGetParam( $_REQUEST, 'plugin', null );
	$return						.=		'<div class="gjMenuAPI' . $class_sfx . '">';

	if ( $location == 'cbgroupjive' ) {
		$action					=	cbGetParam( $_REQUEST, 'action', null );
		$catid					=	cbGetParam( $_REQUEST, 'cat', null );
		$grpid					=	cbGetParam( $_REQUEST, 'grp', null );

		switch ( $action ) {
			case 'panel':
				$authorized		=	cbgjClass::getAuthorization( null, null, $user );

				if ( ( $plugin->params->get( 'overview_panel', 1 ) && in_array( 'usr_me', $authorized ) ) || in_array( 'usr_mod', $authorized ) ) {
					cbgjClass::getTemplate( array( 'panel', 'panel_panes' ) );

					$return		.=			HTML_groupjivePanelPanes::showPanelPanes( $user, $plugin );
				}
				break;
			case 'categories':
				$row			=	cbgjData::getCategories( array( array( 'cat_access', 'mod_lvl1' ), $user ), array( 'id', '=', $catid ), null, null, false );

				if ( $row->id ) {
					cbgjClass::getTemplate( array( 'category', 'category_panes' ) );

					$return		.=			HTML_groupjiveCategoryPanes::showCategoryPanes( $row, $user, $plugin );
				}
				break;
			case 'groups':
				$category		=	cbgjData::getCategories( array( array( 'cat_access', 'mod_lvl1' ), $user ), array( 'id', '=', $catid ), null, null, false );
				$row			=	cbgjData::getGroups( array( array( 'grp_access', 'mod_lvl2' ), $user ), array( 'id', '=', $grpid ), null, null, false );

				if ( ( ! $category->id ) && $row->id ) {
					$category	=	( isset( $row->_category ) ? $row->_category : null );
				}

				if ( $row->id ) {
					cbgjClass::getTemplate( array( 'group', 'group_panes' ) );

					$return		.=			HTML_groupjiveGroupPanes::showGroupPanes( $row, $category, $user, $plugin );
				}
				break;
			case 'overview':
			default:
				cbgjClass::getTemplate( array( 'overview', 'overview_panes' ) );

				$return			.=			HTML_groupjiveOverviewPanes::showOverviewPanes( $user, $plugin );
				break;
		}
	}

	$return						.=		'</div>';
} elseif ( $mode == 7 ) {
	cbgjClass::getTemplate();

	$rows						=	cbgjData::getCategories( array( array( 'cat_access', 'mod_lvl1' ), $user ), array( 'user_id', '=', $user->id ), null, $display );

	$return						.=		'<div class="gjMyCategories' . $class_layout . $class_sfx . '">';

	if ( $rows ) foreach ( $rows as $row ) {
		$return					.=			'<div class="gjMyCategory">'
								.				'<div class="gjMyCategoryName">' . $row->getName( $name_length, true ) . '</div>'
								.				'<div class="gjMyCategoryLogo">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjMyCategoryInfo">' . cbgjClass::getOverride( 'group', $row->groupCount() ) . '</div>'
								.			'</div>';
	} else {
		$return					.=			CBTxt::P( 'There are no [categories] available.', array( '[categories]' => cbgjClass::getOverride( 'category', true ) ) );
	}

	$return						.=		'</div>';
} elseif ( $mode == 8 ) {
	cbgjClass::getTemplate();

	$where						=	$include_exclude;

	if ( $plugin->params->get( 'group_tab_joined', 0 ) ) {
		$where[]				=	array( 'user_id', '=', $user->id, array( 'e.user_id', '=', $user->id, 'e.status', '!IN', array( -1, 0, 4 ) ) );
	} else {
		$where[]				=	array( 'user_id', '=', $user->id );
	}

	$rows						=	cbgjData::getGroups( array( array( 'grp_access', 'mod_lvl2' ), $user ), $where, null, $display );

	$return						.=		'<div class="gjMyGroups' . $class_layout . $class_sfx . '">';

	if ( $rows ) foreach ( $rows as $row ) {
		$return					.=			'<div class="gjMyGroup">'
								.				'<div class="gjMyGroupName">' . $row->getName( $name_length, true ) . '</div>'
								.				'<div class="gjMyGroupLogo">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjMyGroupInfo">' . cbgjClass::getOverride( 'user', $row->userCount() ) . '</div>'
								.			'</div>';
	} else {
		$return					.=			CBTxt::P( 'There are no [groups] available.', array( '[groups]' => cbgjClass::getOverride( 'group', true ) ) );
	}

	$return						.=		'</div>';
} elseif ( $mode == 9 ) {
	cbgjClass::getTemplate();

	$where						=	$include_exclude;

	if ( $plugin->params->get( 'joined_tab_owned', 0 ) ) {
		$where[]				=	array( 'user_id', '=', $user->id, array( 'e.user_id', '=', $user->id, 'e.status', '!IN', array( -1, 0, 4 ) ) );
	} else {
		$where[]				=	array( 'e.user_id', '=', $user->id, 'e.status', '!IN', array( -1, 0, 4 ) );
	}

	$rows						=	cbgjData::getGroups( array( array( 'grp_access', 'mod_lvl2' ), $user ), $where, null, ( $display ? array( 0, $display ) : null ) );

	$return						.=		'<div class="gjJoinedGroups' . $class_layout . $class_sfx . '">';

	if ( $rows ) foreach ( $rows as $row ) {
		$return					.=			'<div class="gjJoinedGroup">'
								.				'<div class="gjJoinedGroupName">' . $row->getName( $name_length, true ) . '</div>'
								.				'<div class="gjJoinedGroupLogo">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjJoinedGroupInfo">' . cbgjClass::getOverride( 'user', $row->userCount() ) . '</div>'
								.			'</div>';
	} else {
		$return					.=			CBTxt::P( 'There are no [groups] available.', array( '[groups]' => cbgjClass::getOverride( 'group', true ) ) );
	}

	$return						.=		'</div>';
} elseif ( $mode == 10 ) {
	cbgjClass::getTemplate();

	$return						.=		'<div class="gjApproval' . $class_layout . $class_sfx . '">';

	$needs_approval				=	false;

	if ( $plugin->params->get( 'category_approve', 0 ) ) {
		$categories				=	count( cbgjData::getCategories( array( array( 'cat_can_publish' ), $user ), array( 'published', '=', 0 ) ) );

		if ( $categories ) {
			$return				.=			'<div><a href="' . cbgjClass::getPluginURL( array( 'categories', 'approval' ) ) . '">' . CBTxt::P( '[categories] pending approval.', array( '[categories]' => cbgjClass::getOverride( 'category', $categories ) ) ) . '</a></div>';

			$needs_approval		=	true;
		}
	}

	if ( $plugin->params->get( 'group_approve', 0 ) ) {
		$groups					=	count( cbgjData::getGroups( array( array( 'grp_can_publish', 'cat_approved' ), $user, null, true ), array( 'published', '=', 0 ) ) );

		if ( $groups ) {
			$return				.=			'<div><a href="' . cbgjClass::getPluginURL( array( 'groups', 'approval' ) ) . '">' . CBTxt::P( '[groups] pending approval.', array( '[groups]' => cbgjClass::getOverride( 'group', $groups ) ) ) . '</a></div>';

			$needs_approval		=	true;
		}
	}

	$users						=	count( cbgjData::getUsers( array( array( 'mod_lvl4', 'grp_approved' ), $user, null, true ), array( 'status', '=', 0, 'b.type', '=', 2 ) ) );

	if ( $users ) {
		$return					.=			'<div><a href="' . cbgjClass::getPluginURL( array( 'users', 'approval' ) ) . '">' . CBTxt::P( '[users] pending approval.', array( '[users]' => cbgjClass::getOverride( 'user', $users ) ) ) . '</a></div>';

		$needs_approval			=	true;
	}

	if ( class_exists( 'cbgjEventsData' ) ) {
		$events					=	count( cbgjEventsData::getEvents( array( array( 'mod_lvl4', 'grp_approved' ), $user, null, true ), array( 'published', '=', 0, 'c.params', 'CONTAINS', 'events_approve=1' ) ) );

		if ( $events ) {
			$return				.=			'<div><a href="' . cbgjClass::getPluginURL( array( 'plugin', 'events_approval' ) ) . '">' . CBTxt::P( '[events] pending approval.', array( '[events]' => $events . ' ' . ( $events == 1 ? CBTxt::T( 'Event' ) : CBTxt::T( 'Events' ) ) ) ) . '</a></div>';

			$needs_approval		=	true;
		}
	}

	if ( class_exists( 'cbgjFileData' ) ) {
		$files					=	count( cbgjFileData::getFiles( array( array( 'mod_lvl4', 'grp_approved' ), $user, null, true ), array( 'published', '=', 0, 'c.params', 'CONTAINS', 'file_approve=1' ) ) );

		if ( $files ) {
			$return				.=			'<div><a href="' . cbgjClass::getPluginURL( array( 'plugin', 'file_approval' ) ) . '">' . CBTxt::P( '[files] pending approval.', array( '[files]' => $files . ' ' . ( $files == 1 ? CBTxt::T( 'File' ) : CBTxt::T( 'Files' ) ) ) ) . '</a></div>';

			$needs_approval		=	true;
		}
	}

	if ( class_exists( 'cbgjPhotoData' ) ) {
		$photos					=	count( cbgjPhotoData::getPhotos( array( array( 'mod_lvl4', 'grp_approved' ), $user, null, true ), array( 'published', '=', 0, 'c.params', 'CONTAINS', 'photo_approve=1' ) ) );

		if ( $photos ) {
			$return				.=			'<div><a href="' . cbgjClass::getPluginURL( array( 'plugin', 'photo_approval' ) ) . '">' . CBTxt::P( '[photos] pending approval.', array( '[photos]' => $photos . ' ' . ( $photos == 1 ? CBTxt::T( 'Photo' ) : CBTxt::T( 'Photos' ) ) ) ) . '</a></div>';

			$needs_approval		=	true;
		}
	}

	if ( class_exists( 'cbgjVideoData' ) ) {
		$videos					=	count( cbgjVideoData::getVideos( array( array( 'mod_lvl4', 'grp_approved' ), $user, null, true ), array( 'published', '=', 0, 'c.params', 'CONTAINS', 'video_approve=1' ) ) );

		if ( $videos ) {
			$return				.=			'<div><a href="' . cbgjClass::getPluginURL( array( 'plugin', 'video_approval' ) ) . '">' . CBTxt::P( '[videos] pending approval.', array( '[videos]' => $videos . ' ' . ( $videos == 1 ? CBTxt::T( 'Video' ) : CBTxt::T( 'Videos' ) ) ) ) . '</a></div>';

			$needs_approval		=	true;
		}
	}

	if ( class_exists( 'cbgjWallData' ) ) {
		$posts					=	count( cbgjWallData::getPosts( array( array( 'mod_lvl4', 'grp_approved' ), $user, null, true ), array( 'published', '=', 0, 'c.params', 'CONTAINS', 'wall_approve=1' ) ) );

		if ( $posts ) {
			$return				.=			'<div><a href="' . cbgjClass::getPluginURL( array( 'plugin', 'wall_approval' ) ) . '">' . CBTxt::P( '[posts] pending approval.', array( '[posts]' => $posts . ' ' . ( $posts == 1 ? CBTxt::T( 'Post' ) : CBTxt::T( 'Posts' ) ) ) ) . '</a></div>';

			$needs_approval		=	true;
		}
	}

	if ( ! $needs_approval ) {
		$return					.=			'<div>' . CBTxt::T( 'There are no pending approvals.' ) . '</div>';
	}

	$return						.=		'</div>';
} elseif ( $mode == 11 ) {
	if ( class_exists( 'cbgjWallData' ) ) {
		cbgjClass::getTemplate();

		$rows					=	cbgjWallData::getPosts( array( array( 'grp_access', 'wall_show' ), $user, null, true ), $include_exclude, null, $display );

		$return					.=		'<div class="gjIntWallPosts' . $class_layout . $class_sfx . '">';

		if ( $rows ) foreach ( $rows as $row ) {
			$return				.=			'<div class="gjIntWallPost">'
								.				CBTxt::P( '[user] posted [post] to [group] in [category] on [date]', array( '[user]' => $row->getOwnerName( true ), '[post]' => $row->getTitle( 0, true ), '[group]' => $row->getGroup()->getName( 0, true ), '[category]' => $row->getCategory()->getName( 0, true ), '[date]' => cbFormatDate( $row->date ) ) )
								.			'</div>';
		} else {
			$return				.=			CBTxt::T( 'There are no wall posts.' );
		}

		$return					.=		'</div>';
	} else {
		$return					.=		'<div>' . CBTxt::T( 'Wall integration not installed!' ) . '</div>';
	}
} elseif ( $mode == 12 ) {
	if ( class_exists( 'cbgjEventsData' ) ) {
		cbgjClass::getTemplate();

		$rows					=	cbgjEventsData::getEvents( array( array( 'grp_access', 'events_show' ), $user, null, true ), $include_exclude, null, $display );

		$return					.=		'<div class="gjIntEvents' . $class_layout . $class_sfx . '">';

		if ( $rows ) foreach ( $rows as $row ) {
			$return				.=			'<div class="gjIntEvent">'
								.				CBTxt::P( '[user] scheduled [event] in [group] of [category] for [date]', array( '[user]' => $row->getOwnerName( true ), '[event]' => $row->getTitle( 0, true ), '[group]' => $row->getGroup()->getName( 0, true ), '[category]' => $row->getCategory()->getName( 0, true ), '[date]' => $row->getDate() ) )
								.			'</div>';
		} else {
			$return				.=			CBTxt::T( 'There are no events scheduled.' );
		}

		$return					.=		'</div>';
	} else {
		$return					.=		'<div>' . CBTxt::T( 'Event integration not installed!' ) . '</div>';
	}
} elseif ( $mode == 13 ) {
	if ( class_exists( 'cbgjPhotoData' ) ) {
		$display_lightbox		=	$plugin->params->get( 'photo_lightbox', 1 );

		if ( $display_lightbox ) {
			$_CB_framework->outputCbJQuery( "$( '.cbgjPhotoModLightbox' ).slimbox( { counterText: '" . addslashes( CBTxt::T( 'Image {x} of {y}' ) ) . "' } );", 'slimbox2' );
		}

		cbgjClass::getTemplate();

		$rows					=	cbgjPhotoData::getPhotos( array( array( 'grp_access', 'photo_show' ), $user, null, true ), $include_exclude, null, $display );

		$return					.=		'<div class="gjIntPhotos' . $class_layout . $class_sfx . '">';

		if ( $rows ) foreach ( $rows as $row ) {
			$return				.=			'<div class="gjIntPhoto">'
								.				'<div class="gjIntPhotoName">' . $row->getTitle( $name_length, 'tab' ) . '</div>'
								.				'<div class="gjIntPhotoImage">' . $row->getImage( true, ( $display_lightbox ? 2 : true ), true, 'cbgjPhotoMod' ) . '</div>'
								.				'<div class="gjIntPhotoInfo">' . cbFormatDate( $row->date, 1, false ) . '</div>'
								.			'</div>';
		} else {
			$return				.=			CBTxt::T( 'There are no photos uploaded.' );
		}

		$return					.=		'</div>';
	} else {
		$return					.=		'<div>' . CBTxt::T( 'Photo integration not installed!' ) . '</div>';
	}
} elseif ( $mode == 14 ) {
	if ( class_exists( 'cbgjVideoData' ) ) {
		cbgjClass::getTemplate();

		$rows					=	cbgjVideoData::getVideos( array( array( 'grp_access', 'video_show' ), $user, null, true ), $include_exclude, null, $display );

		$return					.=		'<div class="gjIntVideos' . $class_layout . $class_sfx . '">';

		if ( $rows ) foreach ( $rows as $row ) {
			$return				.=			'<div class="gjIntVideo">'
								.				'<div class="gjIntVideoName">' . $row->getTitle( $name_length, 'tab' ) . '</div>'
								.				'<div class="gjIntVideoEmbed">' . $row->getEmbed( true, true ) . '</div>'
								.				'<div class="gjIntVideoInfo">' . cbFormatDate( $row->date, 1, false ) . '</div>'
								.			'</div>';
		} else {
			$return				.=			CBTxt::T( 'There are no videos published.' );
		}

		$return					.=		'</div>';
	} else {
		$return					.=		'<div>' . CBTxt::T( 'Video integration not installed!' ) . '</div>';
	}
} elseif ( $mode == 15 ) {
	if ( class_exists( 'cbgjFileData' ) ) {
		cbgjClass::getTemplate();

		$rows					=	cbgjFileData::getFiles( array( array( 'grp_access', 'file_show' ), $user, null, true ), $include_exclude, null, $display );

		$return					.=		'<div class="gjIntFiles' . $class_layout . $class_sfx . '">';

		if ( $rows ) foreach ( $rows as $row ) {
			$return				.=			'<div class="gjIntFile">'
								.				'<div class="gjIntFile">' . $row->getTitle( $name_length, 'tab' ) . '</div>'
								.				'<div class="gjIntFileLogo">' . $row->getIcon( true, true ) . '</div>'
								.				'<div class="gjIntFileInfo">' . cbFormatDate( $row->date, 1, false ) . '</div>'
								.			'</div>';
		} else {
			$return				.=			CBTxt::T( 'There are no files uploaded.' );
		}

		$return					.=		'</div>';
	} else {
		$return					.=		'<div>' . CBTxt::T( 'File integration not installed!' ) . '</div>';
	}
} elseif ( $mode == 16 ) {
	cbgjClass::getTemplate();

	$where						=	$include_exclude;

	$where[]					=	array( 'f.user', '=', (int) $user->id, array( 'f.email', '=', $user->email ) );
	$where[]					=	array( 'f.accepted', 'IN', array( '0000-00-00', '0000-00-00 00:00:00', '', null ) );

	$rows						=	cbgjData::getGroups( array( array( 'grp_access', 'mod_lvl2' ), $user ), $where, null, $display );

	$return						.=		'<div class="gjInvitedTo' . $class_layout . $class_sfx . '">';

	if ( $rows ) foreach ( $rows as $row ) {
		$return					.=			'<div class="gjInvitedTo">'
								.				'<div class="gjInvitedToName">' . $row->getName( $name_length, true ) . '</div>'
								.				'<div class="gjInvitedToLogo">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjInvitedToInfo"><a href="' . cbgjClass::getPluginURL( array( 'groups', 'join', (int) $row->get( 'category' ), (int) $row->get( 'id' ) ) ) . '">' . CBTxt::T( 'Join' ) . '</a></div>'
								.			'</div>';
	} else {
		$return					.=			CBTxt::P( 'You are not invited to any [groups].', array( '[groups]' => cbgjClass::getOverride( 'group', true ) ) );
	}

	$return						.=		'</div>';
}

$return							.=	'</div>';

echo $return;
?>
