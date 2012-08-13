<?php
/**
 * The Template for displaying publications search results.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */

get_header(); 
if('' <> $_GET['searchtests'] ) {
	$myquery['s'] = strtolower($_GET['searchpubs']);
}

?>

		<div id="wrap">
			<div id="content" role="main">
				<?php if ( function_exists('vfic_pubs_forms_shortcode')) 
					vfic_pubs_forms_shortcode(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php global $post; $my_meta = get_post_meta($post->ID,'_my_meta',TRUE); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
						<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

				</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>