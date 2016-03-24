<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">


    <h1 class="page-title">
      <?php printf( __( 'Search Results for: %s', 'agriflex' ),
      '<span>' . get_search_query() . '</span>' ); ?>
    </h1>
      
    <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
      
      <?php switch_to_blog($post->blog_id); ?>
      <!-- Run the loop for the search to output the results.
      If you want to overload this in a child theme then include a file
      called loop-search.php and that will be used instead. -->
      <?php get_template_part( 'content', 'search' ); ?>

    <?php endwhile; else : ?>

      <?php get_template_part( 'no-results', 'index' ); ?>

    <?php endif; ?>
  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
