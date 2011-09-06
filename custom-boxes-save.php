<?php 
// WP 3.0+
add_action( 'add_meta_boxes', 'staff_add_custom_box' );

// backwards compatible
// add_action( 'admin_init', 'staff_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'staff_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function staff_add_custom_box() {
    add_meta_box( 
        'staff_sectionid',
        __( 'Employee Details', 'staff_textdomain' ),
        'staff_inner_custom_box',
        'staff' 
    );
}

/* Prints the box content */
function staff_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'staff_noncename' );

// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'staff_new_field',TRUE);
	
  // The actual fields for data entry

  echo '<label for="staff_new_field">';
       _e("Position", 'staff_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="position" name="staff_new_field[position]" value="Staff Cheerleader" size="25" />';

  echo '<label for="email">';
       _e("email", 'staff_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="email" name="staff_new_field[email]" value="example@tamu.edu" size="25" />';

  echo '<label for="phone">';
       _e("phone", 'staff_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="phone" name="staff_new_field[phone]" value="777-777-777" size="25" />';
}

/* When the post is saved, saves our custom data */
function staff_save_postdata( $post_id ) {
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	    return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !wp_verify_nonce( $_POST['staff_noncename'], plugin_basename( __FILE__ ) ) )
	    return;


	// Check permissions
	if ( 'staff' == $_POST['post_type'] ) 
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

	$mydata = $_POST['staff_new_field'];
	
	my_meta_clean($mydata);
	
	// Do something with $mydata 
	// probably using add_post_meta(), update_post_meta(), or 
	$current_data = get_post_meta($post_id, 'staff_new_field', TRUE);
	
	if ($current_data) 
	{
		if (is_null($mydata)) delete_post_meta($post_id,'staff_new_field');
		else update_post_meta($post_id,'staff_new_field',$mydata);
	}
	elseif (!is_null($mydata))
	{
		add_post_meta($post_id,'staff_new_field',$mydata,TRUE);
	}
 
	return $post_id;
	}


function my_meta_clean(&$arr)
{
	if (is_array($arr))
	{
		foreach ($arr as $i => $v)
		{
			if (is_array($arr[$i])) 
			{
				my_meta_clean($arr[$i]);
 
				if (!count($arr[$i])) 
				{
					unset($arr[$i]);
				}
			}
			else 
			{
				if (trim($arr[$i]) == '') 
				{
					unset($arr[$i]);
				}
			}
		}
 
		if (!count($arr)) 
		{
			$arr = NULL;
		}
	}
}
?>