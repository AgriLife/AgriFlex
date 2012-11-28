<?php
/**
 * Hooks, filters, and template tags for the sidebar
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
 */

/**
 * Register action hook: agriflex_before_sidebar
 *
 * Located in sidebar.php after the opening aside div
 */
function agriflex_before_sidebar() {

  do_action( 'agriflex_before_sidebar' );

} // agriflex_after_sidebar

/**
 * Register action hook: agriflex_after_sidebar
 *
 * Located in sidebar.php after the opening aside div
 */
function agriflex_after_sidebar() {

  do_action( 'agriflex_after_sidebar' );

} // agriflex_after_sidebar

add_action( 'agriflex_before_sidebar', 'agriflex_logout_pages', 10 );
/**
 * Show the logout button on password-protected pages if logged in
 *
 * @since AgriFlex 2.0
 */
function agriflex_logout_pages() {
  
	do_action('posts_logout_link','Logout','logout_btn');

}

/**
 * Register widgetized areas, including two sidebars and four widget-ready areas in the sidebar.
 *
 * To override agriflex_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 * @since AgriFlex 1.0
 */
add_action( 'widgets_init', 'agriflex_widgets_init' );
function agriflex_widgets_init() {

  // Area 1, located at the top of the sidebar.
  register_sidebar( array(
    'name' => __( 'Right Column', 'agriflex' ),
    'id' => 'right-column-widget-area',
    'description' => __( 'The right column area', 'agriflex' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">
      <div class="widget-wrap">',
    'after_widget' => '</div></li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 4, located in the sidebar.
  register_sidebar( array(
    'name' => __( 'Sidebar Navigation', 'agriflex' ),
    'id' => 'sidebar-widget-navigation',
    'description' => __( 'Sidebar Navigation', 'agriflex' ),
    'before_title' => '<h3 class="widget-title"><a>',
    'after_title' => '</a></h3>',
  ) );  


  // Area 2, located in the second sidebar.
  register_sidebar( array(
    'name' => __( 'Right Column Bottom', 'agriflex' ),
    'id' => 'right-column-bottom-widget-area',
    'description' => __( 'The right column bottom widget area', 'agriflex' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">
      <div class="widget-wrap">',
    'after_widget' => '</div></li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 3
  register_sidebar( array(
    'name' => __( 'Home Page Bottom', 'agriflex' ),
    'id' => 'home-middle-1',
    'description' => __( 'Home Middle #1', 'agriflex' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );    

} // agriflex_widgets_init
