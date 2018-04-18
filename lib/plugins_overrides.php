<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/*----------  Remove uk_cookie_consent plugins inline styles  ----------*/

if ( isset($CTCC_Public) ) {

	remove_filter( 'body_class', array( $CTCC_Public, 'body_class' ), 10 );
	remove_action( 'wp_enqueue_scripts', array( $CTCC_Public, 'enqueue_scripts' ), 10 );
	remove_action( 'wp_head', array( $CTCC_Public, 'add_css' ), 10 );
	remove_action( 'wp_footer', array( $CTCC_Public, 'add_js' ), 1000 );
	remove_action( 'wp_footer', array( $CTCC_Public, 'add_notification_bar' ), 1000 );

	if ( class_exists( 'CTCC_Public' ) ) {

		class CTCC_Tsm extends CTCC_Public {

			public function init() {
				add_filter ( 'body_class', array ( $this, 'body_class' ) );
				add_action ( 'wp_enqueue_scripts', array ( $this, 'enqueue_scripts' ) );
				add_action ( 'wp_footer', array ( $this, 'add_js' ), 1000 );
				add_action ( 'wp_footer', array ( $this, 'add_translated_notification_bar' ), 1000 );
			}

			public function add_translated_notification_bar() {

				$exclude = $this->show_bar();
				// Only do all this if post isn't excluded
				if( ! empty( $exclude ) ) {

					$ctcc_options_settings = get_option ( 'ctcc_options_settings' );
					$ctcc_content_settings = get_option ( 'ctcc_content_settings' );
					$ctcc_styles_settings = get_option ( 'ctcc_styles_settings' );

					// Check if it's a block or a bar
					$is_block = true;
					if ( $ctcc_styles_settings['position'] == 'top-bar' || $ctcc_styles_settings['position'] == 'bottom-bar' ) {
					$is_block = false; // It's a bar
				}

				// Add some classes to the block
				$classes = '';
				if ( $is_block ) {
					if ( ! empty ( $ctcc_styles_settings['rounded_corners'] ) ) {
						$classes .= ' rounded-corners';
					}
					if ( ! empty ( $ctcc_styles_settings['drop_shadow'] ) ) {
						$classes .= ' drop-shadow';
					}
				}
				if ( ! empty ( $ctcc_styles_settings['x_close'] ) ) {
					$classes .= ' use_x_close';
				}
				if ( empty ( $ctcc_styles_settings['display_accept_with_text'] ) ) {
					$classes .= ' float-accept';
				}

				// Allowed tags
				$allowed = array (
					'a' => array (
						'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'strong' => array(),
					'p' => array()
				);

				$content = '';
				$close_content = '';

				// Print the notification bar
				$content = '<div id="catapult-cookie-bar" class="' . $classes . '">';

				// Add a custom wrapper class if specified
				if ( $ctcc_styles_settings['position'] == 'top-bar' || $ctcc_styles_settings['position'] == 'bottom-bar' ) {
					$content .= '<div class="ctcc-inner ' . esc_attr ( str_replace ( '.', '', $ctcc_styles_settings['container_class'] ) ) . '">';
					$close_content = '</div><!-- custom wrapper class -->';
				}

				// Add a title if it's a block
				if ( $ctcc_styles_settings['position'] != 'top-bar' && $ctcc_styles_settings['position'] != 'bottom-bar' ) {
					$heading_text = wp_kses ( $ctcc_content_settings['heading_text'], $allowed );
					$heading_text = apply_filters( 'ctcc_heading_text', $heading_text );
					$content .= sprintf ( '<h3>%s</h3>',
						$heading_text
					);
				}

				// Make the Read More link
				$link = get_permalink( $ctcc_content_settings['more_info_page'] );
				$more_text = sprintf ( 
					'<a class="ctcc-more-info-link" tabindex=0 target="%s" href="%s">%s</a>',
					esc_attr ( $ctcc_content_settings['more_info_target'] ),
					esc_url ( $link ),
					_x('regulations', 'Cookie bar content', THEME_DOMAIN)
				);
				
				$button_text = sprintf ( '<button id="catapultCookie" tabindex=0 onclick="catapultAcceptCookies();">%s</button>',_x("Close and don't show again", 'Cookie bar content', THEME_DOMAIN) );

				// The main bar content
				$notification_text = sprintf( _x('This site uses cookies. To learn more, read the %s.', 'Cookie bar content', THEME_DOMAIN), $more_text );
				
				$content .= sprintf ( 
					'<span class="ctcc-left-side">%s</span><span class="ctcc-right-side">%s</span>',
					$notification_text,
					$button_text
				);

				// X close button
				if ( ! empty ( $ctcc_styles_settings['x_close'] ) ) {
					$content .= '<div class="x_close"><span></span><span></span></div>';
				}

				// Close custom wrapper class if used
				$content .= $close_content;

				$content .= '</div><!-- #catapult-cookie-bar -->';

				echo apply_filters ( 'catapult_cookie_content', $content, $ctcc_content_settings );
				
			}

		}

	}
}

$CTC_Public = new CTCC_Tsm();
$CTC_Public -> init();

}

?>