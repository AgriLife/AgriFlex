<?php
/**
 * Template Name: Tests
 * @package WordPress
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">
				<h1 class="entry-title">Tests</h1>
					<?php tvmdl_test_search() ?>
					<ul class="job-listing-ul">
				<?php $my_query = new WP_Query('post_type=tests&post_status=publish&posts_per_page=10');
			  		while ($my_query->have_posts()) : $my_query->the_post();
			  		global $post;
					$my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
			  	?>
					<li class="test-listing-item">
						<a class="test-listing-link" href="<?php echo $my_meta['link']; ?>">
							<h2 class="test-title" title="<?php the_title(); ?>"><?php the_title(); ?></h2>
						</a>
					</li>
					
					<?php endwhile;?>
					</ul>
					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('Previous entries') ?></div>
						<div class="alignright"><?php previous_posts_link('Next entries') ?></div>
					</div>
					<?php wp_reset_query(); ?>
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>