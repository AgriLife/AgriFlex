<?php
/**
 * Template Name: Staff
 *
 * The Template for displaying all staff single posts or pulling in staff web
 * service for counties.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

    <?php
    $a = agriflex_agency();

    if ( ($a['ext-type'] == 'county' || $a['ext-type'] == 'tce' ) && $a['single'] ) :
      ?>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php
      require_once (MY_THEME_FOLDER . '/inc/counties.php');
      // For County Extension Offices
      // This pulls from a managed staff database web service
      if ( have_posts() ) while ( have_posts() ) : the_post();
      county_office_info(); ?>


      <div id="post-<?php the_ID(); ?>">             
      <div class="entry-content">
      <?php the_content(); ?>
      </div><!-- .entry-content -->

      </div><!-- #post-## -->
      <?php endwhile; // end of the loop. ?>
      <?php show_county_directory($options); ?>

    <?php else:
    // Everyone else gets info from 'Staff' custom post type ?>

      <h1 class="entry-title"><?php the_title(); ?></h1>
      <div class="staff-search-form">
        <label>
          <h4>Search Staff Database</h4>
        </label>
        <form role="search" class="searchform" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
          <input type="text" class="s" name="s" id="s" placeholder="Wilber B. Snodgrass" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
          <input type="hidden" name="post_type" value="staff" />
        </form>
      </div><!-- staff-search-form -->

      <ul class="people-listing-ul">
        <?php 
        $args = array(
        'post_type' => 'staff',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
        );

        $my_query = new WP_Query($args);

        // The Loop
        while ($my_query->have_posts()) : $my_query->the_post();	
          $my_meta = get_post_meta($post->ID,'_my_meta');
          if(empty($my_meta)){
            $meta = get_post_meta( $post->ID );
            $my_meta = array(
              'firstname' => $meta['als_first-name'][0],
              'lastname' => $meta['als_last-name'][0],
              'position' => !empty($meta['als_position']) ? $meta['als_position'][0] : '',
              'phone' => !empty($meta['als_phone']) ? $meta['als_phone'][0] : '',
              'email' => !empty($meta['als_email']) ? $meta['als_email'][0] : ''
            );
          }
          ?><li class="people-listing-item">
            <div class="role people-container">
              <div class="people-image">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail('staff_archive');
                } else  {
                echo '<img src="' . get_stylesheet_directory_uri() .'/img/AgriLife-default-staff-image.png?v=100" alt="AgriLife Logo" title="AgriLife" />';
                }
                ?></a>
              </div>
              <div class="people-head">
                <h3 class="people-name" title="<?php the_title(); ?>">
                  <a href="<?php the_permalink(); ?>"><?php echo $my_meta['firstname'].' '.$my_meta['lastname']; ?></a>
                </h3>
                <?php
                if (!empty($my_meta['position'])){
                  ?><h4 class="people-title"><?php echo $my_meta['position']; ?></h4><?php
                }
                ?>
              </div>
              <div class="people-contact-details">
                <?php
                if (!empty($my_meta['phone'])){
                  ?><p class="people-phone tel"><?php echo $my_meta['phone']; ?></p><?php
                }
                ?>
                <?php
                if (!empty($my_meta['email'])){
                  ?><p class="people-email email"><a href="mailto:<?php echo $my_meta['email']; ?>"><?php echo $my_meta['email']; ?></a></p><?php
                }
                ?>
              </div><!-- .staff-contact-details -->
            </div><!-- .role .staff-container -->
          </li>
        <?php endwhile; ?>
      </ul>
      <?php agriflex_content_nav( 'nav-below' ); ?>
      <?php wp_reset_query(); ?>

    <?php endif;?>

  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
