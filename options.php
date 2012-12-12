<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

  // Site title selections
  $site_title_array = array(
    0 => 'Site Title (text only)',
    1 => 'Site Title and Small Logo',
    2 => 'Custom Image Header'
  );

  $agency_array = array(
    'research' => 'Research',
    'extension' => 'Extension',
    'college'   => 'College',
    'tvmdl'     => 'TVMDL'
  );

  $ext_array = array(
    'typical' => 'Typical',
    '4h'      => '4-H',
    'county'  => 'County Office',
    'tce'     => 'County TCE Office',
    'mg'      => 'Master Gardener Chapter',
    'mn'      => 'Master Naturalist Chapter',
    'sg'      => 'Sea Grant'
  );

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __( 'Appearance', 'options_framework_theme' ),
    'type' => 'heading'
  );

	$options[] = array(
		'name' => __('Site Title Style', 'options_framework_theme'),
		'desc' => __('Select your site title style', 'options_framework_theme'),
		'id' => 'site-title',
		'std' => 0,
		'type' => 'radio',
		'options' => $site_title_array);

  $options[] = array(
    'name' => __( 'Custom Site Logo', 'options_framework_theme' ),
    'desc' => __( 'Upload your custom logo', 'options_framework_theme' ),
    'id'   => 'custom-site-logo',
    'type' => 'upload',
  );

  $options[] = array(
    'name' => __( 'Minimal Header', 'options_framework_theme' ),
    'desc' => __( 'Removes agency logos', 'options_framework_theme' ),
    'id'   => 'minimal-header',
    'std'  => 0,
    'type' => 'checkbox',
  );

  $options[] = array(
    'name' => __( 'Minimal Footer', 'options_framework_theme' ),
    'desc' => __( 'Shows only the required links', 'options_framework_theme' ),
    'id'   => 'minimal-footer',
    'std'  => 0,
    'type' => 'checkbox',
  );

  // Contact Information Tab
	$options[] = array(
		'name' => __( 'Contact Information', 'options_framework_theme' ),
    'type' => 'heading'
  );

  $options[] = array(
    'name' => __( 'Phone Number', 'options_framework_theme' ),
    'desc' => __( 'Ex. 979-999-7777', 'options_framework_theme' ),
    'id'   => 'phone',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Fax Number', 'options_framework_theme' ),
    'desc' => __( 'Ex. 979-999-7777', 'options_framework_theme' ),
    'id'   => 'fax',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Email Address (public)', 'options_framework_theme' ),
    'desc' => __( 'Ex. example@tamu.edu', 'options_framework_theme' ),
    'id'   => 'email',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Hours of Operation', 'options_framework_theme' ),
    'desc' => __( 'Ex. Mon-Fri 8:00am-5:00pm', 'options_framework_theme' ),
    'id'   => 'hours',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Physical Address', 'options_framework_theme' ),
    'desc' => __( 'Not a P.O. Box', 'options_framework_theme' ),
    'id'   => 'phys-addr',
    'type' => 'info'
  );

  $options[] = array(
    'name' => __( 'Street 1', 'options_framework_theme' ),
    'id'   => 'p-street-1',
    'std'  => '600 John Kimbrough Blvd.',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Street 2', 'options_framework_theme' ),
    'id'   => 'p-street-2',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'City', 'options_framework_theme' ),
    'id'   => 'p-city',
    'std'  => 'College Station',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Zip', 'options_framework_theme' ),
    'id'   => 'p-zip',
    'std'  => '77843',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Mailing Address', 'options_framework_theme' ),
    'id'   => 'mail-addr',
    'type' => 'info'
  );

  $options[] = array(
    'name' => __( 'Street 1', 'options_framework_theme' ),
    'id'   => 'm-street-1',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Street 2', 'options_framework_theme' ),
    'id'   => 'm-street-2',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'City', 'options_framework_theme' ),
    'id'   => 'm-city',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Zip', 'options_framework_theme' ),
    'id'   => 'm-zip',
    'std'  => '',
    'type' => 'text'
  );

  // Social/Web Services Tab
  $options[] = array(
    'name' => __( 'Social/Web Services', 'options_framework_theme' ),
    'type' => 'heading'
  );

  $options[] = array(
    'name' => __( 'Google Analytics', 'options_framework_theme' ),
    'desc' => __( 'Ex. UA-XXXXX-2', 'options_framework_theme' ),
    'id'   => 'g-analytics',
    'std'  => '',
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'FeedBurner Feed Address', 'options_framework_theme' ),
    'desc' => __( 'Ex. http://feeds.feedburner.com/AgriLife', 'options_framework_theme' ),
    'id'   => 'feedburner',
    'std'  => '',
    'type' => 'text'
  );

  // Agency Affilliation Tab
  $options[] = array(
    'name' => __('Agency Affiliation', 'options_framework_theme' ),
    'type' => 'heading'
  );

  $options[] = array(
    'name' => __( 'Agency Selection', 'options_framework_theme' ),
    'desc' => __( 'Select all that apply', 'options_framework_theme' ),
    'id'   => 'agency-top',
    'type' => 'multicheck',
    'options' => $agency_array
  );

  $options[] = array(
    'name' => __( 'Extension Type', 'options_framework_theme' ),
    'id'   => 'ext-type',
    'std'  => 'typical',
    'type' => 'radio',
    'options' => $ext_array
  );

  $options[] = array(
    'name' => __( 'Additional Agency Logos', 'options_framework_theme' ),
    'desc' => __( 'Upload your custom logo. Must be 45px in height.', 'options_framework_theme' ),
    'id'   => 'custom-agency-logo',
    'type' => 'upload',
  );

	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}
