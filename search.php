<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">

<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'agriflex' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
				<?php
					global $query_string;
					$termslug = $_GET['species'];
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'agriflex' ); ?></h2>
					<div class="entry-content">
						<?php 

							if (empty($termslug)) {
								query_posts($query_string);
								if(have_posts()) : while(have_posts()) : the_post();
								endwhile; else:
								_e('Sorry, no listings matched your criteria or you forgot select a category.');
								endif;
							} 

							if (!empty($termslug)) {
							         query_posts(array('species' => $termslug) );
								if(have_posts()) : while(have_posts()) : the_post();
								endwhile; else:
								_e('Sorry, no listings matched your criteria or you forgot select a category.');
								endif;
							}
						?>
						
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
