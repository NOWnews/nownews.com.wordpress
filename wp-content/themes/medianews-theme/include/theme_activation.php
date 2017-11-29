<?php
	// Install data on theme activation
	if ( ! function_exists( 'px_activation_data' ) ) {
		function px_activation_data() {
		global $wpdb;
		$args = array(
		'style_sheet' => 'custom',
		'custom_color_scheme' => '#d23733',
		//'header_bg_color' => '#FFFFFF',
		'footer_bg_color' => '#efefef',
		'nav_bg_color' => '#292A32',
		'nav_color' => '#959595',
		'header_languages' => '',
		'header_cart' => '',
		'header_search' => 'on',
		'header_breadcrumbs' => 'on',
		'layout_option' => 'wrapper_boxed',
		'bg_img' => '2',
		'bg_img_custom' => '',
		'bg_position' => 'center',
		'bg_repeat' => 'no-repeat',
		'bg_attach' => 'fixed',
		'pattern_img' => '0',
		'custome_pattern' => '',
		'bg_color' => '#e95842',
		
		// home page announcements
		'announcement_title' => '',
		'announcement_blog_category' => '',
		'announcement_no_posts' => '',
		// end home page announcements
		// Home page slider
		'slider_blog_category' => '',
		'slider_no_posts' =>'',
		'slider_type' =>'post_slider',
		'slider_name' =>'',
		'slider_id' =>'',
		
		'logo' => get_template_directory_uri().'/images/logo.png',
		'logo_width' => '286',
		'logo_height' => '44',
		
		'fav_icon' => get_template_directory_uri() . '/images/favicon.ico',
		'advertisement_banner' => get_template_directory_uri() . '/images/head-add.png',
		'advertisement_banner_url' => '#',
		'header_code' => '',
		 'analytics' => '',
		 'responsive' => 'on',
		 'style_rtl' => '',
		 'rtl_switcher' => '',
		 'top_strip_switcher' => 'on',
		 // fotter setting 
		 'header_social_icons' => 'on',	
		 'twitter_name' => '',
		 'tweets_number' =>'',	
		 'trans_switcher' => '',
		 'sidebar' => array( 'sidebar-1','sidebar-home','sidebar-home2','sidebar-home3','sidebar-home4','sidebar-home5','sidebar-home6','small-sidebar','contact-sidebar'),
		 'social_share' => 'on',
		 // Advertisement Banner
		 'banner_title_input' => array( 'Header Banner', 'Footer Banner', 'Sidebar Banner', 'Vertical Banner', 'PX Blog Bnr' ),
		 'banner_type_input' => array( 'top_banner', 'bottom_banner', 'sidebar_banner', 'vertical_banner', 'sidebar_banner'),
		 'banner_image_url' => array( get_template_directory_uri() . '/images/px-image1.png', get_template_directory_uri() . '/images/px-image2.png', get_template_directory_uri() . '/images/px-image3.jpg', get_template_directory_uri() . '/images/px-image4.jpg', get_template_directory_uri() . '/images/px-blog-bnr.jpg'),
		 'banner_url_input' => array( '#', '#', '#', '#', '#'),
		 'adsense_input' => array( '', '', '', '', ''),
		 
		 // Social Share
		'social_net_icon_path' => array( '', '', '', '', '', '', '', '', '' ),
		'social_net_awesome' => array( 'fa-facebook-square', 'fa-google-plus-square', 'fa-linkedin-square', 'fa-pinterest-square', 'fa-twitter-square', 'fa-tumblr-square', 'fa-instagram', 'fa-flickr' ),'social_net_url' => array( 'Facebook URL', '#', '#', '#', '#', '#', '#', '#' ),'social_net_tooltip' => array( 'Facebook', 'Google-plus', 'Linked-in', 'Pinterest', 'Twitter', 'Tumblr', 'Instagram', 'Flickr' ),'facebook_share' => 'on','twitter_share' => 'on','linkedin_share' => 'on','pinterest_share' => 'on','tumblr_share' => 'on','google_plus_share' => 'on','px_other_share' => 'on',
		'trans_from' => 'From the',
		'trans_viewall' => 'View All',
		'trans_currentpage' => 'Current Page',
		'trans_photo' => 'Photos',
		'trans_previous' => 'Previous',
		'trans_headlines' => 'Headlines',
		'trans_recent' => 'Recent Posts',
		'trans_popular' => 'Popular Posts',
		'trans_user_rating' => 'User Rating',
		'trans_out_of' => 'Out of',
		'trans_firstname' => 'First Name','trans_subject' => 'Subject','trans_subject' => 'Subject','trans_message' => 'Message', 'trans_share_this_post' => 'Share Now','trans_featured' => 'Featured','trans_listed_in' => 'in','trans_posted_on' => 'Posted on','trans_read_more' => 'read more','trans_other_phone' => 'Phone:','trans_other_fax' => 'Fax:','trans_special_request' => 'Special Request','trans_email_published' => '*Your Email will never published.',
		'pagination' => 'Show Pagination',
		'default_excerpt_length' => '255',
		'record_per_page' => '5',
		'px_layout' => 'none',
		'px_sidebar_left' => '',
		'px_sidebar_right' => '',
		'showlogo' => 'on',
		'socialnetwork' => 'on',
		'launch_date' => '2015-10-24',
		'copyright' =>  '&copy;'.gmdate("Y")." ".get_option("blogname")." Wordpress All rights reserved.", 
		'powered_by' => '<a href="#">Design by Pixfill</a>',
		'mailchimp_key' => '90f86a57314446ddbe87c57acc930ce8-us2',
		'consumer_key' => 'BUVzW5ThLW8Nbmk9rSFag',
		'consumer_secret' => 'J8LDM3SOSNuP2JrESm8ZE82dv9NtZzer091ZjlWI',
		'access_token' => '1584785251-sTO1qbjZFwicbIe04fIByGifvfKIeewfOpSVsJq',
		'access_token_secret' => 'FpHZH50brTiiztx0G0LNp37c1rUjjwQ4rNHbEWjABw',
		// review settings
			'review_criteria_1_1' => '1',
			'review_criteria_1_2' => '40',
			//review_criteria_text_color_
			'review_criteria_text_color_1' => '#b70d0d',
			'review_criteria_text_1' => 'Bad',
				'review_criteria_2_1' => '41',
				'review_criteria_2_2' => '60',
				'review_criteria_text_color_2' => '#479906',
				'review_criteria_text_2' => 'Not Bad',
			'review_criteria_3_1' => '61',
			'review_criteria_3_2' => '70',
			'review_criteria_text_color_3' => '#961892',
			'review_criteria_text_3' => 'Average',
				'review_criteria_4_1' => '71',
				'review_criteria_4_2' => '99',
				'review_criteria_text_color_4' => '#1c92d8',
				'review_criteria_text_4' => 'Good',
			'review_criteria_5_1' => '100',
			'review_criteria_5_2' => '100',
			'review_criteria_text_color_5' => '#084718',
			'review_criteria_text_5' => 'Very Good',
				'review_criteria_6_1' => '',
				'review_criteria_6_2' => '',
				'review_criteria_text_color_6' => '',
				'review_criteria_text_6' => '',
			'review_criteria_7_1' => '',
			'review_criteria_7_2' => '',
			'review_criteria_text_color_7' => '',
			'review_criteria_text_7' => '',
				'review_criteria_8_1' => '',
				'review_criteria_8_2' => '',
				'review_criteria_text_color_8' => '',
				'review_criteria_text_8' => '',
			'review_criteria_9_1' => '',
			'review_criteria_9_2' => '',
			'review_criteria_text_color_9' => '',
			'review_criteria_text_9' => '',
				'review_criteria_10_1' => '',
				'review_criteria_10_2' => '',
				'review_criteria_text_color_10' => '',
				'review_criteria_text_10' => '',
		
	);
		/* Merge Heaser styles	*/
		update_option("px_theme_option", $args );
		update_option("px_theme_option_restore", $args );
 	}
	}
	if ( ! function_exists( 'px_activate_widget' ) ) {
		function px_activate_widget(){
		
		$sidebars_widgets = get_option('sidebars_widgets');  //collect widget informations
		
		// ---- Archive widget setting---

		$archives = array();

		$archives[1] = array(

		"title"		=>	'Archives'

		);

						

		$archives['_multiwidget'] = '1';

		update_option('widget_archives',$archives);

		$archives = get_option('widget_archives');

		krsort($archives);

		foreach($archives as $key1=>$val1)

		{

			$archives_key = $key1;

			if(is_int($archives_key))

			{

				break;

			}

		}
		
		// ---- calendar widget setting---

		$calendar = array();

		$calendar[1] = array(

		"title"		=>	'Calendar'

		);

						

		$calendar['_multiwidget'] = '1';

		update_option('widget_calendar',$calendar);

		$calendar = get_option('widget_calendar');

		krsort($calendar);

		foreach($calendar as $key1=>$val1)

		{

			$calendar_key = $key1;

			if(is_int($calendar_key))

			{

				break;

			}

		}

		//---Blog Categories

		$categories = array();

		$categories[1] = array(

		"title"		=>	'Categories',

		"count" => 'checked'

		);

						

		$calendar['_multiwidget'] = '1';

		update_option('widget_categories',$categories);

		$categories = get_option('widget_categories');

		krsort($categories);

		foreach($categories as $key1=>$val1)

		{

			$categories_key = $key1;

			if(is_int($categories_key))

			{

				break;

			}

		}

	// Default Recent Comments
	
	// Default Recent Post
	
	
		
		$default_recent_comments_widget = array();

		$default_recent_comments_widget[1] = array(

		"title"		=>	'Recent Comments',
		"number" => '3',

		 );						

		$default_recent_comments_widget['_multiwidget'] = '1';

		update_option('widget_recent-comments',$default_recent_comments_widget);

		$default_recent_comments_widget = get_option('widget_recent-comments');

		krsort($default_recent_comments_widget);

		foreach($default_recent_comments_widget as $key1=>$val1)

		{

			$default_recent_comments_widget_key = $key1;

			if(is_int($default_recent_comments_widget_key))

			{

				break;

			}

		}
	
	
	// Default Recent Post
	
	
		
		$default_recent_post_widget = array();

		$default_recent_post_widget[1] = array(

		"title"		=>	'Latest Blogs',

		"select_category" 	=> 'boxing',

		"showcount" => '4',

		 );						

		$default_recent_post_widget['_multiwidget'] = '1';

		update_option('widget_recent-posts',$default_recent_post_widget);

		$default_recent_post_widget = get_option('widget_recent-posts');

		krsort($default_recent_post_widget);

		foreach($default_recent_post_widget as $key1=>$val1)

		{

			$default_recent_post_widget_key = $key1;

			if(is_int($default_recent_post_widget_key))

			{

				break;

			}

		}
	
	
	

		// ----   recent post with thumbnail widget setting---

		$recent_post_widget = array();

		$recent_post_widget[1] = array(

		"title"		=>	'Reviews',

		"select_category" 	=> 'reviews',

		"showcount" => '3',

		 );						

		$recent_post_widget['_multiwidget'] = '1';

		update_option('widget_recentposts',$recent_post_widget);

		$recent_post_widget = get_option('widget_recentposts');

		krsort($recent_post_widget);

		foreach($recent_post_widget as $key1=>$val1)

		{

			$recent_post_widget_key = $key1;

			if(is_int($recent_post_widget_key))

			{

				break;

			}

		}

		// ----   recent post without thumbnail widget setting---

		$recent_post_widget2 = array();

		$recent_post_widget2 = get_option('widget_recentposts');

		$recent_post_widget2[2] = array(

		"title"		=>	'Blog',

		"select_category" 	=> 'blog',

		"showcount" => '3',

		"thumb" => 'true'

		 );						

		$recent_post_widget2['_multiwidget'] = '1';

		update_option('widget_recentposts',$recent_post_widget2);

		$recent_post_widget2 = get_option('widget_recentposts');

		krsort($recent_post_widget2);

		foreach($recent_post_widget2 as $key1=>$val1)

		{

			$recent_post_widget_key2 = $key1;

			if(is_int($recent_post_widget_key2))

			{

				break;

			}

		}


		// --- gallery widget setting ---

		$px_gallery = array();

		$px_gallery[1] = array(

			'title' => 'Our Gallery',

			'get_names_gallery' => 'our-gallery',

			'showcount' => '20'

		);						

		$px_gallery['_multiwidget'] = '1';

		update_option('widget_px_gallery',$px_gallery);

		$px_gallery = get_option('widget_px_gallery');

		krsort($px_gallery);

		foreach($px_gallery as $key1=>$val1)

		{

			$px_gallery_key = $key1;

			if(is_int($px_gallery_key))

			{

				break;

			}

		}

		 

		// ---- search widget setting---		

		$search = array();

		$search[1] = array(

			"title"		=>	'',

		);	

		$search['_multiwidget'] = '1';

		update_option('widget_search',$search);

		$search = get_option('widget_search');

		krsort($search);

		foreach($search as $key1=>$val1)

		{

			$search_key = $key1;

			if(is_int($search_key))

			{

				break;

			}

		}
		
		// ---- Custom Menu widget setting---		

		$nav_menu = array();

		$nav_menu[1] = array(

			"title"		=>	'',
			"nav_menu"		=>	'shortcodes',
			

		);	

		$nav_menu['_multiwidget'] = '1';

		update_option('widget_nav_menu',$nav_menu);

		$nav_menu = get_option('widget_nav_menu');

		krsort($nav_menu);

		foreach($nav_menu as $key1=>$val1)

		{

			$nav_menu_key = $key1;

			if(is_int($nav_menu_key))

			{

				break;

			}

		}
		
		
		// --- facebook widget setting-----

		$px_widget_facebook = array();

		$px_widget_facebook[1] = array(

		"title"		=>	'Follow on Facebook',

		"pageurl" 	=>	"https://www.facebook.com/envato",

		"showfaces" => "on",

		"likebox_height" => "385",

		"fb_bg_color" =>"#fff",

		);						

		$px_widget_facebook['_multiwidget'] = '1';

		update_option('widget_px_widget_facebook',$px_widget_facebook);

		$px_widget_facebook = get_option('widget_px_widget_facebook');

		krsort($px_widget_facebook);

		foreach($px_widget_facebook as $key1=>$val1)

		{

			$px_widget_facebook_key = $key1;

			if(is_int($px_widget_facebook_key))

			{

				break;

			}

		}
	

		
		// --- Twitter widget setting-----
		
		
		$px_twitter_widget = array();

		$px_twitter_widget [1] = array(

			"title"		=>	'Twitter',
			"username"		=>	"envato",
			"numoftweets"		=>	'3',
		);						

		$px_twitter_widget['_multiwidget'] = '1';

		update_option('widget_px_twitter_widget',$px_twitter_widget);

		$px_twitter_widget = get_option('widget_px_twitter_widget');

		krsort($px_twitter_widget);

		foreach($px_twitter_widget as $key1=>$val1)

		{

			$px_twitter_widget_key = $key1;

			if(is_int($px_twitter_widget_key))

			{

				break;

			}

		}
		$px_twitter_widget2 = array();

		$px_twitter_widget2 [1] = array(

			"title"		=>	'Twitter',
			"username"		=>	"envato",
			"numoftweets"		=>	'3',
		);						

		$px_twitter_widget2['_multiwidget'] = '1';

		update_option('widget_px_twitter_widget',$px_twitter_widget2);

		$px_twitter_widget2 = get_option('widget_px_twitter_widget');

		krsort($px_twitter_widget2);

		foreach($px_twitter_widget2 as $key1=>$val1)

		{

			$px_twitter_widget_key2 = $key1;

			if(is_int($px_twitter_widget_key2))

			{

				break;

			}

		}
		
		// --- Mail chimp widget setting-----

		$px_MailChimp_Widget = array();

		$px_MailChimp_Widget [1] = array(

		"title"		=>	'Newsletter',
		"description"		=>	'New Enterprise Commercial <br/>A Funny Disclaimer ',
		"email_text"		=>	'Enter Your Email',

		);						

		$px_MailChimp_Widget['_multiwidget'] = '1';

		update_option('widget_px_MailChimp_Widget',$px_MailChimp_Widget);

		$px_MailChimp_Widget = get_option('widget_px_MailChimp_Widget');

		krsort($px_MailChimp_Widget);

		foreach($px_MailChimp_Widget as $key1=>$val1)

		{

			$px_MailChimp_Widget_key = $key1;

			if(is_int($px_MailChimp_Widget_key))

			{

				break;

			}

		}

		// --- Social count Followers widget setting-----
		//facebook_page_url
		$px_social_widget = array();

		$px_social_widget [1] = array(
		"title"				=> '',
		"facebook_page_url"		=>	'envato',
		"facebook_text"		=>	'Facebook Fans',
		
		"twitter_username"		=>	'@envato',
		"twitter_text"		=>	'Facebook Fans',
		
		"googleplus_id"		=>	'105599180788269156461',
		"googleplus_text"		=>	'Google+ Followers',
		
		"youtube_id"		=>	'https://www.youtube.com/user/PitbullVEVO',
		"youtube_text"		=>	'Youtube Subscribers',
		
		"vimeo_id"		=>	'https://vimeo.com/channels/staffpicks',
		"vimeo_text"		=>	'Vimeo Subscribers',
		
		"dribble_id"		=>	'http://dribbble.com/envato',
		"dribble_text"		=>	'Dribble Followers',
		

		);						

		$px_social_widget['_multiwidget'] = '1';

		update_option('widget_px_social_meida_followers_widget',$px_social_widget);

		$px_social_widget = get_option('widget_px_social_meida_followers_widget');

		krsort($px_social_widget);

		foreach($px_social_widget as $key1=>$val1)

		{

			$px_social_widget_key = $key1;

			if(is_int($px_social_widget_key))

			{

				break;

			}

		}
		
		// --- text widget setting ---

		$text = array();

		$text[1] = array(

			'title' => 'Hospitality',

			'text' => '',

		);						

		$text['_multiwidget'] = '1';

		update_option('widget_text',$text);

		$text = get_option('widget_text');

		krsort($text);

		foreach($text as $key1=>$val1)

		{

			$text_key = $key1;

			if(is_int($text_key))

			{

				break;

			}

		}

	 	//----text widget for contact info----------

		$text2 = array();

		$text2 = get_option('widget_text');

		$text2[2] = array(
			'title' => ' Contact Info',
			'text' => '<br>
				<img src="http://pixfill.com/wp-themes/medianews/wp-content/uploads/2014/05/logo.png" alt="" />
				<h5>
				The Job Bank <br>
				1234 South Lipsum Avenue <br>
				United States, 123456 
				</h5><br> 
				<ul>
				<li>Phone : 123456789</li>
				<li>Fax : 012345</li>
				<li>Phone : 123456789</li>
				<li>Email : 123456789</li>
				</ul>
				
				<ul>
				<li style="display:inline-block;"><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li style="display:inline-block;"><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li style="display:inline-block;"><a href="#"><i class="fa fa-instagram"></i></a></li>
				<li style="display:inline-block;"><a href="#"><i class="fa fa-skype"></i></a></li>
				<li style="display:inline-block;"><a href="#"><i class="fa fa-youtube"></i></a></li>
				<li style="display:inline-block;"><a href="#"><i class="fa fa-foursquare"></i></a></li>
				<li style="display:inline-block;"><a href="#"><i class="fa fa-google-plus"></i></a></li>
				</ul>
			',
		);						

		$text2['_multiwidget'] = '1';

		update_option('widget_text',$text2);

		$text2 = get_option('widget_text');

		krsort($text2);

		foreach($text2 as $key1=>$val1)

		{

			$text_key2 = $key1;

			if(is_int($text_key2))

			{

				break;

			}

		}
		
		
		$header_adstext = array();

		$header_adstext = get_option('widget_text');

		$header_adstext[3] = array(
			'title' => '',
			'text' => '[ads no="0"]',
		);						

		$header_adstext['_multiwidget'] = '1';

		update_option('widget_text',$header_adstext);

		$header_adstext = get_option('widget_text');

		krsort($header_adstext);

		foreach($header_adstext as $key1=>$val1)

		{

			$header_adstext_key = $key1;

			if(is_int($header_adstext_key))

			{

				break;

			}

		}
		
		$footer_adstexttt = array();

		$footer_adstexttt = get_option('widget_text');

		$footer_adstexttt[4] = array(
			'title' => '',
			'text' => '[ads no="1"]',
		);						

		$footer_adstexttt['_multiwidget'] = '1';

		update_option('widget_text',$footer_adstexttt);

		$footer_adstexttt = get_option('widget_text');

		krsort($footer_adstexttt);

		foreach($footer_adstexttt as $key1=>$val1)

		{

			$footer_adstexttt_key = $key1;

			if(is_int($footer_adstexttt_key))

			{

				break;

			}

		}
		
		$sidebar_adstext = array();

		$sidebar_adstext = get_option('widget_text');

		$sidebar_adstext[5] = array(
			'title' => '',
			'text' => '[ads no="2"]',
		);						

		$sidebar_adstext['_multiwidget'] = '1';

		update_option('widget_text',$sidebar_adstext);

		$sidebar_adstext = get_option('widget_text');

		krsort($sidebar_adstext);

		foreach($sidebar_adstext as $key1=>$val1)

		{

			$sidebar_adstext_key = $key1;

			if(is_int($sidebar_adstext_key))

			{

				break;

			}

		}
		
		$sidebar_vertical_adstext = array();

		$sidebar_vertical_adstext = get_option('widget_text');

		$sidebar_vertical_adstext[6] = array(
			'title' => '',
			'text' => '[ads no="3"]',
		);						

		$sidebar_vertical_adstext['_multiwidget'] = '1';

		update_option('widget_text',$sidebar_vertical_adstext);

		$sidebar_vertical_adstext = get_option('widget_text');

		krsort($sidebar_vertical_adstext);

		foreach($sidebar_vertical_adstext as $key1=>$val1)

		{

			$sidebar_vertical_adstext_key = $key1;

			if(is_int($sidebar_vertical_adstext_key))

			{

				break;

			}

		}
		$sidebar_vertical2_adstext = array();

		$sidebar_vertical2_adstext = get_option('widget_text');

		$sidebar_vertical2_adstext[7] = array(
			'title' => '',
			'text' => '[ads no="4"]',
		);						

		$sidebar_vertical2_adstext['_multiwidget'] = '1';

		update_option('widget_text',$sidebar_vertical2_adstext);

		$sidebar_vertical2_adstext = get_option('widget_text');

		krsort($sidebar_vertical2_adstext);

		foreach($sidebar_vertical2_adstext as $key1=>$val1)

		{

			$sidebar_vertical2_adstext_key = $key1;

			if(is_int($sidebar_vertical2_adstext_key))

			{

				break;

			}

		}
		

	// Add widgets in sidebars
	$sidebars_widgets['sidebar-home'] = array("px_social_meida_followers_widget-$px_social_widget_key", "recentposts-$recent_post_widget_key","text-$sidebar_adstext_key", "px_twitter_widget-$px_twitter_widget_key", "px_gallery-$px_gallery_key", "calendar-$calendar_key", "px_widget_facebook-$px_widget_facebook_key");
	
	$sidebars_widgets['sidebar-home2'] = array("text-$sidebar_adstext_key", "recentposts-$recent_post_widget_key", "px_mailchimp_widget-$px_MailChimp_Widget_key", "px_gallery-$px_gallery_key", "px_twitter_widget-$px_twitter_widget_key", "recent-comments-$default_recent_comments_widget_key", "recent-posts-$default_recent_post_widget_key");
	
	$sidebars_widgets['sidebar-home3'] = array("text-$sidebar_adstext_key", "recentposts-$recent_post_widget_key", "px_widget_facebook-$px_widget_facebook_key", "text-$sidebar_vertical2_adstext_key", "recent-posts-$default_recent_post_widget_key", "px_twitter_widget-$px_twitter_widget_key");
	
	$sidebars_widgets['sidebar-home4'] = array("px_widget_facebook-$px_widget_facebook_key","recentposts-$recent_post_widget_key", "px_gallery-$px_gallery_key", "px_twitter_widget-$px_twitter_widget_key", "recent-posts-$default_recent_post_widget_key", "calendar-$calendar_key");
	
	$sidebars_widgets['sidebar-home5'] = array("text-$sidebar_adstext_key","recentposts-$recent_post_widget_key2", "px_gallery-$px_gallery_key", "px_widget_facebook-$px_widget_facebook_key", "recent-posts-$default_recent_post_widget_key", "px_twitter_widget-$px_twitter_widget_key");
	
	$sidebars_widgets['sidebar-home6'] = array("px_twitter_widget-$px_twitter_widget_key","recent-comments-$default_recent_comments_widget_key", "px_mailchimp_widget-$px_MailChimp_Widget_key","recentposts-$recent_post_widget_key", "px_gallery-$px_gallery_key", "px_widget_facebook-$px_widget_facebook_key");
	
	$sidebars_widgets['footer-widget'] = array("text-$text_key2", "recentposts-$default_recent_post_widget_key", "recentposts-$recent_post_widget_key2", "px_mailchimp_widget-$px_MailChimp_Widget_key");
	$sidebars_widgets['contact-sidebar'] = array("px_twitter_widget-$px_twitter_widget_key", "px_widget_facebook-$px_widget_facebook_key" );
	$sidebars_widgets['small-sidebar'] = array("text-$sidebar_vertical_adstext_key", "recentposts-$recent_post_widget_key", "archives-$archives_key", "recentposts-$recent_post_widget_key2" );
	$sidebars_widgets['header-advertisement-widget'] = array("text-$header_adstext_key");
	$sidebars_widgets['footer-advertisement-widget'] = array("text-$footer_adstexttt_key");
	//print_r($sidebars_widgets);
	
	update_option('sidebars_widgets', $sidebars_widgets);


	}
	}