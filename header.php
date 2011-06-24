<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage county_ext
 * @since county_ext 1.0
 */
 $options = get_option('AgrilifeCountyOptions');
    GLOBAL $options, $googlemap;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;">	
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * county_ext_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon.ico" type="image/ico" />
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
<div id="extension-section-nav">
	<div id="drop-nav">
		<ul>
		<!--	<li class='ask'><a class="ext-link" href="/ask/">Ask</a></li>
			<li class='explore right-align'><a class="ext-link" href="/explore/">Explore</a></li>-->			
			<li class="tx-ext-item"><a href="http://agrilifeextension.tamu.edu/">Texas AgriLife	 Extension Service</a></li>
		</ul>				
	</div><!-- #drop-nav -->	
</div><!-- #extension-section-nav -->
	
<div id="extension-section">
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
</div><!-- #extension-section -->
	
<div id="wrapper" class="hfeed">
	<div id="header">
			<div id="branding" role="banner">
				<h1 id="site-title">
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span>Texas AgriLife Extension Service</span> <em>in <?php echo $options['county-name-human']; ?> County</em></a>
				</h1>
				<div id="site-description"><?php bloginfo( 'description' ); ?></div>
			<!--	<div id="state-regions"><a href="">Find Local Events, Educators,<br> and More...</a></div>	 -->			

			</div><!-- #branding -->
	</div><!-- #header -->		
			<div id="access" role="navigation">	
				<div class="search">
				<?php get_search_form(); ?>
				</div><!-- end .search -->		
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'county_ext' ); ?>"><?php _e( 'Skip to content', 'county_ext' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>			
			</div><!-- #access -->
		