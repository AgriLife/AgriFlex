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
print_r($options);

function agriflex_county_listing( $id = 0 ) {

  $counties = array(
    0 => '',
    1 => 'Anderson',
    3 => 'Andrews',
    5 => 'Angelina',
    7 => 'Aransas',
    9 => 'Archer',
    11 => 'Armstrong',
    13 => 'Atascosa',
    15 => 'Austin',
    17 => 'Bailey',
    19 => 'Bandera',
    21 => 'Bastrop',
    23 => 'Baylor',
    25 => 'Bee',
    27 => 'Bell',
    29 => 'Bexar',
    31 => 'Blanco',
    33 => 'Borden',
    35 => 'Bosque',
    37 => 'Bowie',
    39 => 'Brazoria',
    41 => 'Brazos',
    43 => 'Brewster',
    45 => 'Briscoe',
    47 => 'Brooks',
    49 => 'Brown',
    51 => 'Burleson',
    53 => 'Burnet',
    55 => 'Caldwell',
    57 => 'Calhoun',
    59 => 'Callahan',
    61 => 'Cameron',
    63 => 'Camp',
    65 => 'Carson',
    67 => 'Cass',
    69 => 'Castro',
    71 => 'Chambers',
    73 => 'Cherokee',
    75 => 'Childress',
    77 => 'Clay',
    79 => 'Cochran',
    81 => 'Coke',
    83 => 'Coleman',
    85 => 'Collin',
    87 => 'Collingsworth',
    89 => 'Colorado',
    91 => 'Comal',
    93 => 'Comanche',
    95 => 'Concho',
    97 => 'Cooke',
    99 => 'Coryell',
    101 => 'Cottle',
    103 => 'Crane',
    105 => 'Crockett',
    107 => 'Crosby',
    109 => 'Culberson',
    111 => 'Dallam',
    113 => 'Dallas',
    115 => 'Dawson',
    117 => 'Deaf Smith',
    119 => 'Delta',
    121 => 'Denton',
    123 => 'DeWitt',
    125 => 'Dickens',
    127 => 'Dimmit',
    129 => 'Donley',
    131 => 'Duval',
    133 => 'Eastland',
    135 => 'Ector',
    137 => 'Edwards',
    139 => 'Ellis',
    141 => 'El Paso',
    143 => 'Erath',
    145 => 'Falls',
    147 => 'Fannin',
    149 => 'Fayette',
    151 => 'Fisher',
    153 => 'Floyd',
    155 => 'Foard',
    157 => 'Fort Bend',
    159 => 'Franklin',
    161 => 'Freestone',
    163 => 'Frio',
    165 => 'Gaines',
    167 => 'Galveston',
    169 => 'Garza',
    171 => 'Gillespie',
    173 => 'Glasscock',
    175 => 'Goliad',
    177 => 'Gonzales',
    179 => 'Gray',
    181 => 'Grayson',
    183 => 'Gregg',
    185 => 'Grimes',
    187 => 'Guadalupe',
    189 => 'Hale',
    191 => 'Hall',
    193 => 'Hamilton',
    195 => 'Hansford',
    197 => 'Hardeman',
    199 => 'Hardin',
    201 => 'Harris',
    203 => 'Harrison',
    205 => 'Hartley',
    207 => 'Haskell',
    209 => 'Hays',
    211 => 'Hemphill',
    213 => 'Henderson',
    215 => 'Hidalgo',
    217 => 'Hill',
    219 => 'Hockley',
    221 => 'Hood',
    223 => 'Hopkins',
    225 => 'Houston',
    227 => 'Howard',
    229 => 'Hudspeth',
    231 => 'Hunt',
    233 => 'Hutchinson',
    235 => 'Irion',
    237 => 'Jack',
    239 => 'Jackson',
    241 => 'Jasper',
    243 => 'Jeff Davis',
    245 => 'Jefferson',
    247 => 'Jim Hogg',
    249 => 'Jim Wells',
    251 => 'Johnson',
    253 => 'Jones',
    255 => 'Karnes',
    257 => 'Kaufman',
    259 => 'Kendall',
    // 261 => 'Kenedy',
    263 => 'Kent',
    265 => 'Kerr',
    267 => 'Kimble',
    269 => 'King',
    271 => 'Kinney',
    273 => 'Kleberg County & Kenedy',
    275 => 'Knox',
    277 => 'Lamar',
    279 => 'Lamb',
    281 => 'Lampasas',
    283 => 'La Salle',
    285 => 'Lavaca',
    287 => 'Lee',
    289 => 'Leon',
    291 => 'Liberty',
    293 => 'Limestone',
    295 => 'Lipscomb',
    297 => 'Live Oak',
    299 => 'Llano',
    301 => 'Loving',
    303 => 'Lubbock',
    305 => 'Lynn',
    307 => 'McCulloch',
    309 => 'McLennan',
    311 => 'McMullen',
    313 => 'Madison',
    315 => 'Marion',
    317 => 'Martin',
    319 => 'Mason',
    321 => 'Matagorda',
    323 => 'Maverick',
    325 => 'Medina',
    327 => 'Menard',
    329 => 'Midland',
    331 => 'Milam',
    333 => 'Mills',
    335 => 'Mitchell',
    337 => 'Montague',
    339 => 'Montgomery',
    341 => 'Moore',
    343 => 'Morris',
    345 => 'Motley',
    347 => 'Nacogdoches',
    349 => 'Navarro',
    351 => 'Newton',
    353 => 'Nolan',
    355 => 'Nueces',
    357 => 'Ochiltree',
    359 => 'Oldham',
    361 => 'Orange',
    363 => 'Palo Pinto',
    365 => 'Panola',
    367 => 'Parker',
    369 => 'Parmer',
    371 => 'Pecos',
    373 => 'Polk',
    375 => 'Potter',
    377 => 'Presidio',
    379 => 'Rains',
    381 => 'Randall',
    383 => 'Reagan',
    385 => 'Real',
    387 => 'Red River',
    389 => 'Reeves',
    391 => 'Refugio',
    393 => 'Roberts',
    395 => 'Robertson',
    397 => 'Rockwall',
    399 => 'Runnels',
    401 => 'Rusk',
    403 => 'Sabine',
    405 => 'San Augustine',
    407 => 'San Jacinto',
    409 => 'San Patricio',
    411 => 'San Saba',
    413 => 'Schleicher',
    415 => 'Scurry',
    417 => 'Shackelford',
    419 => 'Shelby',
    421 => 'Sherman',
    423 => 'Smith',
    425 => 'Somervell',
    427 => 'Starr',
    429 => 'Stephens',
    431 => 'Sterling',
    433 => 'Stonewall',
    435 => 'Sutton',
    437 => 'Swisher',
    439 => 'Tarrant',
    441 => 'Taylor',
    443 => 'Terrell',
    445 => 'Terry',
    447 => 'Throckmorton',
    449 => 'Titus',
    451 => 'Tom Green',
    453 => 'Travis',
    455 => 'Trinity',
    457 => 'Tyler',
    459 => 'Upshur',
    461 => 'Upton',
    463 => 'Uvalde',
    465 => 'Val Verde',
    467 => 'Van Zandt',
    469 => 'Victoria',
    471 => 'Walker',
    473 => 'Waller',
    475 => 'Ward',
    477 => 'Washington',
    479 => 'Webb',
    481 => 'Wharton',
    483 => 'Wheeler',
    485 => 'Wichita',
    487 => 'Wilbarger',
    489 => 'Willacy',
    491 => 'Williamson',
    493 => 'Wilson',
    495 => 'Winkler',
    497 => 'Wise',
    499 => 'Wood',
    501 => 'Yoakum',
    503 => 'Young',
    505 => 'Zapata',
    507 => 'Zavala'
  );

  if ( $id != 0 ) {
    return $counties[$id];
  } else {
    return $counties;
  }

}
