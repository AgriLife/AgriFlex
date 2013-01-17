<?php
/**
 * Contains the custom filters and actions for the
 * Sea Grant extension type.
 *
 * @package AgriFlex
 */

$a = agriflex_agency();

if ( $a['ext-type'] == 'sg' ) {
  add_action( 'agriflex_before_header', 'agriflex_sg_logo', 60 );
}
/**
 * Displays the sea grant logo when selected
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_sg_logo() {


  $html = '<li class="top-agency sg-item">';
  $html .= '<a href="http://texas-sea-grant.tamu.edu/">';
  $html .= 'Texas Sea Grant';
  $html .= '</a>';
  $html .= '</li>';

  echo $html;

} // agriflex_sg_logo
