 <?php
 	global $px_node,$post,$px_theme_option,$px_counter_node,$px_meta_page; 
 	$image_url = $clses = $readmore = $post_order ='';
	if(isset($px_node->var_pb_blog_order)){
		$post_order = $px_node->var_pb_blog_order;
	}else{
		$post_order ='DESC';
	}
	if(!isset($px_theme_option['trans_read_more'])){
		$readmore = __('READ MORE','Media News');
	} else {
		if(isset($px_theme_option["trans_switcher"]) && $px_theme_option["trans_switcher"] == "on") { $readmore = __('READ MORE','Media News'); }elseif(isset($px_theme_option["trans_read_more"])){  $readmore = 		$px_theme_option["trans_read_more"];}
	}
   	if ( !isset($px_node->var_pb_blog_num_post) || empty($px_node->var_pb_blog_num_post) ) { $px_node->var_pb_blog_num_post = -1; }
		if($px_node->var_pb_blog_view =="blog-carousel"){
			$clses= 'blog-vertical';
			$var_pb_blog_view = $px_node->var_pb_blog_view;
			$divend= '';
		}elseif($px_node->var_pb_blog_view =="blog-grid-v1" || $px_node->var_pb_blog_view =="blog-grid-v2"){
			$var_pb_blog_view = $px_node->var_pb_blog_view;
			$var_pb_blog_view = str_replace('-v1','',$var_pb_blog_view);
			$var_pb_blog_view = str_replace('-v2','',$var_pb_blog_view);
			$clses ='';
			$divend = '';
		} else if ($px_node->var_pb_blog_view =="blog-banner-carousel"){
			$var_pb_blog_view = $px_node->var_pb_blog_view;	
			$clses ='blog-grid';
			
		} else {
			$var_pb_blog_view = $px_node->var_pb_blog_view;	
		}
	?>
	<div class="element_size_<?php echo $px_node->blog_element_size; ?>">
    	<?php
		if ($px_node->var_pb_blog_title <> '' && ($px_node->var_pb_blog_view =="blog-grid-v1" || $px_node->var_pb_blog_view =="blog-grid-v2")) { ?>
                <header class="pix-heading-title">
                    <?php	if ($px_node->var_pb_blog_title <> '') { ?>
                    <h2 class="pix-heading-color pix-section-title"><?php echo $px_node->var_pb_blog_title; ?></h2>
					<?php  } ?>
                </header>
        <?php } 
		if($px_node->var_pb_featured_cat <> '' && $px_node->var_pb_blog_view <> 'blog-home' && $px_node->var_pb_blog_view <> 'blog-carousel'){
			
			$args = array('posts_per_page' => "3",  'category_name' => "$px_node->var_pb_featured_cat", 'order' => "$post_order");
            $custom_query = new WP_Query($args);
			if($custom_query->have_posts()):
		?>
            <div class="pix-blog blog-carousel-view">
                <div class="cycle-slideshow"
                    data-cycle-fx=scrollHorz
                    pagination=".cycle-pager"
                    data-cycle-slides=">article"
                    data-cycle-timeout=3000>
                    <div class="cycle-pager"></div>
                    <?php 
                        px_enqueue_cycle_script();
                        while ($custom_query->have_posts()) : $custom_query->the_post();
                        $image_url = px_get_post_img_src($post->ID,768,403); 
                       	if($image_url <> ""){ ?>
                        	<article>
                                <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url;?>" alt=""></a></figure>
                                <div class="text">
                                    <h2 class="pix-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php px_get_the_excerpt(165,false, ' ...'); ?>
                                </div>
                      		</article>
                      <?php }?>
                       <?php endwhile; ?>
                   </div>
             </div>
        <?php endif; 
		}
		?> 
    	<div class="pix-blog <?php echo $var_pb_blog_view; ?> <?php echo $clses; ?>">
     	<!-- Blog Start -->
        <?php 
			$blog_category_name = '';
			if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
            $args = array('posts_per_page' => "-1", 'paged' => $_GET['page_id_all'], 'post_status' => 'publish', 'order' => "$post_order");
			if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> ''){
				$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
				$args = array_merge($args, $blog_category_array);
			} else {
				$category_ids = get_all_category_ids();
				$category_ids = implode(",", $category_ids);
				$blog_category_array = array('cat' => $category_ids);
				$args = array_merge($args, $blog_category_array);
			}
            $custom_query = new WP_Query($args);
            $post_count = $custom_query->post_count;
            $count_post = 0;
            
            $px_counter = 0;
			if($px_node->var_pb_blog_view =="blog-large"){
				$width = '810';
				$height = '410';
			}else{
				$width = 395;
				$height = 222;
			}
		
			
			if ($px_node->var_pb_blog_view =="blog-home"){$blog_category_name = $category_link = '';
			
			$args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'paged' => $_GET['page_id_all'],'order' =>"$post_order");
			if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
				$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
				$args = array_merge($args, $blog_category_array);
			} else {
				$category_ids = get_all_category_ids();
				$category_ids = implode(",", $category_ids);
				$blog_gallery_category_array = array('cat' => $category_ids);
				$args = array_merge($args, $blog_gallery_category_array);
			}
			
            $custom_query = new WP_Query($args);
					$width = 395;
					$height = 222;
				?>
                       	 <div class="tabs horizontal">
                        	  	<header class="pix-heading-title">
								<?php if ($px_node->var_pb_blog_title <> '') { ?>
                               				<h2 class="pix-heading-color pix-section-title"><?php echo $px_node->var_pb_blog_title; ?></h2>
                                <?php  }?>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class=" active"><a href="#blog-headlines" data-toggle="tab"><?php if($px_theme_option["trans_switcher"] == "on") { _e("Headlines",'Media News'); }else{  echo $px_theme_option["trans_headlines"];} ?></a></li>
                                    <li class=""><a href="#blog-recent" data-toggle="tab"><?php if($px_theme_option["trans_switcher"] == "on") { _e("Recent Posts",'Media News'); }else{  echo $px_theme_option["trans_recent"];} ?></a></li>
                                    <li class=""><a href="#blog-popular" data-toggle="tab"><?php if($px_theme_option["trans_switcher"] == "on") { _e("Popular Posts",'Media News'); }else{  echo $px_theme_option["trans_popular"];} ?></a></li>
                            	</ul>
                            	</header>
                            <div class="tab-content">
                             <div id="blog-headlines" class="blog-headlines tab-pane fade in active">
                             <div class="pix-feature">
							<?php
							$counter_blog = 0;
							$sticky = get_option( 'sticky_posts' );
							$args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'post__in' => $sticky, 'paged' => $_GET['page_id_all'],  'order' => "$post_order");
							if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
								$row_cat = $wpdb->get_row("SELECT * from ".$wpdb->prefix."terms WHERE slug = '" . $px_node->var_pb_blog_cat ."'" );
								if(isset($row_cat)){
									$blog_category_name = $row_cat->name;
									$category_link = get_category_link( $row_cat->term_id );
								}
								$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
								$args = array_merge($args, $blog_category_array);
							} else {
								$category_ids = get_all_category_ids();
								$category_ids = implode(",", $category_ids);
								$blog_category_array = array('cat' => $category_ids);
								$args = array_merge($args, $blog_category_array);
							}
							$custom_query = new WP_Query($args);
                            while ($custom_query->have_posts()) : $custom_query->the_post();
							if(is_sticky()){
								$counter_blog++;
								$post_xml = get_post_meta($post->ID, "post", true);	
								$blog_classes = array();
								if ( $post_xml <> "" ) {
									$px_xmlObject = new SimpleXMLElement($post_xml);
									$no_image = '';
									$image_url = px_get_post_img_src($post->ID, $width, $height);
									if($image_url == ""){
										$blog_classes[] = 'no-image';
									}
									}else{
										
										$post_view = '';
										$no_image = '';	
										$image_url_full = '';
									}	
								$format = get_post_format( $post->ID );
								if($px_node->var_pb_blog_featured_post == 'No' && $counter_blog == 1){
									$counter_blog = 2;
									$blog_classes[] = 'full-width-post';
								}
								if($counter_blog == 1){
									$blog_classes[] = 'featured-post';
									
								?>
                                
								<article <?php post_class($blog_classes); ?>>
									<?php if($image_url <> ""){?>
										<figure>
                                        	<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url;?>" alt=""></a>
                                        	
                                            <figcaption>
                                            	<?php 
													$rating = px_user_rating_display('blog-headliness'.$counter_blog);
													if(isset($rating) && $rating <> ''){
													?>
                                                    <div class="heading-color cs-rating-heading">
                                                        <?php  echo $rating;?>
                                                    </div>
                                                <?php }?>
                                            </figcaption>
                                        </figure>
									<?php }?>
									<div class="text">
                                    			<h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php if ( strlen(get_the_title()) > 45){echo substr(get_the_title(),0,45);} else { the_title();} if ( strlen(get_the_title()) > 45) echo  "...";?></a></h2>
                                    		<?php px_posted_on(true,false,true,true,true,true);?>
										 <?php 
											px_get_the_excerpt($px_node->var_pb_blog_excerpt,false,'...');
											wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Media News' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
										   ?>
										<div class="blog-bottom">
												<a href="<?php the_permalink(); ?>" class="btnreadmore btn pix-bgcolrhvr"><?php echo $readmore; ?></a>
                                                
										</div>
									</div>
								</article></div>
								<?php if($post_count>1){?><div class="blog-listing-text"><?php }?>
								<?php 
								} else {
								?>
									<article <?php post_class($blog_classes); ?>>
										<div class="text">
                                        	<?php 
												$rating = px_user_rating_horziantal_display();
												if(isset($rating) && $rating <> ''){
												  echo $rating;
												 }
											?>
											<h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php the_title();?></a></h2>
											<?php px_posted_on(true,false,true,true,true,true);?>
										</div>
								</article>
								<?php
								}
							}
                            endwhile; 
                            ?>
                            <?php if($post_count>1){?></div><?php }?>
                                    </div>
                                    <div id="blog-recent" class="blog-headlines tab-pane fade in "> 
                                    	<div class="pix-feature">
										<?php
										$args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'paged' => $_GET['page_id_all'],'order'=>"$post_order");
									
                                        $counter_blog = 0;
										if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
											$row_cat = $wpdb->get_row("SELECT * from ".$wpdb->prefix."terms WHERE slug = '" . $px_node->var_pb_blog_cat ."'" );
											if(isset($row_cat)){
												$blog_category_name = $row_cat->name;
												$category_link = get_category_link( $row_cat->term_id );
											}
											$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
											$args = array_merge($args, $blog_category_array);
										} else {
											$category_ids = get_all_category_ids();
											$category_ids = implode(",", $category_ids);
											$blog_category_array = array('cat' => $category_ids);
											$args = array_merge($args, $blog_category_array);
										}
										$custom_query = new WP_Query($args);
                                        while ($custom_query->have_posts()) : $custom_query->the_post();
                                        $counter_blog++;
                                        $post_xml = get_post_meta($post->ID, "post", true);	
                                        $blog_classes = array();
                                        if ( $post_xml <> "" ) {
                                            $px_xmlObject = new SimpleXMLElement($post_xml);
                                            $no_image = '';
                                            $image_url = px_get_post_img_src($post->ID, $width, $height);
                                            if($image_url == ""){
                                                $blog_classes[] = 'no-image';
                                            }
										}else{
											
											$post_view = '';
											$no_image = '';	
											$image_url_full = '';
										}	
                                        $format = get_post_format( $post->ID );
										if($px_node->var_pb_blog_featured_post == 'No' && $counter_blog == 1){
											$counter_blog = 2;
											$blog_classes[] = 'full-width-post';
										}
                                        if($counter_blog == 1){
                                            $blog_classes[] = 'featured-post';
                                        ?>
                                        <article <?php post_class($blog_classes); ?>>
									<?php if($image_url <> ""){?>
										<figure>
                                        	<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url;?>" alt=""></a>
                                     
                                            <figcaption>
                                            	<?php 
													$rating = px_user_rating_display('blog-recent'.$counter_blog);
													if(isset($rating) && $rating <> ''){
													?>
                                                    <div class="heading-color cs-rating-heading">
                                                        <?php  echo $rating;?>
                                                    </div>
                                                <?php }?>
                                            </figcaption>
                                        	
                                        </figure>
									<?php }?>
									<div class="text">
                                    	<h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php if ( strlen(get_the_title()) > 45){echo substr(get_the_title(),0,45);} else { the_title();} if ( strlen(get_the_title()) > 45) echo  "...";?></a></h2>
                                    		<?php px_posted_on(true,false,true,true,true,true);?>
										 <?php 
											px_get_the_excerpt($px_node->var_pb_blog_excerpt,false,'...');
											wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Media News' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
										   ?>
										  
										<div class="blog-bottom">
												<a href="<?php the_permalink(); ?>" class="btnreadmore btn pix-bgcolrhvr"><?php echo $readmore; ?></a>
										</div>
									</div>
								</article></div>
                                        <?php if($post_count>1){?><div class="blog-listing-text"><?php }?>
                                        <?php 
                                        } else {
                                        ?>
                                            <article <?php post_class($blog_classes); ?>>
                                                <div class="text">
                                                	<?php 
														$rating = px_user_rating_horziantal_display();
														if(isset($rating) && $rating <> ''){
														  echo $rating;
														 }
													?>
                                                    <h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php the_title();?></a></h2>
                                                    <?php px_posted_on(true,false,true,true,true,true);?>
                                                </div>
                                        </article>
                                        <?php
                                        }
                                        endwhile; 
                                        ?>
                                        <?php if($post_count>1){?></div><?php }?>
                     
                                    </div>
                                    <div id="blog-popular" class="blog-headlines tab-pane fade in ">
                                    	<div class="pix-feature">
							<?php
                            $counter_blog = 0;
							$args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'paged' => $_GET['page_id_all'], 'orderby' => "comment_count",  'order' => "$post_order");
							if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){

								$row_cat = $wpdb->get_row("SELECT * from ".$wpdb->prefix."terms WHERE slug = '" . $px_node->var_pb_blog_cat ."'" );
								if(isset($row_cat)){
									$blog_category_name = $row_cat->name;
									$category_link = get_category_link( $row_cat->term_id );
								}
								
								$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
								$args = array_merge($args, $blog_category_array);
							} else {
								$category_ids = get_all_category_ids();
								$category_ids = implode(",", $category_ids);
								$blog_category_array = array('cat' => $category_ids);
								$args = array_merge($args, $blog_category_array);
							}
									
							$custom_query = new WP_Query($args);
                            while ($custom_query->have_posts()) : $custom_query->the_post();
							$counter_blog++;
                            $post_xml = get_post_meta($post->ID, "post", true);	
                            $blog_classes = array();
                            if ( $post_xml <> "" ) {
                                $px_xmlObject = new SimpleXMLElement($post_xml);
                                $no_image = '';
								$format = get_post_format( $post->ID );
                                $image_url = px_get_post_img_src($post->ID, $width, $height);
                                if($image_url == ""){
                                    $blog_classes[] = 'no-image';
                                }
							}else{
								$post_view = '';
								$no_image = '';	
								$image_url_full = '';
							}	
                            //$format = get_post_format( $post->ID );
                            if($px_node->var_pb_blog_featured_post == 'No' && $counter_blog == 1){
								$counter_blog = 2;
								$blog_classes[] = 'full-width-post';
							}
							if($counter_blog == 1){
								$blog_classes[] = 'featured-post';
                            ?>
                            <article <?php post_class($blog_classes); ?>>
									<?php if($image_url <> ""){?>
										<figure>
                                        	<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url;?>" alt=""></a>
                                        	<figcaption>
                                            	<?php 
													$rating = px_user_rating_display('blog-popular'.$counter_blog);
													if(isset($rating) && $rating <> ''){
														?>
														<div class="heading-color cs-rating-heading">
															<?php  echo $rating;?>
														</div>
                                                <?php }?>
                                            </figcaption>
                                        </figure>
									<?php }?>
									<div class="text">
                                    		<h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php if ( strlen(get_the_title()) > 45){echo substr(get_the_title(),0,45);} else { the_title();} if ( strlen(get_the_title()) > 45) echo  "...";?></a></h2>
                                    		<?php px_posted_on(true,false,true,true,true,true);?>
										 <?php 
											px_get_the_excerpt($px_node->var_pb_blog_excerpt,false,'...');
											wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Media News' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
										   ?>
										  
										<div class="blog-bottom">
												<a href="<?php the_permalink(); ?>" class="btnreadmore btn pix-bgcolrhvr"><?php echo $readmore; ?></a>
                                                
										</div>
									</div>
								</article></div>
                            <?php if($post_count>1){?><div class="blog-listing-text"><?php }?>
							<?php 
							} else {
							?>
								<article <?php post_class($blog_classes); ?>>
                                    <div class="text">
                                    	<?php 
											$rating = px_user_rating_horziantal_display();
											if(isset($rating) && $rating <> ''){
											  echo $rating;
											 }
										?>
                                      	<h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php the_title();?></a></h2>
                                        <?php px_posted_on(true,false,true,true,true,true);?>
                                    </div>
                           	 </article>
							<?php
							}
                            endwhile; 
                            ?>
                           			<?php if($post_count>1){?></div><?php }?>
                                   </div>
                             </div>
                       </div>
                      
                    <?php
				} else if($px_node->var_pb_blog_view =="blog-gallery"){
					wp_reset_query();
					$args_blog = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'post_type' => 'post','order' => "$post_order");
					if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
						$blog_gallery_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
						$args_blog = array_merge($args_blog, $blog_gallery_category_array);
					} else {
						$category_ids = get_all_category_ids();
						$category_ids = implode(",", $category_ids);
						$blog_gallery_category_array = array('cat' => $category_ids);
						$args_blog = array_merge($args_blog, $blog_gallery_category_array);
					}
					$custom_blog_query = new WP_Query($args_blog);
					if($custom_blog_query->have_posts()):

					?>
									
									<?php if ($px_node->var_pb_blog_title <> '') { ?>
										<header class="pix-heading-title">
											<h2 class="pix-heading-color pix-section-title"><?php echo $px_node->var_pb_blog_title; ?></h2>
										</header>
									<?php }?>
									
									<?php
										echo '<div class="cycle-slideshow" 
											data-cycle-fx=fade
											data-cycle-timeout=3000
											data-cycle-auto-height=container
											data-cycle-slides="article"
											
											data-cycle-random=false
											data-cycle-pager="#banner-pager'.$px_counter_node.'"
											data-cycle-pager-template="">';
											$counter_slideshow=0;
										while ($custom_blog_query->have_posts()) : $custom_blog_query->the_post();
											$counter_slideshow++;
											/*if($counter_slideshow > $px_node->var_pb_blog_num_post){
												break;	
											}*/
											$image_url_full = px_get_post_img_src($post->ID, '500' ,'370');
											if($image_url_full <> ''){
											?>
												<article class="<?php echo $post->ID; ?>">
													<?php if($image_url_full <> ''){?><img src="<?php echo $image_url_full;?>" alt=""><?php }?>
														   <div class="caption">
																<?php 
																	$rating = px_user_rating_display('blog-gallery'.$counter_slideshow);
																	if(isset($rating) && $rating <> ''){
																		?>
																		<div class="heading-color cs-rating-heading">
																			<?php  echo $rating;?>
																		</div>
																<?php }?>
																<div class="text">
																	<h2><a href="<?php the_permalink(); ?>"><?php if ( strlen(get_the_title()) > 50){echo substr(get_the_title(),0,50);} else { the_title();} if ( strlen(get_the_title()) > 50) echo  "...";?></a></h2>
																	<?php px_posted_on(false,false,true,true,true,true);?>
																</div>
														   </div> 
												</article>
											<?php
											}
										endwhile;
									
									echo '</div>';
			
			
								$pagination_no = 0;
								echo '<div class="sliderpagination">
									<ul id="banner-pager'.$px_counter_node.'" class="banner-pager">';
									while ($custom_blog_query->have_posts()) : $custom_blog_query->the_post();
											$pagination_no++;
											/*if($pagination_no > $px_node->var_pb_blog_num_post){
												break;	
											}*/
											$image_url_full = px_get_post_img_src($post->ID, '395' ,'222');
											if($image_url_full <> ''){
												echo '<li><figure><img src="'.$image_url_full.'" alt=""><figcaption>';
													$rating = px_user_rating_horziantal_display();
													if(isset($rating) && $rating <> ''){
														echo $rating;
													 }
												echo '</figcaption></figure></li>';
											}
									endwhile;
									
									echo '</ul></div>';
			
						px_enqueue_cycle_script();
					endif;
					wp_reset_postdata();
					
	}
	 else if($px_node->var_pb_blog_view =="blog-carousel"){
		 $args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'paged' => $_GET['page_id_all'],'order'=>"$post_order");
			if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
				$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
				$args = array_merge($args, $blog_category_array);
			} else {
				$category_ids = get_all_category_ids();
				$category_ids = implode(",", $category_ids);
				$blog_category_array = array('cat' => $category_ids);
				$args = array_merge($args, $blog_category_array);
			}
            $custom_query = new WP_Query($args);
		if($custom_query->have_posts()):
		?>
                        
                        <?php if ($px_node->var_pb_blog_title <> '') { ?>
                            <header class="pix-heading-title">
                                <h2 class="pix-heading-color pix-section-title"><?php echo $px_node->var_pb_blog_title; ?></h2>
                            </header>
                        <?php }?>
                      
						<?php
						$slider_pagination = array();
							echo '<div class="cycle-slideshow" 
								data-cycle-fx=fade
								data-cycle-timeout=3000
								data-cycle-auto-height=container
								data-cycle-slides="article"
								
								data-cycle-random=false
								data-cycle-pager="#banner-pager'.$px_counter_node.'"
								data-cycle-pager-template="">';
								$counter_slideshow=0;
							while ($custom_query->have_posts()) : $custom_query->the_post();
								$counter_slideshow++;
								$image_url_full = px_get_post_img_src($post->ID, '550' ,'340');
								if($image_url_full <> ''){
								$slider_pagination[] = get_the_title();
								?>
									<article class="<?php echo $post->ID; ?>">
                                        <?php if($image_url_full <> ''){?><img src="<?php echo $image_url_full;?>" alt=""><?php }?>
                                        		
                                               <div class="caption">
                                               		<?php 
														$rating = px_user_rating_display('blog-carousel'.$counter_slideshow);
														if(isset($rating) && $rating <> ''){
															?>
															<div class="heading-color cs-rating-heading">
																<?php  echo $rating;?>
															</div>
													<?php }?>
                                                    <div class="text">
                                                		<h2><a href="<?php the_permalink(); ?>"><?php if ( strlen(get_the_title()) > 50){echo substr(get_the_title(),0,50);} else { the_title();} if ( strlen(get_the_title()) > 50) echo  "...";?></a></h2>
                                                        <time datetime="<?php echo date('Y-m-d',strtotime(get_the_date()));?>">
														<?php 
														the_date( get_option('date_format'), '', '', true); 
														//echo date_i18n(get_option('date_format'),strtotime(get_the_date()));
														?>
                                                        </time>
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
						<ul id="banner-pager'.$px_counter_node.'" class="banner-pager">';
							foreach($slider_pagination as $slider){
								$pagination_no++;
								$slider_title = substr($slider,0,50); if ( strlen($slider) > 50) $slider_title .= "...";
								echo '<li>
										<div class="pager-desc">
											
											<span class="cs-desc">'.$slider_title.'</span>
										</div>
									</li>';
							}
						echo '</ul></div>';
				}
			px_enqueue_cycle_script();
		endif;
		wp_reset_postdata();
			}
			else if($px_node->var_pb_blog_view =="blog-carousel-v2"){
				$args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'paged' => $_GET['page_id_all'],'order'=>"$post_order");
			if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
				$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
				$args = array_merge($args, $blog_category_array);
			} else {
					$category_ids = get_all_category_ids();
					$category_ids = implode(",", $category_ids);
					$blog_category_array = array('cat' => $category_ids);
					$args = array_merge($args, $blog_category_array);
				}
            $custom_query = new WP_Query($args);
		if($custom_query->have_posts()):
		px_enqueue_nicescroll();
		?>
                        
                        <?php if ($px_node->var_pb_blog_title <> '') { ?>
                            <header class="pix-heading-title">
                                <h2 class="pix-heading-color pix-section-title"><?php echo $px_node->var_pb_blog_title; ?></h2>
                            </header>
                        <?php }?>
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
								data-cycle-pager="#banner-pager'.$px_counter_node.'"
								data-cycle-pager-template="">';
								$counter_slideshow=0;
							while ($custom_query->have_posts()) : $custom_query->the_post();
								$counter_slideshow++;
								$image_url_full = px_get_post_img_src($post->ID, '550' ,'340');
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
                                                    	<?php px_posted_on(true,false,false,false,false,false);?>
                                                		<h2><a href="<?php the_permalink(); ?>"><?php if ( strlen(get_the_title()) > 50){
															echo substr(get_the_title(),0,50);} else { the_title();} if ( strlen(get_the_title()) > 50) echo  "...";?></a>
                                                         </h2>
                                                        <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>">
															<?php
																the_date( get_option('date_format'), '', '', true); 
														 		//echo date_i18n(get_option('date_format'),strtotime(get_the_date()));
														 	?>
                                                         </time>
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
						<ul id="banner-pager'.$px_counter_node.'" class="banner-pager">';
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
			}
			
	else if($px_node->var_pb_blog_view =="blog-banner-carousel"){
		$args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'paged' => $_GET['page_id_all'],'order'=>"$post_order");
			if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
				$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
				$args = array_merge($args, $blog_category_array);
			} else {
				$category_ids = get_all_category_ids();
				$category_ids = implode(",", $category_ids);
				$blog_category_array = array('cat' => $category_ids);
				$args = array_merge($args, $blog_category_array);
			}
            $custom_query = new WP_Query($args);
		if($custom_query->have_posts()):
		?>
                        
				<?php if ($px_node->var_pb_blog_title <> '') { ?>
                    <header class="pix-heading-title">
                        <h2 class="pix-heading-color pix-section-title"><?php echo $px_node->var_pb_blog_title; ?></h2>
                    </header>
                <?php }?>
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
                                    <li>
                                    <time datetime="<?php echo date('Y-m-d',strtotime(get_the_date()));?>">
										<?php 
											the_date( get_option('date_format'), '', '', true); 
											//echo date_i18n(get_option('date_format'),strtotime(get_the_date()));
										?>
                                    </time></li>
                                
                                </ul>
                               <div class="text-desc">
								 <?php 
                                    px_get_the_excerpt($px_node->var_pb_blog_excerpt,false);
                                    wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Media News' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                                   ?>
                               </div>
                            
                        </div>
                        </figcaption>
                    </figure>
                </article>
					<?php
               		 	endwhile;
					echo '</div>';
				wp_reset_postdata();
			px_enqueue_cycle_script();
			endif;
		
	} else if($px_node->var_pb_blog_view =="blog-grid-v2"){
			$args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'paged' => $_GET['page_id_all'],'order'=>"$post_order");
			if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
				$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
				$args = array_merge($args, $blog_category_array);
			} else {
				$category_ids = get_all_category_ids();
				$category_ids = implode(",", $category_ids);
				$blog_category_array = array('cat' => $category_ids);
				$args = array_merge($args, $blog_category_array);
			}
            $custom_query = new WP_Query($args);
			if ($px_node->var_pb_blog_title <> '' && $px_node->var_pb_blog_view <> 'blog-grid-v2') { ?>
                <header class="pix-heading-title">
                    <?php	if ($px_node->var_pb_blog_title <> '' ) { ?>
                    <h2 class="pix-heading-color pix-section-title"><?php echo $px_node->var_pb_blog_title; ?></h2>
					<?php  } ?>
                </header>
        <?php  }  
            while ($custom_query->have_posts()) : $custom_query->the_post();
				$post_xml = get_post_meta($post->ID, "post", true);	
				$blog_classes = array();
				if ( $post_xml <> "" ) {
					$px_xmlObject = new SimpleXMLElement($post_xml);
					$blog_classes[] = $px_node->var_pb_blog_view;
 					$image_url = px_get_post_img_src($post->ID,$width,$height);
					$image_url_full = px_get_post_img_src($post->ID, '' ,'');
					if($image_url == ""){
						$blog_classes[] = 'no-image';
					}
				}else{
					
					$post_view = '';
					$no_image = '';	
					$image_url_full = '';
				}	
				$user_rating = px_user_rating();
				$user_rating_percent = $user_rating;
				//$format = get_post_format( $post->ID );
				$format = get_post_format( $post->ID );
				?>
				<!-- Blog Post Start -->
                <article <?php post_class($blog_classes); ?>>
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
							if ( comments_open() ) {  
								echo "<li class='px-comments'>"; comments_popup_link( __( '0 Comment', 'Media News' ) , __( '1 Comment', 'Media News' ), __( '% Comments', 'Media News' ) ); 
							}
						?>
                        </ul>
							<?php  echo px_user_rating_display('blog-grid-v2');?>
                          	<h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?>.</a>
                          	<time datetime="<?php echo date('Y-m-d',strtotime(get_the_date()));?>">
						  		<?php 
						  			the_date( get_option('date_format'), '', '', true); 
						  			//echo date_i18n(get_option('date_format'),strtotime(get_the_date()));
						  		?>
                          	</time>
                            </h2>  
                            <div class="text-desc">
								 <?php 
                                    px_get_the_excerpt($px_node->var_pb_blog_excerpt,false,'...');
                                    wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Media News' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                                   ?>
                               </div>
                            
                        </div>
                        </figcaption>
                    </figure>
                </article>
				<!-- Blog Post End -->
            <?php 
			endwhile;
			wp_reset_postdata();
            } else { 	
			$args = array('posts_per_page' => "$px_node->var_pb_blog_num_post", 'paged' => $_GET['page_id_all'],'order'=>"$post_order");
			if(isset($px_node->var_pb_blog_cat) && $px_node->var_pb_blog_cat <> '' && $px_node->var_pb_blog_cat <> '0'){
				$blog_category_array = array('category_name' => "$px_node->var_pb_blog_cat");
				$args = array_merge($args, $blog_category_array);
			} else {
				$category_ids = get_all_category_ids();
				$category_ids = implode(",", $category_ids);
				$blog_category_array = array('cat' => $category_ids);
				$args = array_merge($args, $blog_category_array);
			}
            $custom_query = new WP_Query($args);
			
			if ($px_node->var_pb_blog_title <> '' && ($px_node->var_pb_blog_view == 'blog-large' || $px_node->var_pb_blog_view == 'blog-medium')) { ?>
                <header class="pix-heading-title">
                    <?php	if ($px_node->var_pb_blog_title <> '') { ?>
                    <h2 class="pix-heading-color pix-section-title"><?php echo $px_node->var_pb_blog_title; ?></h2>
					<?php  } ?>
                </header>
        <?php  }  
			$var_pb_blog_desc = 'Yes';
			$var_pb_blog_image = 'Yes';
			if(isset($px_node->var_pb_blog_desc)){
				$var_pb_blog_desc = $px_node->var_pb_blog_desc;
			}
			if(isset($px_node->var_pb_blog_image)){
				$var_pb_blog_image = $px_node->var_pb_blog_image;
			}
            while ($custom_query->have_posts()) : $custom_query->the_post();
				$post_xml = get_post_meta($post->ID, "post", true);	
				$blog_classes = array();
				if ( $post_xml <> "" ) {
					$px_xmlObject = new SimpleXMLElement($post_xml);
					
					$no_image = '';
 					$image_url = px_get_post_img_src($post->ID,$width,$height);
					$image_url_full = px_get_post_img_src($post->ID, '' ,'');
					if($image_url == "" || $var_pb_blog_image <> 'Yes'){
						$blog_classes[] = 'no-image';
					}
					
				}else{
					
					$post_view = '';
					$no_image = '';	
					$image_url_full = '';
				}	
				//$format = get_post_format( $post->ID );
				$format = get_post_format( $post->ID );
				?>
				<!-- Blog Post Start -->
                <article <?php post_class($blog_classes); ?>>
                    <?php if($image_url <> "" && $var_pb_blog_image == 'Yes'){?>
                        <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url;?>" alt=""></a>
                            <figcaption>
                                    <?php echo px_user_rating_display('defaultpost'.$px_node->var_pb_blog_view);?>
                            </figcaption>
                        </figure>
                    <?php }?>
                    <div class="text">
                      <h2 class="pix-post-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?>.</a></h2>
                      <?php 
					  		px_posted_on(true,false,true,true,true,true); 
							if($var_pb_blog_desc == 'Yes'){
								px_get_the_excerpt($px_node->var_pb_blog_excerpt,false,' ...');
								wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Media News' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
							   ?>
							<div class="blog-bottom">
									<a href="<?php the_permalink(); ?>" class="btnreadmore btn pix-bgcolrhvr"><?php if($px_theme_option["trans_switcher"] == "on") {  _e("READ MORE",'Media News'); }else{  echo $px_theme_option["trans_read_more"];}?></a>
							</div>
                        <?php }?>
                    </div>
                </article>
				<!-- Blog Post End -->
               	<?php endwhile;  ?>
                 	<!-- Blog End -->
                    <?php  }?>
    			</div>   
                <?php
                $qrystr = '';
				if ( $px_node->var_pb_blog_view == 'blog-large' || $px_node->var_pb_blog_view == 'blog-medium' || $px_node->var_pb_blog_view == 'blog-grid-v1' || $px_node->var_pb_blog_view == 'blog-grid-v2'){
				   if ( $px_node->var_pb_blog_pagination == "Show Pagination" and $post_count > $px_node->var_pb_blog_num_post and $px_node->var_pb_blog_num_post > 0 ) {
						echo "<nav class='pagination'><ul>";
							if ( isset($_GET['page_id']) ) $qrystr = "&amp;page_id=".$_GET['page_id'];
								echo px_pagination($post_count, $px_node->var_pb_blog_num_post,$qrystr);
						echo "</ul></nav>";
					}
				}
                 // pagination end
             ?>
           </div>