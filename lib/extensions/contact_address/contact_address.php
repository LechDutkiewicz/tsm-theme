<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

// add google maps api key for google_map acf field
function my_acf_google_map_api( $api ){
	$api['key'] = get_field('gmap_api_key', 'options');
	return $api;
} 
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/*=============================================
=            Add ACF custom fields            =
=============================================*/

if ( function_exists( "acf_add_local_field_group" ) ) {

	acf_add_local_field_group(array(
		'id'		=> 'general_contact',
		'title'		=> 'Dane kontaktowe firmy',
		'fields'	=> array(
			array(
				'key'			=> 'field_5Q7aVj',
				'label'			=> 'Pełna nazwa',
				'name'			=> 'con_name',
				'type'			=> 'text',
			),
			array(
				'key' => 'field_5a9d39cb9cd2e',
				'label' => 'Takie same godziny we wszystkie dni',
				'name' => 'con_office_hours_match',
				'type' => 'true_false',
				'instructions' => 'Zaznacz, jeśli godziny otwarcia biura są takie same we wszystkie dni',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_YeadD46M',
				'label' => 'Godziny otwarcia',
				'name' => 'con_office_hours',
				'type' => 'repeater',
				'instructions' => 'W tym miejscu dodaj godziny otwarcia',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5a9d39cb9cd2e',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => 'Dodaj dzień pracy biura',
				'sub_fields' => array(
					array(
						'key' => 'field_FCqI955ezpMggd',
						'label' => 'Dzień',
						'name' => 'day',
						'type' => 'select',
						'instructions' => 'W tym miejscu wybierz nazwę dnia',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'mon' => 'Poniedziałek',
							'tue' => 'Wtorek',
							'wed' => 'Środa',
							'thu' => 'Czwartek',
							'fri' => 'Piątek',
							'sat' => 'Sobota',
							'sun' => 'Niedziela',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'return_format' => 'value',
						'placeholder' => '',
					),
					array(
						'key' => 'field_HTY1F4g',
						'label' => 'Godzina otwarcia',
						'name' => 'hour_open',
						'type' => 'text',
						'instructions' => 'Wpisz godzinę otwarcia jako godzina:minuta. Czyli np 10:00, jeśli to ma być 10⁰⁰, albo 9:00, jeśli to ma być 9⁰⁰',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '9:00',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_nkEEjbbktVp',
						'label' => 'Godzina zamknięcia',
						'name' => 'hour_close',
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
						'placeholder' => '18:00',
						'prepend' => '',
						'append' => '',
					),
				),
			),
			array(
				'key' => 'field_5a9d39f49cd2f',
				'label' => 'Godziny otwarcia',
				'name' => 'con_office_hours_same',
				'type' => 'group',
				'instructions' => 'W tym miejscu dodaj godziny otwarcia',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5a9d39cb9cd2e',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'table',
				'sub_fields' => array(
					array(
						'key' => 'field_5a9d3a389cd30',
						'label' => 'Pierwszy dzień pracy biura w tygodniu',
						'name' => 'day_start',
						'type' => 'select',
						'instructions' => 'W tym miejscu wybierz nazwę dnia',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'mon' => 'Poniedziałek',
							'tue' => 'Wtorek',
							'wed' => 'Środa',
							'thu' => 'Czwartek',
							'fri' => 'Piątek',
							'sat' => 'Sobota',
							'sun' => 'Niedziela',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'return_format' => 'value',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5a9d3a7b9cd31',
						'label' => 'Ostatni dzień pracy biura w tygodniu',
						'name' => 'day_finish',
						'type' => 'select',
						'instructions' => 'W tym miejscu wybierz nazwę dnia',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'mon' => 'Poniedziałek',
							'tue' => 'Wtorek',
							'wed' => 'Środa',
							'thu' => 'Czwartek',
							'fri' => 'Piątek',
							'sat' => 'Sobota',
							'sun' => 'Niedziela',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'return_format' => 'value',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5a9d3aa69cd32',
						'label' => 'Godzina otwarcia',
						'name' => 'hour_open',
						'type' => 'text',
						'instructions' => 'Wpisz godzinę otwarcia jako godzina:minuta. Czyli np 10:00, jeśli to ma być 10⁰⁰, albo 9:00, jeśli to ma być 9⁰⁰',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '9:00',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5a9d3adc9cd33',
						'label' => 'Godzina zamknięcia',
						'name' => 'hour_close',
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
						'placeholder' => '18:00',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
			array(
				'key' => 'field_5a44ee3ac2848',
				'label' => 'Pełny adres i nazwa firmy',
				'name' => 'con_address',
				'type' => 'google_map',
				'instructions' => 'Wpisz tutaj pełny adres, który ma się wyświetlić na stronie.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'center_lat' => '',
				'center_lng' => '',
				'zoom' => '',
				'height' => '',
			),
			array(
				'key' => 'field_5a44ec706092b',
				'label' => 'Numer telefonu',
				'name' => 'con_phone',
				'type' => 'number',
				'instructions' => 'Wpisz tutaj numer telefonu używając samych cyfr. Bez spacji, kresek, nawiasów, plusów...',
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
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array(
				'key'			=> 'field_It4XM',
				'label'			=> 'Email',
				'name'			=> 'con_email',
				'type'			=> 'email',
			),
		),
'location' => array(
	array(
		array(
			'param'		=> 'options_page',
			'operator'	=> '==',
			'value'		=> 'acf-options-address',
			'order_no'	=> 1,
			'group_no'	=> 1
		),
	),
),
'options'	=> array(
	'position'			=> 'normal',
	'layout'			=> 'default',
	'hide_on_screen'	=> array(
	),
),
'menu_order'	=> 1,
));

acf_add_local_field_group(array(
	'key' => 'group_5a9d3f325ecbd',
	'title' => 'Placówki i biura firmy',
	'fields' => array(
		array(
			'key' => 'field_5a9d3f5c81d88',
			'label' => 'Placówki',
			'name' => 'company_places',
			'type' => 'repeater',
			'instructions' => 'Dodaj tutaj kolejne placówki firmy',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => 'Dodaj nową placówkę',
			'sub_fields' => array(
				array(
					'key' => 'field_5a9d4022d6da4',
					'label' => 'Nazwa placówki',
					'name' => 'company_place_name',
					'type' => 'text',
					'instructions' => 'Podaj nazwę placówki, która ma się wyświetlić na stronie',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => 'Np. główna siedziba, filia w Opolu, itp...',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5a9d3f8881d89',
					'label' => 'Pełny adres i nazwa placówki',
					'name' => 'company_place_address',
					'type' => 'google_map',
					'instructions' => 'Wpisz tutaj pełny adres, który ma się wyświetlić na stronie.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'center_lat' => '',
					'center_lng' => '',
					'zoom' => '',
					'height' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-address',
			),
		),
	),
	'menu_order' => 50,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

/*=====  End of Add ACF custom fields  ======*/





/*============================================
=            Add ACF options page            =
============================================*/

if ( !function_exists('setup_acf_tab_contact_address_bar') ) {

	function setup_acf_tab_contact_address_bar() {

		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> 'Dane teleadresowe',
				'menu_title' 	=> 'Dane teleadresowe',
				'slug'			=> 'acf-options-address',
				'icon_url'		=> THEME_URL . 'lib/extensions/contact_address/contact_address.png',
				'redirect' 		=> false
			));
		}
	}

	setup_acf_tab_contact_address_bar();

}

/*=====  End of Add ACF options page  ======*/





/*================================================================
=            API keys visible only for administrators            =
================================================================*/	

$api_page_fields = array(
	'id'		=> 'apis',
	'title'		=> 'Klucze api',
	'fields'	=> array(
		array(
			'key'	=> 'field_3HpGIBX',
			'label'	=> 'Google Maps Api Key',
			'name'	=> 'gmap_api_key',
			'type'	=> 'text',
		),
		array(
			'key'	=> 'field_ZgkDfFK1Dx56p',
			'label'	=> 'Google Static Maps Api Key',
			'name'	=> 'staticgmap_api_key',
			'type'	=> 'text',
		),
	),
	'location' => array(
		array(
			array(
				'param'		=> 'options_page',
				'operator'	=> '==',
				'value'		=> 'acf-options-address',
				'order_no'	=> 1,
				'group_no'	=> 1
			),
			array(
				'param' => 'current_user_role',
				'operator' => '==',
				'value' => 'administrator',
			),
		),
	),
	'options'	=> array(
		'position'			=> 'normal',
		'layout'			=> 'default',
		'hide_on_screen'	=> array(
		),
	),
	'menu_order'	=> 1,
);

acf_add_local_field_group( $api_page_fields );

/*=====  End of API keys visible only for administrators  ======*/


}

?>