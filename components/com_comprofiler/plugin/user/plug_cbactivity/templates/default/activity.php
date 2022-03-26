<?php
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

class HTML_cbactivityActivity {

	static public function getMessageDisplay( $row, &$cache ) {
		global $_CB_database, $_CB_framework;

		$return												=	null;

		switch ( $row->get( 'type' ) ) {
			case 'groupjive':
				if ( ! $cache['gjLoaded']++ ) {
					require_once( $_CB_framework->getCfg( 'absolute_path' ) . '/components/com_comprofiler/plugin/user/plug_cbgroupjive/cbgroupjive.class.php' );
				}

				$itemId										=	(int) $row->get( 'item' );

				switch ( $row->get( 'subtype' ) ) {
					case 'category':
						if ( ! isset( $cache['gjCategories'][$itemId] ) ) {
							$cache['gjCategories'][$itemId]	=	cbgjData::getGroups( null, array( 'id', '=', $itemId ), null, null, false );
						}

						$item								=	$cache['gjCategories'][$itemId];
						$return								=	HTML_cbactivityActivity::getItemDisplay( $item->getLogo( true, true, true ), $item->getName( 0, true ), $item->getDescription() );
						break;
					case 'group':
						if ( ! isset( $cache['gjGroups'][$itemId] ) ) {
							$cache['gjGroups'][$itemId]		=	cbgjData::getGroups( null, array( 'id', '=', $itemId ), null, null, false );
						}

						$item								=	$cache['gjGroups'][$itemId];
						$return								=	HTML_cbactivityActivity::getItemDisplay( $item->getLogo( true, true, true ), $item->getName( 0, true ), $item->getDescription() );
						break;
					case 'event':
						if ( ! isset( $cache['gjEvents'][$itemId] ) ) {
							$cache['gjEvents'][$itemId]		=	cbgjEventsData::getEvents( null, array( 'id', '=', $itemId ), null, null, false );
						}

						$item								=	$cache['gjEvents'][$itemId];
						$return								=	HTML_cbactivityActivity::getItemDisplay( null, $item->getTitle( 0, true ), $item->getEvent(), $item->getGroup()->getName( 0, true ) );
						break;
					case 'file':
						if ( ! isset( $cache['gjFiles'][$itemId] ) ) {
							$cache['gjFiles'][$itemId]		=	cbgjFileData::getFiles( null, array( 'id', '=', $itemId ), null, null, false );
						}

						$item								=	$cache['gjFiles'][$itemId];
						$return								=	HTML_cbactivityActivity::getItemDisplay( $item->getIcon( true, 'tab' ), $item->getTitle( 0, 'tab' ), $item->getDescription(), $item->getGroup()->getName( 0, true ) );
						break;
					case 'photo':
						if ( ! isset( $cache['gjPhotos'][$itemId] ) ) {
							$cache['gjPhotos'][$itemId]		=	cbgjPhotoData::getPhotos( null, array( 'id', '=', $itemId ), null, null, false );
						}

						$item								=	$cache['gjPhotos'][$itemId];
						$return								=	HTML_cbactivityActivity::getItemDisplay( $item->getImage( true, 'tab', true ), $item->getTitle( 0, 'tab' ), $item->getDescription(), $item->getGroup()->getName( 0, true ) );
						break;
					case 'video':
						if ( ! isset( $cache['gjVideos'][$itemId] ) ) {
							$cache['gjVideos'][$itemId]		=	cbgjVideoData::getVideos( null, array( 'id', '=', $itemId ), null, null, false );
						}

						$item								=	$cache['gjVideos'][$itemId];
						$return								=	HTML_cbactivityActivity::getItemDisplay( null, $item->getTitle( 0, 'tab' ), ( $item->getCaption() ? '<div class="activityItemContentBodyInfoRow">' . $item->getEmbed( true, false ) . '</div>' : $item->getEmbed( true, false ) ) . $item->getCaption(), $item->getGroup()->getName( 0, true ) );
						break;
					case 'wall':
						if ( ! isset( $cache['gjPosts'][$itemId] ) ) {
							$cache['gjPosts'][$itemId]		=	cbgjWallData::getPosts( null, array( 'id', '=', $itemId ), null, null, false );
						}

						$item								=	$cache['gjPosts'][$itemId];
						$return								=	HTML_cbactivityActivity::getItemDisplay( null, null, $item->getPost(), $item->getGroup()->getName( 0, true  ) );
						break;
				}
				break;
			case 'kunena':
				KunenaForum::setup();

				switch ( $row->get( 'subtype' ) ) {
					case 'message':
						$itemId								=	(int) $row->get( 'item' );

						if ( ! isset( $cache['messages'][$itemId] ) ) {
							$cache['messages'][$itemId]		=	KunenaForumMessage::getInstance( $itemId );
						}

						$item								=	$cache['messages'][$itemId];
						$title								=	'<a href="' . $item->getUrl() . '">' . cbactivityClass::cleanBBCode( $item->subject ) . '</a>';
						$return								=	HTML_cbactivityActivity::getItemDisplay( null, $title, cbactivityClass::cleanBBCode( $item->message ) );
						break;
				}
				break;
			case 'profilebook':
					$itemId									=	(int) $row->get( 'item' );

					if ( ! isset( $cache['pb'][$itemId] ) ) {
						$query								=	'SELECT *'
															.	"\n FROM " . $_CB_database->NameQuote( '#__comprofiler_plug_profilebook' )
															.	"\n WHERE " . $_CB_database->NameQuote( 'id' ) . " = " . $itemId;
						$_CB_database->setQuery( $query );
						$cache['pb'][$itemId]				=	null;
						$_CB_database->loadObject( $cache['pb'][$itemId] );
					}

					$item									=	$cache['pb'][$itemId];
					$tab									=	( $item->mode == 'g' ? 'getprofilebooktab' : ( $item->mode == 'w' ? 'getprofilebookwalltab' : ( $item->mode == 'b' ? 'getprofilebookblogtab' : null ) ) );
					$title									=	( $item->postertitle ? '<a href="' . $_CB_framework->userProfileUrl( $item->userid, true, $tab ) . '">' . htmlspecialchars( $item->postertitle ) . '</a>' : null );
					$return									=	HTML_cbactivityActivity::getItemDisplay( null, $title, cbactivityClass::cleanBBCode( $item->postercomment ) );
				break;
			case 'profilegallery':
					$itemId									=	(int) $row->get( 'item' );

					if ( ! isset( $cache['pg'][$itemId] ) ) {
						$query								=	'SELECT *'
															.	"\n FROM " . $_CB_database->NameQuote( '#__comprofiler_plug_profilegallery' )
															.	"\n WHERE " . $_CB_database->NameQuote( 'id' ) . " = " . $itemId;
						$_CB_database->setQuery( $query );
						$cache['pg'][$itemId]				=	null;
						$_CB_database->loadObject( $cache['pg'][$itemId] );
					}

					$item									=	$cache['pg'][$itemId];
					$tabUrl									=	$_CB_framework->userProfileUrl( $item->userid, true, 'getProfileGalleryTab' );

					if ( in_array( $item->pgitemtype, array( 'jpg', 'jpeg', 'gif', 'png', 'bmp' ) ) ) {
						$logo								=	'<a href="' . $tabUrl . '"><img src="' . $_CB_framework->getCfg( 'live_site' ) . '/images/comprofiler/plug_profilegallery/' . (int) $item->userid . '/tn' . $item->pgitemfilename . '" /></a>';
					} else {
						if ( file_exists( $_CB_framework->GetCfg( 'absolute_path' ) . '/components/com_comprofiler/plugin/user/plug_cbprofilegallery/images/pgtn_' . $item->pgitemtype . 'item.gif' ) ) {
							$img							=	'pgtn_' . $item->pgitemtype . 'item.gif';
						} else {
							$img							=	'pgtn_nonimageitem.gif';
						}

						$logo								=	'<a href="' . $tabUrl . '"><img src="' . $_CB_framework->getCfg( 'live_site' ) . '/components/com_comprofiler/plugin/user/plug_cbprofilegallery/images/' . $img . '" /></a>';
					}

					$title									=	'<a href="' . $tabUrl . '">' . htmlspecialchars( $item->pgitemtitle ) . '</a>';
					$return									=	HTML_cbactivityActivity::getItemDisplay( $logo, $title, cbactivityClass::cleanBBCode( $item->pgitemdescription ) );
				break;
			case 'cbblogs':
				if ( ! $cache['blogsLoaded']++ ) {
					require_once( $_CB_framework->getCfg( 'absolute_path' ) . '/components/com_comprofiler/plugin/user/plug_cbblogs/cbblogs.class.php' );
				}

				$itemId										=	(int) $row->get( 'item' );

				if ( ! isset( $cache['blogs'][$itemId] ) ) {
					$cache['blogs'][$itemId]				=	cbblogsData::getBlogs( null, array( 'id', '=', $itemId ), null, null, false );
				}

				$item										=	$cache['blogs'][$itemId];
				$return										=	HTML_cbactivityActivity::getItemDisplay( null, $item->getTitle( 0, $item->getBlog()->published ), cbactivityClass::cleanBBCode( $item->getBlog()->blog_text ) );
				break;
			default:
				$return										=	HTML_cbactivityActivity::getItemDisplay( null, null, $row->getMessage() );
				break;
		}

		return $return;
	}

	static public function getItemDisplay( $logo = null, $title = null, $description = null, $footer = null ) {
		$return				=	null;

		if ( $logo || $title || $description || $footer ) {
			$return			.=	'<div class="activityItemContent">'
							.		'<div class="row-fluid">';

			if ( $logo ) {
				$return		.=			'<div class="activityItemContentLogo span2">' . $logo . '</div>'
							.			'<div class="activityItemContentBody span10">';
			} else {
				$return		.=			'<div class="activityItemContentBody span12">';
			}

			if ( $title ) {
				$return		.=				'<div class="activityItemContentTitle"><h5>' . $title . '</h5></div>';
			}

			if ( $description ) {
				$return		.=				'<div class="activityItemContentBodyInfo">' . $description . '</div>';
			}

			$return			.=			'</div>'
							.		'</div>';

			if ( $footer ) {
				$return		.=		'<div class="activityItemContentDivider"></div>'
							.		'<div class="activityItemContentFooter">'
							.			$footer
							.		'</div>';
			}

			$return			.=	'</div>';
		}

		return $return;
	}
}
?>