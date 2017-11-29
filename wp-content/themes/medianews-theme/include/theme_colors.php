<?php
	if ( ! function_exists( 'px_custom_styles' ) ) {
		add_action('wp_head', 'px_custom_styles');
		// Corlor Styles for front end
		function px_custom_styles() {
			global $px_theme_option;
			$nav_bg_color = $nav_color = '';
			if ( isset($_POST['style_sheet']) ) {
				$_SESSION['mnsess_style_sheet'] = $_POST['style_sheet'];
				$px_color_scheme = $_SESSION['mnsess_style_sheet'];
			}
			
			elseif (isset($_SESSION['mnsess_style_sheet']) and $_SESSION['mnsess_style_sheet'] <> '') {
				$px_color_scheme = $_SESSION['mnsess_style_sheet'];
			} else {
				$px_color_scheme = $px_theme_option['custom_color_scheme'];
			}
			
			if(isset($px_theme_option['nav_bg_color']) && $px_theme_option['nav_bg_color'] <> ''){
				$nav_bg_color = $px_theme_option['nav_bg_color'];
			}
			if(isset($px_theme_option['footer_bg_color']) && $px_theme_option['footer_bg_color'] <> ''){
				$footer_bg_color = $px_theme_option['footer_bg_color'];
			}
			if(isset($px_theme_option['nav_color']) && $px_theme_option['nav_color'] <> ''){
				$nav_color = $px_theme_option['nav_color'];
			}
			
			if(!isset($px_color_scheme) || $px_color_scheme == ''){
				$px_color_scheme = '#d23733';
			}
			if(!isset($header_bg_color) || $header_bg_color == ''){
				$header_bg_color = '#fff';
			}
			if(!isset($nav_bg_color) || $nav_bg_color == ''){
				$nav_bg_color = '#292A32';
			}
			if(!isset($nav_color) || $nav_color == ''){
				$nav_color = '#959595';
			}
			
			
			// Custom background image
			$bg_image_backgournd  = '';
			$pattern = '';
			$bg_color = '';
			
			if ( isset($_POST['custome_pattern']) ) {
		
				$_SESSION['mnsess_custome_pattern'] = $_POST['custome_pattern'];
		
				$pattern = get_template_directory_uri()."/images/pattern/pattern".$_SESSION['mnsess_custome_pattern'].".png";
		
			}
		
			else if ( isset($_SESSION['mnsess_custome_pattern']) and !empty($_SESSION['mnsess_custome_pattern'])){
		
				$pattern = get_template_directory_uri()."/images/pattern/pattern".$_SESSION['mnsess_custome_pattern'].".png";
		
			}
		
			else {
		
				if (isset($px_theme_option['custome_pattern']) and $px_theme_option['custome_pattern'] == "" ) {
		
					if (isset($px_theme_option['pattern_img']) and $px_theme_option['pattern_img'] <> 0 ){
		
						$pattern = get_template_directory_uri()."/images/pattern/pattern".$px_theme_option['pattern_img'].".png";
		
					}
		
				}
		
				else { 
					if ( isset($px_theme_option['custome_pattern']) )
						$pattern = $px_theme_option['custome_pattern'];
		
				}
		
			}
		
			// pattern end
		
			// bg color start
			
		
			if ( isset($_POST['bg_color']) ) {
		
				$_SESSION['mnsess_bg_color'] = $_POST['bg_color'];
		
				$bg_color = $_SESSION['mnsess_bg_color'];
		
			}
		
			else if ( isset($_SESSION['mnsess_bg_color']) ){
		
				$bg_color = $_SESSION['mnsess_bg_color'];
		
			}
		
			else {
				if ( isset($px_theme_option['bg_color']) )
					$bg_color = $px_theme_option['bg_color'];
		
			}
		
			// bg color end
			if($bg_color <> '' or $pattern <> ''){
				$bg_image_backgournd = ' background:'.$bg_color.' url('.$pattern.'); ';
			}
			
			
			
			
			
			$bg_img = '';
			
			
			
			
			
			if ( isset($_POST['bg_img']) ) {
		
				$_SESSION['mnsess_bg_img'] = $_POST['bg_img'];
				$_SESSION['mnsess_custome_pattern'] = '';
		
				$bg_img = get_template_directory_uri()."/images/background/bg".$_SESSION['mnsess_bg_img'].".png";
		
			}
		
			else if ( isset($_SESSION['mnsess_bg_img']) and !empty($_SESSION['mnsess_bg_img'])){
		
				$bg_img = get_template_directory_uri()."/images/background/bg".$_SESSION['mnsess_bg_img'].".png";
		
			}
		
			else {
		
				if (isset($px_theme_option['bg_img_custom']) and $px_theme_option['bg_img_custom'] == "" ) {
		
					if (isset($px_theme_option['bg_img']) and $px_theme_option['bg_img'] <> 0 ){
		
						$_SESSION['mnsess_custome_pattern'] = '';
						$bg_img = get_template_directory_uri()."/images/background/bg".$px_theme_option['bg_img'].".png";
		
					}
		
				}
		
				else  { 
		
					if(isset($px_theme_option['bg_img_custom']))
						$bg_img = $px_theme_option['bg_img_custom'];
						$_SESSION['mnsess_custome_pattern'] = '';
		
				}
		
			}
			
			if ( $bg_img <> "" ) {
		
				$bg_image_backgournd = 'background:url('.$bg_img.') ' . $px_theme_option['bg_repeat'] . ' top  ' . $px_theme_option['bg_position'] . ' 		' . $px_theme_option['bg_attach'].';';
		
			}
			
			
			
			if ( isset($_POST['patter_or_bg']) && $_POST['patter_or_bg'] <> '1' ) {
			
					
					if ( isset($_POST['custome_pattern']) ) {
		
						$_SESSION['mnsess_custome_pattern'] = $_POST['custome_pattern'];
						$_SESSION['mnsess_bg_img'] = '';
						$pattern = get_template_directory_uri()."/images/pattern/pattern".$_SESSION['mnsess_custome_pattern'].".png";
				
					}
				
					// bg color end
					if($bg_color <> '' or $pattern <> ''){
						$bg_image_backgournd = ' background:'.$bg_color.' url('.$pattern.'); ';
					}	
				
			}
			
		
			
			
			?>
	
			<style type="text/css">
			.pix-colr, .pix-colrhvr:hover,.breadcrumbs ul li.pix-active,#footer p a:hover,.is-countdown span:before,.latest-video .minus-column article:hover h2 a,
	/* New Clases Add*/.event-listing article:hover .text .pix-post-title a,.blog-medium-options li a,.is-countdown span,.pix-blog article:hover h2.pix-post-title a,
	.pix-blog article .post-options li a:hover,.tabs.horizontal .nav-tabs li.active a,.blog-home .tabs.horizontal .nav-tabs li:hover a { color:<?php  echo $px_color_scheme; ?> !important;
			}
			.pix-bgcolr,.pix-bgcolrhvr:hover,.cart-sec span,.navigation ul ul li:hover > a,.navigation ul > li.current-menu-item > a,
			.navigation ul ul li.current-menu-item > a,.cycle-pager-active,.widget .tagcloud a:hover,.flex-direction-nav li a:hover, .our-team-sec article:hover figure figcaption .pix-post-title a,.footer-widget .widget_newsletter .error,.news-section article:hover .text,.password_protected form input[type="submit"],.team-vertical article figcaption .caption h2,
	#respond form input[type="submit"],#wp-calendar caption,.gallery ul li figure figcaption a,.woocommerce-pagination ul li a:hover,.woocommerce-pagination ul li span,.woocommerce-tabs .tabs .active a, span.match-category.cat-neutral, .event.event-listing article:hover .text .btn,.widget_search form input[type="submit"], .woocommerce .button,.onsale,.gallery ul li:hover .text,.footer-icons .followus a:hover,
	/* New Clases Add*/.searchform button,.tabs.horizontal .nav-tabs li.active a,p.stars span a.active,.event.event-listing.event-listing-v2 .btn-viewall,.featured-title,.next-post-paginate a:hover,
	.pix-feature article .blog-bottom .btn,.pix-feature .featured,.blog-vertical .tab-content header.pix-heading-title h2,header #lang_sel a:hover, header #lang_sel ul ul a:hover,
	.post-tags a:hover,.pix-tittle,nav.navigation > ul > li:hover > a, nav.navigation > ul > li.current-menu-ancestor > a,.table tbody tr:hover,.widget_newsletter label .btn,.detail_figure .mejs-audio.mejs-container .mejs-controls,
	.detail_figure .mejs-audio.mejs-container,.latest-video .minus-column article:hover .uppercase,.flexslider ul li .caption h2,.pagination > ul > li > span.active,.pagination > ul > li > a.active, .pagination > ul > li > a:hover,.widget_nav_menu ul li a:hover, .widget_nav_menu ul li ul li a:hover, .widget_pages ul li a:hover,
	.widget_recent_entries ul li:hover, .widget_recent_comments ul li:hover, .widget_archive ul li:hover, .widget_links ul li:hover, .widget_meta ul li:hover, .widget_layered_nav ul li:hover, .widget_categories ul li:hover,
	h2 .bbp-forum-title,.widget .bbp-forum-title:hover, .widget .bbp-view-title:hover,#respond > h3:after{
				background-color:<?php  echo $px_color_scheme; ?> !important;
			}
			.pix-bdrcolr ,.tabs.horizontal .nav-tabs li.active,.address-info .text,.subtitle h1,.about-us article .text,blockquote,.blog-gallery .sliderpagination ul li.cycle-pager-active figure:before,
			.footer-icons .followus a:hover,.px-mega-menu > li > a:before,header.pix-heading-title h2:before,.blog-banner-carousel figure:before,.tabs.horizontal .nav-tabs li.active a {
				border-color:<?php  echo $px_color_scheme; ?> !important;
			}
			#banner .flexslider figcaption .pix-desc h3 span {
			   box-shadow: -10px  0 0 <?php  echo $px_color_scheme; ?>,10px  0 0 <?php  echo $px_color_scheme; ?> !important; 
			}
			.our-team-sec article:hover figure figcaption .pix-post-title a{
				 box-shadow: -10px  0 0 <?php  echo $px_color_scheme; ?>,10px  0 0 <?php  echo $px_color_scheme; ?> !important;   
			}
			.latest-video .minus-column article:hover figure{
				 box-shadow: 0 0 0 2px <?php  echo $px_color_scheme; ?>;
			}
			.footer-widget{
				background-color:<?php  echo $footer_bg_color; ?> !important;
			}
			header#header .top-head, .inner-sec{
				background-color:<?php  echo $nav_bg_color; ?> !important;
			}
			nav.navigation > ul > li > a, li.sub-mega-menu .px-mega-menu ul li a, .sub-menu > li a, .px-mega-menu li a{
				color:<?php  echo $nav_color; ?> !important;
			}
			heade #mainheader{
				background-color:<?php  echo $nav_bg_color; ?> !important;
			}
			.sliderpagination ul li:before{
				border-color: transparent <?php  echo $px_color_scheme; ?> !important;
			}
			.footer-widget .widget_newsletter .error:before{
				border-top-color: <?php  echo $px_color_scheme; ?> !important;
			}
			body{
				<?php  echo $bg_image_backgournd; ?>
			}
			
			</style>
			<?php 
		}
	}
	if ( ! function_exists( 'px_color_switcher' ) ) {
	// Corlor Switcher for front end
		add_action('wp_head', 'px_color_switcher');
		function px_color_switcher(){
	
		global $px_theme_option;
	
		if ( isset($px_theme_option['color_switcher']) && $px_theme_option['color_switcher'] == "on" ) {
	
			if ( empty($_POST['patter_or_bg']) ){
	
				$_POST['patter_or_bg'] = '';
	
			}
	
			if ( empty($_POST['reset_color_txt']) ) { 
	
				$_POST['reset_color_txt'] = "";
	
			}
	
			else if ( $_POST['reset_color_txt'] == "1" ) {
				
				$_POST['layout_option'] = $px_theme_option['layout_option'];
	
				$_POST['custome_pattern'] = "";
	
				$_POST['bg_img'] = "";
	
				$_POST['style_sheet'] = $px_theme_option['custom_color_scheme'];
	
			}
	
			
	
			if ( $_POST['patter_or_bg'] == 0 ){
	
				$_SESSION['mnsess_bg_img'] = '';
	
			}
	
			else if ( $_POST['patter_or_bg'] == 1 ){
	
				$_SESSION['mnsess_custome_pattern'] = '';
	
			}
	
			
	
			if ( isset($_POST['layout_option']) ) {
	
				$_SESSION['mnsess_layout_option'] = $px_theme_option['layout_option'];
	
			}
	
			if ( isset($_POST['style_sheet']) ) {
	
				$_SESSION['mnsess_style_sheet'] = $_POST['style_sheet'];
	
			}
	
			
	
			if ( isset($_POST['custome_pattern']) ) {
	
				$_SESSION['mnsess_custome_pattern'] = $_POST['custome_pattern'];
	
			}
	
			if ( isset($_POST['bg_img']) ) {
	
				$_SESSION['mnsess_bg_img'] = $_POST['bg_img'];
	
			}
	
	
	
			if ( empty($_SESSION['mnsess_layout_option']) or $_POST['reset_color_txt'] == "1" ) { $_SESSION['mnsess_layout_option'] = ""; }
	
			if ( empty($_SESSION['mnsess_header_styles']) or $_POST['reset_color_txt'] == "1" ) { $_SESSION['mnsess_header_styles'] = ""; }
	
			if ( empty($_SESSION['mnsess_style_sheet']) or $_POST['reset_color_txt'] == "1" ) { $_SESSION['mnsess_style_sheet'] = ''; }
	
			if ( empty($_SESSION['mnsess_custome_pattern']) or $_POST['reset_color_txt'] == "1" ) { $_SESSION['mnsess_custome_pattern'] = ""; }
	
			if ( empty($_SESSION['mnsess_bg_img']) or $_POST['reset_color_txt'] == "1" ) { $_SESSION['mnsess_bg_img'] = ""; }
	
	
	
			$theme_path = get_template_directory_uri();	
	
			wp_enqueue_style( 'wp-color-picker' );
	
			
	
			wp_enqueue_script('iris',admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),false, 1  );
	
			wp_enqueue_script('wp-color-picker',admin_url( 'js/color-picker.min.js' ),array( 'iris' ),false,1);
	
			$colorpicker_l10n = array(
	
				'clear' => 'Clear',
	
				'defaultString' => 'Default',
	
				'pick' => 'Select Color'
	
			);
	
			wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );
	
	?>
	
	
	
			<script type="text/javascript">
	
			jQuery(document) .ready(function($){
	
				jQuery("#togglebutton").click(function(){
	
					jQuery("#sidebarmain").trigger('click')
	
					jQuery(this).toggleClass('btnclose');
	
					jQuery("#sidebarmain") .toggleClass('sidebarmain');
	
					return false; 
	
			   });
	
			   jQuery("#pattstyles li label") .click(function(){
				   var classname=jQuery("#wrappermain-pix") .hasClass("wrapper_boxed"); 
				   if(classname == false) { 

						alert("Please select Boxed View")
	
						return false; 
	
					} else {
	
						jQuery("#backgroundimages li label") .removeClass("active");	
	
						jQuery("#patter_or_bg") .attr("value","0");
	
						var ah = jQuery(this) .find('input[type="radio"]') .val();
	
						jQuery('body') .css({"background":"url(<?php echo $theme_path?>/images/pattern/pattern"+ah+".jpg)"});
					}
				
	
		  });
	
		  jQuery("#backgroundimages li label") .click(function(){
			  
			   	var classname=jQuery("#wrappermain-pix") .hasClass("wrapper_boxed"); 
			   

		// var classname=$(".layoutoption li:first-child label") .hasClass("active"); 

			if(classname == false) { 

				alert("Please select Boxed View")

				return false; 

				

			} else {
	
					$("#patter_or_bg") .attr("value","1");
	
					$("#pattstyles li label") .removeClass("active");	
					
					$(this) .parents(".selectradio") .find("label") .removeClass("active");
	
					$(this) .addClass("active");
	
					var ah = $(this) .find('input[type="radio"]') .val();
	
					$('body') .css({"background":"url(<?php echo $theme_path?>/images/background/bg"+ah+".png) no-repeat center / cover fixed"});
			}
	
		  
	
		 });
	
	   $("#backgroundimages li label, #pattstyles li label") .click(function($){
		   
			
			var classname=$(".layoutoption li:first-child label") .hasClass("active"); 
	
			if(classname) {
				
				alert("Please select Boxed View")
	
				return false; 
	
			}else {
		
			  $(this) .parents(".selectradio") .find("label") .removeClass("active");
	
			  $(this) .addClass("active");
	
	
		
	
			 }
	
		});
	
					jQuery(".layoutoption li label") .click(function(){
	
						//jQuery("#header").scrollToFixed();
	
		var th = $(this).find('input') .val();
	
		$("#wrappermain-pix") .attr('class','');
	
		$('#wrappermain-pix') .addClass(th);
	
					$(this) .parents(".selectradio") .find("label") .removeClass("active");
	
					$(this) .addClass("active");
	
	
					});
	
		
	
		$(".accordion-sidepanel .innertext") .hide();
	
		$(".accordion-sidepanel header") .click(function(){
	
		 if ($(this) .next() .is(":visible")){
	
		   $(".accordion-sidepanel .innertext") .slideUp(300);
	
		   $(".accordion-sidepanel header") .removeClass("active");
	
		   return false;
	
		  }
	
		$(".accordion-sidepanel .innertext") .slideUp(300);
	
		$(".accordion-sidepanel header") .removeClass("active");
	
		$(this) .addClass("active");
	
		$(this).next() .slideDown(300);
	
		 
	
		
	
		});
	
		
	
			});
	
	
	
		jQuery(document).ready(function($){
	
			jQuery(".colorpicker-main").click(function(){
	
			jQuery(this).find('.wp-color-result').trigger('click'); 
	
		});
	
		<!-- Color-->
	
		var cf = '.pix-colr, .pix-colrhvr:hover,.breadcrumbs ul li.pix-active,#footer p a:hover,.is-countdown span:before,.latest-video .minus-column article:hover h2 a,/* New Clases Add*/.event-listing article:hover .text .pix-post-title a,.blog-medium-options li a,.is-countdown span,.pix-blog article:hover h2.pix-post-title a,.pix-blog article .post-options li a:hover,.tabs.horizontal .nav-tabs li.active a,.blog-home .tabs.horizontal .nav-tabs li:hover a'; 
	
		<!-- Background Color-->
	
	var bc ='.pix-bgcolr,.pix-bgcolrhvr:hover,.cart-sec span,.navigation ul ul li:hover > a,.navigation ul > li.current-menu-item > a,.navigation ul ul li.current-menu-item > a,.cycle-pager-active,.widget .tagcloud a:hover,.flex-direction-nav li a:hover, .our-team-sec article:hover figure figcaption .pix-post-title a,.footer-widget .widget_newsletter .error,.news-section article:hover .text,.password_protected form input[type="submit"],.team-vertical article figcaption .caption h2,#respond form input[type="submit"],#wp-calendar caption,.gallery ul li figure figcaption a,.woocommerce-pagination ul li a:hover,.woocommerce-pagination ul li span,.woocommerce-tabs .tabs .active a, span.match-category.cat-neutral, .event.event-listing article:hover .text .btn,.widget_search form input[type="submit"], .woocommerce .button,.onsale,.gallery ul li:hover .text,.footer-icons .followus a:hover,/* New Clases Add*/.searchform button,.tabs.horizontal .nav-tabs li.active a,p.stars span a.active,.event.event-listing.event-listing-v2 .btn-viewall,.featured-title,.next-post-paginate a:hover,.pix-feature article .blog-bottom .btn,.pix-feature .featured,.blog-vertical .tab-content header.pix-heading-title h2,header #lang_sel a:hover, header #lang_sel ul ul a:hover,.post-tags a:hover,.pix-tittle,nav.navigation > ul > li:hover > a, nav.navigation > ul > li.current-menu-ancestor > a,.table tbody tr:hover,.widget_newsletter label .btn,.detail_figure .mejs-audio.mejs-container .mejs-controls,.detail_figure .mejs-audio.mejs-container,.latest-video .minus-column article:hover .uppercase,.flexslider ul li .caption h2,.pagination > ul > li > span.active,.pagination > ul > li > a.active,.pagination > ul > li > a:hover,.widget_nav_menu ul li a:hover,.widget_nav_menu ul li ul li a:hover,.widget_pages ul li a:hover,.widget_recent_entries ul li:hover,.widget_recent_comments ul li:hover,.widget_archive ul li:hover,.widget_links ul li:hover,.widget_meta ul li:hover,.widget_layered_nav ul li:hover,.widget_categories ul li:hover,h2 .bbp-forum-title,.widget .bbp-forum-title:hover,.widget .bbp-view-title:hover,#respond > h3:after';
	
		<!-- Border Color-->
	
		var boc ='.pix-bdrcolr ,.tabs.horizontal .nav-tabs li.active,.address-info .text,.subtitle h1,.about-us article .text,blockquote,.blog-gallery .sliderpagination ul li.cycle-pager-active figure:before,.footer-icons .followus a:hover,.px-mega-menu > li > a:before,header.pix-heading-title h2:before,.blog-banner-carousel figure:before,.tabs.horizontal .nav-tabs li.active a';
	
		<!-- Border Transparent Color-->
	
		var boc2 =".sliderpagination ul li:before";
		
		var bck = ".datepicker thead tr:first-child th";
	
		jQuery("#colorpickerwrapp span.col-box") .live("click",function(event) {
				//alert('test');
				var a = jQuery(this).data('color');
				//alert(a);
				jQuery("#bgcolor").val(a);
				jQuery('.wp-color-result').css('background-color', a);
				$("#color_switcher_stylecss") .remove();
				$("<style type='text/css' id='color_switcher_stylecss'>"+cf+"{color:"+a+" !important}"+bc+"{background-color:"+a+" !important}"+bck+"{background:"+a+" !important}"+boc+"{border-color:"+a+" !important}"+boc2+"{border-color:transparent "+a+" !important}</style>").insertAfter("#wrappermain-pix");
				
				jQuery("#colorpickerwrapp span.col-box") .removeClass('active');
				jQuery(this).addClass("active");
			});
	
		jQuery('#themecolor .bg_color').wpColorPicker({
	
			change:function(event,ui){
			
	
				var a = ui.color.toString();
				
				$("#color_switcher_stylecss") .remove();
	
				$("<style type='text/css' id='color_switcher_stylecss'>"+cf+"{color:"+a+" !important}"+bc+"{background-color:"+a+" !important}"+boc+"{border-color:"+a+" !important}"+boc2+"{border-color:transparent "+a+" !important}</style>").insertAfter("#wrappermain-cs");
	
				} 
	
			}); 
	
		});
		
		
	
		function reset_color(){
	
			jQuery("#reset_color_txt").attr('value',"1")
	
			jQuery("#bgcolor").attr('value',"<?php echo $px_theme_option['custom_color_scheme'];?>")
	
			jQuery("#color_switcher").submit();
	
		}
	
			</script>
	
			<div id="sidebarmain">
	
				<span id="togglebutton">&nbsp;</span>
	
				<div id="sidebar">
	
					<form method="post" id="color_switcher">
	
						<aside class="rowside">
	
							<header><h4>Layout options</h4></header>
							<div class="switcher-inn">
								<h5>Select Color Scheme</h5>
								<div id="colorpickerwrapp">
									<?php $px_color_array= array('#45b363','#339a74', '#1d7f5b', '#3fb0c3', '#2293a6', '#137d8f', '#9374ae', '#775b8f', '#dca13a', '#c46d32', '#c44732', '#c44d55', '#425660', '#292f32');
									foreach($px_color_array as $colors){
										$active = '';
										if($colors == $px_theme_option['custom_color_scheme']){$active = 'active';}
										echo '<span class="col-box '.$active.'" data-color="'.$colors.'" style="background: '.$colors.'"></span>';
									}
									?>
								</div>
								<input id="bgcolor" name="style_sheet" type="hidden" class="bg_color" value="<?php echo $_SESSION['mnsess_style_sheet'];?>" />
								<ul class="layoutoption selectradio">
                                    <li><label class="label_radio <?php if($_SESSION['mnsess_layout_option']=="wrapper_boxed")echo "active";?> ">
                                    <span>Boxed</span>
                                    <i class="fa fa-columns"></i><input type="radio" name="layout_option" value="wrapper_boxed" ></label></li>
                                    
                                    <li><label class="full-view <?php if($_SESSION['mnsess_layout_option']=="wrapper")echo "active";?> ">
                                    <span>Full</span>
                                    <i class="fa fa-arrows-h"></i><input type="radio" name="layout_option" value="wrapper" ></label></li>
                                </ul>
								
							</div>
						</aside>
	
						<div class="accordion-sidepanel">
	
						<aside class="rowside">
	
						  <header>  <h4>Pattren Styles</h4></header>
	
						  <div class="innertext">
	
						  
	
							<div id="pattstyles" class="itemstyles selectradio">
								<span>Patterns are available in boxed mode</span>
								<ul>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="1")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern1.jpg" alt=""><input type="radio" name="custome_pattern" value="1"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="2")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern2.jpg" alt=""><input type="radio" name="custome_pattern" value="2"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="3")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern3.jpg" alt=""><input type="radio" name="custome_pattern" value="3"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="4")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern4.jpg" alt=""><input type="radio" name="custome_pattern" value="4"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="5")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern5.jpg" alt=""><input type="radio" name="custome_pattern" value="5"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="6")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern6.jpg" alt=""><input type="radio" name="custome_pattern" value="6"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="7")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern7.jpg" alt=""><input type="radio" name="custome_pattern" value="7"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="8")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern8.jpg" alt=""><input type="radio" name="custome_pattern" value="8"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="9")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern9.jpg" alt=""><input type="radio" name="custome_pattern" value="9"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_custome_pattern']=="10")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern10.jpg" alt=""><input type="radio" name="custome_pattern" value="10"></label></li>
									 <li><label <?php if($_SESSION['mnsess_custome_pattern']=="11")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern11.jpg" alt=""><input type="radio" name="custome_pattern" value="11"></label></li>
									  <li><label <?php if($_SESSION['mnsess_custome_pattern']=="12")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern12.jpg" alt=""><input type="radio" name="custome_pattern" value="12"></label></li>
										<li><label <?php if($_SESSION['mnsess_custome_pattern']=="13")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern13.jpg" alt=""><input type="radio" name="custome_pattern" value="13"></label></li>
										  <li><label <?php if($_SESSION['mnsess_custome_pattern']=="14")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern14.jpg" alt=""><input type="radio" name="custome_pattern" value="14"></label></li>
											<li><label <?php if($_SESSION['mnsess_custome_pattern']=="15")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/pattern/pattern15.jpg" alt=""><input type="radio" name="custome_pattern" value="15"></label></li>
	
								   
	
								</ul>
	
							</div>
	
							</div>
	
						</aside>
	
						<aside class="rowside">
	
							<header><h4>Background Images</h4></header>
	
							<div class="innertext">
	
						  
	
							<div id="backgroundimages" class="selectradio">
	
								<ul>
	
									<li><label <?php if($_SESSION['mnsess_bg_img']=="1")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/background/bg1.png" alt=""><input type="radio" name="bg_img" value="1"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_bg_img']=="2")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/background/bg2.png" alt=""><input type="radio" name="bg_img" value="2"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_bg_img']=="3")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/background/bg3.png" alt=""><input type="radio" name="bg_img" value="3"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_bg_img']=="4")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/background/bg4.png" alt=""><input type="radio" name="bg_img" value="4"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_bg_img']=="5")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/background/bg5.png" alt=""><input type="radio" name="bg_img" value="5"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_bg_img']=="6")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/background/bg6.png" alt=""><input type="radio" name="bg_img" value="6"></label></li>
	
									<li><label <?php if($_SESSION['mnsess_bg_img']=="7")echo "class='active'";?> ><img src="<?php echo $theme_path?>/images/background/bg7.png" alt=""><input type="radio" name="bg_img" value="7"></label></li>
	
	
								</ul>
	
							</div>
	
							</div>
	
						</aside>
	
						</div>
	
						<div class="buttonarea">
	
							<input type="submit" value="Apply" class="btn" />
	
							<input type="hidden" name="patter_or_bg" id="patter_or_bg" value="1" />
	
							<input type="hidden" name="reset_color_txt" id="reset_color_txt" value="" />
	
							<input type="reset" value="Reset" class="btn" onclick="javascript:reset_color()" />
	
						</div>
	
				</form>
	
				</div>
	
			</div>
	
	<?php
	
		}

	}
}



