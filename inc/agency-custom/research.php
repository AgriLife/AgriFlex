<?php
/**
 * Contains the custom filters and actions for the
 * Research agency type.
 *
 * @package AgriFlex
 */

$a = agriflex_agency();

if ( in_array( 'research', $a['agencies'] ) ) {
  add_action( 'agriflex_before_header', 'agriflex_res_logo', 30 );

  if ( $a['single'] ) {
    add_filter( 'agriflex_about', 'research_about', 10, 1 );
    add_filter( 'footer_links', 'research_links', 10, 1 );
  }
}

/**
 * Displays the research logo when selected
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_res_logo() {

  $html = '<li class="top-agency research-item">';
  $html .= '<a href="http://agriliferesearch.tamu.edu/">';
  $html .= '<span class="top-level-hide">';
  $html .= 'Texas A&amp;M AgriLife Research';
  $html .= '</span>';
  $html .= '<img src="' . get_template_directory_uri() . '/img/research-branding.png" alt="Texas A&amp;M Research Logo" />';
  $html .= '</a>';
  $html .= '</li>';

  echo $html;

} // agriflex_res_logo

/**
 * Filters the 'About' footer column. Inserts Extension-related about information.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $about The unfiltered, default about information
 * @return string $html The Research about information
 */
function research_about( $about ) {

  $html = '<h4>About</h4>';
  $html .= '<a href="http://www.youtube.com/watch?v=UnLkKMJasXk"><img src="' . get_template_directory_uri() . '/img/research-video-pic.jpg?v=100" alt="link to Texas A&amp;M Research about video" /></a>';
  $html .= '<p><a href="http://agriliferesearch.tamu.edu/">Texas A&amp;M AgriLife Research</a> is the state&apos;s premier research agency in agriculture, natural resources, and the life sciences. Our research spans numerous scientific disciplines and is international in scope.</p>';
  $html .= '<ul>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/research-units/">Research Units</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/about/">About</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/resources/">Resources</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/careers/">Careers</a></li>																						 									';
  $html .= '</ul>';

  return $html;

} // research_about

/**
 * Filters the 'Popular Links' footer column. Inserts links for
 * Extension research topics.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $links The unfiltered, default popular links
 * @return string $html The research topic links
 */
function research_links( $links ) {

  $html = '<h4>Research Topics</h4>';
  $html .= '<a href="http://agriliferesearch.tamu.edu/"><img src="' . get_template_directory_uri(). '/img/agrilife-research-footer-logo.png?v=100" alt="Texas A and M AgriLife Research Logo" /></a>	';
  $html .= '<ul>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topics/animals/">Animals</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topics/crops-plants/">Crops &amp; Plants</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topics/natural-resources/">Environment &amp; Natural Resources</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topics/health-and-food/">Health &amp; Food Science</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topics/policy-and-economics/">Policy &amp; Economics</a></li>';
  $html .= '</ul>';

  return $html;

} // research_links
