<?php 
get_header();

?>
	
    		<?php
			/***************** Shop Page ******************/
			if(is_shop()){
				$px_shop_id = woocommerce_get_page_id( 'shop' );
				$px_meta_page = px_meta_shop_page('px_page_builder', $px_shop_id);
				if ( !isset($_SESSION["px_page_back_shop"]) ||  isset($_SESSION["px_page_back_shop"])){
					$_SESSION["px_page_back_shop"] = $px_shop_id;
				}
				if (post_password_required($px_shop_id)) { 
					echo '<div class="rich_editor_text">'.px_password_form().'</div>';
				}else{
					if ( $px_meta_page->sidebar_layout->px_layout <> '' and $px_meta_page->sidebar_layout->px_layout <> "none" and $px_meta_page->sidebar_layout->px_layout == 'left') :   ?>
						<aside class="col-md-3">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_meta_page->sidebar_layout->px_sidebar_left) ) : endif; ?>
						</aside>
					<?php endif; ?>
				<div class="<?php echo px_meta_content_class();?> page_element_area">
				<?php
				if (count($px_meta_page) > 0) {
					wp_reset_query();
					if($px_meta_page->page_content == "on"){
						echo '<div class="rich_editor_text">';
							$content_post = get_post($px_shop_id);
							$content = $content_post->post_content;
							$content = apply_filters('the_content', $content);
							$content = str_replace(']]>', ']]&gt;', $content);
							echo $content;
						echo '</div>';
						
					}
					if ( have_posts() ) :
						echo "<div class='px_shop_wrap'>";
							woocommerce_content();
						echo "</div>";
					endif;
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
				}
			
			wp_reset_query(); 
			if ( comments_open() ) : 
				comments_template('', true); 
			endif; 
			?>
            
        </div>
        		<?php if ( $px_meta_page->sidebar_layout->px_layout <> '' and $px_meta_page->sidebar_layout->px_layout <> "none" and $px_meta_page->sidebar_layout->px_layout == 'right') : ?>
                <aside class="col-md-3">
                     <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_meta_page->sidebar_layout->px_sidebar_right) ) : endif; ?>
                </aside>
            <?php endif; 
        
			}
 		}else if(is_single()){
				$px_layout = "col-md-12";
				if ( have_posts() ) :
					$post_xml = get_post_meta($post->ID, "product", true);	
					if ( $post_xml <> "" ) {
						$px_xmlObject = new SimpleXMLElement($post_xml);
						$sub_title = $px_xmlObject->sub_title;
						
						$px_layout = $px_xmlObject->sidebar_layout->px_layout;
						$px_sidebar_left = $px_xmlObject->sidebar_layout->px_sidebar_left;
						$px_sidebar_right = $px_xmlObject->sidebar_layout->px_sidebar_right;
						if ( $px_layout == "left") {
							$px_layout = "content-right col-md-9";
						}
						else if ( $px_layout == "right" ) {
							$px_layout = "content-left col-md-9";
						}
						else {
							$px_layout = "col-md-12";
						}
					}
					if ($px_layout == 'content-right col-md-9'){ ?>
                        <aside class="sidebar-left col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_sidebar_left) ) : ?><?php endif; ?></aside>
                    <?php } ?>
                    <div class="<?php echo $px_layout; ?> px_shop_wrap page_element_area">
						<?php woocommerce_content(); ?>
                    </div>
                     <?php if ( $px_layout  == 'content-left col-md-9'){ ?>
                	<aside class="sidebar-right col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_sidebar_right) ) : ?><?php endif; ?></aside>
					<?php } ?>
                <?php
				endif;
			}
			/***************** Shop Taxonomies pages ******************/
			else if(is_product_category() or is_product_tag()){
				global  $px_theme_option; 
				isset($px_theme_option['px_layout']); $px_layout = $px_theme_option['px_layout'];
				if ( have_posts() ) :
			?>
            	
					
					<div class="col-md-12 px_shop_wrap page_element_area">
						<?php woocommerce_content(); ?>
					</div>
					
                
                <?php endif; ?>
                
            <?php
			}
			
			/***************** Shop Other Pages ******************/
			
			else{
				if ( have_posts() ) :
			?>
                    <div class="px_shop_wrap page_element_area">
                        <?php woocommerce_content(); ?>
                    </div>
                
                <?php endif; ?>
            <?php
			}
		?>
        
<?php get_footer(); ?>
