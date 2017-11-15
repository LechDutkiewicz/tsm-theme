<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */

// define theme paths for template and extensions
define('THEME_PATH',get_template_directory().'/');
define('THEME_URL',get_template_directory_uri().'/');

// define('THEME_PATH_LIB',THEME_PATH.'lib/');
define('EXTENSIONS_PATH',THEME_PATH.'lib/extensions/');
define('POST_TYPES_PATH',THEME_PATH.'lib/post_types/');
define('CUSTOM_FIELDS_PATH',THEME_PATH.'lib/custom_fields/');
define('PLUGINS_PATH',THEME_PATH.'lib/plugins/');
define('IMAGES_PATH',THEME_URL.'dist/images/');
define('VENDOR_PATH',THEME_PATH.'vendor/');

$sage_includes = [
	'lib/assets.php',    // Scripts and stylesheets
	'lib/extras.php',    // Custom functions
	'lib/plugins.php',   // Plugins used in theme
	'lib/plugins_overrides.php',				// Overrides in plugins used in theme
	'lib/setup.php',     // Theme setup
	'lib/titles.php',    // Page titles
	'lib/nav_walkers.php',						// Custom nav walkers
	'lib/wrapper.php',   // Theme wrapper class
	'lib/customizer.php', // Theme customizer
	'lib/ajax_actions.php', // Theme WP ajax actions
	'lib/theme_helper.php', // Theme functions
];

foreach ($sage_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);

if (is_readable(EXTENSIONS_PATH)) {
	$sage_extensions = scandir(EXTENSIONS_PATH);

	foreach ($sage_extensions as $extension) {
			// echo $extension;
		$file = EXTENSIONS_PATH.$extension;

		if(is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === "php") {
			require_once($file);
		} else if (is_dir($file) && $extension !== ".." && $extension !== ".") {

				// scan through dir with extension
			$dir_extension = scandir($file);

			foreach ($dir_extension as $dir_file) {
				if ($dir_file !== ".." && $dir_file !== ".") {
					$dir_file_path = EXTENSIONS_PATH.$extension . "/" . $dir_file;
					$dir_file_type = pathinfo($dir_file_path, PATHINFO_EXTENSION);

						// include only php files
					if ($dir_file_type === "php") {
						require_once($dir_file_path);
					}
				}
			}
		}
	}
}

if (is_readable(POST_TYPES_PATH)) {
	$sage_post_types = scandir(POST_TYPES_PATH);

	foreach ($sage_post_types as $post_type) {
		$file = POST_TYPES_PATH.$post_type;
		if(is_file($file)) {
			require_once($file);
		}
	}
}

if (is_readable(CUSTOM_FIELDS_PATH)) {
	$sage_custom_fields = scandir(CUSTOM_FIELDS_PATH);

	foreach ($sage_custom_fields as $custom_field) {
		$file = CUSTOM_FIELDS_PATH.$custom_field;
		if(is_file($file)) {
			require_once($file);
		}
	}
}
