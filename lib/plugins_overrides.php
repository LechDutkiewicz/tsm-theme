<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/*----------  Remove uk_cookie_consent plugins inline styles  ----------*/

remove_action( 'wp_head', array( $CTCC_Public, 'add_css' ), 10 );

?>