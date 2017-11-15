<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

?>
<!-- <div data-sticky-container class="sticky-container"> -->
	<div class="title-bar">
		<div class="grid-container" style="flex-grow:1;">
			<!-- <div class="grid-x grid-padding-x"> -->
				<div class="grid-x align-justify align-middle">
					<div class="cell small-2">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="company-logo" rel="home">
							<span class="hide-for-large logo logo_mobile"></span>
							<span class="show-for-large logo logo_desktop"></span>
							<span class="show-for-sr"><?= __("Home page", "sage"); ?></span>
						</a>
					</div>
					<div class="cell small-8 text-right">
						<?php
						if (has_nav_menu('primary_navigation')) :
							wp_nav_menu([
								'container'			=> 'nav',
								'theme_location'	=> 'primary_navigation',
								'menu_class'		=> 'dropdown menu show-for-large',
            					'items_wrap'        => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
								'fallback_cb'     	=> 'f6_topbar_menu_fallback',
								'walker'          	=> new Roots\Sage\NavWalkers\Foundation_Nav_Menu
							]);
						endif;
						?>
						<div class="hamburger__container hide-for-large">
							<a href="#" class="hamburger">
								<span class="hamburger__bars">
									<b class="bar-top"></b>
									<b class="bar-middle"></b>
									<b class="bar-bottom"></b>
								</span>
								<span class="hamburger__text"><?php _e( 'Menu', THEME_DOMAIN ); ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		<!-- </div> -->