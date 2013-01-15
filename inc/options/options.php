<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */
include('migrate.php');

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

  // Get the migration going
  $migrate = new AgriFlex_Migrate();

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
    'tvmdl'     => 'TVMDL',
    'fazd'       => 'FAZD'
  );

  $agency_default = array(
    'research'  => $migrate->get_default( 'research' ),
    'extension' => $migrate->get_default( 'extension' ),
    'college'   => $migrate->get_default( 'college' ),
    'tvmdl'     => $migrate->get_default( 'tvmdl' ),
    'fazd'       => $migrate->get_default( 'fazd' ),
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

  $county_array = agriflex_county_listing(); 

	$options = array();

	$options[] = array(
		'name' => __( 'Appearance', 'options_framework_theme' ),
    'type' => 'heading'
  );

	$options[] = array(
		'name' => __('Site Title Style', 'options_framework_theme'),
		'desc' => __('Select your site title style', 'options_framework_theme'),
		'id' => 'site-title',
		'std' => $migrate->get_default( 'site-title' ),
		'type' => 'radio',
    'options' => $site_title_array
  );

  $options[] = array(
    'name' => __( 'Custom Site Logo', 'options_framework_theme' ),
    'desc' => __( 'Upload your custom logo', 'options_framework_theme' ),
    'id'   => 'custom-site-logo',
    'std'  => $migrate->get_default( 'custom-site-logo' ),
    'type' => 'upload',
  );

  $options[] = array(
    'name' => __( 'Minimal Header', 'options_framework_theme' ),
    'desc' => __( 'Removes agency logos', 'options_framework_theme' ),
    'id'   => 'minimal-header',
    'std'  => $migrate->get_default( 'minimal-header' ),
    'type' => 'checkbox',
  );

  $options[] = array(
    'name' => __( 'Minimal Header Text', 'options_framework_theme' ),
    'desc' => __( 'Header text. Keep it short.', 'options_framework_theme' ),
    'id'   => 'minimal-header-text',
    'std'  => $migrate->get_default( 'minimal-header-text' ),
    'type' => 'text',
  );

  $options[] = array(
    'name' => __( 'Minimal Footer', 'options_framework_theme' ),
    'desc' => __( 'Shows only the required links', 'options_framework_theme' ),
    'id'   => 'minimal-footer',
    'std'  => $migrate->get_default( 'minimal-footer' ),
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
    'std'  => $migrate->get_default( 'phone' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Fax Number', 'options_framework_theme' ),
    'desc' => __( 'Ex. 979-999-7777', 'options_framework_theme' ),
    'id'   => 'fax',
    'std'  => $migrate->get_default( 'fax' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Email Address (public)', 'options_framework_theme' ),
    'desc' => __( 'Ex. example@tamu.edu', 'options_framework_theme' ),
    'id'   => 'email',
    'std'  => $migrate->get_default( 'email' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Hours of Operation', 'options_framework_theme' ),
    'desc' => __( 'Ex. Mon-Fri 8:00am-5:00pm', 'options_framework_theme' ),
    'id'   => 'hours',
    'std'  => $migrate->get_default( 'hours' ),
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
    'std'  => $migrate->get_default( 'p-street-1' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Street 2', 'options_framework_theme' ),
    'id'   => 'p-street-2',
    'std'  => $migrate->get_default( 'p-street-2' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'City', 'options_framework_theme' ),
    'id'   => 'p-city',
    'std'  => $migrate->get_default( 'p-city' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Zip', 'options_framework_theme' ),
    'id'   => 'p-zip',
    'std'  => $migrate->get_default( 'p-zip' ),
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
    'std'  => $migrate->get_default( 'm-street-1' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Street 2', 'options_framework_theme' ),
    'id'   => 'm-street-2',
    'std'  => $migrate->get_default( 'm-street-2' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'City', 'options_framework_theme' ),
    'id'   => 'm-city',
    'std'  => $migrate->get_default( 'm-city' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'Zip', 'options_framework_theme' ),
    'id'   => 'm-zip',
    'std'  => $migrate->get_default( 'm-zip' ),
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
    'std'  => $migrate->get_default( 'g-analytics' ),
    'type' => 'text'
  );

  $options[] = array(
    'name' => __( 'FeedBurner Feed Address', 'options_framework_theme' ),
    'desc' => __( 'Ex. http://feeds.feedburner.com/AgriLife', 'options_framework_theme' ),
    'id'   => 'feedburner',
    'std'  => $migrate->get_default( 'feedburner' ),
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
    'std'  => $agency_default,
    'type' => 'multicheck',
    'options' => $agency_array
  );

  $options[] = array(
    'name' => __( 'Extension Type', 'options_framework_theme' ),
    'id'   => 'ext-type',
    'std'  => $migrate->get_default( 'ext-type' ),
    'type' => 'radio',
    'options' => $ext_array
  );

  $options[] = array(
    'name' => __( 'County Name', 'options_framework_theme' ),
    'id'   => 'county-name',
    'std'  => $migrate->get_default( 'county-name' ),
    'type' => 'select',
    'options' => $county_array,
  );

  $options[] = array(
    'name' => __( 'County Name Human', 'options_framework_theme' ),
    'id'   => 'county-name-human',
    'std'  => $migrate->get_default( 'county-name-human' ),
    'type' => 'text',
    'class' => 'hidden'
  );

  $options[] = array(
    'name' => __( 'Additional Agency Logos', 'options_framework_theme' ),
    'desc' => __( 'Upload your custom logo. Must be 45px in height.', 'options_framework_theme' ),
    'id'   => 'custom-agency-logo',
    'std'  => $migrate->get_default( 'custom-agency-logo' ),
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

  // Changes the human-readable name based on the county selection
	$('select#county-name').change(function() {
    $('input#county-name-human').val($(this).children(':selected').text());
	});

  // Removes ext-type when agency selection changes. It's a failsafe.
  $('#section-agency-top input').change(function() {
    $('#section-ext-type input').removeAttr('checked');
  });

  // Hides the custom site logo field if option 0 is checked on load
  if( $('#agriflex-site-title-0').is(':checked') ) {
    $('#section-custom-site-logo').hide();
  }

  // Shows the custom site logo field if options 1 or 2 are checked
  $('#section-site-title').change( function() {
    if ( $('#agriflex-site-title-1').attr('checked') || $('#agriflex-site-title-2').attr('checked') ) {
      $('#section-custom-site-logo').show('fast');
    } else {
      $('#section-custom-site-logo').hide('fast');
    }
  });

  if ( $('#section-minimal-header input').is(':checked') ) {
      $('#section-minimal-header-text').show();
    } else {
      $('#section-minimal-header-text').hide();
    }

  $('#section-minimal-header input').change( function() {
    if ( $('#minimal-header' ).is(':checked') ) {
      $('#section-minimal-header-text').show();
    } else {
      $('#section-minimal-header-text').hide();
      $('#minimal-header-text').val('');
    }
  });

  // Hides ext-type if multiple agencies are checked
  others = $('#section-agency-top input').not('#agriflex-agency-top-extension');
  if( others.is(':checked')) {
    $('#section-ext-type').hide();
  }

  $('#section-agency-top input').change(function() {
    console.log(others.filter(':not(:checked)').length);
    if( $('#agriflex-agency-top-extension').is(':checked') && others.filter(':not(:checked)').length == 4) {
      $('#section-ext-type').show();
    } else {
      $('#section-ext-type').hide();
      $('#section-county-name').hide();
    }
  });

    if($('#agriflex-ext-type-county').is(':checked') || $('#agriflex-ext-type-tce').is(':checked')) {
      $('#section-county-name').show();
    } else {
      $('#section-county-name').hide();
    }

  $('#section-ext-type').change(function() {
    if($('#agriflex-ext-type-county').is(':checked') || $('#agriflex-ext-type-tce').is(':checked')) {
      $('#section-county-name').show();
    } else {
      $('#section-county-name').hide();
    }
});

});
</script>

<?php
}
