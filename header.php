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
 
  GLOBAL $options,$googlemap;
  GLOBAL $isresearch, $isextension, $iscollege, $istvmdl;
  GLOBAL $isextensiononly, $isresearchonly, $iscollegeonly, $istvmdlonly, $isfazd;
  GLOBAL $isextension4h, $isextensioncounty, $isextensioncountytce, $isextensionmg, $isextensionmn;
  
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
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * agriflex_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?3" />
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/iefix.css?2" />
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
	<!-- Hook up the FlexSlider and FitVids-->
	<script type="text/javascript">
	
		$(window).load(function() {
			$('.flexslider').flexslider({
				animation: "slide",
          		controlsContainer: ".flex-container",
				animationDuration: 300     
				});
			$("#tabs-1,.entry-content").fitVids();
		});
	</script>
</head>

<body <?php body_class(); ?>>
<div id="drop-section-nav"> 
	<div id="drop-nav">
		<ul>			
			<?php if($iscollegeonly) :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/">Texas A&amp;M College of Agriculture and Life Sciences</a></li>
			<?php elseif($isextensioncountytce) :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife Extension Service</a></li>
			<li class="top-agency tce"><a href="http://pvcep.pvamu.edu/">Cooperative Extension Program</a></li>				
			<?php elseif($isextensiononly) :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife Extension Service</a></li>		
			<?php elseif($isresearchonly) :?>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/">Texas A&amp;M Research</a></li>
			<?php elseif($istvmdlonly) :?>
			<li class="top-agency tvmdl-item"><a href="http://tvmdl.tamu.edu/">Texas Veterinary Medical Diagnostics Laboratory</a></li>
			<?php elseif($isfazd) :?>
			<li class="top-agency fazd-item">National Center for Foreign Animal and Zoonotic Disease Defense</a></li>				
			
			<?php elseif($isextension && $isresearch && !$iscollege && !$istvmdl)  :?>
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/"><span class="top-level-hide">Texas AgriLife Extension Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/extension-branding.png" alt="Texas A&amp;M Extension Logo" /></a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/"><span class="top-level-hide">Texas A&amp;M Research</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/research-branding.png" alt="Texas A&amp;M Research Logo" /></a></li>	
			
			<?php elseif($isextension && !$isresearch && $iscollege && !$istvmdl)  :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/"><span class="top-level-hide">Texas A&amp;M College of Agriculture and Life Sciences</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/college-branding.png" alt="Texas A&amp;M College Logo" /></a></li>								
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/"><span class="top-level-hide">Texas AgriLife Extension Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/extension-branding.png" alt="Texas A&amp;M Extension Logo" /></a></li>
			
			<?php elseif(!$isextension && $isresearch && $iscollege && !$istvmdl)  :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/"><span class="top-level-hide">Texas A&amp;M College of Agriculture and Life Sciences</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/college-branding.png" alt="Texas A&amp;M College Logo" /></a></li>								
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/"><span class="top-level-hide">Texas A&amp;M Research</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/research-branding.png" alt="Texas A&amp;M Research Logo" /></a></li>	
							
			<?php elseif($isextension && $isresearch && $iscollege && !$istvmdl) :?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/"><span class="top-level-hide">Texas A&amp;M College of Agriculture and Life Sciences</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/college-branding.png" alt="Texas A&amp;M College Logo" /></a></li>				
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/"><span class="top-level-hide">Texas AgriLife Extension Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/extension-branding.png" alt="Texas A&amp;M Extension Logo" /></a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/"><span class="top-level-hide">Texas A&amp;M Research</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/research-branding.png" alt="Texas A&amp;M Research Logo" /></a></li>	
														
			<?php else : ?>
			<li class="top-agency college-item"><a href="http://aglifesciences.tamu.edu/"><span class="top-level-hide">Texas A&amp;M College of Agriculture and Life Sciences</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/college-branding.png" alt="Texas A&amp;M College Logo" /></a></li>				
			<li class="top-agency tx-ext-item"><a href="http://agrilifeextension.tamu.edu/"><span class="top-level-hide">Texas AgriLife Extension Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/extension-branding.png" alt="Texas A&amp;M Extension Logo" /></a></li>
			<li class="top-agency research-item"><a href="http://agriliferesearch.tamu.edu/"><span class="top-level-hide">Texas A&amp;M Research</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/research-branding.png" alt="Texas A&amp;M Research Logo" /></a></li>
			<li class="top-agency tvmdl-item"><a href="http://tvmdl.tamu.edu/"><span class="top-level-hide">Texas Veterinary Medical Diagnostics Laboratory</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/tvmdl-branding.png" alt="TVMDL Logo" /></a></li>						
			<li class="top-agency tfs-item"><a href="http:///txforestservice.tamu.edu/"><span class="top-level-hide">Texas Forest Service</span><img src="<?php bloginfo('stylesheet_directory') ?>/images/forest-branding.png" alt="Texas Forest Service Logo" /></a></li>														
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
		</ul>				
	</div><!-- #drop-nav -->	
</div><!-- #drop-section-nav -->

<?php if($iscollegeonly) college_top_level_section() ?>
	
<div id="wrapper" class="hfeed">
	<div id="header">
			<header id="branding" role="banner">
				<hgroup>
				<h1 id="site-title">
				<?php if($isextensioncounty) :?>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><span>Texas AgriLife Extension Service</span> <em>in <?php echo $options['county-name-human']; ?> County</em></a>
				
				<?php elseif($isextensioncountytce) :?>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><span>Extension Education</span> <em>in <?php echo $options['county-name-human']; ?> County</em></a>
									
				<?php elseif($isextensionmg) :?>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<img src="<?php bloginfo('stylesheet_directory') ?>/images/txmg-logo80.gif" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
						</a>
				<?php elseif($isextensionmn) :?>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<img src="<?php bloginfo('stylesheet_directory') ?>/images/txmn-logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
						</a>		

				<?php else : ?>	
			
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php if($options['header_type']==1 && $options['titleImg']<>'') :
							// Image with Small Logo ?>
							<img src="<?php echo $options['titleImg']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
						<?php elseif($options['header_type']==2) : 
							// Full Width Image ?>
							<img src="<?php echo $options['titleImg']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							<span class="full-img-text"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span>
						<?php else: 
							// Just Site Title ?>
							<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
						<?php endif; ?>
						</a>
							
				
				<?php endif; ?>
				</h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
				<?php get_search_form(); ?>					
			</header><!-- #branding -->	
		</div><!-- end #header -->
			<div class='menu-button'>Menu</div>
			<nav id="access" role="navigation">		
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'agriflex' ); ?>"><?php _e( 'Skip to content', 'agriflex' ); ?></a></div>
				
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>

				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>  
				
			</nav><!-- .access -->
	<div id="content-wrap">		
		<div class="wrap">	
