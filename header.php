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
  GLOBAL $isextensiononly, $isresearchonly, $iscollegeonly, $istvmdlonly;
  GLOBAL $isextensionh4, $isextensioncounty, $isextensioncountytce, $isextensionmg, $isextensionmn;
  
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
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?50" />
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
			<li class='right-align'><a class="explore" href="/explore/">Tests</a></li>	
			
			<?php elseif($isextension && $isresearch && !$iscollege && !$istvmdl)  :?>
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
			<!--<li class='ask'><a class="ext-link" href="/ask/">Ask</a></li>-->
			<li class='explore right-align'><a class="ext-link" href="/explore/">Explore</a></li>
		</ul>				
	</div><!-- #drop-nav -->	
</div><!-- #drop-section-nav -->

<?php if($collegeonly) college_top_level_section() ?>
	
<div id="wrapper" class="hfeed">
	<div id="header">
			<header id="branding" role="banner">
				<hgroup>
					
				<?php if($isextensioncounty) :?>
				<h1 id="site-title">
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><span>Texas AgriLife Extension Service</span> <em>in <?php echo $options['county-name-human']; ?> County</em></a></h1>
				
				<?php elseif($isextensioncountytce) :?>
				<h1 id="site-title">
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><span>Extension Education</span> <em>in <?php echo $options['county-name-human']; ?> County</em></a></h1>
									
				<?php else : ?>	
				<h1 id="site-title">
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php if($options['header_type']==1 && $options['titleImg']<>'') :?>
							<img src="<?php echo $options['titleImg']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a>	
						<?php elseif($options['header_type']==2) : ?>
							<img src="<?php echo $options['titleImg']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
						<?php else: ?>
							<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a>
						<?php endif; ?>
							
							
				</h1>
				<?php endif; ?>
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
				<div class="clear"></div>
				
				<?php 
				function agrilife_default_menu() {
					// This mess is to mimic existing DOM structures
					echo '<div class="menu-header">';
					$default_menu = wp_page_menu( array( 'show_home' => 'Blog', 'sort_column' => 'menu_order', 'echo' => false ) );;
					$default_menu = str_replace('<ul>', '<ul id="menu-main-site-navigation" class="sf-menu menu">', $default_menu);
					$default_menu = str_replace('title="Home"', 'title="home"', $default_menu);  // WP defaults to "Home" on "home"
					echo $default_menu;
					echo '</div>';
				}?>
			</nav><!-- .access -->
	<div id="content-wrap">		
		<div class="wrap">	