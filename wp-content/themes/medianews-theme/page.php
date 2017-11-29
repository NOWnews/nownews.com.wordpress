<?php get_header();  

					$width =1100;
					$height = 556;
					$image_url ='';
					if (post_password_required()) { 
						echo '<div class="rich_editor_text">'.px_password_form().'</div>';
					}else{
					$px_meta_page = px_meta_page('px_page_builder');
					if (count($px_meta_page) > 0) {
						 ?>
                         <?php if ( $px_meta_page->sidebar_layout->px_layout <> '' and $px_meta_page->sidebar_layout->px_layout <> "none" and ($px_meta_page->sidebar_layout->px_layout == 'left' || $px_meta_page->sidebar_layout->px_layout == 'both_left')) : ?>
                            <aside class="col-md-3">
                                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_meta_page->sidebar_layout->px_sidebar_left) ) : endif; ?>
                             </aside>
                        <?php endif; ?>
                        <?php if ($px_meta_page->sidebar_layout->px_layout <> '' and $px_meta_page->sidebar_layout->px_layout <> "none" and $px_meta_page->sidebar_layout->px_layout == 'both_left'): ?>
                            <aside class="small-sidebar col-md-2">
                              <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_meta_page->sidebar_layout->px_small_sidebar) ) : ?>
                              <?php endif; ?>
                            </aside>
                            <?php wp_reset_postdata();endif; ?>
               	 		<div class="<?php echo px_meta_content_class();?>">
						<?php
							px_page_title();
 							wp_reset_postdata();
							$image_url = px_get_post_img_src($post->ID, $width, $height);
							if($image_url <> ''){ 
								echo '<figure class="featured-img"><a href="'.get_permalink().'" ><img src="'.$image_url.'" alt="" ></a></figure>';
							}
 							if( $px_meta_page->page_content == "on"  && get_the_content() <> ''){
 							echo '<div class="rich_editor_text pix-content-wrap">';
 								if( $px_meta_page->page_content == "on"  && get_the_content() <> ''){
									the_content();
									wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Rocky' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
								}
 							echo '</div>';
						}
						global $px_counter_node;
						foreach ( $px_meta_page->children() as $px_node ) {
							if ( $px_node->getName() == "blog" ) {
								if ( !isset($_SESSION["px_page_back"]) ||  isset($_SESSION["px_page_back"])){
									$_SESSION["px_page_back"] = get_the_ID();
								}
								$px_counter_node++;
								get_template_part( 'page_blog', 'page' );
							} else if ( $px_node->getName() == "gallery_albums" ) {
								$px_counter_node++;
  								if ( $px_node->px_gal_album_cat <> "" ) {
									get_template_part( 'page_gallery_albums', 'page' );
								}
 							}else if ( $px_node->getName() == "gallery" ) {
								$px_counter_node++;
  								if ( $px_node->album <> "" and $px_node->album <> "0" ) {
									get_template_part( 'page_gallery', 'page' );
								}
							}else if ( $px_node->getName() == "slider" ) {
								$px_counter_node++;
								if ( $px_node->slider <> "" and $px_node->slider <> "0" ) {
									get_template_part( 'page_slider', 'page' );
								}

							}elseif($px_node->getName() == "map"){
							   	$px_counter_node++;
								echo px_map_page();
							
 							}elseif($px_node->getName() == "contact"){
							   $px_counter_node++;
							   get_template_part('page_contact','page');
							}elseif($px_node->getName() == "column"){
								$px_counter_node++;
								px_column_page();
							}
						}
                     	wp_reset_query(); 
					 	if ( comments_open() ) : 
					 		comments_template('', true); 
		   				endif; 
						?>
                 </div>
                 	  <?php if ($px_meta_page->sidebar_layout->px_layout <> '' and $px_meta_page->sidebar_layout->px_layout <> "none" and $px_meta_page->sidebar_layout->px_layout == 'both_right'): ?>
                            <aside class="small-sidebar col-md-2">
                              <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_meta_page->sidebar_layout->px_small_sidebar) ) : ?>
                              <?php endif; ?>
                            </aside>
                            <?php wp_reset_query();endif; ?>
					<?php if ( $px_meta_page->sidebar_layout->px_layout <> '' and $px_meta_page->sidebar_layout->px_layout <> "none"  and ($px_meta_page->sidebar_layout->px_layout == 'both_right' || $px_meta_page->sidebar_layout->px_layout == 'right')) : ?>
                            <aside class="sidebar-right col-md-3">
                                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_meta_page->sidebar_layout->px_sidebar_right) ) : endif; ?>
                             </aside>
                        <?php endif; 	
                        
                      	} else if(function_exists( 'is_bbpress' ) && is_bbpress()){
							$px_sidebar_right = $px_small_sidebar = $px_sidebar_left = $px_layout = '';
							$forum_xml = get_post_meta($post->ID, "forum_meta", true);	
							if ( $forum_xml <> "" ) {
								$px_meta_page = new SimpleXMLElement($forum_xml);
								$px_layout = $px_meta_page->sidebar_layout->px_layout;
								if(isset($px_meta_page->sidebar_layout->px_sidebar_left)){
									$px_sidebar_left = $px_meta_page->sidebar_layout->px_sidebar_left;	
								}
								if(isset($px_meta_page->sidebar_layout->px_small_sidebar)){
									$px_small_sidebar = $px_meta_page->sidebar_layout->px_small_sidebar;	
								}
								if(isset($px_meta_page->sidebar_layout->px_sidebar_right)){
									$px_sidebar_right = $px_meta_page->sidebar_layout->px_sidebar_right;	
								}
								
								
								
							} else {
								global $px_theme_option;
								$px_sidebar_right = $px_small_sidebar = $px_sidebar_left = $px_layout = '';
								$px_layout = 'none';
								
								if(isset($px_theme_option['px_layout'])){ $px_layout = $px_theme_option['px_layout']; }elseif(!isset($px_theme_option['px_layout'])){ $px_layout = 'right';}
								if(isset($px_theme_option['px_sidebar_left'])){ $px_sidebar_left = $px_theme_option['px_sidebar_left']; }
								if(isset($px_theme_option['px_small_sidebar'])){ $px_small_sidebar = $px_theme_option['px_small_sidebar']; }
								if(isset($px_theme_option['px_sidebar_right'])){ $px_sidebar_right = $px_theme_option['px_sidebar_right']; }
								
							}
							?>
							<?php if ( $px_layout <> '' and $px_layout <> "none" and ($px_layout == 'left' || $px_layout == 'both_left') && $px_sidebar_left <> '') : ?>
                            <aside class="col-md-3">
                                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_sidebar_left) ) : endif; ?>
                             </aside>
                        <?php endif; ?>
                        <?php if ($px_layout <> '' and $px_layout <> "none" and $px_layout == 'both_left' && $px_small_sidebar <> ''): ?>
                            <aside class="small-sidebar col-md-2">
                              <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_small_sidebar) ) : ?>
                              <?php endif; ?>
                            </aside>
                            <?php wp_reset_query();endif; ?>
							<div class="<?php echo px_default_pages_meta_content_class($px_layout);?>">
                            	<?php px_page_title();?>
                            	<?php 
									the_content();
									wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Rocky' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
								?>
                          	</div>
                            <?php if ($px_layout <> '' and $px_layout <> "none" and $px_layout == 'both_right'): ?>
                            <aside class="small-sidebar col-md-2">
                              <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_small_sidebar) ) : ?>
                              <?php endif; ?>
                            </aside>
                            <?php wp_reset_query();endif; ?>
					<?php if ( $px_layout <> '' and $px_layout <> "none"  and ($px_layout == 'both_right' || $px_layout == 'right')) : ?>
                            <aside class="sidebar-right col-md-3">
                                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_sidebar_right) ) : endif; ?>
                             </aside>
                        <?php endif; 	
             			}else{
						
						px_page_title();
						 ?> 
                    
                    
            		<div class="rich_editor_text pix-content-wrap">
					<?php 
                        while (have_posts()) : the_post();
							$image_url = px_get_post_img_src($post->ID, $width, $height);
								if($image_url <> ''){ 
									echo '<figure class="featured-img"><a href="'.get_permalink().'" ><img src="'.$image_url.'" alt="" ></a></figure>';
								}
                            the_content();
							wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Rocky' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                        endwhile; 
						if ( comments_open() ) { 
					 		comments_template('', true); 
						}
						wp_reset_query();
                    ?>
                	</div>
			<?php }
			} 
		?>
<?php get_footer();?>
<!-- Columns End -->