<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
	$options = get_option('AgrilifeOptions');
	
  $isresearch 	= (is_array($options) ? $options['isResearch'] 	: true);
  $isextension	= (is_array($options) ? $options['isExtension'] : true);
  $iscollege 	= (is_array($options) ? $options['isCollege'] 	: true);
  $istvmdl	 	= (is_array($options) ? $options['isTvmdl'] 	: true);
  $titleimg		= (is_array($options) ? $options['titleImg'] 	: '');
  
  $extensiononly = ($isextension && !$isresearch && !$iscollege && !$istvmdl ? true : false);
  $researchonly = ($isresearch && !$isextension && !$iscollege && !$istvmdl ? true : false);
  $collegeonly = ($iscollege && !$isextension && !$isresearch && !$istvmdl ? true : false);
  $tvmdlonly = ($istvmdl && !$isextension && !$isresearch && !$iscollege ? true : false);
  $res_ext = (!$istvmdl && $isextension && $isresearch && !$iscollege ? true : false);
  
  if($extensiononly) :
  	$isextensionh4 = $isextensioncounty = $isextensioncountytce = $isextensionmg = $isextensionmn = false;
  	switch ($options['extension_type']) {
  		case 0:
  			break;
  		case 1:
  			// 4-h
  			$isextension4h = true;
  			break;
  		case 2:
  			// County
  			$isextensioncounty = true;
  			break;
  		case 3:
  			// County TCE
  			$isextensioncountytce = true;
  			break;
  		case 4:
  			// Master Gardener
  			$isextensionmg = true;
  			break;
  		case 5:
  			// Master Naturalist
  			$isextensionmn = true;
  			break;
  	}
  endif; 	
?>
</div><!--.wrap-->
</div><!--#content-wrap-->
</div><!-- #wrapper -->
	<footer id="footer" role="contentinfo">
		<div class="wrap">

<?php if($collegeonly) :?>
		
		<div id="about">
			<div class="about">			
				<h4>About</h4>
				<a href="http://www.youtube.com/watch?v=NrfZh8t443M"><img src="<?php bloginfo( 'template_directory' ); ?>/images/college-video.jpg" alt="link to College about video" /></a>
				<p>The College of Agriculture and Life Sciences is the largest of its kind in the U.S. with 400 faculty members, including winners of prestigious awards like the Nobel, Wolf and World Food Prizes. It provides students with hands-on involvement in developing solutions to today’s issues like bioenergy, environmental sustainability, international food security, and youth development.</p>	
			</div><!-- .about -->
		</div><!-- #about -->		
		<div id="popular-links">
			<div class="popular-links">			
				<h4>Departments</h4>
				<a href="http://aglifesciences.tamu.edu/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/Agriculture_HQ.jpg" alt="Texas A and M Ag Life Sciences" /></a>	
				<ul>
					<li><a href="http://agecon.tamu.edu/">Agricultural Economics</a></li>
					<li><a href="http://alec.tamu.edu/">Agricultural Leadership, Education, and Communications</a></li>
					<li><a href="http://animalscience.tamu.edu/">Animal Science</a></li>
					<li><a href="http://biochemistry.tamu.edu/">Biochemistry and Biophysics</a></li>
					<li><a href="http://baen.tamu.edu/">Biological and Agricultural Engineering</a></li>
					<li><a href="http://essm.tamu.edu/">Ecosystem Science and Management</a></li>
					<li><a href="http://insects.tamu.edu/">Entomology</a></li>
					<li><a href="http://hortsciences.tamu.edu/">Horticulture </a></li>
					<li><a href="http://nfs.tamu.edu/">Nutrition and Food Science</a></li>
					<li><a href="http://plantpathology.tamu.edu/">Plant Pathology and Microbiology</a></li>
					<li><a href="http://posc.tamu.edu/">Poultry Science</a></li>
					<li><a href="http://rptsweb.tamu.edu/">Recreation, Park and Tourism Sciences</a></li>
					<li><a href="http://soilcrop.tamu.edu/">Soil and Crop Sciences</a></li>
					<li><a href="http://wfscnet.tamu.edu/">Wildlife and Fisheries Sciences</a></li>									
										 									
				</ul>		
			</div><!-- .popular-links -->			
		</div><!-- #popular-links -->
		
		<div id="texas-a-m">
			<div class="texas-a-m">			
			<h4>Required Links</h4>
				<a href="http://www.tamu.edu"><img src="<?php bloginfo( 'template_directory' ); ?>/images/texas-a-m-logo.png" alt="Texas A&amp;M University" /></a>
				<ul>
					<li><a href="http://agrilife.tamu.edu/compact/">Compact with Texans</a></li> 
					<li><a href="http://agrilife.tamu.edu/privacy/">Privacy and Security</a></li> 
					<li><a href="http://itaccessibility.tamu.edu/">Accessibility Policy</a></li> 
					<li><a href="http://www.dir.state.tx.us/standards/link_policy.htm">State Link Policy</a></li> 
					<li><a href="http://www.tsl.state.tx.us/trail">Statewide Search</a></li> 
					<li><a href="http://aghr.tamu.edu/education-civil-rights.htm">Equal Opportunity for Educational Programs Statement</a></li> 
					<li><a href="http://www.tamus.edu/veterans/">Veterans Benefits</a></li> 
					<li><a href="http://fcs.tamu.edu/families/military_families/">Military Families</a></li> 
					<li><a href="https://secure.ethicspoint.com/domain/en/report_custom.asp?clientid=19681">Risk, Fraud &amp; Misconduct Hotline</a></li> 
					<li><a href="http://www.texashomelandsecurity.com/">Texas Homeland Security</a></li> 
					<li class="last"><a href="http://agrilife.tamu.edu/orpi/">Open Records/Public Information</a></li> 									
				</ul>			
			</div><!-- .texas-a-m -->			
		</div><!-- #texas-a-m -->
	
<?php elseif($researchonly) :?>
		
		<div id="about">
			<div class="about">			
				<h4>About</h4>
				<a href="http://www.youtube.com/watch?v=UnLkKMJasXk"><img src="<?php bloginfo( 'template_directory' ); ?>/images/research-video-pic.jpg" alt="link to Texas A&amp;M Research about video" /></a>
				<p><a href="http://agriliferesearch.tamu.edu/">Texas AgriLife Research</a> is the state’s premier research agency in agriculture, natural resources, and the life sciences. Our research spans numerous scientific disciplines and is international in scope.</p>
				<ul>
					<li><a href="http://agriliferesearch.tamu.edu/research-units/">Research Units</a></li>
					<li><a href="http://agriliferesearch.tamu.edu/about/">About</a></li>
					<li><a href="http://agriliferesearch.tamu.edu/resources/">Resources</a></li>
					<li><a href="http://agriliferesearch.tamu.edu/careers/">Careers</a></li>																						 									
				</ul>	
			</div><!-- .about -->
		</div><!-- #about -->		
		<div id="popular-links">
			<div class="popular-links">			
				<h4>Agencies</h4>
				<a href="http://aglifesciences.tamu.edu/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/agrilife-footer-logo" alt="Texas A and M AgriLife Logo" /></a>	
				<ul>
					<li><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife Extension Service</a></li>
					<li><a href="http://agriliferesearch.tamu.edu/">Texas AgriLife Research</a></li>
					<li><a href="http://tamu.edu/">Texas A&amp;M University</a></li>
					<li><a href="http://aglifesciences.tamu.edu/">College of Agriculture and Life Sciences</a></li>
					<li><a href="http://vetmed.tamu.edu/">College of Veterinary Medicine (cooperative with AgriLife Extension &amp; Research)</a></li>
					<li><a href="http://tvmdl.tamu.edu/">Texas Veterinary Medical Diagnostic Laboratory</a></li>
					<li><a href="http://texasforestservice.tamu.edu/">Texas Forest Service</a></li>																			 									
				</ul>		
			</div><!-- .popular-links -->			
		</div><!-- #popular-links -->
		
		<div id="texas-a-m">
			<div class="texas-a-m">			
			<h4>Required Links</h4>
				<a href="http://www.tamus.edu"><img src="<?php bloginfo( 'template_directory' ); ?>/images/texas-a-m-system.png" alt="Texas A&amp;M System image" /></a>
				<ul>
					<li><a href="http://agrilife.tamu.edu/compact/">Compact with Texans</a></li>
					<li><a href="http://agrilife.tamu.edu/privacy/">Privacy and Security</a></li>
					<li><a href="http://itaccessibility.tamu.edu/">Accessibility Policy</a></li>
					<li><a href="http://www.dir.state.tx.us/standards/link_policy.htm">State Link Policy</a></li>					
					<li><a href="http://www.tsl.state.tx.us/trail">Statewide Search</a></li>					
					<li><a href="http://aghr.tamu.edu/education-civil-rights.htm">Equal Opportunity for Educational Programs Statement</a></li>
					<li><a href="http://www.tamus.edu/veterans/">Veterans Benefits</a></li>		
					<li><a href="http://fcs.tamu.edu/families/military_families/">Military Families</a></li>
					<li><a href="https://secure.ethicspoint.com/domain/en/report_custom.asp?clientid=19681">Risk, Fraud &amp; Misconduct Hotline</a></li>
					<li><a href="http://www.texashomelandsecurity.com/">Texas Homeland Security</a></li>
					<li class="last"><a href="http://agrilife.tamu.edu/orpi/">Open Records/Public Information</a></li>
				</ul>		
			</div><!-- .texas-a-m -->		
		</div><!-- #texas-a-m -->				

<?php elseif($isextension4h) :?>

		<div id="about">
			<div class="about">			
				<h4>About 4-H</h4>
				<a href="http://www.4-h.org/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/about_4-h.jpg" alt="link to 4-H site" /></a>
				<p><a href="http://www.4-h.org/">4-H</a> is a positive youth development organization that empowers young people to reach their full potential.</p>	
				<ul>
					<li><a href="http://texas4-h.tamu.edu/about/">Learn About 4-H</a></li>
					<li><a href="http://texas4-h.tamu.edu/youth/scholarships/index_youth_scholarships.php">Scholarships</a></li>
					<li><a href="http://texas4-h.tamu.edu/publications/">Publications</a></li>
					<li><a href="http://texas4-h.tamu.edu/district_sites/">District Websites</a></li>					
					<li><a href="http://texas4-h.tamu.edu/projects/index_projects_programs.php">Projects &amp; Programs</a></li>					
					<li><a href="http://texas4-h.tamu.edu/youth/roundup/">Roundup</a></li>
					<li class="last"><a href="http://texas4-h.tamu.edu/youth/">Youth</a></li>										
				</ul>				
			</div><!-- .about -->
		</div><!-- #about -->	
			
		<div id="popular-links">
			<div class="popular-links">			
				<h4>Popular Links</h4>
				<a href="http://agrilifeextension.tamu.edu/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/agrilife_ext_logo.png" alt="Texas AgriLife Extension" /></a>	
				<ul>
					<li><a href="http://county-tx.tamu.edu/">County Extension Offices</a></li>
					<li><a href="http://agrilife.tamu.edu/locations-window/#centers">Research and Extension Centers</a></li>
					<li><a href="http://agdirectory.tamu.edu/">Contact Directory</a></li>
					<li><a href="http://agrilife.org/today/contact-us/">Media Contacts</a></li>					
					<li><a href="http://texas4-h.tamu.edu/">Texas 4-H and Youth Dev.</a></li>					
					<li><a href="http://agrilifeextension.tamu.edu/about/strategyimpact/index.php">Strategic Plans, Impacts and Roadmaps</a></li>
					<li class="last"><a href="http://agrilifeextension.tamu.edu/careers/index.php">Employment Opportunities</a></li>										
				</ul>		
			</div><!-- .popular-links -->			
		</div><!-- #popular-links -->
		
		<div id="texas-a-m">
			<div class="texas-a-m">			
			<h4>Required Links</h4>
				<a href="http://www.tamus.edu"><img src="<?php bloginfo( 'template_directory' ); ?>/images/texas-a-m-system.png" alt="Texas A&amp;M System image" /></a>
				<ul>
					<li><a href="http://agrilife.tamu.edu/compact/">Compact with Texans</a></li>
					<li><a href="http://agrilife.tamu.edu/privacy/">Privacy and Security</a></li>
					<li><a href="http://itaccessibility.tamu.edu/">Accessibility Policy</a></li>
					<li><a href="http://www.dir.state.tx.us/standards/link_policy.htm">State Link Policy</a></li>					
					<li><a href="http://www.tsl.state.tx.us/trail">Statewide Search</a></li>					
					<li><a href="http://aghr.tamu.edu/education-civil-rights.htm">Equal Opportunity for Educational Programs Statement</a></li>
					<li><a href="http://www.tamus.edu/veterans/">Veterans Benefits</a></li>		
					<li><a href="http://fcs.tamu.edu/families/military_families/">Military Families</a></li>
					<li><a href="https://secure.ethicspoint.com/domain/en/report_custom.asp?clientid=19681">Risk, Fraud &amp; Misconduct Hotline</a></li>
					<li><a href="http://www.texashomelandsecurity.com/">Texas Homeland Security</a></li>
					<li class="last"><a href="http://agrilife.tamu.edu/orpi/">Open Records/Public Information</a></li>
				</ul>		
			</div><!-- .texas-a-m -->			
		</div><!-- #texas-a-m -->	
		
<?php elseif($isextensiononly && !$isextension4h) :?>

		<div id="about">
			<div class="about">			
				<h4>About</h4>
				<a href="http://www.youtube.com/watch?v=q_UsLHl_YDQ"><img src="<?php bloginfo( 'template_directory' ); ?>/images/about_video.jpg" alt="link to Extension about video" /></a>
				<p>A unique education agency, the Texas AgriLife Extension Service teaches Texans wherever they live, extending research-based knowledge to benefit their families and communities.</p>	
			</div><!-- .about -->
		</div><!-- #about -->	
			
		<div id="popular-links">
			<div class="popular-links">			
				<h4>Popular Links</h4>
				<a href="http://agrilifeextension.tamu.edu/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/agrilife_ext_logo.png" alt="Texas AgriLife Extension" /></a>	
				<ul>
					<li><a href="http://county-tx.tamu.edu/">County Extension Offices</a></li>
					<li><a href="http://agrilife.tamu.edu/locations-window/#centers">Research and Extension Centers</a></li>
					<li><a href="http://agdirectory.tamu.edu/">Contact Directory</a></li>
					<li><a href="http://agrilife.org/today/contact-us/">Media Contacts</a></li>					
					<li><a href="http://texas4-h.tamu.edu/">Texas 4-H and Youth Dev.</a></li>					
					<li><a href="http://agrilifeextension.tamu.edu/about/strategyimpact/index.php">Strategic Plans, Impacts and Roadmaps</a></li>
					<li class="last"><a href="http://agrilifeextension.tamu.edu/careers/index.php">Employment Opportunities</a></li>										
				</ul>		
			</div><!-- .popular-links -->			
		</div><!-- #popular-links -->
		
		<div id="texas-a-m">
			<div class="texas-a-m">			
			<h4>Required Links</h4>
				<a href="http://www.tamus.edu"><img src="<?php bloginfo( 'template_directory' ); ?>/images/texas-a-m-system.png" alt="Texas A&amp;M System image" /></a>
				<ul>
					<li><a href="http://agrilife.tamu.edu/compact/">Compact with Texans</a></li>
					<li><a href="http://agrilife.tamu.edu/privacy/">Privacy and Security</a></li>
					<li><a href="http://itaccessibility.tamu.edu/">Accessibility Policy</a></li>
					<li><a href="http://www.dir.state.tx.us/standards/link_policy.htm">State Link Policy</a></li>					
					<li><a href="http://www.tsl.state.tx.us/trail">Statewide Search</a></li>					
					<li><a href="http://aghr.tamu.edu/education-civil-rights.htm">Equal Opportunity for Educational Programs Statement</a></li>
					<li><a href="http://www.tamus.edu/veterans/">Veterans Benefits</a></li>		
					<li><a href="http://fcs.tamu.edu/families/military_families/">Military Families</a></li>
					<li><a href="https://secure.ethicspoint.com/domain/en/report_custom.asp?clientid=19681">Risk, Fraud &amp; Misconduct Hotline</a></li>
					<li><a href="http://www.texashomelandsecurity.com/">Texas Homeland Security</a></li>
					<li class="last"><a href="http://agrilife.tamu.edu/orpi/">Open Records/Public Information</a></li>
				</ul>		
			</div><!-- .texas-a-m -->			
		</div><!-- #texas-a-m -->			
	

<?php elseif($tvmdlonly) :?>

	<div id="about">
			<div class="about">			
				<h4>About</h4>
				<a href="http://www.youtube.com/watch?v=q_UsLHl_YDQ"><img src="<?php bloginfo( 'template_directory' ); ?>/images/about_video.jpg" alt="link to Extension about video" /></a>
				<p>Copy</p>	
			</div><!-- .about -->
		</div><!-- #about -->	
			
		<div id="popular-links">
			<div class="popular-links">			
				<h4>Popular Links</h4>
				<a href="http://agrilifeextension.tamu.edu/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/agrilife_tvmdl_logo.png" alt="TVMDL" /></a>	
				<ul>
					<li><a href="http://tvmdl.tamu.edu/">TVMDL Link</a></li>
					<li class="last"><a href="http://tvmdl.tamu.edu/">TVMDL Link</a></li>										
				</ul>		
			</div><!-- .popular-links -->			
		</div><!-- #popular-links -->
		
		<div id="texas-a-m">
			<div class="texas-a-m">			
			<h4>Required Links</h4>
				<a href="http://www.tamus.edu"><img src="<?php bloginfo( 'template_directory' ); ?>/images/texas-a-m-system.png" alt="Texas A&amp;M System image" /></a>
				<ul>
					<li><a href="http://agrilife.tamu.edu/compact/">Compact with Texans</a></li>
					<li><a href="http://agrilife.tamu.edu/privacy/">Privacy and Security</a></li>
					<li><a href="http://itaccessibility.tamu.edu/">Accessibility Policy</a></li>
					<li><a href="http://www.dir.state.tx.us/standards/link_policy.htm">State Link Policy</a></li>					
					<li><a href="http://www.tsl.state.tx.us/trail">Statewide Search</a></li>					
					<li><a href="http://aghr.tamu.edu/education-civil-rights.htm">Equal Opportunity for Educational Programs Statement</a></li>
					<li><a href="http://www.tamus.edu/veterans/">Veterans Benefits</a></li>		
					<li><a href="http://fcs.tamu.edu/families/military_families/">Military Families</a></li>
					<li><a href="https://secure.ethicspoint.com/domain/en/report_custom.asp?clientid=19681">Risk, Fraud &amp; Misconduct Hotline</a></li>
					<li><a href="http://www.texashomelandsecurity.com/">Texas Homeland Security</a></li>
					<li class="last"><a href="http://agrilife.tamu.edu/orpi/">Open Records/Public Information</a></li>
				</ul>		
			</div><!-- .texas-a-m -->			
		</div><!-- #texas-a-m -->			
		
<?php else : // Multi-agency ?>	
		
		<div id="about">
			<div class="about">			
				<h4>About</h4>
				<a href="http://www.youtube.com/watch?v=q_UsLHl_YDQ"><img src="<?php bloginfo( 'template_directory' ); ?>/images/about_video.jpg" alt="link to Extension about video" /></a>
				<p>A unique education agency, the Texas AgriLife Extension Service teaches Texans wherever they live, extending research-based knowledge to benefit their families and communities.</p>	
			</div><!-- .about -->
		</div><!-- #about -->		
		<div id="popular-links">
			<div class="popular-links">			
				<h4>AgriLife Agencies</h4>
				<a href="http://aglifesciences.tamu.edu/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/agrilife-footer-logo" alt="Texas A and M AgriLife Logo" /></a>	
				<ul>
					<li><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife Extension Service</a></li>
					<li><a href="http://agriliferesearch.tamu.edu/">Texas AgriLife Research</a></li>
					<li><a href="http://tamu.edu/">Texas A&amp;M University</a></li>
					<li><a href="http://aglifesciences.tamu.edu/">College of Agriculture and Life Sciences</a></li>
					<li><a href="http://vetmed.tamu.edu/">College of Veterinary Medicine (cooperative with AgriLife Extension &amp; Research)</a></li>
					<li><a href="http://tvmdl.tamu.edu/">Texas Veterinary Medical Diagnostic Laboratory</a></li>
					<li><a href="http://texasforestservice.tamu.edu/">Texas Forest Service</a></li>																			 									
				</ul>		
			</div><!-- .popular-links -->			
		</div><!-- #popular-links -->
		
		<div id="texas-a-m">
			<div class="texas-a-m">			
			<h4>Required Links</h4>
				<a href="http://www.tamus.edu"><img src="<?php bloginfo( 'template_directory' ); ?>/images/texas-a-m-system.png" alt="Texas A&amp;M System image" /></a>
				<ul>
					<li><a href="http://agrilife.tamu.edu/compact/">Compact with Texans</a></li>
					<li><a href="http://agrilife.tamu.edu/privacy/">Privacy and Security</a></li>
					<li><a href="http://itaccessibility.tamu.edu/">Accessibility Policy</a></li>
					<li><a href="http://www.dir.state.tx.us/standards/link_policy.htm">State Link Policy</a></li>					
					<li><a href="http://www.tsl.state.tx.us/trail">Statewide Search</a></li>					
					<li><a href="http://aghr.tamu.edu/education-civil-rights.htm">Equal Opportunity for Educational Programs Statement</a></li>
					<li><a href="http://www.tamus.edu/veterans/">Veterans Benefits</a></li>		
					<li><a href="http://fcs.tamu.edu/families/military_families/">Military Families</a></li>
					<li><a href="https://secure.ethicspoint.com/domain/en/report_custom.asp?clientid=19681">Risk, Fraud &amp; Misconduct Hotline</a></li>
					<li><a href="http://www.texashomelandsecurity.com/">Texas Homeland Security</a></li>
					<li class="last"><a href="http://agrilife.tamu.edu/orpi/">Open Records/Public Information</a></li>
				</ul>		
			</div><!-- .texas-a-m -->			
		</div><!-- #texas-a-m -->				

<?php endif; ?>
		
		<div id="contact">
			<div class="contact">			
			<h4>Contact</h4>
				<?php 
				
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
					if($options['phone']<>'')
						echo '<li>Phone: '.$options['phone'].'</li>';
					if($options['fax']<>'')
						echo '<li>Fax: '.$options['fax'].'</li>';	 						
				}
				?>
				</ul>
				
											
			</div><!-- .contact -->
		</div><!-- #contact -->
		
		<div id="agrilife-bookstore">
			<div class="agrilife-bookstore">			
			<h4>AgriLife Bookstore</h4>
				<a href="https://agrilifebookstore.org/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/bookstore-books.png" alt="Image of books for the AgriLife Bookstore" /></a>
				<p>The Texas AgriLife Extension Bookstore offers educational publications, CDs and videos on topics related to agriculture, 4-H and youth development.</p>				
			</div><!-- .agrilife-bookstore -->			
		</div><!-- #agrilife-bookstore -->
						
		</div><!-- .wrap -->		
	</footer><!-- #footer -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
