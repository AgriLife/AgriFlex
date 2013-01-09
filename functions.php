<?php
/**
 * agriflex functions and definitions
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */

     define('MY_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
     define('MY_THEME_FOLDER',str_replace("\\",'/',dirname(__FILE__)));
     define('MY_THEME_PATH','/' . substr(MY_THEME_FOLDER,stripos(MY_THEME_FOLDER,'wp-content')));
    
	// Make some nice human-readable options for what template and features to use
	$options = get_option('AgrilifeOptions');
	$isresearch      = (is_array($options) ? $options['isResearch']      : true);
	$isextension     = (is_array($options) ? $options['isExtension'] : true);
	$iscollege      = (is_array($options) ? $options['isCollege']      : true);
	$istvmdl           = (is_array($options) ? $options['isTvmdl']      : true);
	$isfazd           = (is_array($options) ? $options['isFazd']      : true);
	$isextensiononly = ($isextension && !$isresearch && !$iscollege && !$istvmdl ? true : false);
	$isresearchonly = ($isresearch && !$isextension && !$iscollege && !$istvmdl ? true : false);
	$iscollegeonly = ($iscollege && !$isextension && !$isresearch && !$istvmdl ? true : false);
	$istvmdlonly = ($istvmdl && !$isextension && !$isresearch && !$iscollege && !$isfazd ? true : false);
	$isall = ($istvmdl && $isextension && $isresearch && $iscollege ? true : false);
	
	$typekitkey = 'thu0wyf';
  if($isextensiononly) :
       $isextension4h = $isextensioncounty = $isextensioncountytce = $isextensionmg = $isextensionmn = $isextensionsg = false;
       switch ($options['extension_type']) {
            case 0:
                 // Typical
                 break;
            case 1:
                 // 4-h
                 $isextension4h = true;
                 break;
            case 2:
                 // County
                 $isextensioncounty = true;
                 break;
            case 3:
                 // County TCE
                 $isextensioncountytce = true;
                 break;
            case 4:
                 // Master Gardener
                 $isextensionmg = true;
                 $typekitkey = 'vaf4fhz';
                 break;
            case 5:
                 // Master Naturalist
                 $isextensionmn = true;
                 $typekitkey = 'nqb0igu';
                 break;
            case 6:
                 // Sea Grant
                 $isextensionsg = true;
                 break;
       }
  endif;
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
     $content_width = 640;

/** Tell WordPress to run agriflex_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'agriflex_setup' );
function agriflex_setup() {

  global $typekitkey;

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
  
	// register Category_Widget widget
  add_action( 'widgets_init',
    create_function( '', 'register_widget( "category_widget" );' ) );
    
}    

// @todo - Move this to separate file
/* -- Add typekit js and css to document head -- */
add_action('wp_head','typekit_js');
function typekit_js() {
global $typekitkey;
if( !is_admin() ) : ?>
<script type="text/javascript" src="http://use.typekit.com/<?php echo $typekitkey ?>.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<style type="text/css">
.wf-loading #site-title,
.wf-loading .entry-title {
/* Hide the blog title and post titles while web fonts are loading */
visibility: hidden;
}
</style>                        
<?php
  endif;
}

/**
 * Load/configure javascripts
 *
 * @since AgriFlex 1.0
 */
add_action('init', 'load_js');    
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
      get_bloginfo('template_directory') . '/js/modernizr-2.6.min.js',
      array('jquery'),
      '2.6',
      false);
                 
    // enqueue the custom jquery js
    wp_enqueue_script('my_scripts',
      get_bloginfo('template_directory') . '/js/my_scripts.js',
      array('jquery'),
      '2.9.2',
      true);                

  }             
}   

/**
 * Disable some widgets that are replaced by theme funcitonality
 * or plugins
 *
 * @since AgriFlex 1.0
 */
add_action('widgets_init', 'remove_some_wp_widgets', 1);  
function remove_some_wp_widgets(){

  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Search');

}

/**
 * Custom admin styles
 *
 * @since AgriFlex 1.0
 */
add_action('admin_head', 'agriflex_admin_register_head');
function agriflex_admin_register_head() {

  $siteurl = get_option('siteurl');

  $url = $siteurl .
    '/wp-content/themes/' .
    basename(dirname(__FILE__)) .
    '/css/admin.css';

  echo "<link rel='stylesheet' type='text/css' href='$url' />\n";

} // agriflex_admin_register_head


/** 
 * Obfuscates email addresses
 *
 * @since AgriFlex 1.0
 * @param string $email Email to obfuscate
 * @return string $link Obfuscated email
 */
function obfuscate($email){

     $link = '';

     foreach( str_split( $email ) as $letter ) {
       $link .= '&#' . ord( $letter ) . ';';
     }

     return $link;
} // obfuscate

// Set path to function files
$includes_path = TEMPLATEPATH . '/includes/';
$include_path = TEMPLATEPATH . '/inc/';

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

// Admin Pages
require_once ($includes_path . 'admin.php');

// Auto-configure plugins
require_once ($includes_path . 'plugin-config.php');

// Add Logout Button to password-protected posts 
require_once ($include_path . 'logout-password-protected-posts/logout.php');

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options/' );

// Add the options library
require_once( $include_path . 'options/options-framework.php');
$options = of_get_option();

function agriflex_agency() {

  $agencies = of_get_option( 'agency-top' );
  $ext_type = of_get_option( 'ext-type' );
  $val = array_count_values( $agencies );

  $active = array();

  // Add the active agency slugs to the $active array
  foreach ( $agencies as $k => $v ) {
    if ( $v == 1 )
      array_push( $active, $k );
  }
  
  // If there's only one active agency, return true
  if ( $val[1] == 1 ) {
    $only = TRUE;
  }

  // Build the return payload
  $return = array(
    'agencies' => $active,
    'single'   => $only,
    'ext-type' => $ext_type
  );
  print_r($return);

  return $return;

} // agriflex_agency

// Conditional inclusion based on agriflex_agency()
$a = agriflex_agency();
$custom = $include_path . '/agency-custom/';

if ( ! $a['single'] ) {
  print_r('Multiple Agencies');
} elseif ( $a['ext-type'] == 'mg' ) { 
  require_once( $custom . 'txmg.php' );
} elseif ( $a['ext-type'] == 'mn' ) { 
  require_once( $custom . 'txmn.php' );
} elseif ( in_array( 'extension', $a['agencies'] ) ) {
  require_once( $custom . 'extension.php' );
} elseif ( in_array( 'research', $a['agencies'] ) ) {
  require_once( $custom . 'research.php' );
} elseif ( in_array( 'college', $a['agencies'] ) ) {
  require_once( $custom . 'college.php' );
} elseif ( in_array( 'tvmdl', $a['agencies'] ) ) {
  require_once( $custom . 'tvmdl.php' );
} elseif ( in_array( 'tfs', $a['agencies'] ) ) {
  // Include tfs.php
}
