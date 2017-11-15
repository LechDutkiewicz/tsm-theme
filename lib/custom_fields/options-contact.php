<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

// add google maps api key for google_map acf field
function my_acf_google_map_api( $api ){
	// development key
	$api['key'] = 'AIzaSyBki3ESCQ-xIjfWPUKzG4tO2AWbYLR0ZEw';
	// production key
	// $api['key'] = 'AIzaSyBB1LEYQJoSf7OBkIxxiFIP4pIl9B2r_WE';
	return $api;
} 
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');



if ( function_exists( "register_field_group" ) ) {

	$options_page_fields = array (
		'id'		=> 'general_contact',
		'title'		=> 'Dane kontaktowe firmy',
		'fields'	=> array (
			array (
				'key'			=> 'field_5Q7aVj',
				'label'			=> 'Pełna nazwa',
				'name'			=> 'con_name',
				'type'			=> 'text',
				),
			array (
				'key'			=> 'field_UDP9c7l',
				'label'			=> 'Adres',
				'name'			=> 'con_address',
				'type'			=> 'google_map',
				'height'		=> '200',
				'center_lat'	=> '51.919438',
				'center_lng'	=> '19.145136',
				'zoom'			=> '6'
				),
			array (
				'key'			=> 'field_LPTNfAy2hF9nI',
				'label'			=> 'Telefon',
				'name'			=> 'con_phone',
				'type'			=> 'text',
				),
			array (
				'key'			=> 'field_It4XM',
				'label'			=> 'Email',
				'name'			=> 'con_email',
				'type'			=> 'email',
				),
			array (
				'key'			=> 'field_yxCp6hiFSczs7Pc4H',
				'label'			=> 'Profile social media',
				'name'			=> 'con_sm',
				'type'			=> 'repeater',
				'button_label'	=> 'Dodaj profil',
				'sub_fields'	=> array (
					array (
						'key'			=> 'field_xTr',
						'label'			=> 'Platforma social media',
						'name'			=> 'con_sm_type',
						'type'			=> 'select',
						'choices'		=> array (
							'facebook'					=> 'Facebook',
							'googleplus'				=> 'Google',
							'twitter'					=> 'Twitter',
							),
						),
					array (
						'key'	=> 'field_K1pKiP8HtHb',
						'label'	=> 'Link',
						'name'	=> 'con_sm_link',
						'type'	=> 'text'
						),
					)
				),
			),
		'location' => array (
			array (
				array (
					'param'		=> 'options_page',
					'operator'	=> '==',
					'value'		=> 'dane-kontaktowe',
					'order_no'	=> 1,
					'group_no'	=> 1
					),
				),
			),
		'options'	=> array (
			'position'			=> 'normal',
			'layout'			=> 'default',
			'hide_on_screen'	=> array (
				),
			),
		'menu_order'	=> 1,
		);

	register_field_group( $options_page_fields );

}

?>