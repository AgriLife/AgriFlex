<?php
/* Job Posting Custom Post Type */

function job_posting_search($job_type_selected='',$term='') {
    do_action('job_posting_search',$job_type_selected,$term);
}

add_action('job_posting_search','job_posting_search_form',5,3);

function job_posting_search_form($job_type_selected='',$term='Wildlife Biologist') { ?>
	<div class="job_posting-search-form">
	<label>
	<h4>Search Job Postings</h4>
	</label>
	<form role="search" class="searchform" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<?php
	/*echo '<div class="tax-options">';
	$args = array('order'=>'ASC','hide_empty'=>true);
	echo get_terms_dropdown($job_type_selected, $args);
	echo '</div>';
	*/
	?>
	  <input type="text" class="s" name="searchjobpostings" id="s" placeholder="<?php echo $term; ?>" onfocus="if(this.value==this.defaultValue)this.value='<?php echo $term; ?>';" onblur="if(this.value=='<?php echo $term; ?>')this.value=this.defaultValue;"/>
	  <input class="job_posting-submit" type="submit" name="submit" value="Search" />	
	  <input type="hidden" name="post_type" value="job_posting" />
	</form>
	</div>
<?php 
}



add_action( 'init', 'create_job_posting_post_type' );
function create_job_posting_post_type() {
     register_post_type( 'job_posting',
          array(
               'labels' => array(
                    'name' => __( 'Job Posting' ),
                    'singular_name' => __( 'Job' ),
                    'add_new_item' => __( 'Add New Job Posting' ),
                    'add_new' => __( 'Add New' ),
                    'edit' => __( 'Edit' ),
                    'edit_item' => __( 'Edit Job Posting' ),
                    'new_item' => __( 'New Job Posting' ),
                    'view' => __( 'View Job Posting' ),
                    'view_item' => __( 'View Job Posting' ),
                    'search_items' => __( 'Search Job Postings' ),
                    'not_found' => __( 'No Job Posting found' ),
                    'not_found_in_trash' => __( 'No Job Postings found in Trash' ),

               ),
          '_builtin' => false, // It's a custom post type, not built in!
          '_edit_link' => 'post.php?post=%d',
          'capability_type' => 'post',
          'hierarchical' => false,
          'public' => true,
          'rewrite' => array('slug' => 'jobs'),
          'supports' => array( 'title', 'editor' ),
          )
     );
}

// hook into the init action and call create_job_taxonomies() when it fires
add_action( 'init', 'create_job_taxonomies', 0 );

// create three taxonomies, species and lab sections for the post type "job_posting"
function create_job_taxonomies() {

     // Add new taxonomy, make it hierarchical (like categories)
     $labels = array(
          'name' => _x( 'Job Category', 'taxonomy general name' ),
          'singular_name' => _x( 'Job Category', 'taxonomy singular name' ),
          'search_items' =>  __( 'Search Job Categories' ),
          'all_items' => __( 'All Job Categories' ),
          'parent_item' => __( 'Parent Job Category' ),
          'parent_item_colon' => __( 'Parent Job Category:' ),
          'edit_item' => __( 'Edit Job Category' ),
          'update_item' => __( 'Update Job Category' ),
          'add_new_item' => __( 'Add New Job Category' ),
          'new_item_name' => __( 'New Job Category Name' ),
     );     

     register_taxonomy( 'job_category', array( 'job_posting' ), array(
          'hierarchical' => true,
          'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
          'show_ui' => true,
          'query_var' => true,
          'rewrite' => false,
     ));

}

/* Define the custom box for job posting custom post type */
//add_action('admin_init','job_posting_meta_init'); 
add_action('admin_init','job_posting_meta_init'); 

function job_posting_meta_init() {
	add_meta_box('job_posting_details_meta', 'Enter Job Details', 'job_posting_details_meta', 'job_posting', 'normal', 'high');
}

function job_posting_details_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	
	// Still Support the legacy _my_meta fields
	$my_meta = get_post_meta($post->ID,'_my_meta',TRUE);
	
	$job_number 	= ($my_meta['job_number']<>''? $my_meta['job_number'] : $custom["job_number"][0]);
	$agency 		= ($my_meta['agency']<>'' ? $my_meta['agency'] 		: $custom["agency"][0]);
	$location		= ($my_meta['location']<>'' ? $my_meta['location'] 	: $custom["location"][0]);
	$type			= ($my_meta['type'] <>'' ? $my_meta['type']			: $custom["classification"][0]);
	$salary			= ($my_meta['salary']<>'' ? $my_meta['salary']		: $custom["salary"][0]);
	$apply_date		= ($my_meta['apply-date'] <> '' ? $my_meta['apply-date'] : $custom["apply_date"][0]);
	$start_date		= ($my_meta['start-date'] <> '' ? $my_meta['start-date'] : $custom["start_date"][0]);
	$description  	= ($my_meta['description'] <> '' ? $my_meta['description'] : $custom["description"][0]);
	$qualifications	= ($my_meta['qualifications'] <> '' ? $my_meta['qualifications'] : $custom["qualifications"][0]);
	$contact_name 	= ($my_meta['contact-name'] <> '' ? $my_meta['contact-name'] : $custom["contact_name"][0]);
	$contact_phone	= ($my_meta['contact-phone'] <> '' ? $my_meta['contact-phone'] : $custom["contact_phone"][0]);
	$contact_email	= ($my_meta['contact-email'] <> '' ? $my_meta['contact-email'] : $custom["contact_email"][0]);
	
	include(MY_THEME_FOLDER . '/includes/meta_boxes/jobs_meta_html.php');
}



/* Save The Post Meta */
add_action('save_post', 'save_job_meta');

function save_job_meta(){
  global $post;
 
  update_post_meta($post->ID, "job_number", $_POST["job_number"]);
  update_post_meta($post->ID, "agency", $_POST["agency"]);
  update_post_meta($post->ID, "location", $_POST["location"]);
  update_post_meta($post->ID, "salary", $_POST["salary"]);
  update_post_meta($post->ID, "apply_date", $_POST["apply_date"]);
  update_post_meta($post->ID, "description", $_POST["description"]);
  update_post_meta($post->ID, "qualifications", $_POST["qualifications"]);
  update_post_meta($post->ID, "contact_name", $_POST["contact_name"]);
  update_post_meta($post->ID, "contact_email", $_POST["contact_email"]);
  update_post_meta($post->ID, "contact_phone", $_POST["contact_phone"]);
  
}

?>