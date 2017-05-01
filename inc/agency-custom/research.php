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
//  $html .= '<img src="' . get_template_directory_uri() . '/img/research-branding.png" alt="Texas A&amp;M Research Logo" />';
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
  $html .= '<a href="http://youtu.be/zVNZ5Bw3H-U"><img src="' . get_template_directory_uri() . '/img/research-video-pic.jpg" alt="link to Texas A&amp;M Research about video" /></a>';
  $html .= '<p><a href="http://agriliferesearch.tamu.edu/">Texas A&amp;M AgriLife Research</a> is the state&apos;s premier research agency in agriculture, natural resources, and the life sciences. Our research spans numerous scientific disciplines and is international in scope.</p>';
  $html .= '<ul>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/research-centers/">Research Centers</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/about/">About</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/resources-downloads/">Resources</a></li>';
  $html .= '<li><a href="https://greatjobs.tamu.edu/">Careers</a></li>																						 									';
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
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/water/">Water</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/disease-prevention/">Disease prevention</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/land-use/">Land use</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/bioenergy/">Bioenergy</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/sustainability/">Sustainability</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/food-nutrition/">Food &amp; Nutrition</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/insect-vectored-diseases/">Insect-vectored diseases</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/new-crops/">New crops</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/pests-invasive-plants/">Pests &amp; invasive plants</a></li>';
  $html .= '<li><a href="http://agriliferesearch.tamu.edu/topic/livestock-plant-genetics/">Livestock &amp; plant genetics</a></li>';
  $html .= '</ul>';

  return $html;

} // research_links
