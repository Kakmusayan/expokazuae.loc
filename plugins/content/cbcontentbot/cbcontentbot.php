<?php
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

jimport( 'joomla.plugin.plugin' );

class plgContentcbcontentbot extends JPlugin {

	public function onContentBeforeDisplay( $context, &$article ) {
		global $_CB_framework, $_PLUGINS, $mainframe;

		static $CB_loaded			=	0;

		if ( ! $CB_loaded++ ) {
			if ( defined( 'JPATH_ADMINISTRATOR' ) ) {
				if ( ! file_exists( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' ) ) {
					return;
				}

				include_once( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' );
			} else {
				if ( ! file_exists( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php' ) ) {
					return;
				}

				include_once( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php' );
			}

			cbimport( 'cb.html' );

			if ( $this->params->get( 'load_tpl', 0 ) ) {
				outputCbTemplate( 1 );
			}

			if ( $this->params->get( 'load_js', 0 ) ) {
				outputCbJs( 1 );
			}

			if ( $this->params->get( 'load_lang', 1 ) ) {
				cbimport( 'language.front' );
			}

			if ( $this->params->get( 'load_plgs', 0 ) ) {
				$_PLUGINS->loadPluginGroup( 'user' );
			}
		}

		static $HEADER_loaded		=	0;

		if ( ! $HEADER_loaded++ ) {
			$css					=	$this->params->get( 'css' );

			if ( $css ) {
				$_CB_framework->document->addHeadStyleInline( $css );
			}

			$js						=	$this->params->get( 'js' );

			if ( $js ) {
				$_CB_framework->document->addHeadScriptDeclaration( $js );
			}

			$jquery					=	$this->params->get( 'jquery' );
			$jquery_plgs			=	$this->params->get( 'jquery_plgs' );

			if ( $jquery ) {
				if ( $jquery_plgs ) {
					$plgs			=	explode( ',', $jquery_plgs );
				} else {
					$plgs			=	null;
				}

				$_CB_framework->outputCbJQuery( $jquery, $plgs );
			}
		}

		if ( $this->params->get( 'user', 0 ) ) {
			$user_id				=	( isset( $article->created_by ) ? $article->created_by : null );
		} else {
			$user_id				=	$_CB_framework->myId();
		}

		$cbUser						=&	CBuser::getInstance( (int) $user_id );

		if ( ! $cbUser ) {
			$cbUser					=&	CBuser::getInstance( null );
		}

		$user						=&	$cbUser->getUserData();

		$extra						=	array(	'current_date' => $this->formatDate( 'Y-m-d' ),
												'current_date_cb' => cbFormatDate( $_CB_framework->now(), 1, false ),
												'current_time_24' => $this->formatDate( 'H:i:s' ),
												'current_time_12' => $this->formatDate( 'h:i:s' ),
												'current_datetime_24' => $this->formatDate( 'Y-m-d H:i:s' ),
												'current_datetime_12' => $this->formatDate( 'Y-m-d h:i:s' ),
												'current_datetime_cb' => cbFormatDate( $_CB_framework->now(), 1, true ),
												'current_day' => $this->formatDate( 'd' ),
												'current_week' => $this->formatDate( 'W' ),
												'current_month' => $this->formatDate( 'm' ),
												'current_year' => $this->formatDate( 'Y' ),
												'current_day_text' => $this->formatDate( 'l' ),
												'current_month_text' => $this->formatDate( 'F' ),
												'current_timezone' => $this->formatDate( 'e' ),
												'current_timeofday' => $this->formatDate( 'A' ),
												'current_dayofyear' => $this->formatDate( 'z' ),
												'link_login' => $_CB_framework->viewUrl( 'login', false ),
												'link_logout' => $_CB_framework->viewUrl( 'logout', false ),
												'link_register' => $_CB_framework->viewUrl( 'registers', false ),
												'link_forgot' => $_CB_framework->viewUrl( 'lostpassword', false ),
												'link_connections' => $_CB_framework->viewUrl( 'manageconnections', false ),
												'link_profile_view' => $_CB_framework->userProfileUrl( $user->id, false ),
												'link_profile_edit' => $_CB_framework->userProfileEditUrl( $user->id, false ),
											);

		$this->articleToArray( $article, $extra );

		$this->_cbUser				=	$cbUser;
		$this->_user				=	$user;
		$this->_extra				=	$extra;

		if ( isset( $article->title ) ) {
			$article->title			=	preg_replace_callback( '/\{cb:(.*?)\}/s', array( $this, 'replacer' ), $article->title );
		}

		if ( isset( $article->introtext ) ) {
			$article->introtext		=	preg_replace_callback( '/\{cb:(.*?)\}/s', array( $this, 'replacer' ), $article->introtext );
		}

		if ( isset( $article->fulltext ) ) {
			$article->fulltext		=	preg_replace_callback( '/\{cb:(.*?)\}/s', array( $this, 'replacer' ), $article->fulltext );
		}

		if ( isset( $article->text ) ) {
			$article->text			=	preg_replace_callback( '/\{cb:(.*?)\}/s', array( $this, 'replacer' ), $article->text );
		}
	}

	private function replacer( $matches ) {
		return $this->_cbUser->replaceUserVars( $matches[1], true, true, $this->_extra );
	}

	private function formatDate( $format = 'Y-m-d H:i:s' ) {
		global $_CB_framework;

		return date( $format, strtotime( _old_cbFormatDate( date( 'Y-m-d H:i:s', $_CB_framework->now() ), '%Y-%m-%d %H:%M:%S' ) ) );
	}

	private function articleToArray( $article, &$extra ) {
		if ( $article ) foreach ( $article as $k => $v ) {
			if ( ( ! is_array( $v ) ) && ( ! is_object( $v ) ) ) {
				$extra["article_$k"]	=	$v;
			}
		}

		if ( ! in_array( 'article_text', $extra ) ) {
			$text						=	null;

			if ( isset( $article->introtext ) ) {
				$text					.=	$article->introtext;
			}

			if ( isset( $article->fulltext ) ) {
				$text					.=	$article->fulltext;
			}

			$extra['article_text']		=	$text;
		}

		return $extra;
	}
}
?>