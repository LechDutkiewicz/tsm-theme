<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

if ( !defined( 'ABSPATH' ) )
  exit( 'No direct script access allowed' ); // Exit if accessed directly

// Make theme available for translation
// Community translations can be found at https://github.com/roots/sage-translations
define('THEME_DOMAIN','sage');

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain(THEME_DOMAIN, get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', THEME_DOMAIN)
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  if ( function_exists("fly_add_image_size") ) {

    // template-home.php sections

    // fly_add_image_size( '360x640', 360, 640, true ); //small

  }

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => 'Glowny',
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => 'Stopka',
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  $localize_sage = array (
    'ajaxurl'         => admin_url('admin-ajax.php'),
    'no_more_posts'   => __('There\'s nothing more to load', THEME_DOMAIN),
  );

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

/**
 * Theme admin_assets
 */
function admin_assets() {

  wp_enqueue_script('admin_sage/js', Assets\asset_path('scripts/admin.js'), ['jquery'], null, true);
  wp_register_style('sage/tsm-admin', Assets\asset_path('styles/admin.css'), false, '1.0.0');
  wp_enqueue_style('sage/tsm-admin');
}
// add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\admin_assets', 100);

/**
 * Theme fonts
 *
 * read more at https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */

function theme_slug_fonts_url() {
  $fonts_url = '';
  $font_families[] = 'Open Sans:400,600,700';

  $query_args = array (
    'family' => urlencode( implode( '|', $font_families ) ),
    'subset' => urlencode( 'latin,latin-ext' ),
  );

  $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

  return esc_url_raw( $fonts_url );
}

function theme_slug_scripts_styles() {
  wp_enqueue_style( 'theme-slug-fonts', theme_slug_fonts_url(), array (), null );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\theme_slug_scripts_styles' );
