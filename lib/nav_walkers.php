<?php

namespace Roots\Sage\NavWalkers;

if ( !defined( 'ABSPATH' ) )
    exit( 'No direct script access allowed' ); // Exit if accessed directly



/**
 * Foundation nav walker
 */

class Foundation_Nav_Menu extends \Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
}

class F6_DRILL_MENU_WALKER extends \Walker_Nav_Menu {

    /**
     * Add vertical menu class
     */

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu\">\n";
    }

    /**
     * Add item description to menu items
     */

    function start_el(&$output, $item, $depth = 0, $args = array (), $id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        // add front page url before hash for custom links on pages other than home page
        $item->url = ( $item->type === "custom" && ! is_front_page() ) ? esc_url( home_url() ) . "/" . $item->url : $item->url;

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' . $args->link_after;
        $item_output .= $item->description ? '<br /><span class="sub">' . $item->description . '</span>' : '';
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

function f6_drill_menu_fallback($args) {
    /*
     * Instantiate new Page Walker class instead of applying a filter to the
     * "wp_page_menu" function in the event there are multiple active menus in theme.
     */

    $walker_page = new Walker_Page();
    $fallback = $walker_page->walk(get_pages(), 0);
    $fallback = str_replace("children", "children vertical menu", $fallback);
    echo '<ul class="vertical menu" data-drilldown="">'.$fallback.'</ul>';
}

class F6_TOPBAR_MENU_WALKER extends \Walker_Nav_Menu {   
    /*
     * Add vertical menu class and submenu data attribute to sub menus
     */

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu nested\" data-submenu>\n";
    }
}

//Optional fallback
function f6_topbar_menu_fallback($args) {
    /*
     * Instantiate new Page Walker class instead of applying a filter to the
     * "wp_page_menu" function in the event there are multiple active menus in theme.
     */

    $walker_page = new Walker_Page();
    $fallback = $walker_page->walk(get_pages(), 0);
    $fallback = str_replace("<ul class='children'>", '<ul class="children submenu menu vertical" data-submenu>', $fallback);
    
    echo '<ul class="dropdown menu" data-dropdown-menu>'.$fallback.'</ul>';
}

?>