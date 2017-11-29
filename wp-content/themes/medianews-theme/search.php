<?php
	get_header();
 global  $px_theme_option;
 $px_layout = '';
	if(isset($px_theme_option['px_layout'])){ $px_layout = $px_theme_option['px_layout']; }elseif(!isset($px_theme_option['px_layout'])){ $px_layout = 'right';}
 
 if ( $px_layout <> '' and $px_layout  <> "none" and ($px_layout  == 'left' || $px_layout  == 'both_left')) :  ?>
        <aside class="left-sidebar col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_theme_option['px_sidebar_left']) ) : endif; ?>
        </aside>
<?php endif;
 if ( $px_layout <> '' and $px_layout  <> "none" and $px_layout  == 'both_left') :  ?>
        <aside class="small-sidebar col-md-2">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_theme_option['px_small_sidebar']) ) : endif; ?>
        </aside>
<?php endif;?>

        <div class="<?php px_default_pages_meta_content_class( $px_layout ); ?>">
        <?php px_page_title();?>
	       	<div class="pix-blog blog-medium">
                 <!-- Blog Post Start -->
                 <?php
                
               		if ( have_posts() ) {
						 while ( have_posts() ) : the_post();
						 
						 	px_defautlt_artilce();
						  
						endwhile;   
						
						$qrystr = '';
						// pagination start
						if ($wp_query->found_posts > get_option('posts_per_page')) {
	
							echo "<nav class='pagination'><ul>";
								if ( isset($_GET['s']) ) $qrystr = "&s=".$_GET['s'];
								if ( isset($_GET['page_id']) ) $qrystr .= "&page_id=".$_GET['page_id'];
								echo px_pagination($wp_query->found_posts,get_option('posts_per_page'), $qrystr);
							 echo "</ul></nav>";
						}
						// pagination end
					
					}else{
					?>
                    <aside class="col-md-3">
                		<div class="widget widget_search">
                        	<header class="heading">
                            	<h2 class="section_title heading-color"><?php _e( 'No results found.', 'Media News'); ?></h2>
                            </header>
                        	<?php get_search_form(); ?>
                    	</div>
                    </aside>
                	<?php 
					}
					?>
               	</div>
                <?php
                	
             	?>                    
         </div>
	  <?php
	  	 if ( $px_layout <> '' and $px_layout  <> "none" and $px_layout  == 'both_right') :  ?>
        <aside class="small-sidebar col-md-2">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_theme_option['px_small_sidebar']) ) : endif; ?>
        </aside>
		<?php endif;
		if ( $px_layout <> '' and $px_layout  <> "none" and ($px_layout  == 'right'|| $px_layout  == 'both_right')) :  ?>
		<aside class="right-sidebar col-md-3">
			<?php 
            if(isset($px_theme_option['px_sidebar_right'])){
                if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($px_theme_option['px_sidebar_right']) ) : endif;
            }else{
                if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1') ) : endif;
            }
      		?>
		</aside>
	<?php endif;?>
<?php get_footer();?>
<!-- Columns End -->