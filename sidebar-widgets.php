<?php
/**
 * The aside widget area.
 *
 * @package WordPress
 * @subpackage county_ext
 * @since county_ext 1.0
 */
?>


<div id="aside-widget-area-2">
	<div id="secondary" class="widget-area" role="complementary">
		<ul class="xoxo">
	<?php
		/* When we call the dynamic_sidebar() function, it'll spit out
		 * the widgets for that widget area. If it instead returns false,
		 * then the sidebar simply doesn't exist, so we'll hard-code in
		 * some default sidebar stuff just in case.
		 */
		if ( ! dynamic_sidebar( 'right-column-bottom-widget-area' ) ) : ?>

				<li id="archives" class="widget-container">
					<h3 class="widget-title"><?php _e( 'Archives', 'county_ext' ); ?></h3>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
				</li>

				<li id="archives" class="widget-container">
					<h3 class="widget-title"><?php _e( 'Recent Posts', 'county_ext' ); ?></h3>
					<ul>
						<?php wp_get_archives( 'type=postbypost' ); ?>
					</ul>
				</li>

			<?php endif; // end aside widget area ?>
				</ul>
			</div><!-- #secondary .widget-area -->

</div><!-- #aside-widget-area -->
