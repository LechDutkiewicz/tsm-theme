<?php

namespace Roots\Sage\Helper;

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

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
			$output .= "<a href=\"tel:" . $phone . "\">";
		}
		$output .= "<span class=\"tel\">".$phone."</span>";
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

		$re = '/(.*?),\s*(\d{2}[\-]{0,1}\d{3})\s*([a-zA-Z]*?)/';
		preg_match($re, $address["address"], $matches);
		$output = array(
			"street"	=> $matches[1],
			"zip"		=> $matches[2],
			"city"		=> $matches[3]
		);
		return $output;
	}
}

?>