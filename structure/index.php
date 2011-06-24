<?php
/**
 * The main template file.
 * @package WordPress
 */

get_header(); ?>
		<div id="wrap">
			<div id="content" role="main">

			<?php get_template_part( 'loop', 'index' ); ?>
			
			</div><!-- #content -->
<?php get_sidebar(); ?>
		</div><!-- #wrap -->
<?php get_footer(); ?>