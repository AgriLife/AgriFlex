<?php
/**
 * county_ext functions and definitions
 *
 * @package WordPress
 * @subpackage county_ext
 * @since county_ext 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run county_ext_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'county_ext_setup' );

if ( ! function_exists( 'county_ext_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override county_ext_setup() in a child theme, add your own county_ext_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since county_ext 1.0
 */
function county_ext_setup() {

	add_action( 'wp_print_styles', 'add_ie_style_sheet', 200 );
	function add_ie_style_sheet() {
	    wp_enqueue_style( 'ie7', get_bloginfo('stylesheet_directory') . '/css/ie.css', array(), '1.0' );
	}
 
	add_filter( 'style_loader_tag', 'make_ie_style_sheet_conditional', 10, 2 );
	/**
	 * Add conditional comments around IE style sheet.
	 *
	 * @param string $tag Existing style sheet tag
	 * @param string $handle Name of the enqueued style sheet
	 * @return string Amended markup
	 */
	function make_ie_style_sheet_conditional( $tag, $handle ) {
	    if ( 'ie7' == $handle )
	        $tag = '<!--[if lte IE 7]>' . "\n" . $tag . '<![endif]-->' . "\n";
	    return $tag;
	}

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	// Add new image sizes
	add_image_size('featured',960,9999);
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'county_ext', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'county_ext' ),
	) );

	/* -- Add typekit js and css to document head -- */
	add_action('wp_head','typekit_js');
		function typekit_js() { 
			if( !is_admin() ) : ?>
	<script type="text/javascript" src="http://use.typekit.com/thu0wyf.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>	
	<style type="text/css">
	  .wf-loading h1#site-title,
	  .wf-loading .entry-title {
	    /* Hide the blog title and post titles while web fonts are loading */
	    visibility: hidden;
	  }
	</style>				
	<?php
	endif; 
	}	

	// load Slideshow scripts
	function load_js() {
	        // instruction to only load if it is not the admin area
		if ( !is_admin() ) {
			 
		// deregister swfobject js							
		wp_deregister_script('swfobject');
		
		// deregister l10n js			
		wp_deregister_script( 'l10n' );	
			
		// register jquery CDN				
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"), false);		
	   	wp_enqueue_script('jquery');
					
		// register script location with wp_register_script	
	   	wp_register_script('my_jquery',
	       	get_bloginfo('stylesheet_directory') . '/js/my_jquery.js');	
	       // enqueue the custom jquery js
	   	wp_enqueue_script('my_jquery');	       
		}	         
	}    
	add_action('init', 'load_js');	


	// Disable some widgets so people don't go apeshit
	function remove_some_wp_widgets(){
	  unregister_widget('WP_Widget_Calendar');
	  unregister_widget('WP_Widget_Search');
	  unregister_widget('WP_Widget_Tag_Cloud');
	}

	add_action('widgets_init',remove_some_wp_widgets, 1);	


	// Custom admin styles
	function admin_register_head() {
	    $siteurl = get_option('siteurl');
	    $url = $siteurl . '/wp-content/themes/' . basename(dirname(__FILE__)) . '/css/admin.css';
	    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
	}
	add_action('admin_head', 'admin_register_head');
		
}	
endif;


/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since county_ext 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function county_ext_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'county_ext' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'county_ext' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'county_ext' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'county_ext_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since county_ext 1.0
 */
function county_ext_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'county_ext_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since county_ext 1.0
 * @return int
 */
function county_ext_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'county_ext_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since county_ext 1.0
 * @return string "Continue Reading" link
 */
function county_ext_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue <span class="meta-nav">&rarr;</span>', 'county_ext' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and county_ext_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since county_ext 1.0
 * @return string An ellipsis
 */
function county_ext_auto_excerpt_more( $more ) {
	return ' &hellip;' . county_ext_continue_reading_link();
}
add_filter( 'excerpt_more', 'county_ext_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since county_ext 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function county_ext_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= county_ext_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'county_ext_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since county_ext 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function county_ext_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'county_ext_remove_gallery_css' );

if ( ! function_exists( 'county_ext_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own county_ext_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since county_ext 1.0
 */
function county_ext_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'county_ext' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'county_ext' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'county_ext' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'county_ext' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'county_ext' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'county_ext'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

// Custom search 
add_filter('get_search_form', 'custom_search_form');
function custom_search_form() {

	$search_text = get_search_query() ? esc_attr( apply_filters( 'the_search_query', get_search_query() ) ) : apply_filters('county_ext_search_text', esc_attr__('Search', 'county_ext'));
	$button_text = apply_filters( 'county_ext_search_button_text', esc_attr__( 'Go', 'county_ext' ) );

	$onfocus = " onfocus=\"if (this.value == '$search_text') {this.value = '';}\"";
	$onblur = " onblur=\"if (this.value == '') {this.value = '$search_text';}\"";

	$form = '
		<form method="get" class="searchform" action="' . get_option('home') . '/" >
			<input type="text" value="'. $search_text .'" name="s" class="s"'. $onfocus . $onblur .' />
			<input type="submit" class="searchsubmit" value="'. $button_text .'" />
		</form>
	';

	return apply_filters('custom_search_form', $form, $search_text, $button_text);
}

/**
 * Register widgetized areas, including two sidebars and four widget-ready areas in the sidebar.
 *
 * To override county_ext_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
function county_ext_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Right Column', 'county_ext' ),
		'id' => 'right-column-widget-area',
		'description' => __( 'The right column area', 'county_ext' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located in the second sidebar.
	register_sidebar( array(
		'name' => __( 'Right Column Bottom', 'county_ext' ),
		'id' => 'right-column-bottom-widget-area',
		'description' => __( 'The right column bottom widget area', 'county_ext' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3
	register_sidebar( array(
		'name' => __( 'Home Page Bottom', 'county_ext' ),
		'id' => 'home-middle-1',
		'description' => __( 'Home Middle #1', 'county_ext' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
	// Area 4, located in the sidebar.
	register_sidebar( array(
		'name' => __( 'Sidebar Navigation', 'county_ext' ),
		'id' => 'sidebar-widget-navigation',
		'description' => __( 'Sidebar Navigation', 'county_ext' ),
		'before_title' => '<h3 class="widget-title"><a>',
		'after_title' => '</a></h3>',
	) );	
}

/** Register sidebars by running county_ext_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'county_ext_widgets_init' );



/**
 * Add some custom Widgets
 *
 * Widget: Watch, Read, Listen
 * Widget: AgriLife Today Feed
 *
 */
// Set path to function files
$includes_path = TEMPLATEPATH . '/includes/';

// Add Custom Widgets
require_once ($includes_path . 'widgets.php');




/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 */
function county_ext_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'county_ext_remove_recent_comments_style' );

if ( ! function_exists( 'county_ext_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since county_ext 1.0
 */
function county_ext_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'county_ext' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'county_ext' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'county_ext_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function county_ext_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'county_ext' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'county_ext' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'county_ext' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


// Admin Menus
// -----------------------------------------------------------------------------
// make the options user-selectable

/* put stuff on pages and init-frontend */
if (!class_exists("AgriLifeCounties")) {
  
  class AgriLifeCounties {
	var $adminOptionsName = "AgrilifeCountyOptions";
	public $countyArray = array(
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
		261 => 'Kenedy',
		263 => 'Kent',
		265 => 'Kerr',
		267 => 'Kimble',
		269 => 'King',
		271 => 'Kinney',
		273 => 'Kleberg',
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
		507 => 'Zavala');

	function AgriLifeCounties() { //constructor
	  
	} // End Constructor
	function init() {
		$this->getAdminOptions();
	}
	//Returns an array of admin options
	function getAdminOptions() {
		$agrilifeAdminOptions = array(
			'county-name' => '',
			'county-name-human' => '',
			'address-street1' => '',
			'address-street2' => '',
			'address-city' => '',
			'address-zip' => '',
			
			'address-mail-street1' => '',
			'address-mail-street2' => '',
			'address-mail-city' => '',
			'address-mail-zip' => '',
			
			'phone' => '',
			'fax' =>'',
			
			'feedBurner' => '',
			'googleAnalytics' => '');
		$agrilifeCountyOptions = get_option($this->adminOptionsName);
		if (!empty($agrilifeCountyOptions)) {
			foreach ($agrilifeCountyOptions as $key => $option)
				$agrilifeAdminOptions[$key] = $option;
		}				
		update_option($this->adminOptionsName, $agrilifeAdminOptions);
		return $agrilifeAdminOptions;
	}


	function set_defaults() {
	
	  $options = get_option('AgrilifeCountyOptions');
	  
	  //County Name Default
	  $options['county-name'] = '';
	  $options['county-name-human'] = '';
	  
	  //Address Defaults
	  $options['address-street1'] = '';
	  $options['address-street2'] = '';
	  $options['address-city'] = '';
	  $options['address-zip'] = '';

	  $options['address-mail-street1'] = '';
	  $options['address-mail-street2'] = '';
	  $options['address-mail-city'] = '';
	  $options['address-mail-zip'] = '';
	  
	  $options['phone'] = '';
	  $options['fax'] = '';
	
	  //Set Google Defaults
	  $options['feedBurner'] = '';
	  $options['googleAnalytics'] = '';
	  
  
	  update_option('AgrilifeCountyOptions',$options);
	}
	
	//Prints out the admin page
	function printAdminPage() {
		  $agrilifeCountyOptions = $this->getAdminOptions();
	     
		  	// On Submit
			if (isset($_POST['update_agrilifeSettings'])) {
				//Sanitize This Data

				//County Name Default
				if (isset($_POST['county-name'])) {
				  // County Integer
				  $agrilifeCountyOptions['county-name'] = $_POST['county-name'];
				  // County Name (Human-Readable)
				  $agrilifeCountyOptions['county-name-human'] = $this->countyArray[$_POST['county-name']];
				}

				

				//Address Defaults
				if (isset($_POST['address-street1'])) 
				  $agrilifeCountyOptions['address-street1'] = stripslashes(apply_filters('content_save_pre', $_POST['address-street1']));

				if (isset($_POST['address-street2'])) 
				  $agrilifeCountyOptions['address-street2'] = stripslashes(apply_filters('content_save_pre', $_POST['address-street2']));

				if (isset($_POST['address-city'])) 
				  $agrilifeCountyOptions['address-city'] = stripslashes(apply_filters('content_save_pre', $_POST['address-city']));

				if (isset($_POST['address-zip'])) 
				  $agrilifeCountyOptions['address-zip'] = stripslashes(apply_filters('content_save_pre', $_POST['address-zip']));


				if (isset($_POST['address-mail-street1'])) 
				  $agrilifeCountyOptions['address-mail-street1'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-street1']));

				if (isset($_POST['address-mail-street2'])) 
				  $agrilifeCountyOptions['address-mail-street2'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-street2']));

				if (isset($_POST['address-mail-city'])) 
				  $agrilifeCountyOptions['address-mail-city'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-city']));

				if (isset($_POST['address-mail-zip'])) 
				  $agrilifeCountyOptions['address-mail-zip'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-zip']));


				if (isset($_POST['phone'])) 
				  $agrilifeCountyOptions['phone'] = stripslashes(apply_filters('content_save_pre', $_POST['phone']));

				if (isset($_POST['fax'])) 
				  $agrilifeCountyOptions['fax'] = stripslashes(apply_filters('content_save_pre', $_POST['fax']));


				if (isset($_POST['feedBurner'])) 
				  $agrilifeCountyOptions['feedBurner'] = stripslashes(apply_filters('content_save_pre', $_POST['feedBurner'])); 
				if (isset($_POST['googleAnalytics'])) 
				  $agrilifeCountyOptions['googleAnalytics'] = stripslashes(apply_filters('content_save_pre', $_POST['googleAnalytics'])); 

				update_option($this->adminOptionsName, $agrilifeCountyOptions);

				?>
				<div class="updated"><p><strong><?php _e("Settings Updated.", "AgriLifeCounties");?></strong></p></div>
			<?php
			} //End On Submit Actions

?>
          
          
<div class="wrap">
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>AgriLife County Site Configuration</h2>

 
<h3>County Information</h3>
<table class="form-table">
	<tr valign="top"> 
		<th scope="row">County Name</th> 
		<td>
            <select name="county-name">
			<?php
			//Make A County Dropdown
			foreach ($this->countyArray as $i => $value) {
				$selected = ($i==$agrilifeCountyOptions['county-name'] ? 'selected' : '');
			    echo '<option value="'.$i.'" '.$selected.'>'.$this->countyArray[$i].'</option>';
			}
			?>
			</select>
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row">Phone</th> 
		<td>
            <input type="text" name="phone" id="phone" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['phone']; ?>" />
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row">Fax</th> 
		<td>
            <input type="text" name="fax" id="fax" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['fax']; ?>" />
		</td>
	</tr>
</table>


<h3>Address</h3>
<h4>Physical Address</h4>
<h5>Not a PO Box.  This needs to be a 'Physical Adress'.</h5>
<table class="form-table">
	<tr valign="top"> 
		<th scope="row">Street 1</th> 
		<td>
            <input type="text" name="address-street1" id="address-street1" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['address-street1']; ?>" />
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row">Street 2</th> 
		<td>
            <input type="text" name="address-street2" id="address-street2" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['address-street2']; ?>" />
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row">City</th> 
		<td>
            <input type="text" name="address-city" id="address-city" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['address-city']; ?>" />
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row">Zip</th> 
		<td>
            <input type="text" name="address-zip" id="address-zip" class="regular-text" maxlength="10" value="<?php echo $agrilifeCountyOptions['address-zip']; ?>" />
		</td>
	</tr>
</table>
<h4>Mailing Address (optional)</h4>
<table class="form-table">
	<tr valign="top"> 
		<th scope="row">Street 1</th> 
		<td>
            <input type="text" name="address-mail-street1" id="address-mail-street1" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['address-mail-street1']; ?>" />
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row">Street 2</th> 
		<td>
            <input type="text" name="address-mail-street2" id="address-mail-street2" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['address-mail-street2']; ?>" />
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row">City</th> 
		<td>
            <input type="text" name="address-mail-city" id="address-mail-city" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['address-mail-city']; ?>" />
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row">Zip</th> 
		<td>
            <input type="text" name="address-mail-zip" id="address-mail-zip" class="regular-text" maxlength="10" value="<?php echo $agrilifeCountyOptions['address-mail-zip']; ?>" />
		</td>
	</tr>
</table>

<h3 style="padding-top: 20px;"><?php _e('Google Analytics Settings') ?></h3> 
<table class="form-table">
	<tr valign="top"> 
		<th scope="row"><?php _e('Tracking Code') ?></th> 
		<td>
            <input type="text" name="googleAnalytics" id="googleAnalytics" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['googleAnalytics']; ?>" />
			<br />
			<?php _e('Ex: UA-XXXXX-2') ?>
		</td>
	</tr>
</table>


<a href="javascript:void(0);" onclick="jQuery(this).next('div').toggle();"><?php _e("What's Google Analytics? How do I set this up?") ?></a> 
    <div style="display:none; padding:10px 20px 20px; border:1px solid #CCC; "> 
	<p><?php _e("<a href=\"https://www.google.com/analytics/\">Google Analytics</a> is the free stats tracking system supplied by Google and produces very attractive (and comprehensive) stats.") ?></p>
	<p><?php _e("To get going, just <a href=\"http://www.google.com/analytics/sign_up.html\">sign up for Analytics</a>, set up a new account and copy the tracking code you receive (it'll start with 'UA-') into the box above and press 'Save' - it can take several hours before you see any stats, but once it is you've got access to one heck of a lot of data!") ?></p>
	<p><?php _e("For more information on finding the tracking code, please visit <a href=\"http://www.google.com/support/analytics/bin/answer.py?hl=en&amp;answer=55603\">this Google help site</a>.") ?></p>
	</div>

<h3><?php _e('Feedburner Settings') ?></h3> 
<table class="form-table">
	<tr valign="top"> 
		<th scope="row"><?php _e('FeedBurner Feed Address') ?></th> 
		<td>
            <input type="text" name="feedBurner" id="feedBurner" class="regular-text" maxlength="200" value="<?php echo $agrilifeCountyOptions['feedBurner']; ?>" />
			<br />
			<?php _e('Ex: http://feeds.feedburner.com/AgriLife') ?>
		</td>
	</tr>
</table>


<div class="submit">
<input type="submit" name="update_agrilifeSettings" value="<?php _e('Update Settings', 'AgriLifeCounties') ?>" /></div>
</form>
</div>

		  <?php
	  }//End function printAdminPage()
  }
} //End Class AgriLifeCounties



if (class_exists("AgriLifeCounties")) {
  $agrilife_customizer = new AgriLifeCounties();
  $options	= get_option('AgrilifeCountyOptions');

  //if db not already populated, the add defaults
  if (!is_array($options))
	  $agrilife_customizer->set_defaults();

}

//Initialize the admin panel
if (!function_exists("AgrilifeCustomize_ap")) {
	function AgrilifeCustomize_ap() {
		global $agrilife_customizer;
		if (!isset($agrilife_customizer)) {
			return;
		}
		if (function_exists('add_options_page')) {
			add_options_page('AgriLife County Site Configuration', 'County Config.', 9, 'agrilife-county-config-admin', array(&$agrilife_customizer, 'printAdminPage'));
		}
	}	
}

if (isset($agrilife_customizer)) {
	// put county options in admin menu
	add_action('admin_menu', 'AgrilifeCustomize_ap');
	
}

























/**
 * Change Default Role Permissions
 * For more info about the options available visit: http://codex.wordpress.org/Roles_and_Capabilities
 */


/**
 * Add new permissions/capabilities to a specific role
 *
 * @param string $role
 * @param string $cap
 */
function add_capability($role,$cap) {
	$role_obj = get_role($role); // get the the role object
	$role_obj->add_cap($cap); // add $cap capability to this role object
}
//add_capability('subscriber','read_private_pages'); //Example

/**
 * Remove existing permissions/capabilities to a specific role
 *
 * @param string $role
 * @param string $cap
 */
function remove_capability($role,$cap) {
	$role_obj = get_role($role); // get the the role object
	$role_obj->remove_cap($cap); // add $cap capability to this role object
}
//remove_capability('subscriber','read_private_pages'); //Example


add_capability('editor','edit_theme_options');  // Allow an editor to edit widgets


// Brute-force Remove Tools Menu
function remove_menus () {
global $menu;
	if( current_user_can('moderate_comments') && !current_user_can('manage_sites') ) { $restricted = array(__('Tools'),  __('Media'),  __('Comments')); } // check if moderator or less and hide 

	//$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');  


//Remove unwanted wdigets from dashboard
function remove_dashboard_widgets(){
	global $wp_meta_boxes;
	
	//remove gravity forms dashboard widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
	
	//remove Twitter Widget Pro/xavisys dashboard widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboardb_xavisys']);
	
	//remove Yoast breadcrumb dashboard widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
	
	// remove core widgets
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 11);



// add asynchronous google analytics code
add_action('wp_head','analytics_code',0);
	function analytics_code() { 
		if( !is_admin() ) : ?>
<script type="text/javascript">//<![CDATA[
// Google Analytics asynchronous
var _gaq = _gaq || [];
_gaq.push(['_setAccount','UA-7414081-1']); 	//county-co
_gaq.push(['_trackPageview'],['_trackPageLoadTime']);
<?php 
if (class_exists("AgriLifeCounties")) {
  $agrilifeOptions	= get_option('AgrilifeCountyOptions');
  if($agrilifeOptions['googleAnalytics']<>''){
    echo "_gaq.push(['_setAccount','".$agrilifeOptions['googleAnalytics']."']);	//local-co\n";
    echo "_gaq.push(['_trackPageview'],['_trackPageLoadTime']);";
  }
}
?> 
(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
//]]>
</script>
<?php
endif; 
}	















