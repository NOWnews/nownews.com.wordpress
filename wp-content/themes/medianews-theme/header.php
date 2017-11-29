<?php
	global $px_theme_option, $px_page_builder, $px_meta_page, $px_node;
	$px_theme_option = get_option('px_theme_option');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>
	<?php
	    bloginfo('name'); ?> | 
    <?php 
		if ( is_home() or is_front_page() ) { bloginfo('description'); }
		else { wp_title(''); }
    ?>
    </title>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="shortcut icon" href="<?php echo $px_theme_option['fav_icon'] ?>" />
    <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<?php 
	if(isset($px_theme_option['header_code']))
    	echo  htmlspecialchars_decode($px_theme_option['header_code']); 
	    if ( is_singular() && get_option( 'thread_comments' ) )
        	wp_enqueue_script( 'comment-reply' );  
         	wp_head(); 
    ?>
    </head>
	<body <?php body_class(); ?> >
		<div id="wrappermain-pix" class="wrapper <?php px_wrapper_class();?>">
		<!-- Header Start -->
        <div class="mainheader">
            <!-- Top Strip Start -->
            
 <?php  if(isset($px_theme_option['top_strip_switcher']) and $px_theme_option['top_strip_switcher'] == 'on') { ?> 
			
            <div class="top-strip">
                <!-- Top Nav Start -->
                <nav class="top-nav">
                    <?php px_navigation('top-menu', 'top_menus'); ?>
                </nav>
                <!-- Top Nav End -->
                 <?php  if(isset($px_theme_option['header_search']) and $px_theme_option['header_search'] == 'on'){?>    
                         <!-- Search Start -->
                         <div class="searchform">
                            <?php echo px_search(); ?>
                        </div>
                         <!-- Search End -->
                  <?php } ?>
            </div>
            
            <?php } ?>
     
            <!-- Top Strip End -->
            <div class="container">
                <!-- Top Header Start -->
                <div class="top-head">
                    <div class="logo">
                        <?php
                             if(isset($px_theme_option['logo']) && $px_theme_option['logo'] <> ''){
                                  px_logo($px_theme_option['logo'], $px_theme_option['logo_width'], $px_theme_option['logo_height']);
                            } else {
								echo '<a href="'.home_url().'">';
                                	bloginfo('name');
								echo '</a>';
                            }
                         ?>
                    </div>
                     <?php 
					$advertisingwidgets = wp_get_sidebars_widgets();
					
					if(isset($advertisingwidgets['header-advertisement-widget']) && count($advertisingwidgets['header-advertisement-widget'])>0){?>
                        <div class="rightheader">
                            <div class="widget widget_text">
                                <div class="textwidget">
                                    <div class="ads-banner">
                                        <div class="top_banner">
                                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('header-advertisement-widget')) : ?><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
                <!-- Top Header End -->
                <div class="inner-sec pix-bdrcolr">
                    <nav class="navigation">
                    	<a class="cs-click-menu"><i class="fa fa-bars"></i></a>
                    	<?php px_navigation('main-menu'); ?>
                    </nav>
                    <!-- Wp Sec Start -->
                     <?php px_header_cart_languages();?>
                     <!-- Wp Sec End -->
                </div>
                <?php px_header_socialnetwork_announcement_section();?> 
                </div>
                <!-- News Section Start -->
            </div>
    <!-- Header Close -->
    <div class="clear"></div>
    <div id="main">
        <!-- Inner Main -->
        <div id="innermain">
           <?php
			if(is_home() and is_front_page()) {
					if(isset($advertisingwidgets['home-top-widget']) && count($advertisingwidgets['home-top-widget'])>0){?>
						<div class="home-top-widget">
							<div class="container">
								<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-top-widget')) : ?><?php endif; ?>
							</div>
						</div>
				 <?php }
				}?>
           <div class="container">
                <div class="row">

				<?php
					//wp_reset_query();
					
					px_home_slider();
		
				  if(!is_home() and !is_front_page()) {
					$page_breadcrumbs = '';
					if(is_page()){
						if ( isset($px_xmlObject->page_breadcrumbs) ) $page_breadcrumbs = $px_xmlObject->page_breadcrumbs;
					} else if(function_exists( 'is_bbpress' ) && is_bbpress()){
						if ( isset($px_xmlObject->page_breadcrumbs) ) $page_breadcrumbs = $px_xmlObject->page_breadcrumbs;
					} else {
						if ( isset($px_theme_option['header_breadcrumbs']) ) $page_breadcrumbs = $px_theme_option['header_breadcrumbs'];
					}
					 if(isset($page_breadcrumbs) && $page_breadcrumbs <> ''){
					  ?>
						<div class="breadcrumb"> 
							<?php px_breadcrumbs(); ?>
						</div>
					<?php }
				 }