<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/*====================================================================================
=            Display list of social media profiles that belong to company            =
====================================================================================*/


if ( !function_exists( 'tsm_sm_list' ) ) {

	function tsm_sm_list( $ex_class = null ) {

		if ( have_rows('con_sm', 'options') ) {
			$ex_class = $ex_class ? $ex_class : 'align-center';
			?>
			<ul class="menu <?= $ex_class; ?> menu__social-media">
				<?php
				while ( have_rows( 'con_sm', 'options' ) ) {
					the_row();
					?>
					<li>
						<a href="<?= get_sub_field('con_sm_link'); ?>" class="link__white" title="<?= sprintf(__('Link to our social media profile on %s', THEME_DOMAIN), get_sub_field('con_sm_type')); ?>" target="_blank"><i class="theme_icons-ion-social-<?= get_sub_field('con_sm_type'); ?>-outline theme_icons-2x"></i></a>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
		}

	}
}


/*=====  End of Display list of social media profiles that belong to company  ======*/






/*=============================================
=            Add ACF custom fields            =
=============================================*/

if ( function_exists( "acf_add_local_field_group" ) ) {

	$options_page_fields = array(
		'id'		=> 'general_social_media',
		'title'		=> 'Profile social media firmy',
		'fields'	=> array(
			array(
				'key'			=> 'field_yxCp6hiFSczs7Pc4H',
				'label'			=> 'Profile social media',
				'name'			=> 'con_sm',
				'type'			=> 'repeater',
				'button_label'	=> 'Dodaj profil',
				'sub_fields'	=> array(
					array(
						'key'			=> 'field_xTr',
						'label'			=> 'Platforma social media',
						'name'			=> 'con_sm_type',
						'type'			=> 'select',
						'choices'		=> array(
							'facebook'					=> 'Facebook',
							'googleplus'				=> 'Google',
							'twitter'					=> 'Twitter',
							'linkedin'					=> 'linkedIn',
						),
					),
					array(
						'key'	=> 'field_K1pKiP8HtHb',
						'label'	=> 'Link',
						'name'	=> 'con_sm_link',
						'type'	=> 'url'
					),
				)
			),
		),
		'location' => array(
			array(
				array(
					'param'		=> 'options_page',
					'operator'	=> '==',
					'value'		=> 'acf-options-social-media',
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
	);

	acf_add_local_field_group( $options_page_fields );

}

/*=====  End of Add ACF custom fields  ======*/





/*============================================
=            Add ACF options page            =
============================================*/

if ( !function_exists('setup_acf_tab_social_media_bar') ) {

	function setup_acf_tab_social_media_bar() {

		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> 'Lista kanałów social media',
				'menu_title' 	=> 'Social media',
				'slug'			=> 'acf-options-social-media',
				'icon_url'		=> THEME_URL . 'lib/extensions/social_media/social_media.png',
				'redirect' 		=> false
			));
		}
	}

	setup_acf_tab_social_media_bar();

}

/*=====  End of Add ACF options page  ======*/


?>