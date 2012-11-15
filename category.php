<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

    <?php agriflex_archive_title(); ?>

    <!-- Run the loop for the category page to output the posts.
    If you want to overload this in a child theme then include a file
    called loop-category.php and that will be used instead. -->

    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'category' ); ?>

    <?php endwhile; ?>

    <?php agriflex_content_nav( 'nav-below' ); ?>

  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
