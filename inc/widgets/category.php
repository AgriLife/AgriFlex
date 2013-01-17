<?php
/**
 * Adds Category Widget widget.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0+
 */
class Category_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
	 		'category_widget', // Base ID
			'Category Widget', // Name
      array(
        'description' => __( 'Displays posts from a given category',
          'text_domain' ), ) // Args
		);

	} // construct

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
   * @return void
	 */
	public function widget( $args, $instance ) {

		extract( $args );
		$category = apply_filters( 'widget_category', $instance['category'] );
    $limit = apply_filters( 'widget_category', $instance['limit'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $category . $after_title;
			
		$this->cat_loop($category, $limit);
		
		echo $after_widget;

	} // widget

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
    $instance['limit'] = strip_tags( $new_instance['limit'] );

		return $instance;

	} // update

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
   * @return void
	 */
	public function form( $instance ) {

		if ( isset( $instance[ 'category' ] ) ) {
			$category = $instance[ 'category' ];			
		} else {
			$category = __( 'Enter Category', 'text_domain' );
    }
    
    if ( isset( $instance[ 'limit' ] ) ) {
      $limit = $instance[ 'limit' ];
    } else {
      $limit = 3;
    }
    ?> 

		<p>
      <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:' ); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" />		
		</p>
		<p>
      <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of Posts:' ); ?></label> 
      <select id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>">
      <?php
        // Set the upper post limit
        $num = 5;

        // Create a <option> for each number up to the post limit
        for ( $i = 1; $i <= $num; $i++ ) {
          echo '<option value="' . $i . '" id="' . $i . '"', $limit == $i ? ' selected="selected"' : '', '>', $i, '</option>';
        } ?>
      </select>
		</p>
		<?php 

	} // form

  /**
   * Category Loop function
   *
   * @since AgriFlex 2.0
   * @param string $category The requested post category
   * @param int    $limit    The number of posts requested
   * @return string|bool     Category loop
   */
  function cat_loop( $category, $limit ) {

    // Slugify the category, just in case.
    $category = sanitize_title( $category );

    $cat_query = new WP_Query( 
      array(
        'posts_per_page' => $limit,
        'category_name'  => $category,
      )
    );
    while ( $cat_query->have_posts() ) : $cat_query->the_post();
    ?>				
      <h2 class="mb-post-title cat-post-title">
        <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
      </h2>
      <a href="<?php the_permalink();?>">
      <?php
        if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'featured-mediabox' ); 
        } else  { 
          echo '<img src="' . get_bloginfo( 'template_url') . '/images/AgriLife-default-post-image.png?v=100" alt="AgriLife Logo" class="attachment-featured-mediabox wp-post-image .wp-post-image" title="AgriLife" />'; 
        }	?>
      </a>
<?php
      the_excerpt();
    endwhile;
    
    wp_reset_query();

    return true;

  } // cat_loop

} // class Category_Widget
