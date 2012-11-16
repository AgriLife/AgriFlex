<?php
/**
 * Template for displaying asides.
 *
 * In AgriFlex 1.0 the category 'asides' was used. Since its creation
 * post formats were introduced to WordPress. We have implemented post formats
 * into 2.0 and have created a function to maintain backwards compatibility.
 *
 * @see inc/helpers.php
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @package AgriFlex
 * @since AgriFlex 2.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <!-- Display excerpts for archives and search. -->
  <?php if ( is_archive() || is_search() ) :  ?>

    <div class="entry-summary">
    <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->			

  <?php else : ?>

    <div class="entry-content">
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>',
        'agriflex' ) ); ?>
    </div><!-- .entry-content -->

  <?php endif; ?>

  <div class="entry-utility">
    <?php agriflex_posted_on(); ?>
    <span class="meta-sep">|</span>
    <span class="comments-link">
      <?php comments_popup_link( __( 'Leave a comment', 'agriflex' ),
        __( '1 Comment', 'agriflex' ), __( '% Comments', 'agriflex' ) ); ?>
    </span>
    <?php edit_post_link( __( 'Edit', 'agriflex' ),
      '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
  </div><!-- .entry-utility -->

</div><!-- #post-<?php the_ID(); ?> -->
