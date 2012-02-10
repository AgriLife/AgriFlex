<?php

add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );

/* Do something with the data entered */
add_action( 'save_post', 'myplugin_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function myplugin_add_custom_box() {
    add_meta_box( 
        'agrilife_featured_post',
        __( 'Featured Post', 'myplugin_textdomain' ),
        'myplugin_inner_custom_box',
        'post',
        'side' 
    );
    add_meta_box(
        'agrilife_featured_post',
        __( 'Featured Page', 'myplugin_textdomain' ), 
        'myplugin_inner_custom_box',
        'page',
        'side'
    );
}

/* Prints the box content */
function myplugin_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );

  // The actual fields for data entry
  echo '<label for="agrilife_featured_post">';
       _e("Feature this on the home page", 'myplugin_textdomain' );
  echo '</label> ';
  echo '<input type="checkbox" name="agrilife_featured_post" id="agrilife_featured_post" ', (get_post_meta($post->ID,'feature-homepage', true )== 1 ? ' checked="checked"' : ''), ' />';
  
}

/* When the post is saved, saves our custom data */
function myplugin_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data

  // Update The Value
  update_post_meta($post_id, 'feature-homepage', ($_POST['agrilife_featured_post'] == 'on' ? 1 : 0));
}
?>