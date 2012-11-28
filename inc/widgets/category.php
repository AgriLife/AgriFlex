<?php

/**
 * Adds Category Widget widget.
 */
class Category_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
	 		'category_widget', // Base ID
			'Category Widget', // Name
			array( 'description' => __( 'Displays posts from a given category', 'text_domain' ), ) // Args
		);

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		extract( $args );
		$category = apply_filters( 'widget_category', $instance['category'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $category . $after_title; ?>
			
		<?php $this->cat_loop($category) ?>	
		
		<?php echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['category'] = strip_tags( $new_instance['category'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		if ( isset( $instance[ 'category' ] ) ) {
			$category = $instance[ 'category' ];			
		} else {
			$category = __( 'Enter Category', 'text_domain' );
		} 	?> 
		<p>
      <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:' ); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" />		
		</p>
		<?php 

	}

  /**
   * Category Loop function
   *
   * @return string|bool Category loop
   */
  function cat_loop( $catClass ) {

    global $post;
    $cat_query = new WP_Query( 
    array(
      'posts_per_page' => 1
          )
    );
      while ($cat_query->have_posts()) : $cat_query->the_post();
      ?>				
        <h2 class="mb-post-title cat-post-title">
          <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
        </h2>
        <a href="<?php the_permalink();?>">
        <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail('featured-mediabox'); 
          } else  { 
            echo '<img src="'.get_bloginfo("template_url").'/images/AgriLife-default-post-image.png?v=100" alt="AgriLife Logo" class="attachment-featured-mediabox wp-post-image .wp-post-image" title="AgriLife" />'; 
          }	?>
        </a>
        <?php the_excerpt(); ?>
      <?php endwhile;  wp_reset_query();
    return true;

  }

}
