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

<?php 
		global $query_string;
			$tax_query = array('relation' => 'OR');
				if ($_GET['pubsauthor'])
				{
					$tax_query[] =  array(
							'taxonomy' => 'PubsAuthor',
							'field' => 'slug',
							'terms' => array($_GET['pubsauthor'])
						);
				}
				if ($_GET['pubsyear'])
				{
					$tax_query[] =  array(
							'taxonomy' => 'Year',
							'field' => 'slug',
							'terms' => array($_GET['pubsyear'])
						);
				}
				if ($_GET['vs'])
				{
					$tax_query['s'] = strtolower($_GET['vs']);
				}				
				
			$query = new WP_Query(
				array(
					//Retreive ALL publications posts
					'post_type' => 'vfic_publications',
					'posts_per_page' => '10',
					'tax_query' => $tax_query
				)
			);
		?>
		
		<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( '%s', 'agriflex' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>

		<?php elseif ( $query->have_posts() ) : ?>
		
				<p><h2>Your search returned<?php /* Search Count */ $allsearch = &new WP_Query(array(
				//Retreive ALL publications posts
				'post_type' => 'vfic_publications',
				'posts_per_page' => '10',
				'tax_query' => $tax_query
				)); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('result(s)'); wp_reset_query(); ?></h2><br/>
			
			<i>Please contact individual journals to obtain a full copy of the publication.</i><hr /><hr /></p>

			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'agriflex' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2><br/><hr />
				
			<?php endwhile; // End the loop. Whew. ?>
					
		<?php else : ?>
						<div id="post-0" class="post no-results not-found">
							<h2 class="entry-title"><?php _e( 'Nothing Found', 'agriflex' ); ?></h2>
							<div class="entry-content">
								<p><?php _e( 'Sorry, but nothing.. matched your search criteria. Please try again with some different keywords.', 'agriflex' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</div><!-- #post-0 -->
		<?php endif; ?>