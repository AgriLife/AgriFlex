<?php
// Admin Menus
// -----------------------------------------------------------------------------
// make the options user-selectable

/* put stuff on pages and init-frontend */
if (!class_exists("AgrilifeCustomizer")) {
  
	class AgrilifeCustomizer {
		var $adminOptionsName = "AgrilifeOptions";
		public $countyArray = array(
		0 => '',
		1 => 'Anderson',
		3 => 'Andrews',
		5 => 'Angelina',
		7 => 'Aransas',
		9 => 'Archer',
		11 => 'Armstrong',
		13 => 'Atascosa',
		15 => 'Austin',
		17 => 'Bailey',
		19 => 'Bandera',
		21 => 'Bastrop',
		23 => 'Baylor',
		25 => 'Bee',
		27 => 'Bell',
		29 => 'Bexar',
		31 => 'Blanco',
		33 => 'Borden',
		35 => 'Bosque',
		37 => 'Bowie',
		39 => 'Brazoria',
		41 => 'Brazos',
		43 => 'Brewster',
		45 => 'Briscoe',
		47 => 'Brooks',
		49 => 'Brown',
		51 => 'Burleson',
		53 => 'Burnet',
		55 => 'Caldwell',
		57 => 'Calhoun',
		59 => 'Callahan',
		61 => 'Cameron',
		63 => 'Camp',
		65 => 'Carson',
		67 => 'Cass',
		69 => 'Castro',
		71 => 'Chambers',
		73 => 'Cherokee',
		75 => 'Childress',
		77 => 'Clay',
		79 => 'Cochran',
		81 => 'Coke',
		83 => 'Coleman',
		85 => 'Collin',
		87 => 'Collingsworth',
		89 => 'Colorado',
		91 => 'Comal',
		93 => 'Comanche',
		95 => 'Concho',
		97 => 'Cooke',
		99 => 'Coryell',
		101 => 'Cottle',
		103 => 'Crane',
		105 => 'Crockett',
		107 => 'Crosby',
		109 => 'Culberson',
		111 => 'Dallam',
		113 => 'Dallas',
		115 => 'Dawson',
		117 => 'Deaf Smith',
		119 => 'Delta',
		121 => 'Denton',
		123 => 'DeWitt',
		125 => 'Dickens',
		127 => 'Dimmit',
		129 => 'Donley',
		131 => 'Duval',
		133 => 'Eastland',
		135 => 'Ector',
		137 => 'Edwards',
		139 => 'Ellis',
		141 => 'El Paso',
		143 => 'Erath',
		145 => 'Falls',
		147 => 'Fannin',
		149 => 'Fayette',
		151 => 'Fisher',
		153 => 'Floyd',
		155 => 'Foard',
		157 => 'Fort Bend',
		159 => 'Franklin',
		161 => 'Freestone',
		163 => 'Frio',
		165 => 'Gaines',
		167 => 'Galveston',
		169 => 'Garza',
		171 => 'Gillespie',
		173 => 'Glasscock',
		175 => 'Goliad',
		177 => 'Gonzales',
		179 => 'Gray',
		181 => 'Grayson',
		183 => 'Gregg',
		185 => 'Grimes',
		187 => 'Guadalupe',
		189 => 'Hale',
		191 => 'Hall',
		193 => 'Hamilton',
		195 => 'Hansford',
		197 => 'Hardeman',
		199 => 'Hardin',
		201 => 'Harris',
		203 => 'Harrison',
		205 => 'Hartley',
		207 => 'Haskell',
		209 => 'Hays',
		211 => 'Hemphill',
		213 => 'Henderson',
		215 => 'Hidalgo',
		217 => 'Hill',
		219 => 'Hockley',
		221 => 'Hood',
		223 => 'Hopkins',
		225 => 'Houston',
		227 => 'Howard',
		229 => 'Hudspeth',
		231 => 'Hunt',
		233 => 'Hutchinson',
		235 => 'Irion',
		237 => 'Jack',
		239 => 'Jackson',
		241 => 'Jasper',
		243 => 'Jeff Davis',
		245 => 'Jefferson',
		247 => 'Jim Hogg',
		249 => 'Jim Wells',
		251 => 'Johnson',
		253 => 'Jones',
		255 => 'Karnes',
		257 => 'Kaufman',
		259 => 'Kendall',
		// 261 => 'Kenedy',
		263 => 'Kent',
		265 => 'Kerr',
		267 => 'Kimble',
		269 => 'King',
		271 => 'Kinney',
		273 => 'Kleberg County & Kenedy',
		275 => 'Knox',
		277 => 'Lamar',
		279 => 'Lamb',
		281 => 'Lampasas',
		283 => 'La Salle',
		285 => 'Lavaca',
		287 => 'Lee',
		289 => 'Leon',
		291 => 'Liberty',
		293 => 'Limestone',
		295 => 'Lipscomb',
		297 => 'Live Oak',
		299 => 'Llano',
		301 => 'Loving',
		303 => 'Lubbock',
		305 => 'Lynn',
		307 => 'McCulloch',
		309 => 'McLennan',
		311 => 'McMullen',
		313 => 'Madison',
		315 => 'Marion',
		317 => 'Martin',
		319 => 'Mason',
		321 => 'Matagorda',
		323 => 'Maverick',
		325 => 'Medina',
		327 => 'Menard',
		329 => 'Midland',
		331 => 'Milam',
		333 => 'Mills',
		335 => 'Mitchell',
		337 => 'Montague',
		339 => 'Montgomery',
		341 => 'Moore',
		343 => 'Morris',
		345 => 'Motley',
		347 => 'Nacogdoches',
		349 => 'Navarro',
		351 => 'Newton',
		353 => 'Nolan',
		355 => 'Nueces',
		357 => 'Ochiltree',
		359 => 'Oldham',
		361 => 'Orange',
		363 => 'Palo Pinto',
		365 => 'Panola',
		367 => 'Parker',
		369 => 'Parmer',
		371 => 'Pecos',
		373 => 'Polk',
		375 => 'Potter',
		377 => 'Presidio',
		379 => 'Rains',
		381 => 'Randall',
		383 => 'Reagan',
		385 => 'Real',
		387 => 'Red River',
		389 => 'Reeves',
		391 => 'Refugio',
		393 => 'Roberts',
		395 => 'Robertson',
		397 => 'Rockwall',
		399 => 'Runnels',
		401 => 'Rusk',
		403 => 'Sabine',
		405 => 'San Augustine',
		407 => 'San Jacinto',
		409 => 'San Patricio',
		411 => 'San Saba',
		413 => 'Schleicher',
		415 => 'Scurry',
		417 => 'Shackelford',
		419 => 'Shelby',
		421 => 'Sherman',
		423 => 'Smith',
		425 => 'Somervell',
		427 => 'Starr',
		429 => 'Stephens',
		431 => 'Sterling',
		433 => 'Stonewall',
		435 => 'Sutton',
		437 => 'Swisher',
		439 => 'Tarrant',
		441 => 'Taylor',
		443 => 'Terrell',
		445 => 'Terry',
		447 => 'Throckmorton',
		449 => 'Titus',
		451 => 'Tom Green',
		453 => 'Travis',
		455 => 'Trinity',
		457 => 'Tyler',
		459 => 'Upshur',
		461 => 'Upton',
		463 => 'Uvalde',
		465 => 'Val Verde',
		467 => 'Van Zandt',
		469 => 'Victoria',
		471 => 'Walker',
		473 => 'Waller',
		475 => 'Ward',
		477 => 'Washington',
		479 => 'Webb',
		481 => 'Wharton',
		483 => 'Wheeler',
		485 => 'Wichita',
		487 => 'Wilbarger',
		489 => 'Willacy',
		491 => 'Williamson',
		493 => 'Wilson',
		495 => 'Winkler',
		497 => 'Wise',
		499 => 'Wood',
		501 => 'Yoakum',
		503 => 'Young',
		505 => 'Zapata',
		507 => 'Zavala');
		
		function AgrilifeCustomizer() { //constructor
			$this->getAdminOptions();
		} // End Constructor
		
		
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
				'isFazd' => false,
        'useCustomHeader' => false,
        'custom_header_text' => '',
        'useCustomFooter' => false,
				
				'extension_type' => 0,

        'custom_logo' => '',
				
				'header_type' => 0,
				'titleImg' => '',
				
				'hours' => '',
				
				'county-name' => '',
				'county-name-human' => '',
			
				'address-street1' => '600 John Kimbrough Boulevard',
				'address-street2' => '',
				'address-city' => 'College Station',
				'address-zip' => '77843',
				'map-link' => '',
				'map-img' => '',
				
				'address-mail-street1' => '',
				'address-mail-street2' => '',
				'address-mail-city' => '',
				'address-mail-zip' => '',
				
				'email_public' => '',
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
			$options['isFazd'] = false;
      $options['useCustomHeader'] = false;
      $options['custom_header_text'] = '';
      $options['useCustomFeader'] = false;

			
			// Extension Sub-options
			$options['extension_type'] = 0;
			
      // Additional agency logo
      $options['custom_logo'] = '';

			//Set Site Title Image
			$options['header_type'] = 0;
			$options['titleImg'] = '';
			
			//County Name Default
	  		$options['county-name'] = '';
	  		$options['county-name-human'] = '';
			
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
			
			$options['email_public'] = '';
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
				if (isset($_POST['isFazd'])) {
				  $agrilifeOptions['isFazd'] = $_POST['isFazd'];
				}	
				if (isset($_POST['useCustomHeader'])) {
				  $agrilifeOptions['useCustomHeader'] = $_POST['useCustomHeader'];
        } else {
          $agrilifeOptions['useCustomHeader'] = null;
        }	

				if (isset($_POST['custom_header_text'])) {
				  $agrilifeOptions['custom_header_text'] = $_POST['custom_header_text'];
				}	
				if (isset($_POST['useCustomFooter'])) {
				  $agrilifeOptions['useCustomFooter'] = $_POST['useCustomFooter'];
        }	else {
          $agrilifeOptions['useCustomFooter'] = null;
        }
				
				// Extension Sub-types
				if (isset($_POST['extension_type']) && ($_POST['isExtension']) ) {
				  $agrilifeOptions['extension_type'] = $_POST['extension_type'];
				} else {
				  $agrilifeOptions['extension_type'] = 0;
				}

        // Addtional agency logo
        if (isset($_POST['custom_logo'])) {
          $agrilifeOptions['custom_logo'] = $_POST['custom_logo'];
        } else {
          $agrilifeOptions['custom_logo'] = '';
        }
				
				//County Name Default
				if (isset($_POST['county-name'])) {
				  // County Integer
				  $agrilifeOptions['county-name'] = $_POST['county-name'];
				  // County Name (Human-Readable)
				  $agrilifeOptions['county-name-human'] = $this->countyArray[$_POST['county-name']];
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
				
				if (isset($_POST['email_public'])) 
				  $agrilifeOptions['email_public'] = stripslashes(apply_filters('content_save_pre', $_POST['email_public']));
				
		
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
			<input type="radio" name="extension_type" id="ext_type_0" value="0" <?php if($agrilifeOptions['extension_type']==0) echo 'checked="checked"';?> /> Typical<br />
			<input type="radio" name="extension_type" id="ext_type_1" value="1" <?php if($agrilifeOptions['extension_type']==1) echo 'checked="checked"';?> /> 4-H<br />
			<input type="radio" name="extension_type" id="ext_type_2" value="2" <?php if($agrilifeOptions['extension_type']==2) echo 'checked="checked"';?> /> County Office<br />
			
			
			<div id="county-info">
				<label for="county-name" style="font-weight:bold; margin-left:30px;">County Name</label> 
		        <select name="county-name">
					<?php //Make A County Dropdown
					foreach ($this->countyArray as $i => $value) {
						$selected = ($i==$agrilifeOptions['county-name'] ? 'selected' : '');
					    echo '<option value="'.$i.'" '.$selected.'>'.$this->countyArray[$i].'</option>';
					} ?>
				</select>
			</div>

			
			<input type="radio" name="extension_type" id="ext_type_3" value="3" <?php if($agrilifeOptions['extension_type']==3) echo 'checked="checked"';?> /> County TCE Office<br />
			<input type="radio" name="extension_type" id="ext_type_4" value="4" <?php if($agrilifeOptions['extension_type']==4) echo 'checked="checked"';?> /> Master Gardener Chapter<br />
			<input type="radio" name="extension_type" id="ext_type_5" value="5" <?php if($agrilifeOptions['extension_type']==5) echo 'checked="checked"';?> /> Master Naturalist Chapter<br />
			<input type="radio" name="extension_type" id="ext_type_6" value="6" <?php if($agrilifeOptions['extension_type']==6) echo 'checked="checked"';?> /> Sea Grant<br />
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
		
		
		<a href="javascript:void(0);" onclick="jQuery(this).next('div').toggle();">FAZD</a>
		<div style="display:none; padding:10px 20px 20px; ">
			<p>FAZD Center?
			<label for="isFazd_yes"><input type="radio" id="isFazd_yes" name="isFazd" value="1" <?php if ($agrilifeOptions['isFazd'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="isFazd_no"><input type="radio" id="isFazd_no" name="isFazd" value="0" <?php if (!$agrilifeOptions['isFazd'] ) { _e('checked="checked"', "AgrilifeCustomizer"); }?>/> No</label></p>
		
		</div>
		
		</td>
		</tr>
		</table>

<?php if( is_super_admin() ) : ?>
<h3>Custom Header/Footer</h3>
<p>
  <input type="checkbox" id="useCustomHeader" name="useCustomHeader"<?php if (isset($agrilifeOptions['useCustomHeader'])) { _e( 'checked', AgrilifeCustomizer); }?> />
<label for="useCustomHeader">Show custom header</label>
</p>
<table class="form-table" id="custom-header">
  <tr valign="top">
    <th scope="row">Custom Header Text</th>
      <td><label for="custom-header-text">
        <input id="custom_header_text" type="text" size="100" name="custom_header_text" value="<?php _e($this->showHtml($agrilifeOptions['custom_header_text']), 'AgrilifeCustomizer') ?>" />
    </label></td>
  </tr>
</table>

<p>
  <input type="checkbox" id="useCustomFooter" name="useCustomFooter"<?php if ($agrilifeOptions['useCustomFooter']) { _e( 'checked="checked"', AgrilifeCustomizer); }?> />
<label for="useCustomFooter">Show custom footer</label>
</p>

<?php endif; ?>
		
		<h3>Addtional Agency Logo</h3>
		
    <table class="form-table" id="image_upload_custom">
    <tr valign="top">
    <th scope="row">Upload Image</th>
    <td><label for="upload_image">
    <input id="upload_image_custom" type="text" size="100" name="custom_logo" value="<?php _e($this->showHtml($agrilifeOptions['custom_logo']), 'AgrilifeCustomizer') ?>" />
    <input id="upload_image_button_custom" type="button" value="Upload Image" />
    <br />Enter an URL or upload an image for the addtional logo. Must be 45px in height.
    </label></td>
    </tr>
    </table>
		
		
		
		<h3>Header</h3>
		<input type="radio" name="header_type" value="0" <?php if($agrilifeOptions['header_type']==0) echo 'checked="checked"';?> /> Site Title (text only)<br />
		<input type="radio" name="header_type" value="1" <?php if($agrilifeOptions['header_type']==1) echo 'checked="checked"';?> /> Site Title and Small Logo<br />
		<input type="radio" name="header_type" value="2" <?php if($agrilifeOptions['header_type']==2) echo 'checked="checked"';?> /> Custom Image Header<br />
		 
		<p style="display: none;">A custom 900px by 60px image you have designed.  Make sure it's exported for Web at 72 dpi.</p>
				
<table class="form-table image_upload" id="image_upload_header">
<tr valign="top">
<th scope="row">Upload Image</th>
<td><label for="upload_image">
<input id="upload_image_header" type="text" size="100" name="titleImg" value="<?php _e($this->showHtml($agrilifeOptions['titleImg']), 'AgrilifeCustomizer') ?>" />
<input id="upload_image_button_header" type="button" value="Upload Image" />
<br />Enter an URL or upload an image for the banner.
</label></td>
</tr>
</table>




		
		
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
		<th scope="row">Email (public)</th> 
		<td>
		    <input type="text" name="email_public" id="email_public" class="regular-text" maxlength="200" value="<?php echo $agrilifeOptions['email_public']; ?>" />
		    <br />
			<?php _e('Ex: email@tamu.edu') ?>
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
			add_options_page('AgriLife Site Configuration', 'AgriLife Options', 'edit_others_pages', 'agrilife-config-admin', array(&$agrilife_customizer, 'printAdminPage'));
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



