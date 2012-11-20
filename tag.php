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

    <!-- Run the loop for the tag archive to output the posts
    If you want to overload this in a child theme then include a file
    called content-tag.php and that will be used instead.-- >
    <?php get_template_part( 'content', 'tag' ); ?>

  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
