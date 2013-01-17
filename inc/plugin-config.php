<?php
/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Yoast Breadcrumb Defaults
- Gravity Form Defaults
- Tiny MCE

-----------------------------------------------------------------------------------*/

/* BEGIN Config Yoast Breadcrumb Defaults */
$yoast_bc_opt = array();
$yoast_bc_opt['home'] 				    = "Home";
$yoast_bc_opt['blog'] 				    = "Blog";
$yoast_bc_opt['sep'] 				      = " &gt; ";
$yoast_bc_opt['prefix']				    = "";
$yoast_bc_opt['boldlast'] 			  = false;
$yoast_bc_opt['nofollowhome'] 		= false;
$yoast_bc_opt['singleparent']     = 0;
$yoast_bc_opt['singlecatprefix']  = true;
$yoast_bc_opt['archiveprefix'] 		= "Archives for";
$yoast_bc_opt['searchprefix'] 		= "Search for";
add_option("yoast_breadcrumbs",$yoast_bc_opt);
/* END Config Yoast Breadcrumb Defaults */

// Remove The Gravity Form Stylesheet
add_action('wp_print_styles', 'remove_gravityforms_style');
function remove_gravityforms_style() {
	wp_dequeue_style('gforms_css');
}
/* END Set Gravity Form Defaults */

/* BEGIN Tiny MCE */
/* Allow iframe content to 'stick' when toggling visual editor */
add_filter('tiny_mce_before_init', create_function( '$a',
'$a["extended_valid_elements"] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]"; return $a;') );
/* END Tiny MCE */
