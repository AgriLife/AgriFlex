<?php
/**
 * Template Name: One column, no sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

		<div id="wrap" class="one-column">
			<div id="content" role="main">

				<?php agriflex_before_loop(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'agriflex' ), 'after' => '</div>' ) ); ?>
            <?php agriflex_edit_link(); ?>
					</div><!-- .entry-content -->
        </div><!-- #post-<?php the_ID(); ?> -->

        <!-- Action hook to insert content after the loop ends -->
        <?php agriflex_after_loop(); ?>

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_footer(); ?>
