<?php
/**
 * The Template for displaying all job posting single posts.
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
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<?php if ( 'post' == get_post_type() ) : ?>
						<div class="entry-meta">
							<?php agriflex_posted_on(); ?>
						</div><!-- .entry-meta -->
						<?php endif; ?>
					</header><!-- .entry-header -->	
					<section class="entry-content">
						<?php $my_meta = get_post_meta($post->ID,'_my_meta',TRUE); ?>
						<div class="job-posting-details">
							<dl class="job-posting-dl">	
							<?php if ($my_meta['agency']) { ?>
							<dt class="job-posting-dt">Agency</dt>
								<dd class="job-posting-dd"><?php echo $my_meta['agency'];?></dd>
							<?php } ?>
							
							<?php if ($my_meta['location']) { ?> 
							<dt class="job-posting-dt">Location</dt>	
								<dd class="job-posting-dd"><?php echo $my_meta['location'];?></dd> 
							<?php } ?>
								
							<?php if ($my_meta['salary']) { ?>	
							<dt class="job-posting-dt">Salary</dt>							
								<dd class="job-posting-dd"><?php echo $my_meta['salary'];?></dd>
							<?php } ?>
							
							<?php if ($my_meta['apply-date']) { ?>	
							<dt class="job-posting-dt">Last Date to Apply</dt>							
								<dd class="job-posting-dd"><?php echo $my_meta['apply-date'];?></dd>
							<?php } ?>							
														
							<?php if ($my_meta['description']) { ?>	
							<dt class="job-posting-dt">Description</dt>	
								<dd class="job-posting-dd"><?php echo $my_meta['description'];?></dd>
							<?php } ?>	
								
							<?php if ($my_meta['qualifications']) { ?>
							<dt class="job-posting-dt">Qualifications</dt>	 
								<dd class="job-posting-dd"><?php echo $my_meta['qualifications'];?></dd> 
							<?php } ?>
							
							<?php if ($my_meta['job_number']) { ?>
							<dt class="job-posting-dt">Job Number</dt>											
								<dd class="job-posting-dd"><?php echo $my_meta['job_number'];?></dd>
							<?php } ?>
							
							<?php if ($my_meta['contact-name']) { ?>	 	
							<dt class="job-posting-dt">Contact Person</dt>
								<dd class="fn job-posting-dd"><?php echo $my_meta['contact-name'];?></dd>
							<?php } ?>
								
							<?php if ($my_meta['contact-phone']) { ?>	
							<dt class="job-posting-dt">Contact Phone</dt>	
								<dd class="tel job-posting-dd"><?php echo $my_meta['contact-phone'];?></dd> 
							<?php } ?>
								
							<?php if ($my_meta['contact-email']) { ?>	
							<dt class="job-posting-dt">Contact eMail</dt>							
								<dd class="email job-posting-dd"><a href="mailto:<?php echo $my_meta['contact-email'];?>"><?php echo $my_meta['contact-email'];?></a></dd> 
							<?php } ?>		
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
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>