<?php

/**
 * This file holds the configuration settings for the Primal Wordpress plugin
 */

	require_once 'primal.php';
	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	$plugin_data = get_plugin_data(plugin_dir_path(__FILE__) . 'primal.php', false);

	$config = array(
		//Temporary. Both name and description require official marcom
		"plugin_name" => 'Primal for WordPress',
		"plugin_descr" => 'Related posts based on your content',

		// Set to either "dev", "qa", "continuous", "prod" for the plugin to access the respective environments
		"env" => "prod",

		// Array which uses env to select option
		"env_urls" => array(
			"qa" => "https://qa-app.primal.com",
			"continuous" => "https://continuous-app.primal.com",
			"dev" => "http://tmedia.primal.com:9000",
			"prod" => "https://app.primal.com"
		),
		
		// Sets a site restriction
		"site_restriction" => "",

		// Array which holds any selected embed options
		"embed_opts" => array(
			"cardStyle" => "tile",
			"showControls" => false,
			"simpleLoader" => true,
			"_track" => array(
				"appName" => "Wordpress Embed",
				"appVersion" => $plugin_data["Version"]
			)
		),

		"max_docs" => 3,

		//Determines the top-level menu Primal's settings page is listed under
		"top_settings_menu" => "options-general.php",
		//Determines the slug of the Primal settings page
		"settings_page" => "primal_settings",
	);
?>
