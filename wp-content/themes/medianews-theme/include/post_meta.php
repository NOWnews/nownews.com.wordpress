<?php
if ( ! function_exists( 'px_meta_post_add' ) ) {
	add_action( 'add_meta_boxes', 'px_meta_post_add' );
}
if ( ! function_exists( 'px_meta_post' ) ) {
	function px_meta_post_add()
	{  
		add_meta_box( 'px_meta_post', 'Post Options', 'px_meta_post', 'post', 'normal', 'high' );  
	}
}
if ( ! function_exists( 'px_meta_post' ) ) {
	function px_meta_post( $post ) {
		$post_xml = get_post_meta($post->ID, "post", true);
		global $px_xmlObject;
		if ( $post_xml <> "" ) {
			$px_xmlObject = new SimpleXMLElement($post_xml);
			
				$inside_post_thumb_view = $px_xmlObject->inside_post_thumb_view;
				$inside_post_featured_image_as_thumbnail = $px_xmlObject->inside_post_featured_image_as_thumbnail;
				$inside_post_thumb_audio = $px_xmlObject->inside_post_thumb_audio;
				$inside_post_thumb_video = $px_xmlObject->inside_post_thumb_video;
				$inside_post_thumb_slider = $px_xmlObject->inside_post_thumb_slider;
				$inside_post_thumb_slider_type = $px_xmlObject->inside_post_thumb_slider_type;
				$var_pb_post_author = $px_xmlObject->var_pb_post_author;
				$var_pb_review_section_title = $px_xmlObject->var_pb_review_section_title;
				$var_pb_review_title_position = $px_xmlObject->var_pb_review_title_position;
				$var_pb_review_section_position = $px_xmlObject->var_pb_review_section_position;
				$var_pb_post_social_sharing = $px_xmlObject->var_pb_post_social_sharing;
				$var_pb_post_attachment = $px_xmlObject->var_pb_post_attachment;
				$var_pb_post_attachment_title = $px_xmlObject->var_pb_post_attachment_title;
				$var_pb_post_featured = $px_xmlObject->var_pb_post_featured;
				$var_pb_post_review = $px_xmlObject->var_pb_post_review;
				$var_pb_review_summery = $px_xmlObject->var_pb_review_summery;
				$var_pb_post_related = $px_xmlObject->var_pb_post_related;
				$var_pb_post_related_title = $px_xmlObject->var_pb_post_related_title;
				$var_pb_post_advertisement = $px_xmlObject->var_pb_post_advertisement;
		} else {
			
			$inside_post_thumb_view = '';
			$inside_post_featured_image_as_thumbnail = '';
			$inside_post_thumb_audio = '';
			$inside_post_thumb_video = '';
			$inside_post_thumb_slider = '';
			$inside_post_thumb_slider_type = '';
			
			$var_pb_post_social_sharing = '';
			$var_pb_post_author = 'on';
			$var_pb_review_summery = '';
			$var_pb_post_advertisement = '';
			
			$var_pb_post_attachment = 'on';
			$var_pb_post_attachment_title = 'Attachment';
			$var_pb_review_section_position = '';
			$var_pb_review_section_title ='Review Overview';
			$var_pb_review_title_position = '';
			$var_pb_post_review = '';
			$var_pb_post_related = '';
			$var_pb_post_related_title = '';
		}
	?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/select.js"></script>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/admin/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/bootstrap-3.0.js"></script>
		<div class="page-wrap event-meta-section">
			<div class="option-sec row">
				<div class="opt-conts">
					
					
					<ul class="form-elements  on-off-options">
						<!--<li class="to-label"><label>Featured Image</label></li>
						<li class="to-field">
							<label class="cs-on-off">
								<input type="checkbox" name="var_pb_post_featured" value="on" class="myClass" <?php if($var_pb_post_featured == 'on') echo "checked"?> />
								<span></span>
							</label>    
						</li>-->
						<li class="to-label"><label>Social Sharing</label></li>
						<li class="to-field">
							<label class="cs-on-off">
								<input type="checkbox" name="var_pb_post_social_sharing" value="on" class="myClass" <?php if($var_pb_post_social_sharing == 'on') echo "checked"?> />
								<span></span>
							</label>    
						</li>
	
						<li class="to-label"><label>Author Description</label></li>
						<li class="to-field">
							<label class="cs-on-off">
								<input type="checkbox" name="var_pb_post_author" value="on" class="myClass" <?php if($var_pb_post_author=='on')echo "checked"?> />
								<span></span>
							</label>
						</li>
						</ul>
								<ul class="form-elements">
									<li class="to-label"><label>Inside Post Thumbnail View</label></li>
									<li class="to-field">
										<select name="inside_post_thumb_view" class="dropdown" onchange="javascript:new_toggle_inside_post(this.value)">
											<option value="" > Select Inside Post Thumbnail View</option>
											<option <?php if($inside_post_thumb_view=="Single Image")echo "selected";?> >Single Image</option>
											<option <?php if($inside_post_thumb_view=="Audio")echo "selected";?> >Audio</option>
											<option <?php if($inside_post_thumb_view=="Video")echo "selected";?> value="Video">Video/Soundcloud</option>
											<option <?php if($inside_post_thumb_view=="Slider")echo "selected";?> >Slider</option>
										</select>
										<p id="inside_post_thumb_image" style="display:<?php if($inside_post_thumb_view=="Single Image")echo 'inline"';else echo 'none';?>">Use Featured Image as Thumbnail</p>
									</li>
								</ul>
								<ul class="form-elements" id="inside_post_thumb_audio" style="display:<?php if($inside_post_thumb_view=="Audio")echo 'inline"';else echo 'none';?>" >
									<li class="to-label"><label>Audio URL</label></li>
									<li class="to-field">
										<input type="text" id="inside_post_thumb_audio2" name="inside_post_thumb_audio" value="<?php echo htmlspecialchars($inside_post_thumb_audio)?>" class="txtfield" />
										<input type="button" id="inside_post_thumb_audio2" name="inside_post_thumb_audio2" class="uploadfile left" value="Browse"/>
										<p>Enter Specific Audio URL (Youtube, Vimeo and all otheres wordpress supported)</p>
									</li>
								</ul>
								<ul class="form-elements" id="inside_post_thumb_video" style="display:<?php if($inside_post_thumb_view=="Video")echo 'inline"';else echo 'none';?>" >
									<li class="to-label"><label>Use featured image as video thumbnail</label></li>
									<li class="to-field">
										<div class="on-off"><input type="checkbox" name="inside_post_featured_image_as_thumbnail" value="on" class="styled" <?php if($inside_post_featured_image_as_thumbnail=='on')echo "checked"?> /></div>
										<p>It will work only for self hosted video</p>
									</li>
									<li class="full">&nbsp;</li>
									<li class="to-label"><label>Thumbnail Video URL</label></li>
									<li class="to-field">
										<input id="inside_post_thumb_video2" name="inside_post_thumb_video" value="<?php echo $inside_post_thumb_video?>" type="text" class="small" />
										<input id="inside_post_thumb_video2" name="inside_post_thumb_video2" type="button" class="uploadfile left" value="Browse"/>
										<p>Enter Specific Video URL (Youtube, Vimeo and all otheres wordpress supported) OR you can select it from your media library</p>
									</li>
								</ul>
								<ul class="form-elements" id="inside_post_thumb_slider" style="display:<?php if($inside_post_thumb_view=="Slider")echo 'inline"';else echo 'none';?>" >
									<li class="to-label"><label>Select Slider</label></li>
									<li class="to-field">
										<select name="inside_post_thumb_slider" class="dropdown">
											<option value="0">-- Select Slider --</option>
											<?php
												$query = array( 'posts_per_page' => '-1', 'post_type' => 'px_gallery', 'orderby'=>'ID', 'post_status' => 'publish' );
												$wp_query = new WP_Query($query);
												while ($wp_query->have_posts()) : $wp_query->the_post();
											?>
												<option <?php if(get_the_ID()==$inside_post_thumb_slider)echo "selected";?> value="<?php the_ID()?>"><?php the_title()?></option>
											<?php
												endwhile;
											?>
										</select>
									</li>
									<li class="full">&nbsp;</li>
								</ul>
						<ul class="form-elements">
							 <li class="to-label"><label>Attachment</label></li>
							<li class="to-field">
								<label class="cs-on-off">
									<input type="checkbox" name="var_pb_post_attachment" value="on" class="myClass" <?php if($var_pb_post_attachment=='on')echo "checked"?> />
									<span></span>
								</label>
							</li>
							<li class="to-label"><label>Attachment title</label></li>
							<li class="to-field">
									<input type="text" name="var_pb_post_attachment_title" value="<?php echo $var_pb_post_attachment_title;?>" />
							</li>
						</ul>
						
						<ul class="form-elements">
							 <li class="to-label"><label>Related Post</label></li>
							<li class="to-field">
								<label class="cs-on-off">
									<input type="checkbox" name="var_pb_post_related" value="on" class="myClass" <?php if($var_pb_post_related=='on')echo "checked"?> />
									<span></span>
								</label>
							</li>
							<li class="to-label"><label>Related Post title</label></li>
							<li class="to-field">
							   
									<input type="text" name="var_pb_post_related_title" value="<?php echo $var_pb_post_related_title;?>" />
								
							</li>
						</ul>
						
						<ul class="form-elements">
						   
							<li class="to-label"><label>Advertisement</label></li>
							<li class="to-field">
									<textarea name="var_pb_post_advertisement" rows="4" cols="20"><?php echo $var_pb_post_advertisement;?></textarea>
									<p> Insert advertisement Shortcode. You can create Adverisement from <a href="<?php echo admin_url('themes.php?page=px_theme_options#tab-advertisement-banner-show');?>" target="_blank">here</a>
							</li>
						</ul>
				</div>
			</div>
			 <div class="opt-head">
				<h4 style="padding-top:12px;">Reviews</h4>
				<a href="javascript:openpopedup('add_track')" class="button">Add Review</a>
				<div class="clear"></div>
			</div>
		   <div class="boxes tracklists">
						<div id="add_track" class="poped-up">
							
							<div class="opt-head">
								<h5>Review Settings</h5>
								<a href="javascript:closepopedup('add_track')" class="closeit">&nbsp;</a>
								<div class="clear"></div>
							</div>
							<ul class="form-elements">
								<li class="to-label"><label>Title</label></li>
								<li class="to-field">
									<input type="text" id="var_pb_review_title" name="var_pb_review_title" value="Review Title" />
								</li>
							</ul>
							<ul class="form-elements">
								<li class="to-label"><label>Review Points</label></li>
								<li class="to-field">
									<input type="text" id="var_pb_review_points" name="var_pb_review_points" value="" />
								</li>
							</ul>
							
							<ul class="form-elements noborder">
								<li class="to-label"></li>
								<li class="to-field"><input type="button" value="Add Review to List" onclick="add_review_to_list('<?php echo admin_url()?>', '<?php echo get_template_directory_uri()?>')" /></li>
							</ul>
						</div>
						<script>
							jQuery(document).ready(function($) {
								$("#total_tracks").sortable({
									cancel : 'td div.poped-up',
								});
							});
						</script>
						<ul class="form-elements noborder  on-off-options">
							<li class="to-label"><label>Review</label></li>
							<li class="to-field">
								<label class="cs-on-off">
									<input type="checkbox" name="var_pb_post_review" value="on" class="myClass" <?php if($var_pb_post_review == 'on') echo "checked"?> />
									<span></span>
								</label>    
							</li>
						</ul>
						<ul class="form-elements noborder">
							<li class="to-label"><label>Review Section Title</label></li>
							<li class="to-field">
								<input type="text" id="var_pb_review_section_title" name="var_pb_review_section_title" value="<?php echo $var_pb_review_section_title;?>" />
							</li>
						</ul>
						<ul class="form-elements noborder">
							<li class="to-label"><label>Review Summery</label></li>
							<li class="to-field">
								<textarea name="var_pb_review_summery" id="var_pb_review_summery" rows="5" cols="20"><?php echo $var_pb_review_summery;?></textarea>
							</li>
						</ul>
						 <ul class="form-elements noborder">
							<li class="to-label"><label>Review Title Position</label></li>
							<li class="to-field">
								<select name="var_pb_review_title_position" class="dropdown">
									<option value="outside" <?php if(isset($var_pb_review_title_position) && $var_pb_review_title_position == 'outside') echo 'selected="selected"';?>>Outside</option>
									<option value="inside" <?php if(isset($var_pb_review_title_position) && $var_pb_review_title_position == 'inside') echo 'selected="selected"';?>>Inside</option>
								</select>
							</li>
						</ul>
						<ul class="form-elements noborder">
							<li class="to-label"><label>Review Section Position</label></li>
							<li class="to-field">
								<select name="var_pb_review_section_position" class="dropdown"  onchange="px_blog_reviews_toggle(this.value)">
									<option value="top_left" <?php if(isset($var_pb_review_section_position) && $var_pb_review_section_position == 'top_left') echo 'selected="selected"';?>>Top Left</option>
									<option value="top_right" <?php if(isset($var_pb_review_section_position) && $var_pb_review_section_position == 'top_right') echo 'selected="selected"';?>>Top Right</option>
									<option value="bottom" <?php if(isset($var_pb_review_section_position) && $var_pb_review_section_position == 'bottom') echo 'selected="selected"';?>>Bottom</option>
									<option value="custom" <?php if(isset($var_pb_review_section_position) && $var_pb_review_section_position == 'custom') echo 'selected="selected"';?>>Custom</option>
								</select>
							</li>
						</ul>
						<ul class="form-elements noborder" id="custom-postion"  style="display:<?php if($var_pb_review_section_position == "custom"){echo 'inline-block';}else{ echo 'none';}?>">
							<li class="to-label"><label>Custom Shortcode</label></li>
							<li class="to-field">
								[reviews]
								<p> Please copy and paste this shortcode in editor to display review section</p>
							</li>
						</ul>
						<table class="to-table px-album-table" border="0" cellspacing="0" <?php if($post_xml <> "" && !isset($px_xmlObject) && count($px_xmlObject->reviews)<1){?>style="<?php echo 'display: none';?>" <?php }?>>
							<thead>
								<tr>
									<th style="width:80%;">Review Title</th>
									<th style="width:80%;" class="centr">Actions</th>
								</tr>
							</thead>
							<tbody id="total_tracks">
								<?php
									global $counter_reviews, $var_pb_review_title, $var_pb_review_points;
									$counter_reviews = $post->ID;
									if ( $post_xml <> "" ) {
										foreach ( $px_xmlObject as $review ){
											if ( $review->getName() == "reviews" ) {
												$var_pb_review_title = $review->var_pb_review_title;
												$var_pb_review_points = $review->var_pb_review_points;
												$counter_reviews++;
												px_add_review_to_list();
											}
										}
									}
								?>
							</tbody>
						</table>
					</div>
			<?php meta_layout()?>
			<div class="clear"></div>
			<input type="hidden" name="post_meta_form" value="1" />
		</div>
	<?php
	}
}
	if ( ! function_exists( 'px_meta_post_save' ) ) {
		if ( isset($_POST['post_meta_form']) and $_POST['post_meta_form'] == 1 ) {
			add_action( 'save_post', 'px_meta_post_save' );
			function px_meta_post_save( $post_id ) {
				if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
					if (empty($_POST["var_pb_post_author"])){ $_POST["var_pb_post_author"] = "";}
 					if (empty($_POST["var_pb_post_social_sharing"])){ $_POST["var_pb_post_social_sharing"] = "";}
					if (empty($_POST["var_pb_post_attachment_title"])){ $_POST["var_pb_post_attachment_title"] = "";}
					if (empty($_POST["var_pb_post_attachment"])){ $_POST["var_pb_post_attachment"] = "";}
					if (empty($_POST["var_pb_post_review"])){ $_POST["var_pb_post_review"] = "";}//
					if (empty($_POST["var_pb_review_section_title"])){ $_POST["var_pb_review_section_title"] = "";}
					if (empty($_POST["var_pb_review_title_position"])){ $_POST["var_pb_review_title_position"] = "";}
					if (empty($_POST["var_pb_review_section_position"])){ $_POST["var_pb_review_section_position"] = "";}
					if (empty($_POST["var_pb_post_related"])){ $_POST["var_pb_post_related"] = "";}//var_pb_review_summery
					if (empty($_POST["var_pb_post_related_title"])){ $_POST["var_pb_post_related_title"] = "";}
					if (empty($_POST["var_pb_review_summery"])){ $_POST["var_pb_review_summery"] = "";}
					if (empty($_POST["var_pb_post_advertisement"])){ $_POST["var_pb_post_advertisement"] = "";}
					
					if (empty($_POST["inside_post_thumb_view"])){ $_POST["inside_post_thumb_view"] = "";}
					if (empty($_POST["inside_post_featured_image_as_thumbnail"])){ $_POST["inside_post_featured_image_as_thumbnail"] = "";}
					if (empty($_POST["inside_post_thumb_audio"])){ $_POST["inside_post_thumb_audio"] = "";}
					if (empty($_POST["inside_post_thumb_video"])){ $_POST["inside_post_thumb_video"] = "";}
					if (empty($_POST["inside_post_thumb_slider"])){ $_POST["inside_post_thumb_slider"] = "";}
					if (empty($_POST["inside_post_thumb_slider_type"])){ $_POST["inside_post_thumb_slider_type"] = "";}
					
						$sxe = new SimpleXMLElement("<px_meta_post></px_meta_post>");
						
							$sxe->addChild('var_pb_post_attachment_title', $_POST['var_pb_post_attachment_title'] );
							$sxe->addChild('var_pb_post_attachment', $_POST['var_pb_post_attachment'] );

							$sxe->addChild('var_pb_post_review', $_POST['var_pb_post_review'] );
							$sxe->addChild('var_pb_review_summery', $_POST['var_pb_review_summery'] );
							$sxe->addChild('var_pb_review_section_title', $_POST['var_pb_review_section_title'] );
							$sxe->addChild('var_pb_review_title_position', $_POST['var_pb_review_title_position'] );
							$sxe->addChild('var_pb_review_section_position', $_POST['var_pb_review_section_position'] );
							$sxe->addChild('var_pb_post_author', $_POST['var_pb_post_author'] );
 							$sxe->addChild('var_pb_post_social_sharing', $_POST['var_pb_post_social_sharing'] );
							$sxe->addChild('var_pb_post_related', $_POST['var_pb_post_related'] );
							$sxe->addChild('var_pb_post_related_title', $_POST['var_pb_post_related_title'] );
							$sxe->addChild('var_pb_post_advertisement', $_POST['var_pb_post_advertisement'] );
							
							$sxe->addChild('inside_post_thumb_view', $_POST['inside_post_thumb_view'] );
							$sxe->addChild('inside_post_featured_image_as_thumbnail', $_POST['inside_post_featured_image_as_thumbnail'] );
							$sxe->addChild('inside_post_thumb_audio', $_POST['inside_post_thumb_audio'] );
							$sxe->addChild('inside_post_thumb_video', $_POST['inside_post_thumb_video'] );
							$sxe->addChild('inside_post_thumb_slider', $_POST['inside_post_thumb_slider'] );
							$sxe->addChild('inside_post_thumb_slider_type', $_POST['inside_post_thumb_slider_type'] );
							
 							$sxe = save_layout_xml($sxe);
							$counter = 0;
							if ( isset($_POST['var_pb_review_title']) && is_array($_POST['var_pb_review_title']) ) {
								foreach ( $_POST['var_pb_review_title'] as $count ){
										$track = $sxe->addChild('reviews');
										$track->addChild('var_pb_review_title', htmlspecialchars($_POST['var_pb_review_title'][$counter]) );
										$track->addChild('var_pb_review_points', htmlspecialchars($_POST['var_pb_review_points'][$counter]) );
										$counter++;
								}
							}
				update_post_meta( $post_id, 'post', $sxe->asXML() );
			}
		}
	}
if ( ! function_exists( 'px_extra_category_fields' ) ) {
//add extra fields to team category edit form hook
add_action ( 'category_edit_form_fields', 'px_extra_category_fields');
add_action ( 'category_add_form_fields', 'px_extra_category_fields');
// Add Category Fields
	function px_extra_category_fields( $tag ) { 
		if ( isset($tag->term_id) ) {$t_id = $tag->term_id; }
		else { $t_id = ""; }
		$cat_meta = get_option( "cat_$t_id");
		?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/select.js"></script>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="cat_Icon_url">Mega Menu</label></th>
		<td>
			 <ul class="form-elements  on-off-options">
				<li class="to-field">
					<label class="cs-on-off">
						<input type="checkbox" name="cat_meta[menu]" class="myClass" <?php if($cat_meta['menu'] == 'on') echo "checked"?> />
						<span></span>
					</label>    
					
				</li>
			 </ul>
			
		</td>
		</tr>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="cat_Icon_url">Mega Menu Style</label></th>
		<td>
			<select  name="cat_meta[menu_style]" class="dropdown">
			   <option value="2 Level Links" <?php if(isset($cat_meta['menu_style']) && $cat_meta['menu_style'] == '2 Level Links') echo 'selected="selected"';?>>2 Level Links</option>
				<option value="Category Post" <?php if(isset($cat_meta['menu_style']) && $cat_meta['menu_style'] == 'Category Post') echo 'selected="selected"';?>>Category Post</option>
			</select>
		</td>
		</tr>
		<?php
}
}
if ( ! function_exists( 'px_save_extra_post_category_fileds' ) ) {
// save team category extra fields hook
	add_action ( 'create_category', 'px_save_extra_post_category_fileds');
	add_action ( 'edited_category', 'px_save_extra_post_category_fileds');
	   // save extra category extra fields callback function
	function px_save_extra_post_category_fileds( $term_id ) {
		if ( isset( $_POST['cat_meta'] ) ) {
			$t_id = $term_id;
			$cat_meta = get_option( "cat_$t_id");
			
			
			$cat_meta['menu_style'] = $_POST['cat_meta']['menu_style'];
			
			if(!isset($_POST['cat_meta']['menu']) || $_POST['cat_meta']['menu'] <> 'on'){
				$cat_meta['menu'] = 'off';
			} else {
				$cat_meta['menu'] = 'on';
			}
			update_option( "cat_$t_id", $cat_meta );
		}
	}
}
	
?>