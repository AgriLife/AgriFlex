<?php
/**
 * Contains the custom filters and actions for the
 * College agency type.
 *
 * @package AgriFlex
 */

$a = agriflex_agency();

if ( in_array( 'college', $a['agencies'] ) ) {
  add_action( 'agriflex_before_header', 'agriflex_college_logo', 10 );

  if ( $a['single'] ) {
    add_action( 'agriflex_header', 'agriflex_college_explore', 1 );
    add_filter( 'agriflex_about', 'college_about', 10, 1 );
    add_filter( 'footer_links', 'college_links', 10, 1 );
    add_filter( 'required_links_logo', 'college_required_logo', 10, 1 );
  }
}

/**
 * Displays the college logo when selected.
 *
 * Also shows the 'Explore' menu if college only
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_college_logo() {

  $a = agriflex_agency();

  $html = '<li class="top-agency college-item">';
  $html .= '<a href="http://aglifesciences.tamu.edu/">';
  $html .= '<span class="top-level-hide">';
  $html .= 'Texas A&amp;M College of Agriculture and Life Sciences';
  $html .= '</span>';
  $html .= '<img src="' . get_bloginfo( 'stylesheet_directory') . '/images/college-branding.png" alt="Texas A&amp;M College Logo" />';
  $html .= '</a>';
  $html .= '</li>';

  // If college only, show 'Explore' menu
  if ( $a['single'] ) {
    $html .= '<li class="explore right-align">';
    $html .= '<a class="ext-link college-explore-link" href="/explore/">';
    $html .= 'Explore';
    $html .= '</a>';
    $html .= '</li>';
  }

  echo $html;

} // agriflex_college_logo

/**
 * Includes the college drop-down navigation
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_college_explore() {

  include( TEMPLATEPATH . '/inc/college/college-drop-down.php' );

} // agriflex_college_explore

/**
 * Filters the 'About' footer column. Inserts College-related about information.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $about The unfiltered, default about information
 * @return string $html The college about information
 */
function college_about( $about ) {

  $html = '<h4>About</h4>';
  $html .= '<a href="http://www.youtube.com/watch?v=NrfZh8t443M"><img src="' . get_bloginfo( 'template_directory' ) . '/images/college-video.jpg?v=100" alt="link to College about video" /></a>';
  $html .= '<p>The College of Agriculture and Life Sciences is the largest of its kind in the U.S. with 400 faculty members, including winners of prestigious awards like the Nobel, Wolf and World Food Prizes. It provides students with hands-on involvement in developing solutions to today&apos;s issues like bioenergy, environmental sustainability, international food security, and youth development.</p>';

  return $html;

} // college_about

/**
 * Filters the 'Popular Links' footer column. Inserts links to
 * College departments.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $links The unfiltered, default popular links
 * @return string $html The college department links
 */
function college_links( $links ) {

  $html = '<h4>Departments</h4>';
  $html .= '<a href="http://aglifesciences.tamu.edu/"><img src="' . get_bloginfo( 'template_directory' ) . '/images/Agriculture_HQ.jpg?v=100" alt="Texas A and M Ag Life Sciences" /></a>	';
  $html .= '<ul>';
  $html .= '<li><a href="http://agecon.tamu.edu/">Agricultural Economics</a></li>';
  $html .= '<li><a href="http://alec.tamu.edu/">Agricultural Leadership, Education, and Communications</a></li>';
  $html .= '<li><a href="http://animalscience.tamu.edu/">Animal Science</a></li>';
  $html .= '<li><a href="http://biochemistry.tamu.edu/">Biochemistry and Biophysics</a></li>';
  $html .= '<li><a href="http://baen.tamu.edu/">Biological and Agricultural Engineering</a></li>';
  $html .= '<li><a href="http://essm.tamu.edu/">Ecosystem Science and Management</a></li>';
  $html .= '<li><a href="http://insects.tamu.edu/">Entomology</a></li>';
  $html .= '<li><a href="http://hortsciences.tamu.edu/">Horticulture </a></li>';
  $html .= '<li><a href="http://nfs.tamu.edu/">Nutrition and Food Science</a></li>';
  $html .= '<li><a href="http://plantpathology.tamu.edu/">Plant Pathology and Microbiology</a></li>';
  $html .= '<li><a href="http://posc.tamu.edu/">Poultry Science</a></li>';
  $html .= '<li><a href="http://rptsweb.tamu.edu/">Recreation, Park and Tourism Sciences</a></li>';
  $html .= '<li><a href="http://soilcrop.tamu.edu/">Soil and Crop Sciences</a></li>';
  $html .= '<li><a href="http://wfscnet.tamu.edu/">Wildlife and Fisheries Sciences</a></li>';
  $html .= '</ul>';

  return $html;

} // college_links

/**
 * Filters the required links logo in the footer. Provides the TAMU logo
 * and link to the TAMU main site.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $link_logo The linkified System logo
 * @return string $link_logo The linkfied TAMU logo
 */
function college_required_logo( $link_logo ) {

  $link_logo = '<a href="http://www.tamu.edu">';
  $link_logo .= '<img src="' . get_bloginfo( 'template_directory' ) . '/images/texas-a-m-logo.png?v=100" alt="Texas A&amp;M University image" />';
  $link_logo .= '</a>';

  return $link_logo;

} // college_required_logo
