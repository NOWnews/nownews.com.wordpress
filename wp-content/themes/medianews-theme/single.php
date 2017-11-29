<?php
 	global $px_theme_option;
	$px_node = new stdClass();
  	get_header();
	$px_layout = '';
	if (have_posts()):
		while (have_posts()) : the_post();
		$post_xml = get_post_meta($post->ID, "post", true);	
		if ( $post_xml <> "" ) {
			$px_xmlObject = new SimpleXMLElement($post_xml);
			$px_layout = $px_xmlObject->sidebar_layout->px_layout;
			$post_view = $px_xmlObject->inside_post_thumb_view;
			$post_video = $px_xmlObject->inside_post_thumb_video;
			$post_audio = $px_xmlObject->inside_post_thumb_audio;
			$post_slider = $px_xmlObject->inside_post_thumb_slider;
			$post_featured_image = $px_xmlObject->inside_post_featured_image_as_thumbnail;
			if ( $px_layout == "left") {
				$px_layout = "col-md-9";
			}
			else if ( $px_layout == "right" ) {
				$px_layout = "col-md-9";
			}
			else if ( $px_layout == "both_right" ) {
				$px_layout = "col-md-7";
			}
			else if ( $px_layout == "both_left" ) {
				$px_layout = "col-md-7";
			}
			else {
				$px_layout = "col-md-12";
			}
		}else{
			$px_layout = "col-md-12";
			$image_url = '';
			$px_xmlObject = new stdClass();
			$post_view = 'Single Image';
			$px_xmlObject->var_pb_post_social_sharing = '';
			$px_xmlObject->var_pb_post_featured = 'on';
			$px_xmlObject->var_pb_post_review = '';
			$px_xmlObject->var_pb_post_attachment = '';
			$px_xmlObject->var_pb_post_author = 'on';
			$px_xmlObject->var_pb_post_related = '';
			$px_xmlObject->var_pb_post_related_title = '';
		}
		$width = 810;
		$height = 410;
		$image_url = px_get_post_img_src($post->ID, $width, $height);	
							
		?>
<!--Left Sidebar Starts-->

<?php if (isset($px_xmlObject->sidebar_layout->px_layout) && $px_xmlObject->sidebar_layout->px_layout <> '' and $px_xmlObject->sidebar_layout->px_layout <> "none" and ($px_xmlObject->sidebar_layout->px_layout == 'both_left' || $px_xmlObject->sidebar_layout->px_layout == 'left')){ ?>
<aside class="left-sidebar col-md-3">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_xmlObject->sidebar_layout->px_sidebar_left) ) : ?>
  <?php endif; ?>
</aside>
<?php wp_reset_postdata();} ?>
<?php if (isset($px_xmlObject->sidebar_layout->px_layout) && $px_xmlObject->sidebar_layout->px_layout <> '' and $px_xmlObject->sidebar_layout->px_layout <> "none" and $px_xmlObject->sidebar_layout->px_layout == 'both_left'){ ?>
<aside class="small-sidebar col-md-2">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_xmlObject->sidebar_layout->px_small_sidebar) ) : ?>
  <?php endif; ?>
</aside>
<?php wp_reset_postdata();} ?>
<!--Left Sidebar End-->
<div class="<?php echo $px_layout; ?>" >
  <div class="blog blog_detail">
    <article>
      <?php if(isset($post_view) and $post_view <> ''){
			if( $post_view == "Slider" and $post_slider <> ''){
				echo '<figure class="detail_figure">';
				 px_flex_slider($width, $height,$post_slider);
				   echo '</figure>';
			 }elseif($post_view == "Single Image" && $image_url <> ''){ 
				  echo '<figure class="detail_figure">';
				 echo '<img src="'.$image_url.'" alt="" >';
				  echo '</figure>';
			   }elseif($post_view == "Video" and $post_video <> '' and $post_view <> ''){
				  
				  $url = parse_url($post_video);
				 if($url['host'] == $_SERVER["SERVER_NAME"]){?>
					<figure class="detail_figure">
					<video width="<?php echo $width;?>" class="mejs-wmp" height="100%"  style="width: 100%; height: 100%;" src="<?php echo $post_video ?>"  id="player1" poster="<?php if($post_featured_image == "on"){ echo $image_url; } ?>" controls="controls" preload="none"></video>
					</figure>
				<?php
				}else{
					echo '<div class="videoWrapper">';
					  echo wp_oembed_get($post_video);
					echo '</div>';
				}
			 }elseif($post_view == "Audio" and $post_audio <> ''){
				 echo '<figure class="detail_figure">';
					if($image_url <> ''){ echo "<a href='".get_permalink()."'><img src=".$image_url." alt='' ></a>";}
					?>
					<figcaption class="gallery">
						<div class="audiowrapp fullwidth">
							<audio style="width:100%;" src="<?php echo $post_audio; ?>" type="audio/mp3" controls="controls"></audio>
						</div>  
					</figcaption>
					<?php
					 echo '</figure>';
				}
		?>
	 <?php } ?>
      <div class="pix-content-wrap">
        <div class="detail_text rich_editor_text">
          <?php px_posted_on(true,false,true,true,true,true,'','single');?>
          <?php px_page_title();?>
          <?php 
			 if((isset($px_xmlObject->var_pb_post_review) && $px_xmlObject->var_pb_post_review == 'on') || (isset($px_xmlObject->var_pb_post_advertisement) && $px_xmlObject->var_pb_post_advertisement <> '')) {
				if(isset($px_xmlObject->var_pb_review_section_position) && $px_xmlObject->var_pb_review_section_position <> '') {
					if($px_xmlObject->var_pb_review_section_position == 'top_right' || $px_xmlObject->var_pb_review_section_position == 'top_left')
						px_rating_section($px_xmlObject);
				}
			 }
			?>
            	<div class="detail-blog-text">
            <?php 
                    the_content();
                    wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Media News' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
			?>
            </div>
            <?php
			 if((isset($px_xmlObject->var_pb_post_review) && $px_xmlObject->var_pb_post_review == 'on') || (isset($px_xmlObject->var_pb_post_advertisement) && $px_xmlObject->var_pb_post_advertisement <> '')) {
				if(isset($px_xmlObject->var_pb_review_section_position) && $px_xmlObject->var_pb_review_section_position <> '' && $px_xmlObject->var_pb_review_section_position == 'bottom')
					px_rating_section($px_xmlObject);
			}
		   ?>
        </div>
        <!-- Share Post -->
        <div class="share-post">
          <?php
			$before_tag = "<div class='post-tags'>".__( '<i class="fa fa-tags"></i>','Media News')." ";
			$tags_list = get_the_term_list ( get_the_id(), 'post_tag', $before_tag, ' ', '</div>' );
			if ( $tags_list ){
				printf( __( '%1$s', 'Media News'),$tags_list );
			} // End if categories
				px_next_prev_custom_links('post');
			 if ($px_xmlObject->var_pb_post_social_sharing == "on"){
				 px_social_share();
			 }
			  //px_next_prev_post();
			 ?>
        </div>
        <!-- Share Post Close --> 
      </div>
	  <?php 
      if(isset($px_xmlObject->var_pb_post_author) && $px_xmlObject->var_pb_post_author <> ''){
            px_author_description();
        }
	  if ($px_xmlObject->var_pb_post_related == 'on') {
		wp_reset_postdata();
		?>
      <div class="pix-blog blog-grid">
        <?php if ($px_xmlObject->var_pb_post_related_title <> '') { ?>
        <header class="pix-heading-title">
          <h2 class="pix-section-title heading-color"><?php echo $px_xmlObject->var_pb_post_related_title;?> </h2>
        </header>
        <?php }?>
        <div class="px-related-post">
          <?php 
                            $custom_taxterms='';
                           $custom_taxterms = wp_get_object_terms( $post->ID, array('category','post_tag'), array('fields' => 'ids') );
                            // arguments
                            $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => 3, // you may edit this number
                            'orderby' => 'DESC',
                            'tax_query' => array(
                                'relation' => 'OR',
                                array(
                                    'taxonomy' => 'post_tag',
                                    'field' => 'id',
                                    'terms' => $custom_taxterms
                                ),
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'id',
                                    'terms' => $custom_taxterms
                                )
                            ),
                            'post__not_in' => array ($post->ID),
                            ); 
                            //print_r($args);
                        $custom_query = new WP_Query($args);
                        if($custom_query->have_posts()):
                        while ( $custom_query->have_posts() ): $custom_query->the_post(); 
                            
                            $image_url = px_attachment_image_src(get_post_thumbnail_id($post->ID), '280','200');
                            $no_image = '';
                            if($image_url == ""){
                                    $no_image = 'no-img';
                            }
                             ?>
                        <!-- Element Size Start -->
                          <article <?php post_class($no_image); ?>>
                            <figure>
                              <?php if($image_url <> ""){?>
                              <a href="<?php the_permalink();?>"><img src="<?php echo $image_url;?>" alt=""></a>
                              <?php }?>
                            </figure>
                            <!-- Text Section -->
                            <div class="text-sec">
                              <h4 class="post-title heading-color"><a href="<?php the_permalink();?>">
                                <?php if ( strlen(get_the_title()) > 50){echo substr(get_the_title(),0,50);} else { the_title();} if ( strlen(get_the_title()) > 50) echo  "...";?>
                                </a></h4>
                              <?php px_posted_on(false,false,true,true,false,true);?>
                            </div>
                            <!-- Text Section --> 
                          </article>
          <!-- Element Size End -->
          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>
      <?php }
				 $post_attachment = '';
				 if(!isset($px_xmlObject->var_pb_post_attachment)){
					 $post_attachment = 'on';
				 } else if (isset($px_xmlObject->var_pb_post_attachment) && $px_xmlObject->var_pb_post_attachment == "on"){
					 $post_attachment = $px_xmlObject->var_pb_post_attachment;
				 }
				 if (isset($post_attachment) && $post_attachment == "on"){
                $args = array(
                   'post_type' => 'attachment',
                   'numberposts' => -1,
                   'post_status' => null,
                   'post_parent' => $post->ID
                  );
                  $attachments = get_posts( $args );
                    if ( $attachments ) {
                 ?>
      <div class="pix-media-attachment mediaelements-post">
        <?php if (isset($px_xmlObject->var_pb_post_attachment_title ) && $px_xmlObject->var_pb_post_attachment_title <> '') { ?>
        <header class="pix-heading-title">
          <h2 class=" pix-section-title"><?php echo $px_xmlObject->var_pb_post_attachment_title; ?></h2>
        </header>
        <?php  }  
                        
	 foreach ( $attachments as $attachment ) {
		$attachment_title = apply_filters( 'the_title', $attachment->post_title );
	   $type = get_post_mime_type( $attachment->ID );
	   if($type=='image/jpeg'){
		  ?>
		<a <?php if ( $attachment_title <> '' ) { echo 'data-title="'.$attachment_title.'"'; }?> href="<?php echo $attachment->guid; ?>" data-rel="<?php echo "prettyPhoto[gallery1]"?>" class="me-imgbox"><?php echo wp_get_attachment_image( $attachment->ID, array(240,180),true ) ?></a>
		<?php
		
		} elseif($type=='audio/mpeg') {
			?>
			<!-- Button to trigger modal --> 
			<a href="#audioattachment<?php echo $attachment->ID;?>" role="button" data-toggle="modal" class="iconbox"><i class="fa fa-microphone"></i></a> 
			<!-- Modal -->
			<div class="modal fade" id="audioattachment<?php echo $attachment->ID;?>" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  </div>
				  <div class="modal-body">
					<audio style="width:100%;" src="<?php echo $attachment->guid; ?>" type="audio/mp3" controls="controls"></audio>
				  </div>
				</div>
				<!-- /.modal-content --> 
			  </div>
			</div>
			<?php
		} elseif($type=='video/mp4') {
		 ?>
		<a href="#videoattachment<?php echo $attachment->ID;?>" role="button" data-toggle="modal" class="iconbox"><i class="fa fa-video-camera"></i></a>
		<div class="modal fade" id="videoattachment<?php echo $attachment->ID;?>" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  </div>
			  <div class="modal-body">
				<video width="100%" height="360" poster="">
				  <source src="<?php echo $attachment->guid; ?>" type="video/mp4" title="mp4">
				</video>
			  </div>
			</div>
			<!-- /.modal-content --> 
		  </div>
		</div>
		<?php
		}
	  }
      ?>
      </div>
      <?php  }
				 
	}?>
 </article>
</div>
 <?php comments_template('', true); ?>
</div>
<?php
endwhile;   
endif;
if (isset($px_xmlObject->sidebar_layout->px_layout) && $px_xmlObject->sidebar_layout->px_layout <> '' and $px_xmlObject->sidebar_layout->px_layout <> "none" and ($px_xmlObject->sidebar_layout->px_layout == 'both_right')){ ?>
    <aside class="small-sidebar col-md-2">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_xmlObject->sidebar_layout->px_small_sidebar) ) : ?>
      <?php endif; ?>
    </aside>
<?php wp_reset_query();} 
if (isset($px_xmlObject->sidebar_layout->px_layout) && $px_xmlObject->sidebar_layout->px_layout <> '' and $px_xmlObject->sidebar_layout->px_layout <> "none" and ($px_xmlObject->sidebar_layout->px_layout == 'both_right' || $px_xmlObject->sidebar_layout->px_layout == 'right')){ ?>
    <aside class="sidebar-right col-md-3">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_xmlObject->sidebar_layout->px_sidebar_right) ) : ?>
      <?php wp_reset_query();endif; ?>
    </aside>
<?php 
}
get_footer();