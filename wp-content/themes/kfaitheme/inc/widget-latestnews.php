<?php
class func_widgetnews extends WP_Widget {

function __construct() {

	parent::__construct(

	// Base ID of your widget
	'func_widgetnews',

	// Widget name will appear in UI
	__('@KFAI Latest News', 'theme_widget_domain'),

	// Widget description
	array( 'description' => __( 'Custom list of latest news.', 'theme_widget_domain' ), )
	);
	}


	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
		}
		else {
		$title = __( '', 'wpb_widget_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {

	$title = apply_filters( 'widget_title', $instance['title'] );

	
			// before and after widget arguments are defined by themes
			echo $args['before_widget'];

			echo $count_key;
			$widget_id = "widget_" . $args["widget_id"];
			
			if($title){
				echo $args['before_title'] . $title . $args['after_title'];
			}
		
		
			$argsw = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' =>  "DESC",
				'orderby' => 'date',
				'posts_per_page' => 2,
			);
		
			$wp_queryw = new WP_Query( $argsw );

			if( $wp_queryw->have_posts()):
				echo '<div class="recent-news clearfix">';
				while($wp_queryw->have_posts()):$wp_queryw->the_post();  ?>
					<div class="gateway-block blog-post">
						<div class="block-content">
							<div class="block-image">
								<?php 
					    		if(has_post_thumbnail()): 
						    		$thumbid = get_post_thumbnail_id();
									$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-420');  ?>
									<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo $imgurl[0]; ?>);"><img src="<?php echo $imgurl[0]; ?>" alt="<?php echo get_the_title(); ?>" /></a>
									<?php
								endif; ?>
							</div>
							<div class="block-details">
								<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
								<p class="date">March 11, 2018</p>
								<p><?php echo get_content_limit(get_the_excerpt(), 300, "<a href='".get_permalink()."'>...continue reading »</a>"); ?></p>
							</div>
						</div>
					</div>
					<?php 
				endwhile;
				echo '</div>';
				wp_reset_query();
			endif;

			echo $args['after_widget'];
	
	
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

 

