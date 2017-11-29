<?php
	global $px_node,$px_theme_option,$counter_node,$video_width;

	
  	get_header();
	if (have_posts()):
		$px_node = new stdClass();
	$px_node->media_per_page = 30;
	if(!isset($px_node->desc)){ $px_node->desc = "On"; }
	while (have_posts()) : the_post();
 	$count_post =0;

	// galery slug to id start

	// galery slug to id end
	$px_meta_gallery_options = get_post_meta($post->ID, "px_meta_gallery_options", true);
	if ( empty($_GET['page_id_all']) ) $_GET['page_id_all'] = 1;
	// pagination start
	if ( $px_meta_gallery_options <> "" ) {
		$px_xmlObject = new SimpleXMLElement($px_meta_gallery_options);
		if ($px_node->media_per_page > 0 ) {
			$limit_start = $px_node->media_per_page * ($_GET['page_id_all']-1);
			$limit_end = $limit_start + $px_node->media_per_page;
			$count_post = count($px_xmlObject->gallery);
				if ( $limit_end > count($px_xmlObject->gallery) ) 
					$limit_end = count($px_xmlObject->gallery);
		}
		else {
			$limit_start = 0;
			$limit_end = count($px_xmlObject->gallery);
			$count_post = count($px_xmlObject->gallery);
		}
	}
	?>
       <div class="element_size_<?php echo $px_node->gallery_element_size; ?> page_listing">

   
   
   
  <div class="col-sm-12 col-md-12">
 <div class="gallerysec gallery">
        <ul class="<?php echo $px_node->layout;?> lightbox clearfix">
         <?php
            if ( $px_meta_gallery_options <> "" ) {
                for ( $i = $limit_start; $i < $limit_end; $i++ ) {
                    $path = $px_xmlObject->gallery[$i]->path;
                    $title = $px_xmlObject->gallery[$i]->title;
					$description = $px_xmlObject->gallery[$i]->description;
                    $use_image_as = $px_xmlObject->gallery[$i]->use_image_as;
                    $video_code = $px_xmlObject->gallery[$i]->video_code;
                    $link_url = $px_xmlObject->gallery[$i]->link_url;
 					$image_url = px_attachment_image_src($path, 470, 353);
                    $image_url_full = px_attachment_image_src($path, 0, 0);
 					?>
            <li <?php if($use_image_as==1){ echo 'class="video-gallery-img"'; }?>>
						<a data-title="<?php if ( $description <> ''  ) { echo $description; }?>"  href="<?php if($use_image_as==1)echo $video_code; elseif($use_image_as==2) echo $link_url; else echo $image_url_full;?>" target="<?php if($use_image_as==2) echo '_blank'; ?>" data-rel="<?php if($use_image_as==1)echo "prettyPhoto";  elseif($use_image_as==2) echo ""; else echo "prettyPhoto[gallery1]"?>">							  
                      	<figure>
                            <?php echo "<img src='".$image_url."' data-alt='".$title."' alt='' />";  ?>
                            <figcaption>
                                 <?php 
								  if($use_image_as==1){
									  echo '<i class="fa fa-video-camera"></i>';
								  }elseif($use_image_as==2){
									  echo '<i class="fa fa-link"></i>';	
								  }else{
									  echo '<i class="fa fa-plus"></i>';
								  }
								?>
                                </figcaption>
                            
                        	</figure>
                        </a>
                        
                        <div class="text">
               		 	<?php if(isset($title) && $title <> '') {?>
                			<h2><?php echo $title; ?></h2>
						<?php }?>
                        <?php
                         $before_cat = "<p> ";
        
                            $categories_list = get_the_term_list ( $post->ID, 'px_gallery-category', $before_cat, ', ', '</p>' );
                            if ( $categories_list ){
                                printf( __( '%1$s', 'Media News'),$categories_list );
                            }
                        
                        
                         ?>
                </div>
             </li>
   <?php }}?>
   		</ul>
   </div>
</div> 
</div>     
<?php endwhile;   endif;?>
<!--Footer-->
<?php get_footer(); ?>
