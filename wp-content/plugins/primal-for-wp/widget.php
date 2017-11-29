<?php

	/** Adds Primal widget. */
	class Primal_Widget extends WP_Widget {
		/** Register widget with WordPress. */
		function __construct() {
			global $config;
			parent::__construct(
				'primal_widget', // Base ID
				__($config["plugin_name"], 'text_domain'), // Name
				array( 'description' => __($config["plugin_descr"], 'text_domain'),) // Args
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args		 Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance) {
			echo $args["before_widget"];

			$embed_url = build_embed_url($instance['color']);
			$iframe_id = get_iframe_id();

			if(get_option('primal_external_links')) show_primal_content($embed_url, $iframe_id);
			else external_links_error();

			echo $args["after_widget"];
		}

		/**
		 * Back-end widget form.
		 * Used for creating widget-local options
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form($instance) {
			global $config;

			
			$color = !empty($instance['color']) ? $instance['color']: __('red', 'text_domain');
			
			//Highlight color option
			?>
			<p>
				<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Highlight Color:'); ?></label>
				<input class="widefat" id="<?php	echo $this->get_field_id('color'); ?>"
					name="<?php echo $this->get_field_name('color'); ?>" type="text" value="<?php echo esc_attr($color); ?>">
			</p>

			<!-- Warns users if they have not enabled external links -->
			<?php if(!get_option('primal_external_links')): ?>
				<div>
					<p class="notice notice-error">
						Warning: The Primal plugin relies on providing external links.
						Enable external links in the <a href= <?php echo get_primal_settings_url() ?>>Primal Settings page</a>.
					</p>
				</div></br>
			<?php endif;
		}

		/**
		 * Updates widget instance with new setting values
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update($new_instance, $old_instance) {
			global $config;
			
			$instance = array();
			$instance['color'] = (!empty($new_instance['color'])) ? strip_tags($new_instance['color']) : '';

			return $instance;
		}
	} // class Primal_Widget
?>
