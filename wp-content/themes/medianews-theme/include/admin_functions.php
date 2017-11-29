<?php
// element setting options
if ( ! function_exists( 'px_element_setting' ) ) {
	function px_element_setting($name,$px_counter,$element_size){
		?>
		<div class="column-in">
			<h5>
				<?php 
					 $element_title = str_replace("px_pb_","",$name);
					echo ucfirst($element_title);
				?>
			</h5>
			<input type="hidden" name="<?php echo $element_title; ?>_element_size[]" class="item" value="<?php echo $element_size; ?>" >
			<a class="decrement fa fa-minus" onclick="javascript:decrement(this)"></a> &nbsp; 
			<a class="increment fa fa-plus" onclick="javascript:increment(this)"></a> &nbsp;
			<a href="#" class="delete-it btndeleteit fa fa-trash-o"></a> &nbsp; 
			<a href="javascript:hide_all('<?php echo $name.$px_counter?>')" class="options fa fa-pencil"></a>
		</div>
	   <?php
	}
}

// add twitter option in user profile
if ( ! function_exists( 'px_contact_options' ) ) {
	function px_contact_options( $contactoptions ) {
	
	 $contactoptions['twitter'] = 'Twitter';
	 $contactoptions['facebook'] = 'Facebook';
	 $contactoptions['googleplus'] = 'Google Plus';
	 $contactoptions['linkedin'] = 'Linked in';
	 $contactoptions['flicker'] = 'Flicker';
	
	 return $contactoptions;
	
	}
}
/* add banner ads*/
if ( ! function_exists( 'add_banner_ad' ) ) {
function add_banner_ad(){
    $template_path = get_template_directory_uri() . '/scripts/admin/media_upload.js';
    wp_enqueue_script('my-upload2', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
	$fontimg = '';
	if($_POST['banner_image_url'] <> ''){
	
		$fontimg = '<td><img width="50" src="' .$_POST['banner_image_url']. '"></td> ';
	}
	
	echo '<tr id="del_' .$_POST['counter_banners'].'"> 
		<td>' .$_POST['banner_title_input']. '</td> 
		'.$fontimg.' 
		<td></td> 
		<td class="centr"> 
			<a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del('.$_POST['counter_banners'].')"><i class="fa fa fa-times"></i></a> 
			| <a href="javascript:px_toggle('.$_POST['counter_banners'].')"><i class="fa fa-edit"></i></a>
		</td> 
	</tr> 
	<tr id="'.$_POST['counter_banners'].'" style="display:none"> 
		<td colspan="3"> 
			<span class="theme-wrap"><a onclick="px_toggle('. $_POST['counter_banners'] .')"><img src="'.get_template_directory_uri().'/images/admin/close-red.png"></a></span>
			<ul class="form-elements">
				
				<li class="to-label"><label>Title</label></li>
				<li class="to-field">
				  <input class="small" type="text" id="banner_title_input" name="banner_title_input[]" value="'.$_POST['banner_title_input'].'" style="width:420px;" />
				</li>';
				?>
                	<li class="full">&nbsp;</li>
                     <li class="to-label">
                        <label>Banner Type</label>
                      </li>
                      <li class="to-field">
                        <select name="banner_type_input[]" id="banner_type_input">
                            <option value="top_banner" <?php if($_POST['banner_type_input'] == 'top_banner') echo 'selected="selected"';?>)>Top Banner</option>
                            <option value="bottom_banner" <?php if($_POST['banner_type_input'] == 'bottom_banner') echo 'selected="selected"';?>>Bottom Banner</option>
                            <option value="sidebar_banner" <?php if($_POST['banner_type_input'] == 'sidebar_banner') echo 'selected="selected"';?>>Sidebar Banner</option>
                            <option value="vertical_banner" <?php if($_POST['banner_type_input'] == 'vertical_banner') echo 'selected="selected"';?>>Vertical Banner</option>
                        </select>
                      </li>
                
                <?php
				
				echo '<li class="full">&nbsp;</li>
				<li class="to-label"><label>Banner Type</label></li>
				<li class="to-field">
				  <input class="small" type="text" id="banner_type_input" name="banner_type_input[]" value="'.$_POST['banner_type_input'].'" style="width:420px;" />
				</li>
				<li class="full">&nbsp;</li>
				<li class="to-label"><label>Image Path</label></li>
				<li class="to-field">
				  <input id="banner_image_url'.$_POST['banner_image_url'].'" name="banner_image_url[]" value="'.$_POST['banner_image_url'].'" type="text" class="small" /> 
				</li>
				
				<li class="full">&nbsp;</li>
				<li class="to-label"><label>Banner URL</label></li>
				<li class="to-field">
				  <input class="small" type="text" id="banner_url_input" name="banner_url_input[]" value="'.$_POST['banner_url_input'].'" style="width:420px;" />
				</li>
				
				
				<li class="full">&nbsp;</li>
				<li class="to-label"><label>Adsense Code</label></li>
				<li class="to-field">
				  <textarea rows="5" cols="20" id="adsense_input" name="adsense_input[]" value="'.$_POST['adsense_input'].'" /></textarea>
				</li>
			</ul>
		</td> 
	</tr>';
	die;
}
add_action('wp_ajax_add_banner_ad', 'add_banner_ad');
}

/* add social icons*/
if ( ! function_exists( 'add_social_icon' ) ) {
	function add_social_icon(){
		$template_path = get_template_directory_uri() . '/scripts/admin/media_upload.js';
		wp_enqueue_script('my-upload2', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
		if($_POST['social_net_awesome'] <> ''){
			$fontimg = '<td><i class="fa ' .$_POST['social_net_awesome']. '"></i></td> ';
			
		} else {
			$fontimg = '<td><img width="50" src="' .$_POST['social_net_icon_path']. '"></td> ';
		}
	
		echo '<tr id="del_' .$_POST['counter_social_network'].'"> 
		
			'.$fontimg.' 
			<td>' .$_POST['social_net_url']. '</td> 
			<td class="centr"> 
				<a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del('.$_POST['counter_social_network'].')"><i class="fa fa fa-times"></i></a> 
				| <a href="javascript:px_toggle('.$_POST['counter_social_network'].')"><i class="fa fa-edit"></i></a>
			</td> 
		</tr> 
		<tr id="'.$_POST['counter_social_network'].'" style="display:none"> 
			<td colspan="3"> 
				<span class="theme-wrap"><a onclick="px_toggle('. $_POST['counter_social_network'] .')"><img src="'.get_template_directory_uri().'/images/admin/close-red.png"></a></span>
				<ul class="form-elements">
					<li class="to-label"><label>Icon Path</label></li>
					<li class="to-field">
					  <input id="social_net_icon_path'.$_POST['counter_social_network'].'" name="social_net_icon_path[]" value="'.$_POST['social_net_icon_path'].'" type="text" class="small" /> 
					</li>
					
					<li class="full">&nbsp;</li>
					<li class="to-label"><label>Awesome Font</label></li>
					<li class="to-field">
					  <input class="small" type="text" id="social_net_awesome" name="social_net_awesome[]" value="'.$_POST['social_net_awesome'].'" style="width:420px;" />
					  <p>Put Awesome Font Code like "flag".</p>
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label"><label>URL</label></li>
					<li class="to-field">
					  <input class="small" type="text" id="social_net_url" name="social_net_url[]" value="'.$_POST['social_net_url'].'" style="width:420px;" />
					  <p>Please enter full URL.</p>
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label"><label>Title</label></li>
					<li class="to-field">
					  <input class="small" type="text" id="social_net_tooltip" name="social_net_tooltip[]" value="'.$_POST['social_net_tooltip'].'" style="width:420px;" />
					  <p>Please enter text for icon tooltip..</p>
					</li>
				</ul>
			</td> 
		</tr>';
		die;
	}
	add_action('wp_ajax_add_social_icon', 'add_social_icon');
}
// media pagination for slider/gallery in admin side start
if ( ! function_exists( 'media_pagination' ) ) {
	function media_pagination(){
		foreach ( $_REQUEST as $keys=>$values) {
			$$keys = $values;
		}
		$records_per_page = 10;
		if ( empty($page_id) ) $page_id = 1;
		$offset = $records_per_page * ($page_id-1);
	?>
		<ul class="gal-list">
		  <?php
			$query_images_args = array('post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);
			$query_images = new WP_Query( $query_images_args );
			if ( empty($total_pages) ) $total_pages = count( $query_images->posts );
			$query_images_args = array('post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);
			$query_images = new WP_Query( $query_images_args );
			$images = array();
			foreach ( $query_images->posts as $image) {
				$image_path = wp_get_attachment_image_src( $image->ID, array( get_option("thumbnail_size_w"),get_option("thumbnail_size_h") ) );
			?>
				<li style="cursor:pointer"><img src="<?php echo $image_path[0]?>" onclick="javascript:clone('<?php echo $image->ID?>')" alt="" /></li>
			 <?php
			 }
			 ?>
		  </ul>
		  <br />
		  <div class="pagination-cus">
				<ul>
					<?php
					if ( $page_id > 1 ) echo "<li><a href='javascript:show_next(".($page_id-1).",$total_pages)'>Prev</a></li>";
						for ( $i = 1; $i <= ceil($total_pages/$records_per_page); $i++ ) {
							if ( $i <> $page_id ) echo "<li><a href='javascript:show_next($i,$total_pages)'>" . $i . "</a></li> ";
							else echo "<li class='active'><a>" . $i . "</a></li>";
						}
					if ( $page_id < $total_pages/$records_per_page ) echo "<li><a href='javascript:show_next(".($page_id+1).",$total_pages)'>Next</a></li>";
					?>
				</ul>
			</div>
	<?php
		if ( isset($_POST['action']) ) die();
	}
	add_action('wp_ajax_media_pagination', 'media_pagination');
}
// media pagination for slider/gallery in admin side end


// to make a copy of media image for gallery start
if ( ! function_exists( 'px_gallery_caption' ) ) {
	function px_gallery_caption(){
		global $px_node, $px_counter;
		if( isset($_POST['action']) ) {
			$px_node = new stdClass();
			$px_node->title = "";
			$px_node->use_image_as = "";
			$px_node->video_code = "";
			$px_node->link_url = "";
			$px_node->use_image_as_db = "";
			$px_node->link_url_db = '';
		}
		if ( isset($_POST['counter']) ) $px_counter = $_POST['counter'];
		if ( isset($_POST['path']) ) $px_node->path = $_POST['path'];
	?>
		<li class="ui-state-default" id="<?php echo $px_counter?>">
			<div class="thumb-secs">
				<?php $image_path = wp_get_attachment_image_src( $px_node->path, array( get_option("thumbnail_size_w"),get_option("thumbnail_size_h") ) );?>
				<img src="<?php echo $image_path[0]?>" alt="">
				<div class="gal-edit-opts">
					<!--<a href="#" class="resize"></a>-->
					<a href="javascript:galedit(<?php echo $px_counter?>)" class="edit"></a>
					<a href="javascript:del_this(<?php echo $px_counter?>)" class="delete"></a>
				</div>
			</div>
			<div class="poped-up" id="edit_<?php echo $px_counter?>">
				<div class="opt-head">
					<h5>Edit Options</h5>
					<a href="javascript:galclose(<?php echo $px_counter?>)" class="closeit">&nbsp;</a>
				</div>
				<div class="opt-conts">
					<ul class="form-elements">
						<li class="to-label"><label>Image Title</label></li>
						<li class="to-field"><input type="text" name="title[]" value="<?php echo htmlspecialchars($px_node->title)?>" class="txtfield" /></li>
					</ul>
					<ul class="form-elements">
	
						<li class="to-label"><label>Image Description</label></li>
	
						<li class="to-field"><textarea class="txtarea" name="px_slider_description[]"><?php echo htmlspecialchars($px_node->description)?></textarea></li>
	
					</ul>
					<ul class="form-elements">
						<li class="to-label"><label>Use Image As</label></li>
						<li class="to-field">
							<select name="use_image_as[]" class="select_dropdown" onchange="px_toggle_gal(this.value, <?php echo $px_counter?>)">
								<option <?php if($px_node->use_image_as=="0")echo "selected";?> value="0">LightBox to current thumbnail</option>
								<option <?php if($px_node->use_image_as=="1")echo "selected";?> value="1">LightBox to Video</option>
								<option <?php if($px_node->use_image_as=="2")echo "selected";?> value="2">Link URL</option>
							</select>
							<p>Please select Image link where it will go.</p>
						</li>
					</ul>
					<ul class="form-elements" id="video_code<?php echo $px_counter?>" <?php if($px_node->use_image_as=="0" or $px_node->use_image_as=="" or $px_node->use_image_as=="2")echo 'style="display:none"';?> >
						<li class="to-label"><label>Video URL</label></li>
						<li class="to-field">
							<input type="text" name="video_code[]" value="<?php echo htmlspecialchars($px_node->video_code)?>" class="txtfield" />
							<p>(Enter Specific Video URL Youtube or Vimeo)</p>
						</li>
					</ul>
					<ul class="form-elements" id="link_url<?php echo $px_counter?>" <?php if($px_node->use_image_as=="0" or $px_node->use_image_as=="" or $px_node->use_image_as=="1")echo 'style="display:none"';?> >
						<li class="to-label"><label>Link URL</label></li>
						<li class="to-field">
							<input type="text" name="link_url[]" value="<?php echo htmlspecialchars($px_node->link_url)?>" class="txtfield" />
							<p>(Enter Specific Link URL)</p>
						</li>
					</ul>
					<ul class="form-elements">
						<li class="to-label"></li>
						<li class="to-field">
							<input type="hidden" name="path[]" value="<?php echo $px_node->path?>" />
							<input type="button" onclick="javascript:galclose(<?php echo $px_counter?>)" value="Submit" class="close-submit" />
						</li>
					</ul>
					<div class="clear"></div>
				</div>
			</div>
		</li>
	<?php
		if ( isset($_POST['action']) ) die();
	}
	add_action('wp_ajax_px_gallery_caption', 'px_gallery_caption');
}
// to make a copy of media image for gallery end
// stripslashes / htmlspecialchars for theme option save start
if ( ! function_exists( 'stripslashes_htmlspecialchars' ) ) {
	function stripslashes_htmlspecialchars($value){
		$value = is_array($value) ? array_map('stripslashes_htmlspecialchars', $value) : stripslashes(htmlspecialchars($value));
		return $value;
	}
}
// stripslashes / htmlspecialchars for theme option save end

// saving all the theme options start
if ( ! function_exists( 'theme_option_save' ) ) {
	function theme_option_save() {
		if ( isset($_POST['logo']) ) {
			$_POST = stripslashes_htmlspecialchars($_POST);
			
			if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['twitter_setting'])){
				
				update_option( "px_theme_option", $_POST );
				$px_theme_option = get_option('px_theme_option');
				echo "All Settings Saved <br>";
			}else{
				
				update_option( "px_theme_option", $_POST );
				echo "All Settings Saved<BR>WPLOCKER.COM";
				
			}
		}
		else {
			$target_path_mo = get_template_directory()."/languages/".$_FILES["mofile"]["name"][0];
			if ( move_uploaded_file($_FILES["mofile"]["tmp_name"][0], $target_path_mo) ) {
				chmod($target_path_mo,0777);
			}
			echo "New Language Uploaded Successfully";
		}
		die();
	}
	add_action('wp_ajax_theme_option_save', 'theme_option_save');
}
// saving theme options import export start
if ( ! function_exists( 'theme_option_import_export' ) ) {
	function theme_option_import_export() {
		if($_POST['theme_option_data'] and $_POST['theme_option_data'] <> ''){
			$a = unserialize(base64_decode(trim($_POST['theme_option_data'])));
			update_option( "px_theme_option", $a );
			echo "OPtions Imported";
			die();
		}else{
			echo "Import failed<br>Textarea is empty.";
			die();
		}
	}
	add_action('wp_ajax_theme_option_import_export', 'theme_option_import_export');
}
// restoring default theme options start
if ( ! function_exists( 'theme_option_restore_default' ) ) {
	function theme_option_restore_default() {
		update_option( "px_theme_option", get_option('px_theme_option_restore') );
		echo "Default Theme Options Restored";
		die();
	}
	add_action('wp_ajax_theme_option_restore_default', 'theme_option_restore_default');
}
// saving theme options backup start
if ( ! function_exists( 'theme_option_backup' ) ) {
	function theme_option_backup() {
		update_option( "px_theme_option_backup", get_option('px_theme_option') );
		update_option( "px_theme_option_backup_time", gmdate("Y-m-d H:i:s") );
		echo "Current Backup Taken @ " . gmdate("Y-m-d H:i:s");
		die();
	}
	add_action('wp_ajax_theme_option_backup', 'theme_option_backup');
}
// restore backup start
if ( ! function_exists( 'theme_option_backup_restore' ) ) {
	function theme_option_backup_restore() {
		update_option( "px_theme_option", get_option('px_theme_option_backup') );
		echo "Backup Restored";
		die();
	}
	add_action('wp_ajax_theme_option_backup_restore', 'theme_option_backup_restore');
}
/* page bulider items start
   gallery html form for page builder start */
 if ( ! function_exists( 'px_pb_gallery' ) ) {
		function px_pb_gallery($die = 0){
			global $px_node, $px_count_node, $post;
			if ( isset($_POST['action']) ) {
				$name = $_POST['action'];
				$px_counter = $_POST['counter'];
				$gallery_element_size = '50';
				$px_gal_header_title_db = '';
				$px_gal_layout_db = '';
				$px_gal_album_db = '';
				$px_gal_pagination_db = '';
				$px_gal_media_per_page_db = get_option("posts_per_page");
			}
			else {
				$name = $px_node->getName();
				$px_count_node++;
				$gallery_element_size = $px_node->gallery_element_size;
				$px_gal_header_title_db = $px_node->header_title;
				$px_gal_layout_db = $px_node->layout;
				$px_gal_album_db = $px_node->album;
				$px_gal_pagination_db = $px_node->pagination;
				$px_gal_media_per_page_db = $px_node->media_per_page;
				$px_counter = $post->ID.$px_count_node;
			}
		?> 
			<div id="<?php echo $name.$px_counter?>_del" class="column  parentdelete column_<?php echo $gallery_element_size?>" item="gallery" data="<?php echo element_size_data_array_index($gallery_element_size)?>" >
				 <?php px_element_setting($name,$px_counter,$gallery_element_size);?>
				 <div class="poped-up" id="<?php echo $name.$px_counter?>" style="border:none; background:#f8f8f8;" >
					<div class="opt-head">
						<h5>Edit Gallery Options</h5>
						<a href="javascript:show_all('<?php echo $name.$px_counter?>')" class="closeit">&nbsp;</a>
					</div>
					<div class="opt-conts">
						<ul class="form-elements">
							<li class="to-label"><label>Gallery Header Title</label></li>
							<li class="to-field">
								<input type="text" name="px_gal_header_title[]" class="txtfield" value="<?php echo htmlspecialchars($px_gal_header_title_db)?>" />
							</li>                    
						</ul>
						<ul class="form-elements">
							<li class="to-label"><label>Choose Gallery Layout</label></li>
							<li class="to-field">
								<select name="px_gal_layout[]" class="dropdown">
									<option value="gallery-four-col" <?php if($px_gal_layout_db=="gallery-four-col")echo "selected";?> >4 Column</option>
									<option value="gallery-three-col" <?php if($px_gal_layout_db=="gallery-three-col")echo "selected";?> >3 Column</option>
									<option value="gallery-two-col" <?php if($px_gal_layout_db=="gallery-two-col")echo "selected";?> >2 Column</option>
									<option value="gallery-masonry" <?php if($px_gal_layout_db=="gallery-masonry")echo "selected";?> >Masonary</option>
								</select>
							</li>
						</ul>
						<ul class="form-elements">
							<li class="to-label"><label>Choose Gallery/Album</label></li>
							<li class="to-field">
								<select name="px_gal_album[]" class="dropdown">
									<option value="0">-- Select Gallery --</option>
									<?php
										$query = array( 'posts_per_page' => '-1', 'post_type' => 'px_gallery', 'orderby'=>'ID', 'post_status' => 'publish' );
										$wp_query = new WP_Query($query);
										while ($wp_query->have_posts()) : $wp_query->the_post();
									?>
										<option <?php if($post->post_name==$px_gal_album_db)echo "selected";?> value="<?php echo $post->post_name; ?>"><?php echo get_the_title()?></option>
									<?php
										endwhile;
									?>
								</select>
							</li>
						</ul>
						
						<ul class="form-elements">
							<li class="to-label"><label>Pagination</label></li>
							<li class="to-field">
								<select name="px_gal_pagination[]" class="dropdown" >
									<option <?php if($px_gal_pagination_db=="Show Pagination")echo "selected";?> >Show Pagination</option>
									<option <?php if($px_gal_pagination_db=="Single Page")echo "selected";?> >Single Page</option>
								</select>
							</li>
						</ul>
						<ul class="form-elements" >
							<li class="to-label"><label>No. of Media Per Page</label></li>
							<li class="to-field">
								<input type="text" name="px_gal_media_per_page[]" class="txtfield" value="<?php echo $px_gal_media_per_page_db; ?>" />
							</li>
						</ul>
						<ul class="form-elements noborder">
							<li class="to-label"></li>
							<li class="to-field">
								<input type="hidden" name="px_orderby[]" value="gallery" />
								<input type="button" value="Save" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$px_counter?>')" />
							</li>
						</ul>
					</div>
			   </div>
			</div>
		<?php
			if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_px_pb_gallery', 'px_pb_gallery');
 }
// gallery html form for page builder end

// slider html form for page builder start
 if ( ! function_exists( 'px_pb_slider' ) ) {
	function px_pb_slider($die = 0){
		global $px_node, $px_count_node, $post;
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$px_counter = $_POST['counter'];
			$slider_element_size = '100';
			$px_slider_header_title_db = '';
			$px_slider_db = '';
	
		}
		else {
			$name = $px_node->getName();
				$px_count_node++;
				$slider_element_size = $px_node->slider_element_size;
				$px_slider_header_title_db = $px_node->slider_header_title;
				$px_slider_db = $px_node->slider;
				$px_counter = $post->ID.$px_count_node;
		}
	?>
		<div id="<?php echo $name.$px_counter?>_del" class="column  parentdelete column_<?php echo $slider_element_size?>" item="slider" data="<?php echo element_size_data_array_index($slider_element_size)?>" >
			 <?php px_element_setting($name,$px_counter,$slider_element_size);?>
			 <div class="poped-up" id="<?php echo $name.$px_counter?>" style="border:none; background:#f8f8f8;" >
				<div class="opt-head">
					<h5>Edit Slider Options</h5>
					<a href="javascript:show_all('<?php echo $name.$px_counter?>')" class="closeit">&nbsp;</a>
				</div>
				<div class="opt-conts">
					<ul class="form-elements">
						<li class="to-label"><label>Slider Header Title</label></li>
						<li class="to-field">
							<input type="text" name="px_slider_header_title[]" class="txtfield" value="<?php echo htmlspecialchars($px_slider_header_title_db)?>" />
							<p>Please enter slider header title.</p>
						</li>                    
					</ul>
					<ul class="form-elements" id="choose_slider" style="display:<?php if($px_slider_type_db == "Custom Slider")echo "none"; else echo "inline"; ?>">
						<li class="to-label"><label>Choose Slider</label></li>
						<li class="to-field">
							<select name="px_slider[]" class="dropdown">
								 <?php
									$query = array( 'posts_per_page' => '-1', 'post_type' => 'px_gallery', 'orderby'=>'ID', 'post_status' => 'publish' );
									$wp_query = new WP_Query($query);
									while ($wp_query->have_posts()) : $wp_query->the_post();
								?>
									<option <?php if($post->post_name==$px_slider_db)echo "selected";?> value="<?php echo $post->post_name; ?>"><?php the_title()?></option>
								<?php
									endwhile;
								?>
							</select>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"></li>
						<li class="to-field">
							<input type="hidden" name="px_orderby[]" value="slider" />
							<input type="button" value="Save" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$px_counter?>')" />
						</li>
					</ul>
				</div>
		   </div>
		</div>
	<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_px_pb_slider', 'px_pb_slider');
 }

// Sets gallery  html form for page builder start
if ( ! function_exists( 'px_pb_gallery_albums' ) ) {
	function px_pb_gallery_albums($die = 0){
		global $px_node, $px_count_node, $post;
		if ( isset($_POST['action']) ) {
				$name = $_POST['action'];
				$px_counter = $_POST['counter'];
				$gallery_element_size = '50';
				$px_gal_header_title_db = '';
				$px_gal_album_cat = '';
				$px_gal_desc_db = '';
			
				$px_gal_pagination_db = '';
				$px_gal_media_per_page_db = get_option("posts_per_page");
		}
		else {
			$name = $px_node->getName();
				$px_count_node++;
				$gallery_element_size = $px_node->gallery_albums_element_size;
				$px_gal_header_title_db = $px_node->px_gal_album_header_title;
				$px_gal_album_cat = $px_node->px_gal_album_cat;
				
				$px_gal_pagination_db = $px_node->px_gal_album_pagination;
				$px_gal_media_per_page_db = $px_node->px_gal_album_media_per_page;
					$px_counter = $post->ID.$px_count_node;
		}
	?> 
	
	
	
	
		<div id="<?php echo $name.$px_counter?>_del" class="column  parentdelete column_<?php echo $gallery_element_size?>" item="gallery" data="<?php echo element_size_data_array_index($gallery_element_size)?>" >
			<?php px_element_setting($name,$px_counter,$gallery_element_size);?>
	
			<div class="poped-up" id="<?php echo $name.$px_counter?>" style="border:none; background:#f8f8f8;" >
				<div class="opt-head">
					<h5>Edit Gallery Options</h5>
					<a href="javascript:show_all('<?php echo $name.$px_counter?>')" class="closeit">&nbsp;</a>
				</div>
				<div class="opt-conts">
					<ul class="form-elements">
						<li class="to-label"><label>Gallery Header Title</label></li>
						<li class="to-field">
							<input type="text" name="px_gal_album_header_title[]" class="txtfield" value="<?php echo htmlspecialchars($px_gal_header_title_db)?>" />
							<p>Please enter gallery header title.</p>
						</li>                    
					</ul>
					
					<ul class="form-elements">
						<li class="to-label"><label>Choose Gallery/Album</label></li>
						<li class="to-field">
							<select name="px_gal_album_cat[]" class="dropdown">
								<option value="0">-- Select Gallery --</option>
								<?php
									$categories = get_categories( array('taxonomy' => 'px_gallery-category', 'hide_empty' => 0) );
									foreach ($categories as $category) {
								?>
									<option <?php if($category->slug==$px_gal_album_cat)echo "selected";?> value="<?php echo $category->slug; ?>"><?php echo $category->cat_name?></option>
								<?php
									}
								?>
							</select>
							<p>Select gallery album to show images.</p>
						</li>
					</ul>
					
					<ul class="form-elements">
						<li class="to-label"><label>Pagination</label></li>
						<li class="to-field">
							<select name="px_gal_album_pagination[]" class="dropdown" >
								<option <?php if($px_gal_pagination_db=="Show Pagination")echo "selected";?> >Show Pagination</option>
								<option <?php if($px_gal_pagination_db=="Single Page")echo "selected";?> >Single Page</option>
							</select>
						</li>
					</ul>
					<ul class="form-elements" >
						<li class="to-label"><label>No. of Media Per Page</label></li>
						<li class="to-field">
							<input type="text" name="px_gal_album_media_per_page[]" class="txtfield" value="<?php echo $px_gal_media_per_page_db; ?>" />
							<p>To display all the records, leave this field blank.</p>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"></li>
						<li class="to-field">
							<input type="hidden" name="px_orderby[]" value="gallery_albums" />
							<input type="button" value="Save" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$px_counter?>')" />
						</li>
					</ul>
				</div>
		   </div>
		</div>
	<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_px_pb_gallery_albums', 'px_pb_gallery_albums');
}
// Sets gallery html form for page builder end

	if ( isset($action) ) die();
// blog html form for page builder start
if ( ! function_exists( 'px_pb_blog' ) ) {
	function px_pb_blog($die = 0){
		global $px_node, $px_count_node, $post;
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$px_counter = $_POST['counter'];
			$blog_element_size = '50';
			$var_pb_blog_title = '';
			$var_pb_featured_cat = '';
			$var_pb_blog_view = '';
			$var_pb_blog_featured_post = '';
			$var_pb_blog_excerpt = '255';
			$var_pb_blog_cat = '';
			$var_pb_blog_num_post = get_option("posts_per_page");
			$var_pb_blog_pagination = '';
			$var_pb_blog_desc = '';
			$var_pb_blog_image = '';
			$var_pb_blog_order = '';
		}
		else {
			$name = $px_node->getName();
				$px_count_node++;
				$blog_element_size = $px_node->blog_element_size;
				$var_pb_blog_title = $px_node->var_pb_blog_title;
				$var_pb_blog_featured_post = $px_node->var_pb_blog_featured_post;
				$var_pb_blog_view = $px_node->var_pb_blog_view;
				$var_pb_featured_cat = $px_node->var_pb_featured_cat;
				$var_pb_blog_cat = $px_node->var_pb_blog_cat;
				$var_pb_blog_excerpt = $px_node->var_pb_blog_excerpt;
				$var_pb_blog_num_post = $px_node->var_pb_blog_num_post;
				$var_pb_blog_pagination = $px_node->var_pb_blog_pagination;
				$var_pb_blog_desc = $px_node->var_pb_blog_desc;
				$var_pb_blog_image = $px_node->var_pb_blog_image;
				$var_pb_blog_order = $px_node->var_pb_blog_order;
					$px_counter = $post->ID.$px_count_node;
	}
	?> 
	
		<div id="<?php echo $name.$px_counter?>_del" class="column  parentdelete column_<?php echo $blog_element_size?>" item="blog" data="<?php echo element_size_data_array_index($blog_element_size)?>" >
			<?php px_element_setting($name,$px_counter,$blog_element_size);?>
			<div class="poped-up" id="<?php echo $name.$px_counter?>" style="border:none; background:#f8f8f8;" >
			
				<div class="opt-head">
					<h5>Edit Blog Options</h5>
					<a href="javascript:show_all('<?php echo $name.$px_counter?>')" class="closeit">&nbsp;</a>
				</div>
				<div class="opt-conts">
					<ul class="form-elements">
						<li class="to-label"><label>Blog Section Title </label></li>
						<li class="to-field">
							<input type="text" name="var_pb_blog_title[]" class="txtfield" value="<?php echo htmlspecialchars($var_pb_blog_title)?>" />
						</li>                    
					</ul>
					<ul class="form-elements noborder">
					  <li class="to-label"><label>Blog View</label></li>
					  <li class="to-field">
						  <select name="var_pb_blog_view[]" class="dropdown"  onchange="px_blognews_toggle(this.value, '<?php echo $px_counter?>')">
							  <option <?php if($var_pb_blog_view=='blog-large')echo "selected"?> value="blog-large">Large</option>
							  <option <?php if($var_pb_blog_view=='blog-medium')echo "selected"?> value="blog-medium">Medium</option>
							  <option <?php if($var_pb_blog_view=='blog-grid-v1')echo "selected"?> value="blog-grid-v1">Grid V1</option>
							  <option <?php if($var_pb_blog_view=='blog-grid-v2')echo "selected"?> value="blog-grid-v2">Grid V2</option>
							  <option <?php if($var_pb_blog_view=='blog-home')echo "selected"?> value="blog-home">Home News</option>
							  <option <?php if($var_pb_blog_view=='blog-carousel')echo "selected"?> value="blog-carousel">Slider V1</option>
							  <option <?php if($var_pb_blog_view=='blog-carousel-v2')echo "selected"?> value="blog-carousel-v2">Slider V2</option>
							  <option <?php if($var_pb_blog_view=='blog-banner-carousel')echo "selected"?> value="blog-banner-carousel">Blog Carousal</option>
							  <option <?php if($var_pb_blog_view=='blog-gallery')echo "selected"?> value="blog-gallery">Blog Gallery Slider</option>
						  </select>
					  </li>
					</ul>
					<ul class="form-elements">
						<li class="to-label"><label>Choose Category</label></li>
						<li class="to-field">
							<select name="var_pb_blog_cat[]" class="dropdown">
								<option value="0">-- All Categories --</option>
								<?php show_all_cats('', '', $var_pb_blog_cat, "category");?>
							</select>
						</li>                                        
					</ul>
                    <ul class="form-elements">
						<li class="to-label"><label>Post Order</label></li>
						<li class="to-field">
							<select name="var_pb_blog_order[]" class="dropdown">
								<option value="ASC" <?php echo px_selected("ASC",$var_pb_blog_order); ?> >Ascending</option>
                                <option value="DESC" <?php echo px_selected("DESC",$var_pb_blog_order); ?>>Descending</option>
								
							</select>
						</li>                                        
					</ul>
					<ul class="form-elements" id="news_excerptlength<?php echo $px_counter; ?>"  style="display:<?php if($var_pb_blog_view <> 'blog-gallery'){echo 'inline-block';}else{ echo 'none';}?>">
						<li class="to-label"><label>Length of Excerpt</label></li>
						<li class="to-field">
							<input type="text" name="var_pb_blog_excerpt[]" class="txtfield" value="<?php echo $var_pb_blog_excerpt;?>" />
							<p>Enter number of character for short description text.</p>
						</li>                         
					</ul>
				   
						<ul class="form-elements" id="news_featuredcat_<?php echo $px_counter; ?>" style="display:<?php if($var_pb_blog_view <> "blog-home" && $var_pb_blog_view <> 'blog-carousel'  && $var_pb_blog_view <> "blog-gallery"){echo 'inline-block';}else{ echo 'none';}?>">
							<li class="to-label"><label><?php echo $var_pb_blog_view ;?>Choose Featured Slider Category</label></li>
							<li class="to-field">
								<select name="var_pb_featured_cat[]" class="dropdown">
									<option value="">-- Select Category --</option>
									<?php show_all_cats('', '', $var_pb_featured_cat, "category");?>
								</select>
								 <p>Latest 3 posts will be shown in slider form.</p>
							</li>                                        
						</ul>
						<ul class="form-elements" id="news_description_post<?php echo $px_counter; ?>" style="display:<?php if($var_pb_blog_view <> "blog-home" && $var_pb_blog_view <> 'blog-carousel'  && $var_pb_blog_view <> "blog-gallery" && $var_pb_blog_view <> "blog-grid-v2"){echo 'inline-block';}else{ echo 'none';}?>">
							<li class="to-label"><label>Show Description</label></li>
							<li class="to-field">
								<select name="var_pb_blog_desc[]" class="dropdown" >
									<option <?php if($var_pb_blog_desc=="Yes")echo "selected";?> >Yes</option>
									<option <?php if($var_pb_blog_desc=="No")echo "selected";?> >No</option>
								</select>
							</li>
						</ul>
						<ul class="form-elements" id="news_image_post<?php echo $px_counter; ?>" style="display:<?php if($var_pb_blog_view <> "blog-home" && $var_pb_blog_view <> 'blog-carousel'  && $var_pb_blog_view <> "blog-gallery"){echo 'inline-block';}else{ echo 'none';}?>">
							<li class="to-label"><label>Show Image</label></li>
							<li class="to-field">
								<select name="var_pb_blog_image[]" class="dropdown" >
									<option <?php if($var_pb_blog_image=="Yes")echo "selected";?> >Yes</option>
									<option <?php if($var_pb_blog_desc=="No")echo "selected";?> >No</option>
								</select>
							</li>
						</ul>
						<ul class="form-elements" id="news_featured_post<?php echo $px_counter; ?>" style="display:<?php if(($var_pb_blog_view == "blog-home")){echo 'inline-block';}else{ echo 'none';}?>">
							<li class="to-label"><label>Show Featured Post</label></li>
							<li class="to-field">
								<select name="var_pb_blog_featured_post[]" class="dropdown" >
									<option <?php if($var_pb_blog_featured_post=="Yes")echo "selected";?> >Yes</option>
									<option <?php if($var_pb_blog_featured_post=="No")echo "selected";?> >No</option>
								</select>
							</li>
						</ul>
					  
						<ul class="form-elements" id="news_pagination<?php echo $px_counter; ?>" style="display:<?php if($var_pb_blog_view == "blog-home" || $var_pb_blog_view == "blog-carousel" || $var_pb_blog_view == "blog-gallery" && $var_pb_blog_view <> "blog-grid-v2"){echo 'none';}else{ echo 'inline-block';}?>">
							<li class="to-label"><label>Pagination</label></li>
							<li class="to-field">
								<select name="var_pb_blog_pagination[]" class="dropdown" >
									<option <?php if($var_pb_blog_pagination=="Show Pagination")echo "selected";?> >Show Pagination</option>
									<option <?php if($var_pb_blog_pagination=="Single Page")echo "selected";?> >Single Page</option>
								</select>
							</li>
						</ul>
					
					<ul class="form-elements">
						<li class="to-label"><label>No. of Post Per Page (leave blank To display all) </label></li>
						<li class="to-field">
							<input type="text" name="var_pb_blog_num_post[]" class="txtfield" value="<?php echo $var_pb_blog_num_post; ?>" />
						</li>
					</ul>
					 <ul class="form-elements noborder">
						<li class="to-label"></li>
						<li class="to-field">
							<input type="hidden" name="px_orderby[]" value="blog" />
							<input type="button" value="Save" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$px_counter?>')" />
						</li>
					</ul>
				</div>
		   </div>
		</div>
	<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_px_pb_blog', 'px_pb_blog');
}
// blog html form for page builder end

// fixtures html form for page builder end

// event html form for page builder end
// contact us html form for page builder start
if ( ! function_exists( 'px_pb_contact' ) ) {
	function px_pb_contact($die = 0){
		global $px_node, $px_count_node, $post;
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$px_counter = $_POST['counter'];
			$contact_element_size = '50';
			$px_contact_email_db = '';
			$px_contact_succ_msg_db = '';
			$px_contact_form_title = '';
			
		}
		else {
			$name = $px_node->getName();
				$px_count_node++;
				$contact_element_size = $px_node->contact_element_size;
				$px_contact_email_db = $px_node->px_contact_email;
				$px_contact_form_title = $px_node->px_contact_form_title;
				$px_contact_succ_msg_db = $px_node->px_contact_succ_msg;
				$px_counter = $post->ID.$px_count_node;
	}
	?> 
		<div id="<?php echo $name.$px_counter?>_del" class="column  parentdelete column_<?php echo $contact_element_size?>" item="contact" data="<?php echo element_size_data_array_index($contact_element_size)?>" >
			<?php px_element_setting($name,$px_counter,$contact_element_size);?>
			<div class="poped-up" id="<?php echo $name.$px_counter?>" style="border:none; background:#f8f8f8;" >
				<div class="opt-head">
					<h5>Edit Contact Form</h5>
					<a href="javascript:show_all('<?php echo $name.$px_counter?>')" class="closeit">&nbsp;</a>
				</div>
				<div class="opt-conts">
					
					<ul class="form-elements noborder">
						<li class="to-label"><label>Contact Title</label></li>
						<li class="to-field">
							<input type="text" name="px_contact_form_title[]" class="txtfield" value="<?php echo $px_contact_form_title;?>" />
						</li>                    
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Recipient Email</label></li>
						<li class="to-field">
							<input type="text" name="px_contact_email[]" class="txtfield" value="<?php if($px_contact_email_db=="") echo get_option("admin_email"); else echo $px_contact_email_db;?>" />
						</li>                    
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Successful Message</label></li>
						<li class="to-field"><textarea name="px_contact_succ_msg[]"><?php if($px_contact_succ_msg_db=="")echo "Email Sent Successfully.\nThank you, your message has been submitted to us."; else echo $px_contact_succ_msg_db;?></textarea></li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"></li>
						<li class="to-field">
							<input type="hidden" name="px_orderby[]" value="contact" />
							<input type="button" value="Save" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$px_counter?>')" />
						</li>
					</ul>
				</div>
		   </div>
		</div>
	<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_px_pb_contact', 'px_pb_contact');
}
// contact us html form for page builder end
// column html form for page builder start
if ( ! function_exists( 'px_pb_column' ) ) {
	function px_pb_column($die = 0){
		global $px_node, $px_count_node, $post;
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$px_counter = $_POST['counter'];
			$column_element_size = '25';
			$column_text = '';
		}
		else {
			$name = $px_node->getName();
				$px_count_node++;
				$column_element_size = $px_node->column_element_size;
				$column_text = $px_node->column_text;
					$px_counter = $post->ID.$px_count_node;
	}
	?> 
		<div id="<?php echo $name.$px_counter?>_del" class="column  parentdelete column_<?php echo $column_element_size?>" item="column" data="<?php echo element_size_data_array_index($column_element_size)?>" >
			<?php px_element_setting($name,$px_counter,$column_element_size);?>
			<div class="poped-up" id="<?php echo $name.$px_counter?>" style="border:none; background:#f8f8f8;" >
				<div class="opt-head">
					<h5>Edit Column Options</h5>
					<a href="javascript:show_all('<?php echo $name.$px_counter?>')" class="closeit">&nbsp;</a>
				</div>
				<div class="opt-conts">
					<ul class="form-elements">
						<li class="to-label"><label>Column Text</label></li>
						<li class="to-field">
							<textarea name="column_text[]"><?php echo $column_text?></textarea>
							<p>Shortcodes and HTML tags allowed.</p>
						</li>                  
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"></li>
						<li class="to-field">
							<input type="hidden" name="px_orderby[]" value="column" />
							<input type="button" value="Save" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$px_counter?>')" />
						</li>
					</ul>
				</div>
		   </div>
		</div>
	<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_px_pb_column', 'px_pb_column');
}
// column html form for page builder end 
// Team page element
if ( ! function_exists( 'px_pb_team' ) ) {
	function px_pb_team($die = 0){
		global $px_node, $px_count_node, $post;
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$px_counter = $_POST['counter'];
			$team_element_size = '75';
			$team_title = '';
			$var_pb_team_cat = array();
			$var_pb_team_multicat = '';
			$team_pagination = '';
			$team_page_num = '';
			$team_view = '';
			$team_orderby = '';
			$team_expertise = '';
		}
		else {
			$name = $px_node->getName();
				//$count_node++;
				$px_count_node++;
				$team_element_size = $px_node->team_element_size;
				$team_title = $px_node->team_title;
				$var_pb_team_cat = $px_node->var_pb_team_cat;
				 $var_pb_team_multicat = $px_node->var_pb_team_cat;
				if(isset($var_pb_team_cat) && $var_pb_team_cat <> ''){
					$var_pb_team_cat = explode(',', $var_pb_team_cat);
				} else {
					$var_pb_team_cat = array();
				}
				$team_view = $px_node->team_view;
				$team_pagination = $px_node->team_pagination;
				$team_page_num = $px_node->team_page_num;
				$team_orderby = $px_node->team_orderby;
				$team_expertise = $px_node->team_expertise;
				$px_counter = $post->ID.$px_count_node;
	}
	?> 
		<div id="<?php echo $name.$px_counter?>_del" class="column parentdelete column_<?php echo $team_element_size?>" item="team" data="<?php echo element_size_data_array_index($team_element_size)?>" >
			<?php px_element_setting($name,$px_counter,$team_element_size);?>
			<div class="poped-up" id="<?php echo $name.$px_counter?>" style="border:none; background:#f8f8f8;" >
				<div class="opt-head">
					<h5>Edit team Options</h5>
					<a href="javascript:show_all('<?php echo $name.$px_counter?>')" class="closeit">&nbsp;</a>
				</div>
				<div class="opt-conts">
					<ul class="form-elements  noborder">
						<li class="to-label"><label>Team Header Title</label></li>
						<li class="to-field">
							<input type="text" name="team_title[]" class="txtfield" value="<?php echo $team_title?>" />
						</li>                    
					</ul>
					 <ul class="form-elements noborder">
						<li class="to-label"><label>Choose category</label></li>
						<li class="to-field">
							 <select id="var_pb_select_team<?php echo $px_counter; ?>" name="var_pb_team_cat[]" multiple="multiple" style="min-height:100px;">
								<option value="">-- Select Teams --</option>
								 <?php
									$categories = get_categories( array('taxonomy' => 'team-category', 'hide_empty' => 0) );
										foreach ($categories as $category) {
										?>
										<option <?php if (in_array($category->term_id, $var_pb_team_cat)){echo 'selected="selected"';} ?> value="<?php echo $category->term_id ?>">
											<?php echo $category->cat_name?>
										</option>
										<?php
										}
									?> 
							</select>
							
							<script>
							jQuery(document).ready(function($) {
								jQuery("#var_pb_select_team<?php echo $px_counter; ?>").change(function () {
									jQuery("#var_pb_team_multicat<?php echo $px_counter; ?> ").val(jQuery(this).val());
								});
							});
							</script>
							<input type="hidden" value="<?php echo $var_pb_team_multicat; ?>" id="var_pb_team_multicat<?php echo $px_counter; ?>" name="var_pb_team_multicat[]" />
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Team View</label></li>
						<li class="to-field">
							<select name="team_view[]" class="dropdown" onchange="px_team_toggle(this.value, '<?php echo $px_counter?>')">
								<option <?php if($team_view=="Grid View")echo "selected";?> >Grid View</option>
								<option <?php if($team_view=="Home View")echo "selected";?> >Home View</option>
								<option <?php if($team_view=="Carousal View")echo "selected";?> >Carousal View</option>
							</select>
						</li>
					</ul>
					<div  id="department<?php echo $px_counter?>" style="display:<?php if($team_view <> "Grid View"){echo 'none;';}?>">
						<ul class="form-elements noborder">
							<li class="to-label"><label>OrderBy Department</label></li>
							<li class="to-field">
								<select name="team_orderby[]" class="dropdown"  >
									<option <?php if($team_orderby=="Yes")echo "selected";?> >Yes</option>
									<option <?php if($team_orderby=="No")echo "selected";?> >No</option>
								</select>
							</li>
						</ul>
						
						<ul class="form-elements noborder">
							<li class="to-label"><label>Display Expertise</label></li>
							<li class="to-field">
								<select name="team_expertise[]" class="dropdown"  >
									<option <?php if($team_expertise=="Yes")echo "selected";?> >Yes</option>
									<option <?php if($team_expertise=="No")echo "selected";?> >No</option>
								</select>
							</li>
						</ul>
						<ul class="form-elements noborder" >
						<li class="to-label"><label>Pagination</label></li>
						<li class="to-field">
							<select name="team_pagination[]" class="dropdown" >
								<option <?php if($team_pagination=="Show Pagination")echo "selected";?> >Show Pagination</option>
								<option <?php if($team_pagination=="Single Page")echo "selected";?> >Single Page</option>
							</select>
						</li>
					</ul>
					</div>
					
					
					<ul class="form-elements noborder">
						<li class="to-label"><label>Records Per Page</label></li>
						<li class="to-field"><input type="text" name="team_page_num[]" class="txtfield" value="<?php if($team_page_num=="")echo "5"; else echo $team_page_num;?>" /></li>
					</ul>
					
					<ul class="form-elements noborder">
						<li class="to-label"></li>
						<li class="to-field">
							<input type="hidden" name="px_orderby[]" value="team" />
							<input type="button" value="Save" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$px_counter?>')" />
						</li>
					</ul>
				</div>
		   </div>
		</div>
	<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_px_pb_team', 'px_pb_team');
}
// portfolio html form for page builder end

// google map html form for page builder start
if ( ! function_exists( 'px_pb_map' ) ) {
	function px_pb_map($die = 0){
		global $px_node, $count_node, $post;
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$px_counter = $_POST['counter'];
			$map_element_size = '25';
			$map_title = '';
			$map_height = '';
			$map_lat = '';
			$map_lon = '';
			$map_zoom = '';
			$map_type = '';
			$map_info = '';
			$map_info_width = '';
			$map_info_height = '';
			$map_marker_icon = '';
			$map_show_marker = '';
			$map_controls = '';
			$map_draggable = '';
			$map_scrollwheel = '';
			$map_text= '';
		}
		else {
			$name = $px_node->getName();
				$count_node++;
				$map_element_size = $px_node->map_element_size;
				$map_title 	= $px_node->map_title;
				$map_height = $px_node->map_height;
				$map_lat 	= $px_node->map_lat;
				$map_lon 	= $px_node->map_lon;
				$map_zoom 	= $px_node->map_zoom;
				$map_type = $px_node->map_type;
				$map_info = $px_node->map_info;
				$map_info_width = $px_node->map_info_width;
				$map_info_height = $px_node->map_info_height;
				$map_marker_icon = $px_node->map_marker_icon;
				$map_show_marker = $px_node->map_show_marker;
				$map_controls = $px_node->map_controls;
				$map_draggable = $px_node->map_draggable;
				$map_scrollwheel = $px_node->map_scrollwheel;
				$map_text 	= $px_node->map_text;
				$px_counter 	= $post->ID.$count_node;
	}
	?> 
		<div id="<?php echo $name.$px_counter?>_del" class="column  parentdelete column_<?php echo $map_element_size?>" item="map" data="<?php echo element_size_data_array_index($map_element_size)?>" >
			<?php px_element_setting($name,$px_counter,$map_element_size);?>
			
			<div class="poped-up" id="<?php echo $name.$px_counter?>" style="border:none; background:#f8f8f8;" >
				<div class="opt-head">
					<h5>Edit Map Options</h5>
					<a href="javascript:show_all('<?php echo $name.$px_counter?>')" class="closeit">&nbsp;</a>
				</div>
				<div class="opt-conts">
					<ul class="form-elements noborder">
						<li class="to-label"><label>Title</label></li>
						<li class="to-field"><input type="text" name="map_title[]" class="txtfield" value="<?php echo $map_title?>" /></li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Map Height</label></li>
						<li class="to-field">
							<input type="text" name="map_height[]" class="txtfield" value="<?php echo $map_height?>" />
							<p>Info Max Height in PX (Default is 200)</p>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Latitude</label></li>
						<li class="to-field">
							<input type="text" name="map_lat[]" class="txtfield" value="<?php echo $map_lat?>" />
							<p>Put Latitude (Default is 0)</p>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Longitude</label></li>
						<li class="to-field">
							<input type="text" name="map_lon[]" class="txtfield" value="<?php echo $map_lon?>" />
							<p>Put Longitude (Default is 0)</p>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Zoom</label></li>
						<li class="to-field">
							<input type="text" name="map_zoom[]" class="txtfield" value="<?php echo $map_zoom?>" />
							<p>Put Zoom Level (Default is 11)</p>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Map Types</label></li>
						<li class="to-field">
							<select name="map_type[]" class="dropdown" >
								<option <?php if($map_type=="ROADMAP")echo "selected";?> >ROADMAP</option>
								<option <?php if($map_type=="HYBRID")echo "selected";?> >HYBRID</option>
								<option <?php if($map_type=="SATELLITE")echo "selected";?> >SATELLITE</option>
								<option <?php if($map_type=="TERRAIN")echo "selected";?> >TERRAIN</option>
                                <option <?php if($map_type=="STYLED")echo "selected";?> >STYLED</option>
							</select>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Info Text</label></li>
						<li class="to-field"><input type="text" name="map_info[]" class="txtfield" value="<?php echo $map_info?>" /></li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Info Max Width</label></li>
						<li class="to-field">
							<input type="text" name="map_info_width[]" class="txtfield" value="<?php echo $map_info_width?>" />
							<p>Info Max Width in PX (Default is 200)</p>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Info Max Height</label></li>
						<li class="to-field">
							<input type="text" name="map_info_height[]" class="txtfield" value="<?php echo $map_info_height?>" />
							<p>Info Max Height in PX (Default is 100)</p>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Marker Icon Path</label></li>
						<li class="to-field">
							<input type="text" name="map_marker_icon[]" class="txtfield" value="<?php echo $map_marker_icon?>" />
							<p>e.g. http://yourdomain.com/logo.png</p>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Show Marker</label></li>
						<li class="to-field">
							<select name="map_show_marker[]" class="dropdown" >
								<option value="true" <?php if($map_show_marker=="true")echo "selected";?> >On</option>
								<option value="false" <?php if($map_show_marker=="false")echo "selected";?> >Off</option>
							</select>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Disable Map Controls</label></li>
						<li class="to-field">
							<select name="map_controls[]" class="dropdown" >
								<option value="false" <?php if($map_controls=="false")echo "selected";?> >Off</option>
								<option value="true" <?php if($map_controls=="true")echo "selected";?> >On</option>
							</select>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Draggable</label></li>
						<li class="to-field">
							<select name="map_draggable[]" class="dropdown" >
								<option value="true" <?php if($map_draggable=="true")echo "selected";?> >On</option>
								<option value="false" <?php if($map_draggable=="false")echo "selected";?> >Off</option>
							</select>
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Scroll Wheel</label></li>
						<li class="to-field">
	
							<select name="map_scrollwheel[]" class="dropdown" >
								<option value="true" <?php if($map_scrollwheel=="true")echo "selected";?> >On</option>
								<option value="false" <?php if($map_scrollwheel=="false")echo "selected";?> >Off</option>
							</select>
						</li>
					</ul>
					 <ul class="form-elements noborder">
						<li class="to-label"><label>Map Text</label></li>
						<li class="to-field">
							<textarea name="map_text[]" rows="4" cols="15"><?php echo $map_text;?></textarea>
							
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"></li>
						<li class="to-field">
							<input type="hidden" name="px_orderby[]" value="map" />
							<input type="button" value="Save" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name.$px_counter?>')" />
						</li>
					</ul>
				</div>
	
		   </div>
		</div>
	<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_px_pb_map', 'px_pb_map');
}

// page bulider items end


if ( ! function_exists( 'subheader_meta_layout' ) ) {
	function subheader_meta_layout($default_theme_options_check = ''){
		global $px_xmlObject, $post;
	
		$slider_type = '';
		if ( empty($px_xmlObject->slider_type) ) $slider_type = ""; else $slider_type = $px_xmlObject->slider_type;
		
		if ( empty($px_xmlObject->slider_name) ) $slider_name = ""; else $slider_name = $px_xmlObject->slider_name;
		
		if ( empty($px_xmlObject->slider_id) ) $slider_id = ""; else $slider_id = $px_xmlObject->slider_id;
		
		if ( empty($px_xmlObject->slider_blog_category) ) $slider_blog_category = ""; else $slider_blog_category = $px_xmlObject->slider_blog_category;
		
		if ( empty($px_xmlObject->slider_no_posts) ) $slider_no_posts = ""; else $slider_no_posts = $px_xmlObject->slider_no_posts;
		
		?>
		<input type="hidden" name="slider_sub_meta" value="page_meta" />
		<div class="clear"></div>
	
			<div class="theme-help">
	
				<h4 style="padding-bottom:0px;">Slider Options</h4>
	
				<div class="clear"></div>
	
			</div>
			<ul class="form-elements noborder">
				<li class="to-label"><label>Choose SliderType</label></li>
				<li class="to-field">
					<select name="slider_type" class="dropdown" onchange="javascript:page_slider_toggle(this.value)">
						<option value="" >Choose Slider</option>
						<option <?php if(isset($slider_type) and $slider_type=="default_slider"){echo "selected";}?> value="default_slider" >Default Slider</option>
						 <option <?php if(isset($slider_type) and $slider_type=="post_slider"){echo "selected";}?> value="post_slider" >Post Slider</option>
						 <option <?php if(isset($slider_type) and $slider_type=="post_carousel"){echo "selected";}?> value="post_carousel" >Carousel Slider</option>
						 <option <?php if(isset($slider_type) and $slider_type=="post_slider2"){echo "selected";}?> value="post_slider2" >Post Listing</option>
						 <option <?php if(isset($slider_type) and $slider_type=="flex"){echo "selected";}?> value="flex" >Flex Slider</option>
						 <option <?php if(isset($slider_type) and $slider_type=="custom"){echo "selected";}?> value="custom" >Custom Slider</option>
					</select>
					
				</li>
			</ul>
			<ul class="form-elements noborder" id="default_slider"  style=" <?php if(isset($slider_type) and $slider_type == "default_slider"){echo "display:inline";} else { echo "display:none";} ?>">
				<li class="to-label"></li>
				<li class="to-field"><p>Default Slider settings <a href="<?php echo admin_url('themes.php?page=px_theme_options#tab-manage-announcement-show');?>" target="_blank">Here</a></p></li>
			</ul>
			 <div class="form-elements" id="flex_sliders"  style=" <?php if(isset($slider_type) and $slider_type == "flex"){echo "display:inline";} else { echo "display:none";} ?>">
				<ul class="form-elements  noborder">
					<li class="to-label"><label>Select Slider</label></li>
					<li class="to-field">
					<select name="slider_name" class="dropdown">
						 <?php
							$query = array( 'posts_per_page' => '-1', 'post_type' => 'px_gallery', 'orderby'=>'ID', 'post_status' => 'publish' );
							$wp_query = new WP_Query($query);
							while ($wp_query->have_posts()) : $wp_query->the_post();
						?>
							<option <?php if($post->post_name==$slider_name)echo "selected";?> value="<?php echo $post->post_name; ?>"><?php the_title()?></option>
						<?php
							endwhile;
						?>
					</select>
					 <p>You can use already created slider OR create new slider <a href="<?php echo admin_url();?>/post-new.php?post_type=px_gallery" target="_blank">Click Here</a>.</p>
					</li>
				 </ul>
				</div>
				
	
				<ul class="form-elements  noborder" id="custom_slider" style=" <?php if(isset($slider_type) and $slider_type == "custom"){echo "display:inline";} else{ echo "display:none";}?>" >
					<li class="to-label">
						<label>Custom Slider Short Code</label>
					</li>
					<li class="to-field">
						<input type="text" name="slider_id" class="txtfield" value="<?php if(isset( $slider_id))echo $slider_id;?>" />
						<p>Please enter the short code for Layer Slider OR Revolution Slider if already included in package. Otherwise buy Sliders from <a href="http://codecanyon.net/" target="_blank">Codecanyon</a>. But its optional</p>
					</li>
				</ul>
				<div class="form-elements" id="post_slider"  style=" <?php if(isset($slider_type) and ($slider_type == "post_slider" || $slider_type == "post_slider2" || $slider_type == "post_carousel")){echo "display:inline";} else{ echo "display:none";}?>">
				<ul class="form-elements noborder">
				  <li class="to-label">
					<label>Choose Slider Category</label>
				  </li>
				  <li class="to-field">
					<select name="slider_blog_category" class="dropdown">
					  <option value="">-- Select Category --</option>
					  <?php show_all_cats('', '', $slider_blog_category, "category");?>
					</select>
				  </li>
				</ul>
				<ul class="form-elements noborder" id="blog-slider-noposts"  style=" <?php if(isset($slider_type) and ($slider_type == "post_slider" || $slider_type == "post_carousel")){echo "display:inline";} else{ echo "display:none";}?>">
				  <li class="to-label">
					<label>Show no of posts</label>
				  </li>
				  <li class="to-field">
					<input type="text" name="slider_no_posts" size="5" value="<?php if(isset($slider_no_posts)) echo $slider_no_posts;?>" />
				   
				  </li>
				</ul>
				</div>
			
	<?php	
	}
}




// side bar layout in pages, post and default page(theme options) start
if ( ! function_exists( 'meta_layout' ) ) {
	function meta_layout($default_pages = ''){
		global $px_xmlObject, $post;
		if ( empty($px_xmlObject->sidebar_layout->px_layout) ) $px_layout = ""; else $px_layout = $px_xmlObject->sidebar_layout->px_layout;
		if ( empty($px_xmlObject->sidebar_layout->px_sidebar_left) ) $px_sidebar_left = ""; else $px_sidebar_left = $px_xmlObject->sidebar_layout->px_sidebar_left;
		if ( empty($px_xmlObject->sidebar_layout->px_sidebar_right) ) $px_sidebar_right = ""; else $px_sidebar_right = $px_xmlObject->sidebar_layout->px_sidebar_right;
		if ( empty($px_xmlObject->sidebar_layout->px_small_sidebar) ) $px_small_sidebar = ""; else $px_small_sidebar = $px_xmlObject->sidebar_layout->px_small_sidebar;
		$px_theme_option = get_option('px_theme_option');
	
		?>
			<div class="elementhidden">
			<div class="clear"></div>
			<div class="opt-head">
				<h4>Layout Options</h4>
				<div class="clear"></div>
			</div>
			<ul class="form-elements">
				<li class="to-label">
					<label>Select Layout</label>
				</li>
				<li class="to-field">
					<div class="meta-input">
						<div class='radio-image-wrapper'>
							<input <?php if($px_layout=="none")echo "checked"?> onclick="show_sidebar('none')" type="radio" name="px_layout" class="radio" value="none" id="radio_1" />
							<label for="radio_1">
								<span class="ss"><span class="cs-sidebar-none"></span></span>
								<span <?php if($px_layout=="none")echo "class='check-list'"?> id="check-list"></span>
							</label>
						</div>
						<div class='radio-image-wrapper'>
							<input <?php if($px_layout=="right")echo "checked"?> onclick="show_sidebar('right')" type="radio" name="px_layout" class="radio" value="right" id="radio_2"  />
							<label for="radio_2">
								<span class="ss"><span class="cs-sidebar-right"></span></span>
								<span <?php if($px_layout=="right")echo "class='check-list'"?> id="check-list"></span>
							</label>
						</div>
						<div class='radio-image-wrapper'>
							<input <?php if($px_layout=="left")echo "checked"?> onclick="show_sidebar('left')" type="radio" name="px_layout" class="radio" value="left" id="radio_3" />
							<label for="radio_3">
								<span class="ss"><span class="cs-sidebar-left"></span></span>
								<span <?php if($px_layout=="left")echo "class='check-list'"?> id="check-list"></span>
							</label>
						</div>
						<div class='radio-image-wrapper'>
							<input <?php if($px_layout=="both_left")echo "checked"?> onclick="show_sidebar('both_left')" type="radio" name="px_layout" class="radio" value="both_left" id="radio_4" />
							<label for="radio_4">
								<span class="ss"><span class="cs-sidebar-left"><span class="cs-sidebar-left cs-both-sidebar-left"></span></span><span class="cs-both-sidebar-left"></span></span>
								<span <?php if($px_layout=="both_left")echo "class='check-list'"?> id="check-list"></span>
							</label>
						</div>
						<div class='radio-image-wrapper'>
							<input <?php if($px_layout=="both_right")echo "checked"?> onclick="show_sidebar('both_right')" type="radio" name="px_layout" class="radio" value="both_right" id="radio_5" />
							<label for="radio_5">
								<span class="ss"><span class="cs-sidebar-right"><span class="cs-sidebar-right cs-both-sidebar-right"></span></span><span class="cs-both-sidebar-right"></span></span>
								<span <?php if($px_layout=="both_right")echo "class='check-list'"?> id="check-list"></span>
							</label>
						</div>
					 </div>
				</li>
			</ul>
			
			<ul class="form-elements meta-body" style=" <?php if($px_sidebar_left == ""){echo "display:none";}else echo "display:block";?>" id="sidebar_left" >
				<li class="to-label">
					<label>Select Left Sidebar</label>
				</li>
				<li class="to-field">
					<select name="px_sidebar_left" class="select_dropdown" id="page-option-choose-left-sidebar">
						<?php
						$px_theme_option = get_option('px_theme_option');
						if ( isset($px_theme_option['sidebar']) and count($px_theme_option['sidebar']) > 0 ) {
							foreach ( $px_theme_option['sidebar'] as $sidebar ){
							?>
								<option <?php if ($px_sidebar_left==$sidebar)echo "selected";?> ><?php echo $sidebar;?></option>
							<?php
							}
						}
						?>
					</select>
				</li>
			</ul>
			
			
			
			<ul class="form-elements meta-body" style=" <?php if($px_sidebar_right == ""){echo "display:none";}else{ echo "display:block";}?>" id="sidebar_right" >
				<li class="to-label">
					<label>Select Right Sidebar</label>
				</li>
				<li class="to-field">
					<select name="px_sidebar_right" class="select_dropdown" id="page-option-choose-right-sidebar">
						<?php
						if ( isset($px_theme_option['sidebar']) and count($px_theme_option['sidebar']) > 0 ) {
							foreach ( $px_theme_option['sidebar'] as $sidebar ){
							?>
								<option <?php if ($px_sidebar_right==$sidebar)echo "selected";?> ><?php echo $sidebar;?></option>
							<?php
							}
						}
						?>
					</select>
					<input type="hidden" name="px_orderby[]" value="meta_layout" />
				</li>
			</ul>
		   
			
			<ul class="form-elements meta-body" style=" <?php if($px_small_sidebar == ""){echo "display:none";}else{ echo "display:block";}?>" id="sidebar_small" >
				<li class="to-label">
					<label>Select Small Sidebar</label>
				</li>
				<li class="to-field">
					<select name="px_small_sidebar" class="select_dropdown" id="page-option-choose-left-sidebar">
						<?php
						$px_theme_option = get_option('px_theme_option');
						if ( isset($px_theme_option['sidebar']) and count($px_theme_option['sidebar']) > 0 ) {
							foreach ( $px_theme_option['sidebar'] as $sidebar ){
							?>
								<option <?php if ($px_small_sidebar==$sidebar)echo "selected";?> ><?php echo $sidebar;?></option>
							<?php
							}
						}
						?>
					</select>
				</li>
			</ul>
			
		</div> 
		   <?php 
	}
}
// side bar layout in pages, post and default page(theme options) end
if ( ! function_exists( 'element_size_data_array_index' ) ) {
	function element_size_data_array_index($size){
		if ( $size == "" or $size == 100 ) return 0;
		else if ( $size == 75 ) return 1;
		else if ( $size == 67 ) return 2;
		else if ( $size == 50 ) return 3;
		else if ( $size == 33 ) return 4;
		else if ( $size == 25 ) return 5;
	}
}
// Show all Categories
if ( ! function_exists( 'show_all_cats' ) ) {
	function show_all_cats($parent, $separator, $selected = "", $taxonomy) {
		if ($parent == "") {
			global $wpdb;
			$parent = 0;
		}
		else
			$separator .= " &ndash; ";
		$args = array(
			'parent' => $parent,
			'hide_empty' => 0,
			'taxonomy' => $taxonomy
		);
		$categories = get_categories($args);
		foreach ($categories as $category) {
			?>
			<option <?php if ($selected == $category->slug) echo "selected"; ?> value="<?php echo $category->slug ?>"><?php echo $separator . $category->cat_name ?></option>
			<?php
			show_all_cats($category->term_id, $separator, $selected, $taxonomy);
		}
	}
}


// Default xml data save
if ( ! function_exists( 'save_layout_xml' ) ) {
	function save_layout_xml($sxe) {
		 
		if (empty($_POST['page_title']))
			$_POST['page_title'] = "";
		if (empty($_POST['px_layout']))
			$_POST['px_layout'] = "";
		if (empty($_POST['px_sidebar_left']))
			$_POST['px_sidebar_left'] = "";
		if (empty($_POST['px_sidebar_right']))
			$_POST['px_sidebar_right'] = "";
		if (empty($_POST['px_small_sidebar']))
			$_POST['px_small_sidebar'] = "";
		//  <input type="hidden" name="slider_sub_meta" value="page_meta" />
		if(isset($_POST['slider_sub_meta']) && !empty($_POST['slider_sub_meta']) && $_POST['slider_sub_meta'] == 'page_meta'){
				if (empty($_POST['slider_type'])){ $_POST['slider_type'] = "";}
				if (empty($_POST['slider_name'])){ $_POST['slider_name'] = "";}
				if (empty($_POST['slider_id'])){ $_POST['slider_id'] = "";}
				if (empty($_POST['slider_blog_category'])){ $_POST['slider_blog_category'] = "";}
				if (empty($_POST['slider_no_posts'])){ $_POST['slider_no_posts'] = "";}
	
				$sxe->addChild('slider_type', $_POST['slider_type']);
				$sxe->addChild('slider_name', $_POST['slider_name']);
				$sxe->addChild('slider_id', $_POST['slider_id']);
				$sxe->addChild('slider_blog_category', $_POST['slider_blog_category']);
				$sxe->addChild('slider_no_posts', $_POST["slider_no_posts"]);
		}
		
		$sidebar_layout = $sxe->addChild('sidebar_layout');
			$sidebar_layout->addChild('px_layout', $_POST["px_layout"]);
			if ($_POST["px_layout"] == "left") {
				$sidebar_layout->addChild('px_sidebar_left', $_POST['px_sidebar_left']);
			} else if ($_POST["px_layout"] == "right") {
				$sidebar_layout->addChild('px_sidebar_right', $_POST['px_sidebar_right']);
			}else if ($_POST["px_layout"] == "both_right") {
				$sidebar_layout->addChild('px_small_sidebar', $_POST['px_small_sidebar']);
				$sidebar_layout->addChild('px_sidebar_right', $_POST['px_sidebar_right']);
			}else if ($_POST["px_layout"] == "both_left") {
				$sidebar_layout->addChild('px_sidebar_left', $_POST['px_sidebar_left']);
				$sidebar_layout->addChild('px_small_sidebar', $_POST['px_small_sidebar']);
			}	
		return $sxe;
	}
}

// import demo xml file
if ( ! function_exists( 'px_demo_importer' ) ) {
	function px_demo_importer(){
		?>
		<div class="px-demo-data">
			<h2>Import Demo Data</h2>
			<div class="inn-text">
				<p>Importing demo data helps to build site like the demo site by all means. It is the quickest way to setup theme. Following things happen when dummy data is imported;</p>
				<ul class="import-data">
					<li>&#8226; All wordpress settings will remain same and intact.</li>
					<li>&#8226; Posts, pages and dummy images shown in demo will be imported.</li>
					<li>&#8226; Only dummy images will be imported as all demo images have copy right restriction.</li>
					<li>&#8226; No existing posts, pages, categories, custom post types or any other data will be deleted or modified.</li>
					<li>&#8226; To proceed, please click "Import Demo Data" and wait for a while.</li>
				</ul>
			</div>
			<form method="post">
				<input name="reset"  type="submit" value="Import Demo Data" id="submit_btn" />
				<input type="hidden" name="demo" value="demo-data" />
			</form>
		 
	   <?php
		if(isset($_REQUEST['demo']) && $_REQUEST['demo']=='demo-data'){
			require_once ABSPATH . 'wp-admin/includes/import.php';
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			$px_demoimport_error = false;
			
			if ( !class_exists( 'WP_Importer' ) ) {
					$px_import_class = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
					if ( file_exists( $px_import_class ) ){
						require_once($px_import_class);
					}
					else{
						$px_demoimport_error = true;
					}
				}
			
			if ( !class_exists( 'WP_Import' ) ) {
				$px_import_class = get_template_directory() . '/include/importer/wordpress-importer.php';
				if ( file_exists( $px_import_class ) )
					require_once($px_import_class);
				else
					$px_demoimport_error = true;
			}
			
			if($px_demoimport_error){
				echo __( 'Error.', 'wordpress-importer' ) . '</p>';
				die();
			}else{
				set_time_limit (1000);
				if(!is_file( get_template_directory() . '/include/importer/demo.xml')){
					echo '<p><strong>' . __( 'Sorry, there has been an error.', 'wordpress-importer' ) . '</strong><br />';
					echo __( 'The file does not exist, please try again.', 'wordpress-importer' ) . '</p>';
				}
				else{
					
					global $wpdb;
					$theme_mod_val = array();
					$term_exists = term_exists('main-menu', 'nav_menu');
					if ( !$term_exists ) {
						$wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Main Menu' , 'main-menu', '0'); ");
						$insert_id = $wpdb->insert_id;
						$theme_mod_val['main-menu'] = $insert_id;
						$wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '".$insert_id."' , 'nav_menu', '', '0', '0'); ");
					}
					else $theme_mod_val['main-menu'] = $term_exists['term_id'];
					
					set_theme_mod( 'nav_menu_locations', $theme_mod_val );
					
					$home = get_page_by_title( 'Home' );
					if($home->ID <> '' && get_option( 'page_on_front' ) == "0"){
						update_option( 'page_on_front', $home->ID );
						update_option( 'show_on_front', 'page' );
						update_option( 'front_page_settings', '1' );
					}
					if(!get_option('px_theme_option')){
						add_action('init', 'px_activation_data');
						//add_action('init', 'px_activate_widget');
						px_activate_widget();
						$px_theme_option = get_option('px_theme_option');
						$px_theme_option['announcement_blog_category']='blog';
						$px_theme_option['announcement_no_posts']='5';
						update_option("px_theme_option", $px_theme_option );
					}  else {
						px_activate_widget();
						$px_theme_option = get_option('px_theme_option');//announcement_title
						$px_theme_option['announcement_title']='Breaking News';
						$px_theme_option['announcement_blog_category']='blog';
						$px_theme_option['announcement_no_posts']='5';
						update_option("px_theme_option", $px_theme_option );
					}
					$px_demo_import = new WP_Import();
					$px_demo_import->fetch_attachments = true;
					
					$px_demo_import->import( get_template_directory() . '/include/importer/demo.xml');
					update_option( 'px_import_data', 'success' );
					if($home->ID <> '' && get_option( 'page_on_front' ) == "0"){
						update_option( 'page_on_front', $home->ID );
						update_option( 'show_on_front', 'page' );
						update_option( 'front_page_settings', '1' );
					}
					// Menu Location
				}
			}
	   }
	   
	   echo '</div>';
	}
}


// Ads Shortcode
if ( ! function_exists( 'px_ads_shortcode' ) ) {
	function px_ads_shortcode($atts, $content = "") {
		global $px_theme_option;
		$banner_shortcode = '';
		if (isset($atts['no']) && $atts['no'] <> ''){
			$no = $atts['no'];
			if (!isset($px_theme_option['adsense_input'][$no])){ $px_theme_option['adsense_input'][$no] = '';}
			if (!isset($px_theme_option['banner_type_input'][$no])){ $px_theme_option['banner_type_input'][$no] = '';}
			if (!isset($px_theme_option['banner_image_url'][$no])){ $px_theme_option['banner_image_url'][$no] = '';}
			if (!isset($px_theme_option['banner_url_input'][$no])){ $px_theme_option['banner_url_input'][$no] = '';}
			if (!isset($px_theme_option['banner_title_input'][$no])){ $px_theme_option['banner_title_input'][$no] = '';}
			if(isset($px_theme_option['adsense_input'][$no]) && $px_theme_option['adsense_input'][$no] <> ''){
				$banner_shortcode .= '<div class="'.$px_theme_option['banner_type_input'][$no].'">'.$px_theme_option['adsense_input'][$no].'</div>';
			} else {
				$banner_shortcode .= '<div class="'.$px_theme_option['banner_type_input'][$no].'"><a href="'.$px_theme_option['banner_url_input'][$no].'" target="_blank"><img src="'.$px_theme_option['banner_image_url'][$no].'" alt="'.$px_theme_option['banner_title_input'][$no].'"></a></div>';
			}
		} else {
			$banner_shortcode .= 'Please Enter Proper Shortcode';
		}
		
		$html = '<div class="ads-banner">'.$banner_shortcode.'</div>';
		return do_shortcode(htmlspecialchars_decode($html));
	}
	add_shortcode('ads', 'px_ads_shortcode');
}




// add Album tracks function
if ( ! function_exists( 'px_add_review_to_list' ) ) {
	function px_add_review_to_list(){
		global $counter_reviews, $var_pb_review_title, $var_pb_review_points;
		foreach ($_POST as $keys=>$values) {
			$$keys = $values;
		}
	?>
		<tr id="edit_track<?php echo $counter_reviews?>">
			<td id="album-title<?php echo $counter_reviews?>" style="width:80%;"><?php echo $var_pb_review_title?></td>
			<td class="centr" style="width:20%;">
				<a href="javascript:openpopedup('edit_track_form<?php echo $counter_reviews?>')" class="actions edit">&nbsp;</a>
				<a onclick="javascript:return confirm('Are you sure! You want to delete.')" href="javascript:px_div_remove('edit_track<?php echo $counter_reviews?>')" class="actions delete">&nbsp;</a>
				<div class="poped-up" id="edit_track_form<?php echo $counter_reviews?>">
					<div class="opt-head">
						<h5>Review Settings</h5>
						<a href="javascript:closepopedup('edit_track_form<?php echo $counter_reviews?>')" class="closeit">&nbsp;</a>
						<div class="clear"></div>
					</div>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Title</label></li>
						<li class="to-field">
							<input type="text" name="var_pb_review_title[]" value="<?php echo htmlspecialchars($var_pb_review_title)?>" id="var_pb_review_title<?php echo $counter_reviews?>" />
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label>Rating</label></li>
						<li class="to-field">
							<input type="text" name="var_pb_review_points[]" value="<?php echo htmlspecialchars($var_pb_review_points)?>" id="var_pb_review_points<?php echo $counter_reviews?>" />
						</li>
					</ul>
					<ul class="form-elements noborder">
						<li class="to-label"><label></label></li>
						<li class="to-field"><input type="button" value="Update Review" onclick="update_title(<?php echo $counter_reviews?>); closepopedup('edit_track_form<?php echo $counter_reviews?>')" /></li>
					</ul>
				</div>
			</td>
		</tr>
	<?php
		if ( isset($action) ) die();
	}
	add_action('wp_ajax_px_add_review_to_list', 'px_add_review_to_list');
}



	/*-----------------------------------------------------------------------------------*/
# Categories Mega Menus
/*-----------------------------------------------------------------------------------*/
if (!class_exists('px_mega_menu_walker')) { 

	class px_mega_menu_walker extends Walker_Nav_Menu {
		private $CurrentItem, $CategoryMenu, $menu_style;
		function px_menu_start(){
			$sub_class = $last ='';
			$count = 0;
			$mega_menu_output = '';
			
			if($this->CurrentItem->object == 'category' && empty($this->CurrentItem->menu_item_parent)){ 
				$cat_id = $this->CurrentItem->object_id;
				$category_options = get_option( "cat_$cat_id");
				
				if( $category_options['menu'] == 'on' &&  isset($category_options['menu_style']) && $category_options['menu_style'] == 'Category Post'){
					$mega_menu_output .= "\n<div class=\"category-menu-block\"><div class=\"blog-grid blog-banner-carouse\">\n";
					$cat_query = new WP_Query('cat='.$cat_id.'&no_found_rows=1&posts_per_page=4'); 
					$width = 280;
					$height = 200;
					while ( $cat_query->have_posts() ) { $count++;
						if( $count == 5 ) $last = '2nd-last-column';
						if( $count == 6 ) $last = 'last-column';
						$cat_query->the_post();
						$blog_classes = $count.'-column blog-grid-v2';
						$image_url = px_get_post_img_src(get_the_id(),$width,$height);
						if($image_url == ""){
							$blog_classes = 'no-image';
						}
						$mega_menu_output .= '<article class="'.$last.' '.$blog_classes.'"><h6>&nbsp;</h6>';
						$mega_menu_output .= '<figure>';
						if($image_url <> ""){
							$mega_menu_output .= '<img src="'.$image_url.'">';
						}
						$mega_menu_output .= '<figcaption>
									<div class="text"><ul class="post-options blog-medium-options">
									';
									$before_cat = "<li>";
									$categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat, ', ', '</li>' );
									if ( $categories_list ){
										$mega_menu_output .= $categories_list;
									}
									if ( comments_open() ) {  
										$args_comment = array(
											'post_id' => get_the_id(),
											'count' => true 
										);
										$comments_count = get_comments($args_comment);
										$mega_menu_output .= "<li class='px-comments'><a href='".get_permalink()."#respond'>".$comments_count."</a></li>";
									}
									$mega_menu_output .= "</ul>";
									$menutitle = '';
									if ( strlen(get_the_title()) > 25){$menutitle .= substr(get_the_title(),0,25);} else { the_title();} if ( strlen(get_the_title()) > 25) $menutitle .= "...";
									$mega_menu_output .= '<div class="pix-post-title"><a href="'.get_permalink().'">'.$menutitle.'</a></div>';
									$mega_menu_output .= ' <time datetime="'.date('Y-m-d',strtotime(get_the_date())).'">'.date_i18n(get_option('date_format'),strtotime(get_the_date())).'</time>';
									$mega_menu_output .= '<div class="text-desc">'.px_return_the_excerpt('100', false).'</div>';
									
							$mega_menu_output .= '</div>';		
						$mega_menu_output .= '</figcaption>
							</figure>';			
					$mega_menu_output .= '</article>';
					}
					return $mega_menu_output .= "\n\n";
				}
				
			}
		
		}
		function start_lvl( &$output, $depth = 0, $args = array(), $id=0 ) {
			$indent = str_repeat("\t", $depth);
			$output .= $this->px_menu_start();
			if( $this->CategoryMenu == 'on' && $depth == 0 && ($this->menu_style == 'Category Post' || $this->menu_style == '2 Level Links')){
				$output .= "\n$indent<ul class=\"px-mega-menu\">\n";
			} else {
				$output .= "\n$indent<ul class=\"sub-menu\">\n";
			}
		}
		
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul> <!--End Sub Menu -->\n";
			
			if( $this->CategoryMenu == 'on' && $depth == 0 && $this->menu_style == 'Category Post'){
				$output .= "\n</div></div> \n";
			}
		}
		
		function start_el(&$output, $item, $depth = 0, $args = array() , $id = 0) {
			global $wp_query;
			$this->CurrentItem = $item;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$class_names = $value = $mega_menu = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
			if($item->object == 'category' && empty($item->menu_item_parent)){
				$cat_id = $this->CurrentItem->object_id;
				$category_options['menu_style'] = '';
				$category_options = get_option( "cat_$cat_id");
				if( $category_options['menu'] == 'on' ){
					$this->CategoryMenu = 'on';
					$this->menu_style = $category_options['menu_style'];
					$mega_menu = 'mega-menu';
					if( $category_options['menu'] == 'on' &&  isset($category_options['menu_style']) && $category_options['menu_style'] == '2 Level Links'){
						$mega_menu = 'mega-menu-links sub-mega-menu';
					}
					if( $category_options['menu'] == 'on' &&  isset($category_options['menu_style']) && $category_options['menu_style'] == 'Category Post'){
						$mega_menu = 'mega-menu-category-post sub-mega-menu';
					}
					if ( empty($args->has_children) ) $mega_menu .= ' full-mega-menu';
				} else {
					$mega_menu = '';
				}
			}
	
			
			if( empty($item->menu_item_parent) && empty($mega_menu) ) $this->CategoryMenu = 'no';
			
			$class_names = join( " $mega_menu ", apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . '"';
	
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
	
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			
			if( !empty($mega_menu) && empty($args->has_children) && $category_options['menu'] == 'on' &&  isset($category_options['menu_style']) && $category_options['menu_style'] == 'Category Post' ){	
				$item_output .= $this->px_menu_start();
				$item_output .= "\n</div></div> <!-- .mega-menu-block & container --> \n";
			}
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
		}
		
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}
}
function px_selected($current = '',$saved = ''){
	$selected_value = '';
	if($current == $saved){
		$selected_value = 'selected="selected"';
	}
	return $selected_value; 	
}