<?php
/**
 * The Template for displaying all single posts for VFIC Publications.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
					<hr /><i>Please contact individual journals to obtain a full copy of the publication.</i><hr />
						<h1 class="entry-title"><?php the_title(); ?></h1></br>
					        
						<h2 class="subtitle"><?php echo strip_tags(get_the_term_list($post->ID, 'PubsAuthor', 'Author(s): ', ', ' , '')); ?></h2>
						
						<div class="entry-meta">
							<p><?php echo strip_tags(get_the_term_list($post->ID, 'Journal', 'Journal: ', ', ', '')); 
									 echo strip_tags(get_the_term_list($post->ID, 'Year', ', (', ', ', ')')); ?>
							</p>
						</div><!-- .entry-meta -->
						
					</header><!-- .entry-header -->
					
					<section class="entry-content">
						
						<h3>Abstract:</h3><?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'agriflex' ), 'after' => '</div>' ) ); ?>
					</section><!-- .entry-content -->


						<p><h3>Non-Technical Summary: </h3><?php echo strip_tags(get_the_term_list($post->ID, 'nts', ' ', ', ', '')); ?></p>

						<section class="entry-utility">
							<?php agriflex_posted_in(); ?>
							<?php edit_post_link( __( 'Edit', 'agriflex' ), '<span class="edit-link">', '</span>' ); ?>
						</section><!-- .entry-utility -->
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
				
				<nav id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'agriflex' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'agriflex' ) . '</span>' ); ?></div>
				</nav><!-- #nav-below -->
								
				<?php comments_template( '', true ); ?>
				

<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>