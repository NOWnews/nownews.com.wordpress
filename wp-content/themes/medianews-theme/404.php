<?php
	get_header(); 
 	global  $px_theme_option; 
	
 ?>
<!-- Columns Start - fullwidth -->
    <!-- Page Contents Start -->
    <div class="col-md-12 pix-content-wrap">
        <div class="pagenone">
            <i class="fa fa-warning pix-colr"></i>
            <h1 class="colr"><?php _e('Page not found','Media News')?></h1>
            
            <h4><?php echo _e('It looks like nothing was found at this location. Maybe try a search?','Media News'); ?></h4>
            <!-- Password Protected Strat -->
            <div class="password_protected page-404">   
                <form id="searchform" method="get" action="<?php echo home_url()?>"  role="search">
                    <input name="s" id="searchinput" value="<?php _e('Search for:', 'Media News'); ?>"
                    onFocus="if(this.value=='<?php _e('Search for:', 'Media News'); ?>') {this.value='';}"
                    onblur="if(this.value=='') {this.value='<?php _e('Search for:', 'Media News'); ?>';}" type="text" />
                    <input type="submit" id="searchsubmit" class="backcolr" value="<?php _e('Search', 'Media News'); ?>" />
                </form>            
                
            </div>
            <!-- Password Protected End -->
        </div>
    </div>
    <!-- Page Contents End -->
<?php get_footer(); ?>