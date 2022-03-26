<?php
/**
* Facebook CB plugin for Community Builder
* @version $Id: cb.facebookconnect.php 1102 2010-05-06 12:56:04Z kyle $
* @package Community Builder
* @subpackage Facebook CB plugin
* @author Kyle and Beat
* @copyright (C) http://www.joomlapolis.com and various
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/

if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

global $_PLUGINS;
$_PLUGINS->registerFunction( 'onAfterLoginForm', 'getDisplay', 'cbfacebookconnectPlugin' );
$_PLUGINS->registerFunction( 'onAfterLogoutForm', 'getDisplay', 'cbfacebookconnectPlugin' );
$_PLUGINS->registerFunction( 'onPrepareMenus', 'getMenu','cbfacebookconnectPlugin' );

$_PLUGINS->registerUserFieldParams();
$_PLUGINS->registerUserFieldTypes( array( 'facebook_userid' => 'cbfacebookconnectField' ) );

class cbfacebookconnectField extends cbFieldHandler {

	public function getField( &$field, &$user, $output, $reason, $list_compare_types ) {
		global $_CB_framework;

		$value						=	$user->get( $field->name );
		$return						=	null;

		switch( $output ) {
			case 'htmledit':
				if ( $reason == 'search' ) {
					$fieldFormat	=	$this->_fieldEditToHtml( $field, $user, $reason, 'input', 'text', $value, null );
					$return			=	$this->_fieldSearchModeHtml( $field, $user, $fieldFormat, 'text', $list_compare_types );
				} else {
					if ( $_CB_framework->getUi() == 2 ) {
						$return		=	$this->_fieldEditToHtml( $field, $user, $reason, 'input', 'text', $value, null );
					}
				}
				break;
			case 'html':
			case 'rss':
				if ( $value ) {
					$value			=	'<a href="http://www.facebook.com/profile.php?id=' . htmlspecialchars( urlencode( $value ) ) . '" target="_blank">' . htmlspecialchars( CBTxt::T( 'View Facebook Profile' ) ) . '</a>';
				}

				$return				=	$this->_formatFieldOutput( $field->name, $value, $output, false );
				break;
			default:
				$return				=	$this->_formatFieldOutput( $field->name, $value, $output );
				break;
		}

		return $return;
	}
}

class cbfacebookconnectSynchronize {

	public function syncUser( $user_id = null ) {
		global $_CB_framework;

		if ( ! $this->getConnectID() ) {
			cbfacebookconnectClass::setRedirect( null, CBTxt::T( 'ID not found!' ), 'error' );

			return false;
		}

		$myId									=	$_CB_framework->myId();

		if ( ! $user_id ) {
			$user_id							=	$this->getUserID();
		}

		if ( $myId ) {
			if ( $user_id ) {
				if ( $user_id != $myId ) {
					cbfacebookconnectClass::setRedirect( null, CBTxt::T( 'ID already in use or account mismatch!' ), 'error' );

					return false;
				}
			} else {
				$user_id						=	$myId;
			}
		}

		$user									=&	CBuser::getUserDataInstance( (int) $user_id );

		if ( $user->id ) {
			if ( $this->sync->link ) {
				if ( ! $this->updateUser( $user ) ) {
					cbfacebookconnectClass::setRedirect( null, $user->getError(), 'error' );

					return false;
				} elseif ( $myId ) {
					cbfacebookconnectClass::setRedirect( null, CBTxt::T( 'Account linked successfully.' ), 'message' );
				}
			} elseif ( $myId ) {
				cbfacebookconnectClass::setRedirect( null, CBTxt::T( 'Account linking not permitted!' ), 'error' );

				return false;
			}

			if ( ! $myId  ) {
				if ( ! $this->registrationComplete( $user ) ) {
					cbfacebookconnectClass::getPluginURL( array( $this->type, 'registration' ), CBTxt::T( 'Your registration is not yet complete' ), false, true, 'message', 'current' );

					return false;
				} else {
					$redirect					=	null;

					if ( ( ! $user->lastvisitDate ) || ( $user->lastvisitDate == '0000-00-00 00:00:00' ) ) {
						$redirect				=	$this->sync->firstlogin;
					}

					$login						=	$this->loginUser( $user );

					if ( $login ) {
						if ( ! $redirect ) {
							$redirect			=	$this->sync->login;
						}

						cbfacebookconnectClass::setRedirect( $redirect, ( $login !== true ? $login : null ) );
					} else {
						cbfacebookconnectClass::setRedirect( null, $user->getError(), 'error' );

						return false;
					}
				}
			}
		} else {
			if ( $this->sync->register ) {
				$registration					=	$this->registerUser( $user );

				if ( ! $this->registrationComplete( $user ) ) {
					cbfacebookconnectClass::getPluginURL( array( $this->type, 'registration' ), CBTxt::T( 'Your registration is not yet complete' ), false, true, 'message', 'current' );

					return false;
				} else {
					if ( $registration ) {
						if ( $user->block == 0 ) {
							$login				=	$this->loginUser( $user );

							if ( $login ) {
								$redirect		=	$this->sync->firstlogin;

								if ( ! $redirect ) {
									$redirect	=	$this->sync->login;
								}

								cbfacebookconnectClass::setRedirect( $redirect, ( $login !== true ? $login : null ) );
							} else {
								cbfacebookconnectClass::setRedirect( null, $user->getError(), 'error' );

								return false;
							}
						} else {
							cbfacebookconnectClass::setRedirect( null, $registration, 'message' );

							return false;
						}
					} else {
						cbfacebookconnectClass::setRedirect( null, $user->getError(), 'error' );

						return false;
					}
				}
			} else {
				cbfacebookconnectClass::setRedirect( null, CBTxt::T( 'Account registration not permitted!' ), 'error' );

				return false;
			}
		}

		return true;
	}

	private function registerUser( &$user ) {
		global $_CB_framework, $_CB_database, $_PLUGINS, $ueConfig;

		$connect_user			=	$this->getConnectUser( null, $user );

		if ( ! $connect_user ) {
			$errors				=	$user->getError();

			cbfacebookconnectClass::setRedirect( null, ( $errors ? $errors : CBTxt::T( 'User failed to initiate!' ) ), 'error' );

			return false;
		}

		$secret					=	$this->gen->secret;
		$approve				=	$this->sync->approve;
		$confirm				=	$this->sync->confirm;
		$usergroup				=	$this->sync->usergroup;
		$approval				=	( $approve == 2 ? $ueConfig['reg_admin_approval'] : $approve );
		$confirmation			=	( $confirm == 2 ? $ueConfig['reg_confirmation'] : $confirm );
		$username				=	$connect_user->username;
		$fieldname				=	$this->gen->fieldname;

		$dummy_user				=	new moscomprofilerUser( $_CB_database );

		if ( $dummy_user->loadByUsername( $username ) ) {
			$username			=	$username . '_' . $connect_user->id;

			if ( $dummy_user->loadByUsername( $username ) ) {
				cbfacebookconnectClass::setRedirect( null, CBTxt::T( 'This username is already in use!' ), 'error' );

				return false;
			}
		}

		$middlename_position	=	strpos( $connect_user->name, ' ' );
		$lastname_position		=	strrpos( $connect_user->name, ' ' );

		if ( $lastname_position !== false ) {
			$firstname			=	substr( $connect_user->name, 0, $middlename_position );
			$lastname			=	substr( $connect_user->name, $lastname_position + 1 );

			if ( $middlename_position !== $lastname_position ) {
				$middlename		=	substr( $connect_user->name, $middlename_position + 1, $lastname_position - $middlename_position - 1 );
			} else {
				$middlename		=	null;
			}
		} else {
			$firstname			=	null;
			$middlename			=	null;
			$lastname			=	$connect_user->name;
		}

		if ( ! $usergroup ) {
			$usertype			=	$_CB_framework->getCfg( 'new_usertype' );
			$gid				=	$_CB_framework->acl->get_group_id( $usertype, 'ARO' );
			$gids				=	array( $gid );
		} else {
			if ( checkJversion() >= 2 ) {
				$gids			=	explode( '|*|', $usergroup );
				$gid			=	$_CB_framework->acl->getBackwardsCompatibleGid( $gids );
				$usertype		=	$_CB_framework->acl->get_group_name( $gid );
			} else {
				$usertype		=	$_CB_framework->acl->get_group_name( $usergroup );
				$gid			=	$usergroup;
				$gids			=	array( $gid );
			}
		}

		if ( ! $usertype ) {
			$usertype			=	'Registered';
			$gid				=	$_CB_framework->acl->get_group_id( $usertype, 'ARO' );
			$gids				=	array( $gid );
		}

		$user->usertype			=	$usertype;
		$user->gid				=	$gid;
		$user->gids				=	$gids;
		$user->sendEmail		=	0;
		$user->registerDate		=	date( 'Y-m-d H:i:s' );
		$user->username			=	$username;
		$user->firstname		=	$firstname;
		$user->middlename		=	$middlename;
		$user->lastname			=	$lastname;
		$user->name				=	$connect_user->name;
		$user->email			=	$connect_user->email;
		$user->password			=	$user->hashAndSaltPassword( md5( $connect_user->id . $secret ) );
		$user->avatar			=	$this->setAvatar( $connect_user );
		$user->registeripaddr	=	cbGetIPlist();
		$user->$fieldname		=	$connect_user->id;

		if ( $approval == 0 ) {
			$user->approved		=	1;
		} else {
			$user->approved		=	0;
		}

		if ( $confirmation == 0 ) {
			$user->confirmed	=	1;
		} else {
			$user->confirmed	=	0;
		}

		if ( ( $user->confirmed == 1 ) && ( $user->approved == 1 ) ) {
			$user->block		=	0;
		} else {
			$user->block		=	1;
		}

		$complete				=	$this->registrationComplete( $user );

		$_PLUGINS->trigger( 'onBeforeUserRegistration', array( &$user, &$user ) );

		if ( $user->store() ) {
			if ( ( $user->confirmed == 0 ) && ( $confirmation != 0 ) ) {
				$user->_setActivationCode();

				if ( ! $user->store() ) {
					return false;
				}
			}

			$messagesToUser		=	activateUser( $user, 1, 'UserRegistration', true, $complete );

			$_PLUGINS->trigger( 'onAfterUserRegistration', array( &$user, &$user, true ) );

			if ( ! $complete ) {
				$user->block	=	1;

				$user->storeBlock();
			}

			return $messagesToUser;
		}

		return false;
	}

	public function registrationComplete( &$user ) {
		global $ueConfig;

		$return		=	true;

		if ( preg_match( '/@invalid(?:\.com)?|cb\.invalid$/', $user->email ) ) {
			$return = false;
		}

		if ( $ueConfig['reg_enable_toc'] && ( $user->acceptedterms != 1 ) ) {
			$return = false;
		}

		return $return;
	}

	private function updateUser( &$user ) {
		global $_PLUGINS, $ueConfig;

		$fieldname						=	$this->gen->fieldname;
		$connect_userid					=	$this->getConnectID();
		$oldUserComplete				=	$user;

		$_PLUGINS->trigger( 'onBeforeUserUpdate', array( &$user, &$user, &$oldUserComplete, &$oldUserComplete ) );

		if ( $user->$fieldname != $connect_userid ) {
			$user->$fieldname			=	$connect_userid;

			if ( $ueConfig['reg_enable_toc'] && ( $user->acceptedterms != 1 ) ) {
				$user->acceptedterms	=	1;
			}

			if ( ! $user->store() ) {
				return false;
			}
		}

		$_PLUGINS->trigger( 'onAfterUserUpdate', array( &$user, &$user, $oldUserComplete ) );

		return true;
	}

	private function loginUser( &$user  ) {
		$fieldname				=	$this->gen->fieldname;

		if ( $user->$fieldname == $this->getConnectID() ) {
			cbimport( 'cb.authentication' );

			$cbAuthenticate		=	new CBAuthentication();

			$messagesToUser		=	array();
			$alertmessages		=	array();
			$redirect_url		=	cbfacebookconnectClass::setReturnURL( true );
			$resultError		=	$cbAuthenticate->login( $user->username, false, 0, 1, $redirect_url, $messagesToUser, $alertmessages, 0 );

			if ( $resultError ) {
				$user->_error	=	$resultError;
			} else {
				return ( count( $alertmessages ) > 0 ? stripslashes( implode( '<br />', $alertmessages ) ) : true );
			}
		}

		return false;
	}

	public function setAvatar( $connect_user ) {
		global $_CB_framework, $ueConfig;

		$avatar_img									=	$connect_user->avatar;

		if ( $avatar_img ) {
			$avatar_name							=	$connect_user->id;

			cbimport( 'cb.snoopy' );

			$snoopy									=	new CBSnoopy;
			$snoopy->read_timeout					=	30;

			$snoopy->fetch( $avatar_img );

			if ( ( ! $snoopy->results ) && stristr( $avatar_img, 'https://' ) ) {
				$snoopy->fetch( str_replace( 'https://', 'http://', $avatar_img ) );
			}

			if ( ! $snoopy->error ) {
				$headers							=	$snoopy->headers;

				if ( $headers ) foreach( $headers as $header ) {
					if ( preg_match( '/^Content-Type:/', $header ) ) {
						if ( preg_match( '/image\/(\w+)/', $header, $matches ) ) {
							if ( isset( $matches[1] ) ) {
								$ext				=	$matches[1];
							}
						}
					}
				}

				if ( isset( $ext ) ) {
					$ext							=	strtolower( $ext );

					if ( ! in_array( $ext, array( 'jpeg', 'jpg', 'png', 'gif' ) ) ) {
						return null;
					}

					cbimport( 'cb.imgtoolbox' );

					$path							=	$_CB_framework->getCfg( 'absolute_path' ) . '/images/comprofiler/';
					$allwaysResize					=	( isset( $ueConfig['avatarResizeAlways'] ) ? $ueConfig['avatarResizeAlways'] : 1 );

					$imgToolBox						=	new imgToolBox();
					$imgToolBox->_conversiontype	=	$ueConfig['conversiontype'];
					$imgToolBox->_IM_path			=	$ueConfig['im_path'];
					$imgToolBox->_NETPBM_path		=	$ueConfig['netpbm_path'];
					$imgToolBox->_maxsize			=	$ueConfig['avatarSize'];
					$imgToolBox->_maxwidth			=	$ueConfig['avatarWidth'];
					$imgToolBox->_maxheight			=	$ueConfig['avatarHeight'];
					$imgToolBox->_thumbwidth		=	$ueConfig['thumbWidth'];
					$imgToolBox->_thumbheight		=	$ueConfig['thumbHeight'];
					$imgToolBox->_debug				=	0;

					$image							=	array( 'name' => $avatar_name . '.' . $ext, 'tmp_name' => $snoopy->results );
					$newFileName					=	$imgToolBox->processImage( $image, $avatar_name, $path, 0, 0, 4, $allwaysResize );

					if ( $newFileName ) {
						return $newFileName;
					}
				}
			}
		}

		return null;
	}
}

class cbfacebookconnectGeneral extends cbfacebookconnectSynchronize {

	public function getUserID( $id = null ) {
		global $_CB_database;

		static $cache		=	array();

		if ( $id === null ) {
			$id				=	$this->getConnectID();
		}

		if ( ! isset( $cache[$id] ) ) {
			$user_id		=	null;

			if ( $id && preg_match( '/^\w+$/', $id ) ) {
				$query		=	'SELECT ' . $_CB_database->NameQuote( 'id' )
							.	"\n FROM " . $_CB_database->NameQuote( '#__comprofiler' )
							.	"\n WHERE " . $_CB_database->NameQuote( $this->gen->fieldname ) . " = " . $_CB_database->Quote( $id );
				$_CB_database->setQuery( $query );
				$user_id	=	$_CB_database->loadResult();
			}

			$cache[$id]		=	$user_id;
		}

		return $cache[$id];
	}

	public function getUser( $id = null ) {
		static $cache		=	array();

		if ( $id === null ) {
			$id				=	$this->getUserID();
		}

		if ( ! isset( $cache[$id] ) ) {
			$cache[$id]		=&	CBuser::getUserDataInstance( (int) $id );
		}

		return $cache[$id];
	}

	public function getToken() {
		static $cache	=	null;

		if ( ! isset( $cache ) ) {
			$session	=	$this->getSession();

			if ( $session ) {
				$cache	=	stripslashes( cbGetParam( $session, 'access_token', null ) );
			}
		}

		return $cache;
	}

	public function getConnectID() {
		static $cache	=	null;

		if ( ! isset( $cache ) ) {
			$session	=	$this->getSession();

			if ( $session ) {
				$cache	=	stripslashes( cbGetParam( $session, 'user_id', null ) );
			}
		}

		return $cache;
	}

	public function setSession( $user_id = null, $access_token = null ) {
		if ( $user_id === null ) {
			$user_id		=	stripslashes( cbGetParam( $_POST, 'user_id', '', _CB_ALLOWRAW ) );
		}

		if ( $access_token === null ) {
			$access_token	=	stripslashes( cbGetParam( $_POST, 'access_token', '', _CB_ALLOWRAW ) );
		}

		$cookie				=	array(	'user_id' => $user_id,
										'access_token' => $access_token,
										'signature' => md5( $user_id . $this->gen->secret )
									);

		if ( class_exists( 'JFactory' ) ) {
			$session		=	JFactory::getSession();

			$session->set( $this->gen->session_id, $cookie );
		} else {
			cbimport( 'cb.session' );

			CBCookie::setcookie( $this->gen->session_id, http_build_query( $cookie, null, '&' ) );
		}
	}

	public function resetSession() {
		$this->setSession( '', '' );
	}

	public function getSession() {
		static $cache			=	null;

		if ( ! isset( $cache ) ) {
			if ( class_exists( 'JFactory' ) ) {
				$sessions		=	JFactory::getSession();
				$session		=	$sessions->get( $this->gen->session_id );
			} else {
				$cookie			=	stripslashes( cbGetParam( $_COOKIE, $this->gen->session_id, null, _CB_ALLOWRAW ) );

				if ( $cookie ) {
					parse_str( $cookie, $session );
				} else {
					$session	=	null;
				}
			}

			if ( $session ) {
				$signature		=	md5( stripslashes( cbGetParam( $session, 'user_id', null ) ) . $this->gen->secret );

				if ( $signature === stripslashes( cbGetParam( $session, 'signature', null ) ) ) {
					$cache		=	$session;
				}
			}
		}

		return $cache;
	}

	public function showRegistration() {
		global $_CB_framework, $ueConfig;

		$return				=	null;

		if ( ! $_CB_framework->myId() ) {
			$user			=	$this->getUser();

			if ( $user->id ) {
				$plugin		=	cbfacebookconnectClass::getPlugin();

				$_CB_framework->document->addHeadStyleSheet( $plugin->livePath . '/cb.facebookconnect.css' );

				$js			=	"$( '#facebookconnectForm' ).validate( {"
							.		"rules: {"
							.			"cbfacebookconnect_email: { required: true, email: true },"
							.			"cbfacebookconnect_email_confirm: { equalTo: '#cbfacebookconnect_email' },"
							.			"cbfacebookconnect_tos: { required: true },"
							.		"},"
							.		"ignoreTitle: true,"
							.		"errorClass: 'connectValidationError',"
							.		"highlight: function( element, errorClass ) {"
							.			"$( element ).addClass( 'facebookconnectValidationInput');"
							.		"},"
							.		"unhighlight: function( element, errorClass ) {"
							.			"$( element ).removeClass( 'facebookconnectValidationInput' );"
							.		"},"
							.		"errorElement: 'div',"
							.		"errorPlacement: function( error, element ) {"
							.			"$( element ).parent().children().last().after( error );"
							.		"}"
							.	"});"
							.	"$.extend( jQuery.validator.messages, {"
							.		"required: '" . addslashes( CBTxt::T( 'This field is required.' ) ) . "',"
							.		"remote: '" . addslashes( CBTxt::T( 'Please fix this field.' ) ) . "',"
							.		"email: '" . addslashes( CBTxt::T( 'Please enter a valid email address.' ) ) . "',"
							.		"url: '" . addslashes( CBTxt::T( 'Please enter a valid URL.' ) ) . "',"
							.		"date: '" . addslashes( CBTxt::T( 'Please enter a valid date.' ) ) . "',"
							.		"dateISO: '" . addslashes( CBTxt::T( 'Please enter a valid date (ISO).' ) ) . "',"
							.		"number: '" . addslashes( CBTxt::T( 'Please enter a valid number.' ) ) . "',"
							.		"digits: '" . addslashes( CBTxt::T( 'Please enter only digits.' ) ) . "',"
							.		"creditcard: '" . addslashes( CBTxt::T( 'Please enter a valid credit card number.' ) ) . "',"
							.		"equalTo: '" . addslashes( CBTxt::T( 'Please enter the same value again.' ) ) . "',"
							.		"accept: '" . addslashes( CBTxt::T( 'Please enter a value with a valid extension.' ) ) . "',"
							.		"maxlength: $.validator.format('" . addslashes( CBTxt::T( 'Please enter no more than {0} characters.' ) ) . "'),"
							.		"minlength: $.validator.format('" . addslashes( CBTxt::T( 'Please enter at least {0} characters.' ) ) . "'),"
							.		"rangelength: $.validator.format('" . addslashes( CBTxt::T( 'Please enter a value between {0} and {1} characters long.' ) ) . "'),"
							.		"range: $.validator.format('" . addslashes( CBTxt::T( 'Please enter a value between {0} and {1}.' ) ) . "'),"
							.		"max: $.validator.format('" . addslashes( CBTxt::T( 'Please enter a value less than or equal to {0}.' ) ) . "'),"
							.		"min: $.validator.format('" . addslashes( CBTxt::T( 'Please enter a value greater than or equal to {0}.' ) ) . "')"
							.	"});";

				$_CB_framework->outputCbJQuery( $js, 'validate' );

				$return		.=	'<div class="cbfacebookconnect">'
							.		'<form action="' . cbfacebookconnectClass::getPluginURL( array( $this->type, 'storeregistration' ), null, false, false, null, 'current' ) . '" method="post" enctype="multipart/form-data" name="facebookconnectForm" id="facebookconnectForm" class="facebookconnectForm">'
							.			'<div class="facebookconnectEdit">'
							.				'<div class="facebookconnectEditTitle">' . CBTxt::T( 'Registration' ) . '</div>'
							.				'<div class="facebookconnectEditContent">';

				if ( preg_match( '/@invalid(?:\.com)?|cb\.invalid$/', $user->email ) ) {
					$return	.=					'<div class="facebookconnectEditContentInput">'
							.						'<div class="facebookconnectEditContentInputTitle">' . CBTxt::T( 'E-mail Address' ) . '</div>'
							.						'<div class="facebookconnectEditContentInputField">'
							.							'<input type="text" id="cbfacebookconnect_email" name="cbfacebookconnect_email" value="" class="inputbox" size="30" />'
							.						'</div>'
							.					'</div>'
							.					'<div class="facebookconnectEditContentInput">'
							.						'<div class="facebookconnectEditContentInputTitle">' . CBTxt::T( 'Confirm E-mail Address' ) . '</div>'
							.						'<div class="facebookconnectEditContentInputField">'
							.							'<input type="text" id="cbfacebookconnect_email_confirm" name="cbfacebookconnect_email_confirm" value="" class="inputbox" size="30" />'
							.						'</div>'
							.					'</div>';
				}

				if ( $ueConfig['reg_enable_toc'] && ( $user->acceptedterms != 1 ) ) {
					$return	.=					'<div class="facebookconnectEditContentInput">'
							.						'<input type="checkbox" id="cbfacebookconnect_tos" name="cbfacebookconnect_tos" value="1" class="inputbox" /> '
							.						'<label for="cbfacebookconnect_tos">' . sprintf( _UE_TOC_LINK, '<a href="' . cbSef( htmlspecialchars( $ueConfig['reg_toc_url'] ) ) . '" target="_BLANK"> ', '</a>' ) . '</label>'
							.					'</div>';
				}

				$return		.=				'</div>'
							.				'<input type="submit" value="' . htmlspecialchars( CBTxt::T( 'Update' ) ) . '" class="facebookconnectButton facebookconnectButtonSubmit" />'
							.			'</div>'
							.			cbGetSpoofInputTag( 'plugin' )
							.		'</form>'
							.	'</div>';
			}
		}

		if ( ! $return ) {
			cbfacebookconnectClass::setRedirect( null, CBTxt::T( 'Not authorized.' ), 'error' );
		} else {
			echo $return;
		}
	}

	public function storeRegistration() {
		global $_CB_framework, $ueConfig;

		$messagesToUser						=	null;
		$login								=	true;

		if ( ! $_CB_framework->myId() ) {
			$user							=	$this->getUser();

			if ( $user->id ) {
				$store						=	false;

				if ( $ueConfig['reg_enable_toc'] && ( $user->acceptedterms != 1 ) ) {
					$user->acceptedterms	=	(int) stripslashes( cbGetParam( $_POST, 'cbfacebookconnect_tos', null ) );

					$store					=	true;
				}

				if ( preg_match( '/@invalid(?:\.com)?|cb\.invalid$/', $user->email ) ) {
					$email					=	stripslashes( cbGetParam( $_POST, 'cbfacebookconnect_email', null ) );
					$confirmemail			=	stripslashes( cbGetParam( $_POST, 'cbfacebookconnect_email_confirm', null ) );

					if ( ( $email && cbIsValidEmail( $email ) ) && ( $confirmemail && cbIsValidEmail( $confirmemail ) ) && ( $email == $confirmemail ) ) {
						$user->email		=	$email;

						$store				=	true;
					}
				}

				if ( $store ) {
					if ( $user->store() ) {
						if ( $this->registrationComplete( $user ) ) {
							$messagesToUser	=	activateUser( $user, 1, 'UserRegistration', false, true );

							if ( $user->block ) {
								$login		=	false;
							}
						} else {
							$login			=	false;
						}
					} else {
						$login				=	false;
					}
				}
			}
		}

		if ( ( ! $login ) && $messagesToUser ) {
			echo '<div class="cbfacebookconnect">' . implode( "\n", $messagesToUser ) . '</div>';
		} elseif ( ( ! $login ) && $user->getError() ) {
			cbfacebookconnectClass::getPluginURL( array( $this->type, 'registration' ), $user->getError(), false, true, 'error', 'current' );
		} else {
			$this->syncUser();
		}
	}

	public function showButton( $horizontal = 0, $compact = 0 ) {
		global $_CB_framework;

		$api					=	$this->getInstance();
		$return					=	null;

		if ( $api->loadAPI() ) {
			$plugin				=	cbfacebookconnectClass::getPlugin();
			$user				=&	CBuser::getUserDataInstance( $_CB_framework->myId() );

			static $CSS_loaded	=	0;

			if ( ! $CSS_loaded++ ) {
				$_CB_framework->document->addHeadStyleSheet( $plugin->livePath . '/cb.facebookconnect.css' );
			}

			$fieldname			=	$this->gen->fieldname;
			$button				=	$this->sync->button;

			if ( $user->id ) {
				if ( $this->sync->link && ( ! $user->$fieldname ) && ( ! $api->getUserID() ) ) {
					if ( ( ! $button ) || ( ( $button == 2 ) && $horizontal ) || ( ( $button == 3 ) && $compact ) ) {
						$return	=	'<input class="' . $this->type . '_button_small" type="button" onclick="' . $this->type . '_login();" title="' . htmlspecialchars( CBTxt::P( 'Link your [sitename] account.', array( '[sitename]' => $this->name ) ) ) . '" />';
					} else {
						$return	=	'<div class="' . $this->type . '_button_bg"><input class="' . $this->type . '_button" type="button" onclick="' . $this->type . '_login();" title="' . htmlspecialchars( CBTxt::P( 'Link your [sitename] account.', array( '[sitename]' => $this->name ) ) ) . '" value="' . htmlspecialchars( CBTxt::T( ( $this->sync->button_link ? $this->sync->button_link : 'Link' ) ) ) . '" /></div>';
					}
				}
			} else {
				if ( ( ! $button ) || ( ( $button == 2 ) && $horizontal ) || ( ( $button == 3 ) && $compact ) ) {
					$return		=	'<input class="' . $this->type . '_button_small" type="button" onclick="' . $this->type . '_login();" title="' . htmlspecialchars( CBTxt::P( 'Login with your [sitename] account.', array( '[sitename]' => $this->name ) ) ) . '" />';
				} else {
					$return		=	'<div class="' . $this->type . '_button_bg"><input class="' . $this->type . '_button" type="button" onclick="' . $this->type . '_login();" title="' . htmlspecialchars( CBTxt::P( 'Login with your [sitename] account.', array( '[sitename]' => $this->name ) ) ) . '" value="' . htmlspecialchars( CBTxt::T( ( $this->sync->button_signin ? $this->sync->button_signin : 'Sign in' ) ) ) . '" /></div>';
				}
			}
		}

		if ( $horizontal ) {
			$return				=	'<span>' . $return . '</span>';
		} else {
			$return				=	'<div>' . $return . '</div>';
		}

		return $return;
	}
}

class cbfacebookconnect extends cbfacebookconnectGeneral {
	var $name	=	null;
	var $type	=	null;
	var $api	=	null;
	var $gen	=	null;
	var $sync	=	null;

	public function __construct() {
		$plugin							=	cbfacebookconnectClass::getPlugin();

		$this->name						=	'Facebook';
		$this->type						=	'facebookconnect';

		$this->api						=	new stdClass();
		$this->api->application_id		=	$plugin->params->get( 'fb_app_id', null );
		$this->api->application_secret	=	$plugin->params->get( 'fb_app_secretkey', null );
		$this->api->language			=	$plugin->params->get( 'fb_app_lang', 'en_US' );
		$this->api->enabled				=	$plugin->params->get( 'fb_app_enabled', 1 );

		$this->gen						=	new stdClass();
		$this->gen->fieldname			=	'fb_userid';
		$this->gen->session_id			=	'cbfacebookconnect_facebook';
		$this->gen->secret				=	md5( $this->api->application_secret );

		$this->sync						=	new stdClass();
		$this->sync->register			=	$plugin->params->get( 'fb_register', 1 );
		$this->sync->usergroup			=	$plugin->params->get( 'fb_reg_usergroup', null );
		$this->sync->approve			=	$plugin->params->get( 'fb_reg_approve', 0 );
		$this->sync->confirm			=	$plugin->params->get( 'fb_reg_confirm', 0 );
		$this->sync->link				=	$plugin->params->get( 'fb_link', 1 );
		$this->sync->firstlogin			=	$plugin->params->get( 'fb_redirect_firstlog', null );
		$this->sync->login				=	$plugin->params->get( 'fb_redirect_log', null );
		$this->sync->button				=	$plugin->params->get( 'fb_button', 2 );
		$this->sync->button_signin		=	$plugin->params->get( 'fb_button_signin', null );
		$this->sync->button_link		=	$plugin->params->get( 'fb_button_link', null );
	}

	static public function getInstance() {
		static $cache	=	null;

		if ( ! isset( $cache ) ) {
			$cache		=	new cbfacebookconnect();
		}

		return $cache;
	}

	public function loadAPI() {
		global $_CB_framework;

		static $cache						=	null;

		if ( ! isset( $cache ) ) {
			$plugin							=	cbfacebookconnectClass::getPlugin();
			$application_id					=	trim( $this->api->application_id );
			$application_secret				=	trim( $this->api->application_secret );

			if ( $this->api->enabled && $application_secret && $application_id ) {
				static $JS_loaded			=	0;

				if ( ! $JS_loaded++ ) {
					if ( $this->api->language == 'auto' ) {
						$lang				=	'en_US';
						$lang_tag			=	$_CB_framework->getCfg( 'lang_tag' );

						if ( $lang_tag ) {
							$tag_split		=	explode( '_', $lang_tag );

							if ( count( $tag_split ) == 2 ) {
								$lang		=	strtolower( $lang_tag[0] ) . '_' . strtoupper( $lang_tag[1] );
							}
						}
					} else {
						$lang				=	$this->api->language;
					}

					$API_js					=	"function facebookconnect_loadapi() {"
											.		"if ( document.body ) {"
											.			"if ( ! document.getElementById( 'fb-root' ) ) {"
											.				"var div = document.createElement( 'div' );"
											.				"div.setAttribute( 'id', 'fb-root' );"
											.				"if ( document.body.firstChild ) {"
											.					"document.body.insertBefore( div, document.body.firstChild );"
											.				"} else {"
											.					"document.body.appendChild( div );"
											.				"}"
											.			"}"
											.		"}"
											.		"if ( window.FB ) {"
											.			"FB.init({"
											.				"appId: '" . addslashes( $application_id ) . "',"
											.				"channelUrl: '" . $plugin->livePath . "/channel.php?scheme=$plugin->scheme&lang=$lang',"
											.				"status: true,"
											.				"cookie: true,"
											.				"xfbml: true"
											.			"});"
											.		"}"
											.		"if ( document.html && document.head ) {"
											.			"if ( ! document.html.getAttribute( 'xmlns:og' ) ) {"
											.				"document.html.setAttribute( 'xmlns:og', '$plugin->scheme://ogp.me/ns#' );"
											.			"}"
											.			"if ( ! document.html.getAttribute( 'xmlns:fb' ) ) {"
											.				"document.html.setAttribute( 'xmlns:fb', '$plugin->scheme://ogp.me/ns/fb#' );"
											.			"}"
											.			"var meta_nodes = document.head.getElementsByTagName( 'meta' );"
											.			"var meta_exists = false;"
											.			"for ( var i = 0; i < meta_nodes.length; i++ ) {"
											.				"if ( meta_nodes[i].getAttribute( 'property' ) == 'fb:app_id' ) {"
											.					"meta_exists = true;"
											.				"}"
											.			"}"
											.			"if ( ! meta_exists ) {"
											.				"var meta = document.createElement( 'meta' );"
											.				"meta.setAttribute( 'property', 'fb:app_id' );"
											.				"meta.setAttribute( 'content', '" . addslashes( $application_id ) . "' );"
											.				"if ( document.head.firstChild ) {"
											.					"document.head.insertBefore( meta, document.head.firstChild );"
											.				"} else {"
											.					"document.head.appendChild( meta );"
											.				"}"
											.			"}"
											.		"}"
											.	"};"
											.	"if ( window.addEventListener ) {"
											.		"window.addEventListener( 'load', facebookconnect_loadapi, false );"
											.	"} else if ( window.attachEvent ) {"
											.		"window.attachEvent( 'onload', facebookconnect_loadapi );"
											.	"}"
											.	"function facebookconnect_login() {"
											.		"if ( window.FB ) {"
											.			"FB.login( function( response ) {"
											.				"if ( ( typeof response.authResponse.userID != 'undefined' ) && ( typeof response.authResponse.accessToken != 'undefined' ) ) {"
											.					"var request = new XMLHttpRequest();"
											.					"request.open( 'POST', '" . addslashes( cbfacebookconnectClass::getPluginURL( array( 'facebookconnect', 'session' ), null, false, false, null, false, 'raw' ) ) . "', false ); "
											.					"request.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );"
											.					"request.send( 'user_id=' + response.authResponse.userID + '&access_token=' + response.authResponse.accessToken );"
											.					"if ( request.status == 200 ) {"
											.						"window.location = '" . addslashes( cbfacebookconnectClass::getPluginURL( array( 'facebookconnect' ), null, false, false, null, true ) ) . "';"
											.					"}"
											.				"}"
											.			"}, { scope: 'email' });"
											.		"}"
											.	"};"
											.	"function facebookconnect_unjoin() {"
											.		"if ( window.FB ) {"
											.			"if ( confirm( '" . addslashes( CBTxt::P( 'Are you sure you want to unjoin [live_site]?', array( '[live_site]' => $_CB_framework->getCfg( 'live_site' ) ) ) ) . "' ) ) {"
											.				"FB.api({ method: 'Auth.revokeAuthorization' }, function( response ) {"
											.					"var request = new XMLHttpRequest();"
											.					"request.open( 'GET', '" . addslashes( cbfacebookconnectClass::getPluginURL( array( 'facebookconnect', 'reset' ), null, false, false, null, false, 'raw' ) ) . "', false ); "
											.					"request.send();"
											.					"if ( request.status == 200 ) {"
											.						"window.location = '" . addslashes( cbfacebookconnectClass::setReturnURL( true ) ) . "';"
											.					"}"
											.				"});"
											.			"}"
											.		"}"
											.	"};";

					$_CB_framework->document->addHeadScriptUrl( $plugin->scheme . '://connect.facebook.net/' . $lang . '/all.js', false, null, $API_js );
				}

				$cache						=	true;
			} else {
				$cache						=	false;
			}
		}

		return $cache;
	}

	public function getConnectUser( $id = null, $user = null ) {
		static $cache							=	array();

		if ( $id === null ) {
			$id									=	'me';
		}

		if ( ! isset( $cache[$id] ) ) {
			$cache[$id]							=	false;

			if ( $this->getConnectID() == $id ) {
				$id								=	'me';
			} else {
				if ( $id != 'me' ) {
					$id							=	htmlspecialchars( urlencode( $id ) );
				}
			}

			$token								=	$this->getToken();

			if ( $token ) {
				$token							=	'&access_token=' . htmlspecialchars( urlencode( $token ) );
			}

			$request							=	cbfacebookconnectClass::httpRequest( 'https://graph.facebook.com/' . $id . '?fields=id,username,name,email,picture.type(large)' . $token );

			if ( ( $request['http_code'] == 200 ) && ( ! $request['error'] ) ) {
				$results_array					=	(array) json_decode( $request['results'] );

				$error							=	cbGetParam( $results_array, 'error', null );

				if ( $error ) {
					if ( $user && isset( $error->message ) ) {
						$user->_error			=	stripslashes( $error->message );
					}
				} else {
					$cache[$id]					=	new stdClass();
					$cache[$id]->id				=	stripslashes( cbGetParam( $results_array, 'id', null ) );
					$cache[$id]->username		=	preg_replace( '/\W/', '', str_replace( ' ', '_', stripslashes( cbGetParam( $results_array, 'username', null ) ) ) );

					if ( ! $cache[$id]->username ) {
						$cache[$id]->username	=	preg_replace( '/\W/', '', str_replace( ' ', '_', stripslashes( cbGetParam( $results_array, 'name', null ) ) ) );
					}

					$cache[$id]->name			=	stripslashes( cbGetParam( $results_array, 'name', null ) );

					$picture					=	cbGetParam( $results_array, 'picture', null );

					if ( isset( $picture->data ) ) {
						$cache[$id]->avatar		=	stripslashes( cbGetParam( get_object_vars( $picture->data ), 'url', null ) );
					} elseif ( is_string( $picture ) ) {
						$cache[$id]->avatar		=	stripslashes( $picture );
					} else {
						$cache[$id]->avatar		=	null;
					}

					$cache[$id]->email			=	stripslashes( cbGetParam( $results_array, 'email', null ) );

					if ( ! $cache[$id]->email ) {
						$cache[$id]->email		=	$cache[$id]->id . '@cb.invalid';
					}

					$cache[$id]->user			=	$results_array;
				}
			} elseif ( $user && $request['error'] ) {
				$user->_error					=	$request['error'];
			}
		}

		return $cache[$id];
	}
}

class cbfacebookconnectPlugin extends cbPluginHandler {

	public function getDisplay( $name_lenght, $pass_lenght, $horizontal, $class_sfx, $params ) {
		global $_CB_framework;

		$return		=	cbfacebookconnect::getInstance()->showButton( $horizontal, $params->get( 'compact', 0 ) );

		return ( ! $_CB_framework->myId() ? array( 'afterButton' => $return ) : $return );
	}

	public function getMenu( $user ) {
		$plugin							=	cbfacebookconnectClass::getPlugin();
		$fb_id							=	$user->get( 'fb_userid' );

		if ( $fb_id ) {
			$fb_userid					=	cbfacebookconnect::getInstance()->getConnectID();

			if ( $fb_userid && ( $fb_id == $fb_userid ) ) {
				if ( $plugin->params->get( 'facebook_unlink', 1 ) ) {
					$unjoin				=	array();
					$unjoin['arrayPos']	=	array( '_UE_MENU_EDIT' => array( '_UE_MENU_FBC_UNJOIN' => null ) );
					$unjoin['position']	=	'menuBar';
					$unjoin['caption']	=	htmlspecialchars( CBTxt::T( 'Unjoin this site' ) );
					$unjoin['url']		=	"javascript: facebookconnect_unjoin();";
					$unjoin['target']	=	'';
					$unjoin['img']		=	'<img src="' . $plugin->livePath . '/images/icon.png" width="16" height="16" />';
					$unjoin['tooltip']	=	htmlspecialchars( CBTxt::T( 'Unauthorize this site from your Facebook account.' ) );

					$this->addMenu( $unjoin );
				}
			}
		}
	}

	public function loadUsergroupsList( $name, $value, $control_name ) {
		global $_CB_framework;

		$list_usergroups	=	array();
		$list_usergroups[]	=	moscomprofilerHTML::makeOption( '', CBTxt::T( 'Default CMS' ) );
		$list_usergroups	=	array_merge( $list_usergroups, $_CB_framework->acl->get_group_children_tree( null, 'USERS', false ) );

		if ( isset( $value ) ) {
			$valAsObj		=	array_map( create_function( '$v', '$o=new stdClass(); $o->value=$v; return $o;' ), explode( '|*|', $value ) );
		} else {
			$valAsObj		=	null;
		}

		return moscomprofilerHTML::selectList( $list_usergroups, ( $control_name ? $control_name .'['. $name .'][]' : $name ), null, 'value', 'text', $valAsObj, 0, false, false );
	}

	public function loadInstructions() {
		global $_CB_framework;

		$return	=	'<div>To begin developing your facebook application to connect with your ' . htmlspecialchars( $_CB_framework->getCfg( 'live_site' ) ) . ' CB website, you must do the following steps.</div>'
				.	'<ol>'
				.		'<li>To begin you will need to login to <a href="http://developers.facebook.com/" target="_blank">Facebook Developer</a> in order to create your Application. Once there click <a href="https://developers.facebook.com/apps" target="_blank">Apps</a> to begin creating your Application.</li>'
				.		'<li>Once at <a href="https://developers.facebook.com/apps" target="_blank">Apps</a> page you will need to click <strong>+ Create New App</strong> to create your new Application.</li>'
				.		'<li>Once presented with the <strong>New App</strong> pop-up you will need to enter your Applications name (recommended: ' . htmlspecialchars( $_CB_framework->getCfg( 'sitename' ) ) . '), select your Applications default language, and agree to <a href="http://www.facebook.com/terms.php" target="_blank">Facebook Terms</a> (please read carefully) then click <strong>Continue</strong>.</li>'
				.		'<li>Once <strong>Continue</strong> is clicked you will need to input and complete the <strong>Security Check</strong> (captcha) to prevent spam then click <strong>Submit</strong>.</li>'
				.		'<li>Once <strong>Submit</strong> is clicked and you have not yet verified your account you will need to follow the instructions for developer account verification.</li>'
				.		'<li>On the Application <strong>Settings</strong> page under <strong>Basic Info</strong> you will need to provide your <strong>App Domains</strong> (required: ' . htmlspecialchars( cbfacebookconnectClass::getURLDomain() ) . ') then clicking <strong>Website</strong> under <strong>Select how your app integrates with Facebook</strong> will present an input to provide <strong>Site URL</strong> (required: ' . htmlspecialchars( $_CB_framework->getCfg( 'live_site' ) ) . '/) then click <strong>Save Changes</strong>.</li>'
				.		'<li>You will now notice your application has its own personalized IDs (<strong>App ID/App Key</strong> and <strong>App Secret</strong>) at the top of the page in order to perform API calls on your websites behalf. These IDs need to be copied to their locations below.</li>'
				.		'<li>Click <strong>Save</strong></li>'
				.		'<li>Locate <strong>CB Login</strong> (mod_cblogin) within <strong>Module Manager</strong>.</li>'
				.		'<li>Set the parameter <strong>CB Plugins integration</strong> to <strong>Yes</strong>.</li>'
				.		'<li>Click <strong>Save</strong></li>'
				.	'</ol>';

		return $return;
	}

	public function checkCURL() {
		if ( ! function_exists( 'curl_init' ) ) {
			return '<div style="color: red;">' . CBTxt::T( 'Not Installed' ) . '</div>';
		} else {
			return '<div style="color: green;">' . CBTxt::T( 'Installed' ) . '</div>';
		}
	}

	public function checkJSON() {
		if ( ! function_exists( 'json_decode' ) ) {
			return '<div style="color: red;">' . CBTxt::T( 'Not Installed' ) . '</div>';
		} else {
			return '<div style="color: green;">' . CBTxt::T( 'Installed' ) . '</div>';
		}
	}

	public function checkAPI() {
		$plugin	=	cbfacebookconnectClass::getPlugin();

		if ( ( ! $plugin->params->get( 'fb_app_id', null ) ) || ( ! $plugin->params->get( 'fb_app_secretkey', null ) ) ) {
			return '<div>' . CBTxt::T( 'Not Configured' ) . '</div>';
		} else {
			if ( $plugin->params->get( 'fb_app_enabled', 1 ) && $plugin->params->get( 'fb_app_id', null ) && $plugin->params->get( 'fb_app_secretkey', null ) ) {
				return '<div style="color: green;">' . CBTxt::T( 'Initiated' ) . '</div>';
			} else {
				return '<div style="color: red;">' . CBTxt::T( 'Not Initiated' ) . '</div>';
			}
		}
	}
}

class cbfacebookconnectClass {

	static public function getPlugin() {
		global $_CB_framework, $_CB_database;

		static $plugin				=	null;

		if ( ! isset( $plugin ) ) {
			$query					=	'SELECT *'
									.	"\n FROM " . $_CB_database->NameQuote( '#__comprofiler_plugin' )
									.	"\n WHERE " . $_CB_database->NameQuote( 'element' ) . " = " . $_CB_database->Quote( 'cb.facebookconnect' );
			$_CB_database->setQuery( $query );
			$plugin					=	null;
			$_CB_database->loadObject( $plugin );

			if ( $plugin ) {
				if ( ! is_object( $plugin->params ) ) {
					$plugin->params	=	new cbParamsBase( $plugin->params );
				}

				if ( $_CB_framework->getUi() == 2 ) {
					$site			=	'..';
				} else {
					$site			=	str_replace( '/administrator', '', $_CB_framework->getCfg( 'live_site' ) );
				}

				$path				=	str_replace( '/administrator', '', $_CB_framework->getCfg( 'absolute_path' ) );

				$plugin->option		=	'com_comprofiler';
				$plugin->relPath	=	'components/' . $plugin->option . '/plugin/' . $plugin->type . '/' . $plugin->folder;
				$plugin->livePath	=	$site . '/' . $plugin->relPath;
				$plugin->absPath	=	$path . '/' . $plugin->relPath;
				$plugin->xml		=	$plugin->absPath . '/' . $plugin->element . '.xml';
				$plugin->scheme		=	( ( isset( $_SERVER['HTTPS'] ) && ( ! empty( $_SERVER['HTTPS'] ) ) && ( $_SERVER['HTTPS'] != 'off' ) ) ? 'https' : 'http' );

				cbimport( 'cb.html' );
				cbimport( 'language.cbteamplugins' );
			}
		}

		return $plugin;
	}

	static public function getItemid( $htmlspecialchars = false ) {
		global $_CB_framework, $_CB_database;

		static $Itemid	=	null;

		if ( ! isset( $Itemid ) ) {
			$query		=	'SELECT ' . $_CB_database->NameQuote( 'id' )
						.	"\n FROM " . $_CB_database->NameQuote( '#__menu' )
						.	"\n WHERE " . $_CB_database->NameQuote( 'link' ) . " LIKE " . $_CB_database->Quote( 'index.php?option=com_comprofiler&task=pluginclass&plugin=cb.facebookconnect%' )
						.	"\n AND " . $_CB_database->NameQuote( 'published' ) . " = 1"
						.	"\n AND " . $_CB_database->NameQuote( 'access' ) . " IN ( " . implode( ',', cbArrayToInts( CBuser::getMyInstance()->getAuthorisedViewLevelsIds( ( checkJversion() >= 2 ? false : true ) ) ) ) . " )"
						.	( checkJversion() >= 2 ? "\n AND " . $_CB_database->NameQuote( 'language' ) . " IN ( " . $_CB_database->Quote( $_CB_framework->getCfg( 'lang_tag' ) ) . ", '*', '' )" : null );
			$_CB_database->setQuery( $query );
			$Itemid		=	$_CB_database->loadResult();

			if ( ! $Itemid ) {
				$Itemid	=	getCBprofileItemid( null );
			}
		}

		if ( is_bool( $htmlspecialchars ) ) {
			return ( $htmlspecialchars ? '&amp;' : '&' ) . 'Itemid=' . $Itemid;
		} else {
			return $Itemid;
		}
	}

	static public function getPluginURL( $variables = array(), $msg = null, $htmlspecialchars = true, $redirect = false, $type = null, $return = false, $ajax = false, $back = false ) {
		global $_CB_framework;

		$get_return				=	cbfacebookconnectClass::getReturnURL();

		if ( $back && $get_return ) {
			$url				=	$get_return;
		} else {
			$plugin				=	cbfacebookconnectClass::getPlugin();
			$action				=	( isset( $variables[0] ) ? '&action=' . urlencode( $variables[0] ) : null );
			$id					=	( isset( $variables[2] ) ? '&id=' . urlencode( $variables[2] ) : null );

			if ( $return === 'current' ) {
				$set_return		=	( $get_return ? '&return=' . base64_encode( $get_return ) : null );
			} else {
				$set_return		=	( $return ? cbfacebookconnectClass::setReturnURL() : null );
			}

			if ( $_CB_framework->getUi() == 2 ) {
				$function		=	( isset( $variables[1] ) ? '.' . urlencode( $variables[1] ) : null );
				$vars			=	$action . $function . $id . $set_return;
				$format			=	( $ajax ? ( is_bool( $ajax ) || is_int( $ajax ) ? 'raw' : $ajax ) : 'html' );
				$url			=	'index.php?option=' . $plugin->option . '&task=editPlugin&cid=' . $plugin->id . $vars;

				if ( $htmlspecialchars ) {
					$url		=	htmlspecialchars( $url );
				}

				$url			=	$_CB_framework->backendUrl( $url, $htmlspecialchars, $format );
			} else {
				$function		=	( isset( $variables[1] ) ? '&func=' . urlencode( $variables[1] ) : null );
				$vars			=	$action . $function . $id . $set_return . cbfacebookconnectClass::getItemid();
				$format			=	( $ajax ? ( is_bool( $ajax ) || is_int( $ajax ) ? 'component' : $ajax ) : 'html' );
				$url			=	cbSef( 'index.php?option=' . $plugin->option . '&task=pluginclass&plugin=' . $plugin->element . $vars, $htmlspecialchars, $format );
			}
		}

		if ( $msg ) {
			if ( $redirect ) {
				cbfacebookconnectClass::setRedirect( $url, $msg, $type );
			} else {
				if ( $msg === true ) {
					$url		=	"javascript: location.href = '" . addslashes( $url ) . "';";
				} else {
					$url		=	"javascript: if ( confirm( '" . addslashes( $msg ) . "' ) ) { location.href = '" . addslashes( $url ) . "'; }";
				}
			}
		}

		return $url;
	}

	static public function setReturnURL( $raw = false ) {
		global $_CB_framework;

		if ( isset( $_SERVER['HTTPS'] ) && ( ! empty( $_SERVER['HTTPS'] ) ) && ( strtolower( $_SERVER['HTTPS'] ) != 'off' ) ) {
			$return					=	'https://';
		} else {
			$return					=	'http://';
		}

		if ( ( ! empty( $_SERVER['PHP_SELF'] ) ) && ( ! empty( $_SERVER['REQUEST_URI'] ) ) ) {
			$return					.=	$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		} else {
			$return					.=	$_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

			if ( isset( $_SERVER['QUERY_STRING'] ) && ( ! empty( $_SERVER['QUERY_STRING'] ) ) ) {
				$return				.=	'?' . $_SERVER['QUERY_STRING'];
			}
		}

		$return						=	urldecode( $return );

		if ( ! preg_match( '!^(?:(?:' . preg_quote( $_CB_framework->getCfg( 'live_site' ), '!' ) . ')|(?:index.php))!', $return ) ) {
			return null;
		} elseif ( preg_match( '!index\.php\?option=com_comprofiler&task=confirm&confirmCode=|index\.php\?option=com_comprofiler&task=login|index\.php\?option=com_comprofiler&task=pluginclass&plugin=cb.facebookconnect!', cbUnHtmlspecialchars( $return ) ) ) {
			$return					=	'index.php';
		} else {
			$urlParts				=	parse_url( $return );

			if ( isset( $urlParts['query'] ) ) {
				$queryParts			=	array();

				parse_str( $urlParts['query'], $queryParts );

				$urlParts['query']	=	http_build_query( $queryParts );
			}

			$return					=	( isset( $urlParts['scheme'] ) ? $urlParts['scheme'] . '://' : null )
									.	( isset( $urlParts['user'] ) ? $urlParts['user'] : null )
									.	( isset( $urlParts['pass'] ) ? ':' . $urlParts['pass'] . ( isset( $urlParts['user'] ) ? '@' : null ) : null )
									.	( isset( $urlParts['host'] ) ? $urlParts['host'] : null )
									.	( isset( $urlParts['port'] ) ? ':' . $urlParts['port'] : null )
									.	( isset( $urlParts['path'] ) ? $urlParts['path'] : null )
									.	( isset( $urlParts['query'] ) ? '?' . $urlParts['query'] : null )
									.	( isset( $urlParts['fragment'] ) ? '#' . $urlParts['fragment'] : null );
		}

		if ( ! $raw ) {
			$return					=	'&return=' . base64_encode( $return );
		}

		return $return;
	}

	static public function getReturnURL() {
		global $_CB_framework;

		$return			=	trim( stripslashes( cbGetParam( $_GET, 'return', null ) ) );

		if ( $return ) {
			$return		=	base64_decode( (string) preg_replace( '/[^A-Z0-9\/+=]/i', '', $return ) );
		} else {
			return null;
		}

		if ( ! preg_match( '!^(?:(?:' . preg_quote( $_CB_framework->getCfg( 'live_site' ), '!' ) . ')|(?:index.php))!', $return ) ) {
			return null;
		}

		if ( preg_match( '!index\.php\?option=com_comprofiler&task=confirm&confirmCode=|index\.php\?option=com_comprofiler&task=login|index\.php\?option=com_comprofiler&task=pluginclass&plugin=cb.facebookconnect!', cbUnHtmlspecialchars( $return ) ) ) {
			$return		=	'index.php';
		}

		return $return;
	}

	static public function setRedirect( $url, $msg = null, $type = 'message' ) {
		static $REDIRECT	=	0;

		if ( ! $REDIRECT++ ) {
			if ( ! $url ) {
				$return		=	cbfacebookconnectClass::getReturnURL();

				if ( $return ) {
					$url	=	$return;
				}

				if ( ! $url ) {
					$url	=	cbfacebookconnectClass::setReturnURL( true );
				}
			}

			if ( ! $url ) {
				$url		=	'index.php';
			}

			if ( is_array( $msg ) ) {
				$msg		=	implode( "\n", $msg );
			}

			cbRedirect( $url, $msg, $type );
		}
	}

	static public function getURLDomain( $url = null ) {
		global $_CB_framework;

		$return			=	null;

		if ( ! $url ) {
			$url		=	$_CB_framework->getCfg( 'live_site' );
		}

		if ( $url ) {
			$pieces		=	parse_url( $url );
			$domain		=	( isset( $pieces['host'] ) ? $pieces['host'] : null );

			if ( $domain && preg_match( '/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $matches ) ) {
				$return	=	$matches['domain'];
			} else {
				$return	=	$domain;
			}
		}

		return $return;
	}

	static public function httpRequest( $url, $method = 'GET', $body = array() ) {
		if ( function_exists( 'curl_init' ) ) {
			$plugin											=	cbfacebookconnectClass::getPlugin();
			$ch												=	curl_init();

			curl_setopt( $ch, CURLOPT_URL, $url );

			if ( $method == 'POST' ) {
				curl_setopt( $ch, CURLOPT_POST, true );
			}

			if ( $body ) {
				if ( $method == 'POST' ) {
					curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );
				} else {
					curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $body, null, '&' ) );
				}
			}

			curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

			if ( ( ! ini_get( 'safe_mode' ) ) && ( ! ini_get( 'open_basedir' ) ) ) {
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			}

			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch, CURLOPT_HEADER, true );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );

			if ( $plugin->params->get( 'fb_curl_ipv4', 1 ) ) {
				curl_setopt( $ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
			}

			$result											=	curl_exec( $ch );
			$http_code										=	curl_getinfo( $ch, CURLINFO_HTTP_CODE );
			$error											=	curl_error( $ch );

			if ( $result ) {
				list( $raw_response_headers, $results )		=	explode( "\r\n\r\n", $result, 2 );
			} else {
				$raw_response_headers						=	null;
				$results									=	null;
			}

			$response_headers								=	array();

			if ( $raw_response_headers ) {
				$response_header_lines						=	explode( "\r\n", $raw_response_headers );

				array_shift( $response_header_lines );

				foreach ( $response_header_lines as $header_line ) {
					list( $header, $value )					=	explode( ': ', $header_line, 2 );

					if ( isset( $response_headers[$header] ) ) {
						$response_headers[$header]			.=	"\n" . $value;
					} else {
						$response_headers[$header]			=	$value;
					}
				}
			}

			curl_close( $ch );

			$response										=	array(	'http_code' => $http_code,
																		'results' => $results,
																		'error' => $error,
																		'headers' => $response_headers
																	);
		} else {
			cbimport( 'cb.snoopy' );

			$snoopy											=	new CBSnoopy;

			$snoopy->read_timeout							=	30;
			$snoopy->rawheaders								=	array( 'Expect:' );

			switch ( $method ) {
				case 'POST':
					$formvar								=	array();

					if ( $body ) {
						$formvars							=	explode( "\n", $body );

						foreach ( $formvars as $vars ) {
							$var							=	explode( '=', trim( $vars ), 2 );

							if ( count( $var ) == 2 ) {
								$formvar[$var[0]]			=	$var[1];
							}
						}
					}

					$snoopy->set_submit_normal();
					$snoopy->submit( $url, $formvar );
				break;
				case 'GET':
				default:
					$formvar								=	array();

					if ( $body ) {
						$formvars							=	explode( "\n", $body );

						foreach ( $formvars as $vars ) {
							$var							=	explode( '=', trim( $vars ), 2 );

							if ( count( $var ) == 2 ) {
								$formvar[]					=	$var[0] . '=' . $var[1];
							}
						}
					}

					if ( $formvar ) {
						$url								=	$url . '?' . implode( '&', $formvar );
					}

					$snoopy->fetch( $url );
				break;
			}

			$response										=	array(	'http_code' => $snoopy->status,
																		'results' => $snoopy->results,
																		'error' => $snoopy->error,
																		'headers' => $snoopy->headers
																	);
		}

		return $response;
	}
}

class CBplug_cbfacebookconnect extends cbPluginHandler {

	public function getCBpluginComponent( $tab, $user, $ui, $postdata ) {
		switch ( cbGetParam( $_REQUEST, 'action', null ) ) {
			case 'facebookconnect':
				switch ( cbGetParam( $_REQUEST, 'func', null ) ) {
					case 'registration':
						cbfacebookconnect::getInstance()->showRegistration();
						break;
					case 'storeregistration':
						cbSpoofCheck( 'plugin' );
						cbfacebookconnect::getInstance()->storeRegistration();
						break;
					case 'session':
						cbfacebookconnect::getInstance()->setSession();
						break;
					case 'reset':
						cbfacebookconnect::getInstance()->resetSession();
						break;
					default:
						cbfacebookconnect::getInstance()->syncUser();
						break;
				}
				break;
		}
	}
}
?>