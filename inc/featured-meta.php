<?php
/**
 * Adds the 'Featured Post' meta box to posts and pages.
 * The featured meta information is used for the slideshows.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */

add_action( 'add_meta_boxes', 'agriflex_add_custom_box' );

/* Adds a box to the main column on the Post and Page edit screens */
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
}

/* Prints the box content */
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

/* Do something with the data entered */
add_action( 'save_post', 'agriflex_save_postdata' );

function agriflex_save_postdata( $post_id ) {

  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
    return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
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

  // OK, we're authenticated: we need to find and save the data

  // Update The Value
  if ( ! empty( $_POST['agrilife_featured_post'] ) ) {
    $featured == 'on';
  } else {
    $featured == 'off';
  }
  update_post_meta($post_id, 'feature-homepage',
    ( $featured == 'on' ? 1 : 0 ) );
}
?>
