<?php
/**
 * Template Name: Private: Must Be Logged In
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

  <?php if (is_user_logged_in()) : ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
      <h2><?php the_title(); ?></h2>
      <div class="storycontent">
        <?php the_content(__('(more...)')); ?>
      </div><!-- #post-<?php the_ID(); ?> -->
    </div>

    <?php endwhile; endif; ?>     
           
  <?php else : ?>

    <div class="post">
      <div class="entry">
        <p>
          You must <a href="<?php echo wp_login_url(); ?>" title="login">login</a> to view this page.
        </p>
      </div><!-- .entry -->
    </div><!-- .post -->

  <?php endif; ?>

  </div><!-- #content -->
</div><!-- #wrap -->
<?php get_sidebar(); ?>	
<?php get_footer(); ?>
