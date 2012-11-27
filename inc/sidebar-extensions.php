<?php
/**
 * Hooks, filters, and template tags for the sidebar
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
 */

/**
 * Register action hook: agriflex_before_sidebar
 *
 * Located in sidebar.php after the opening aside div
 */
function agriflex_before_sidebar() {

  do_action( 'agriflex_before_sidebar' );

} // agriflex_after_sidebar

/**
 * Register action hook: agriflex_after_sidebar
 *
 * Located in sidebar.php after the opening aside div
 */
function agriflex_after_sidebar() {

  do_action( 'agriflex_after_sidebar' );

} // agriflex_after_sidebar
