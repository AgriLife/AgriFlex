<?php

/**
 * Helper functions for archive.php and similar files
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 2.0
 */

// Determines which title to display on the archive page
function agriflex_archive_title() {

  /* Queue the first post, that way we know
   * what date we're dealing with (if that is the case).
   *
   * We reset this later so we can run the loop
   * properly with a call to rewind_posts().
   */
  if ( have_posts() ) {
    the_post();
  }

  $html = '<h1 class="page-title">';

  if ( is_day() ) {
    $html .= sprintf( __( 'Daily Archives: <span>%s</span>', 'agriflex' ),
            get_the_date() );
  } elseif ( is_month() ) {
    $html .= sprintf( __( 'Monthly Archives: <span>%s</span>', 'agriflex' ),
            get_the_date('F Y') );
  } elseif ( is_year() ) {
    $html .= sprintf( __( 'Yearly Archives: <span>%s</span>', 'agriflex' ),
            get_the_date('Y') );
  } else {
    $html .= __( 'Blog Archives', 'agriflex' );
  }

  $html .= '</h1>';

  echo $html;

	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

}
