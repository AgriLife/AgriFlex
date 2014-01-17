<?php
/**
 * Adds the 'Featured Post' meta box to posts and pages.
 * The featured meta information is used for the slideshows.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */

/**
 * Adds a box to the main column on the Post and Page edit screens
 *
 * @since AgriFlex 1.0
 */
function agriflex_add_custom_box() {
  add_meta_box( 
    'agrilife_featured_post',
    __( 'Featured Post', 'agriflex' ),
    'agriflex_inner_custom_box',
    'post',
    'side' 
  );
  add_meta_box(
    'agrilife_featured_post',
    __( 'Featured Page', 'agriflex' ), 
    'agriflex_inner_custom_box',
    'page',
    'side'
  );
} // agriflex_add_custom_box
add_action( 'add_meta_boxes', 'agriflex_add_custom_box' );

/**
 * Prints the box content
 *
 * @since AgriFlex 1.0
 * @param object $post The Post object
 */
function agriflex_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'agriflex_noncename' );

  // The actual fields for data entry
  $html = '<label for="agrilife_featured_post">';
  $html .= __('Feature this on the home page', 'agriflex' );
  $html .= '</label> ';
  $html .= '<input type="checkbox" name="agrilife_featured_post" id="agrilife_featured_post" ';
  if ( get_post_meta( $post->ID, 'feature-homepage', true ) == 1 ) {
    $html .= ' checked="checked"';
  }
  $html .= ' />';
  
  echo $html;

}

/**
 * Do something with the data entered
 *
 * @since AgriFlex 1.0
 * @param ing $post_id The post ID
 */
function agriflex_save_postdata( $post_id ) {

  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
    return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( ! empty($_POST['agriflex_noncename'] ) ) {
    if ( ! wp_verify_nonce( $_POST['agriflex_noncename'],
      plugin_basename( __FILE__ ) ) )
        return;


    // Check permissions
    if ( 'page' == $_POST['post_type'] ) {
      if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
    } else {
      if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
    }
  }

  // OK, we're authenticated: we need to find and save the data

  // Update The Value
  if ( ! empty( $_POST['agrilife_featured_post'] ) ) {
    $featured = 'on';
  } else {
    $featured = 'off';
  }
  update_post_meta($post_id, 'feature-homepage',
    ( $featured == 'on' ? 1 : 0 ) );
} // agriflex_save_postdata
add_action( 'save_post', 'agriflex_save_postdata' );

/**
 * Create the slider field on appropriate page templates
 */
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_slider',
    'title' => 'Slider',
    'fields' => array (
      array (
        'key' => 'field_528f9c5161764',
        'label' => __('Slider'),
        'name' => 'college-home-slider',
        'type' => 'post_object',
        'post_type' => array (
          0 => 'soliloquy',
        ),
        'taxonomy' => array (
          0 => 'all',
        ),
        'allow_null' => 0,
        'multiple' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-home-fullwidth-slideshow.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-home-slideshow-2.php',
          'order_no' => 0,
          'group_no' => 1,
        ),
      ),
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-home-slideshow.php',
          'order_no' => 0,
          'group_no' => 2,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}

