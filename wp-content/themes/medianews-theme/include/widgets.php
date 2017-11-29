<?php
/* widget_facebook start */

	class px_widget_facebook extends WP_Widget{
		function px_widget_facebook()  {
			$widget_ops = array('classname' => 'facebok_widget', 'description' => 'Facebook widget like box total customized with theme.' );
			$this->WP_Widget('px_widget_facebook', 'PX: Facebook', $widget_ops);
		}
		function form($instance){
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$title = $instance['title'];
			$pageurl = isset( $instance['pageurl'] ) ? esc_attr( $instance['pageurl'] ) : '';
			$showfaces = isset( $instance['showfaces'] ) ? esc_attr( $instance['showfaces'] ) : '';
			$showstream = isset( $instance['showstream'] ) ? esc_attr( $instance['showstream'] ) : '';
			$showheader = isset( $instance['showheader'] ) ? esc_attr( $instance['showheader'] ) : '';
			$fb_bg_color = isset( $instance['fb_bg_color'] ) ? esc_attr( $instance['fb_bg_color'] ) : '';
			$likebox_height = isset( $instance['likebox_height'] ) ? esc_attr( $instance['likebox_height'] ) : '';						
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> Title:
					<input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size='40' 
					name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('pageurl'); ?>"> Page URL:
					<input class="upcoming" id="<?php echo $this->get_field_id('pageurl'); ?>" size='40' 
					name="<?php echo $this->get_field_name('pageurl'); ?>" type="text" value="<?php echo esc_attr($pageurl); ?>" />
					<br />
					<small>Please enter your page or User profile url example: http://www.facebook.com/profilename OR <br />
					https://www.facebook.com/pages/wxyz/123456789101112 </small><br />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('showfaces'); ?>"> Show Faces:
					<input class="upcoming" id="<?php echo $this->get_field_id('showfaces'); ?>" 
					name="<?php echo $this->get_field_name('showfaces'); ?>" type="checkbox" <?php if(esc_attr($showfaces) != '' ){echo 'checked';}?> />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('showstream'); ?>"> Show Stream:
					<input class="upcoming" id="<?php echo $this->get_field_id('showstream'); ?>" 
					name="<?php echo $this->get_field_name('showstream'); ?>" type="checkbox" <?php if(esc_attr($showstream) != '' ){echo 'checked';}?> />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('likebox_height'); ?>"> Like Box Height:
					<input class="upcoming" id="<?php echo $this->get_field_id('likebox_height'); ?>" size='2' 
					name="<?php echo $this->get_field_name('likebox_height'); ?>" type="text" value="<?php echo esc_attr($likebox_height); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('fb_bg_color'); ?>"> Background Color:
					<input type="text" size='4' id="<?php echo $this->get_field_id('fb_bg_color'); ?>" 
					name="<?php echo $this->get_field_name('fb_bg_color'); ?>" value="<?php if(!empty($fb_bg_color)){ echo $fb_bg_color;}else{ echo "#fff";}; ?>" class="fb_bg_color upcoming"  />
				</label>
			</p>
		<?php
		}
		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['pageurl'] = $new_instance['pageurl'];
			$instance['showfaces'] = $new_instance['showfaces'];	
			$instance['showstream'] = $new_instance['showstream'];
			$instance['showheader'] = $new_instance['showheader'];
			$instance['fb_bg_color'] = $new_instance['fb_bg_color'];		
			//$instance['likebox_width'] = $new_instance['likebox_width'];
			$instance['likebox_height'] = $new_instance['likebox_height'];			
			return $instance;
		}
		function widget($args, $instance){
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$pageurl = empty($instance['pageurl']) ? ' ' : apply_filters('widget_title', $instance['pageurl']);
			$showfaces = empty($instance['showfaces']) ? ' ' : apply_filters('widget_title', $instance['showfaces']);
			$showstream = empty($instance['showstream']) ? ' ' : apply_filters('widget_title', $instance['showstream']);
			$showheader = empty($instance['showheader']) ? ' ' : apply_filters('widget_title', $instance['showheader']);
			$fb_bg_color = empty($instance['fb_bg_color']) ? ' ' : apply_filters('widget_title', $instance['fb_bg_color']);								
			//$likebox_width = empty($instance['likebox_width']) ? ' ' : apply_filters('widget_title', $instance['likebox_width']);								
			$likebox_height = empty($instance['likebox_height']) ? ' ' : apply_filters('widget_title', $instance['likebox_height']);													
			if(isset($showfaces) AND $showfaces == 'on'){$showfaces ='true';}else{$showfaces = 'false';}
			if(isset($showstream) AND $showstream == 'on'){$showstream ='true';}else{$showstream ='false';}
			echo $before_widget;	
			// WIDGET display CODE Start
			if (!empty($title) && $title <> ' '){
				echo $before_title;
				echo $title;
				echo $after_title;
			}
			global $wpdb, $post;
		?>
			<style type="text/css" >
				.facebookOuter {
					background-color:<?php echo $fb_bg_color ?>; 
					width:100%; 
					padding:0;
					float:left;
				}
				.facebookInner {
					float: left;
					width: 100%;
				}
				.facebook_module, .fb_iframe_widget > span, .fb_iframe_widget > span > iframe {
					width: 100% !important;
				}
				.fb_iframe_widget, .fb-like-box div span iframe {
					width: 100% !important;
					float: left;
				}
			</style>
		<div class="facebook">
			<div class="facebookOuter">
				<div class="facebookInner">
					<div class="fb-like-box" 
							  colorscheme="light" data-height="<?php echo $likebox_height;?>"  data-width="190" 
							  data-href="<?php echo $pageurl;?>" 
							  data-border-color="#fff" data-show-faces="<?php echo $showfaces;?>"  data-show-border="false"
							  data-stream="<?php echo $showstream;?>" data-header="false"> </div>
				</div>
			</div>
		</div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script> 
		<?php 
		echo $after_widget;
		}
	}

// widget_gallery start

	class px_gallery extends WP_Widget {
		function px_gallery() {
			$widget_ops = array('classname' => 'widget-gallery', 'description' => 'Select any gallery to show in widget.');
			$this->WP_Widget('px_gallery', 'PX : Gallery Widget', $widget_ops);
		}
		function form($instance) {
			$instance = wp_parse_args((array) $instance, array('title' => '', 'get_names_gallery' => 'new'));
			$title = $instance['title'];
			$get_names_gallery = isset($instance['get_names_gallery']) ? esc_attr($instance['get_names_gallery']) : '';
			$showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> Title:
					<input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" 
					name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('get_names_gallery'); ?>"> Select Gallery:
					<select id="<?php echo $this->get_field_id('get_names_gallery'); ?>" 
					name="<?php echo $this->get_field_name('get_names_gallery'); ?>" style="width:225px;">
				<?php
					global $wpdb, $post;
					$newpost = 'posts_per_page=-1&post_type=px_gallery&order=DESC&post_status=publish';
					$newquery = new WP_Query($newpost);
					while ($newquery->have_posts()): $newquery->the_post();
					?>
						<option <?php
							if (esc_attr($get_names_gallery) == $post->post_name) {
								echo 'selected';
							}
							?> value="<?php echo $post->post_name; ?>" > <?php echo substr(get_the_title($post->ID), 0, 20);
									if (strlen(get_the_title($post->ID)) > 20)
										echo "...";
									?> 
					   </option>
					<?php endwhile; ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('showcount'); ?>"> Number of Images:
				<input class="upcoming" id="<?php echo $this->get_field_id('showcount'); ?>" size="2" 
				name="<?php echo $this->get_field_name('showcount'); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
			</label>
		</p>
		<?php
		}
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['get_names_gallery'] = $new_instance['get_names_gallery'];
			$instance['showcount'] = $new_instance['showcount'];
			return $instance;
		}
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			global $wpdb, $post;
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$get_names_gallery = isset($instance['get_names_gallery']) ? esc_attr($instance['get_names_gallery']) : '';
			$showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';
			if (empty($showcount)) {
				 $showcount = '12';
			}
			echo $before_widget;
			if (!empty($title) && $title <> ' '){
				echo $before_title;
				echo $title;
				echo $after_title;
			}
			if ($get_names_gallery <> '') {
				// galery slug to id start
				$get_gallery_id = '';
				$args=array(
					'name' => $get_names_gallery,
					'post_type' => 'px_gallery',
					'post_status' => 'publish',
					'showposts' => 1,
				);
				$get_posts = get_posts($args);
				if($get_posts){
					$get_gallery_id = $get_posts[0]->ID;
				}
				// galery slug to id end
				if($get_gallery_id <> ''){
					$px_meta_gallery_options = get_post_meta($get_gallery_id, "px_meta_gallery_options", true);
					if ($px_meta_gallery_options <> "") {
						$px_xmlObject = new SimpleXMLElement($px_meta_gallery_options);
						if ($showcount > count($px_xmlObject)) {
							$showcount = count($px_xmlObject);
						}
					?>
					<div  class="gallery lightbox">
						<ul>
						<?php
							 for ($i = 0; $i < $showcount; $i++) {
								$path = $px_xmlObject->gallery[$i]->path;
								$title = $px_xmlObject->gallery[$i]->title;
								$description = $px_xmlObject->gallery[$i]->description;
								$social_network = $px_xmlObject->gallery[$i]->social_network;
								$use_image_as = $px_xmlObject->gallery[$i]->use_image_as;
								$video_code = $px_xmlObject->gallery[$i]->video_code;
								$link_url = $px_xmlObject->gallery[$i]->link_url;
								$image_url = px_attachment_image_src($path, 64, 64);
								$image_url_full = px_attachment_image_src($path, 0, 0);
						?>
						
						
						
						<li> 
							<figure>
							<?php echo "<img  src='" . $image_url . "' data-alt='" . $title . "' alt='' />" ?>
						   <figcaption>
							<a data-title="<?php if ( $description <> "" ) { echo $description;}?>" href="<?php if ($use_image_as == 1)echo $video_code;  elseif($use_image_as==2) 
								echo $link_url; else echo $image_url_full;?>"	        
								target="<?php if($use_image_as==2){ echo '_blank'; }else{ echo '_self'; }; ?>" data-rel="<?php if ($use_image_as == 1) 
								echo "prettyPhoto"; elseif($use_image_as==2) echo ""; else echo "prettyPhoto[gallery1]"?>">
								<i class="fa fa-plus"></i>	
							</a> 
							  </figcaption>
							</figure>
						</li>
				<?php } ?>
				</ul>
			</div>
		<?php }
		}else{
			echo '<h4>'.__( 'No results found.', 'Media News' ).'</h4>';
		}
		wp_reset_query(); 
		} 
		echo $after_widget; // WIDGET display CODE End
		}
	}

// widget_recent_post start

	class recentposts extends WP_Widget{
		function recentposts()	{
			$widget_ops = array('classname' => 'widget-recent-blog', 'description' => 'Recent Posts from category.' );
			$this->WP_Widget('recentposts', 'PX : Recent Posts', $widget_ops);
		}
		function form($instance){
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$title = $instance['title'];
			$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
			$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"> Title:
				<input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" 
				name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('select_category'); ?>"> Select Category:
				<select id="<?php echo $this->get_field_id('select_category'); ?>" 
					name="<?php echo $this->get_field_name('select_category'); ?>" style="width:225px">
					<?php
					$categories = get_categories();
						if($categories <> ""){
							foreach ( $categories as $category ) {
							?>
								<option <?php if($select_category == $category->slug){echo 'selected';}?> 
									value="<?php echo $category->slug;?>" ><?php echo $category->name;?>
								</option>
							<?php } 
						}
					?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('showcount'); ?>"> Number of Posts To Display:
				<input class="upcoming" id="<?php echo $this->get_field_id('showcount'); ?>" size='2' 
				name="<?php echo $this->get_field_name('showcount'); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
			</label>
		 </p>
		 
		<?php
		}
		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['select_category'] = $new_instance['select_category'];
			$instance['showcount'] = $new_instance['showcount'];
			return $instance;
		}
		function widget($args, $instance){
			global $px_node;
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);		
			$showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);	
			
			if($instance['showcount'] == ""){$instance['showcount'] = '-1';}
			echo $before_widget;	
			// WIDGET display CODE Start
			if (!empty($title) && $title <> ' '){
				echo $before_title;
				echo $title;
				echo $after_title;
			}
			global $wpdb, $post;
			
			wp_reset_query();
			$sticky = get_option( 'sticky_posts' );
			$args = array('posts_per_page' => '1','post_type' => 'post','category_name' => "$select_category", 'order' => 'DESC','post__in' => $sticky);
			$custom_query = new WP_Query($args);
			if ( $custom_query->have_posts() <> "" ) {
				$counter_post=0;
				while ( $custom_query->have_posts()) : $custom_query->the_post();
				$blog_classes = 'featured-post';
				$width 	= 395;
				$height = 222;
				$image_url = px_get_post_img_src($post->ID, $width, $height);
				if($image_url == ""){
						$blog_classes = 'no-image';
				}
				?>
					<article <?php post_class($blog_classes); ?>>
						<h6>&nbsp;</h6>
						<figure>
						<?php if($image_url <> ""){?>
							<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url;?>" alt=""></a>
						<?php }?>
						<figcaption>
							<div class="text">
							<ul class='post-options blog-medium-options'>
							<?php 
								$before_cat = "<li>";
								$categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat, ', ', '</li>' );
								if ( $categories_list ){
									printf( __( '%1$s', 'Media News'),$categories_list );
								}
							?>
							</ul>
								<?php // echo px_user_rating_horziantal_display();?>
								<div class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?>.</a></div>
								<?php px_posted_on(false,false,false,true,true,true,true);?>
							</div>
							</figcaption>
						</figure>
					</article>
				<?php
				endwhile;
			}
			
			wp_reset_query();
			$args = array( 'posts_per_page' => "$showcount",'post_type' => 'post','category_name' => "$select_category",'order' => 'DESC'); 
			$custom_query = new WP_Query($args);
			if ( $custom_query->have_posts() <> "" ) {
				while ( $custom_query->have_posts()) : $custom_query->the_post();
				$blog_classes = 'featured-post';
				$width 	= 280;
				$height = 200;
				$image_url = px_get_post_img_src($post->ID, $width, $height);
				if($image_url == ""){
						$blog_classes = 'no-image';
				}
	
				?>
				<article>
				<?php 
					if($image_url <> ''){
						echo " <figure><a class='pix-colrhvr' href='".get_permalink()."' ><img src='".$image_url."' alt=''></a></figure>";					
					} ?>
					<div class="text">
						<h6>
							<a href="<?php the_permalink();?>"  class='pix-colrhvr'>
								<?php echo substr(get_the_title(),0,50); if ( strlen(get_the_title()) > 50) echo ".."; ?>
							</a>
						</h6>
						<?php  //echo px_user_rating_horziantal_display();?>
						 <?php px_posted_on(false,false,false,true,false,false,true);?>
					</div>
				</article>
			<?php
			 endwhile; 
		}else {
			echo '<h4>'.__( 'No results found.', 'Media News' ).'</h4>';
		}
		wp_reset_postdata();
		echo $after_widget;
		}
	}

// widget_twitter start

	class px_twitter_widget extends WP_Widget {
		function px_twitter_widget() {
			$widget_ops = array('classname' => 'widget-twitter', 'description' => 'twitter widget');
			$this->WP_Widget('px_twitter_widget', 'PX : Twitter Widget', $widget_ops);
		}
		function form($instance) {
			$instance = wp_parse_args((array) $instance, array('title' => ''));
			$title = $instance['title'];
			$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
			$numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';
 		?>
        	<p>
          	<label for="<?php echo $this->get_field_id('title'); ?>">
				<span>Title: </span>
				<input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
            </p>
            <p>
			<label for="screen_name">User Name<span class="required">(*)</span>: </label>
				<input class="upcoming" id="<?php echo $this->get_field_id('username'); ?>" size="40" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
            </p>
            <p>
            <label for="tweet_count">
			<span>Num of Tweets: </span>
			<input class="upcoming" id="<?php echo $this->get_field_id('numoftweets'); ?>" size="2" name="<?php echo $this->get_field_name('numoftweets'); ?>" type="text" value="<?php echo esc_attr($numoftweets); ?>" />
			</label>
            </p>
            <div class="clear"></div>
  		<?php
		}
	
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['numoftweets'] = $new_instance['numoftweets'];
			
 			return $instance;
		}
  		function widget($args, $instance) {
			global $px_theme_option;
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$username = $instance['username'];
 			$numoftweets = $instance['numoftweets'];		
	 		if($numoftweets == ''){$numoftweets = 2;}
			echo $before_widget;
  			// WIDGET display CODE Start
			if (!empty($title) && $title <> ' '){
				echo $before_title . $title . $after_title;
			}
				if(strlen($username) > 1){
						$text ='';
						$return = '';
						$cacheTime =10000;
						$transName = 'latest-tweets';
						require_once "twitteroauth/twitteroauth.php"; //Path to twitteroauth library
						$consumerkey = $px_theme_option['consumer_key'];
						$consumersecret = $px_theme_option['consumer_secret'];
						$accesstoken = $px_theme_option['access_token'];
						$accesstokensecret = $px_theme_option['access_token_secret'];
						$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
						$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=".$numoftweets);
						if(!is_wp_error($tweets) and is_array($tweets)){
							set_transient($transName, $tweets, 60 * $cacheTime);
						}else{
							$tweets= get_transient('latest-tweets');
						}
 						if(!is_wp_error($tweets) and is_array($tweets)){
							$return .= "<div class='twitter_sign webkit'>
								<div class='tweets-wrapper article'>";
									foreach($tweets as $tweet) {
										$text = $tweet->{'text'}; 
										foreach($tweet->{'entities'} as $type => $entity) {
												if($type == 'urls') {						
													foreach($entity as $j => $url) {
														$display_url = '<a href="' . $url->{'url'} . '" target="_blank" title="' . $url->{'expanded_url'} . '">' . $url->{'display_url'} . '</a>';
														$update_with = 'Read more at '.$display_url;
														$text = str_replace('Read more at '.$url->{'url'}, '', $text);
														$text = str_replace($url->{'url'}, '', $text);
													}
												} else if($type == 'hashtags') {
													foreach($entity as $j => $hashtag) {
														$update_with = '<a href="https://twitter.com/search?q=%23' . $hashtag->{'text'} . '&src=hash" target="_blank" title="' . $hashtag->{'text'} . '">#' . $hashtag->{'text'} . '</a>';
														$text = str_replace('#'.$hashtag->{'text'}, $update_with, $text);
													}
												} else if($type == 'user_mentions') {
														foreach($entity as $j => $user) {
															  $update_with = '<a href="https://twitter.com/' . $user->{'screen_name'} . '" target="_blank" title="' . $user->{'name'} . '">@' . $user->{'screen_name'} . '</a>';
															  $text = str_replace('@'.$user->{'screen_name'}, $update_with, $text);
														}
													}
												}
										$large_ts = time();
										$n = $large_ts - strtotime($tweet->{'created_at'});
										if($n < (60)){ $posted = sprintf(__('%d seconds ago','Media News'),$n); }
										elseif($n < (60*60)) { $minutes = round($n/60); $posted = sprintf(_n('About a Minute Ago','%d Minutes Ago',$minutes,'Media News'),$minutes); }
										elseif($n < (60*60*16)) { $hours = round($n/(60*60)); $posted = sprintf(_n('About an Hour Ago','%d Hours Ago',$hours,'Media News'),$hours); }
										elseif($n < (60*60*24)) { $hours = round($n/(60*60)); $posted = sprintf(_n('About an Hour Ago','%d Hours Ago',$hours,'Media News'),$hours); }
										elseif($n < (60*60*24*6.5)) { $days = round($n/(60*60*24)); $posted = sprintf(_n('About a Day Ago','%d Days Ago',$days,'Media News'),$days); }
										elseif($n < (60*60*24*7*3.5)) { $weeks = round($n/(60*60*24*7)); $posted = sprintf(_n('About a Week Ago','%d Weeks Ago',$weeks,'Media News'),$weeks); } 
										elseif($n < (60*60*24*7*4*11.5)) { $months = round($n/(60*60*24*7*4)) ; $posted = sprintf(_n('About a Month Ago','%d Months Ago',$months,'Media News'),$months);}
										elseif($n >= (60*60*24*7*4*12)){$years=round($n/(60*60*24*7*52)) ; $posted = sprintf(_n('About a year Ago','%d years Ago',$years,'Media News'),$years);} 
										$user = $tweet->{'user'};
										$return .="<article><h6>&nbsp;</h6><div class='text webkit'>";
										$return .= "<p class='cs-post-title'>" . $text . "</p>";
										$return .= "<p><i class='fa fa-twitter'></i> <span>" . $posted. "</span></p>";
										$return .="</div></article>";
									}
							$return .="</div></div>";
							echo $return;
			}else{
			if(isset($tweets->errors[0]) && $tweets->errors[0] <> ""){
				echo $tweets->errors[0]->message.".<br> Please enter valid Twitter API Keys";
			}else{
				_e( 'No results found.', 'Media News' );	
			}
		}
	}else{ 				
			//echo '<h4>No User information given.</h4>';
		}
		echo $after_widget;
		// WIDGET display CODE End
		}
 	}

// widget_twitter end
	
// MailChimp Widget

	class px_MailChimp_Widget extends WP_Widget {
	
		private $default_failure_message;
	
		public $default_loader_graphic;
	
		private $default_signup_text;
	
		private $default_success_message;
	
		private $default_title;
	
		private $successful_signup = false;
	
		private $subscribe_errors;
	
		private $ns_mc_plugin;
	
	
		public function px_MailChimp_Widget () {
	
			$this->default_failure_message = __('There was a problem processing your submission.', 'Media News');
	
			$this->default_signup_text = __('Join now!', 'Media News');
			
			$this->default_email_field_text = __('Enter Your Email', 'Media News');
	
			$this->default_success_message = __('Thank you for joining our mailing list. Please check your email for a confirmation link.', 'Media News');
	
			$this->default_title = __('Sign up for our mailing list.', 'Media News');
	
			$widget_options = array('classname' => 'widget_newsletter', 'description' => __( "Displays a sign-up form for a MailChimp mailing list.", 'Media News'));
	
			$this->WP_Widget('px_MailChimp_Widget', __('PX: MailChimp List Signup', 'Media News'), $widget_options);
	
			$this->ns_mc_plugin = CHIMP_MC_Plugin::get_instance();
	
			$default_loader_graphic = get_template_directory_uri()."/images/admin/ajax-loader.gif";
	
			$this->default_loader_graphic = get_template_directory_uri()."/images/ajax-loader.gif";
	
			add_action('parse_request', array(&$this, 'process_submission'));
	
		}
	
		/**
	
		 * @author James Lafferty
	
		 * @since 0.1
	
		 */
	
		public function form ($instance) {
	
			$mcapi = $this->ns_mc_plugin->get_mcapi();
	
			if (false == $mcapi) {
	
				echo $this->ns_mc_plugin->get_admin_notices();
	
			} else {
	
				$this->lists = $mcapi->lists();
	
				$defaults = array(
	
					'failure_message' => $this->default_failure_message,
	
					'title' => $this->default_title,
					
					'email_text' => $this->default_email_field_text,
					
					
					'description' => 'Enter Your Email',
	
					'signup_text' => $this->default_signup_text,
	
					'success_message' => $this->default_success_message,
	
					'collect_first' => false,
	
					'collect_last' => false,
	
					'old_markup' => false
	
				);
	
				$vars = wp_parse_args($instance, $defaults);
	
				extract($vars);
	
				?>
	
						<h3><?php echo  __('General Settings', 'Media News'); ?></h3>
	
						<p>
	
							<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo  __('Title :', 'Media News'); ?></label>
	
							<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	
						</p>
	
						<p>
	
							<label for="<?php echo $this->get_field_id('current_mailing_list'); ?>"><?php echo __('Select a Mailing List :', 'Media News'); ?></label>
	
							<select class="widefat" id="<?php echo $this->get_field_id('current_mailing_list');?>" name="<?php echo $this->get_field_name('current_mailing_list'); ?>">
	
				<?php	
	
				foreach ($this->lists['data'] as $key => $value) {
	
					$selected = (isset($current_mailing_list) && $current_mailing_list == $value['id']) ? ' selected="selected" ' : '';
	
					?>	
	
							<option <?php echo $selected; ?>value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
	
					<?php
	
				}
	
				?>
	
							</select>
	
						</p>
	
						<p>
	
							<label ><?php echo  __('Description :', 'Media News'); ?></label>
	
							<textarea  class="widefat" name="<?php echo $this->get_field_name('description'); ?>"  rows="4" cols="8"><?php if(isset($description)){echo $description;} else { 'New Enterprise Commercial <br/> A Funny Disclaimer';} ?></textarea>
	
						</p>
						<p>
	
							<label ><?php echo  __('Email Text :', 'Media News'); ?></label>
	
							<textarea  class="widefat" name="<?php echo $this->get_field_name('email_text'); ?>"  rows="4" cols="8"><?php if(isset($email_text)){echo $email_text;} else { 'Enter Your Email';} ?></textarea>
	
						</p>
						
	
						<p>
	
							<label for="<?php echo $this->get_field_id('signup_text'); ?>"><?php echo __('Sign Up Button Text :', 'Media News'); ?></label>
	
							<input class="widefat" id="<?php echo $this->get_field_id('signup_text'); ?>" name="<?php echo $this->get_field_name('signup_text'); ?>" value="<?php echo $signup_text; ?>" />
	
						</p>
	
						<p>
	
							<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('collect_first'); ?>" name="<?php echo $this->get_field_name('collect_first'); ?>" <?php echo  checked($collect_first, true, false); ?> />
	
							<label for="<?php echo $this->get_field_id('collect_first'); ?>"><?php echo  __('Collect first name.', 'Media News'); ?></label>
	
							<br />
	
							<input type="checkbox" class="checkbox" id="<?php echo  $this->get_field_id('collect_last'); ?>" name="<?php echo $this->get_field_name('collect_last'); ?>" <?php echo checked($collect_last, true, false); ?> />
	
							<label><?php echo __('Collect last name.', 'Media News'); ?></label>
	
						</p>
	
						<h3><?php echo __('Notifications', 'Media News'); ?></h3>
	
						<p><?php echo  __('Use these fields to customize what your visitors see after they submit the form', 'Media News'); ?></p>
	
						<p>
	
							<label for="<?php echo $this->get_field_id('success_message'); ?>"><?php echo __('Success :', 'Media News'); ?></label>
	
							<textarea class="widefat" id="<?php echo $this->get_field_id('success_message'); ?>" name="<?php echo $this->get_field_name('success_message'); ?>"><?php echo $success_message; ?></textarea>
	
						</p>
	
						<p>
	
							<label for="<?php echo $this->get_field_id('failure_message'); ?>"><?php echo __('Failure :', 'Media News'); ?></label>
	
							<textarea class="widefat" id="<?php echo $this->get_field_id('failure_message'); ?>" name="<?php echo $this->get_field_name('failure_message'); ?>"><?php echo $failure_message; ?></textarea>
	
						</p>
	
				<?php
	
			}
	
		}
	
		
	
		/**
	
		 * @author James Lafferty
	
		 * @since 0.1
	
		 */
	
		
	
		public function process_submission () {
	
			global $px_theme_option;
			
			if(isset($px_theme_option['mailchimp_key']) && isset($_REQUEST[$this->id_base . '_email']) && $px_theme_option['mailchimp_key'] <> ''){
					
					
			
	
				if (isset($_GET[$this->id_base . '_email'])) {
					
					
					$mcapi = $this->ns_mc_plugin->get_mcapi();
					
		
					header("Content-Type: application/json");
		
					
		
					//Assume the worst.
		
					$response = '';
		
					$result = array('success' => false, 'error' => $this->get_failure_message($_GET['ns_mc_number']));
		
					
		
					$merge_vars = array();
		
					
		
					if (! is_email($_GET[$this->id_base . '_email'])) { //Use WordPress's built-in is_email function to validate input.
		
						
		
						$response = json_encode($result); //If it's not a valid email address, just encode the defaults.
		
						
		
					} else {
		
						
		
						$mcapi = $this->ns_mc_plugin->get_mcapi();
						
						if (false == $mcapi) {
		
						
		
						return false;
		
						
		
					}
						
		
						if (false == $this->ns_mc_plugin) {
		
							
		
							$response = json_encode($result);
		
							
		
						} else {
		
							
		
							if (isset($_GET[$this->id_base . '_first_name']) && is_string($_GET[$this->id_base . '_first_name'])) {
		
								
		
								$merge_vars['FNAME'] = $_GET[$this->id_base . '_first_name'];
		
								
		
							}
		
							
		
							if (isset($_GET[$this->id_base . '_last_name']) && is_string($_GET[$this->id_base . '_last_name'])) {
		
								
		
								$merge_vars['LNAME'] = $_GET[$this->id_base . '_last_name'];
		
								
		
							}
		
							
		
							$subscribed = $mcapi->listSubscribe($this->get_current_mailing_list_id($_GET['ns_mc_number']), $_GET[$this->id_base . '_email'], $merge_vars);
		
						
		
							if (false == $subscribed) {
		
								
		
								$response = json_encode($result);
		
								
		
							} else {
		
							
		
								$result['success'] = true;
		
								$result['error'] = '';
		
								$result['success_message'] =  $this->get_success_message($_GET['ns_mc_number']);
		
								$response = json_encode($result);
		
								
		
							}
		
							
		
						}
		
						
		
					}
		
					
		
					exit($response);
		
					
		
					} elseif (isset($_POST[$this->id_base . '_email'])) {
		
					
		
					$this->subscribe_errors = '<div class="error">'  . $this->get_failure_message($_POST['ns_mc_number']) .  '</div>';
		
					
		
					if (! is_email($_POST[$this->id_base . '_email'])) {
		
						
		
						return false;
		
						
		
					}
		
					
		
					$mcapi = $this->ns_mc_plugin->get_mcapi();
		
					
		
					if (false == $mcapi) {
		
						
		
						return false;
		
						
		
					}
					$merge_vars = array();
					if (!isset($_POST[$this->id_base . '_first_name']) && empty($_POST[$this->id_base . '_first_name'])){$_POST[$this->id_base . '_first_name'] = '';}
					if (!isset($_POST[$this->id_base . '_last_name']) && empty($_POST[$this->id_base . '_last_name'])){$_POST[$this->id_base . '_last_name'] = '';}
					if (!isset($_POST[$this->id_base . '_email']) && empty($_POST[$this->id_base . '_email'])){$_POST[$this->id_base . '_email'] = '';}
					
		
					if (isset($_POST[$this->id_base . '_first_name']) && is_string($_POST[$this->id_base . '_first_name'])  && '' != $_POST[$this->id_base . '_first_name']) {
		
						
		
						$merge_vars['FNAME'] = strip_tags($_POST[$this->id_base . '_first_name']);
		
						
		
					}
		
					
		
					if (isset($_POST[$this->id_base . '_last_name']) && is_string($_POST[$this->id_base . '_last_name']) && '' != $_POST[$this->id_base . '_last_name']) {
		
						
		
						$merge_vars['LNAME'] = strip_tags($_POST[$this->id_base . '_last_name']);
		
						
		
					}
					
					
		
					$subscribed = $mcapi->listSubscribe($this->get_current_mailing_list_id($_POST['ns_mc_number']), $_POST[$this->id_base . '_email'], $merge_vars);
		
					
		
					if (false == $subscribed) {
		
		
		
						return false;
		
						
		
					} else {
		
						
		
						$this->subscribe_errors = '';
		
						
		
						setcookie($this->id_base . '-' . $this->number, $this->hash_mailing_list_id(), time() + 31556926);
		
						
		
						$this->successful_signup = true;
		
						
		
						$this->signup_success_message = '<p>' . $this->get_success_message($_POST['ns_mc_number']) . '</p>';
		
						
		
						return true;
		
						
		
					}	
		
					
		
				}
				
				
			} else if(!isset($px_theme_option['mailchimp_key']) && isset($_REQUEST[$this->id_base . '_email']) && $px_theme_option['mailchimp_key'] == ''){
				
				echo '<div class="error">Invalid API key.</div>';	
				
				return false;
				//echo '<div class="error">'  . $this->get_failure_message($_POST['ns_mc_number']) .  '</div>';	
			}
	
			
	
		}
	
		
	
		/**
	
		 * @author James Lafferty
	
		 * @since 0.1
	
		 */
	
		
	
		public function update ($new_instance, $old_instance) {
	
			
	
			$instance = $old_instance;
	
			
	
			$instance['collect_first'] = ! empty($new_instance['collect_first']);
	
			
	
			$instance['collect_last'] = ! empty($new_instance['collect_last']);
	
			
	
			$instance['current_mailing_list'] = esc_attr($new_instance['current_mailing_list']);
	
			
	
			$instance['failure_message'] = esc_attr($new_instance['failure_message']);
	
			
	
			$instance['signup_text'] = esc_attr($new_instance['signup_text']);
			
			$instance['email_text'] = esc_attr($new_instance['email_text']);
	
			
	
			$instance['success_message'] = esc_attr($new_instance['success_message']);
	
			
	
			$instance['title'] = esc_attr($new_instance['title']);
	
			$instance['description'] = esc_attr($new_instance['description']);
	
			
	
			return $instance;
	
			
	
		}
	
		
	
		/**
	
		 * @author James Lafferty
	
		 * @since 0.1
	
		 */
	
		
	
		public function widget ($args, $instance) {
	
			
	
			extract($args);
	
			
	
		
	
				
	
				echo $before_widget . $before_title . $instance['title'] . $after_title;
	
	
				
				
				if ($this->successful_signup) {
	
					echo '<p class="bad_authentication">'.$this->signup_success_message.'</span>';
	
				}
	
					//cs_mailchimp_add_scripts ();
	
					global $px_theme_option;
	
					?>	
	
					
	
				   
	
					<?php echo $this->subscribe_errors; ?>
	
					
	
					<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="<?php echo $this->id_base . '_form-' . $this->number; ?>" method="post">
	
						
	
						<?php	
						$mailchimpkey  = '';
						if($px_theme_option['mailchimp_key'] == ''){
							$mailchimpkey = 'invalid Mailchimp API Key';
							
						}
						echo '<input type="hidden" name="mailchimp_key" id="mailchimp_key_validation" value="'.$mailchimpkey.'">';
	
							if (isset($instance['collect_first']) && $instance['collect_first'] <> '') {
	
						?>	
						<label>
						<input type="text" name="<?php echo $this->id_base . '_first_name'; ?>" value="<?php if($px_theme_option['trans_switcher'] == "on"){ _e('First Name :','Media News');}else{ echo $px_theme_option['trans_firstname']; }?>" />
						</label>
	
						<?php
	
							}
							if (isset($instance['collect_last']) && $instance['collect_last'] <> '') {
	
						?>	
						<label>	
						<input type="text" name="<?php echo $this->id_base . '_last_name'; ?>" value="<?php if($px_theme_option['trans_switcher'] == "on"){ _e('Last Name :','Media News');}else{ echo $px_theme_option['trans_lastname']; }?>" />
	
						</label>
	
						<?php }?>
	
							<input type="hidden" name="ns_mc_number" value="<?php echo $this->number; ?>" />
							 <label>
								<?php if(isset($instance['description']) && $instance['description'] <> ''){echo html_entity_decode($instance['description']);}?>
							</label>
							<label class="pix-newsletter">
								<input id="<?php echo $this->id_base; ?>-email-<?php echo $this->number; ?>" type="text" name="<?php echo $this->id_base; ?>_email" value="<?php if(isset($instance['email_text']) && $instance['email_text'] <> ''){echo html_entity_decode($instance['email_text']);} else {_e('Enter Your Email','');};?>"/>
							</label>
							<label>
								<?php if(!isset($instance['signup_text'])){ $instance['signup_text'] = 'Submit';}?>
								<input type="submit" name="<?php echo $instance['signup_text']; ?>" class="btn cs-bgcolr" value="<?php echo $instance['signup_text']; ?>">
							</label>
						   
							<!--<button class="btn cs-bgcolr" name="<?php echo $instance['signup_text']; ?>"><?php echo $instance['signup_text']; ?></button>-->
	
						</form>
	
	
							<script type="text/javascript">
	
								jQuery(document).ready(function(){
	
									px_mailchimp_add_scripts ();
	
									jQuery('#<?php echo $this->id_base; ?>_form-<?php echo $this->number; ?>').ns_mc_widget({"url" : "<?php echo $_SERVER['PHP_SELF']; ?>", "cookie_id" : "<?php echo $this->id_base; ?>-<?php echo $this->number; ?>", "cookie_value" : "<?php //echo $this->hash_mailing_list_id(); ?>", "loader_graphic" : "<?php //echo $this->default_loader_graphic; ?>"});
	
								});
	
							 </script>
	
					<?php
	
				
	
				echo $after_widget;
	
			
	
			
	
		}
	
		
	
		/**
	
		 * @author James Lafferty
	
		 * @since 0.1
	
		 */
	
		
	
		private function hash_mailing_list_id () {
	
			
	
			$options = get_option($this->option_name);
	
			
	
			$hash = md5($options[$this->number]['current_mailing_list']);
	
			
	
			return $hash;
	
			
	
		}
	
		
	
		/**
	
		 * @author James Lafferty
	
		 * @since 0.1
	
		 */
	
		
	
		private function get_current_mailing_list_id ($number = null) {
	
			
	
			$options = get_option($this->option_name);
	
			
	
			return $options[$number]['current_mailing_list'];
	
			
	
		}
	
		
	
		/**
	
		 * @author James Lafferty
	
		 * @since 0.5
	
		 */
	
		
	
		private function get_failure_message ($number = null) {
	
			
	
			$options = get_option($this->option_name);
	
			return __('There was a problem processing your submission.', 'Media News');
	
			//return $options[$number]['failure_message'];
	
			
	
		}
	
		
	
		/**
	
		 * @author James Lafferty
	
		 * @since 0.5
	
		 */
	
		
	
		private function get_success_message ($number = null) {
	
			
	
			$options = get_option($this->option_name);
	
			
	
			return $options[$number]['success_message'];
	
			
	
		}
	
	}


// Social Meida Followers Widget

	class px_social_meida_followers_widget extends WP_Widget{
		function px_social_meida_followers_widget()	{
			$widget_ops = array('classname' => 'px_social_meida_followers', 'description' => 'Social Media Followers Widget.' );
			$this->WP_Widget('px_social_meida_followers_widget', 'PX : Social Media Followers Widget', $widget_ops);
		}
		function form($instance){
				global $px_theme_option;
				$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
				$title = $instance['title'];
				$facebook_page_url = isset( $instance['facebook_page_url'] ) ? esc_attr( $instance['facebook_page_url'] ) : '';
				$facebook_text = isset( $instance['facebook_text'] ) ? esc_attr( $instance['facebook_text'] ) : 'Facebook Fans';	
				$twitter_text = isset( $instance['twitter_text'] ) ? esc_attr( $instance['twitter_text'] ) : 'Twitter Followers';
				$twitter_username = isset( $instance['twitter_username'] ) ? esc_attr( $instance['twitter_username'] ) : '';
				$googleplus_text = isset( $instance['googleplus_text'] ) ? esc_attr( $instance['googleplus_text'] ) : 'Google+ Followers';
				$googleplus_id = isset( $instance['googleplus_id'] ) ? esc_attr( $instance['googleplus_id'] ) : '';
				
				$youtube_text = isset( $instance['youtube_text'] ) ? esc_attr( $instance['youtube_text'] ) : 'Youtube Followers';
				$youtube_id = isset( $instance['youtube_id'] ) ? esc_attr( $instance['youtube_id'] ) : '';
				
				$vimeo_text = isset( $instance['vimeo_text'] ) ? esc_attr( $instance['vimeo_text'] ) : 'vimeo Followers';
				$vimeo_id = isset( $instance['vimeo_id'] ) ? esc_attr( $instance['vimeo_id'] ) : '';
				
				$dribble_text = isset( $instance['dribble_text'] ) ? esc_attr( $instance['dribble_text'] ) : 'Dribble Followers';
				$dribble_id = isset( $instance['dribble_id'] ) ? esc_attr( $instance['dribble_id'] ) : '';
				
				$consumer_key = $consumer_secret = $access_token = $access_token_secret = '';
				if(isset($px_theme_option['consumer_key']))
					$consumer_key= $px_theme_option['consumer_key'];
				if(isset($px_theme_option['consumer_secret']))
					$consumer_secret= $px_theme_option['consumer_secret'];
				if(isset($px_theme_option['access_token']))
					$access_token= $px_theme_option['access_token'];
				if(isset($px_theme_option['consumer_secret']))
					$access_token_secret= $px_theme_option['access_token_secret'];
				
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> Widget Title:
					<input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" 
					name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('facebook_text'); ?>"> Facebook Text:
					<input class="upcoming" id="<?php echo $this->get_field_id('facebook_text'); ?>" size="40" 
					name="<?php echo $this->get_field_name('facebook_text'); ?>" type="text" value="<?php echo esc_attr($facebook_text); ?>" />
				</label>
			</p>
			 <p>
				<label for="<?php echo $this->get_field_id('facebook_page_url'); ?>"> Facebook Page ID:
					<input class="upcoming" id="<?php echo $this->get_field_id('facebook_page_url'); ?>" size="40" 
					name="<?php echo $this->get_field_name('facebook_page_url'); ?>" type="text" value="<?php echo esc_attr($facebook_page_url); ?>" />
					
				</label>
				<div class="example">Example: envato</div>
			</p>
			
			<?php 
			 if(!empty($consumer_key) && !empty($consumer_secret) && !empty($access_token) && !empty($access_token_secret) ){ 
				echo $notice = __('You\'ll need to set up the Twitter API Setting options before using it. ', 'Media News') . __('You can make your changes', 'Media News') . ' <a href="' . get_admin_url() . 'themes.php?page=px_theme_options#tab-api-key-show">' . __('here', 'Media News') . '.</a>';
			 }
			?>
			
			 <p>
				<label for="<?php echo $this->get_field_id('twitter_text'); ?>"> Twitter Text:
					<input class="upcoming" id="<?php echo $this->get_field_id('twitter_text'); ?>" size="40" 
					name="<?php echo $this->get_field_name('twitter_text'); ?>" type="text" value="<?php echo esc_attr($twitter_text); ?>" />
				</label>
			</p>
			 <p>
				<label for="<?php echo $this->get_field_id('twitter_username'); ?>"> Twitter Username:
					<input class="upcoming" id="<?php echo $this->get_field_id('twitter_username'); ?>" size="40" 
					name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo esc_attr($twitter_username); ?>" />
					
				</label>
				<div class="example">Example: @envato</div>
			</p>
			
			 <p>
				<label for="<?php echo $this->get_field_id('googleplus_text'); ?>"> Google+ Text:
					<input class="upcoming" id="<?php echo $this->get_field_id('googleplus_text'); ?>" size="40" 
					name="<?php echo $this->get_field_name('googleplus_text'); ?>" type="text" value="<?php echo esc_attr($googleplus_text); ?>" />
					
				</label>
			</p>
			 <p>
				<label for="<?php echo $this->get_field_id('googleplus_id'); ?>"> Google Page ID:
					<input class="upcoming" id="<?php echo $this->get_field_id('googleplus_id'); ?>" size="40" 
					name="<?php echo $this->get_field_name('googleplus_id'); ?>" type="text" value="<?php echo esc_attr($googleplus_id); ?>" />
					
				</label>
				<div class="example">Example: +envato or 105599180788269156461</div>
			</p>
			
			 <p>
				<label for="<?php echo $this->get_field_id('youtube_text'); ?>"> Youtube Text:
					<input class="upcoming" id="<?php echo $this->get_field_id('youtube_text'); ?>" size="40" 
					name="<?php echo $this->get_field_name('youtube_text'); ?>" type="text" value="<?php echo esc_attr($youtube_text); ?>" />
					
				</label>
			</p>
			 <p>
				<label for="<?php echo $this->get_field_id('youtube_id'); ?>"> Youtube Channel URL:
					<input class="upcoming" id="<?php echo $this->get_field_id('youtube_id'); ?>" size="40" 
					name="<?php echo $this->get_field_name('youtube_id'); ?>" type="text" value="<?php echo esc_attr($youtube_id); ?>" />
					
				</label>
				<div class="example">Example:  http://www.youtube.com/user/username or http://www.youtube.com/channel/channel-name</div>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('vimeo_text'); ?>"> Vimeo Text:
					<input class="upcoming" id="<?php echo $this->get_field_id('vimeo_text'); ?>" size="40" 
					name="<?php echo $this->get_field_name('vimeo_text'); ?>" type="text" value="<?php echo esc_attr($vimeo_text); ?>" />
					
				</label>
			</p>
			 <p>
				<label for="<?php echo $this->get_field_id('vimeo_id'); ?>"> Vimeo Channel URL:
					<input class="upcoming" id="<?php echo $this->get_field_id('vimeo_id'); ?>" size="40" 
					name="<?php echo $this->get_field_name('vimeo_id'); ?>" type="text" value="<?php echo esc_attr($vimeo_id); ?>" />
					
				</label>
				<div class="example">Example: http://vimeo.com/channels/username</div>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('dribble_text'); ?>"> dribbble Text:
					<input class="upcoming" id="<?php echo $this->get_field_id('dribble_text'); ?>" size="40" 
					name="<?php echo $this->get_field_name('dribble_text'); ?>" type="text" value="<?php echo esc_attr($dribble_text); ?>" />
					
				</label>
			</p>
			 <p>
				<label for="<?php echo $this->get_field_id('dribble_id'); ?>"> dribbble Page URL :
					<input class="upcoming" id="<?php echo $this->get_field_id('dribble_id'); ?>" size="40" 
					name="<?php echo $this->get_field_name('dribble_id'); ?>" type="text" value="<?php echo esc_attr($dribble_id); ?>" />
					
				</label>
				<div class="example">Example: http://dribbble.com/username</div>
			</p>
			 
			<?php
			}
			
		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['facebook_text'] = $new_instance['facebook_text'];
			$instance['facebook_page_url'] = $new_instance['facebook_page_url'];
			
			$instance['twitter_text'] = $new_instance['twitter_text'];
			$instance['twitter_username'] = $new_instance['twitter_username'];
			
			$instance['googleplus_text'] = $new_instance['googleplus_text'];
			$instance['googleplus_id'] = $new_instance['googleplus_id'];
			
			$instance['youtube_text'] = $new_instance['youtube_text'];
			$instance['youtube_id'] = $new_instance['youtube_id'];
			
			$instance['vimeo_text'] = $new_instance['vimeo_text'];
			$instance['vimeo_id'] = $new_instance['vimeo_id'];
			
			$instance['dribble_text'] = $new_instance['dribble_text'];
			$instance['dribble_id'] = $new_instance['dribble_id'];
	
			
			
			return $instance;
		}
		
		function widget($args, $instance){
			global $px_theme_option;
			extract($args, EXTR_SKIP);
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
			$facebook_page_url 	= $instance['facebook_page_url'];	
			$facebook_text 	= $instance['facebook_text'];
			
			$twitter_username = $instance['twitter_username'];
			$twitter_text 	= $instance['twitter_text'];
			
			$googleplus_text = $instance['googleplus_text'];
			$googleplus_id 	= $instance['googleplus_id'];
			
			$youtube_text = $instance['youtube_text'];
			$youtube_id 	= $instance['youtube_id'];
			
			$vimeo_text = $instance['vimeo_text'];
			$vimeo_id 	= $instance['vimeo_id'];
			
			$dribble_text = $instance['dribble_text'];
			$dribble_id 	= $instance['dribble_id'];
			px_enqueue_count_nos();
			/*for twitter*/
			$consumer_key = $consumer_secret = $access_token = $access_token_secret = '';
			if(isset($px_theme_option['consumer_key']))
				$consumer_key 			= $px_theme_option['consumer_key'];
			if(isset($px_theme_option['consumer_secret']))
				$consumer_secret 		= $px_theme_option['consumer_secret'];
			if(isset($px_theme_option['access_token']))
				$access_token 		= $px_theme_option['access_token'];
			if(isset($px_theme_option['consumer_secret']))
				$access_token_secret 		= $px_theme_option['access_token_secret'];
			echo $before_widget;	
			if (!empty($title) && $title <> ' '){
				echo $before_title;
				echo $title;
				echo $after_title;
			}
			?>     
			<script>
				jQuery(document).ready(function($) {
					px_counter_view();
				});
			</script>   
				<ul class="px-social-followers">   
					<?php if(function_exists('curl_init') && !empty($facebook_page_url)){
							$facbook_count = px_facebook_like_count($facebook_page_url);
						 ?>               
						<li style="background-color: #4c66a3;">
							<i class="fa fa-facebook"></i>
							<a href="https://facebook.com/<?php echo $facebook_page_url; ?>" target="_blank"  class="px-time-counter" data-from="0" data-to="<?php echo $facbook_count;?>" data-speed="1000"></a>
												
							<p><?php echo $facebook_text; ?></p>
						</li>
					<?php } ?>
					<?php if(!empty($twitter_username) && !empty($consumer_key) && !empty($consumer_secret) && !empty($access_token) && !empty($access_token_secret) ){
								$twitter_count = px_twitter_count($twitter_username, $consumer_key, $consumer_secret, $access_token, $access_token_secret);
						
						 ?>
						<li style="background-color: #2fc2ee;">
							<i class="fa fa-twitter"></i>
							<a href="https://twitter.com/<?php echo $twitter_username; ?>" target="_blank"  class="px-time-counter" data-from="0" data-to="<?php echo $twitter_count;?>" data-speed="1000"></a>
							<p><?php echo $twitter_text; ?></p>
						</li>
					<?php } ?>
					<?php if(function_exists('file_get_contents') && !empty($googleplus_id)){
							$gplus_count = px_google_plus_count($googleplus_id);
						?> 
						<li style="background-color: #de1935;">
							<i class="fa fa-google-plus"></i>
							<a href="https://plus.google.com/<?php echo $googleplus_id; ?>/posts" target="_blank" class="px-time-counter" data-from="0" data-to="<?php echo $gplus_count;?>" data-speed="1000"></a>
							<p><?php echo $googleplus_text; ?></p>
						</li>
					<?php } ?>
					
					<?php 
					if(isset($youtube_id) && !empty($youtube_id)){
						$youtube = px_youtube_subscriptions( $youtube_id );
						?> 
						<li style="background-color: #cd181f;">
							<i class="fa fa-youtube"></i>
							<a href="<?php echo $youtube_id; ?>" target="_blank" class="px-time-counter" data-from="0" data-to="<?php echo $youtube; ?>" data-speed="1000"></a>
							<p><?php echo $youtube_text; ?></p>
						</li>
					<?php } ?>
					
					<?php if(isset($vimeo_id) && !empty($vimeo_id)){
							$vimeo = px_vimeo_count( $vimeo_id );
						?> 
						<li style="background-color: #17b2e8;">
							<i class="fa fa-vimeo-square"></i>
							<a href="<?php echo $vimeo_id; ?>" target="_blank" class="px-time-counter" data-from="0" data-to="<?php echo $vimeo; ?>" data-speed="1000"></a>
							<p><?php echo $vimeo_text; ?></p>
						</li>
					<?php } ?>
					
					<?php if(isset($dribble_id) && !empty($dribble_id)){
							$dribble = px_dribble_count( $dribble_id );
						?> 
						<li style="background-color: #ea4c89;">
							<i class="fa fa-dribbble"></i>
							<a href="<?php echo $dribble_id; ?>" target="_blank" class="px-time-counter" data-from="0" data-to="<?php echo $dribble;?>" data-speed="1000"></a>
							<p><?php echo $dribble_text; ?></p>
						</li>
					<?php } ?>
				</ul>
		<?php
			echo $after_widget;
		}	
		
	}

// Facebook Count	

	function px_facebook_like_count($page_link){
			$fb_count = '';
			$transName = 'px_facebook_count';
			$cacheTime = 60*60*2;
			$fb_count = get_transient($transName);
			
			if(isset($page_link) && $page_link <> ''){
			
				$url = str_replace('https://www.facebook.com/', '', $page_link);
			
				 $curl_url = 'https://graph.facebook.com/' . $url;
				try{
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $curl_url);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($ch);
					$results = json_decode($result, true);
					
					curl_close($ch);
				
					if(isset($results) && array_key_exists( 'error', $results)){
						$px_facebook_message = 'Error - '.$results['error']['message'];
						if(isset($fb_count) && $fb_count <> ''){
							return $fb_count;	
						} else {
							$px_facebook_message = $e->getMessage();
						}
					} else{
							if(isset($results['likes'])){
								set_transient($transName, (int)$results['likes'], $cacheTime);
								return (int)$results['likes'];
							}
					}
				} catch( Exception $e){
					if(isset($fb_count) && $fb_count <> ''){
						
						return $fb_count;	
					} else {
						$px_facebook_message = $e->getMessage();
					}
					
				} 
			} else if(isset($fb_count) && $fb_count <> '') {
				return $fb_count;
			}
	
	}

	
// Twitter Count	

	function px_twitter_count($twitter_id, $consumer_key, $consumer_secret, $access_token, $access_token_secret ){
		$twitter_id = $twitter_id;		
		$consumer_key = $consumer_key;
		$consumer_secret = $consumer_secret;
		$access_token = $access_token;
		$access_token_secret = $access_token_secret;
		$count = 0;
		if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret) {
			$transName = 'px_twitter_followrs_count';
			$cacheTime = 60*60*5;
			delete_transient($transName);
			if(false === ($twitterData = get_transient($transName))) {
				 @require_once 'twitteroauth/twitteroauth.php';
				 $twitterConnection = new TwitterOAuth(
								$consumer_key,		 // Consumer Key
								$consumer_secret,    // Consumer secret
								$access_token,       // Access token
								$access_token_secret // Access token secret
								);
				$twitterData = $twitterConnection->get(
								  'statuses/user_timeline',
								  array(
									'screen_name'     => $twitter_id,
									'count'           => $count,
									'exclude_replies' => false
								  )
								);
				 if($twitterConnection->http_code != 200)
				 {
					  $twitterData = get_transient($transName);
				 }
		
				 // Save our new transient.
				 set_transient($transName, $twitterData, $cacheTime);
			};
			
			$twitter = get_transient($transName);
			
			if($twitter && is_array($twitter)) {
				$count = $twitter[0]->user->followers_count;
				return $count;
			 }
			 
		}
	}


// Google Plus Count

	function px_google_plus_count($googleplus_id){
			$google_count = get_transient('px_googleplus_count');
			
			if(isset($googleplus_id) && $googleplus_id <> ''){
				 $count = 0;
				 
				 $data = file_get_contents('https://plus.google.com/'.$googleplus_id.'/posts');
			
			   if (is_wp_error($data)) {
						
					return $google_count;
			   } else {
				  
					 if (preg_match('/>([0-9,]+) people</i', $data, $matches)) {
							$results =  str_replace(',', '', $matches[1]);
					}
					if ( isset ( $results ) && !empty ( $results ) )
					{					
						$google_count = $results;
						set_transient('px_googleplus_count', $results, 60*60*1);
					}
					return $google_count;
				}
			} else if(isset($google_count) && $google_count <> '') {
				
				return $google_count;
			}
	}


// Youtube Subscribers

	function px_youtube_subscriptions( $channel_id){
		$youtube_link = parse_url($channel_id);
		$subscriptions = 0;
		if(isset($youtube_link['host']) && $youtube_link['host'] <> ''){
			if( $youtube_link['host'] == 'www.youtube.com' || $youtube_link['host']  == 'youtube.com' ){
				$subscriptions = get_transient('youtube_count');
					try {
						if (strpos( strtolower($channel_id) , "channel") === false)
							$youtube_name = str_replace('/user/','',$youtube_link['path'] );	
						else
							$youtube_name = str_replace('/channel/','',$youtube_link['path'] );	
		
						$json = file_get_contents("http://gdata.youtube.com/feeds/api/users/".$youtube_name."?alt=json");
						$data = json_decode($json, true); 
						
						$subscriptions = $data['entry']['yt$statistics']['subscriberCount']; 
						if( !empty($subscriptions) ){
							set_transient( 'youtube_count' , $subs , 1200);
						}
							
					} catch (Exception $e) {
						$subscriptions = get_transient('youtube_count');
					}
		
				return $subscriptions;
			}
		}
	}


// Vimeo Subscribers

	function px_vimeo_count( $page_link ) {
		$vimeo_link = parse_url($page_link);
		$vimeo = 0;
		if(isset($vimeo_link['host']) && $vimeo_link['host'] <> ''){
			if( $vimeo_link['host'] == 'www.vimeo.com' || $vimeo_link['host']  == 'vimeo.com' ){
					try {
						$page_name = str_replace('/channels/','',$vimeo_link['path'] );	
						$data = json_decode(file_get_contents( 'http://vimeo.com/api/v2/channel/' . $page_name  .'/info.json'));
						$vimeo = $data->total_subscribers;
						if( !empty($vimeo) && is_int($vimeo) ){
							set_transient( 'vimeo_count' , $vimeo , 1200);
						}
					} catch (Exception $e) {
						$vimeo = get_transient('vimeo_count');
					}
				return $vimeo;
			}
		}
	}


// Dribble Subscribers

	function px_dribble_count( $profile_link ) {
		$dribbble_link = @parse_url($profile_link);
		$dribbble = 0;
		if(isset($dribbble_link['host']) && $dribbble_link['host'] <> ''){
			if( $dribbble_link['host'] == 'www.dribbble.com' || $dribbble_link['host']  == 'dribbble.com' ){
				try {
					$page_name = str_replace('/','',$dribbble_link['path'] );	
					@$data = @json_decode(file_get_contents( 'http://api.dribbble.com/' . $page_name));
					$dribbble = $data->followers_count;
					if( !empty($dribbble) ){
						set_transient( 'dribbble_count' , $dribbble , 1200);
					}
				} catch (Exception $e) {
					$dribbble = get_transient('dribbble_count');
				}
				return $dribbble;
			}
		}
	}


// Reviews Shortcode

	function px_reviews_shortcode($atts, $content = "") {
		global $post,$px_theme_option;
		$review_shortcode = '';
		 $html = '';
		if (isset($post->ID) && $post->ID <> ''){
			 if($px_theme_option["trans_switcher"] == "on") { $user_rating = __("User Rating",'Media News'); }else{  $user_rating = $px_theme_option["trans_user_rating"];}
			$no = $post->ID;
			$width = 500;
			$height = 370;
			$image_url_small = px_get_post_img_src($post->ID, $width, $height);
			$summry_class = '';
			$post_xml = get_post_meta($post->ID, "post", true);	
			if ( $post_xml <> "" ) {
				$px_xmlObject = new SimpleXMLElement($post_xml);
				if(isset($px_xmlObject->var_pb_post_review) && $px_xmlObject->var_pb_post_review == 'on') {
				px_enqueue_rating_style_script();
				if($px_xmlObject->var_pb_review_section_title <> '' && isset($px_xmlObject->var_pb_review_title_position) && $px_xmlObject->var_pb_review_title_position == 'outside') {
					$review_shortcode .= '<header class="pix-heading-title">
						<h2 class="pix-section-title">'.$px_xmlObject->var_pb_review_section_title.'</h2>
					</header>';
				  }
				  if(!isset($px_xmlObject->var_pb_review_summery) || $px_xmlObject->var_pb_review_summery == ''){$summry_class = 'no-summary';}
				  $review_shortcode .= '<div class="blog-rating-sec '.$summry_class.'">';
				  $review_shortcode .= '<figure>';
				   $review_shortcode .= '<figcaption>';
				   $review_shortcode .= px_user_box_rating_display();
				   $rating_value = get_post_meta($post->ID, "rating_value", true);
					if($rating_value == ''){
					 $rating_value = 0;
					}
					$review_shortcode .= ' <div class="stars">
						<script type="text/javascript">
									  jQuery(document).ready(function(){
											jQuery(".basic ").jRating({
													bigStarsPath : "'.get_template_directory_uri().'/images/stars.png", // path of the icon stars.png
													smallStarsPath : "'.get_template_directory_uri().'/images/small.png", // path of the icon small.png
													phpPath : "' .get_template_directory_uri().'/include/review_save.php?id='.$post->ID.'", // path of the php file jRating.php
													rateMax : 10,
													length : 5
											});
									  });
								</script>';
					$review_shortcode .= '<div class="rating-desc">
								<div class="rating-inn">';	
					$review_shortcode .= '
									<div id="rating_saved">
										<div class="heading-color cs-rating-heading">';
						$rating = px_user_rating();
						$rating_point = $rating*10;
					if ( isset($_COOKIE["rating_vote_counter".$post->ID ]) ){$already_rated = "jDisabled"; }
					$review_shortcode .= $rating;
											if ( get_post_meta(get_the_id(), "rating_vote_counter", true) > 0 ) {
												$rating_vote_counter = get_post_meta(get_the_id(), "rating_vote_counter", true);
											} else {
												$rating_vote_counter = 0;
											}
											$review_shortcode .=  " ( " . $rating_vote_counter . " Votes )";
				   $review_shortcode .= '</div>
								</div>';
				  $review_shortcode .= '<div id="rating_loading" style="display:none"><i class="fa fa-spinner fa-spin fa-1x"></i></div>';
				  $review_shortcode .= '<div class="px-star-rating basic '.$rating.'" data="'.$rating.'"><span style="width:'.$rating_point.'%"></span></div>';
				 
				   $review_shortcode .= '</div></div>
					  </div>';
				 $review_shortcode .= '</figcaption>
							</figure>';
			if(isset($px_xmlObject->var_pb_review_summery) && $px_xmlObject->var_pb_review_summery <> '' || isset($px_xmlObject->reviews)){
				$review_shortcode .= '<div class="text">';
					if($px_xmlObject->var_pb_review_section_title <> '' && isset($px_xmlObject->var_pb_review_title_position) && $px_xmlObject->var_pb_review_title_position == 'inside') {
						$review_shortcode .= '<header class="pix-heading-title">
							<h2 class="pix-section-title">'.$px_xmlObject->var_pb_review_section_title.'</h2>
						</header>';
					  }
					if(isset($px_xmlObject->reviews)) {
						$review_shortcode .= '<script type="text/javascript">
							jQuery(document).ready(function(){
								px_skills_shortcode_script();
								jQuery("[data-loadbar]").each(function(index){
									var d =jQuery(this) .attr("data-loadbar");
									jQuery(this).css({"color":"yellow"});
								});
							});
							</script>';
							if(isset($px_xmlObject->var_pb_review_summery) && $px_xmlObject->var_pb_review_summery <> '' || isset($px_xmlObject->reviews)){
								$review_shortcode .= '<div class="skills">
								<div class="progress_bar">';
								foreach($px_xmlObject->reviews as $reviews){ $color_value = cs_criteria_color_check($reviews->var_pb_review_points);
									$review_shortcode .= '<div data-loadbar-text="'.$reviews->var_pb_review_points.'" data-loadbar="'.round($reviews->var_pb_review_points*10).'" class="tiny-green">';
										if($reviews->var_pb_review_title <> ''){
											$review_shortcode .= '<p>'.$reviews->var_pb_review_title.'</p>';
											 }
										$review_shortcode .= '<div style="background-color:'.$color_value.';"></div>';
										if($reviews->var_pb_review_points <> ''){
											$review_shortcode .= '<span class="infotxt">'.round($reviews->var_pb_review_points*10).'</span>';
										 }
									$review_shortcode .= '</div>';
									}
								$review_shortcode .= '</div>
							</div>';
							}
							
					}
					if(isset($px_xmlObject->var_pb_review_summery) && $px_xmlObject->var_pb_review_summery <> ''){
						 $review_shortcode .= '<div class="review-summary">'.$px_xmlObject->var_pb_review_summery.'</div>';
					}
				$review_shortcode .= '</div>';	
			}
			$review_shortcode .= '</div>';	
			$html = '<div class="px-review-section medium-review">'.$review_shortcode.'</div>';
			}
		 }
		}
		return do_shortcode(htmlspecialchars_decode($html));
	}
	add_shortcode('reviews', 'px_reviews_shortcode');