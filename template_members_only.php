<?php
/**
 * @package WordPress
 * @subpackage Agrilife_Theme
 */
 /*
Template Name: Private: Must Be Logged In
*/
get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">

<?php if (is_user_logged_in()) { ?>
		       
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		  <h2><?php the_title(); ?></h2>
		  <div class="storycontent">
		    <?php the_content(__('(more...)')); ?>
		  </div>
		</div>
		<?php mail('travisward@gmail.com', 'members only template use!', 'used on '.get_permalink($post->ID));?>
	
		<?php mail('travisward@gmail.com', 'members only template use!', 'used on '.get_permalink($post->ID));?>
	<?php endwhile; endif; ?>     
	                   
<?php } else { ?>
		<div class="post"><div class="entry">You must <a href="<?php echo wp_login_url(); ?>" title="login">login</a> to view this page.</div></div>
<?php } ?>

			</div><!-- #content -->
		</div><!-- #wrap -->
	<?php get_sidebar(); ?>	
<?php get_footer(); ?>