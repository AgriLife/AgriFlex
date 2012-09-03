<?php
/**
 * The Template for displaying all staff single posts.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */

get_header(); ?>

		<div id="wrap">
			<div id="content" role="main">
			<p><span class="read-more"><a href="../">&larr; All Employees</a><span></p>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
					<section class="entry-content">
						<?php if ( has_post_thumbnail() ) {
  							the_post_thumbnail('staff_single'); 
						} else  { 
							echo '<img src="'.get_bloginfo("template_url").'/images/AgriLife-default-staff-image-single.png?v=100" class="alignleft" alt="AgriLife staff image default" title="AgriLife" />'; 
						}
						?>
						<?php $my_meta = get_post_meta($post->ID,'_my_meta',TRUE); ?>
						<div class="staff-person-details">
							<dl>	
							<dt><?php echo $my_meta['firstname'].' '.$my_meta['lastname']; ?></dt>
							
							<?php if ($my_meta['position']) { ?> 
								<dd class="role"><?php echo $my_meta['position'];?></dd>
							<?php } ?>
							
							<?php if ($my_meta['room']) { ?> 
								<dd><?php echo $my_meta['room'];?></dd> 
							<?php } ?>	
							
							<?php if ($my_meta['email']) { ?>							
								<dd class="email"><a href="mailto:<?php echo $my_meta['email'];?>"><?php echo $my_meta['email'];?></a></dd>
							<?php } ?>
							
							<?php if ($my_meta['phone']) { ?>
								<dd><?php echo $my_meta['phone'];?></dd> 
							<?php } ?> 
								
							<?php if ($my_meta['website']) { ?>
								<dd class="website"><a href="<?php echo $my_meta['website'];?>"><?php echo $my_meta['website'];?></a></dd> 
							<?php } ?>							
							
							<?php if ($my_meta['undergraduate_1']) { ?>						
							<dt>Undergraduate Education</dt>
							<?php } ?> 
							
							<?php if ($my_meta['undergraduate_1']) { ?>
								<dd><?php echo $my_meta['undergraduate_1']; ?></dd>
							<?php } ?> 
								
							<?php if ($my_meta['undergraduate_2']) { ?>	
								<dd><?php echo $my_meta['undergraduate_2'];?></dd>
							<?php } ?> 
							
							<?php if ($my_meta['graduate_1']) { ?>						
							<dt>Graduate Education</dt>
							<?php } ?> 							
								
							<?php if ($my_meta['graduate_1']) { ?>							
								<dd><?php echo $my_meta['graduate_1'];?></dd>
							<?php } ?> 
								
							<?php if ($my_meta['graduate_2']) { ?>	 						
								<dd><?php echo $my_meta['graduate_2']; ?></dd>								
							<?php } ?> 	
							
							<?php if ($my_meta['graduate_3']) { ?>							
								<dd><?php echo $my_meta['graduate_3'];?></dd>
							<?php } ?> 
							
							<?php if ($my_meta['specialty']) { ?>						
							<dt>Specialty</dt>
							<?php } ?> 							
								
							<?php if ($my_meta['specialty']) { ?>							
								<dd><?php echo $my_meta['specialty'];?></dd>
							<?php } ?> 
							
							<?php if ($my_meta['research']) { ?>							
								<dd><?php echo $my_meta['research'];?></dd>
							<?php } ?>
							 
							<?php if ($my_meta['award_1']) { ?>						
							<dt>Awards</dt>
							<?php } ?> 							
								
							<?php if ($my_meta['award_1']) { ?>							
								<dd><?php echo $my_meta['award_1'];?></dd>
							<?php } ?> 
								
							<?php if ($my_meta['award_2']) { ?>	 						
								<dd><?php echo $my_meta['award_2']; ?></dd>								
							<?php } ?> 	
							
							<?php if ($my_meta['award_3']) { ?>							
								<dd><?php echo $my_meta['award_3'];?></dd>
							<?php } ?> 
							 
							<?php if ($my_meta['course_1']) { ?>						
							<dt>Courses Taught</dt>
							<?php } ?> 							
								
							<?php if ($my_meta['course_1']) { ?>							
								<dd><?php echo $my_meta['course_1'];?></dd>
							<?php } ?> 
								
							<?php if ($my_meta['course_2']) { ?>	 						
								<dd><?php echo $my_meta['course_2']; ?></dd>								
							<?php } ?> 	
							
							<?php if ($my_meta['course_3']) { ?>							
								<dd><?php echo $my_meta['course_3'];?></dd>
							<?php } ?> 	

							<?php if ($my_meta['course_4']) { ?>	 						
								<dd><?php echo $my_meta['course_4']; ?></dd>								
							<?php } ?> 	
							
							<?php if ($my_meta['course_5']) { ?>							
								<dd><?php echo $my_meta['course_5'];?></dd>
							<?php } ?>							
																				
							</dl>	
								
						</div>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'agriflex' ), 'after' => '</div>' ) ); ?>
					</section><!-- .entry-content -->

	
					<footer class="entry-meta">

						<section class="entry-utility">
							<?php agriflex_posted_in(); ?>
							<?php edit_post_link( __( 'Edit', 'agriflex' ), '<span class="edit-link">', '</span>' ); ?>
						</section><!-- .entry-utility -->
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
