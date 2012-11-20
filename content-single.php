<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					        <?php if ( get_post_meta($post->ID, 'agnews_subtitle', true)) : ?>
						<h2 class="subtitle"><?php echo get_post_meta($post->ID, 'agnews_subtitle', true);?></h2>
						<?php endif; ?>
	
						<?php if ( get_post_meta($post->ID, 'agnews_contacts', true)) {
							$contacts = '<p id="contacts" class="contact_sources"><h3><span>Contacts</span></h3></p>'.get_post_meta($post->ID, 'agnews_contacts', true).'';
						} else {
							$contacts = '';
						} ?>
						<?php if ( 'post' == get_post_type() ) : ?>
						<div class="entry-meta">
							<?php agriflex_posted_on(); ?>
						</div><!-- .entry-meta -->
						<?php endif; ?>
					</header><!-- .entry-header -->
					
					<section class="entry-content">
						<?php the_content(); ?>
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
              <?php agriflex_edit_link(); ?>
						</section><!-- .entry-utility -->
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
