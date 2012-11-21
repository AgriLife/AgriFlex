<?php
/**
 * Custom template tags for the AgriFlex Theme
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
 */

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
    <h1 class="assistive-text screen-reader-text"><?php _e ( 'Post navigation', 'agriflex' ); ?></h1>
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

} // agriflex_post_thumbnail

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
  } elseif ( is_author() ) {
    $html .= sprintf( __( 'Author Archives: %s', 'agriflex'),
            '<span class="vcard"><a class="url fn n" href="' .
            get_author_posts_url( get_the_author_meta( 'ID' ) ) .
            '" title="' . esc_attr( get_the_author() ) . '"' .
            'rel="me">' . get_the_author() . '</a></span>' );
  } elseif ( is_category() ) {
    $html .= sprintf( __( 'Category Archives: %s', 'agriflex' ),
      '<span>' . single_cat_title( '', false ) . '</span>' );
    $desc = category_description();
    if ( ! empty( $desc ) )
      $html .= '<div class="archive-meta">' . $desc . '</div>';
  } elseif ( is_tag() ) {
    $html .= sprintf( __( 'Tag Archives: %s', 'agriflex' ), '<span>' . single_tag_title( '', false ) . '</span>' );
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

if ( ! function_exists( 'agriflex_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since agriflex 1.0
 */
function agriflex_posted_on() {
     printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
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

/**
 * Displays author image, bio, and contact information
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 */
function agriflex_author_info() {

  // If a user has filled out their description, show a bio on their entries.
  if ( get_the_author_meta( 'description' ) ) :

    $html = '<div id="entry-author-info">';
    $html .= '<div id="author-avatar">';
    $html .= get_avatar( get_the_author_meta( 'user_email' ),
      apply_filters( 'agriflex_author_bio_avatar_size', 60 ) );
    $html .= '</div><!-- #author-avatar -->';
    $html .= '<div id="author-description">';
    $html .= '<h2>';
    $html .= sprintf( __( 'About %s', 'agriflex' ), get_the_author() );
    $html .= '</h2>';
    $html .= get_the_author_meta( 'description' );
    $html .= '</div><!-- #author-description	-->';
    $html .= '</div><!-- #entry-author-info -->';

    echo $html;

  endif;

} // agriflex_author_info

/**
 * Displays comment navigation if comments are available
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @param string $nav_id Used as the nav ID
 * @return void
 */
function agriflex_comment_nav( $nav_id ) {

  if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

    $html = '<div id="' . $nav_id . '" class="comment-nav navigation">';
    $html .= '<div class="nav-previous">';
    $html .= sprintf(previous_comments_link(
              __( '<span class="meta-nav">&larr;</span> Older Comments',
              'agriflex' ) ) );
    $html .= '</div>';
    $html .= '<div class="nav-next">';
    $html .= sprintf(next_comments_link(
              __( 'Newer Comments <span class="meta-nav">&rarr;</span>',
              'agriflex' ) ) );
    $html .= '</div>';
    $html .= '</div> <!-- #' . $nav_id . ' -->';

    echo $html;

  endif; // check for comment navigation

}

/**
 * Displays the comments link in the loop
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @return void
 */
function agriflex_comments_link() {

    $html = '<span class="comments-link">';
    $html .= sprintf(comments_popup_link( __( 'Leave a comment', 'agriflex' ),
        __( '1 Comment', 'agriflex' ), __( '% Comments', 'agriflex' ) ) );
    $html .= '</span>';

    echo $html;

} // agriflex_comments_link

/**
 * Displays the edit link for logged-in users
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @return void
 */
function agriflex_edit_link() {

    $html .= sprintf(edit_post_link( __( 'Edit', 'agriflex' ),
      '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ) );

    echo $html;

} // agriflex_edit_link

if ( ! function_exists( 'agriflex_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments
 * template simply create your own agriflex_comment(), and that function will be
 * used instead.
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
