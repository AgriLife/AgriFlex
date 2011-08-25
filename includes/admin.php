<?php
// Admin Menus
// -----------------------------------------------------------------------------
// make the options user-selectable

/* put stuff on pages and init-frontend */
if (!class_exists("AgrilifeCustomizer")) {
  
	class AgrilifeCustomizer {
		var $adminOptionsName = "AgrilifeOptions";
		
		function AgrilifeCustomizer() { //constructor
		
		} // End Constructor
		
		function init() {
			$this->getAdminOptions();
		}
		
		
		// Add scripts for admin image selector
		function my_admin_scripts() {
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_register_script('my-upload', get_bloginfo('template_directory').'/js/admin.js', array('jquery','media-upload','thickbox'));
			wp_enqueue_script('my-upload');
		}
		
		function my_admin_styles() {
			wp_enqueue_style('thickbox');
		}
		// END
		

		
		//Returns an array of admin options
		function getAdminOptions() {
			$agrilifeAdminOptions = array(
				'isResearch' => false,
				'isExtension' => false, 
				'isCollege' => false,
				'isTvmdl' => false,
				
				'extension_type' => 0,
				
				'header_type' => 0,
				'titleImg' => '',
				
				'hours' => '',
				
				'address-street1' => '',
				'address-street2' => '',
				'address-city' => '',
				'address-zip' => '',
				'map-link' => '',
				'map-img' => '',
				
				'address-mail-street1' => '600 John Kimbrough Boulevard',
				'address-mail-street2' => '',
				'address-mail-city' => 'College Station',
				'address-mail-zip' => '77843',
				
				'phone' => '',
				'fax' =>'',
				
				'feedBurner' => '',
				'googleAnalytics' => '');
			$AgrilifeOptions = get_option($this->adminOptionsName);
			if (!empty($AgrilifeOptions)) {
				foreach ($AgrilifeOptions as $key => $option)
					$agrilifeAdminOptions[$key] = $option;
			}				
			update_option($this->adminOptionsName, $agrilifeAdminOptions);
			return $agrilifeAdminOptions;
		}
		
		
		function set_defaults() {
		
			$options = get_option('AgrilifeOptions');
			
			// Set Header Tabs
			$options['isResearch'] = false;
			$options['isExtension'] = false;
			$options['isCollege'] = false;
			$options['isTvmdl'] = false;
			
			// Extension Sub-options
			$options['extension_type'] = 0;
			
			//Set Site Title Image
			$options['header_type'] = 0;
			$options['titleImg'] = '';
			
			//Set Footer HTML
			// Deprecated!
			$options['footerHtml'] = '';
			
			//hours
			$options['hours'] = '';
			
			//Address Defaults
			$options['address-street1'] = '600 John Kimbrough Boulevard';
			$options['address-street2'] = '';
			$options['address-city'] = 'College Station';
			$options['address-zip'] = '77843';
			$options['map-img'] = '';
			$options['map-link'] = '';
			
			$options['address-mail-street1'] = '';
			$options['address-mail-street2'] = '';
			$options['address-mail-city'] = '';
			$options['address-mail-zip'] = '';
			
			$options['phone'] = '';
			$options['fax'] = '';
			
			//Set Google Defaults
			$options['feedBurner'] = '';
			$options['googleAnalytics'] = '';
			
			
			update_option('AgrilifeOptions',$options);
		}
		
		//Prints out the admin page
		function printAdminPage() {
		  $agrilifeOptions = $this->getAdminOptions();
		 
		  	// On Submit
			if (isset($_POST['update_agrilifeSettings'])) {
				//Sanitize This Data
				
				
				if (isset($_POST['isCollege'])) {
				  $agrilifeOptions['isCollege'] = $_POST['isCollege'];
				}
				if (isset($_POST['isExtension'])) {
				  $agrilifeOptions['isExtension'] = $_POST['isExtension'];
				}	
				if (isset($_POST['isResearch'])) {
				  $agrilifeOptions['isResearch'] = $_POST['isResearch'];
				}	
				if (isset($_POST['isTvmdl'])) {
				  $agrilifeOptions['isTvmdl'] = $_POST['isTvmdl'];
				}	
				
				// Extension Sub-types
				if (isset($_POST['extension_type']) && ($_POST['isExtension']) ) {
				  $agrilifeOptions['extension_type'] = $_POST['extension_type'];
				} else {
				  $agrilifeOptions['extension_type'] = 0;
				}
			  
		
				
				
				// Header
				if (isset($_POST['header_type'])) 
				  $agrilifeOptions['header_type'] = apply_filters('content_save_pre', $_POST['header_type']);
				if (isset($_POST['titleImg'])) 
				  $agrilifeOptions['titleImg'] = stripslashes(apply_filters('content_save_pre', $_POST['titleImg']));
			  
			  	 // Footer (deprecated)
			  	 if (isset($_POST['footerHtml'])) 
				  $agrilifeOptions['footerHtml'] = stripslashes(apply_filters('content_save_pre', $_POST['footerHtml']));
				  
				 
				 // Hours
				 if (isset($_POST['hours'])) 
				  $agrilifeOptions['hours'] = stripslashes(apply_filters('content_save_pre', $_POST['hours']));
				  
		
				//Address Defaults
				if (isset($_POST['address-street1'])) 
				  $agrilifeOptions['address-street1'] = stripslashes(apply_filters('content_save_pre', $_POST['address-street1']));
		
				if (isset($_POST['address-street2'])) 
				  $agrilifeOptions['address-street2'] = stripslashes(apply_filters('content_save_pre', $_POST['address-street2']));
		
				if (isset($_POST['address-city'])) 
				  $agrilifeOptions['address-city'] = stripslashes(apply_filters('content_save_pre', $_POST['address-city']));
		
				if (isset($_POST['address-zip'])) 
				  $agrilifeOptions['address-zip'] = stripslashes(apply_filters('content_save_pre', $_POST['address-zip']));
				
				if (isset($_POST['map-img'])) 
				  $agrilifeOptions['map-img'] = stripslashes(apply_filters('content_save_pre', $_POST['map-img']));
				if (isset($_POST['map-link'])) 
				  $agrilifeOptions['map-link'] = stripslashes(apply_filters('content_save_pre', $_POST['map-link']));
				  
				  
		
				// Mailing Address
				if (isset($_POST['address-mail-street1'])) 
				  $agrilifeOptions['address-mail-street1'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-street1']));
		
				if (isset($_POST['address-mail-street2'])) 
				  $agrilifeOptions['address-mail-street2'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-street2']));
		
				if (isset($_POST['address-mail-city'])) 
				  $agrilifeOptions['address-mail-city'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-city']));
		
				if (isset($_POST['address-mail-zip'])) 
				  $agrilifeOptions['address-mail-zip'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-zip']));
				  
		
				if (isset($_POST['phone'])) 
				  $agrilifeOptions['phone'] = stripslashes(apply_filters('content_save_pre', $_POST['phone']));
		
				if (isset($_POST['fax'])) 
				  $agrilifeOptions['fax'] = stripslashes(apply_filters('content_save_pre', $_POST['fax']));
		
		
				if (isset($_POST['feedBurner'])) 
				  $agrilifeOptions['feedBurner'] = stripslashes(apply_filters('content_save_pre', $_POST['feedBurner'])); 
				if (isset($_POST['googleAnalytics'])) 
				  $agrilifeOptions['googleAnalytics'] = stripslashes(apply_filters('content_save_pre', $_POST['googleAnalytics'])); 
		
				update_option($this->adminOptionsName, $agrilifeOptions);
		
				?>
				<div class="updated"><p><strong><?php _e("Settings Updated.", "AgrilifeCustomizer");?></strong></p></div>
			<?php
			} //End On Submit Actions
		
		?>
		  
		  
		<div class="wrap">
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" name="agriform" id="agriform">
		<h2>AgriLife Site Configuration</h2>
		<table width="100%" border="0" cellspacing="0" cellpadding="8">
		<tr valign="top">
		<td>
		<h3>Research</h3>
		<p>Selecting "No" will disable the Research tab in the header.</p>
		<p><label for="isResearch_yes"><input type="radio" id="isResearch_yes" name="isResearch" value="1" <?php if ($agrilifeOptions['isResearch'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isResearch_no"><input type="radio" id="isResearch_no" name="isResearch" value="0" <?php if (!$agrilifeOptions['isResearch'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		</td>
		<td valign="top">
		<h3>Extension</h3>
		<p>Selecting "No" will disable the Extension tab in the header.</p>
		<p><label for="isExtension_yes"><input type="radio" id="isExtension_yes" name="isExtension" value="1" <?php if ($agrilifeOptions['isExtension'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isExtension_no"><input type="radio" id="isExtension_no" name="isExtension" value="0" <?php if (!$agrilifeOptions['isExtension'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		
			<div id="extension_type">
			<input type="radio" name="extension_type" value="0" <?php if($agrilifeOptions['extension_type']==0) echo 'checked="checked"';?> /> Typical<br />
			<input type="radio" name="extension_type" value="1" <?php if($agrilifeOptions['extension_type']==1) echo 'checked="checked"';?> /> 4-H<br />
			<input type="radio" name="extension_type" value="2" <?php if($agrilifeOptions['extension_type']==2) echo 'checked="checked"';?> /> County Office<br />
			<input type="radio" name="extension_type" value="3" <?php if($agrilifeOptions['extension_type']==3) echo 'checked="checked"';?> /> County TCE Office<br />
			<input type="radio" name="extension_type" value="4" <?php if($agrilifeOptions['extension_type']==4) echo 'checked="checked"';?> /> Master Gardener Chapter<br />
			<input type="radio" name="extension_type" value="5" <?php if($agrilifeOptions['extension_type']==5) echo 'checked="checked"';?> /> Master Naturalist Chapter<br />
			</div>
		</td>
		<td>
		<h3 valign="top">College</h3>
		<p>Selecting "No" will disable the College tab in the header.</p>
		<p><label for="isCollege_yes"><input type="radio" id="isCollege_yes" name="isCollege" value="1" <?php if ($agrilifeOptions['isCollege'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isCollege_no"><input type="radio" id="isCollege_no" name="isCollege" value="0" <?php if (!$agrilifeOptions['isCollege'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		</td>
		<td>
		<h3 valign="top">TVMDL</h3>
		<p>Selecting "No" will disable the TVMDL tab in the header.</p>
		<p><label for="isTvmdl_yes"><input type="radio" id="isTvmdl_yes" name="isTvmdl" value="1" <?php if ($agrilifeOptions['isTvmdl'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isTvmdl_no"><input type="radio" id="isTvmdl_no" name="isTvmdl" value="0" <?php if (!$agrilifeOptions['isTvmdl'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		</td>
		</tr>
		</table>
		
		
		
		<h3>Header</h3>
		
		
		<input type="radio" name="header_type" value="0" <?php if($agrilifeOptions['header_type']==0) echo 'checked="checked"';?> /> Site Title (text only)<br />
		<input type="radio" name="header_type" value="1" <?php if($agrilifeOptions['header_type']==1) echo 'checked="checked"';?> /> Site Title and Small Logo<br />
		
		 
		<p style="display: none;">A custom 900px by 60px image you have designed.  Make sure it's exported for Web at 72 dpi.</p>
				
<table class="form-table" id="image_upload">
<tr valign="top">
<th scope="row">Upload Image</th>
<td><label for="upload_image">
<input id="upload_image" type="text" size="100" name="titleImg" value="<?php _e($this->showHtml($agrilifeOptions['titleImg']), 'AgrilifeCustomizer') ?>" />
<input id="upload_image_button" type="button" value="Upload Image" />
<br />Enter an URL or upload an image for the banner.
</label></td>
</tr>
</table>

<input type="radio" name="header_type" value="2" disabled="disabled" <?php if($agrilifeOptions['header_type']==2) echo 'checked="checked"';?> /> Custom Image Header (coming soon)<br />


		
		
		<h3>Unit Information</h3>
		<table class="form-table">
		<tr valign="top"> 
		<th scope="row">Phone</th> 
		<td>
		    <input type="text" name="phone" id="phone" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['phone']; ?>" />
		    <br />
			<?php _e('Ex: 979-999-7777') ?>
		</td>
		</tr>
		<tr valign="top"> 
		<th scope="row">Fax</th> 
		<td>
		    <input type="text" name="fax" id="fax" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['fax']; ?>" />
		    <br />
			<?php _e('Ex: 979-999-7777') ?>
		</td>
		</tr>
		<tr valign="top"> 
		<th scope="row">Hours</th> 
		<td>
		    <input type="text" name="hours" id="hours" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['hours']; ?>" />
		    <br />
			<?php _e('Ex: Monday-Friday: 8:00am - 5:00pm') ?>
		</td>
		</tr>
		</table>
		
		
		<h3>Address</h3>
		<h4>Physical Address</h4>
		<h5>Not a PO Box.  This needs to be a 'Physical Address'.</h5>
		<table class="form-table">
		<tr valign="top"> 
		<th scope="row">Street 1</th> 
		<td>
		    <input type="text" name="address-street1" id="address-street1" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['address-street1']; ?>" />
		</td>
		</tr>
		<tr valign="top"> 
		<th scope="row">Street 2</th> 
		<td>
		    <input type="text" name="address-street2" id="address-street2" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['address-street2']; ?>" />
		</td>
		</tr>
		<tr valign="top"> 
		<th scope="row">City</th> 
		<td>
		    <input type="text" name="address-city" id="address-city" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['address-city']; ?>" />
		</td>
		</tr>
		<tr valign="top"> 
		<th scope="row">Zip</th> 
		<td>
		    <input type="text" name="address-zip" id="address-zip" class="regular-text" maxlength="10" value="<?php echo $agrilifeOptions['address-zip']; ?>" />
		</td>
		</tr>
		</table>
		
		<a href="javascript:void(0);" onclick="jQuery(this).next('div').toggle();">Map Not Working?</a>
		<div style="display:none; padding:10px 20px 20px; ">
		
			<table class="form-table">
			<tr valign="top"> 
			<th scope="row">Override Image Link</th> 
			<td>
			    <input type="text" name="map-img" id="map-img" class="regular-text" maxlength="300" value="<?php echo $agrilifeOptions['map-img']; ?>" /> <br />This is a link to a Google maps image.
			</td>
			</tr>
			<tr valign="top"> 
			<th scope="row">Override Map Link</th> 
			<td>
			    <input type="text" name="map-link" id="map-link" class="regular-text" maxlength="300" value="<?php echo $agrilifeOptions['map-link']; ?>" /><br />This is a permalink to a Google maps address.
			</td>
			</tr>
			</table>
		    
		</div>

		
		<h4>Mailing Address (optional)</h4>
		<table class="form-table">
		<tr valign="top"> 
		<th scope="row">Street 1</th> 
		<td>
		    <input type="text" name="address-mail-street1" id="address-mail-street1" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['address-mail-street1']; ?>" />
		</td>
		</tr>
		<tr valign="top"> 
		<th scope="row">Street 2</th> 
		<td>
		    <input type="text" name="address-mail-street2" id="address-mail-street2" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['address-mail-street2']; ?>" />
		</td>
		</tr>
		<tr valign="top"> 
		<th scope="row">City</th> 
		<td>
		    <input type="text" name="address-mail-city" id="address-mail-city" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['address-mail-city']; ?>" />
		</td>
		</tr>
		<tr valign="top"> 
		<th scope="row">Zip</th> 
		<td>
		    <input type="text" name="address-mail-zip" id="address-mail-zip" class="regular-text" maxlength="10" value="<?php echo $agrilifeOptions['address-mail-zip']; ?>" />
		</td>
		</tr>
		</table>
		
		<h3 style="padding-top: 20px;"><?php _e('Google Analytics Settings') ?></h3> 
		<table class="form-table">
		<tr valign="top"> 
		<th scope="row"><?php _e('Tracking Code') ?></th> 
		<td>
		    <input type="text" name="googleAnalytics" id="googleAnalytics" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['googleAnalytics']; ?>" />
			<br />
			<?php _e('Ex: UA-XXXXX-2') ?>
		</td>
		</tr>
		</table>
		
		
		<a href="javascript:void(0);" onclick="jQuery(this).next('div').toggle();"><?php _e("What's Google Analytics? How do I set this up?") ?></a> 
		<div style="display:none; padding:10px 20px 20px; border:1px solid #CCC; "> 
		<p><?php _e("<a href=\"https://www.google.com/analytics/\">Google Analytics</a> is the free stats tracking system supplied by Google and produces very attractive (and comprehensive) stats.") ?></p>
		<p><?php _e("To get going, just <a href=\"http://www.google.com/analytics/sign_up.html\">sign up for Analytics</a>, set up a new account and copy the tracking code you receive (it'll start with 'UA-') into the box above and press 'Save' - it can take several hours before you see any stats, but once it is you've got access to one heck of a lot of data!") ?></p>
		<p><?php _e("For more information on finding the tracking code, please visit <a href=\"http://www.google.com/support/analytics/bin/answer.py?hl=en&amp;answer=55603\">this Google help site</a>.") ?></p>
		</div>
		
		<h3><?php _e('Feedburner Settings') ?></h3> 
		<table class="form-table">
		<tr valign="top"> 
		<th scope="row"><?php _e('FeedBurner Feed Address') ?></th> 
		<td>
		    <input type="text" name="feedBurner" id="feedBurner" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['feedBurner']; ?>" />
			<br />
			<?php _e('Ex: http://feeds.feedburner.com/AgriLife') ?>
		</td>
		</tr>
		</table>
		
		
		<div class="submit">
		<input type="submit" name="update_agrilifeSettings" value="<?php _e('Update Settings', 'AgrilifeCustomizer') ?>" /></div>
		</form>
		</div>
		
		  <?php
		}//End function printAdminPage()
		
		function showHtml($html) {
			//return htmlspecialchars(stripslashes($html));
			return $html;
		}
	
	
	} //End Class AgrilifeCustomizer
} // End If



if (class_exists("AgrilifeCustomizer")) {
  $agrilife_customizer = new AgrilifeCustomizer();
  $options	= get_option('AgrilifeOptions');

  //if db not already populated, the add defaults
  if (!is_array($options))
	  $agrilife_customizer->set_defaults();

}

//Initialize the admin panel
if (!function_exists("AgrilifeCustomize_ap")) {
	function AgrilifeCustomize_ap() {
		global $agrilife_customizer;
		if (!isset($agrilife_customizer)) {
			return;
		}
		if (function_exists('add_options_page')) {
			add_options_page('AgriLife Site Configuration', 'AgriLife Options', 9, 'agrilife-config-admin', array(&$agrilife_customizer, 'printAdminPage'));
		}
		// Add Image Thickbox To Config Screen
		if (isset($_GET['page']) && $_GET['page'] == 'agrilife-config-admin') {
			add_action('admin_print_scripts', array(&$agrilife_customizer,'my_admin_scripts'));
			add_action('admin_print_styles', array(&$agrilife_customizer,'my_admin_styles'));
		}
		
	}	
}

if (isset($agrilife_customizer)) {
	// put agrilife options in admin menu
	add_action('admin_menu', 'AgrilifeCustomize_ap');
	
}



