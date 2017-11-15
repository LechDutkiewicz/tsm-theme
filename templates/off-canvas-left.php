<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

?>
<button class="close-button" aria-label="Close menu" type="button" data-close>
	<span aria-hidden="true">&times;</span>
</button>
<?php

if (has_nav_menu('primary_navigation')) :
	wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
endif;

?>