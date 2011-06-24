<?php
/**
 * Template Name: Blog
 * @package WordPress
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">

			<?php get_template_part( 'loop', 'index' ); ?>
			
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>