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

  <?php agriflex_post_title(); ?>

  <div class="entry-meta">
    <?php agriflex_posted_on(); ?>
  </div><!-- .entry-meta -->

  <?php if ( is_archive() || is_search() ) : ?>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
  <?php else : ?>
    <div class="entry-content">
      <?php agriflex_post_thumbnail(); ?>
      <?php the_excerpt(); ?>
    </div><!-- .entry-content -->
  <?php endif; ?>

</div><!-- #post-<?php the_ID(); ?> -->

<?php comments_template( '', true ); ?>


