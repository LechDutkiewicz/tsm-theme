<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/*=============================================================
=            Function to display footer copyrights            =
=============================================================*/

if ( !function_exists( 'tsm_dynamic_year_copyrights' ) ) {

	function tsm_dynamic_year_copyrights( $start_year = null ) {

		// get company name
		$company_name = get_field("con_name", "option");

		$current_year = date( 'Y' );
		if ( $start_year > 0 && $current_year > $start_year ) {
			$year_copy = "$start_year - $current_year";
		} else {
			$year_copy = $current_year;
		}

		if ( $company_name ) {
			echo "© $year_copy $company_name";
		} else {
			echo "© $year_copy";
		}
	}
}

/*=====  End of Function to display footer copyrights  ======*/





/*==================================================================
=            Function to display link to cookies policy            =
==================================================================*/

if ( !function_exists('tsm_cookies_link') ) {

	function tsm_cookies_link() {

		// setup variables
		$anchor = __('Cookies policy', THEME_DOMAIN);
		// check if catapult cookie bar plugin options are filled to fetch cookie policy page
		$cookie_bar_options = get_option( 'ctcc_content_settings' );
		$target = $cookie_bar_options ? get_permalink( $cookie_bar_options['more_info_page'] ) : get_field('target_cookies_link', 'options');
		?>
		<a href="<?= $target; ?>" class="link__white" title="<?php _e('Link to cookies policy page', THEME_DOMAIN); ?>" target="_blank">
			<?= $anchor; ?>
		</a>
		<?php
	}
}

/*=====  End of Function to display link to cookies policy  ======*/





/*=====================================================================
=            Function to display footer author credentials            =
=====================================================================*/

if ( !function_exists( 'tsm_author_credentials' ) ) {

	function tsm_author_credentials() {

		// setup variables
		$text = get_field('tekst_przed_linkiem', 'options');
		$anchor = get_field('anchor_linku', 'options');
		$target = get_field('cel_linku', 'options');
		$title = get_field('title_linku', 'options') ? get_field('title_linku', 'options') : __('Go to the website', THEME_DOMAIN);

		if ($text) {
			echo "$text";
		}

		if ($text && $anchor && $target) {
			echo " - ";
		}

		if ($anchor && $target) {
			echo "<a href='$target' class='link__white' title='$title' target='_blank'>$anchor</a>";
		}

	}
}

/*=====  End of Function to display footer author credentials  ======*/





/*============================================
=            Add ACF custom field            =
============================================*/

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5a66369cb82fa',
		'title' => 'Treści odnośnika do autora strony',
		'fields' => array(
			array(
				'key' => 'field_5a6636c243b93',
				'label' => 'Tekst przed linkiem',
				'name' => 'tekst_przed_linkiem',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5a6636cc43b94',
				'label' => 'Anchor linku',
				'name' => 'anchor_linku',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Lech Dutkiewicz',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5a6636d243b95',
				'label' => 'Cel linku',
				'name' => 'cel_linku',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'https://www.linkedin.com/in/lech-dutkiewicz-5392aa85/',
				'placeholder' => '',
			),
			array(
				'key' => 'field_5a6636dd43b96',
				'label' => 'Title linku',
				'name' => 'title_linku',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'WWW design i e-marketing consulting',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-copyrights',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5a663f64d46de',
		'title' => 'Link do polityki cookies',
		'fields' => array(
			array(
				'key' => 'field_5a663f839ae78',
				'label' => 'Cel linku',
				'name' => 'target_cookies_link',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-copyrights',
				),
			),
		),
		'menu_order' => 10,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;

/*=====  End of Add ACF custom field  ======*/





/*============================================
=            Add ACF options page            =
============================================*/

if ( !function_exists('setup_acf_tab_footer_copy_bar') ) {

	function setup_acf_tab_footer_copy_bar() {

		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> 'Odnośnik do autora w stopce strony',
				'menu_title' 	=> 'Odnośnik do autora',
				'slug'			=> 'acf-options-copyrights',
				'icon_url'		=> THEME_URL . 'lib/extensions/footer_copy/footer_copy.png',
				'redirect' 		=> false
			));
		}
	}

	setup_acf_tab_footer_copy_bar();

}

/*=====  End of Add ACF options page  ======*/



?>