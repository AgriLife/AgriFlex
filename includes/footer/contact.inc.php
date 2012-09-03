<div id="contact">
	<div class="contact">			
	<h4>Contact</h4>
		<?php 
		
		if (($options['extension_type'] == 2 || $options['extension_type'] == 3) && $isextensiononly) {
			require_once (MY_THEME_FOLDER . '/includes/counties.php');
			require_once (MY_THEME_FOLDER . '/includes/nusoap/nusoap.php');
			county_footer_contact();
		} else {		
			$mapaddress=$options['address-street1'].' '.$options['address-street2'].' '.$options['address-city'].', TX '.$options['address-zip'];
			$map_image = ($options['map-img']=='' ? 'http://maps.google.com/maps/api/staticmap?size=175x101&amp;markers=size:mid%7Ccolor:blue%7Clabel:Office%7C'.urlencode($mapaddress).'&amp;sensor=false' : $options['map-img']);
			
			$map_link = ($options['map-link']=='' ? 'http://maps.google.com/?q='.urlencode($mapaddress).'&amp;markers=size:mid%7Ccolor:blue%7Clabel:Office&amp;sensor=false' : $options['map-link']);
			
			?>
			<a href="<?php echo $map_link; ?>"><img src="<?php echo $map_image; ?>" height="101" width="175" alt="Map to office" /></a>
			<ul>
			<?php
			if (is_array($options)) {
				if($options['address-street1']<>'') {
					echo '<li>'.$options['address-street1'];
					if($options['address-street2']<>'')
						echo '<br />'.$options['address-street2'];
					echo '<br />'.$options['address-city'].', TX '.$options['address-zip'].'</li>';
				}
				if($options['address-mail-street1']<>'') {
					echo '<li>'.$options['address-mail-street1'];
					if($options['address-mail-street2']<>'')
						echo '<br />'.$options['address-mail-street2'];
					echo '<br />'.$options['address-mail-city'].', TX '.$options['address-mail-zip'].'</li>';
				}
				if($options['hours']<>'') {
					echo '<li>'.$options['hours'].'</li>';
				}
				if($options['email_public']<>'')
					echo '<li><a href="'.obfuscate('mailto:').obfuscate($options['email_public']).'">'.obfuscate($options['email_public']).'</a></li>';
				if($options['phone']<>'')
					echo '<li><a href="tel:+1'.$options['phone'].'">Phone: '.$options['phone'].'</a></li>';
				if($options['fax']<>'')
					echo '<li>Fax: '.$options['fax'].'</li>';	 						
			}
			?>
			</ul>
		<?php 
		} ?>
		
									
	</div><!-- .contact -->
</div><!-- #contact -->
