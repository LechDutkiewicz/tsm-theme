<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

if ( !function_exists( 'get_company_schema_org' ) ) {
	function get_company_schema_org() {

		$args = array(
			"business-type"			=> "LocalBusiness",
			"name"					=> get_field("con_name", "option"),
			"description"			=> get_field("con_description", "option"),
			"logo"					=> IMAGES_PATH . 'logo-nav-white.png',
			"phone"					=> get_field("con_phone", "option"),

			);

		// $output = "<script type=\"application/ld+json\">";
		// $output .= "\n\t{";
		// $output .= "\n\t\t\"@context\": \"https://schema.org\",";
		// $output .= "\n\t\t\"@type\": \"" . $args['business-type'] . "\",";
		// $output .= "\n\t\t\"name\": \"" . $args['name'] . "\",";
		// $output .= "\n\t\t\"description\": \"" . $args['name'] . "\",";
		// $output .= "\n\t\t\"url\": \"" . get_home_url() . "\",";
		// $output .= "\n\t\t\"logo\": \"" . $args['logo'] . "\",";
		// $output .= "\n\t\t\"image\": \"" . TLThemeOption::getOption("lawyer_image") . "\",";
		// $output .= "\n\t\t\"address\": {";
		// $output .= "\n\t\t\t\"streetAddress\": \"" . TLThemeOption::getOption("company_info_company_street") . "\",";
		// $output .= "\n\t\t\t\"addressLocality\": \"" . TLThemeOption::getOption("company_info_company_city") . "\",";
		// $output .= "\n\t\t\t\"addressRegion\": \"śląskie\",";
		// $output .= "\n\t\t\t\"postalCode\": \"" . TLThemeOption::getOption("company_info_company_postcode") . "\",";
		// $output .= "\n\t\t\t\"addressCountry\": \"Polska\"";
		// $output .= "\n\t\t},";
		// $output .= "\n\t\t\"telephone\": [";
		// $output .= "\n\t\t\t\"" . $args['phone'] . "\"";
		// $output .= "\n\t\t],";
		// $output .= "\n\t\t\"geo\": {";
		// $output .= "\n\t\t\t\"@type\": \"GeoCoordinates\",";
		// $output .= "\n\t\t\t\"latitude\": \"" . TLThemeOption::getOption("google_map_coordinate_marker_lat") . "\",";
		// $output .= "\n\t\t\t\"longitude\": \"" . TLThemeOption::getOption("google_map_coordinate_marker_lng") . "\"";
		// $output .= "\n\t\t},";
		// $output .= "\n\t\t\"hasMap\": \"https://goo.gl/kTJJSH\",";
		// $output .= "\n\t\t\"aggregateRating\": {";
		// $output .= "\n\t\t\t\"@type\": \"AggregateRating\",";
		// $output .= "\n\t\t\t\"ratingValue\": \"" . TLThemeOption::getOption("reviews_aggregate") . "\",";
		// $output .= "\n\t\t\t\"reviewCount\": \"" . TLThemeOption::getOption("reviews_amount") . "\"";
		// $output .= "\n\t\t},";
		// $output .= "\n\t\t\"priceRange\": \"" . __("100-200 pln for initial consultation (up to 1 hour)", THEME_DOMAIN) . "\",";
		// $output .= "\n\t\t\"sameAs\": [";
		// $output .= "\n\t\t\t\"" . TLThemeOption::getOption("social_network_facebook_url") . "\",";
		// $output .= "\n\t\t\t\"" . TLThemeOption::getOption("social_network_linkedin_url") . "\",";
		// $output .= "\n\t\t\t\"" . TLThemeOption::getOption("social_network_googleplus_url") . "\",";
		// $output .= "\n\t\t\t\"https://www.specprawnik.pl/radca-prawny/marcin-dutkiewicz-53429\"";
		// $output .= "\n\t\t]";
		// $output .= "\n\t}";
		// $output .= "\n</script>";

		return $output;
	}
}

?>