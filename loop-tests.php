<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * Used in archive.php
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
?>

<?php 
// Build a new query with tests based on GET variables

/*
global $wp_query, $wpdb;

echo "<pre>";
print_r($wp_query);
echo "</pre>";
*/
$myquery['post_type'] = "tests";
if('' <> $_GET['lab_section'] ) {
	$myquery['tax_query'][0] = array(
		'taxonomy' => 'lab_sections',
		'terms' => array($_GET['lab_section']),
		'field' => 'slug'
	);
}
if('' <> $_GET['species'] ) {
	$myquery['tax_query'][1] = array(
			'taxonomy' => 'species',
			'terms' => array($_GET['species']),
			'field' => 'slug'	
		);
} /*elseif ( '' <> $wp_query->get('species')) {
	$myquery['tax_query'][1] = array(
			'taxonomy' => 'species',
			'terms' => array($wp_query->get('species')),
			'field' => 'slug'	
		);
}*/

if('' <> $_GET['searchtests'] ) {
	$myquery['s'] = strtolower($_GET['searchtests']);
	// $wp_query->set('s',strtolower($_GET['searchtests']));
}


$filtered_search = new WP_Query($myquery);

/*
if ( ! $filtered_search -> have_posts() ) {
	// If there are no search results:
	// Also look for search term that matches taxonomy terms
	$myquery['s'] = '';
	$myquery['tax_query']['relation'] = 'OR';
	$myquery['tax_query'][3] = array(
			'taxonomy' => 'species',
			'terms' => array(strtolower($_GET['searchtests'])),
			'field' => 'slug'	
		);
	$myquery['tax_query'][4] = array(
			'taxonomy' => 'lab_sections',
			'terms' => array(strtolower($_GET['searchtests'])),
			'field' => 'slug'	
		);
	// Run Query Again
	$filtered_search = new WP_Query($myquery);
}

echo "<pre>";
print_r($myquery);
echo "</pre>";
*/
?>

<?php /* If there are no tests to display, let the user know */ ?>
<?php if ( ! $filtered_search -> have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'agriflex' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no tests were found that match your search criteria.', 'agriflex' ); ?></p>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php tvmdl_test_search($_GET['species'],$_GET['lab_section'],$_GET['searchtests']); ?>

<dl class="job-listing-ul">
	<?php while ( $filtered_search->have_posts() ) : $filtered_search->the_post(); ?>
		<?php $my_meta = get_post_meta($post->ID,'_my_meta',TRUE); ?>	
		<a href="<?php echo $my_meta['link']; ?>" class="test-listing-link" title="<?php printf( esc_attr__( 'Permalink to %s test', 'agriflex' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<dt id="post-<?php the_ID(); ?>" class="test-listing-dt">
			<h2 class="test-title" title="<?php the_title(); ?>"><?php the_title(); ?></h2>
		</dt>
		<dd class="test-listing-dd">
			<?php ucc_get_terms_list(); ?>				
		</dd>
		</a>
	<?php endwhile; ?>
</dl>
