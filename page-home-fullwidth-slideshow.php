<?php
/**
 * Template Name: Home: Slideshow Fullwidth 
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<?php agriflex_home_slider(); ?>

<div id="wrap">		
  <div id="content" role="main">			

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if ( is_front_page() ) : ?>
          <h2 class="entry-title"><?php the_title(); ?></h2>
        <?php else : ?>	
          <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>				

        <div class="entry-content">
          <?php the_content(); ?>
          <?php wp_link_pages(
            array( 'before' => '<div class="page-link">' . __( 'Pages:',
            'county_ext' ), 'after' => '</div>' ) ); ?>
          <?php agriflex_edit_link(); ?>
        </div><!-- .entry-content -->

      </div><!-- #post-<?php the_ID(); ?> -->

    <?php endwhile; ?>

    <div id="home-middle-bg">
      <div id="home-middle">

        <div class="home-middle-1">

          <?php if (!dynamic_sidebar('Home Page Bottom')) : ?>
            <div class="widget">
              <h2><?php _e("Home Page Bottom Widget", 'county_ext'); ?></h2>
              <p><?php _e("This is a widgeted area which is called Home Middle #1. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Middle #1 widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit post screen and publish your page. The Featured Page widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
            </div>		
          <?php endif; ?>

        </div><!-- end .home-middle-1 -->

      </div><!-- end #home-middle -->

    </div><!-- end #home-middle-bg -->

  </div><!-- #content -->
</div><!-- #wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
