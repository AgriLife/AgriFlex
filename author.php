<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

    <?php agriflex_archive_title(); ?>

    <?php agriflex_author_info(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <!-- Run the loop for the author archive page to output the authors posts
      If you want to overload this in a child theme then include a file
      called loop-author.php and that will be used instead. -->

      <?php get_template_part( 'content', 'author' ); ?>

    <?php endwhile; ?>

    <?php agriflex_content_nav( 'nav-below' );?>

  </div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
