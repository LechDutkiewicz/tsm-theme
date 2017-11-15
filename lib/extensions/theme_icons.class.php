<?php

use Roots\Sage\Assets;

if ( !class_exists('theme_icons_icon_font') ) {

	class theme_icons_icon_font {

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
	 * Array of available BBSG Font icon slugs.
	 *
	 * @since  1.0.0
	 * 
	 * @var    array
	 */
	private $icons;

	/**
	 * BBSG font Library constructor.
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

		$this->setup_icon_array();

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

	private function setup_icon_array() {

		$icons = array();
		$hex_codes = array();

		/**
		 * Get all CSS selectors that have a "content:" pseudo-element rule,
		 * as well as all associated hex codes.
		 */

		preg_match_all( '/\.(theme_icons-)([^,}]*)\s*:before\s*{\s*(content:)\s*"(.*?)"/s', $this->css, $matches );
		$icons = $matches[2];
		$hex_codes = $matches[4];

		// Add hex codes as icon array index.
		$icons = array_combine( $hex_codes, $icons );

		// Alphabetize the icons array by icon name.
		asort( $icons );

		$this->icons = $icons;

	}

	public function setup_icon_array_choices() {

		foreach ( $this->icons as $key => $icon ) {
			$icons[$icon] = "<i class='theme_icons theme_icons-$icon'></i>";
		}

		return $icons;
	}
}
}