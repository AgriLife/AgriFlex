<?php
/**
 * Template for displaying galleries.
 *
 * In AgriFlex 1.0 the category 'gallery' was used. Since its creation
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

  <h2 class="entry-title">
    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'agriflex' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
  </h2>

  <div class="entry-meta">
    <?php agriflex_posted_on(); ?>
  </div><!-- .entry-meta -->

  <div class="entry-content">
    <?php if ( post_password_required() ) : ?>
      <?php the_content(); ?>
    <?php else : ?>
      <div class="gallery-thumb">
        <?php
          $images = get_children( array(
            'post_parent' => $post->ID,
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => 999 )
          );
          $total_images = count( $images );
          $image = array_shift( $images );
          $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
        ?>
        <a class="size-thumbnail" href="<?php the_permalink(); ?>">
          <?php echo $image_img_tag; ?>
        </a>
      </div><!-- .gallery-thumb -->
      <p>
        <em>
          <?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.',
            'agriflex' ),
            'href="' . get_permalink() . '" title="' .
            sprintf( esc_attr__( 'Permalink to %s', 'agriflex' ),
              the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
              $total_images ); ?>
        </em>
      </p>

      <?php the_excerpt(); ?>
    <?php endif; ?>
  </div><!-- .entry-content -->

  <div class="entry-utility">
    <a href="<?php echo get_term_link(
      _x('gallery', 'gallery category slug', 'agriflex'), 'category' ); ?>"
      title="<?php esc_attr_e( 'View posts in the Gallery category',
      'agriflex' ); ?>">
    <?php _e( 'More Galleries', 'agriflex' ); ?>
    </a>
    <span class="meta-sep">|</span>
    <?php agriflex_comments_link(); ?>
    <?php agriflex_edit_link(); ?>
  </div><!-- .entry-utility -->

</div><!-- #post-<?php the_ID(); ?> -->
