<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

    <?php if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb('<div id="breadcrumbs">','</div>');
    } ?>

    <!-- Action hook to insert content before the loop starts -->
    <?php agriflex_before_loop(); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if ( is_front_page() ) { ?>
      <h2 class="entry-title"><?php the_title(); ?></h2>
      <?php } else { ?>	
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php } ?>				

      <div class="entry-content">

        <?php the_content(); ?>

        <?php wp_link_pages( array(
          'before' => '<div class="page-link">' . __( 'Pages:', 'agriflex' ),
          'after' => '</div>' ) ); ?>

        <?php agriflex_edit_link(); ?>
      </div><!-- .entry-content -->

    </div><!-- #post-<?php the_ID(); ?> -->

    <!-- Action hook to insert content after the loop ends -->
    <?php agriflex_after_loop(); ?>

    <?php comments_template( '', true ); ?>

    <?php endwhile; ?>

  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
