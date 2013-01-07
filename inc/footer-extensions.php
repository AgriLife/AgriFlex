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

add_action( 'footer_col_4', 'agriflex_contact_footer', 10, 1 );
function agriflex_contact_footer() {

  $options = of_get_option();

  $html = '<div id="contact">';
  $html .= '<div class="contact">';
  $html .= '<h4>Contact</h4>';

  if ( ( $options['ext-type'] == 'county' || $options['ext-type'] == 'tce') && agriflex_single_agency() ) {
    require_once( TEMPLATEPATH . '/inc/nusoap/nusoap.php' );
    $html .= sprintf( county_footer_contact() );
  } else {
    $mapaddress = $options['p-street-1'] . ' ';
    $mapaddress .= $options['p-street-2'] . ' ';
    $mapaddress .= $options['p-city'] . ', TX ';
    $mapaddress .= $options['p-zip'];

    $map_image = 'http://maps.google.com/maps/api/staticmap?size=175x101&amp;markers=size:mid%7Ccolor:blue%7Clabel:Office%7C' . urlencode($mapaddress) . '&amp;sensor=false';

    $map_link = 'http://maps.google.com/?q=' . urlencode($mapaddress) . '&amp;markers=size:mid%7Ccolor:blue%7Clabel:Office&amp;sensor=false';

    $html .= '<a href="' . $map_link . '">';
    $html .= '<img src="' . $map_image . '" height="101" width="175" alt="Map to office" />';
    $html .= '</a>';

    $html .= '<ul>';

    if ( ! empty( $options['p-street-1'] ) ) {
      $html .= '<li>' . $options['p-street-1'] . '<br />';
      if ( ! empty( $options['p-street-2'] ) ) {
        $html .= $options['p-street-2'] . '<br />';
      }
      $html .= $options['p-city'] . ', TX ' . $options['p-zip'] . '</li>';
    }

    if ( ! empty( $options['m-street-1'] ) ) {
      $html .= '<li>' . $options['m-street-1'] . '<br />';
      if ( ! empty( $options['m-street-2'] ) ) {
        $html .= $options['m-street-2'] . '<br />';
      }
      $html .= $options['m-city'] . ', TX ' . $options['m-zip'] . '</li>';
    }

    if ( ! empty( $options['hours'] ) ) {
      $html .= '<li>' . $options['hours']. '</li>';
    }

    if ( ! empty( $options['email'] ) ) {
      $html .= '<li>';
      $html .= '<a href="' . obfuscate( 'mailto:' ) . obfuscate( $options['email'] ) . '">';
      $html .= obfuscate( $options['email'] );
      $html .= '</a>';
      $html .= '</li>';
    }

    if ( ! empty( $options['phone'] ) ) {
      $html .= '<li>';
      $html .= '<a href="tel:+1' . $options['phone'] . '">';
      $html .= 'Phone: ' . $options['phone'];
      $html .= '</a>';
      $html .= '</li>';
    }

    if ( ! empty( $options['fax'] ) ) {
      $html .= '<li>' . $options['fax']. '</li>';
    }

    $html .= '</ul>';

  }

  $html .= '</div><!-- .contact -->';
  $html .= '</div><!-- #contact -->';

  echo $html;

} // agriflex_contact_footer

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
