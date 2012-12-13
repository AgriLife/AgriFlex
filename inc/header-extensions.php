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

add_action( 'agriflex_before_header', 'agriflex_agency_nav_begin', 1 );
/**
 * Pull in the agency navigation template part
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 */
function agriflex_agency_nav_begin() {

  $html .= '<div id="drop-section-nav">';
  $html .= '<div id="drop-nav">';
  $html .= '<ul>';

  echo $html;

} // agriflex_agency_nav_begin

//add_action( 'agriflex_before_header', 'agriflex_agency_logos', 10 );
function agriflex_agency_logos() {

  $html .= apply_filters( 'agriflex_logo_filter', $html );

  echo $html;

} // agriflex_agency_logos

add_action( 'agriflex_before_header', 'agriflex_college_logo', 10 );
function agriflex_college_logo() {

  $agencies = of_get_option( 'agency-top' );
  $val = array_count_values( $agencies );

  if ( $agencies['college'] == 1 ) {
    $html = '<li class="top-agency college-item">';
    $html .= '<a href="http://aglifesciences.tamu.edu/">';
    $html .= '<span class="top-level-hide">';
    $html .= 'Texas A&amp;M College of Agriculture and Life Sciences';
    $html .= '</span>';
    $html .= '<img src="' . get_bloginfo( 'stylesheet_directory') . '/images/college-branding.png" alt="Texas A&amp;M College Logo" />';
    $html .= '</a>';
    $html .= '</li>';

    // If college only, show 'Explore' menu
    if ( $val[1] == 1 ) {
      $html .= '<li class="explore right-align">';
      $html .= '<a class="ext-link college-explore-link" href="/explore/">';
      $html .= 'Explore';
      $html .= '</a>';
      $html .= '</li>';
    }

  }

  echo $html;

} // agriflex_college_logo

add_action( 'agriflex_before_header', 'agriflex_ext_logo', 20 );
function agriflex_ext_logo() {

  $agencies = of_get_option( 'agency-top' );

  if ( $agencies['extension'] == 1 ) {
    $html = '<li class="top-agency tx-ext-item">';
    $html .= '<a href="http://agrilifeextension.tamu.edu/">';
    $html .= '<span class="top-level-hide">';
    $html .= 'Texas A&amp;M AgriLife Extension Service';
    $html .= '</span>';
    $html .= '<img src="' . get_bloginfo( 'stylesheet_directory') . '/images/extension-branding.png" alt="Texas A&amp;M Extension Logo" />';
    $html .= '</a>';
    $html .= '</li>';
  }

  echo $html;

} // agriflex_ext_logo

add_action( 'agriflex_before_header', 'agriflex_res_logo', 30 );
function agriflex_res_logo() {

  $agencies = of_get_option( 'agency-top' );

  if ( $agencies['research'] == 1 ) {
    $html = '<li class="top-agency research-item">';
    $html .= '<a href="http://agriliferesearch.tamu.edu/">';
    $html .= '<span class="top-level-hide">';
    $html .= 'Texas A&amp;M AgriLife Research';
    $html .= '</span>';
    $html .= '<img src="' . get_bloginfo( 'stylesheet_directory') . '/images/research-branding.png" alt="Texas A&amp;M Research Logo" />';
    $html .= '</a>';
    $html .= '</li>';
  }

  echo $html;

} // agriflex_res_logo

add_action( 'agriflex_before_header', 'agriflex_tvmdl_logo', 40 );
function agriflex_tvmdl_logo() {

  $agencies = of_get_option( 'agency-top' );
  $val = array_count_values( $agencies );

  if ( $agencies['tvmdl'] == 1 ) {
    $html = '<li class="top-agency tvmdl-item">';
    $html .= '<a href="http://tvmdl.tamu.edu/">';
    $html .= '<span class="top-level-hide">';
    $html .= 'Texas A&amp;M Veterinary Medical Diagnostics Laboratory';
    $html .= '</span>';
    $html .= '<img src="' . get_bloginfo( 'stylesheet_directory') . '/images/tvmdl-branding.png" alt="Texas A&amp;M Research Logo" />';
    $html .= '</a>';
    $html .= '</li>';

    // Show client login if TVMDL only
    if ( $val[1] == 1) {
      $html .= '<li class="right-align client-login-li">';
      $html .= '<a class="client-login" href="https://tvmdl.tamu.edu/webaccess/">';
      $html .= 'Client Login';
      $html .= '</a>';
      $html .= '</li>';
    }

  }

  echo $html;

} // agriflex_tvmdl_logo

add_action( 'agriflex_before_header', 'agriflex_tfs_logo', 40 );
function agriflex_tfs_logo() {

  $agencies = of_get_option( 'agency-top' );

  if ( $agencies['tfs'] == 1 ) {
    $html = '<li class="top-agency tfs-item">';
    $html .= '<a href="http://txforestservice.tamu.edu/">';
    $html .= '<span class="top-level-hide">';
    $html .= 'Texas A&amp;M Forest Service';
    $html .= '</span>';
    $html .= '<img src="' . get_bloginfo( 'stylesheet_directory') . '/images/forest-branding.png" alt="Texas A&amp;M Forest Service Logo" />';
    $html .= '</a>';
    $html .= '</li>';
  }

  echo $html;

} // agriflex_tfs_logo

add_action( 'agriflex_before_header', 'agriflex_tpwd_logo', 60 );
function agriflex_tpwd_logo() {

  $ext_type = of_get_option( 'ext-type' );

  if ( $ext_type == 'mn' ) {
    $html = '<li class="top-agency txmn-item">';
    $html .= '<a href="http://www.tpwd.state.tx.us/">';
    $html .= 'Texas Parks &amp; Wildlife';
    $html .= '</a>';
    $html .= '</li>';
  }

  echo $html;

} // agriflex_tpwd_logo

add_action( 'agriflex_before_header', 'agriflex_sg_logo', 60 );
function agriflex_sg_logo() {

  $ext_type = of_get_option( 'ext-type' );

  if ( $ext_type == 'sg' ) {
    $html = '<li class="top-agency sg-item">';
    $html .= '<a href="http://texas-sea-grant.tamu.edu/">';
    $html .= 'Texas Sea Grant';
    $html .= '</a>';
    $html .= '</li>';
  }

  echo $html;

} // agriflex_sg_logo

add_action( 'agriflex_before_header', 'agriflex_custom_logo', 70 );
function agriflex_custom_logo() {

  $logo = of_get_option( 'custom-agency-logo' );

  if ( $logo ) {
    $html = '<li class="custom-logo">';
    $html .= '<img src="' . $logo . '" />';
    $html .= '</li>';
  }

  echo $html;

} // agriflex_custom_logo


add_action( 'agriflex_before_header', 'agriflex_agency_nav_end', 99 );
function agriflex_agency_nav_end() {

  $html .= '</ul>';
  $html .= '</div><!-- #drop-nav -->';
  $html .= '</div><!-- #drop-section-nav -->';

  echo $html;

} // agriflex_agency_nav_end

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
    include( __FILE__ . '/college/college-drop-down.php');
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
