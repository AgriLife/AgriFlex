<?php
/**
 * The template for displaying attachments.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <p class="page-title">
    <a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'agriflex' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery">
      <?php
        /* translators: %s - title of parent post */
        printf( __( '<span class="meta-nav">&larr;</span> %s', 'agriflex' ),
          get_the_title( $post->post_parent ) );
      ?>
    </a>
  </p>

  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php agriflex_post_title( '', FALSE ); ?>

    <div class="entry-meta">
      <?php agriflex_posted_on(); ?>
      <?php
      if ( wp_attachment_is_image() ) {
        echo ' <span class="meta-sep">|</span> ';

        $metadata = wp_get_attachment_metadata();

        printf( __( 'Full size is %s pixels', 'agriflex'),
          sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
            wp_get_attachment_url(),
            esc_attr( __('Link to full-size image', 'agriflex') ),
            $metadata['width'],
            $metadata['height']
          )
        );
      }
      ?>

      <?php agriflex_edit_link(); ?>
    </div><!-- .entry-meta -->

    <div class="entry-content">
      <div class="entry-attachment">

      <?php if ( wp_attachment_is_image() ) :
      $attachments = array_values(
        get_children( array(
          'post_parent' => $post->post_parent,
          'post_status' => 'inherit',
          'post_type' => 'attachment',
          'post_mime_type' => 'image',
          'order' => 'ASC',
          'orderby' => 'menu_order ID' ) )
      );

      foreach ( $attachments as $k => $attachment ) {
        if ( $attachment->ID == $post->ID )
          break;
      }

      $k++;

      // If there is more than 1 image attachment in a gallery
      if ( count( $attachments ) > 1 ) {
        if ( isset( $attachments[ $k ] ) ) {
          // get the URL of the next image attachment
          $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
        } else {
          // or get the URL of the first image attachment
          $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
        }
      } else {
        // or, if there's only 1 image attachment, get the URL of the image
        $next_attachment_url = wp_get_attachment_url();
      }
      ?>

      <p class="attachment">
        <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
        <?php
        $attachment_size = apply_filters( 'agriflex_attachment_size', 900 );

        echo wp_get_attachment_image( $post->ID,
          array( $attachment_size, 9999 ) ); 
        ?>
        </a>
      </p>

      <?php agriflex_content_nav( 'nav-below' ); ?>

      <?php else : ?>

        <a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
          <?php echo basename( get_permalink() ); ?>
        </a>

      <?php endif; ?>

      </div><!-- .entry-attachment -->

      <div class="entry-caption">
        <?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
      </div>

      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'agriflex' ) ); ?>

      <?php wp_link_pages( array(
        'before' => '<div class="page-link">' . __( 'Pages:', 'agriflex' ),
        'after' => '</div>' ) ); ?>

    </div><!-- .entry-content -->

    <div class="entry-utility">
      <?php agriflex_posted_in(); ?>
      <?php agriflex_edit_link(); ?>
    </div><!-- .entry-utility -->

  </div><!-- #post-<?php the_ID(); ?> -->

  <?php comments_template(); ?>

  <?php endwhile; ?>

  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_footer(); ?>
