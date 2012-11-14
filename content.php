<?php
/**
 * The default loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with content.php or
 * content-template.php, where 'template' is the loop context
 * requested by a template. For example, content-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'content', 'index' );</code>
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
 */
?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'agriflex' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php agriflex_posted_on(); ?>
			</div><!-- .entry-meta -->

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<a class="feature-img-excerpt" href="<?php the_permalink();?>">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail('featured-mediabox'); 
			} else  { 
				echo '<img src="'.get_bloginfo("template_url").'/images/AgriLife-default-post-image.png?v=100" alt="AgriLife Logo" title="AgriLife" />';
			}
			?></a>
		<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>
	
		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>


