<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
?>
<div id="aside">
	<?php do_action('posts_logout_link','Logout','logout_btn'); ?>
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