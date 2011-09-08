<?php
/**
 * Template Name: Job Posting
 * @package WordPress
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">
				<h1 class="entry-title">Jobs</h1>
					<div class="job-search-form">
						<label>
						<h4>Search Job Board Database</h4>
						</label>
						<form role="search" class="searchform" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
							<input type="text" class="s" name="s" id="s" placeholder="Wildlife Biologist" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
							<input type="hidden" name="post_type" value="job_posting" />
						</form>
					</div>
					<ul class="job-listing-ul">
				<?php $my_query = new WP_Query('post_type=job_posting&post_status=publish&posts_per_page=10');
			  		while ($my_query->have_posts()) : $my_query->the_post();
			  		global $post;
					$my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
			  	?>
					<li class="job-listing-item">
						<a class="job-listing-link" href="<?php the_permalink(); ?>">
						<div class="role">
							<h2 class="job-title"><title="<?php the_title(); ?>"><?php the_title(); ?></h2>
							<h3 class="job-agency"><?php echo $my_meta['agency']; ?></h3>
							<p class="job-location location"><?php echo $my_meta['location']; ?></p>
							<p class="job-type type"><?php echo $my_meta['type']; ?></p>
						</div>
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