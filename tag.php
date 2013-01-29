<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

    <?php agriflex_archive_title(); ?>

    <!-- Action hook to insert content before the loop starts -->
    <?php agriflex_before_loop(); ?>

    <!-- Run the loop for the category page to output the posts.
    If you want to overload this in a child theme then include a file
    called loop-category.php and that will be used instead. -->

    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'tag' ); ?>

    <?php endwhile; ?>

    <!-- Action hook to insert content after the loop ends -->
    <?php agriflex_after_loop(); ?>

  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
