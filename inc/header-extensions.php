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
 *
 * @since AgriFlex 2.0
 */
function agriflex_head() {

  do_action( 'agriflex_head' );

}

/**
 * Register action hook: agriflex_before_header
 *
 * Located in header.php after the opening body tag
 *
 * @since AgriFlex 2.0
 */
function agriflex_before_header() {

  do_action( 'agriflex_before_header' );

}

/**
 * Register action hook: agriflex_header
 *
 * Located in header.php just after the opening wrapper div
 *
 * @since AgriFlex 2.0
 */
function agriflex_header() {

  do_action( 'agriflex_header' );

}

/**
 * Register action hook: agriflex_after_header
 *
 * Located in header.php before the primary navigation
 *
 * @since AgriFlex 2.0
 */
function agriflex_after_header() {

  do_action( 'agriflex_after_header' );

}

/**
 * Show location map if available
 *
 * @since AgriFlex 2.0
 */
function agriflex_return_map() {

  GLOBAL $googlemap;

  if ( $googlemap ) echo $googlemap;

} // agriflex_return_map
add_action( 'agriflex_head', 'agriflex_return_map', 10 );

/**
 * Load the favicon
 *
 * @since AgriFlex 2.3
 */
function agriflex_favicon() {

  echo '<link rel="shortcut icon" href="' . AF2_THEME_DIRURL . '/img/favicon.ico" type="image/ico" />';

}
add_action( 'agriflex_head', 'agriflex_favicon', 5 );

/**
 * We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 *
 * @since AgriFlex 2.0
 */
function agriflex_threaded_comments() {

  if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

} // agriflex_threaded_comments
add_action( 'agriflex_head', 'agriflex_threaded_comments', 20 );

/**
 * Sets up the header actions in preparation for the minimal header
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_remove_header_actions() {

  $min = of_get_option( 'minimal-header' );
  $a = agriflex_agency();

  if ( $min ) {
    remove_all_actions( 'agriflex_before_header' );
    add_action( 'agriflex_before_header', 'agriflex_agency_nav_begin', 1 );
    add_action( 'agriflex_before_header', 'agriflex_minimal_header', 10 );
    add_action( 'agriflex_before_header', 'agriflex_agency_nav_end', 99 );
  }

} // agriflex_remove_header_actions
add_action( 'init', 'agriflex_remove_header_actions' );

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
add_action( 'agriflex_before_header', 'agriflex_agency_nav_begin', 1 );

/**
 * Displays the TFS logo when selected
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_tfs_logo() {

  $agencies = of_get_option( 'agency-top' );

  if ( $agencies['tfs'] ) {
    $html = '<li class="top-agency tfs-item">';
    $html .= '<a href="http://txforestservice.tamu.edu/">';
    $html .= '<span class="top-level-hide">';
    $html .= 'Texas A&amp;M Forest Service';
    $html .= '</span>';
//    $html .= '<img src="' . get_template_directory_uri() . '/img/forest-branding.png" alt="Texas A&amp;M Forest Service Logo" />';
    $html .= '</a>';
    $html .= '</li>';

    echo $html;

  }

} // agriflex_tfs_logo
add_action( 'agriflex_before_header', 'agriflex_tfs_logo', 50 );

/**
 * Displays the custom agency logo if available
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_custom_logo() {

  $logo = of_get_option( 'custom-agency-logo' );
  $url = of_get_option( 'custom-agency-link' );

  if ( $logo ) {
    $html = '<li class="top-agency custom-logo">';
    $html .= '<a href="' . $url . '">';
    $html .= '<span class="top-level-hide"></span>';
    $html .= '<img src="' . $logo . '" />';
    $html .= '</a>';
    $html .= '</li>';

    echo $html;
  }

} // agriflex_custom_logo
add_action( 'agriflex_before_header', 'agriflex_custom_logo', 70 );

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
add_action( 'agriflex_before_header', 'agriflex_agency_nav_end', 99 );

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

  $home_url = get_home_url();
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
add_action( 'agriflex_header', 'agriflex_site_title', 30 );

/**
 * Displays the site title containing a small logo and title
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param  string $link The default site title
 * @param  array  $args The site url and name
 * @return string $link The new site title
 */
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
add_filter( 'agriflex_site_title', 'agriflex_small_logo', 20, 2 );

/**
 * Displays the site title only a large image
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @param  string $link The default site title
 * @param  array  $args The site url and name
 * @return string $link The new site title
 */
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
add_filter( 'agriflex_site_title', 'agriflex_big_logo', 20, 2 );

/**
 * Includes the main navigation
 *
 * @since Agriflex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function agriflex_main_nav() {

  echo '<div class="menu-button" id="menu-button">Menu</div>';
  get_template_part( 'nav', 'primary' );

} // agriflex_main_nav
add_action( 'agriflex_after_header', 'agriflex_main_nav', 30 );
