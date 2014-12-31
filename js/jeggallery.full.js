/** 
 * jeggallery.full.js
 *  
 * simple fragment of jeglio, uses only for load gallery 
 **/
(function($) {
	$.fn.jeggallery = function( options ) 
	{
		var settings = {};

		if (options) {
			var options = $.extend(settings, options);	
		} else {
			var options = $.extend(settings);					
		}
		
		/** public **/
		var touch					= false;
		if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
			touch = true;
		}
		
		var type_image = function(ele){
			/** add tooltips for tips **/
			if(!touch) {
				$('a.item-gallery-image', ele).jtooltip({});
			}
			
			/** photo swipe **/			
			(function(PhotoSwipe){
				photoswipe = $('a.item-gallery-image',ele).photoSwipe({
					backButtonHideEnabled 			: false,
					captionAndToolbarAutoHideDelay 	: 0,
					imageScaleMethod				: 'fitNoUpscale',
					allowUserZoom 					: true,
					getImageSource					: function(obj){ return $(obj).attr('data'); }
				});
				photoswipe.addEventHandler(PhotoSwipe.EventTypes.onHide, function(e){
					$container.isotope("reLayout");
				});
	        }(window.Code.PhotoSwipe));			
			
			$('a', ele).click(function(){
				return false;
			});
		};
		
		
		/** lazy load flex slider **/
		var loadotherimage = function(sel) {
			var datasrc = $('img',sel).attr('data-src');
			if(datasrc != undefined) {							
				var img = new Image();
				$(img).css("opacity" , 0);
				$('a', sel).html('').append(img);
				$(img).load(function(){
					$('img', sel).stop().animate({"opacity" : 1}, "fast");
				}).attr('src', datasrc);
			}
		};
		
		var loadnextprev = function(slider) {					
			// load next slide
			var next = $('.flex-active-slide', slider).next();
			loadotherimage(next);
			
			// load prev slide
			var prev = $('.flex-active-slide', slider).prev();
			loadotherimage(prev);
		};
		
		var lazyloadflex = function(slider) {					
			var datasrc = $('.flex-active-slide img', slider).attr('data-src');
			if(datasrc != undefined){
				var img = new Image();
				$(img).css("opacity" , 0);
				$('.flex-active-slide a', slider).html('').append(img);
				
				$(img).load(function(){
					$('.flex-active-slide img', slider).stop().animate({"opacity" : 1}, "fast");
					loadnextprev(slider);
				}).attr('src', datasrc);
			} else {
				if($('.flex-active-slide img', slider).css('opacity') == 0) {
					$('.flex-active-slide img', slider).animate({"opacity" : 1}, "fast");
				}
				loadnextprev(slider);
			}
		};
		/** lazy load flex slider **/
		
		var type_gallery = function(ele){
			
			/** add tooltips for tips **/
			type_image(ele);
			
			$(ele).flexslider({
				animation: "slide",              
				slideDirection: "horizontal",   
				slideshow: true,                
				slideshowSpeed: 7000,          
				animationDuration: 300,         
				directionNav: options.direction_nav,
				controlNav: options.control_nav,
				keyboardNav: true,              
				mousewheel: false,              
				prevText: "Previous",           
				nextText: "Next",               
				pausePlay: false,               
				pauseText: 'Pause',             
				playText: 'Play',               
				randomize: false,               
				slideToStart: 0,                
				animationLoop: true,            
				pauseOnAction: true,            
				pauseOnHover: false,            
				controlsContainer: "",          
				manualControls: "",             
				start: function(slider) {
					lazyloadflex(slider);
				},
				end: function(slider){},
				before: function(slider){},
				after: function(slider){
					lazyloadflex(slider);
				}		             
			});
			
		};
		
		var type_audio = function(ele){
			var audioresize = function () {
				var w = parseInt($(ele).css('width'),10);
				var h = 30;
				$('audio', ele).attr('width', '100%').attr('height', h);
			};			
			
			$(window).resize(function(){audioresize();});			
			$(window).resize();
			
			$('audio', ele).mediaelementplayer({
				pluginPath: template_css + "mediaelement/"
			});
		};
		
		var type_video = function(ele){
			/** set size of video & image **/
			$('video', ele).css({'width' : '100%','height': '100%'});
			$('img', ele).css({'width': '100%','height': '100%'});			
			$('video', ele).mediaelementplayer({});
		};
		
		var youtube_parser = function (url)
		{
		    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		    var match = url.match(regExp);
		    
		    if ( match && match[7].length == 11 ) {
		        return match[7];
		    } else {
		        alert("Url Incorrect");
		    }
		};
		
		var vimeo_parser = function (url) 
		{
			var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
			var match = url.match(regExp);

			if (match){
			    return match[2];
			}else{
			    alert("not a vimeo url");
			}

		};
		
		var type_video_youtube = function(ele){
			var youtube_id = youtube_parser($('.video-container', ele).attr('data-src'));
			var iframe = '<iframe width="700" height="500" src="http://www.youtube.com/embed/' + youtube_id +  '?showinfo=0&theme=light&autohide=1&rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
			$('.video-container', ele).append(iframe);
		};
		
		var type_video_vimeo = function(ele){
			var vimeo_id = vimeo_parser($('.video-container', ele).attr('data-src'));
			var iframe = '<iframe src="http://player.vimeo.com/video/' + vimeo_id + '?title=0&byline=0&portrait=0" width="700" height="500" frameborder="0"></iframe>';
			$('.video-container', ele).append(iframe);
		};
		
		var type_ba = function (ele) {
			$('.ba-gallery', ele).wpwBAgallery({
			    height	:	'auto',
			    width	:	'auto'
			});
		};
		
		$(this).each(function(){
			var type = $(this).attr('data-type');	
			switch(type) {
				case "gallery" :
					type_gallery(this);
					break;
				case "image" :
					type_image(this);
					break;
				case "video" : 
					type_video(this);
					break;
				case "youtube" :
					type_video_youtube(this);
					break;
				case "vimeo" :
					type_video_vimeo(this);
					break;	
				case "audio" : 
					type_audio(this);
					break;
				case "ba" : 
					type_ba(this);
					break;
				default : 
					break;
			};
		});
		
		$(window).bind("jmainremove", function(){			
		});
	};
})(jQuery);

function setupCarousel(itemTotal, navstyle, tourl){
	/** carousel **/
	var minItem;
	if(scw(iphonewidth)) {
		minItem = itemTotal;
	} else {
		minItem = 4;
	}
	
	jQuery('.carousel').elastislide({
		imageW 			: 180,
		minItems		: minItem,
		navigatorStyle 	: navstyle,
		onClick			: function(i){			
			if($('a', i).attr('data-tourl') == "false") {
				return false;
			} else {
				if(jcurtain == 1) {
					window.tourl($('a',i).attr('href'));
					return false;
				} else {
					window.location = $('a',i).attr('href');
					return true;
				}
			}
		}
	});
}

(function($) {
	$.fn.jegfolio = function( options ) 
	{
		var settings = {
			minItem			: 6
		};

		if (options) {
			var options = $.extend(settings, options);	
		} else {
			var options = $.extend(settings);					
		}
		
		
		/** public **/
		var touch					= false;
		if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
			touch = true;
		}
		
		
		/** carousel **/
		setupCarousel(options.minItem, 1, true);
		
		/** jeg gallery **/
		$(".gallery-main").jeggallery({
			direction_nav	:  options.direction_nav,
			control_nav		:  options.control_nav			
		});
		
		
		/** portfolio gallery animation **/
		$(".portfolio-gallery li").hover(function(){
			
			$(this).find('.shadow').stop().animate({
				'height' 	: '100%'
			},'fast');

			var h = ( ($(this).height() - $(this).find('.desc-holder').height()) / 2 ) - 5;
			
			$(this).find('.desc-holder').stop().animate({
				'bottom'	: h
			},'fast');
			
		}, function(){
			
			$(this).find('.shadow').stop().animate({
				'height' 	: '0'
			},'fast');
			
			$(this).find('.desc-holder').stop().animate({
				'bottom'	: '-100'
			},10);	
		});
		
		var attach_social = function () 
		{					
			var $this 		= $('.single-portfolio-like');
			var shareurl 	= $('.single-portfolio-like').attr('data-url'); 
			var imageurl 	= $('.single-portfolio-like').attr('data-cover');
			
			/** facebook like **/
			var fbl = $(document.createElement("fb:like"))
				.attr("href", shareurl)
				.attr("send", "false")
				.attr("layout", "button_count")
				.attr("show_faces", "false");
			
			var fbl = $("<div class='fblio'></div>").append(fbl);						
	        $(".wrapper-social .facebook-sharer").empty().append(fbl);
	        FB.XFBML.parse($(".fblio", $this).get(0));	        
	        
	        /** pinterest button **/
	        var pinurl = "http://pinterest.com/pin/create/button/?url=" 
	        	+ encodeURIComponent(shareurl) + "&media=" + encodeURIComponent(imageurl);
	        
	        var pinvar = $(document.createElement("a"))
	        		.attr("href", pinurl)
	        		.attr("class", "pin-it-button")
	        		.attr("count-layout", "horizontal")
	        		.html('<img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" />');
	        
	        $(".wrapper-social .pinterest-sharer")
	        	.append(pinvar)
	        	.append('<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>');				        
	        
	        
	        /** google plus share **/
	        var gplusvar = $('<g:plusone size="medium" annotation="bubble" href="' 
	        		+ encodeURIComponent(shareurl) + '"></g:plusone>');
	        $(".wrapper-social .google-sharer").append(gplusvar);
	        gapi.plusone.go("google-sharer");
	        
	        /** twitter sharer **/
	        var twt = $(document.createElement("a"))
	        		.attr("class", "twitter-share-button")
	        		.attr("href", "http://twitter.com/share")
					.attr("data-url", document.URL)
					.html("Tweet");
	        
	        var twt = $("<div class='twtlio'></div>").append(twt);
	        $(".wrapper-social .twitter-sharer").append(twt);
	        twttr.widgets.load();
	        
		};
		
		
		attach_social();
		
	};
})(jQuery);


(function($) {
	$.fn.jegblog = function( options ) 
	{		
		var settings = {
			minItem			: 4
		};

		if (options) {
			var options = $.extend(settings, options);	
		} else {
			var options = $.extend(settings);
		}
		
		
		/** public **/
		var touch					= false;
		if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
			touch = true;
		}
		
		var body = $(this);
		
		/** gallery **/
		$(".blog-gallery-type", body).jeggallery({
			direction_nav	:  options.direction_nav,
			control_nav		:  options.control_nav
		});
		
		
		/** attach photoswipe **/
		if($('.blog-gallery li a').length > 0 || $('.photoswipe').length > 0) {
			
			$('.blog-gallery li a').click(function() { return false; });
			$('.photoswipe').click(function() { return false; });
			
			if(!options.uselightbox) {
				(function(PhotoSwipe){
					$(".blog-gallery").each(function(){
						$(this).find('a').photoSwipe({
							backButtonHideEnabled 			: false,
							captionAndToolbarAutoHideDelay 	: 0,
							allowUserZoom 					: true,
							imageScaleMethod				: 'fitNoUpscale',
							getImageSource					: function(obj){ return $(obj).attr('href'); },
							getImageCaption					: function(obj){ return $(obj).attr('data-title'); }
						});
					});
					
					$(".photoswipe").each(function(){
						$(this).photoSwipe({
							backButtonHideEnabled 			: false,
							captionAndToolbarAutoHideDelay 	: 0,
							allowUserZoom 					: true,
							imageScaleMethod				: 'fitNoUpscale',
							getImageSource					: function(obj){ return $(obj).attr('href'); },
							getImageCaption					: function(obj){ return $(obj).attr('data-title'); }
						});
					});
					
			    }(window.Code.PhotoSwipe));
			} else {
				$(".blog-gallery").each(function(){
					$(this).find('a').lightbox();					
				}); 
				$(".photoswipe").each(function(){
					$(this).find('a').lightbox();
				});
			}
			
		}
		
		/** carousel **/
		setupCarousel(options.minItem, 2, false);			
		
		/** comment **/
		$(".replycomment").click(function(){
			var i = $(this).parents(".coment-box").parent();
			var f = $("#respond");
			var x = $("<div id='comment-box-reply'></div>");
			var t = $("<div id='temp-comment-holder' style='display:none;'></div>");
			var p = $("#comment_parent");			
			var c = "data-comment-id";
			
			$(".closecommentform").hide();
			$(".replycomment").show();
			$("#comment-box-reply").remove();
			
			if(!$("#temp-comment-holder").length) {
				t.insertBefore(f);
			}

			
			x.insertAfter($(i).find('.coment-box-inner')).append(f);
			p.val($(this).attr(c));
			
			$(this).hide();
			
			$(i).find(".closecommentform").show().click(function(){
				f.insertAfter($("#temp-comment-holder"));
				$("#temp-comment-holder").remove();
				$("#comment-box-reply").remove();
				$(this).hide();
				$(i).find('.replycomment').show();
				$("#comment_parent").val(0);
			});			
		});
		
	};
})(jQuery);