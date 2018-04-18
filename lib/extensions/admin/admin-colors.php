<?php

namespace Roots\Sage\TSM\AdminColors;

use Roots\Sage\Assets;

if ( !class_exists('TSM_Admin_Colors') ) {

	class TSM_Admin_Colors {

	/**
	 * Url of css file.
	 *
	 * @since  1.0.0
	 * 
	 * @var    string
	 */
	private $stylesheet_url;

	/**
	 * File with css file.
	 *
	 * @since  1.0.0
	 * 
	 * @var    string
	 */
	private $css;

	/**
	 * Array of available color slugs.
	 *
	 * @since  1.0.0
	 * 
	 * @var    array
	 */
	private $colors;

	/**
	 * Library constructor.
	 *
	 * @since  1.0.0
	 *
	 * @param  array  $args  Initialization arguments.
	 */
	public function __construct() {

		// Load the library functionality.
		$this->load();

	}

	public function load() {

		$this->set_stylesheet_url();

		$this->get_remote_css();

		$this->setup_color_array();

	}

	private function set_stylesheet_url() {

		$this->stylesheet_url = Assets\asset_path('styles/admin.css');
		
	}

	private function get_remote_css() {

		// Get the remote CSS.
		$url = set_url_scheme( $this->stylesheet_url );
		$response = wp_remote_get( $url, array('timeout' => 10) );

		/**
		 * If fetch was successful, return the remote CSS.
		 */
		if ( 200 == wp_remote_retrieve_response_code( $response ) ) {
			
			$response = wp_remote_retrieve_body( $response );

		} elseif ( is_wp_error( $response ) ) { // Check for faulty wp_remote_get()
			$response = $response;
		} elseif ( isset( $response['response'] ) ) { // Check for 404 and other non-WP_ERROR codes
			$response = new WP_Error( $response['response']['code'], $response['response']['message'] . " (URL: $url)" );
		} else { // Total failsafe
			$response = '';
		}

		$this->css = $response;

	}

	private function setup_color_array() {

		$colors = array();
		$hex_codes = array();

		/**
		 * Get all CSS selectors that have a "content:" pseudo-element rule,
		 * as well as all associated hex codes.
		 */

		preg_match_all( '/\.(color_switch\.)\s*(.*?)\s*{/s', $this->css, $matches );
		$colors = $matches[2];

		// Alphabetize the colors array by color name.
		asort( $colors );

		$this->colors = $colors;

	}

	public function setup_color_array_choices() {

		foreach ( $this->colors as $key => $color ) {
			$color_name = str_replace("-", " ", $color);
			$colors[$color] = "<i class='color_switch $color'></i> <span>$color_name</span>";
		}

		return $colors;
	}
}
}