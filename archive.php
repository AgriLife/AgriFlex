<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
	<div id="content" role="main">
	
  <?php agriflex_archive_title(); ?>
	
    <!-- Action hook to insert content before the loop starts -->
    <?php agriflex_before_loop(); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'archive' ); ?>

      <?php comments_template( '', true ); ?>

    <?php endwhile; // end of the loop. ?>

    <?php agriflex_content_nav( 'nav-below' ); ?>

    <!-- Action hook to insert content after the loop ends -->
    <?php agriflex_after_loop(); ?>

	</div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
