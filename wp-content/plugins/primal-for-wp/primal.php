<?php
	/*
  Plugin Name: Primal for WordPress
  Plugin URI: http://primal.com
	Description: This plugin displays news and info from the web related to each post on your WordPress site.
	Author: Primal
	Author URI: www.primal.com
	Version: 2.0.5
	*/

	require 'config.php';
	require 'utils.php';
	require 'settings.php';
	require_once 'widget.php';

	/**
	 * Handles displaying the plugin content without a widget
	 * @param  $content The page content
	 */
	function primal_auto_insert($content) {
	    global $config;
	    
		if(is_single() && get_option('primal_auto_insert_display')) {
			$color = get_option('primal_auto_insert_color');
			
			$embed_url = build_embed_url($color);
			$iframe_id = get_iframe_id();
			echo $content;

			if(get_option('primal_external_links')) show_primal_content($embed_url, $iframe_id);
			else external_links_error();
		}
		else return $content;
	}

	/** Registers our widget with WordPress*/
	function register_primal_widget() {
	    register_widget('primal_widget');
	}

	/** Adds jQuery and our own scripts to the plugin */
	function add_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('resize', plugins_url('js/resize.js', __FILE__));
		wp_enqueue_script('crossDomainMessaging', get_media_server_url() . '/~/js/crossDomainMessaging.js');
		wp_enqueue_style('primal_style', plugins_url('css/style.css', __FILE__));
	}

	/** Retrieves and compares current and previously stored version numbers */
	function check_and_set_plugin_version() {
		$headerArr = get_plugin_data(plugins_url('primal.php', __FILE__));
		$cur_version = $headerArr['Version'];

		if(!get_option('primal_plugin_version'))
			update_option('primal_plugin_version', $cur_version);
		else {
			$stored_version = get_option('primal_plugin_version');
			update_option('primal_plugin_version', $cur_version);
			if(version_compare($cur_version, $stored_version) > 0) add_update_notice($cur_version);
		}
	}

	/** Provides a message to the user if they updated the plugin */
	function add_update_notice($version) {
		global $config;
		?><div class="notice notice-success is-dismissible">
			<p> You have updated <strong><?php echo $config['plugin_name'] ?></strong>
				to version <?php echo $version ?>. See
				<a href="<?php echo plugins_url('changelog/', __FILE__); ?>" target="_blank">what's new</a>.
			</p>
		</div><?php
	}

	add_action('admin_notices', 'check_and_set_plugin_version');
	add_action('widgets_init', 'register_primal_widget');
	add_action('wp_enqueue_scripts', 'add_scripts');
	add_filter('the_content', 'primal_auto_insert');
?>
