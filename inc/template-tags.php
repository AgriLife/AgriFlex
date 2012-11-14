<?php
/**
 * Custom template tags for the AgriFlex Theme
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
 */

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

/**
 * Determines which header to show then echos it
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @return void
 */
function agriflex_show_header() {

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

  echo $html;

}

if ( ! function_exists( 'agriflex_content_nav' ) ) :
/**
 * Display navigation to next/previous pages/posts when applicable
 * Works on single entries and loops
 * 
 * @link https://github.com/Automattic/_s/blob/master/inc/template-tags.php Source
 * @since AgriFlex 2.0
 * @global $wp_query
 * @global $post
 * @param string $nav_id Unique identifier to be used as ID
 * @return void
 */
function agriflex_content_nav( $nav_id ) {

  global $wp_query, $post;

  // Don't print empty markup on single pages if there's nowhere to navigate
  if ( is_single() ) {
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) :
      get_adjacent_post( false, '', true );
    $next = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
      return;
  }

  // Dont' print empty markup in archives if there's only one page
  if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
    return;

  $nav_class = 'navigation paging-navigation';
  if ( is_single() )
    $nav_class = 'navigation post-navigation';
  ?>
  <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
    <h1 class="assistive-text"><?php _e ( 'Post navigation', 'agriflex' ); ?></h1>
    <?php if ( is_single() ) : // navigation links for single posts ?>

      <?php previous_post_link( '<div class="nav-previous">%link</div>',
        '<span class="meta-nav">' .
        _x( '&larr;', 'Previous post', 'agriflex' ) . 
        '</span> %title' ); ?>

      <?php next_post_link( '<div class="nav-next">%link</div>',
        '%title <span class="meta-nav">' .
        _x( '&rarr;', 'Newer posts', 'agriflex' ) . 
        '</span>' ); ?>

    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_archive() || is_search() ) ) : ?>

      <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', '_s' ) ); ?></div>
        <?php endif; ?>

        <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', '_s' ) ); ?></div>
        <?php endif; ?>

    <?php endif; ?>

  </nav><!-- #<?php echo $nav_id; ?> -->
<?php
}
endif; // agriflex_content_nav

if ( ! function_exists( 'agriflex_post_title' ) ) :
/**
 * Echos the post's title wrapped in a header anchor tag.
 * Tags are configurable
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @param string $header Header size (h1, h2, etc.)
 * @param bool $anchor Whether to wrap title in an anchor tag
 * @global $post
 * @returns void
 */
function agriflex_post_title( $header = '', $anchor = TRUE ) {

  global $post;

  $id = $post->ID;

  // Setting a default header size
  if ( empty( $header ) ) $header = 'h2';

  // Opening header tag
  $html = '<' . $header . ' class="entry-title">';

  // Opening anchor tag
  if ( $anchor ) {
    $html .= '<a href="' . get_permalink( $id ) . '" ' .
      'title="' . esc_attr( sprintf( __('Permalink to %s', 'agriflex'  ),
        the_title_attribute( 'echo=0' )  ) ) . '" ' .
      'rel="bookmark">';
  }

  // The actual post title, false returns it for PHP use
  $html .= the_title( '', '', FALSE );

  // Closing anchor tag
  if ( $anchor ) {
    $html .= '</a>';
  }

  // Closing header tag
  $html .= '</' . $header . '>';

  echo $html;

}

endif; // agriflex_post_title

if ( ! function_exists( 'agriflex_post_thumbnail' ) ) :
/**
 * Retrieves the post's thumbnail. Returns a default thumbnail
 * if one doesn't exist.
 *
 * @todo - Change default thumbnail to specific agency
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @param string $size Thumbnail size to use
 * @global $post
 * @returns void
 */
function agriflex_post_thumbnail( $size = 'featured-mediabox' ) {

  global $post;

  $html = '<a class="feature-img-excerpt" href="' . get_permalink( $post->ID ) . '">';

  if ( has_post_thumbnail( $post->ID ) ) {
    // Show the post thumbnail
    $html .= get_the_post_thumbnail( $post->ID, $size ); 
  } else  { 
    // Show the default thumbnail
    $html .='<img src="' . get_bloginfo('template_url') . '/images/AgriLife-default-post-image.png?v=100" alt="AgriLife Logo" title="AgriLife" />';
  }
  $html .= '</a>';

  echo $html;

}
endif; // agriflex_post_thumbnail

/**
 * Determines which title to display on the archive page
 * 
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @return void
 */
function agriflex_archive_title() {

  /* Queue the first post, that way we know
   * what date we're dealing with (if that is the case).
   *
   * We reset this later so we can run the loop
   * properly with a call to rewind_posts().
   */
  if ( have_posts() ) {
    the_post();
  }

  $html = '<h1 class="page-title">';

  if ( is_day() ) {
    $html .= sprintf( __( 'Daily Archives: <span>%s</span>', 'agriflex' ),
            get_the_date() );
  } elseif ( is_month() ) {
    $html .= sprintf( __( 'Monthly Archives: <span>%s</span>', 'agriflex' ),
            get_the_date('F Y') );
  } elseif ( is_year() ) {
    $html .= sprintf( __( 'Yearly Archives: <span>%s</span>', 'agriflex' ),
            get_the_date('Y') );
  } else {
    $html .= __( 'Blog Archives', 'agriflex' );
  }

  $html .= '</h1>';

  echo $html;

	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

}

/**
 * Determines which agency the site belongs to and builds
 * the required footer.
 * 
 * @todo - Make this not ugly
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 */
function agriflex_show_footer() {

  GLOBAL $isresearch,
    $isextension,
    $iscollege,
    $istvmdl;

  GLOBAL $isextensiononly,
    $isresearchonly,
    $iscollegeonly,
    $istvmdlonly,
    $isfazd;

  GLOBAL $isextension4h,
    $isextensioncounty,
    $isextensioncountytce,
    $isextensionmg,
    $isextensionmn;

  GLOBAL $options;

  GLOBAL $useCustomFooter;
  
  $path = get_template_directory() . '/inc/footer/';

// Column 1-3
if ( $iscollegeonly ) : 
	include( $path . 'college.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif ( $isresearchonly ) : 
	include( $path . 'research.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' );  
elseif ( $istvmdlonly ) : 
	include( $path . 'tvmdl.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif ( $isfazd ) : 
	include( $path . 'fazd.inc.php' );
	// Column 4
	//include($path . 'contact.inc.php' );  
	// Column 5
	//include($path . 'bookstore.inc.php' ); 	
elseif ( $options['useCustomFooter'] ) :
  include( $path . 'fazd.inc.php' );
elseif ( $isextensiononly && $isextension4h ) : 
	include( $path . '4h.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif ( $isextensiononly && $isextensionmg ) : 
	include( $path . 'txmg.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif ( $isextensiononly && $isextensionmn ) : 
	include( $path . 'txmn.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif( $isextensiononly ) : 
	include( $path . 'extension.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
else : 
	// Multi-agency 
	include( $path . 'multi.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
endif;

}
