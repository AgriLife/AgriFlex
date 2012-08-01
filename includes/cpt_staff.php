<?php
/* Staff Custom Post Type */

add_action( 'init', 'create_staff_post_type' );
     function create_staff_post_type() {
          register_post_type( 'staff',
               array(
                    'labels' => array(
                         'name' => __( 'Staff' ),
                         'singular_name' => __( 'Employee' ),
                         'add_new_item' => __( 'Add New Staff Employee' ),
                         'add_new' => __( 'Add New' ),
                         'edit' => __( 'Edit' ),
                         'edit_item' => __( 'Edit Staff Employee' ),
                         'new_item' => __( 'New Staff Employee' ),
                         'view' => __( 'View Staff Employee' ),
                         'view_item' => __( 'View Staff Employee' ),
                         'search_items' => __( 'Search Staff Employees' ),
                         'not_found' => __( 'No Staff Employees found' ),
                         'not_found_in_trash' => __( 'No Staff Employees found in Trash' ),
    
                    ),
               'capability_type' => 'page',
               'hierarchical' => true,
               'has_archive' => true,
               'public' => true,
               'public' => true,
               'rewrite' => array('slug' => 'staff'),
               'supports' => array( 'editor','thumbnail' ),
               )
          );
     }
       // Add new taxonomy, make it hierarchical (like categories)
     $labels = array(
          'name' => _x( 'Type', 'taxonomy general name' ),
          'singular_name' => _x( 'Type', 'taxonomy singular name' ),
          'search_items' =>  __( 'Search Types' ),
          'all_items' => __( 'All Types' ),
          'parent_item' => __( 'Parent Type' ),
          'parent_item_colon' => __( 'Parent Types:' ),
          'edit_item' => __( 'Edit Type' ),
          'update_item' => __( 'Update Type' ),
          'add_new_item' => __( 'Add New Type' ),
          'new_item_name' => __( 'New Type Name' ),
     );     

     register_taxonomy( 'types', array( 'staff' ), array(
          'hierarchical' => true,
          'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
          'show_ui' => true,
          'query_var' => true,
          'rewrite' => false,
     ));
     
     
/* Define the custom box */
add_action('admin_init','staff_meta_init');
 
function staff_meta_init() {

     // review the function reference for parameter details
     // http://codex.wordpress.org/Function_Reference/add_meta_box
 
     // add a meta box for each of the wordpress page types: posts and pages
     foreach (array('staff') as $type)
     {
          add_meta_box('staff_details_meta', 'Enter Employee Details', 'staff_details_meta_setup', $type, 'normal', 'high');
     }
 
     // add a callback function to save any data a user enters in
     add_action('save_post','box_meta_save');
    
     // Populate Title Field with _my_meta[lastname], _my_meta[firstname] for alphabetical sorting by title
     add_filter('title_save_pre', 'save_staff_title');
}


function save_staff_title($people_title) {
	$_post_meta = $_POST['_my_meta'];
	if ($_POST['post_type'] == 'staff') :
	  $fname = $_post_meta['firstname'];
	  $lname = $_post_meta['lastname'];
	  $people_title = $lname.', '.$fname;
	endif;
	return $people_title;
}
 
function staff_details_meta_setup() {
	global $post;
	
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_my_meta',TRUE);
	// The Details fields for data entry
	// instead of writing HTML here, lets do an include
	?>
	<h4>Contact Details</h4>
	
	<p><label  class="admin-form-label" for="lastname">First Name</label>
	<input type="text" class="admin-form-input" id="firstname" name="_my_meta[firstname]" value="<?php if(!empty($meta['firstname'])) echo $meta['firstname']; ?>" placeholder="e.g. John" size="25" /></p>
	
	<p><label  class="admin-form-label" for="lastname">Last Name</label>
	<input type="text" class="admin-form-input" id="lastname" name="_my_meta[lastname]" value="<?php if(!empty($meta['lastname'])) echo $meta['lastname']; ?>" placeholder="e.g. Doe" size="25" /></p>	
	
	<p><label  class="admin-form-label" for="position">Position</label>
	<input type="text" class="admin-form-input" id="position" name="_my_meta[position]" value="<?php if(!empty($meta['position'])) echo $meta['position']; ?>" placeholder="e.g. Distinguished Professor" size="25" /></p>
	
	<p><label  class="admin-form-label" for="room">Building/Room</label>
	<input type="text" class="admin-form-input" id="room" name="_my_meta[room]" value="<?php if(!empty($meta['room'])) echo $meta['room']; ?>" placeholder="e.g. Building 555 Room 555" size="25" /></p>	
	
	<p><label class="admin-form-label"  for="website">Website</label>
	<input type="text" class="admin-form-input" id="website" name="_my_meta[website]" value="<?php if(!empty($meta['website'])) echo $meta['website']; ?>" placeholder="e.g. http://awesomeness.tamu.edu" size="25" /></p>	

	<p><label class="admin-form-label"  for="phone">Phone</label>
	<input type="text" class="admin-form-input" id="phone" name="_my_meta[phone]" value="<?php if(!empty($meta['phone'])) echo $meta['phone']; ?>" placeholder="e.g. 777-777-7777" size="25" /></p>
	
	<p><label class="admin-form-label" for="email">eMail</label>
	<input type="text" class="admin-form-input" id="email" name="_my_meta[email]" value="<?php if(!empty($meta['email'])) echo $meta['email']; ?>" placeholder="e.g. janedoe@tamu.edu" size="25" /></p>	
	
	<h4>Education</h4>
	<p><label  class="admin-form-label" for="undergraduate_1">Undergraduate #1</label>
	<input type="text" class="admin-form-input" id="undergraduate_1" name="_my_meta[undergraduate_1]" value="<?php if(!empty($meta['undergraduate_1'])) echo $meta['undergraduate_1']; ?>" placeholder="e.g. B.A., Loughborough College, 1964" size="40" /></p>
	<p><label  class="admin-form-label" for="undergraduate_2">Undergraduate #2</label>	
	<input type="text" class="admin-form-input" id="undergraduate_2" name="_my_meta[undergraduate_2]" value="<?php if(!empty($meta['undergraduate_2'])) echo $meta['undergraduate_2']; ?>" placeholder="e.g. B.S., Loughborough College, 1966" size="40" /></p>	
		
	<p><label  class="admin-form-label" for="graduate_1">Graduate #1</label>
	<input type="text" class="admin-form-input" id="graduate_1" name="_my_meta[graduate_1]" value="<?php if(!empty($meta['graduate_1'])) echo $meta['graduate_1']; ?>" placeholder="e.g. M.S., Texas A&amp;M University, 1970" size="40" /></p>			
		
	<p><label  class="admin-form-label" for="graduate_2">Graduate #2</label>
	<input type="text" class="admin-form-input" id="graduate_2" name="_my_meta[graduate_2]" value="<?php if(!empty($meta['graduate_2'])) echo $meta['graduate_2']; ?>" placeholder="e.g. M.A., Texas A&amp;M University, 1977" size="40" /></p>	
			
	<p><label  class="admin-form-label" for="graduate_3">Graduate #3</label>
	<input type="text" class="admin-form-input" id="graduate_3" name="_my_meta[graduate_3]" value="<?php if(!empty($meta['graduate_3'])) echo $meta['graduate_3']; ?>" placeholder="e.g. Ph.D., Texas A&amp;M University, 1983" size="40" /></p>	
	
	<h4>Details</h4>
	<p><label  class="admin-form-label" for="specialty">Specialty</label>
	<input type="text" class="admin-form-input" id="specialty" name="_my_meta[specialty]" value="<?php if(!empty($meta['specialty'])) echo $meta['specialty']; ?>" placeholder="e.g. Youth Development" size="25" /></p>	
		
	<p><label class="admin-form-label"  class="admin-form-label" for="research">Description</label>
	<textarea class="admin-form-input" id="research" name="_my_meta[research]" cols="65" rows="10"><?php if(!empty($meta['research'])) echo $meta['research']; ?></textarea></p>

	<h4>Awards</h4>	
	<p><label  class="admin-form-label" for="award_1">Award #1</label>
	<input type="text" class="admin-form-input" id="award_1" name="_my_meta[award_1]" value="<?php if(!empty($meta['award_1'])) echo $meta['award_1']; ?>" placeholder="e.g. Bradberry Scholarship Recipient (2007 &amp; 2008) Texas A&amp;M University" size="60" /></p>
					
	<p><label  class="admin-form-label" for="award_2">Award #2</label>
	<input type="text" class="admin-form-input" id="award_2" name="_my_meta[award_2]" value="<?php if(!empty($meta['award_2'])) echo $meta['award_2']; ?>" placeholder="e.g. Graduate Merit Fellowship (2006) Texas A&amp;M University" size="60" /></p>	
			
	<p><label  class="admin-form-label" for="award_3">Award #3</label>
	<input type="text" class="admin-form-input" id="award_3" name="_my_meta[award_3]" value="<?php if(!empty($meta['award_3'])) echo $meta['award_3']; ?>" placeholder="e.g. Utah Recreation and Parks Association Graduate Student Award (2006)" size="60" /></p>	

	<h4>Courses Taught</h4>	
	<p><label  class="admin-form-label" for="course_1">Course #1</label>
	<input type="text" class="admin-form-input" id="course_1" name="_my_meta[course_1]" value="<?php if(!empty($meta['course_1'])) echo $meta['course_1']; ?>" placeholder="e.g. Program Planning" size="40" /></p>
					
	<p><label  class="admin-form-label" for="course_2">Course #2</label>
	<input type="text" class="admin-form-input" id="course_2" name="_my_meta[course_2]" value="<?php if(!empty($meta['course_2'])) echo $meta['course_2']; ?>" placeholder="e.g. Youth Development Organizations &amp; Services" size="40" /></p>	
			
	<p><label  class="admin-form-label" for="course_3">Course #3</label>
	<input type="text" class="admin-form-input" id="course_3" name="_my_meta[course_3]" value="<?php if(!empty($meta['course_3'])) echo $meta['course_3']; ?>" placeholder="e.g. Leisure and Outdoor Recreation" size="40" /></p>		
					
	<p><label  class="admin-form-label" for="course_4">Course #4</label>
	<input type="text" class="admin-form-input" id="course_4" name="_my_meta[course_4]" value="<?php if(!empty($meta['course_4'])) echo $meta['course_4']; ?>" placeholder="e.g. Introduction to Leadership for Outdoor Education" size="40" /></p>	
			
	<p><label  class="admin-form-label" for="course_5">Course #5</label>
	<input type="text" class="admin-form-input" id="course_5" name="_my_meta[course_5]" value="<?php if(!empty($meta['course_5'])) echo $meta['course_5']; ?>" placeholder="e.g. Research and Evaluation" size="40" /></p><?php
	
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

function box_meta_save($post_id)
{
     // verify if this is an auto save routine.
       // If it is our form has not been submitted, so we dont want to do anything
       if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

     // authentication checks
 
     // make sure data came from our meta box
     if (!wp_verify_nonce($_POST['my_meta_noncename'],__FILE__)) return $post_id;
 
     // check user permissions

       if ( array('job_posting','staff','tests') == $_POST['post_type'] )
       {
         if ( !current_user_can( 'edit_page', $post_id ) )
         return;
       }
       else
       {
         if ( !current_user_can( 'edit_post', $post_id ) )
             return;
       }
     // authentication passed, save data
 
     // var types
     // single: _my_meta[var]
     // array: _my_meta[var][]
     // grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]
 
     $current_data = get_post_meta($post_id, '_my_meta', TRUE);    
 
     $new_data = $_POST['_my_meta'];
 

 
     if ($current_data)
     {
          if (is_null($new_data)) delete_post_meta($post_id,'_my_meta');
          else update_post_meta($post_id,'_my_meta',$new_data);
     }
     elseif (!is_null($new_data))
     {
          add_post_meta($post_id,'_my_meta',$new_data,TRUE);
     }
 
     return $post_id;
}


function add_class_to_cpt_menu($classes)
{
	// your custom post type name
	if (get_post_type() == 'staff')
	{
		// we're viewing a custom post type, so remove the 'current_page_xxx and current-menu-item' from all menu items.
		$classes = array_filter($classes, "remove_parent");

		// add the current page class to a specific menu item.
		if (in_array('menu-item-xx', $classes)) $classes[] = 'current_page_parent';
	}

	return $classes;
}

add_filter('nav_menu_css_class', 'add_class_to_cpt_menu');
