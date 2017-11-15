<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

?>
<!-- Mobile navigation start -->
<nav class="menu main-menu menu__mobile" role="navigation">
	<?php
	if (has_nav_menu('primary_navigation')) {
		wp_nav_menu([		
			'theme_location'  	=> 'primary_navigation',
			'menu_id'         	=> 'primary_navigation_mobile',
			'depth'           	=> 3,
			'container'       	=> false,
			'menu_class'      	=> 'vertical menu accordion-menu text-center',
			'items_wrap'        => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
			'fallback_cb'     	=> 'f6_topbar_menu_fallback',
			'walker'          	=> new Roots\Sage\NavWalkers\Foundation_Nav_Menu
		]);
	}
	?>
</nav>
<!-- Mobile navigation end -->