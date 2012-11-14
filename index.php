<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */

get_header(); ?>

  <div id="wrap">
    <div id="content" role="main">

      <?php if ( have_posts() ) : ?>

        <?php agriflex_content_nav( 'nav-above' ); ?>

        <?php while ( have_posts() ) : the_post(); ?>

          <!-- Get the category or post format the post belongs to -->
          <?php $format = agriflex_get_format(); ?>

          <!-- Run the loop to output the posts.
          If you want to overload this in a child theme then include a file
          called content-index.php and that will be used instead. -->
          <?php get_template_part( 'content', $format ); ?>

        <?php endwhile; ?>

        <?php agriflex_content_nav( 'nav-below' ); ?>

      <?php else : ?>

        <?php get_template_part( 'no-results', 'index' ); ?>

      <?php endif; ?>

    </div><!-- #content -->
  </div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
