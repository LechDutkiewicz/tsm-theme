<?php

namespace Roots\Sage\Helper;
use TSM\Extensions\GoogleEvents;

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/**
*
* get_formatted_phone()
*
* @return phone number as clickable link for mobile
*
**/

if ( !function_exists( 'get_formatted_phone' ) ) {
	function get_formatted_phone( $phone = null ) {
		$phone = $phone ? $phone : get_field("con_phone", "option");

		/* Format phone number accordingly */

		$formatted_phone = substr_replace( (string)$phone, "-", 3, 0);
		$formatted_phone = substr_replace( $formatted_phone, "-", 7, 0);

		return $formatted_phone;
	}
}

/**
*
* format_working_hours()
*
* @return working hours as from - to with <sup> tag for minutes
*
**/

if ( !function_exists( 'format_working_hours' ) ) {
	function format_working_hours( $from, $to ) {

		$from = str_replace(':', '<sup>', $from) . '</sup>';
		$to = str_replace(':', '<sup>', $to) . '</sup>';
		echo $from . ' - ' . $to;
	}
}

/**
*
* get_mobile_friendly_phone()
*
* @return phone number as clickable link for mobile
*
**/

if ( !function_exists( 'get_mobile_friendly_phone' ) ) {
	function get_mobile_friendly_phone( $phone = null ) {
		$phone = $phone ? $phone : get_field("con_phone", "option");
		$output = "";
		if (wp_is_mobile()) {
			$output .= "<a href=\"tel:" . get_formatted_phone($phone) . "\">";
		}
		$output .= "<span class=\"tel\">".get_formatted_phone($phone)."</span>";
		if (wp_is_mobile()) {
			$output .="</a>";
		}
		return $output;
	}
}

/**
*
* split_google_address()
*
* split address string to street, zip and city.

Translate "London Street 9, 20-200, London" to
Array
(
    [0] => Array
        (
            [0] => London Street 9, 20-200, London, 
        )

    [1] => Array
        (
            [0] => London Street 9
        )

    [2] => Array
        (
            [0] => 20-200
        )

    [3] => Array
        (
            [0] => London
        )

)

* @return above array
*
**/

if ( !function_exists( 'split_google_address' ) ) {
	function split_google_address( $address = null ) {
		$address = $address ? $address : get_field("con_address", "option");

		$re = '/(.*?),\s*(\d{2}[\-]{0,1}\d{3})\s*([\p{L}]*)/u';
		preg_match($re, $address["address"], $matches);
		$output = array(
			"street"	=> $matches[1],
			"zip"		=> $matches[2],
			"city"		=> $matches[3]
		);
		return $output;
	}
}

/**
*
* get_url_address()
*
* @return return company addres as single string
*
**/

if ( !function_exists( 'get_url_address' ) ) {
	function get_url_address( $place_name = null, $address = null ) {
		$address = split_google_address( $address );
		$place_name = $place_name ? $place_name : get_field('con_name', 'option');
		$output = $place_name . ',' . $address["street"] . ',' . $address["zip"] . ',' . $address["city"];
		return urlencode($output);
	}
}

/**
*
* get_responsive_thumbnail()
* @param $sizes array with keys as foundation viewport size and values in thumbnail image size
*
* @return style tag with media queries containing background images.
*
**/

function get_responsive_thumbnail( $sizes, $ex_class = null, $post = null ) {

	// find attachment if is set or it will use post's featured image instead
	if (is_integer($post)) {
		$attachment_id = $post;
	} else if (!$post) {
		global $post;
	}

	// add empty space if extra classes were passed
	$ex_class = $ex_class ? " " . $ex_class : $ex_class;

	// store last key of sizes array for bgset parameter
	end($sizes);
	$last_key = key($sizes);
	reset($sizes);

	$first_key = key($sizes);

	// use post's featured image if attachment wasn't set
	if (!isset($attachment_id)) {
		$attachment_id = get_post_thumbnail_id($post->ID);
	}

	$first_img = fly_get_attachment_image_src($attachment_id, $sizes[$first_key]);

	// open bg container

	if (array_key_exists('src', $first_img)) {
		$output = '<img class="lazyload' . $ex_class . '" data-src="' . $first_img["src"] . '" data-srcset="';

	} else {
		$output = '<img class="lazyload' . $ex_class . '" data-sizes="auto" data-srcset="';

	}

	// go through all viewport sizes for bgset parameter
	while ( list( $viewport, $image_size) = each($sizes) ) {
		$image = fly_get_attachment_image_src($attachment_id, $image_size);

		if (array_key_exists('src', $image)) {

			if ($viewport === $first_key) {

			// for the biggest screen there's no need to set [--viewport]
				$output .= $image["src"];

			} else {

				$output .= $image["src"];
				$output .= " $viewport, ";
			}

		}

	}

	// close bg container
	$output .= '">';

	return $output;

}

/**
*
* get_responsive_background()
* @param $sizes array with keys as foundation viewport size and values in thumbnail image size
*
* @return style tag with media queries containing background images.
*
**/

function get_responsive_background( $sizes, $ex_class = null, $post = null ) {

	// find attachment if is set or it will use post's featured image instead
	if (is_integer($post)) {
		$attachment_id = $post;
	} else if (!$post) {
		global $post;
	}

	// add empty space if extra classes were passed
	$ex_class = $ex_class ? " " . $ex_class : $ex_class;

	// store last key of sizes array for bgset parameter
	end($sizes);
	$last_key = key($sizes);
	reset($sizes);

	// use post's featured image if attachment wasn't set
	if (!isset($attachment_id)) {
		$attachment_id = get_post_thumbnail_id($post->ID);
	}

	// open bg container
	$output = '<div class="lazyload' . $ex_class . '" data-bgset="';

	// go through all viewport sizes for bgset parameter
	while ( list( $viewport, $image_size) = each($sizes) ) {
		$image = fly_get_attachment_image_src($attachment_id, $image_size);

		if ($viewport === $last_key) {

			// for the biggest screen there's no need to set [--viewport]
			$output .= $image["src"];

		} else {

			$output .= $image["src"];
			$output .= " [--$viewport] | ";
		}

	}

	// close bg container
	$output .= '"></div>';

	return $output;

}

/**
*
* google_maps_mfp_link()
* @param $class with extra classes for link styling
*
* @return anchor with link to Google Maps compatible with magnific popup
*
**/

if ( !function_exists( 'google_maps_mfp_link' ) ) {
	function google_maps_mfp_link ( $place_name = null, $address = null, $class = null ) {
		$output = "<a href=\"https://maps.google.pl/maps?q=" . get_url_address( $place_name, $address ) . "\" class=\"popup-gmaps contact__link--secondary text__uppercase";
		$output .= $class ? " {$class}" : "";
		$output .= "\" title='" . __( 'Click to open map', THEME_DOMAIN ) . "' target='_blank' " . GoogleEvents\get_ga_event( "Wskazówki dojazdu", "Link na stronie", get_the_title() ) . ">" . __("Click for driving directions", THEME_DOMAIN) . "</a>";
		echo $output;
	}
}

?>