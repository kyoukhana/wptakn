/**
 * jeggal.full.js
 */

jQuery(document).ready(function($) {
	$.Isotope.prototype._getCenteredMasonryColumns = function() {
		this.width = this.element.width();
	    
		var parentWidth = this.element.parent().width();
	    
	                  // i.e. options.masonry && options.masonry.columnWidth
		var colW = this.options.masonry && this.options.masonry.columnWidth ||
	                  // or use the size of the first item
	                  this.$filteredAtoms.outerWidth(true) ||
	                  // if there's no items, use size of container
	                  parentWidth;
	    
		var cols = Math.floor( parentWidth / colW );
		cols = Math.max( cols, 1 );
	
	    // i.e. this.masonry.cols = ....
		this.masonry.cols = cols;
	    // i.e. this.masonry.columnWidth = ...
		this.masonry.columnWidth = colW;
	};
	  
	$.Isotope.prototype._masonryReset = function() {
	    // layout-specific props
		this.masonry = {};
	    // FIXME shouldn't have to call this again
	    this._getCenteredMasonryColumns();
	    var i = this.masonry.cols;
	    this.masonry.colYs = [];
	    while (i--) {
	    	this.masonry.colYs.push( 0 );
	    }
	};
	
	$.Isotope.prototype._masonryResizeChanged = function() {
		var prevColCount = this.masonry.cols;
	    // get updated colCount
		this._getCenteredMasonryColumns();
		return ( this.masonry.cols !== prevColCount );
	};
	  
	$.Isotope.prototype._masonryGetContainerSize = function() {
		var unusedCols = 0,
			i = this.masonry.cols;
	    // count unused columns
		while ( --i ) {
			if ( this.masonry.colYs[i] !== 0 ) {
				break;
			}
			unusedCols++;
		}
	    
		return {
			height : Math.max.apply( Math, this.masonry.colYs ),
	          // fit container to columns that have been used;
			width : ((this.masonry.cols - unusedCols) * this.masonry.columnWidth) + 5
		};
	};
});

/** jeggal v1 **/

(function($) {
	$.fn.jeggal = function( options ) 
	{
		var settings = {
			zoomDelay			: 7000,
			use_pagging			: 0,
			pagging_count		: 10,
			loading_text		: "Loading . . . ",
			loadAnimation		: 'sequpfade'  // normal | fade | seqfade | upfade | sequpfade | randomfade | randomupfade
		};
		
		if (options) {
			var options = $.extend(settings, options);	
		} else {
			var options = $.extend(settings);					
		}
		
		var $container 				= $(this);		
		
		var contentloaded = function (loadAnimation)
		{
			$container.imagesLoaded( function($images, $proper, $broken) 
			{
				// close loader & show filter
				$('.lio-loader').fadeOut('fast');			
				
				// build isotope
				$container.isotope({
					animationEngine: "jquery",
		            itemSelector: ".imggal.animated",
		            masonry: {
						columnWidth: 1
					}
				});	
				
				animload(loadAnimation);
				
				(function(PhotoSwipe){
					photoswipe = $container.find('.imggal').photoSwipe({
						backButtonHideEnabled 			: false,
						captionAndToolbarAutoHideDelay 	: 0,
						slideshowDelay					: options.zoomDelay,
						slideSpeed						: 500,
						imageScaleMethod				: 'fitNoUpscale',
						allowUserZoom 					: false,
						getImageSource					: function(obj){ return $(obj).attr('data-img'); },
						getImageCaption					: function(obj){ return $(obj).attr('data-title'); }
					});
					photoswipe.addEventHandler(PhotoSwipe.EventTypes.onHide, function(e){
						$container.isotope("reLayout");
					});
		        }(window.Code.PhotoSwipe));
				
			});				
		};
		
		var setuptop = function () {
			// setup item
			$container.find('.imggal.animated').each(function(i){
				var $item 	= $(this),
				t		= parseInt($item.css('top'),10) + ( $item.height() / 2);
				$item.css({ top	: t + 'px', opacity : 0});
			});
		};
		
		var shuffleitem = function() {
			var shufflearray = new Array();
			$container.find('.imggal.animated').each(function(i){ shufflearray[i] = $(this); });
			shufflearray.sort(function(){return Math.round(Math.random());});
			return shufflearray;
		};
		
		// normal | fade | seqfade | upfade | sequpfade | randomfade | randomupfade
		var animload = function(animation){					
			if(animation 			== "normal") {
				$container.find('.imggal.animated').each(function(){
					$(this).css({"opacity": 1}).removeClass('animated');
				});
			} else if(animation 	== "fade"){
				$container.find('.imggal.animated').each(function(){
					$(this).stop().animate({
						"opacity" : 1
					}, "fast").removeClass('animated');
				});
			} else if(animation	 	== "seqfade"){
				$container.find('.imggal.animated').each(function(i){
					var element = $(this);
					setTimeout(function() {
						$(element).show().stop().animate({
							"opacity" : 1
						}, "fast").removeClass('animated');							
					}, 100 + i * 100);
				});
			} else if(animation	 	== "upfade"){
				// setup item
				setuptop();
				
				$container.find('.imggal.animated').each(function(i){
					var element = $(this);					
					$(element).stop().animate({
						top			: parseInt($(element).css('top'),10)- ( $(element).height() / 2),
						opacity		: 1
					}, 1000).removeClass('animated');
				});				
			} else if(animation	 	== "sequpfade"){
				// setup item
				setuptop();
				
				$container.find('.imggal.animated').each(function(i){
					var element = $(this); 					
					setTimeout(function() {
						$(element).stop().animate({
							top			: parseInt($(element).css('top'),10)- ( $(element).height() / 2),
							opacity		: 1
						}, 300).removeClass("animated");
					}, 100 + i * 100);
				});
				
			} else if(animation	 	== "randomfade"){
				var shufflearray = shuffleitem();
				
				for(var i = 0; i < shufflearray.length ; i++){					
					setTimeout(function() {
						var element = shufflearray.pop();						
						$(element).stop().animate({
							"opacity" : 1
						}, 200).removeClass('animated');	
					}, 75 + i * 75);
				}
			}else if(animation	 	== "randomupfade"){		
				var shufflearray = shuffleitem();
				setuptop();
				
				for(var i = 0; i < shufflearray.length ; i++){			
					setTimeout(function() {
						var element = shufflearray.pop();
						$(element).stop().animate({
							top			: parseInt($(element).css('top'),10)- ( $(element).height() / 2),
							opacity		: 1
						}, 300).removeClass('animated');
					}, 75 + i * 75);
				}				
			}
		};
		
		
		var request_data = {
			id			: options.postid,
			action		: 'get_gallery'
		};
		
		var showPasswordForm = function (status) {
			if(!$(".portopwd").length) {
				// create password form
				var pwdtxt = '<div class="portopwd">' +
							'<div class="portopwd-wrapper">' +
								'<h2>' + options.lang.portfoliotitle +  ' </h2> ' +
								'<div>' +
									'<input type="password" class="pwdtxt" placeholder="' + options.lang.passwordplaceholder +  '"/>' +
									'<button href="#" class="btn btn-inverse pwdbtn">' + options.lang.submit + '</button>' +
								'</div>' +
								'<div class="pwderr"></div>' +
								'<div alt="Close" class="pwdcls" style="display: block;">' +
									'<div class="icon-remove icon-white"></div>' +
								'</div>' +
							'</div>' +
						  '</div>';
				$('body').append(pwdtxt);
			}
			
			$(".pwdcls").click(function(){							
				$(".portopwd").remove();
			});
			
			var submitpwdform = function () {
				request_data.password = $(".pwdtxt").val();
				$(".portopwd").remove();
				loadData();
			};
			
			$(".pwdtxt").keypress(function(e){
				if(e.which == 13){
					submitpwdform();
				}
			});
			
			$(".pwdbtn").click(function(){
				submitpwdform(); 
			});
		};
		
		var partialpage = 1;
		var firstrun = 0;
		
		var partial_content_animation = function () {
			
			if(firstrun == 0) {
				firstrun++;
				
				$(".mpnotif").html(options.loading_text);
				$(".mpnotif").fadeIn();
				
				// close loader & show filter
				$('.lio-loader').fadeOut('fast');			
				
				// build isotope
				$container.isotope({
					animationEngine: "jquery",
					itemSelector: ".imggal.animated",
					masonry: {
						columnWidth: 1
					}
				});	
				
				animload(options.loadAnimation);
				
				(function(PhotoSwipe){
					photoswipe = $container.find('.imggal').photoSwipe({
						backButtonHideEnabled 			: false,
						captionAndToolbarAutoHideDelay 	: 0,
						slideshowDelay					: options.zoomDelay,
						slideSpeed						: 500,
						imageScaleMethod				: 'fitNoUpscale',
						allowUserZoom 					: false,
						getImageSource					: function(obj){ return $(obj).attr('data-img'); },
						getImageCaption					: function(obj){ return $(obj).attr('data-title'); }
					});
					photoswipe.addEventHandler(PhotoSwipe.EventTypes.onHide, function(e){
						setTimeout(function(){
							$container.isotope("reLayout");
						}, 1000);
					});
				}(window.Code.PhotoSwipe));
				
			} else {
				$container.isotope( 'appended', $container.find('.imggal.animated'), function(){
					animload('seqfade');
				});
			}
		};
		
		var partial_load = function (){
			var notloaded = $container.find('.imggal.notloaded');			
			
			if(notloaded.length > 0) {
				var elearray = new Array();
				for($i = 0; $i < options.pagging_count; $i++) {
					elearray[$i] = notloaded[$i];
				}
				load_image(elearray);								
			} else {
				$(".mpnotif").fadeOut();
				setTimeout(function(){
					$container.isotope( 'reLayout' );
				}, 2000);
				
			}
		};
		
		var load_image = function(elearray){
			// cache element
			var element = elearray[0];
			
			if(element) {
				// remove array from first element
				elearray.shift();
				
				// proceed with loading iamge
				var imgsrc = $(element).find("img").attr("data-src");
				
				var img = new Image();
				$(img).load(function(){
					$(element)
						.removeClass("notloaded")
						.addClass("animated")
						.find("figure")
						.html("")
						.append(img);
					load_image(elearray);
				}).attr('src', imgsrc);
			} else {
				setTimeout(function(){					
					partial_content_animation();
					setTimeout(function(){
						partial_load();
					},1000);
				}, 1000);
			}
		};
		
		var loadData = function () {			
			$.ajax({
				url: admin_url,
				type : "post",
				dataType : "json", 
				data : request_data,
				success: function(data) {
					if(data.status == 1) {
						$container.html(data.content);
						if(options.use_pagging == 0) {
							contentloaded(options.loadAnimation);
						} else {
							partial_load();
						}
					}  else  if (data.status == 2) {
						// need password
						showPasswordForm(0);
					} else if (data.status == 3) {
						// invalid password
						showPasswordForm(1);
					} else if (data.status == 4) {									
						// wrong post format
					}
				}
			});
		};
		
		/** request ajax dulu nih **/
		loadData();
	};
})(jQuery);