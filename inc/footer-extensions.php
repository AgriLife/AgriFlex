<?php
/**
 * Actions, filters, and template tags for footer.php
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
 */


/**
 * Register action hook: agriflex_before_footer
 *
 * Located in footer.php, just after the opening footer tag
 */
function agriflex_before_footer() {

  do_action( 'agriflex_before_footer' );

} // agriflex_before_footer

/**
 * Register action hook: agriflex_footer
 *
 * Located in footer.php, inside the wrap div
 */
function agriflex_footer() {

  do_action( 'agriflex_footer' );

} // agriflex_footer

/**
 * Register action hook: agriflex_after_footer
 *
 * Located in footer.php, just before the closing footer tag
 */
function agriflex_after_footer() {

  do_action( 'agriflex_after_footer' );

} // agriflex_after_footer

add_action( 'agriflex_footer', 'agriflex_show_footer' );
/**
 * Determines which agency the site belongs to and builds
 * the required footer.
 * 
 * @todo - Make this not ugly
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 */
function agriflex_show_footer() {

  do_action( 'footer_col_1' );

  do_action( 'footer_col_2' );

  do_action( 'footer_col_3' );

  do_action( 'footer_col_4' );

  do_action( 'footer_col_5' );

} // agriflex_show_footer

add_action( 'footer_col_5', 'agriflex_bookstore_footer', 10, 1 );
function agriflex_bookstore_footer() {

  $html = '<div id="agrilife-bookstore">';
  $html .= '<div class="agrilife-bookstore">';
  $html .= '<h4>AgriLife Bookstore</h4>';
  $html .= '<a href="https://agrilifebookstore.org/">';
  $html .= '<img src="' . get_bloginfo( 'template_directory' ) . '/images/bookstore-books.png?v=100" alt="AgriLife Bookstore image" />';
  $html .= '</a>';
  $html .= '<p>AgriLife Extension&apos;s online Bookstore offers educational information and resources related to our many areas of expertise and programming; from agriculture, horticulture, and natural resources to nutrition, wellness for families and youth, and much more.</p>';
  $html .= '</div><!-- .agrilife-bookstore -->';
  $html .= '</div><!-- #agrilife-bookstore -->';

  echo $html;

}
