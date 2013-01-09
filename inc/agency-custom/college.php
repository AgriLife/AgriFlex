<?php
add_filter( 'agriflex_about', 'college_about', 10, 1 );
function college_about( $about ) {
  $html .= '<h4>About</h4>';
  $html .= '<a href="http://www.youtube.com/watch?v=NrfZh8t443M"><img src="' . get_bloginfo( 'template_directory' ) . '/images/college-video.jpg?v=100" alt="link to College about video" /></a>';
  $html .= '<p>The College of Agriculture and Life Sciences is the largest of its kind in the U.S. with 400 faculty members, including winners of prestigious awards like the Nobel, Wolf and World Food Prizes. It provides students with hands-on involvement in developing solutions to today&apos;s issues like bioenergy, environmental sustainability, international food security, and youth development.</p>';

  return $html;
}

add_filter( 'footer_links', 'college_links', 10, 1 );
function college_links( $links ) {
  $html .= '<h4>Departments</h4>';
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

add_filter( 'required_links_logo', 'college_required_logo', 10, 1 );
function college_required_logo( $link_logo ) {

  $link_logo = '<a href="http://www.tamu.edu">';
  $link_logo .= '<img src="' . get_bloginfo( 'template_directory' ) . '/images/texas-a-m-logo.png?v=100" alt="Texas A&amp;M University image" />';
  $link_logo .= '</a>';

  return $link_logo;

} // college_required_logo
