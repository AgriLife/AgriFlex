<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage county_ext
 * @since county_ext 1.0
 */
?>
<div id="aside">

	<div id="aside-widget-area-1">
		<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'right-column-widget-area' ) ) : ?>
	
			<li id="search" class="widget-container widget_search">
				<?php get_search_form(); ?>
			</li>

			<li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 'county_ext' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>

		<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #primary .widget-area -->
		
	</div><!-- #aside-widget-area-1 -->	

	<div class="sidebar-widget-navigation" role="complementary">
	<ul id="sidebar-navigation-widgets" class="xoxo">
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'sidebar-widget-navigation' ) ) : ?>


		<?php endif; // end aside widget area ?>
			</ul>
		</div><!-- #sidebar-navigation-widgets -->

<?php get_sidebar( 'widgets' ); ?>		
</div><!-- #aside -->	