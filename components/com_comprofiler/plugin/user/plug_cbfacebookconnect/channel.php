<?php
$cache_expire	=	( 60 * 60 * 24 * 365 );

header( "Pragma: public" );
header( "Cache-Control: maxage=" . $cache_expire );
header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', ( time() + $cache_expire ) ) . ' GMT' );

$scheme			=	( isset( $_GET['scheme'] ) ? $_GET['scheme'] . '://' : '//' );
$lang			=	( isset( $_GET['lang'] ) ? $_GET['lang'] : 'en_US' );
?>

<script src="<?php echo $scheme; ?>connect.facebook.net/<?php echo $lang; ?>/all.js"></script>