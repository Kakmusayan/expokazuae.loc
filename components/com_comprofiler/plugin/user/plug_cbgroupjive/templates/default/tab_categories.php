<?php
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

class HTML_groupjiveTabCategories {

	/**
	 * render frontend tab categories
	 *
	 * @param object $rows
	 * @param object $pageNav
	 * @param moscomprofilerUser $displayed
	 * @param moscomprofilerUser $user
	 * @param object $plugin
	 * @param boolean $tabbed
	 * @return mixed
	 */
	static function showCategories( $rows, $pageNav, $displayed, $user, $plugin, $tabbed ) {
		global $_CB_framework;

		$categoryTabSearch		=	$plugin->params->get( 'category_tab_search', 1 );
		$categoryTabPaging		=	$plugin->params->get( 'category_tab_paging', 1 );
		$categoryTabLimitbox	=	$plugin->params->get( 'category_tab_limitbox', 1 );

		if ( ! $tabbed ) {
			$formUrl			=	cbgjClass::getPluginURL( array( 'panel', 'categories' ) );
		} else {
			$formUrl			=	$_CB_framework->userProfileUrl( $displayed->id, true, $plugin->tab->tabid );
		}

		$return					=	'<div class="gjTabCategories">'
								.		'<form action="' . $formUrl . '" method="post" name="gjTabForm_categories" id="gjTabForm_categories" class="gjForm">'
								.			( $categoryTabSearch && ( $pageNav->searching || $pageNav->total ) ? '<div class="gjTop gjTopRight">' . $pageNav->search . '</div>' : null );


		if ( $rows ) foreach ( $rows as $row ) {
			$authorized			=	cbgjClass::getAuthorization( $row, null, $user );

			if ( $row->get( 'published' ) == 1 ) {
				$state			=	'<div><a href="javascript: void(0);" onclick="' . cbgjClass::getPluginURL( array( 'categories', 'unpublish', (int) $row->get( 'id' ) ), CBTxt::P( 'Are you sure you want to unpublish this [category]?', array( '[category]' => cbgjClass::getOverride( 'category' ) ) ), true, false, null, true ) . '"><i class="icon-ban-circle"></i> ' . CBTxt::Th( 'Unpublish' ) . '</a></div>';
			} else {
				$state			=	'<div><a href="' . cbgjClass::getPluginURL( array( 'categories', 'publish', (int) $row->get( 'id' ) ), null, true, false, null, true ) . '"><i class="icon-ok"></i> ' . CBTxt::Th( 'Publish' ) . '</a></div>';
			}

			$beforeMenu			=	cbgjClass::getIntegrations( 'gj_onBeforeProfileOverviewCategoryMenu', array( $row, $displayed, $user, $plugin ) );
			$afterMenu			=	cbgjClass::getIntegrations( 'gj_onAfterProfileOverviewCategoryMenu', array( $row, $displayed, $user, $plugin ) );

			$return				.=			'<div class="gjContent row-fluid">'
								.				'<div class="gjContentLogo span2">' . $row->getLogo( true, true, true ) . '</div>'
								.				'<div class="gjContentBody mini-layout span10">'
								.					'<div class="gjContentBodyHeader row-fluid">'
								.						'<div class="gjContentBodyTitle span9"><h5>' . $row->getName( 0, true ) . '<small> ' . cbFormatDate( $row->get( 'date' ), 1, false ) . ( $row->get( 'parent' ) ? ' - ' . $row->getParent()->getName( 0, true ) : null ) . '</small></h5></div>'
								.						'<div class="gjContentBodyMenu span3">';

			if ( $beforeMenu || cbgjClass::hasAccess( array( 'mod_lvl1', 'cat_can_publish' ), $authorized ) || $afterMenu ) {
				$return			.=							'<div class="gjDropdown">'
								.								'<i class="icon-chevron-down"></i>'
								.								'<div class="gjDropdownItems">'
								.									$beforeMenu
								.									( cbgjClass::hasAccess( 'mod_lvl1', $authorized ) ? '<div><a href="' . cbgjClass::getPluginURL( array( 'categories', 'edit', (int) $row->get( 'id' ) ), null, true, false, null, true ) . '"><i class="icon-pencil"></i> ' . CBTxt::Th( 'Edit' ) . '</a></div>' : null )
								.									( cbgjClass::hasAccess( 'cat_can_publish', $authorized ) ? $state : null )
								.									( cbgjClass::hasAccess( 'mod_lvl1', $authorized ) ? '<div><a href="javascript: void(0);" onclick="' . cbgjClass::getPluginURL( array( 'categories', 'delete', (int) $row->get( 'id' ) ), CBTxt::P( 'Are you sure you want to delete this [category] and all its associated [groups]?', array( '[category]' => cbgjClass::getOverride( 'category' ), '[groups]' => cbgjClass::getOverride( 'group', true ) ) ), true, false, null, true ) . '"><i class="icon-remove"></i> ' . CBTxt::Th( 'Delete' ) . '</a></div>' : null )
								.									$afterMenu
								.								'</div>'
								.							'</div>';
			}

			$return				.=						'</div>'
								.					'</div>'
								.					'<div class="gjContentBodyInfo">' . ( $row->getDescription() ? '<div class="well well-small">' . $row->getDescription() . '</div>' : null ) . '</div>'
								.					'<div class="gjContentDivider"></div>'
								.					'<div class="gjContentBodyFooter">'
								.						cbgjClass::getIntegrations( 'gj_onBeforeProfileOverviewCategoryInfo', array( $row, $displayed, $user, $plugin ), null, 'span' )
								.						( ( ( ( ! $row->get( 'nested' ) ) && cbgjClass::hasAccess( 'mod_lvl1', $authorized ) ) || $row->get( 'nested' ) ) && $row->nestedCount() ? cbgjClass::getOverride( 'category', $row->nestedCount() ) . ' | ' : null )
								.						( $row->groupCount() ? cbgjClass::getOverride( 'group', $row->groupCount() ) . ' | ' : null )
								.						implode( ', ', $row->getTypes() )
								.						cbgjClass::getIntegrations( 'gj_onAfterProfileOverviewCategoryInfo', array( $row, $displayed, $user, $plugin ), null, 'span' )
								.					'</div>'
								.				'</div>'
								.			'</div>';
		} else {
			$return				.=			'<div class="gjContent">';

			if ( $categoryTabSearch && $pageNav->searching ) {
				$return			.=				CBTxt::Ph( 'No [category] search results found.', array( '[category]' => cbgjClass::getOverride( 'category' ) ) );
			} else {
				if ( $displayed->id == $user->id ) {
					$return		.=				CBTxt::Ph( 'You have no [categories].', array( '[categories]' => cbgjClass::getOverride( 'category', true ) ) );
				} else {
					$return		.=				CBTxt::Ph( 'This user has no [categories].', array( '[categories]' => cbgjClass::getOverride( 'category', true ) ) );
				}
			}

			$return				.=			'</div>';
		}

		if ( $categoryTabPaging ) {
			$return				.=			'<div class="gjPaging pagination pagination-centered">'
								.				( $pageNav->total > $pageNav->limit ? $pageNav->pagelinks : null )
								.				( ! $categoryTabLimitbox ? $pageNav->getLimitBox( false ) : ( $pageNav->total ? '<div class="gjPagingLimitbox">' . $pageNav->limitbox . '</div>' : null ) )
								.			'</div>';
		}

		$return					.=			cbGetSpoofInputTag( 'plugin' )
								.		'</form>'
								.	'</div>';

		return $return;
	}
}
?>