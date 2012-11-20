<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'agriflex' ), 'after' => '</div>' ) ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>

    <?php if ( get_post_meta($post->ID, 'agnews_subtitle', true)) : ?>
      <h2 class="subtitle">
        <?php echo get_post_meta($post->ID, 'agnews_subtitle', true);?>
      </h2>
    <?php endif; ?>

    <?php if ( get_post_meta( $post->ID, 'agnews_contacts', true ) ) {
      $contacts = '<p id="contacts" class="contact_sources">
          <h3><span>Contacts</span></h3>
          </p>' .
        get_post_meta( $post->ID, 'agnews_contacts', true ) . '';
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
  </section><!-- .entry-content -->

  <footer class="entry-meta">
    <?php agriflex_author_info(); ?>

    <section class="entry-utility">
      <?php agriflex_posted_in(); ?>
      <?php agriflex_edit_link(); ?>
    </section><!-- .entry-utility -->

  </footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
