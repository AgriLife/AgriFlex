<?php
/**
 * Custom actions to allow child theme and plugin developers
 * to easily add functionality to the theme.
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
 */

/**
 * Register action hook: agriflex_head
 *
 * Located in header.php in the <head> section
 */
function agriflex_head() {

  do_action( 'agriflex_head' );

}

/**
 * Register action hook: agriflex_before_header
 *
 * Located in header.php after the opening body tag
 */
function agriflex_before_header() {

  do_action( 'agriflex_before_header' );

}

/**
 * Register action hook: agriflex_header
 *
 * Located in header.php just after the opening wrapper div
 */
function agriflex_header() {

  do_action( 'agriflex_header' );

}

/**
 * Register action hook: agriflex_after_header
 *
 * Located in header.php before the primary navigation
 */
function agriflex_after_header() {

  do_action( 'agriflex_after_header' );

}

/**
 * Register action hook: agriflex_before_loop
 *
 * Located in index.php after the opening content div
 */
function agriflex_before_loop() {

  do_action( 'agriflex_before_loop' );

}

/**
 * Register action hook: agriflex_after_loop
 *
 * Located in index.php before the closing content div
 */
function agriflex_after_loop() {

  do_action( 'agriflex_after_loop' );

}
