<?php
/**
 * Template Name: Home: Default
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>
<div id="wrap">
  <div id="content" role="main">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if ( is_front_page() ) : ?>
          <h2 class="entry-title"><?php the_title(); ?></h2>
        <?php else : ?>	
          <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>				

        <div class="entry-content">
          <?php the_content(); ?>
          <?php wp_link_pages(
            array( 'before' => '<div class="page-link">' . __( 'Pages:',
            'county_ext' ), 'after' => '</div>' ) ); ?>
          <?php agriflex_edit_link(); ?>
        </div><!-- .entry-content -->
      </div><!-- #post-<?php the_ID(); ?> -->

    <?php endwhile; ?>	

    <div id="home-middle">
      <div class="home-middle-features">

        <?php 
        $my_query = new WP_Query(
                          array(
                            'meta_key'  => 'feature-homepage',
                            'meta_value'=> '1',
                            'showposts' => '3',
                            'post_type' => array( 'post', 'page' )
                          ));
        $count = 0;
        while ($my_query->have_posts()) : $my_query->the_post();
        $do_not_duplicate[] = $post->ID; $count++;
        global $post;
        ?>

          <div class="featured-wrap" id="featured-wrapper-<?php echo $count;?>">
            <h3 class="entry-title">
              <a href="<?php the_permalink();?>">
                <?php echo get_the_title(); ?>
              </a>
            </h3>
            <p>
              <?php agriflex_post_thumbnail(); ?>
            </p>

            <?php the_excerpt();?>
          </div><!-- end .featured-wrap -->

        <?php endwhile;  wp_reset_query(); ?>	
              
      </div><!-- end .home-features -->		

      <div class="home-middle-1">

        <?php if (!dynamic_sidebar('Home Page Bottom')) : ?>
          <div class="widget">
            <h2><?php _e("", 'agriflex'); ?></h2>
            <p><?php _e("", 'agriflex'); ?></p>
          </div>		
        <?php endif; ?>

      </div><!-- end .home-middle-1 -->
    </div><!-- end #home-middle -->				
  </div><!-- #content -->
</div><!-- #wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
