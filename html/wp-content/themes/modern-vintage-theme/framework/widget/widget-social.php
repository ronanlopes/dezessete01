<?php
	class Indieground_wSocial extends WP_Widget {

		function __construct() {
			$widget_ops = array('classname' => 'indieground_widget_social clearfix', 'description' => __( 'Displays Social Icons in navigation bar!', 'indieground') );
			parent::__construct('lw_social', __('Modern Vintage Social', 'indieground'), $widget_ops);
			$this->alt_option_name = 'indieground_widget_social';
		}

		// Creating widget front-end
		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );


			echo "<div class='cont_widget wow fadeInDown'><div class='tit_widget'>";
			if (!empty($title)) {
				echo $title."<br>";
			}

						echo "</div>";

						echo "<div class='box_widget'>";
						echo "<div class='box_widget_social'>";

			// This is where you run the code and display the output
			echo indiegroundshortcode_social();
			echo "</div>";
			echo "</div>";

	          echo "<div class='tit_widget_bottom'></div>";
			echo "</div>";

		}

		// Widget Backend
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else {
				$title = __( 'New title', 'indieground' );
			}

			// Widget admin form
			?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'indieground'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<?php
		}


		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}
} // Class wpb_widget ends here



?>