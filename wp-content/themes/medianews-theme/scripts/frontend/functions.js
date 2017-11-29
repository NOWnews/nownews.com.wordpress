 jQuery(document).ready(function() {
   jQuery("body").addClass('laodingpage');
  });
  jQuery(window).load(function() {
   // Animate loader off screen
   jQuery("body").removeClass("laodingpage");
  });
//Normal Call Back Functions
jQuery(document).ready(function($) {
	jQuery('audio,video').mediaelementplayer();

jQuery('.tabs ul li').click(function(){
        jQuery('.bmark_active').addClass('bmark');
        jQuery('.bmark_active').removeClass('bmark_active');
        jQuery(this).addClass('bmark_active');
        jQuery(this).removeClass('bmark');
    });

jQuery(".sub-menu").parent("li").addClass("parentIcon");

// Foucs Blur function for input field 
  jQuery(' #respond textarea, #respond input[type="text"], #respond input[type="password"], #respond input[type="datetime"], #respond input[type="datetime-local"], #respond input[type="date"], #respond input[type="month"], #respond input[type="time"], #respond input[type="week"], #respond input[type="number"], #respond input[type="email"], #respond input[type="url"], #respond input[type="search"], #respond input[type="tel"], #respond input[type="color"], .searchform input[type="text"], .widget_newsletter input[type="text"]').focus(function() {
    if (!$(this).data("DefaultText")) $(this).data("DefaultText", $(this).val());
    if ($(this).val() != "" && $(this).val() == $(this).data("DefaultText")) $(this).val("");
  }).blur(function() {
    if ($(this).val() == "") $(this).val($(this).data("DefaultText"));
  });
  jQuery('a.btngotop').click(function(event) {
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, 1000);
    return false;
})
	jQuery("a.btnsearch") .click(function(){
		jQuery("#searcharea").slideToggle(200);
		return false;
	})

// JavaScript Toggle function everywhere click close

 jQuery('html').click(function() {
 jQuery("#searcharea").slideUp();
 });
 jQuery(".close-form").click(function(event) {
  jQuery("#searcharea").slideUp();
  return false;
 });
jQuery('a.btnsearch,#searcharea').click(function(event){
     event.stopPropagation();
 });
// JavaScript Toggle function everywhere click close

  jQuery('[data-toggle="tooltip"]').tooltip()

    
    
});

function px_flexsliderBannerGallery() {
	jQuery(".flexslider").flexslider({
		animation: "fade",
		prevText: " <i class='fa fa-angle-left'></i>",
		nextText: " <i class='fa fa-angle-right'></i>"
	});

}

function px_flexsliderGallery() {
	jQuery(".flexslider").flexslider({
		animation: "fade",
		prevText: " <i class='fa fa-arrow-left'></i>",
		nextText: " <i class='fa fa-arrow-right'></i>"
	});
	
}

function BannerGallery() {
	jQuery("#banner .flexslider").flexslider({
		animation: "fade",
		prevText: " <i class='fa fa-arrow-left'></i>",
		nextText: " <i class='fa fa-arrow-right'></i>"
	});
	
	
}


// Mailchimp widget 
function px_mailchimp_add_scripts () {
	'use strict';
	(function (a) {
	    a.fn.ns_mc_widget = function (b) {
	        var e, c, d;
	        e = {
	            url: "/",
	            cookie_id: false,
	            cookie_value: ""
	        };
	        d = jQuery.extend(e, b);
	        c = a(this);
	        c.submit(function () {
				var mailchimp_submitvalue = jQuery('.widget_newsletter form input[type="submit"]').val();

				var mailchimp_key_validation = jQuery('#mailchimp_key_validation').val();
				
				if( mailchimp_key_validation  != ""){
					//api_key_error = jQuery("<p class='bad_authentication'>" + mailchimp_key_validation + "</p>");
					//c.prepend(api_key);
					alert(mailchimp_key_validation);
					return false;
				} else {
				
	            var f;
	            f = jQuery("<div class='loader_img'><i class='fa fa-spinner fa-spin fa-1x'></i></div>");
	            f.css({
	                "background-position": "center center",
	                "background-repeat": "no-repeat",
	                height: "25px",
	                right: "20px",
					color: "#000",
	                position: "absolute",
	                top: "109px",
	                width: "100px",
	                "z-index": "100"
	            });
	            c.css({
	                height: "100%",
	                position: "relative",
	                width: "100%"
	            });
				//if(jQuery('.widget_newsletter').hasClass('bad_authentication')){
					jQuery('.bad_authentication').remove();
					//i.remove();
				//}
				
					jQuery('.error').remove();
				
	          //  c.children().hide();
	            c.prepend(f);
	            a.getJSON(d.url, c.serialize(), function (h, k) {
					//alert(h+'======'.k);
	                var j, g, i;
	                if ("success" === k) {
	                    if (true === h.success) {
							if(jQuery('.widget_newsletter span').hasClass('bad_authentication')){
								i.remove();
							}
							
	                        i = jQuery("<p class='bad_authentication'>" + h.success_message + "</p>");
	                        i.hide();
							f.remove();
							
							
	                        c.fadeTo(400, 0, function () {
	                            c.prepend(i);
	                            i.show();
	                            c.fadeTo(400, 1)
	                        });
	                        if (false !== d.cookie_id) {
	                            j = new Date();
	                            j.setTime(j.getTime() + "3153600000");
	                            document.cookie = d.cookie_id + "=" + d.cookie_value + "; expires=" + j.toGMTString() + ";"
	                        }
							jQuery('.loader_img').remove();
	                    } else {
							jQuery('.loader_img').remove();
	                        g = jQuery(".error", c);
	                        if (0 === g.length) {
	                            f.remove();
	                            c.children().show();
	                            g = jQuery('<div class="error"></div>');
	                            g.prependTo(c)
	                        } else {
	                            f.remove();
	                            c.children().show()
	                        }
	                        g.html(h.error)
	                    }
	                }
					jQuery('.widget_newsletter input[type="submit"]').val(mailchimp_submitvalue);
	                return false
	            });
				}
	            return false
	        })
	    }
	}(jQuery));
	
	
	

}


jQuery(document).ready(function($) {
 'use strict';
  MenuToggle();
  jQuery(window) .resize(function(event) {
    /* Act on the event */
    MenuToggle()
  });
     jQuery("#menus  li.sub-icon > a") .bind("click",function(){
      jQuery(this) .next() .slideToggle(200);
      return false;
     });
       jQuery( ".cs-click-menu" ).click(function() {
        jQuery(this) .next() .slideToggle(200)
      });
});


function MenuToggle() {
   var a = jQuery(window).width();
 var b = 1000
 if (a <= b) {
 jQuery("#menus ul") .parent('li') .addClass('sub-icon');
  jQuery("#menus ul") .hide();
    } else {
        jQuery("#menus ul,#menus") .show();
    }
}

// News ticker
function px_jsnewsticker(cls,startDelay,tickerRate){
	'use strict';
	var options = {
		newsList: "."+cls,
		startDelay: startDelay,
		tickerRate: tickerRate,
		controls: false,
		ownControls: false,
		stopOnHover: false,
		resumeOffHover: true
	}
	jQuery().newsTicker(options);
}

jQuery(document).ready(function($) {
	jQuery('.back-to-top').click(function(event) {
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, 1000);
    return false;
})
  jQuery('.cs-post-top-section a').click(function(event) {
    event.preventDefault();
    var a = jQuery(this).attr('href')
    jQuery('html, body').animate({scrollTop: (jQuery(a).offset().top)-60}, 1000);
    return false;
})
});

function skill_shortcode(user_rating,post_id,user_rating_percentage, color, radius){
	
		  var n, id, progress;
		  progress = new CircularProgress({
			radius: radius,
			lineWidth: 5.4,
			strokeStyle: color,
			text: {
				font: "normal 14px  Open Sans,sans-serif",
				fillStyle: "#999999",
				shadowBlur: 0,
				value: user_rating
				
			},
			initial: {
			  lineWidth: 6,
			  strokeStyle: "#000"
			}
		  });
	
		  var a = document.getElementById("cirlce"+post_id)
			a.appendChild(progress.el);
	
		  n = 0;
		  id = setInterval(function () {
			  
			if (n == user_rating_percentage) clearInterval(id);
			progress.update(n++);
		  }, 50);
						
	
}

function px_skills_shortcode_script(){
	'use strict';
	jQuery("[data-loadbar]").each(function(index){
		var d =jQuery(this) .attr('data-loadbar');
		var e =jQuery(this) .attr('data-loadbar-text');
		var ani = jQuery(this).find('div');
		jQuery(ani).animate({width:d+"%"},2000).next().html(e);
	}); 

}
// Counter Integers
 function count(options) {
	var $this = jQuery(this);
	options = jQuery.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
function px_counter_view(){
	 'use strict';
	jQuery(".px-time-counter") .each(function(index, el) {
			jQuery(this).one('inview', function(event, isInView, visiblePartX, visiblePartY) {
			  if (isInView) {
				jQuery(this).data('countToOptions', {
					formatter: function (value, options) {
					  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
					}
				  });
				 jQuery(this).each(count);
			
			  } 
		});
	});	
}

function px_iframe_videos(){
	jQuery(document).ready(function($) {
	// Find all YouTube videos
	var $allVideos = $("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com']"),
	
		// The element that is fluid width
		$fluidEl = $("body");
	
	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {
	
	  $(this)
		.data('aspectRatio', this.height / this.width)
	
		// and remove the hard coded width/height
		.removeAttr('height')
		.removeAttr('width');
	
	});
	
	// When the window is resized
	$(window).resize(function() {
	
	  var newWidth = $fluidEl.width();
	
	  // Resize all videos according to their own aspect ratio
	  $allVideos.each(function() {
	
		var $el = $(this);
		$el
		  .width(newWidth)
		  .height(newWidth * $el.data('aspectRatio'));
	
	  });
	
	// Kick off one resize to fix all videos on page load
	}).resize();
	
});
}


