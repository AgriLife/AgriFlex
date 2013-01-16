<?php
/**
 * Actions, filters, and template tags for header.php
 *
 * @package AgriFlex
 */


/**
 * Register action hook: agriflex_head
 *
 * Located in header.php in the <head> section
 */
function agriflex_head() {

  do_action( 'agriflex_head' );

}

/**
 * Register action hook: agriflex_before_header
 *
 * Located in header.php after the opening body tag
 */
function agriflex_before_header() {

  do_action( 'agriflex_before_header' );

}

/**
 * Register action hook: agriflex_header
 *
 * Located in header.php just after the opening wrapper div
 */
function agriflex_header() {

  do_action( 'agriflex_header' );

}

/**
 * Register action hook: agriflex_after_header
 *
 * Located in header.php before the primary navigation
 */
function agriflex_after_header() {

  do_action( 'agriflex_after_header' );

}

add_action( 'agriflex_head', 'agriflex_return_map', 10 );
/**
 * Show location map if available
 * 
 * @since AgriFlex 2.0
 */
function agriflex_return_map() {

  GLOBAL $googlemap;

  if ( $googlemap ) echo $googlemap;

}

add_action( 'agriflex_head', 'agriflex_threaded_comments', 20 );
/**
 * We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 * 
 * @since AgriFlex 2.0
 */
function agriflex_threaded_comments() {

  if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

}


/**
 * Sets up the header actions in preparation for the minimal header
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
add_action( 'init', 'agriflex_remove_header_actions' );
function agriflex_remove_header_actions() {

  $min = of_get_option( 'minimal-header' );

  if ( $min ) {
    remove_all_actions( 'agriflex_before_header' );
    add_action( 'agriflex_before_header', 'agriflex_agency_nav_begin', 1 );
    add_action( 'agriflex_before_header', 'agriflex_minimal_header', 10 );
    add_action( 'agriflex_before_header', 'agriflex_agency_nav_end', 99 );
  }

}

/**
 * Inserts the minimal header if selected in theme settings
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @see agriflex_remove_header_actions()
 */
function agriflex_minimal_header() {

  $html = '<li class="top-agency fazd-item">';
  $html .= of_get_option( 'minimal-header-text' );
  $html .= '</li>';

  echo $html;

} // agriflex_minimal_header

add_action( 'agriflex_before_header', 'agriflex_agency_nav_begin', 1 );
/**
 * Displays the opening agency nav markup
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_agency_nav_begin() {

  $html = '<div id="drop-section-nav">';
  $html .= '<div id="drop-nav">';
  $html .= '<ul>';

  echo $html;

} // agriflex_agency_nav_begin

add_action( 'agriflex_before_header', 'agriflex_tfs_logo', 50 );
/**
 * Displays the TFS logo when selected
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_tfs_logo() {

  $agencies = of_get_option( 'agency-top' );

  if ( $agencies['fazd'] ) {
    $html = '<li class="top-agency tfs-item">';
    $html .= '<a href="http://txforestservice.tamu.edu/">';
    $html .= '<span class="top-level-hide">';
    $html .= 'Texas A&amp;M Forest Service';
    $html .= '</span>';
    $html .= '<img src="' . get_bloginfo( 'stylesheet_directory') . '/images/forest-branding.png" alt="Texas A&amp;M Forest Service Logo" />';
    $html .= '</a>';
    $html .= '</li>';

    echo $html;

  }

} // agriflex_tfs_logo

add_action( 'agriflex_before_header', 'agriflex_custom_logo', 70 );
/**
 * Displays the custom logo if available
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_custom_logo() {

  $logo = of_get_option( 'custom-agency-logo' );

  if ( $logo ) {
    $html = '<li class="custom-logo">';
    $html .= '<img src="' . $logo . '" />';
    $html .= '</li>';

    echo $html;
  }


} // agriflex_custom_logo

add_action( 'agriflex_before_header', 'agriflex_agency_nav_end', 99 );
/**
 * Displays the closing agency nav markup
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_agency_nav_end() {

  $html = '</ul>';
  $html .= '</div><!-- #drop-nav -->';
  $html .= '</div><!-- #drop-section-nav -->';

  echo $html;

} // agriflex_agency_nav_end

add_action( 'agriflex_header', 'agriflex_site_title', 30 );
/**
 * Shows the default site title style. Allows for filtering to make
 * custom site titles.
 *
 * Filter: agriflex_site_title
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_site_title() {

  $home_url = get_home_url( '/' );
  $blog_name = esc_attr( get_bloginfo( 'name', 'display' ) );

  $args = array(
    'url' => $home_url,
    'name' => $blog_name
  );

  $link = '<a href="' . $home_url . '" title="' . $blog_name . '">';
  $link .= $blog_name;
  $link .= '</a>';

  $link = apply_filters( 'agriflex_site_title', $link, $args );

  $html = '<div id="header">';
  $html .= '<header id="branding" role="banner">';
  $html .= '<hgroup>';
  $html .= '<h1 id="site-title">';
  $html .= $link;
  $html .= '</h1>';
  $html .= '<h2 id="site-description">';
  $html .= get_bloginfo( 'description' );
  $html .= '</h2>';
  $html .= '</hgroup>';
  $html .= get_search_form( false );    // false returns form as string
  $html .= '</header><!-- end #branding -->';
  $html .= '</div><!-- end #header -->';

  echo $html;

} // agriflex_site_title



add_filter( 'agriflex_site_title', 'agriflex_small_logo', 20, 2 );
function agriflex_small_logo( $link, $args ) {

  $style = of_get_option( 'site-title' );
  $logo = of_get_option( 'custom-site-logo' );

  if ( $style == 1 && ! empty( $logo ) ) {
    $img = '<img src="' . $logo . '" alt="' . $args['name'] . '" />';
    $display = $img . $args['name'];

    $link = '<a href="' . $args['url'] . '" ';
    $link .= 'title="' . $args['name'] . '">';
    $link .= $display;
    $link .= '</a>';
  
    return $link;
  }

  return $link;

} // agriflex_small_logo

add_filter( 'agriflex_site_title', 'agriflex_big_logo', 20, 2 );
function agriflex_big_logo( $link, $args ) {

  $style = of_get_option( 'site-title' );
  $logo = of_get_option( 'custom-site-logo' );

  if ( $style == 2 && ! empty( $logo ) ) {
    $img = '<img src="' . $logo . '" alt="' . $args['name'] . '" />';
    $display = $img . '<span class="full-img-text">' . $args['name'] . '</span>';

    $link = '<a href="' . $args['url'] . '" ';
    $link .= 'title="' . $args['name'] . '">';
    $link .= $display;
    $link .= '</a>';
  
    return $link;
  }

  return $link;

} // agriflex_big_logo

add_action( 'agriflex_after_header', 'agriflex_main_nav', 30 );
/**
 * Includes the main navigation
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since Agriflex 2.0
 */
function agriflex_main_nav() {

  echo '<div class="menu-button">Menu</div>';
  get_template_part( 'nav', 'primary' );

} // agriflex_main_nav
