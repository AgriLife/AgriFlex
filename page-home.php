<?php
/**
 * Template Name: Home Page
 * @package WordPress
 */

get_header(); ?>
			<div id="content" role="main">		
		<?php $my_query = new WP_Query('meta_key=feature-homepage&meta_value=1&showposts=5&post_type=any');
		$count = 0;	?>
  		<?php if ( $my_query->have_posts() ) : ?>

		<div id="home-top">	
		<div id="big-feature">
		<?php while ($my_query->have_posts()) : $my_query->the_post();
  		global $post;
 		$count++;
  		$feature_title = get_post_meta($post->ID,'feature-title',true);?>

		<div class="feature-item-<?php echo $count;?>">			
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail('featured');?></a>
			<div class="feature-detail">
				<h2><a href="<?php the_permalink();?>"><?php if($feature_title !== '') { echo $feature_title; }else{ echo get_the_title(); } ?></a></h2>
			</div><!-- end .feature-detail -->
		</div><!-- end .feature-item -->	
							
		<?php endwhile;  wp_reset_query; ?>
		
		</div><!-- end #big-feature -->	
		<div id="slideshow-nav">
		<a href="#" class="slidePrev"></a> <a href="#" class="slideNext"></a>
		</div><!-- #slideshow-nav -->
		<div id="slidePager"></div>											
		</div><!-- end #home-top -->
		<?php endif;?>	


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>	
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>				

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'county_ext' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'county_ext' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; ?>
		
<div id="home-middle-bg">
	<div id="home-middle">
		
		<div class="home-middle-1">
			<?php if (!dynamic_sidebar('Home Page Bottom')) : ?>
			<div class="widget">
				<h2><?php _e("Home Page Bottom Widget", 'county_ext'); ?></h2>
				<p><?php _e("This is a widgeted area which is called Home Middle #1. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Middle #1 widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit post screen and publish your page. The Featured Page widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
			</div>		
			<?php endif; ?>
		</div><!-- end .home-middle-1 -->

    </div><!-- end #home-middle -->
</div><!-- end #home-middle-bg -->
			
			</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>