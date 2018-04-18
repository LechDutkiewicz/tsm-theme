<?php

/*
*	1. Setups custom field in WP admin for inline scripts.
*	2. Adds inline scripts to wp_head
*	3. Requires advanced custom fields http://www.advancedcustomfields.com/
*
*
*/

/*============================================
=            Add ACF custom field            =
============================================*/

if ( function_exists( "acf_add_local_field_group" ) ) {	

	acf_add_local_field_group(
		array(
			'id'		=> 'inline_script_data',
			'title'		=> 'Dodatkowe skrypty dodane do stopki strony',
			'fields'	=> array(
				array(
					'key'	=> 'field_ewiNTdoQUznDBooTfB',
					'label'	=> 'Wklej tutaj dodatkowe skrypty na stronie',
					'name'	=> 'inline_script',
					'type'	=> 'acf_code_field',
				),
				array(
					'key'	=> 'field_AeYfpkYsl9blhSJK6q2U',
					'label'	=> 'Wklej tutaj dodatkowe skrypty do panelu CMS',
					'name'	=> 'inline_script_admin',
					'type'	=> 'acf_code_field',
				),
			),
			'location'	=> array(
				array(
					array(
						'param'		=> 'options_page',
						'operator'	=> '==',
						'value'		=> 'acf-scripts',
						'order_no'	=> 50,
						'group_no'	=> 50
					),
					array(
						'param' => 'user_role',
						'operator' => '==',
						'value' => 'administrator',
					),
				),
			),
			'options'	=> array(
				'position'			=> 'normal',
				'layout'			=> 'default',
			),
			'menu_order'	=> 25
		)
	);
}

/*=====  End of Add ACF custom field  ======*/





/*============================================
=            Add ACF options page            =
============================================*/

if ( !function_exists('setup_acf_custom_scripts_bar') ) {

	function setup_acf_custom_scripts_bar() {

		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> 'Różne skrypty do wklejenia na stronie',
				'menu_title' 	=> 'Skrypty',
				'slug'			=> 'acf-scripts',
				'icon_url'		=> THEME_URL . 'lib/extensions/inline_scripts/js.png',
				'redirect' 		=> false
			));
		}
	}

	setup_acf_custom_scripts_bar();
}

/*=====  End of Add ACF options page  ======*/





/*================================================
=            Add scripts to wp_head            =
================================================*/

function register_custom_scripts() {
	
	the_field( 'inline_script', 'options' );
}

if ( function_exists( "acf_add_local_field_group" ) ) {

	add_action( 'wp_head', 'register_custom_scripts', 500 );
}

/*=====  End of Add scripts to wp_head  ======*/





/*============================================
=            Add scripts to admin            =
============================================*/

function admin_inline_js(){

	the_field( 'inline_script_admin', 'options' );
}

if ( function_exists( "acf_add_local_field_group" ) && is_admin() ) {

	add_action( 'admin_print_scripts', 'admin_inline_js', 500 );
}

/*=====  End of Add scripts to admin  ======*/


