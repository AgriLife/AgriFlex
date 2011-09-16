<?php
/**
 * The Template for displaying all tests single posts.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">
				<?php tvmdl_test_search() ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php $my_meta = get_post_meta($post->ID,'_my_meta',TRUE); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
						<h1 class="entry-title"><a href="<?php ($my_meta['link']) ?>"><?php the_title(); ?></a></h1>

				</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>