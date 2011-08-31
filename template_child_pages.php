<?php
/**
 * @package WordPress
 * @subpackage Agrilife_Theme
 */
 /*
Template Name: Child Page List
*/
get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">

<?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    
                    <?php if ( !is_front_page() ) : ?>
				  	  <h2><?php the_title(); ?></h2>
				    <?php endif; ?>
						<ul>
				    		<?php wp_list_pages('sort_column=menu_order&title_li=&child_of='.$post->ID); ?>
						</ul>
                   
                    <div class="storycontent">
	                	<?php the_content(); ?>
	               	</div><!-- /.storycontent -->	           

                </div><!-- /.post -->
                
                <?php if ('open' == $post->comment_status) : ?>
	                <?php comments_template(); ?>
				<?php endif; ?>
                                                    
			<?php endwhile; else: ?>
				<div class="post">
                	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
			</div><!-- #content -->
		</div><!-- #wrap -->
	<?php get_sidebar(); ?>	
<?php get_footer(); ?>
