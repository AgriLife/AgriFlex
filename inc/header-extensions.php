<?php
/**
 * Actions, filters, and template tags for header.php
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
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
 * @author J. Aaron Eaton <aaron@channeleaton.com>
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
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 */
function agriflex_threaded_comments() {

  if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

}

add_action( 'agriflex_before_header', 'agriflex_agency_nav', 10 );
/**
 * Pull in the agency navigation template part
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 */
function agriflex_agency_nav() {

  get_template_part( 'nav', 'agency' );

} // agriflex_agency_nav

add_action( 'agriflex_before_header', 'agriflex_college_drop_down', 20 );
/**
 * College specific content for drop-down
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 */
function agriflex_college_drop_down() {

  GLOBAL $iscollegeonly;

  if ( $iscollegeonly ) {
    // instead of writing HTML here, lets do an include
    include( __FILE__ . '/college-drop-down.php');
  }

}

add_action( 'agriflex_header', 'agriflex_site_title', 30 );
/**
 * Determines which header to show then echos it
 *
 * Filter: agriflex_site_title
 *
 * @todo - Move agency logic to consolidated area
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @return void
 */
function agriflex_site_title() {

  GLOBAL $options;

  GLOBAL $isextensioncounty,
    $isextensioncountytce,
    $isextensionmg,
    $isextensionmn;

  $home_url = get_home_url( '/' );
  $blog_name = esc_attr( get_bloginfo( 'name', 'display' ) );
  
  if ( $isextensioncounty || $isextensioncountytce ) {
    $display = '<span>Extension Education</span> <em>in ' . 
               $options['county-name-human'] .
               ' County</em>';

  } elseif ( $isextensionmg ) {
    $src = get_bloginfo( 'stylesheet_directory' ) . '/img/txmg-logo80.gif';
    $img = '<img src="' . $src . '" alt="' . $blog_name . '" />';

    $display = $img . $blog_name;
    
  } elseif ( $isextensionmn ) {
    $src = get_bloginfo( 'stylesheet_directory' ) . '/img/txmn-logo.png';
    $img = '<img src="' . $src . '" alt="' . $blog_name . '" />';

    $display = $img . $blog_name;

  } else {
  
    if ( $options['header_type'] == 1 && $options['titleImg'] <> '' ) {
      $src = $options['titleImg'];
      $img = '<img src="' . $src . '" alt="' . $blog_name . '" />';

      $display = $img . $blog_name;

    } elseif ( $options['header_type'] == 2 ) {
      $src = $options['titleImg'];
      $img = '<img src="' . $src . '" alt="' . $blog_name . '" />';

      $display = $img . '<span class="full-img-text">' . $blog_name . '</span>';

    } else {
      $display = $blog_name;
    }
  
  }

  $link = '<a href="' . $home_url . '" 
    title="' . $blog_name . '" >' . 
    $display . '</a>';

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

  echo apply_filters( 'agriflex_site_title', $html );

}

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
