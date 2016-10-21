<?php
	class Indieground_wInstagram extends WP_Widget {

		function __construct() {
			$widget_ops = array('classname' => 'indieground_widget_instagram clearfix', 'description' => __( 'Displays Instagram Feed!', 'indieground') );
			parent::__construct('lw_instagram', __('Indieground Instagram Widget', 'indieground'), $widget_ops);
			$this->alt_option_name = 'indieground_widget_instagram';
		}

		// Creating widget front-end
		public function widget( $args, $instance ) {
			global $indieground_options;

			extract($args);

			$title = apply_filters( 'widget_title', $instance['title'] );

			extract($args);

			$title = apply_filters('widget_title', $instance['title']);

			echo $before_widget;
			echo $before_title . $title . $after_title;

			echo "<div class='widget'>\n";

			if ($indieground_options["indieground-instagram"][1]!="" && $indieground_options["indieground-instagram"][2]!="") {
				echo "<div id='instafeed'></div>\n";
				echo "	<script type='text/javascript'>\n";
				echo "		var feed = new Instafeed({\n";
				echo "			get: 'user',\n";
				echo "			userId: ".$indieground_options["indieground-instagram"][1].",\n";
				echo "			accessToken: '".$indieground_options["indieground-instagram"][2]."',\n";
				echo "			link: 'true',\n";
				echo "			clientId: '".$indieground_options["indieground-instagram"][1]."',\n";
				echo "			limit: '".$indieground_options["indieground-instagram"][3]."'\n";
				echo "		});\n";
				echo "		feed.run();\n";
				echo "	</script>\n";
			} else {
				echo "First complete the instagram's fields in the panel option (Social Key Tab)";
			}

			echo "</div>\n";

			echo $after_widget;
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
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'indieground'); ?></label>
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