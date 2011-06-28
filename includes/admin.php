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
		//Returns an array of admin options
		function getAdminOptions() {
			$agrilifeAdminOptions = array(
				'isResearch' => false,
				'isExtension' => false, 
				'isCollege' => false,
				'isTvmdl' => false,
				'titleImg' => '',
				
				'address-street1' => '',
				'address-street2' => '',
				'address-city' => '',
				'address-zip' => '',
				
				'address-mail-street1' => '',
				'address-mail-street2' => '',
				'address-mail-city' => '',
				'address-mail-zip' => '',
				
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
			
			//Set Site Title Image
			$options['titleImg'] = '';
			
			//Set Footer HTML
			// Deprecated!
			$options['footerHtml'] = '';
			
			//Address Defaults
			$options['address-street1'] = '600 John Kimbrough Boulevard';
			$options['address-street2'] = '';
			$options['address-city'] = 'College Station';
			$options['address-zip'] = '77843';
			
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
			  
		
				
				
				// Header Image (optional)
				if (isset($_POST['titleImg'])) 
				  $agrilifeOptions['titleImg'] = stripslashes(apply_filters('content_save_pre', $_POST['titleImg']));
			  
			  	 // Footer (deprecated)
			  	 if (isset($_POST['footerHtml'])) 
				  $agrilifeOptions['footerHtml'] = stripslashes(apply_filters('content_save_pre', $_POST['footerHtml']));
		
				
		
				//Address Defaults
				if (isset($_POST['address-street1'])) 
				  $agrilifeOptions['address-street1'] = stripslashes(apply_filters('content_save_pre', $_POST['address-street1']));
		
				if (isset($_POST['address-street2'])) 
				  $agrilifeOptions['address-street2'] = stripslashes(apply_filters('content_save_pre', $_POST['address-street2']));
		
				if (isset($_POST['address-city'])) 
				  $agrilifeOptions['address-city'] = stripslashes(apply_filters('content_save_pre', $_POST['address-city']));
		
				if (isset($_POST['address-zip'])) 
				  $agrilifeOptions['address-zip'] = stripslashes(apply_filters('content_save_pre', $_POST['address-zip']));
		
				/* Mailing Address
				if (isset($_POST['address-mail-street1'])) 
				  $agrilifeOptions['address-mail-street1'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-street1']));
		
				if (isset($_POST['address-mail-street2'])) 
				  $agrilifeOptions['address-mail-street2'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-street2']));
		
				if (isset($_POST['address-mail-city'])) 
				  $agrilifeOptions['address-mail-city'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-city']));
		
				if (isset($_POST['address-mail-zip'])) 
				  $agrilifeOptions['address-mail-zip'] = stripslashes(apply_filters('content_save_pre', $_POST['address-mail-zip']));
				*/
				// END - Mailing Address
		
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
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		<h2>AgriLife Site Configuration</h2>
		<table width="100%" border="0" cellspacing="0" cellpadding="8">
		<tr>
		<td>
		<h3>Research?</h3>
		<p>Selecting "No" will disable the Research tab in the header.</p>
		<p><label for="isResearch_yes"><input type="radio" id="isResearch_yes" name="isResearch" value="1" <?php if ($agrilifeOptions['isResearch'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isResearch_no"><input type="radio" id="isResearch_no" name="isResearch" value="0" <?php if (!$agrilifeOptions['isResearch'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		</td>
		<td>
		<h3>Extension?</h3>
		<p>Selecting "No" will disable the Extension tab in the header.</p>
		<p><label for="isExtension_yes"><input type="radio" id="isExtension_yes" name="isExtension" value="1" <?php if ($agrilifeOptions['isExtension'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isExtension_no"><input type="radio" id="isExtension_no" name="isExtension" value="0" <?php if (!$agrilifeOptions['isExtension'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		</td>
		<td>
		<h3>College?</h3>
		<p>Selecting "No" will disable the College tab in the header.</p>
		<p><label for="isCollege_yes"><input type="radio" id="isCollege_yes" name="isCollege" value="1" <?php if ($agrilifeOptions['isCollege'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isCollege_no"><input type="radio" id="isCollege_no" name="isCollege" value="0" <?php if (!$agrilifeOptions['isCollege'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		</td>
		<td>
		<h3>TVMDL?</h3>
		<p>Selecting "No" will disable the TVMDL tab in the header.</p>
		<p><label for="isTvmdl_yes"><input type="radio" id="isTvmdl_yes" name="isTvmdl" value="1" <?php if ($agrilifeOptions['isTvmdl'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isTvmdl_no"><input type="radio" id="isTvmdl_no" name="isTvmdl" value="0" <?php if (!$agrilifeOptions['isTvmdl'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		</td>
		</tr>
		</table>
		
		<h3>Header Image</h3>
		<p>A custom 900px by 60px image you have designed.  Make sure it's exported for Web at 72 dpi.  You will need to add the image to the Media Library and then paste the path to the image below. The Media Library can be found under the 'Media' link in the left column.</p>
		<p>The link you paste in should look something like: <em><?php bloginfo('url'); ?>/wp-content/uploads/2009/11/borlaug_title.gif</em></p>
		<textarea name="titleImg" style="width:575px" rows="3"><?php _e($this->showHtml($agrilifeOptions['titleImg']), 'AgrilifeCustomizer') ?></textarea>
		
		
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
		</table>
		
		
		<h3>Address</h3>
		<h4>Physical Address</h4>
		<h5>Not a PO Box.  This needs to be a 'Physical Adress'.</h5>
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
		<?php 
		/* May have to add this later 
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
		*/ ?>
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
	}	
}

if (isset($agrilife_customizer)) {
	// put agrilife options in admin menu
	add_action('admin_menu', 'AgrilifeCustomize_ap');
	
}



