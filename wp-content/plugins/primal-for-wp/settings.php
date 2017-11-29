<?php

	require 'config.php';

	add_action('admin_menu', 'primal_plugin_create_menu');

	/** Creates the menu on the WordPress Admin dashboard */
	function primal_plugin_create_menu(){
		global $config;
		add_submenu_page($config["top_settings_menu"], 'Primal Settings', 'Primal', 'administrator', $config["settings_page"],
		 'primal_plugin_settings_page');
		add_action('admin_init', 'register_primal_plugin_settings');
	}

	/** Register any settings for easier database access */
	function register_primal_plugin_settings(){
		global $config;
		register_setting('primal-plugin-settings-group', 'primal_external_links');
		register_setting('primal-plugin-settings-group', 'primal_auto_insert_display');
		register_setting('primal-plugin-settings-group', 'primal_auto_insert_color');
	}

	/** Prints the global settings page for the plugin and saves the setting values */
	function primal_plugin_settings_page(){ 
		global $config;
		?>
		<!-- Settings page form -->
		<div class="wrap">
			<h2>Primal Settings</h2></br>
			<form method="post" action="options.php">
				<?php settings_fields('primal-plugin-settings-group'); ?>
				<?php do_settings_sections('primal-plugin-settings-group'); ?>
				<p>Check this option to allow external links. The plugin will not work if this option is disabled.</p>
				<input type="checkbox" name="primal_external_links" value="1" <?php checked(get_option("primal_external_links"), 1);?>> Enable external links

				<!-- Print a warning message if external links are disabled -->
				<?php if(!get_option("primal_external_links")): ?>
					</br></br>
					<div>
						<p class="notice notice-error">
							The Primal plugin relies on providing external links.
							Check the above option to use the plugin.
						</p>
					</div>
				<?php endif;?>
				</br></br>
				<h4>The following options relate to displaying content without using widgets </h4>
				<input type="checkbox" name="primal_auto_insert_display" value="1" <?php checked(get_option("primal_auto_insert_display"), 1);?>>
				Automatically add after each post </br></br>

				<?php $color = !get_option('primal_auto_insert_color') ? 'red' : get_option('primal_auto_insert_color'); ?>
				Highlight color: </br>
				<input type="text" name="primal_auto_insert_color" value=<?php echo $color;?>>

				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	} ?>
