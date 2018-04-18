<?php

namespace TSM\Extensions\GoogleEvents;

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/**
*
* get_ga_keys()
*
* @return google events keys that correspond category | action | label | value
* read more at https://developers.google.com/analytics/devguides/collection/analyticsjs/events
*
**/

function get_ga_keys() {

	$keys = array('cat', 'act', 'lbl', 'val');
	return $keys;
}

/**
*
* get_formatted_event()
*
* @return single formatted google analytics event as data-ga-cat for category, data-ga-act for action, data-ga-lbl for label and data-ga-val for value
* each data attribute is returned only if it was passed as argument
* read more at https://developers.google.com/analytics/devguides/collection/analyticsjs/events
*
**/

function get_formatted_event($event) {

	$keys = get_ga_keys();
	$temp = array();

	foreach ( $event as $key => $description ) {

		$temp[$keys[$key]] = $description;
	}

	$event = $temp;
	unset($temp);

	return $event;
}

/**
*
* get_ga_event()
*
* @param that correspond category | action | label | value
* read more at https://developers.google.com/analytics/devguides/collection/analyticsjs/events
* @return get google analytics events markup
*
**/

function get_ga_event() {

	$args = func_get_args();

	// remove unnecessary array outside array with args from the_ga_event() call if only 1 argument was passed
	if ( is_array($args) && count($args) === 1 ) {
		$args = $args[0];
	}

	// get analytics keys for event description
	$keys = get_ga_keys();

	// check if there are multiple events assigned to single DOM element
	if ( is_array($args[0]) ) {

		// variable to hold highest amount of attributes
		$attr_amount = 0;

		// assign event keys for each array element with single event
		foreach ( $args as $key => $arg ) {

			$args[$key] = get_formatted_event($args[$key]);
			$attr_amount = count($args[$key]) > $attr_amount ? count($args[$key]) : $attr_amount;
		}

		// create array which will contain multiple events
		$combined_events = array();

		for ( $i = 0; $i < $attr_amount; $i++ )	{

			// create adequate keys
			$combined_events[$keys[$i]] = array();
		}

	} else {

		$args = get_formatted_event($args);
	}

	// create an empty output varialbe
	$output = '';

	foreach ( $args as $key => $arg ) {

		// check if there is array with multiple events to run
		if ( is_array($arg) ) {

			foreach ( $arg as $arg_key => $single_arg ) {

				array_push( $combined_events[$arg_key], $single_arg );
			}
		} else if ( $arg !== '' ) {

			$output .= 'data-ga-' . $key . '=\'' . $arg . '\' ';
		}
	}

	if ( isset($combined_events) && is_array($combined_events) ) {
		foreach ( $combined_events as $key => $event ) {

			if ( $event !== '' ) {

				$output .= 'data-ga-' . $key . '=\'' . json_encode( $event ) . '\' ';
			}
		}
	}

	return $output;
}

/**
*
* the_ga_event()
*
* @param that correspond category | action | label | value
* read more at https://developers.google.com/analytics/devguides/collection/analyticsjs/events
* @print get_ga_event()
*
**/

function the_ga_event() {

	$args = func_get_args();
	echo get_ga_event( $args );
}

?>