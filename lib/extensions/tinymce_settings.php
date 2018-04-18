<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/**
 *
 * Custom colours in WordPress tinymce
 * https://urosevic.net/wordpress/tips/custom-colours-tinymce-4-wordpress-39/
 *
 */


function my_mce4_options( $init ) {
	$custom_colours = '
	"e74c3c","cinnabar",
	"ff7f67","salmon",
	"ae0c13","shiraz",
	"84bcad","gulf-stream",
	"b5efdf","cruise",
	"558c7e","patina",
	"f1c40f","buttercup",
	"fff653","gorse",
	"ba9400","buddha-gold",
	"2c3e50","picked-bluewood",
	"57687c","shuttle-gray",
	"031828","black-pearl",
	"ffffff","white",
	"000000","black",
	';
	$init['textcolor_map'] = '['.$custom_colours.']';
$init['textcolor_rows'] = 6; // expand colour grid to 6 rows
$init['textcolor_cols'] = 3; 

Source: https://urosevic.net/wordpress/tips/custom-colours-tinymce-4-wordpress-39/ © urosevic.net
return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

?>