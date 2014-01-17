<?php
/**
 * Contains the custom filters and actions for the
 * TXMN extension type.
 *
 * @package AgriFlex
 */

$a = agriflex_agency();

if ( $a['ext-type'] == 'mn' ) {
  add_action( 'agriflex_before_header', 'agriflex_tpwd_logo', 60 );
  add_filter( 'agriflex_about', 'txmn_about', 10, 1 );
  add_filter( 'footer_links', 'txmn_links', 10, 1 );
}

/**
 * Displays the TPWD logo when Master Naturalist is selected
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_tpwd_logo() {

  $html = '<li class="top-agency txmn-item">';
  $html .= '<a href="http://www.tpwd.state.tx.us/">';
  $html .= 'Texas Parks &amp; Wildlife';
  $html .= '</a>';
  $html .= '</li>';

  echo $html;

} // agriflex_tpwd_logo

/**
 * Filters the 'About' footer column. Inserts TXMN-related about information.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $about The unfiltered, default about information
 * @return string $html The TXMN about information
 */
function txmn_about( $about ) {

  $html = '<h4>About Us</h4>';
  $html .= '<a href="http://www.txmn.org/"><img src="' . get_template_directory_uri() . '/img/about_txmn.jpg?v=100" alt="link to txmn.org" /></a>';
  $html .= '<p><a href="http://txmn.org/">Texas Master Naturalists</a> enjoy digging in the dirt and slogging through the mud while giving back to the community.</p>';
  $html .= '<ul>';
  $html .= '<li><a href="http://txmn.org/whats-a-master-naturalist/">What&apos;s a Master Naturalist?</a></li>';
  $html .= '<li><a href="http://txmn.org/chapters/">Chapters</a></li>';
  $html .= '<li class="last"><a href="http://txmn.org/contact-us/">Contact Us</a></li>';
  $html .= '</ul>	';

  return $html;

} // txmn_about

/**
 * Filters the 'Popular Links' footer column. Inserts TXMN popular links.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $links The unfiltered, default popular links
 * @return string $html The TXMN popular links
 */
function txmn_links( $links ) {

  $html = '<h4>Popular Links</h4>';
  $html .= '<a href="http://agrilifeextension.tamu.edu/"><img src="' . get_template_directory_uri() . '/img/agrilife_ext_logo.png?v=100" alt="Texas AgriLife Extension" /></a>';
  $html .= '<ul>';
  $html .= '<li><a href="http://county-tx.tamu.edu/">County Extension Offices</a></li>';
  $html .= '<li><a href="http://agrilife.tamu.edu/locations-window/#centers">Research and Extension Centers</a></li>';
  $html .= '<li><a href="http://agdirectory.tamu.edu/">Contact Directory</a></li>';
  $html .= '<li><a href="http://agrilife.org/today/contact-us/">Media Contacts</a></li>';
  $html .= '<li><a href="http://texas4-h.tamu.edu/">Texas 4-H and Youth Dev.</a></li>';
  $html .= '<li><a href="http://agrilifeextension.tamu.edu/about/strategyimpact/index.php">Strategic Plans, Impacts and Roadmaps</a></li>';
  $html .= '<li class="last"><a href="http://agrilifeextension.tamu.edu/careers/index.php">Employment Opportunities</a></li>';
  $html .= '</ul>	';

  return $html;

} // txmn_links
