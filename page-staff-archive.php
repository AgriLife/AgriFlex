<?php
/**
 * Template Name: Staff
 * @package WordPress
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">
				<h1 class="entry-title">Staff</h1>
					<div class="staff-search-form">
						<label>
						<h4>Search Staff Database</h4>
						</label>
						<form role="search" class="searchform" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
							<input type="text" class="s" name="s" id="s" placeholder="Wilber B. Snodgrass" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
							<input type="hidden" name="post_type" value="staff" />
						</form>
					</div>
					<ul class="staff-listing-ul">
				<?php $my_query = new WP_Query('post_type=staff&post_status=publish&posts_per_page=10');
			  		while ($my_query->have_posts()) : $my_query->the_post();
			  		global $post;
					$my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
			  	?>
					<li class="staff-listing-item">
						<a class="staff-listing-link" href="<?php the_permalink(); ?>">
						<div class="role">
							<hgroup class="staff-head">
							<h2 class="staff-title" title="<?php the_title(); ?>"><?php the_title(); ?></h2>
							<h3 class="staff-position"><?php echo $my_meta['position']; ?></h3>
							</hgroup>							
							<div class="staff-contact-details">
								<p class="staff-phone tel"><?php echo $my_meta['phone']; ?></p>
								<p class="staff-email email"><?php echo $my_meta['email']; ?></p>
							</div>
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
<?php get_footer(); ?>t_footer(); ?>