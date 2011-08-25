<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
 $options = get_option('AgrilifeOptions');
 
  GLOBAL $options,$googlemap;

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
?><!DOCTYPE html>
<!--[if lt IE 7]>
<html id="ie6" class="no-js ie6 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="no-js ie7 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="no-js ie8 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 ***Does not validate***-->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width; initial-scale=1.0;">	
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * agriflex_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?11" />
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/ie.css?1" />
<![endif]-->
<link rel="shortcut icon" href="http://agrilifecdn.tamu.edu/wp-content/themes/agrilife-2.0/favicon.ico" type="image/ico" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ($googlemap) echo $googlemap; ?>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>

<body <?php body_class(); ?>>
<div id="drop-section-nav"> 
	<div id="drop-nav">
		<ul>			
			<?php if($collegeonly) :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/">Texas A&amp;M College of Agriculture and Life Sciences</a></li>
			<?php elseif($extensiononly) :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife Extension Service</a></li>
			<?php elseif($researchonly) :?>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/">Texas A&amp;M Research</a></li>
			<?php elseif($tvmdlonly) :?>
			<li class="top-agency tvmdl-item"><a href="http://tvmdl.tamu.edu/">Texas Veterinary Medical Diagnostics Laboratory</a></li>
			<li class='right-align'><a class="explore" href="/explore/">Tests</a></li>	
			
			<?php elseif($res_ext) :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife	Extension Service</a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/">Texas A&amp;M Research</a></li>
					
			<?php elseif($isextension && $isresearch && $iscollege && !$istvmdl) :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife	Extension Service</a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/">Texas A&amp;M Research</a></li>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/">Texas A&amp;M College of Agriculture and Life Sciences</a></li>												
			<?php else : ?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife	Extension Service</a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/">Texas A&amp;M Research</a></li>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/">Texas A&amp;M College of Agriculture and Life Sciences</a></li>
			<li class="top-agency tvmdl-item"><a href="http://tvmdl.tamu.edu/">Texas Veterinary Medical Diagnostics Laboratory</a></li>						
			<li class="top-agency tfs-item"><a href="http:///txforestservice.tamu.edu/">Texas Forest Service</a></li>														
			<?php endif; ?>		
			<!--<li class='ask'><a class="ext-link" href="/ask/">Ask</a></li>
			<li class='explore right-align'><a class="ext-link" href="/explore/">Explore</a></li>-->
		</ul>				
	</div><!-- #drop-nav -->	
</div><!-- #drop-section-nav -->
	
<div id="drop-section">
	<div class="flow">
		<div class="contents">
			<div class="wrap">
			<div class="gform_wrapper">
	            <form id='gform_1' action="http://agrilife.org" method="post" enctype='multipart/form-data' accept-charset="utf-8">
	                <fieldset class="first">
	                    <div class="container">
	                        <input type="text" name="name" id="name" placeholder="Your Name" value="">
	                    </div>
	                    <div class="container">
	                        <input type="text" name="email" id="email" placeholder="Your eMail" value="">
	                    </div>
	                    <div class="container">

	                    </div>
	                </fieldset><!-- /.first -->
	                <fieldset class="second">
	                    <div class="container">
	                        <textarea name="message" placeholder="Your Question" id="message" rows="2" cols="25"> </textarea>
	                    </div>

	                </fieldset><!-- /.second -->
	                <div class="button-container">
	                    <button class="btn" type="reset">Cancel</button>
	                    <button class="btn" type="submit" name="submit">Send</button>
	                    <input type="hidden" name="sent" value="true">
	                </div><!-- /.button-container -->
	            </form>
			</div><!-- .gform_wrapper -->	
			<div id="top-level-nav">
				
				<div id="ext-intro">
					<p>Texas AgriLife Extension Service offers practical, how-to education based on university research. <a href="http://agrilifeextension.tamu.edu/">More &rarr;</a><p>
				</div>
				<div class="top-level-nav business-nav">
					<h2>Category A</h2>
						<div class="tags"><ul><li><a href='http://agrilifedev/county/tag/4-h/' title='4-h Tag' class='4-h'>topic</a></li><li><a href='http://agrilifedev/county/tag/agriculture/' title='agriculture Tag' class='agriculture'>topic</a></li><li><a href='http://agrilifedev/county/tag/crops/' title='crops Tag' class='crops'>topic</a></li><li><a href='http://agrilifedev/county/tag/disaster-recovery/' title='disaster recovery Tag' class='disaster-recovery'>topic</a></li><li><a href='http://agrilifedev/county/tag/food/' title='food Tag' class='food'>topic</a></li><li><a href='http://agrilifedev/county/tag/health/' title='health Tag' class='health'>topic</a></li><li><a href='http://agrilifedev/county/tag/4-h/' title='4-h Tag' class='4-h'>topic</a></li><li><a href='http://agrilifedev/county/tag/agriculture/' title='agriculture Tag' class='agriculture'>topic</a></li><li><a href='http://agrilifedev/county/tag/crops/' title='crops Tag' class='crops'>topic</a></li><li><a href='http://agrilifedev/county/tag/disaster-recovery/' title='disaster recovery Tag' class='disaster-recovery'>topic</a></li><li><a href='http://agrilifedev/county/tag/food/' title='food Tag' class='food'>topic</a></li><li><a href='http://agrilifedev/county/tag/health/' title='health Tag' class='health'>topic</a></li></ul><!-- .tags --></div><!-- .tags -->
				</div>	
				<div class="top-level-nav home-nav">
					<h2>Category B</h2>
						<div class="tags"><ul><li><a href='http://agrilifedev/county/tag/4-h/' title='4-h Tag' class='4-h'>topic</a></li><li><a href='http://agrilifedev/county/tag/agriculture/' title='agriculture Tag' class='agriculture'>topic</a></li><li><a href='http://agrilifedev/county/tag/crops/' title='crops Tag' class='crops'>topic</a></li><li><a href='http://agrilifedev/county/tag/disaster-recovery/' title='disaster recovery Tag' class='disaster-recovery'>topic</a></li><li><a href='http://agrilifedev/county/tag/food/' title='food Tag' class='food'>topic</a></li><li><a href='http://agrilifedev/county/tag/health/' title='health Tag' class='health'>topic</a></li><li><a href='http://agrilifedev/county/tag/4-h/' title='4-h Tag' class='4-h'>topic</a></li><li><a href='http://agrilifedev/county/tag/agriculture/' title='agriculture Tag' class='agriculture'>topic</a></li><li><a href='http://agrilifedev/county/tag/crops/' title='crops Tag' class='crops'>topic</a></li><li><a href='http://agrilifedev/county/tag/disaster-recovery/' title='disaster recovery Tag' class='disaster-recovery'>topic</a></li><li><a href='http://agrilifedev/county/tag/food/' title='food Tag' class='food'>topic</a></li><li><a href='http://agrilifedev/county/tag/health/' title='health Tag' class='health'>topic</a></li></ul><!-- .tags --></div><!-- .tags -->				
				</div>				
				<div class="top-level-nav government-nav">
					<h2>Category C</h2>
						<div class="tags"><ul><li><a href='http://agrilifedev/county/tag/4-h/' title='4-h Tag' class='4-h'>topic</a></li><li><a href='http://agrilifedev/county/tag/agriculture/' title='agriculture Tag' class='agriculture'>topic</a></li><li><a href='http://agrilifedev/county/tag/crops/' title='crops Tag' class='crops'>topic</a></li><li><a href='http://agrilifedev/county/tag/disaster-recovery/' title='disaster recovery Tag' class='disaster-recovery'>topic</a></li><li><a href='http://agrilifedev/county/tag/food/' title='food Tag' class='food'>topic</a></li><li><a href='http://agrilifedev/county/tag/health/' title='health Tag' class='health'>topic</a></li><li><a href='http://agrilifedev/county/tag/4-h/' title='4-h Tag' class='4-h'>topic</a></li><li><a href='http://agrilifedev/county/tag/agriculture/' title='agriculture Tag' class='agriculture'>topic</a></li><li><a href='http://agrilifedev/county/tag/crops/' title='crops Tag' class='crops'>topic</a></li><li><a href='http://agrilifedev/county/tag/disaster-recovery/' title='disaster recovery Tag' class='disaster-recovery'>topic</a></li><li><a href='http://agrilifedev/county/tag/food/' title='food Tag' class='food'>topic</a></li><li><a href='http://agrilifedev/county/tag/health/' title='health Tag' class='health'>topic</a></li></ul><!-- .tags --></div><!-- .tags -->			
				</div>				
				<div class="top-level-nav k-12-schools-nav">
					<h2>Category D</h2>
						<div class="tags"><ul><li><a href='http://agrilifedev/county/tag/4-h/' title='4-h Tag' class='4-h'>topic</a></li><li><a href='http://agrilifedev/county/tag/agriculture/' title='agriculture Tag' class='agriculture'>topic</a></li><li><a href='http://agrilifedev/county/tag/crops/' title='crops Tag' class='crops'>topic</a></li><li><a href='http://agrilifedev/county/tag/disaster-recovery/' title='disaster recovery Tag' class='disaster-recovery'>topic</a></li><li><a href='http://agrilifedev/county/tag/food/' title='food Tag' class='food'>topic</a></li><li><a href='http://agrilifedev/county/tag/health/' title='health Tag' class='health'>topic</a></li><li><a href='http://agrilifedev/county/tag/4-h/' title='4-h Tag' class='4-h'>topic</a></li><li><a href='http://agrilifedev/county/tag/agriculture/' title='agriculture Tag' class='agriculture'>topic</a></li><li><a href='http://agrilifedev/county/tag/crops/' title='crops Tag' class='crops'>topic</a></li><li><a href='http://agrilifedev/county/tag/disaster-recovery/' title='disaster recovery Tag' class='disaster-recovery'>topic</a></li><li><a href='http://agrilifedev/county/tag/food/' title='food Tag' class='food'>topic</a></li><li><a href='http://agrilifedev/county/tag/health/' title='health Tag' class='health'>topic</a></li></ul><!-- .tags --></div><!-- .tags -->				
				</div>									
			</div><!-- #top-level-nav -->				

			</div><!-- .wrap -->
		</div><!-- .contents -->	
	</div><!-- .flow -->		
</div><!-- #drop-section -->
	
<div id="wrapper" class="hfeed">
	<div id="header">
			<header id="branding" role="banner">
				<hgroup>
				<h1 id="site-title">
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php if($options['header_type']==1 && $options['titleImg']<>'') :?>
							<img src="<?php echo $options['titleImg']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
						<?php endif; ?>
							
						<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a>		
				</h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
				<div class="search">
				<ul id="navigation-link-ul">
					<li class="navigation-link">Navigation</li>
				</ul>
				<?php get_search_form(); ?>
				</div><!-- end .search -->					
			</header><!-- #branding -->	
		</div><!-- end #header -->
			<nav id="access" role="navigation">		
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'agriflex' ); ?>"><?php _e( 'Skip to content', 'agriflex' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>				<div class="clear"></div>
			</nav><!-- .access -->
	<div id="content-wrap">		
		<div class="wrap">	