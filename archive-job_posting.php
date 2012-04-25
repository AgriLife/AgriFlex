<?php
/**
 * Archive: job_posting
 * @package WordPress
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">
				<h1 class="entry-title">Jobs</h1>
				<?php get_template_part( 'loop', 'job_listings' ); ?>
					
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>