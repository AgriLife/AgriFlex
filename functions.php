<?php
/**
 * AgriFlex functions and definitions
 *
 * @package AgriFlex
 */

define('MY_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
define('MY_THEME_FOLDER',str_replace("\\",'/',dirname(__FILE__)));
define('MY_THEME_PATH','/' . substr(MY_THEME_FOLDER,stripos(MY_THEME_FOLDER,'wp-content')));
    
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to
 * the width the theme is designed for, generally via the style.css stylesheet.
 *
 * @since AgriFlex 1.0
 */
if ( ! isset( $content_width ) )
  $content_width = 640;

/**
 * Tell WordPress to run agriflex_setup() when the 'after_setup_theme'
 * hook is run. 
 *
 * @since AgriFlex 1.0
 */
function agriflex_setup() {

  // Remove things that get stuck up in the doc head that we don't need
  remove_action( 'wp_head', 'wp_generator' );
  remove_action( 'wp_head', 'index_rel_link' );
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

  // Add support for post thumbnails
  add_theme_support( 'post-thumbnails' );

  // Add posts and comments RSS feed links to the head
  add_theme_support( 'automatic-feed-links' );

  // Add new image sizes
  add_image_size( 'featured', 965, 475, true );
  add_image_size( 'featured-2', 585, 305, true );
  add_image_size( 'featured-mediabox', 175, 124, true );    

  // Register the primary menu
  register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'agriflex' ),
  ) );
  
} // agriflex_setup
add_action( 'after_setup_theme', 'agriflex_setup' );

/**
 * Load/configure javascripts
 *
 * @since AgriFlex 1.0
 */
function load_js() {
 
  // instruction to only load if it is not the admin area
  if ( !is_admin() ) {

    // deregister swfobject js                                  
    wp_deregister_script('swfobject');

    // deregister l10n js              
    wp_deregister_script( 'l10n' );    

    // register jquery CDN                   
    wp_deregister_script('jquery');
    wp_register_script('jquery',
      ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"),
      false);         
    wp_enqueue_script('jquery');

    // enqueue the custom jquery js
    wp_enqueue_script('modernizr',
      get_template_directory_uri() . '/js/modernizr-2.6.min.js',
      array('jquery'),
      '2.6',
      false);
                 
    // enqueue the custom jquery js
    wp_register_script('my_scripts',
      get_template_directory_uri() . '/js/my_scripts.js',
      array('jquery'),
      '2.9.2',
      true);                
    wp_enqueue_script( 'my_scripts' );

    // enqueue fitvids
    wp_register_script( 'fitvids',
      get_template_directory_uri() . '/js/flex-bootstrap.js'
    );
    wp_enqueue_script( 'fitvids' );

  }             

} // load_js
add_action('init', 'load_js');

function agriflex_load_ie_styles() {

  echo '<!--[if lt IE 9]><link rel="stylesheet" type="text/css" media="all" href="' . get_template_directory_uri() . '/css/iefix.css?2" /><![endif]-->';

} // agriflex_load_styles
add_action( 'wp_enqueue_scripts', 'agriflex_load_ie_styles' );

/**
 * Use the Feedburner link if it exists
 *
 * @since 2.2.5
 * @param  string $output The link output
 * @param  string $feed   
 * @return string         The new feed link
 */
function agriflex_use_feedburner( $output, $feed ) {

  $url = of_get_option( 'feedburner' );

  if ( strpos( $output, 'comments' ) || empty( $url ) )
    return $output;


  return esc_url( $url );

}
add_action ( 'feed_link', 'agriflex_use_feedburner', 10, 2 );

/**
 * Disable some widgets that are replaced by theme funcitonality
 * or plugins
 *
 * @since AgriFlex 1.0
 */
function agriflex_remove_wp_widgets(){

  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Search');

} // agriflex_remove_wp_widgets
add_action('widgets_init', 'agriflex_remove_wp_widgets', 1);  

/**
 * Custom admin styles
 *
 * @since AgriFlex 1.0
 */
function agriflex_admin_register_head() {

  $siteurl = get_option('siteurl');

  $url = $siteurl .
    '/wp-content/themes/' .
    basename(dirname(__FILE__)) .
    '/css/admin.css';

  echo "<link rel='stylesheet' type='text/css' href='$url' />\n";

} // agriflex_admin_register_head
add_action('admin_head', 'agriflex_admin_register_head');

// Set path to function files
$include_path = TEMPLATEPATH . '/inc/';

require_once( $include_path . 'options/options-framework.php');

// Auto-include extensions
foreach ( glob( $include_path . "*.php" ) as $file ) {
  require_once( $file );
}
unset( $file );

// Auto-include all widget files
foreach ( glob( $include_path . "/widgets/*.php" ) as $file ) {
  require_once( $file );
}
unset( $file );

// Auto-include all custom agency files
foreach ( glob( $include_path . "/agency-custom/*.php" ) as $file ) {
  require_once( $file );
}
unset( $file );

// Add Logout Button to password-protected posts 
require_once ($include_path . 'logout-password-protected-posts/logout.php');

// Define location of Options Framework
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options/' );
