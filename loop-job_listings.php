<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * Used in archive.php
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
?>


	<div class="job-search-form">
		<label>
		<h4>Search Job Board Database</h4>
		</label>
		<form role="search" class="searchform" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
			<input type="text" class="s" name="s" id="s" placeholder="Wildlife Biologist" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
			<input type="hidden" name="post_type" value="job_posting" />
		</form>
	</div>
				
	<?php 
		//might need to beef up the search later
	 	//job_posting_search($_GET['job_type'],$_GET['searchjobpostings']); 
	?>		

	<?php /* If there are no tests to display, let the user know */ ?>
	<?php if ( ! have_posts() ) : ?>
		<div id="post-0" class="post error404 not-found">
			<h1 class="entry-title"><?php _e( 'Not Found', 'agriflex' ); ?></h1>
			<div class="entry-content">
				<p><?php _e( 'Apologies, but no jobs were found that match your search criteria.', 'agriflex' ); ?></p>
			</div><!-- .entry-content -->
		</div><!-- #post-0 -->
	<?php endif; ?>
	
	
	<ul class="job-listing-ul">
	<?php	
			while (have_posts()) : the_post();
				global $post;
			$my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
			
			$custom = get_post_custom($post->ID);
			
			//echo '<hr />my_meta:<pre>'.print_r($my_meta['agency']).'</pre>';
			//echo 'agency: '.$my_meta['agency'];
			//echo '<hr />custom:<pre>'.print_r($custom).'</pre>';
		
			$job_number     = ($my_meta['job_number']<>'' ? $my_meta['job_number']	: $custom["job_number"][0]);
			if($job_number=='')
				$job_number = get_the_ID();
			$agency 		= ($my_meta['agency']<>'' ? $my_meta['agency'] 			: $custom["agency"][0]);
			$location		= ($my_meta['location']<>'' ? $my_meta['location'] 		: $custom["location"][0]);
				?>
			<li class="job-listing-item">
				<a class="job-listing-link" href="<?php the_permalink(); ?>">
				<div class="role">
					<h2 class="job-title" title="<?php the_title(); ?>"><?php the_title(); ?></h2>
					<h3 class="job-agency"><?php echo $agency; ?></h3>
					<h4 class="job-posted-date">Posted: <?php echo get_the_date('M-d-y'); ?></h4>
					<h4 class="job-number">Job: <?php echo $job_number; ?></h4>
					<p class="job-location location"><?php echo $location; ?></p>
					<!--<p class="job-type type"></p>-->
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