<?php
/**
 * The Template for displaying all staff single posts.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */


function county_office_info() { 
	GLOBAL $options;
	if (is_array($options)) {
	    echo '<div class="vcard">';				
	    
	    echo '<p><a class="url fn org" href="'.get_bloginfo('home').'">'.$options['county-name-human'].' County Extension Office</a></p>';
	
	    if($options['phone']<>'') {
		    echo '<p class="tel">';
		    echo '<span class="type">Office</span>: ';
				echo '<span class="value">'.$options['phone'].'</span>';
				echo '</p>';
			}
			if($options['fax']<>'') {
		    echo '<p class="tel">';
		    echo '<span class="type">Fax</span>: ';
				echo '<span class="value">'.$options['fax'].'</span>';
				echo '</p>';
			}

			echo "<div class=\"adr\">";
			echo "<p class=\"street-address\">".$options['address-street1'].'<br />';
			if($options['address-street2']<>'')
			echo '<span class="extended-address">'.$options['address-street2'].'</span><br />';
		echo '<span class="locality">'.$options['address-city'].'</span>, ';
		echo '<span class="region">TX</span> <span class="postal-code">'.$options['address-zip'].'</span>';
		echo '<span class="country-name"> U.S.A.</span></p>';
		echo '</div>';
		if($options['address-mail-street1']<>'') {
			echo "<div class=\"adr\">";
				echo "<p class=\"street-address\">".$options['address-mail-street1']."<br />";
				if($options['address-mail-street2']<>'')
				echo '<span class="extended-address">'.$options['address-mail-street2'].'</span>';
			echo '<span class="locality">'.$options['address-mail-city'].'</span>, ';
			echo '<span class="region">TX</span> <span class="postal-mail-code">'.$options['address-mail-zip'].'</span>';
			echo '<span class="country-name"> U.S.A.</span></p>';
			echo '</div>';						
		}						
		echo '</div> <!-- .vcard -->';
	}
}

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
			// For County Extension Offices
			// This pulls from a managed staff database web service	
			
			if (($options['extension_type'] == 2 || $options['extension_type'] == 3) && $isextensiononly) :
				county_office_info(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>				
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
		
		<?php else:
			// Everyone else gets info from 'Staff' custom post type
			
			get_template_part( 'content', 'staff' ); ?>
			<nav id="nav-below" class="navigation">
				<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'agriflex' ) . '</span> %title' ); ?></div>
				<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'agriflex' ) . '</span>' ); ?></div>
			</nav><!-- #nav-below -->
			<?php comments_template( '', true ); ?>
		
		<?php endif;

endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>