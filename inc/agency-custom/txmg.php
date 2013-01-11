<?php

add_filter( 'agriflex_about', 'txmg_about', 10, 1 );
function txmg_about( $about ) {

  $html = '<h4>About Us</h4>';
  $html .= '<a href="http://www.txmg.org/"><img src="' . get_bloginfo( 'template_directory' ) . '/images/about_txmg.jpg?v=100" alt="link to txmg.org" /></a>';
  $html .= '<p><a href="http://txmg.org/">Texas Master Gardeners</a> is a volunteer program designed to grow horticultural information throughout the state, town by town. </p>	';
  $html .= '<ul>';
  $html .= '<li><a href="http://txmg.org/become-a-master-gardener/become-a-texas-master-gardener/">Become a Master Gardener</a></li>';
  $html .= '<li><a href="http://txmg.org/future-events/">Master Gardener Events</a></li>';
  $html .= '<li><a href="http://txmg.org/contacts/by-county/">Chapter By County</a></li>					';
  $html .= '<li class="last"><a href="http://txmg.org/contacts/program-coordinator/">Contact Us</a></li>										';
  $html .= '</ul>';

  return $html;

} // txmg_about

add_filter( 'footer_links', 'txmg_links', 10, 1 );
function txmg_links( $links ) {

  $html = '<h4>Popular Links</h4>';
  $html .= '<a href="http://agrilifeextension.tamu.edu/"><img src="' . get_bloginfo( 'template_directory' ) . '/images/agrilife_ext_logo.png?v=100" alt="Texas A&amp;M AgriLife Extension" /></a>	';
  $html .= '<ul>';
  $html .= '<li><a href="http://county-tx.tamu.edu/">County Extension Offices</a></li>';
  $html .= '<li><a href="http://agrilife.tamu.edu/locations-window/#centers">Research and Extension Centers</a></li>';
  $html .= '<li><a href="http://agdirectory.tamu.edu/">Contact Directory</a></li>';
  $html .= '<li><a href="http://agrilife.org/today/contact-us/">Media Contacts</a></li>					';
  $html .= '<li><a href="http://texas4-h.tamu.edu/">Texas 4-H and Youth Dev.</a></li>					';
  $html .= '<li><a href="http://agrilifeextension.tamu.edu/about/strategyimpact/index.php">Strategic Plans, Impacts and Roadmaps</a></li>';
  $html .= '<li class="last"><a href="http://agrilifeextension.tamu.edu/careers/index.php">Employment Opportunities</a></li>										';
  $html .= '</ul>';

  return $html;

} // txmg_links
