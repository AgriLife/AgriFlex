<?php

// Screen reader title attribute
$scr_title = esc_attr( 'Skip to content', 'agriflex' );

// Screen reader link display
$scr_display = __( 'Skip to content', 'agriflex' );

// Primary nav menu
$nav_menu = wp_nav_menu( array(
              'container_class' => 'menu-header',
              'theme_location'  => 'primary',
              'echo'            => false
            ));

?>

<nav id="access" role="navigation">		

  <!-- Allow screen readers / text browsers to skip the navigation
    menu and get right to the good stuff -->
  <div class="skip-link screen-reader-text">
    <a href="#content" title="<?php echo $scr_title; ?>">
      <?php echo $scr_display; ?>
    </a>
  </div>

  <!-- Our navigation menu.  If one isn't filled out, wp_nav_menu
    falls back to wp_page_menu.  The menu assiged to the primary
    position is the one used.  If none is assigned, the menu with the 
    lowest ID is used. -->

  <?php echo $nav_menu; ?>  

</nav><!-- .access -->
