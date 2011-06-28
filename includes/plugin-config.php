<?php
/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- CDN Domain Variable
- Thumbnail Support
- Menu Navigation Variables
- Widget Areas
- Set Plugin Defaults
	- $content_width
	- Yoast Breadcrumb Defaults
	- Gravity Form Defaults
	- Vipers Video Tags Defaults [not working]
	- Tiny MCE

-----------------------------------------------------------------------------------*/

/* BEGIN Config Yoast Breadcrumb Defaults */
$yoast_bc_opt 						= array();
$yoast_bc_opt['home'] 				= "Home";
$yoast_bc_opt['blog'] 				= "Blog";
$yoast_bc_opt['sep'] 				= " &gt; ";
$yoast_bc_opt['prefix']				= "";
$yoast_bc_opt['boldlast'] 			= false;
$yoast_bc_opt['nofollowhome'] 		= false;
$yoast_bc_opt['singleparent'] 		= 0;
$yoast_bc_opt['singlecatprefix']		= true;
$yoast_bc_opt['archiveprefix'] 		= "Archives for";
$yoast_bc_opt['searchprefix'] 		= "Search for";
add_option("yoast_breadcrumbs",$yoast_bc_opt);
/* END Config Yoast Breadcrumb Defaults */

/* BEGIN Set Gravity Form Defaults */
// This will be added in WordPress 3.1
if(!function_exists('wp_dequeue_style')) {
	function wp_dequeue_style( $handle ) {
	    global $wp_styles;
	    if ( !is_a($wp_styles, 'WP_Styles') )
	        $wp_styles = new WP_Styles(); 

	    $wp_styles->dequeue( $handle );
	}
}

// Remove The Gravity Form Stylesheet
function remove_gravityforms_style() {
	wp_dequeue_style('gforms_css');
}
add_action('wp_print_styles', 'remove_gravityforms_style');
/* END Set Gravity Form Defaults */

/* BEGIN Config Vipers Video Tags Defaults */
/* This does not work. Want to turn off all options except YouTube by default.  */
/* Setting it in PU works, but PU upgrades break it. */
/*
$vvq_defaultsettings							= array();
$vvq_defaultsettings['vimeo']['button'] 		= 0;
$vvq_defaultsettings['veoh']['button'] 			= 0;
$vvq_defaultsettings['dailymotion']['button'] 	= 0;
$vvq_defaultsettings['bliptv']['button']		= 0;
update_option("vvq_options",$vvq_defaultsettings);
*/
/* END Config Vipers Video Tags Defaults */

/* BEGIN Tiny MCE */
/* Allow iframe content to 'stick' when toggling visual editor */
add_filter('tiny_mce_before_init', create_function( '$a',
'$a["extended_valid_elements"] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]"; return $a;') );
/* END Tiny MCE */

?>