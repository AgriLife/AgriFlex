<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( 'Browse: %s', 'agriflex' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
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
			while ( have_posts() ) : the_post();
				global $post;
				$my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
				
				$custom = get_post_custom($post->ID);
			
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


			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
