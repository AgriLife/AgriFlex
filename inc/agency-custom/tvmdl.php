<?php
/**
 * Contains the custom filters and actions for the
 * TVMDL agency type.
 *
 * @package AgriFlex
 */

$a = agriflex_agency();

if ( in_array( 'tvmdl', $a['agencies'] ) ) {
  add_action( 'agriflex_before_header', 'agriflex_tvmdl_logo', 40 );

  if ( $a['single'] ) {
    add_filter( 'agriflex_about', 'tvmdl_about', 10, 1 );
    add_filter( 'footer_links', 'tvmdl_links', 10, 1 );
  }
}

/**
 * Displays the TVMDL logo when selected
 *
 * Also shows the client login button when TVMDL only
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @return void
 */
function agriflex_tvmdl_logo() {

  $a = agrilife_agency();

  $html = '<li class="top-agency tvmdl-item">';
  $html .= '<a href="http://tvmdl.tamu.edu/">';
  $html .= '<span class="top-level-hide">';
  $html .= 'Texas A&amp;M Veterinary Medical Diagnostics Laboratory';
  $html .= '</span>';
  $html .= '<img src="' . get_bloginfo( 'stylesheet_directory') . '/images/tvmdl-branding.png" alt="Texas A&amp;M Research Logo" />';
  $html .= '</a>';
  $html .= '</li>';

  // Show client login if TVMDL only
  if ( $a['single'] ) {
    $html .= '<li class="right-align client-login-li">';
    $html .= '<a class="client-login" href="https://tvmdl.tamu.edu/webaccess/">';
    $html .= 'Client Login';
    $html .= '</a>';
    $html .= '</li>';
  }

  echo $html;

} // agriflex_tvmdl_logo

/**
 * Filters the 'About' footer column. Inserts TVMDL-related about information.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $about The unfiltered, default about information
 * @return string $html The college about information
 */
function tvmdl_about( $about ) {

  $html = '<h4>About</h4>';
  $html .= '<a href="http://www.youtube.com/watch?v=7Cdai78sCPw"><img src="' . get_bloginfo( 'template_directory' ) . '/images/about_video_tvmdl.jpg?v=100" alt="link to TVMDL about video" /></a>';
  $html .= '<p>The Texas A&amp;M Veterinary Medical Diagnostic Laboratory protects animal and human health through diagnostics. TVMDL has provided excellence in veterinary diagnostic services since 1967. TVMDL services veterinarians and citizens throughout Texas, the United States, and beyond.</p>	';

  return $html;

} // tvmdl_about

/**
 * Filters the 'Popular Links' footer column. Inserts links to
 * TVMDL tests.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $links The unfiltered, default popular links
 * @return string $html The TVMDL testing links
 */
function tvmdl_links( $links ) {

  $html = '<h4>Testing Sections</h4>';
  $html .= '<a href="http://agrilifeextension.tamu.edu/"><img src="' . get_bloginfo( 'template_directory' ) . '/images/agrilife_tvmdl_logo.png?v=100" alt="TVMDL" /></a>	';
  $html .= '<ul>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=B">Bacteriology</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=C">Clinical Pathology</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=R">Endocrinology</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=H">Histopathology</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=M">Molecular Diagnostics</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=N">Necropsy</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=P">Parasitology</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=E">Poultry</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=S">Serology</a></li>';
  $html .= '<li><a href="http://tvmdl.tamu.edu/testing.php?dept=T">Toxicology</a></li>';
  $html .= '<li class="last"><a href="http://tvmdl.tamu.edu/testing.php?dept=V">Virology</a></li>';
  $html .= '</ul>';

  return $html;

} // tvmdl_links
