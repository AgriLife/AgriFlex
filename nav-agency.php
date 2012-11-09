<?php
GLOBAL $isresearch,
  $isextension,
  $iscollege,
  $istvmdl;

GLOBAL $isextensiononly,
  $isresearchonly,
  $iscollegeonly,
  $istvmdlonly,
  $isfazd;

GLOBAL $isextension4h,
  $isextensioncounty,
  $isextensioncountytce,
  $isextensionmg,
  $isextensionmn,
  $isextensionsg;
?>

<div id="drop-section-nav"> 
	<div id="drop-nav">
		<ul>			
			<?php if($iscollegeonly) :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/">Texas A&amp;M College of Agriculture and Life Sciences</a></li>
			<?php elseif($isextensioncountytce) :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas A&amp;M AgriLife Extension Service</a></li>
			<li class="top-agency tce"><a href="http://pvcep.pvamu.edu/">Cooperative Extension Program</a></li>				
			<?php elseif($isextensiononly) :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas A&amp;M AgriLife Extension Service</a></li>		
			<?php elseif($isresearchonly) :?>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/">Texas A&amp;M AgriLife Research</a></li>
			<?php elseif($istvmdlonly) :?>
			<li class="top-agency tvmdl-item"><a href="http://tvmdl.tamu.edu/">Texas Veterinary Medical Diagnostics Laboratory</a></li>
			<?php elseif($isfazd) :?>
			<li class="top-agency fazd-item">National Center for Foreign Animal and Zoonotic Disease Defense</a></li>				
      <?php elseif($options['useCustomHeader']) :?>
      <li class="top-agency custom-header"><?php echo $options['custom_header_text']; ?></li>
			<?php elseif($isextension && $isresearch && !$iscollege && !$istvmdl)  :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/"><span class="top-level-hide">Texas A&amp;M AgriLife Extension Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/extension-branding.png?v=100" alt="Texas A&amp;M Extension Logo" /></a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/"><span class="top-level-hide">Texas A&amp;M AgriLife Research</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/research-branding.png?v=100" alt="Texas A&amp;M Research Logo" /></a></li>	
			
			<?php elseif($isextension && !$isresearch && $iscollege && !$istvmdl)  :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/"><span class="top-level-hide">Texas A&amp;M College of Agriculture and Life Sciences</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/college-branding.png?v=100" alt="Texas A&amp;M College Logo" /></a></li>								
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/"><span class="top-level-hide">Texas A&amp;M AgriLife Extension Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/extension-branding.png?v=100" alt="Texas A&amp;M Extension Logo" /></a></li>
			
			<?php elseif(!$isextension && $isresearch && $iscollege && !$istvmdl)  :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/"><span class="top-level-hide">Texas A&amp;M College of Agriculture and Life Sciences</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/college-branding.png?v=100" alt="Texas A&amp;M College Logo" /></a></li>								
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/"><span class="top-level-hide">Texas A&amp;M AgriLife Research</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/research-branding.png?v=100" alt="Texas A&amp;M Research Logo" /></a></li>	
							
			<?php elseif($isextension && $isresearch && $iscollege && !$istvmdl) :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/"><span class="top-level-hide">Texas A&amp;M College of Agriculture and Life Sciences</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/college-branding.png?v=100" alt="Texas A&amp;M College Logo" /></a></li>				
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/"><span class="top-level-hide">Texas A&amp;M AgriLife Extension Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/extension-branding.png?v=100" alt="Texas A&amp;M Extension Logo" /></a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/"><span class="top-level-hide">Texas A&amp;M AgriLife Research</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/research-branding.png?v=100" alt="Texas A&amp;M Research Logo" /></a></li>	
														
			<?php else : ?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/"><span class="top-level-hide">Texas A&amp;M College of Agriculture and Life Sciences</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/college-branding.png?v=100" alt="Texas A&amp;M College Logo" /></a></li>				
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/"><span class="top-level-hide">Texas A&amp;M AgriLife Extension Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/extension-branding.png?v=100" alt="Texas A&amp;M Extension Logo" /></a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/"><span class="top-level-hide">Texas A&amp;M AgriLife Research</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/research-branding.png?v=100" alt="Texas A&amp;M Research Logo" /></a></li>
			<li class="top-agency tvmdl-item"><a href="http://tvmdl.tamu.edu/"><span class="top-level-hide">Texas A&amp;M Veterinary Medical Diagnostics Laboratory</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/tvmdl-branding.png?v=100" alt="TVMDL Logo" /></a></li>						
			<li class="top-agency tfs-item"><a href="http:///txforestservice.tamu.edu/"><span class="top-level-hide">Texas A&amp;M Forest Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/forest-branding.png?v=100" alt="Texas Forest Service Logo" /></a></li>														
			<?php endif; ?>		
			<!--<li class='ask'><a class="ext-link" href="/ask/">Ask</a></li>-->
			
			<?php if($isextension && $isresearch && $iscollege && $istvmdl) :?>		
			<?php elseif($istvmdlonly) :?>	
			<li class='right-align client-login-li'><a class="client-login" href="https://tvmdl.tamu.edu/webaccess/">Client Login</a></li>
			<?php elseif($iscollegeonly) :?>
			<li class='explore right-align'><a class="ext-link college-explore-link" href="/explore/">Explore</a></li>				
			<?php else : ?>	
			<!--<li class='explore right-align'><a class="ext-link" href="/explore/">Explore</a></li>-->
			<?php endif; ?>
      <?php if ( $isextensionmn ) : ?>
        <li class='top-agency txmn-item'><a href="http://www.tpwd.state.tx.us">Texas Parks & Wildlife</a></li>
      <?php endif; ?>
      <?php if ( $isextensionsg ) : ?>
        <li class='top-agency sg-item'><a href="http://texas-sea-grant.tamu.edu/">Texas Sea Grant</a></li>
      <?php endif; ?>
<?php if ( ! empty($options['custom_logo']) ) : ?>
  <li class="custom-logo"><img src="<?php echo $options['custom_logo']; ?>" height="45px"/></li>
<?php endif; ?>
		</ul>				
	</div><!-- #drop-nav -->	
</div><!-- #drop-section-nav -->
