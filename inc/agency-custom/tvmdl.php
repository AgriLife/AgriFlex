<?php
/**
 * Contains the custom filters and actions for the
 * TVMDL agency type.
 *
 * @package AgriFlex
 */

/**
 * Filters the 'About' footer column. Inserts TVMDL-related about information.
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param string $about The unfiltered, default about information
 * @return string $html The college about information
 */
add_filter( 'agriflex_about', 'tvmdl_about', 10, 1 );
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
add_filter( 'footer_links', 'tvmdl_links', 10, 1 );
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
