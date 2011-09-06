<?php
/**
 * The Template for displaying all staff single posts.
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
					<section class="entry-content">
						<?php if ( has_post_thumbnail() ) {
  							the_post_thumbnail('staff_single'); 
						} else  { 
							echo '<img src="'.get_bloginfo("template_url").'/images/AgriLife-default-post-image.png" alt="AgriLife Logo" title="AgriLife" />'; 
						}
						?>
						<?php $my_meta = get_post_meta($post->ID,'_my_meta',TRUE); ?>
						<div class="staff-person-details">
							<dl>	
							<dt><?php the_title(); ?></dt>
								<dd class="role"><?php echo $my_meta['position'];?></dd>
								<dd><?php echo $my_meta['room'];?></dd> 						
								<dd class="email"><a href="mailto:<?php echo $my_meta['email'];?>"><?php echo $my_meta['email'];?></a></dd>
								<dd><?php echo $my_meta['phone'];?></dd>  	
													
							<dt>Education</dt>
								<dd><?php echo $my_meta['education_1']; ?></dd>
								<dd><?php echo $my_meta['education_2'];?></dd>						
								<dd><?php echo $my_meta['education_3'];?></dd> 						
								<dd><?php echo $my_meta['education_4']; ?></dd>								
								
								
							</dl>	
								
						</div>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'agriflex' ), 'after' => '</div>' ) ); ?>
					</section><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
	
					<footer class="entry-meta">
						<section id="entry-author-info">
							<div id="author-avatar">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'agriflex_author_bio_avatar_size', 60 ) ); ?>
							</div><!-- #author-avatar -->
							<div id="author-description">
								<h2><?php printf( esc_attr__( 'About %s', 'agriflex' ), get_the_author() ); ?></h2>
								<?php the_author_meta( 'description' ); ?>
								<div id="author-link">
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'agriflex' ), get_the_author() ); ?>
									</a>
								</div><!-- #author-link	-->
							</div><!-- #author-description -->
						</section><!-- #entry-author-info -->
	<?php endif; ?>

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
<?php echo do_shortcode('[gigpress_related_shows]'); ?>
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>