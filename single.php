<?php
/**
 * The Template for displaying all single posts.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

    <!-- Action hook to insert content before the loop starts -->
    <?php agriflex_before_loop(); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'single' ); ?>

      <?php agriflex_content_nav( 'nav-below' ); ?>

      <?php comments_template( '', true ); ?>

    <?php endwhile; // end of the loop. ?>

    <!-- Action hook to insert content after the loop ends -->
    <?php agriflex_after_loop(); ?>

  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
