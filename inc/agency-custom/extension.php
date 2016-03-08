<?php
/**
 * Contains the custom filters and actions for the
 * Extension agency type.
 *
 * @package AgriFlex
 */

$a = agriflex_agency();

if ( in_array( 'extension', $a['agencies'] ) ) {
	add_action( 'agriflex_before_header', 'agriflex_ext_logo', 20 );

	if ( $a['single'] ) {
		add_filter( 'agriflex_about', 'extension_about', 10, 5 );
		add_filter( 'footer_links', 'extension_links', 10, 5 );
	}

	if ( $a['ext-type'] == 'county' || $a['ext-type'] == 'tce' ) {
		add_filter( 'agriflex_site_title', 'agriflex_county_title', 10, 2 );
	}
	if ( $a['ext-type'] == 'tce' ) {
		add_action( 'agriflex_before_header', 'agriflex_tce_logo', 21 );
	}
	if ( $a['ext-type'] == 'mg' ) {
		add_filter( 'agriflex_site_title', 'agriflex_mg_title', 10, 2 );
	}
	if ( $a['ext-type'] == 'mn' ) {
		add_filter( 'agriflex_site_title', 'agriflex_mn_title', 10, 2 );
	}

	if ( $a['ext-type'] == '4h' ) {
		add_filter( 'agriflex_about', 'hhhh_about', 10, 1 );
	}
}

/**
 * Displays the extension logo when selected
 *
 * @since  AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_ext_logo() {

	$html = '<li class="top-agency tx-ext-item">';
	$html .= '<a href="http://agrilifeextension.tamu.edu/">';
	$html .= '<span class="top-level-hide">';
	$html .= 'Texas A&amp;M AgriLife Extension Service';
	$html .= '</span>';
	$html .= '</a>';
	$html .= '</li>';

	echo $html;

} // agriflex_ext_logo

/**
 * Displays the TCE logo when selected
 * @since AgriFlex 2.3.3
 * @return void
 */
function agriflex_tce_logo() {

	$html = '<li class="top-agency tce">';
	$html .= '<a href="http://pvcep.pvamu.edu/">';
	$html .= '<span class="top-level-hide">';
	$html .= 'Cooperative Extension Program';
	$html .= '</span>';
	$html .= '</a>';
	$html .= '</li>';

	echo $html;

}

/**
 * Displays the county/TCE site title
 *
 * @since  AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 *
 * @param string $link The old, unfiltered site title
 * @param array  $args The site URL and name
 *
 * @return string $link The new site title
 */
function agriflex_county_title( $link, $args ) {

	$link = '<a href="' . $args['url'] . '" ';
	$link .= 'title="' . $args['name'] . '">';
	$link .= '<span>Extension Education</span>';
	$link .= '<em>in ' . of_get_option( 'county-name-human' ) . ' County</em>';
	$link .= '</a>';

	return $link;

} // agriflex_county_title

/**
 * Displays the Master Gardener site title
 *
 * @since  AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 *
 * @param string $link The old, unfiltered site title
 * @param array  $args The site URL and name
 *
 * @return string $link The new site title
 */
function agriflex_mg_title( $link, $args ) {

	$src = get_template_directory_uri() . '/img/txmg-logo80.gif';
	$img = '<img src="' . $src . '" alt="' . $args['name'] . '" />';

	$link = '<a href="' . $args['url'] . '" ';
	$link .= 'title="' . $args['name'] . '">';
	$link .= $img . $args['name'];
	$link .= '</a>';

	return $link;

} // agriflex_mg_title

/**
 * Displays the Master Naturalist site title
 *
 * @since  AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 *
 * @param string $link The old, unfiltered site title
 * @param array  $args The site URL and name
 *
 * @return string $link The new site title
 */
function agriflex_mn_title( $link, $args ) {

	$src = get_template_directory_uri() . '/img/txmn-logo.png';
	$img = '<img src="' . $src . '" alt="' . $args['name'] . '" />';

	$link = '<a href="' . $args['url'] . '" ';
	$link .= 'title="' . $args['name'] . '">';
	$link .= $img . $args['name'];
	$link .= '</a>';

	return $link;

} // agriflex_mn_title

/**
 * Replaces the default about to the Extension about
 *
 * @since  AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 *
 * @param string $about The unfiltered, default about information
 *
 * @return string $html The Extension about information
 */
function extension_about( $about ) {

	$html = '<h4>About</h4>';
	$html .= '<a href="http://www.youtube.com/watch?v=q_UsLHl_YDQ"><img src="' . get_template_directory_uri() . '/img/about_video.jpg?v=100" alt="link to Extension about video" /></a>';
	$html .= '<p>A unique education agency, the Texas A&amp;M AgriLife Extension Service teaches Texans wherever they live, extending research-based knowledge to benefit their families and communities.</p>';

	return $html;

} // extension_about

/**
 * Replaces the default links with Extension related links
 *
 * @since  AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 *
 * @param string $links The unfiltered, default popular links
 *
 * @return string $html The Extension popular links
 */
function extension_links( $links ) {

	$html = '<h4>Popular Links</h4>';
	$html .= '<a href="http://agrilifeextension.tamu.edu/"><img src="' . get_template_directory_uri() . '/img/agrilife_ext_logo.png?v=100" alt="Texas A&amp;M AgriLife Extension" /></a>	';
	$html .= '<ul>';
	$html .= '<li><a href="http://county-tx.tamu.edu/">County Extension Offices</a></li>';
	$html .= '<li><a href="http://agrilife.tamu.edu/locations-window/#centers">Research and Extension Centers</a></li>';
	$html .= '<li><a href="https://agrilifepeople.tamu.edu/">Contact Directory</a></li>';
	$html .= '<li><a href="http://today.agrilife.org/team/">Media Contacts</a></li>';
	$html .= '<li><a href="http://texas4-h.tamu.edu/">Texas 4-H and Youth Dev.</a></li>';
	$html .= '<li><a href="http://agrilifeextension.tamu.edu/about/strategyimpact/index.php">Strategic Plan and Impacts</a></li>';
	$html .= '<li class="last"><a href="https://greatjobs.tamu.edu">Employment Opportunities</a></li>';
	$html .= '</ul>';

	return $html;

} // extension_links

function hhhh_about( $about ) {

	$html = '<h4>About 4-H</h4>';
	$html .= '<a href="http://www.4-h.org/"><img src="' . get_bloginfo( 'template_directory' ) . '/img/about_4-h.jpg" alt="link to 4-H site" /></a>';
	$html .= '<p><a href="http://www.4-h.org/">4-H</a> is a positive youth development organization that empowers young people to reach their full potential.</p>';
	$html .= '<ul>';
	$html .= '<li><a href="http://texas4-h.tamu.edu/learn">Learn About 4-H</a></li>';
	$html .= '<li><a href="http://texas4-h.tamu.edu/scholarships">Scholarships</a></li>';
	$html .= '<li><a href="http://texas4-h.tamu.edu/enroll">Enroll</a></li>';
	$html .= '<li><a href="http://texas4-h.tamu.edu/districts">District Websites</a></li>';
	$html .= '<li><a href="http://texas4-h.tamu.edu/projects">Projects &amp; Programs</a></li>';
	$html .= '<li><a href="http://texas4-h.tamu.edu/roundup">Roundup</a></li>';
	$html .= '<li class="last"><a href="http://texas4-h.tamu.edu/contact">Contact Us</a></li>';
	$html .= '</ul>';

	return $html;

}
