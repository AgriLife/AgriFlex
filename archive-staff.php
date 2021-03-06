<?php
/**
 * The Template for displaying all staff single posts or pulling in staff web service for counties.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

    <?php

    agriflex_before_loop();

    $a = agriflex_agency();

    if ( ( $a['ext-type'] == 'county' || $a['ext-type'] == 'tce' ) && $a['single'] ) :


      // For County Extension Offices
      // This pulls from a managed staff database web service
      if ( have_posts() ) while ( have_posts() ) : the_post();

      county_office_info(); ?>


      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="entry-title"><?php the_title(); ?></h1>                   
        <div class="entry-content">
          <?php the_content(); ?>
        </div><!-- .entry-content -->
        <?php show_county_directory($options); ?>
      </div><!-- #post-## -->
      <?php endwhile; // end of the loop. ?>

    <?php else:
    // Everyone else gets info from 'Staff' custom post type ?>

      <?php agriflex_archive_title(); ?>

      <div class="staff-search-form">
        <label>
          <h4>Search Staff Database</h4>
        </label>
        <form role="search" class="searchform" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
          <input type="text" class="s" name="s" id="s" placeholder="Wilber B. Snodgrass" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><br />
          <input type="hidden" name="post_type" value="staff" />
        </form>
      </div><!-- .staff-search-form -->

      <ul class="staff-listing-ul">
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
        $my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
        ?>

        <li class="staff-listing-item">
          <div class="role staff-container">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
              <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail('staff_archive');
              } else  {
                echo '<img src="' . get_template_directory_uri() .'/images/AgriLife-default-staff-image.png?v=100" alt="AgriLife Logo" title="AgriLife" />';
              } ?>
            </a>
            <hgroup class="staff-head">
              <h2 class="staff-title" title="<?php the_title(); ?>">
                <a href="<?php the_permalink(); ?>"><?php echo $my_meta['firstname'] . ' ' . $my_meta['lastname']; ?></a>
              </h2>
              <h3 class="staff-position"><?php echo $my_meta['position']; ?></h3>
            </hgroup>                                  
            <div class="staff-contact-details">
              <p class="staff-phone tel"><?php echo $my_meta['phone']; ?></p>
              <p class="staff-email email"><a href="mailto:<?php echo $my_meta['email']; ?>"><?php echo $my_meta['email']; ?></a></p>
            </div><!-- .staff-contact-details -->
          </div><!-- .role .staff-container -->
          </a>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php agriflex_content_nav( 'nav-below' ); ?>
      <?php agriflex_after_loop(); ?>
      <?php wp_reset_query(); ?>

    <?php endif;?>

  </div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
