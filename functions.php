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
  $isresearch 	= (is_array($options) ? $options['isResearch'] 	: true);
  $isextension	= (is_array($options) ? $options['isExtension'] : true);
  $iscollege 	= (is_array($options) ? $options['isCollege'] 	: true);
  $istvmdl	 	= (is_array($options) ? $options['isTvmdl'] 	: true);
  $isextensiononly = ($isextension && !$isresearch && !$iscollege && !$istvmdl ? true : false);
  $isresearchonly = ($isresearch && !$isextension && !$iscollege && !$istvmdl ? true : false);
  $iscollegeonly = ($iscollege && !$isextension && !$isresearch && !$istvmdl ? true : false);
  $istvmdlonly = ($istvmdl && !$isextension && !$isresearch && !$iscollege ? true : false);
  
  if($isextensiononly) :
  	$isextension4h = $isextensioncounty = $isextensioncountytce = $isextensionmg = $isextensionmn = false;
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
  			break;
  		case 5:
  			// Master Naturalist
  			$isextensionmn = true;
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

if ( ! function_exists( 'agriflex_setup' ) ):

function agriflex_setup() {

	// Remove things that get stuck up in the doc head that we don't need
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	// Add new image sizes
	add_image_size('featured',965,475,true);
	add_image_size('staff_single',175,9999);
	add_image_size('staff_archive',70,70,true);		
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'agriflex', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'agriflex' ),
	) );

	/* -- Add typekit js and css to document head -- */
	add_action('wp_head','typekit_js');
		function typekit_js() { 
			if( !is_admin() ) : ?>
	<script type="text/javascript" src="http://use.typekit.com/thu0wyf.js"></script>
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
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"), false);		
	   	wp_enqueue_script('jquery');
	
	       // enqueue the custom jquery js
	   	wp_enqueue_script('modernizr',
	       	get_bloginfo('template_directory') . '/js/modernizr-2.0.6.min.js' , array('jquery'), '2.0.6', false);
							
	       // enqueue the custom jquery js
	   	wp_enqueue_script('my_scripts',
	       	get_bloginfo('template_directory') . '/js/my_scripts.js', array('jquery'), '2.4', true);		       
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
	
	// Custom Body Classes Based On Agency Selected
	function my_class_names($classes) {
		$classes[] = '';
		
		if (class_exists("AgrilifeCustomizer")) {
			GLOBAL $options;

			// Set Header Tabs
			if($options['isResearch']) $classes[] .= 'research';
			if($options['isExtension']) $classes[] .= 'extension';
			if($options['isCollege']) $classes[] .= 'college';
			if($options['isTvmdl']) $classes[] .= 'tvmdl';
			
			// Single Agency Classes
			if($options['isResearch'] && !$options['isExtension'] && !$options['isCollege'] && !$options['isTvmdl']) $classes[] .= 'researchonly';
			if($options['isCollege'] && !$options['isExtension'] && !$options['isResearch'] && !$options['isTvmdl']) $classes[] .= 'collegeonly';
			if($options['isTvmdl'] && !$options['isExtension'] && !$options['isResearch'] && !$options['isCollege']) $classes[] .= 'tvmdlonly';
			if($options['isExtension'] && !$options['isResearch'] && !$options['isCollege'] && !$options['isTvmdl']) :
				$classes[] .= 'extensiononly';			
				// Extension Only Sub-categories
			  	switch ($options['extension_type']) {
			  		case 0:
			  			break;
			  		case 1:
			  			$classes[] .= 'extension4h';
			  			break;
			  		case 2:
			  			$classes[] .= 'extensioncounty';
			  			break;
			  		case 3:
			  			$classes[] .= 'extensioncountytce';
			  			break;
			  		case 4:
			  			$classes[] .= 'extensionmg';
			  			break;
			  		case 5:
			  			$classes[] .= 'extensionmn';
			  			break;
			  	}
			  endif;  

		}	
		return $classes;
	}

	add_filter('body_class','my_class_names');
	
	
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
 * @since agriflex 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function agriflex_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'agriflex' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'agriflex' ), $paged );
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
		$title .= " $separator " . sprintf( __( 'Page %s', 'agriflex' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'agriflex_filter_wp_title', 10, 2 );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since agriflex 1.0
 */
function agriflex_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'agriflex_page_menu_args' );


function agriflex_nav_menu_args( $args = 'sf-menu' )
{
	$args['menu_class'] = 'sf-menu menu';
	return $args;
} // function

add_filter( 'wp_nav_menu_args', 'agriflex_nav_menu_args' );


/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since agriflex 1.0
 * @return int
 */
function agriflex_excerpt_length( $length ) {
	return 88;
}
add_filter( 'excerpt_length', 'agriflex_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since agriflex 1.0
 * @return string "Continue Reading" link
 */
function agriflex_continue_reading_link() {
	return ' <span class="read-more"><a href="'. get_permalink() . '">' . __( 'Read More &rarr;', 'agriflex' ) . '</a></span>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and agriflex_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since agriflex 1.0
 * @return string An ellipsis
 */
function agriflex_auto_excerpt_more( $more ) {
	return '...' . agriflex_continue_reading_link();
}
add_filter( 'excerpt_more', 'agriflex_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since agriflex 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function agriflex_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= agriflex_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'agriflex_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since agriflex 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function agriflex_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'agriflex_remove_gallery_css' );

if ( ! function_exists( 'agriflex_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own agriflex_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since agriflex 1.0
 */
function agriflex_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'agriflex' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'agriflex' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'agriflex' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'agriflex' ), ' ' );
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
		<p><?php _e( 'Pingback:', 'agriflex' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'agriflex'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

// Custom search 
add_filter('get_search_form', 'custom_search_form');
function custom_search_form() {

	$search_text = get_search_query() ? esc_attr( apply_filters( 'the_search_query', get_search_query() ) ) : apply_filters('agriflex_search_text', esc_attr__('Search', 'agriflex'));
	$button_text = apply_filters( 'agriflex_search_button_text', esc_attr__( 'Go', 'agriflex' ) );

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
 * To override agriflex_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
function agriflex_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Right Column', 'agriflex' ),
		'id' => 'right-column-widget-area',
		'description' => __( 'The right column area', 'agriflex' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located in the second sidebar.
	register_sidebar( array(
		'name' => __( 'Right Column Bottom', 'agriflex' ),
		'id' => 'right-column-bottom-widget-area',
		'description' => __( 'The right column bottom widget area', 'agriflex' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3
	register_sidebar( array(
		'name' => __( 'Home Page Bottom', 'agriflex' ),
		'id' => 'home-middle-1',
		'description' => __( 'Home Middle #1', 'agriflex' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
	// Area 4, located in the sidebar.
	register_sidebar( array(
		'name' => __( 'Sidebar Navigation', 'agriflex' ),
		'id' => 'sidebar-widget-navigation',
		'description' => __( 'Sidebar Navigation', 'agriflex' ),
		'before_title' => '<h3 class="widget-title"><a>',
		'after_title' => '</a></h3>',
	) );	
}

/** Register sidebars by running agriflex_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'agriflex_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 */
function agriflex_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'agriflex_remove_recent_comments_style' );

if ( ! function_exists( 'agriflex_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since agriflex 1.0
 */
function agriflex_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'agriflex' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

if ( ! function_exists( 'agriflex_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function agriflex_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'agriflex' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'agriflex' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'agriflex' );
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


// Body class for admin
function base_admin_body_class( $classes )
{
	// Current action
	if ( is_admin() && isset($_GET['action']) ) {
		$classes .= 'action-'.$_GET['action'];
	}
	// Current post ID
	if ( is_admin() && isset($_GET['post']) ) {
		$classes .= ' ';
		$classes .= 'post-'.$_GET['post'];
	}
	// New post type & listing page
	if ( isset($_GET['post_type']) ) $post_type = $_GET['post_type'];
	if ( isset($post_type) ) {
		$classes .= ' ';
		$classes .= 'post-type-'.$post_type;
	}
	// Editting a post type
	$post_query = $_GET['post'];
	if ( isset($post_query) ) {
		$current_post_edit = get_post($post_query);
		$current_post_type = $current_post_edit->post_type;
		if ( !empty($current_post_type) ) {
			$classes .= ' ';
			$classes .= 'post-type-'.$current_post_type;
		}
	}
	// Return the $classes array
	return $classes;
}
add_filter('admin_body_class', 'base_admin_body_class');

/* Staff Custom Post Type & Taxonomies*/
if ($istvmdlonly) {
add_action( 'init', 'create_tests_post_type' );
function create_tests_post_type() {
	register_post_type( 'tests',
		array(
			'labels' => array(
				'name' => __( 'Tests' ),
				'singular_name' => __( 'Test' ),
				'add_new_item' => __( 'Add New Test' ),
				'add_new' => __( 'Add New' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Test' ),
				'new_item' => __( 'New Test' ),
				'view' => __( 'View Test' ),
				'view_item' => __( 'View Test' ),
				'search_items' => __( 'Search Tests' ),
				'not_found' => __( 'No Tests found' ),
				'not_found_in_trash' => __( 'No Tests found in Trash' ),

			),
		'_builtin' => false, // It's a custom post type, not built in!
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'public' => true,
		'rewrite' => array('slug' => 'tests'),
		'supports' => array( 'title', 'editor' ),
		)
	);
}

// hook into the init action and call create_tests_taxonomies() when it fires
add_action( 'init', 'create_tests_taxonomies', 0 );

// create three taxonomies, species and lab sections for the post type "tests"
function create_tests_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Species', 'taxonomy general name' ),
		'singular_name' => _x( 'Species', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Species' ),
		'all_items' => __( 'All Species' ),
		'parent_item' => __( 'Parent Species' ),
		'parent_item_colon' => __( 'Parent Species:' ),
		'edit_item' => __( 'Edit Species' ),
		'update_item' => __( 'Update Species' ),
		'add_new_item' => __( 'Add New Species' ),
		'new_item_name' => __( 'New Species Name' ),
	); 	

	register_taxonomy( 'species', array( 'tests' ), array(
		'hierarchical' => true,
		'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'species' ),
	));

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Lab Sections', 'taxonomy general name' ),
		'singular_name' => _x( 'Lab Sections', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Lab Sections' ),
		'all_items' => __( 'All Lab Sections' ),
		'parent_item' => __( 'Parent Lab Section' ),
		'parent_item_colon' => __( 'Parent Lab Section:' ),
		'edit_item' => __( 'Edit Lab Section' ),
		'update_item' => __( 'Update Lab Section' ),
		'add_new_item' => __( 'Add New Lab Section' ),
		'new_item_name' => __( 'New Lab Section Name' ),
	); 	

	register_taxonomy( 'lab_sections', array( 'tests' ), array(
		'hierarchical' => true,
		'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'lab-sections' ),
	));

}
}

/* Staff Custom Post Type */
if ($iscollegeonly) {
add_action( 'init', 'create_staff_post_type' );
function create_staff_post_type() {
	register_post_type( 'staff',
		array(
			'labels' => array(
				'name' => __( 'Staff' ),
				'singular_name' => __( 'Employee' ),
				'add_new_item' => __( 'Add New Staff Employee' ),
				'add_new' => __( 'Add New' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Staff Employee' ),
				'new_item' => __( 'New Staff Employee' ),
				'view' => __( 'View Staff Employee' ),
				'view_item' => __( 'View Staff Employee' ),
				'search_items' => __( 'Search Staff Employees' ),
				'not_found' => __( 'No Staff Employees found' ),
				'not_found_in_trash' => __( 'No Staff Employees found in Trash' ),

			),
		'_builtin' => false, // It's a custom post type, not built in!
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'public' => true,
		'rewrite' => array('slug' => 'staff'),
		'supports' => array( 'title', 'editor','thumbnail' ),
		)
	);
}
}

/* Job Posting Custom Post Type */
if ($iscollegeonly) {
add_action( 'init', 'create_job_posting_post_type' );
function create_job_posting_post_type() {
	register_post_type( 'job_posting',
		array(
			'labels' => array(
				'name' => __( 'Job Posting' ),
				'singular_name' => __( 'Job' ),
				'add_new_item' => __( 'Add New Job Posting' ),
				'add_new' => __( 'Add New' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Job Posting' ),
				'new_item' => __( 'New Job Posting' ),
				'view' => __( 'View Job Posting' ),
				'view_item' => __( 'View Job Posting' ),
				'search_items' => __( 'Search Job Postings' ),
				'not_found' => __( 'No Job Posting found' ),
				'not_found_in_trash' => __( 'No Job Postings found in Trash' ),

			),
		'_builtin' => false, // It's a custom post type, not built in!
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'public' => true,
		'rewrite' => array('slug' => 'jobs'),
		'supports' => array( 'title', 'editor' ),
		)
	);
}
}


/* Define the custom box */
add_action('admin_init','staff_meta_init');
 
function staff_meta_init() {

	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/add_meta_box
 
	// add a meta box for each of the wordpress page types: posts and pages
	foreach (array('staff') as $type) 
	{
		add_meta_box('staff_details_meta', 'Enter Employee Details', 'staff_details_meta_setup', $type, 'normal', 'high');
	}
 
	// add a callback function to save any data a user enters in
	add_action('save_post','box_meta_save');
}
 
function staff_details_meta_setup() {
	global $post;
 
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_my_meta',TRUE)? get_post_meta($post->ID, '_my_meta', true) : 'empty meta';
	// The Details fields for data entry
	
// instead of writing HTML here, lets do an include
	include(MY_THEME_FOLDER . '/includes/meta_boxes/staff_meta_html.php');
	
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 

/* Define the custom box for job posting custom post type */
add_action('admin_init','job_posting_meta_init');
 
function job_posting_meta_init() {

	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/add_meta_box
 
	// add a meta box for each of the wordpress page types: job_posting
	foreach (array('job_posting') as $type) 
	{
		add_meta_box('job_posting_details_meta', 'Enter Job Details', 'job_posting_details_meta_setup', $type, 'normal', 'high');
	}
 
	// add a callback function to save any data a user enters in
	add_action('save_post','box_meta_save');
}
 
function job_posting_details_meta_setup() {
	global $post;
 
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_my_meta',TRUE);
 
	// The Details fields for data entry

	// instead of writing HTML here, lets do an include
	include(MY_THEME_FOLDER . '/includes/meta_boxes/jobs_meta_html.php');

	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}


/* Define the custom box for "tests" custom post type */
add_action('admin_init','tests_meta_init');
 
function tests_meta_init() {

	// review the function reference for parameter details
	// http://codex.wordpress.org/Function_Reference/add_meta_box
 
	// add a meta box for each of the wordpress page types: posts and pages
	foreach (array('tests') as $type) 
	{
		add_meta_box('tests_details_meta', 'Enter Test url', 'tests_details_meta_setup', $type, 'normal', 'high');
	}
 
	// add a callback function to save any data a user enters in
	add_action('save_post','box_meta_save');
}
 
function tests_details_meta_setup() {
	global $post;
 
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_my_meta',TRUE);
 
	// The Details fields for data entry

	// instead of writing HTML here, lets do an include
	include(MY_THEME_FOLDER . '/includes/meta_boxes/tests_meta_html.php');

	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';	

}

function box_meta_save($post_id) 
{
	// verify if this is an auto save routine.
  	// If it is our form has not been submitted, so we dont want to do anything
  	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

	// authentication checks
 
	// make sure data came from our meta box
	if (!wp_verify_nonce($_POST['my_meta_noncename'],__FILE__)) return $post_id;
 
	// check user permissions

	  if ( array('job_posting','staff') == $_POST['post_type'] )
	  {
	    if ( !current_user_can( 'edit_page', $post_id ) )
	    return;
	  }
	  else
	  {
	    if ( !current_user_can( 'edit_post', $post_id ) )
	        return;
	  }
	// authentication passed, save data
 
	// var types
	// single: _my_meta[var]
	// array: _my_meta[var][]
	// grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]
 
	$current_data = get_post_meta($post_id, '_my_meta', TRUE);	
 
	$new_data = $_POST['_my_meta'];
 

 
	if ($current_data) 
	{
		if (is_null($new_data)) delete_post_meta($post_id,'_my_meta');
		else update_post_meta($post_id,'_my_meta',$new_data);
	}
	elseif (!is_null($new_data))
	{
		add_post_meta($post_id,'_my_meta',$new_data,TRUE);
	}
 
	return $post_id;
}


function my_meta_setup()
{
	global $post;
 
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_my_meta',TRUE);
 
		echo '<h4>Details</h4>';
	echo '<label for="staff_new_field">';
	     _e("Position", 'staff_textdomain' );
	echo '</label> ';

	
	echo '<label for="room">';
	     _e("Building & Room Number", 'staff_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="room" name="_my_meta[room]" placeholder="Big Building Room 777" size="25" />';
 
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 
function my_meta_save($post_id) 
{
	// authentication checks
 
	// make sure data came from our meta box
	if (!wp_verify_nonce($_POST['my_meta_noncename'],__FILE__)) return $post_id;
 
	// check user permissions
	if ($_POST['post_type'] == 'page') 
	{
		if (!current_user_can('edit_page', $post_id)) return $post_id;
	}
	else 
	{
		if (!current_user_can('edit_post', $post_id)) return $post_id;
	}
 
	// authentication passed, save data
 
	// var types
	// single: _my_meta[var]
	// array: _my_meta[var][]
	// grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]
 
	$current_data = get_post_meta($post_id, '_my_meta', TRUE);	
 
	$new_data = $_POST['_my_meta'];
 
	my_meta_clean($new_data);
 
	if ($current_data) 
	{
		if (is_null($new_data)) delete_post_meta($post_id,'_my_meta');
		else update_post_meta($post_id,'_my_meta',$new_data);
	}
	elseif (!is_null($new_data))
	{
		add_post_meta($post_id,'_my_meta',$new_data,TRUE);
	}
 
	return $post_id;
}
 
function my_meta_clean(&$arr)
{
	if (is_array($arr))
	{
		foreach ($arr as $i => $v)
		{
			if (is_array($arr[$i])) 
			{
				my_meta_clean($arr[$i]);
 
				if (!count($arr[$i])) 
				{
					unset($arr[$i]);
				}
			}
			else 
			{
				if (trim($arr[$i]) == '') 
				{
					unset($arr[$i]);
				}
			}
		}
 
		if (!count($arr)) 
		{
			$arr = NULL;
		}
	}
}

// TVMDL specific content for test search form
function tvmdl_test_search() {
    do_action('tvmdl_test_search');
}

add_action('tvmdl_test_search','tvmdl_test_search_form',5);

function tvmdl_test_search_form() { ?>
	<div class="test-search-form">
	<label>
	<h4>Search for Tests</h4>
	</label>
	<form role="search" class="searchform" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
<?php
echo '<div class="tax-options">';
function get_terms_dropdown($species, $lab_sections, $args){
	$myspecies = get_terms($species, $args);
	$mylab_sections = get_terms($lab_sections, $args);	
	$optionname = "optionname";
	$emptyvalue = "";
	$output ="<select name='".$optionname."'><option selected='".$selected."' value='".$emptyvalue."'>Species</option>'";

	foreach($myspecies as $term){
		$term_taxonomy=$term->species; 
		$term_slug=$term->slug;
		$term_name =$term->name;
		$link = $term_slug;
		$output .="<option name='".$link."' value='".$link."'>".$term_name."</option>";
	}
	$output .="</select>";	
	
	$output .="<select name='".$optionname."'><option selected='".$selected."' value='".$emptyvalue."'>Lab Sections</option>'";

	foreach($mylab_sections as $term){
		$term_taxonomy=$term->lab_sections; 
		$term_slug=$term->slug;
		$term_name =$term->name;
		$link = $term_slug;
		$output .="<option name='".$link."' value='".$link."'>".$term_name."</option>";
	}
	$output .="</select>";	
	
return $output;


}

$species = array( 'species' ); 
$lab_sections = array( 'lab_sections'); 
$args = array('order'=>'ASC','hide_empty'=>true);
echo get_terms_dropdown($species, $lab_sections, $args);
echo '</div>';
?>
		<input type="text" class="s" name="s" id="s" placeholder="Avian Influenza" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
		<input type="hidden" name="post_type" value="tests" />
	</form>
	</div>
<?php  
}



	// Set path to function files
	$includes_path = TEMPLATEPATH . '/includes/';
	// Admin Pages
	require_once ($includes_path . 'admin.php');
	// Remove Admin Menus and Dashboards
    //	require_once ($includes_path . 'admin-remove.php');
	// Custom Shortcodes
	require_once ($includes_path . 'shortcodes.php');
	// Auto-configure plugins
	require_once ($includes_path . 'plugin-config.php');
	// Add Custom Widgets
	require_once ($includes_path . 'widgets.php');
	// Custom Featured Page/Post metaboxes
	require_once ($includes_path . 'custom-meta.php');