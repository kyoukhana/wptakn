<?php 
	global $jdata;	
	$i = 0;
	
	$jsContent = array();
		
	foreach($jdata->frontItem as $data) {	
		$slideType = j_get_meta('frontslider_media', '', $data->ID);
		switch($slideType) {
			case "image" : {
				$jsContent[] = array (
					'index'		=> $i,
					'type'		=> 'image',
					'nocrop'	=> j_get_meta('frontslider_nocrop', '', $data->ID),	
					'source'	=> j_get_meta('frontslider_image', '', $data->ID),
					'pos'		=> j_get_meta('frontslider_pos', 'center', $data->ID),
					'title'		=> $data->post_title,
					'link'		=> j_get_meta('frontslider_image_link', '', $data->ID),
					'desc'		=> apply_filters('the_content',$data->post_content)
				);
				break;
			}
			case "youtube" : {
				if(jeg_mobile_device()) {
					$jsContent[] = array (
						'index'		=> $i,
						'type'		=> 'image',
						'nocrop'	=> j_get_meta('frontslider_youtube_nocrop', '', $data->ID),	
						'source'	=> j_get_meta('frontslider_youtube_image', '', $data->ID),
						'pos'		=> j_get_meta('frontslider_youtube_pos', 'center', $data->ID),
						'title'		=> $data->post_title,
						'link'		=> j_get_meta('frontslider_youtube_url_link', '', $data->ID),
						'desc'		=> apply_filters('the_content',$data->post_content)
					);
				} else {
					$jsContent[] = array(
						'index'		=> $i,
						'type'		=> 'video',
						'source'		=> array(
							'videotype'	=> 'youtube',
							'src'		=> j_get_meta('frontslider_youtube_url', '', $data->ID)
						),
						'title'		=> $data->post_title,
						'link'		=> j_get_meta('frontslider_youtube_url_link', '', $data->ID),
						'desc'		=> apply_filters('the_content',$data->post_content)	
					);
				}		
				break;		
			}
			case "html-5-video" :  {
				if(jeg_mobile_device()) {
					$jsContent[] = array (
						'index'		=> $i,
						'type'		=> 'image',
						'nocrop'	=> j_get_meta('frontslider_html_nocrop', '', $data->ID),	
						'source'	=> j_get_meta('frontslider_html_image', '', $data->ID),
						'pos'		=> j_get_meta('frontslider_html_pos', 'center', $data->ID),
						'title'		=> $data->post_title,
						'link'		=> j_get_meta('frontslider_video_link', '', $data->ID),
						'desc'		=> apply_filters('the_content',$data->post_content)
					);
				} else {
					$video 	= array();			
					$mp4 	= j_get_meta('frontslider_video_mp4', '', $data->ID);
					$webm 	= j_get_meta('frontslider_video_webm', '', $data->ID);
					$ogg 	= j_get_meta('frontslider_video_ogg', '', $data->ID);
					
					if(!empty($mp4)) 
						$video[] = array(
							'videotype'		=> "mp4",
							'src'				=> $mp4
						);
					
					if(!empty($webm)) 
						$video[] = array(
							'videotype'		=> "webm",
							'src'			=> $webm
						);
					
					if(!empty($ogg)) 
						$video[] = array(
							'videotype'		=> "ogg",
							'src'			=> $ogg
						);
					
					$jsContent[] = array(
						'index'		=> $i,
						'type'		=> 'video',
						'source'	=> $video,
						'title'		=> $data->post_title,
						'link'		=> j_get_meta('frontslider_video_link', '', $data->ID),
						'desc'		=> apply_filters('the_content',$data->post_content)	
					);
				}
				break;
			}
		}
		$i += 1;
	}
	$jsContent = json_encode($jsContent);
?>
<div id="jegbgcontainer">
	<div class="mask"></div>
	<div class="navleft"><span>&nbsp;</span></div>
	<div class="navright"><span>&nbsp;</span></div>
	
	<div id="homepita" class="hptoogle">
		<div class="triangle-border"></div>
		<div class="triangle"></div>
		<div class="torapper">Loading . . .</div>
		<div class="homeinfo">
			<div class="homeflagwrapper">
				<div class="misc-info-about"></div>
			</div>
		</div>
	</div>
	
	<div class="homeblock">
		<div class="homeblockinside">
			<div class="closeme" style="display: block;">
				<div class="icon-remove"></div>
			</div>
			
			<div class="homelink">
				<a href="#"><?php j_e('more_detail'); ?></a>
			</div>
		</div>
	</div>
	
	 <div class="texthome">
	 	<div class="texthome-wrapper">
		 	<h2><?php echo $jdata->frontslidealt; ?></h2>
		 	<h1><?php echo $jdata->frontslidetitle; ?></h1>
	 	</div>
	 </div>
</div>

<script type="text/javascript" src="<?php echo JEG_JS_URL . 'jegbg.js';?>"></script>
<script type="text/javascript">
	
	(function($){
		$(document).ready(function(){
            function resize_window(selector)
            {
                $(window).resize(function(){
                    var wh = $(window).height();

                    //var hh = $("header").height();
                    var fh = $("footer").height();

                    var hh =0;

                    ch = wh - hh - fh + 7; /* 3 itu margin top nya yang diatas */

                    if(!scw(iphonewidth)) {
                        ch = 275;
                    } else if(!scw(mediaquerywidth)) {
                        ch = 450;
                    }

                    $(selector).height(ch);
                });

                $(window).resize();
            }
			
			resize_window("#jegbgcontainer");		
	
			/** bind jeg default **/
			$(window).jegdefault({
				curtain : <?php echo j_get_option('curtain', 0);?>,
				rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
				clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>"
			});
	
			var content = <?php echo $jsContent; ?> ;
	
			var holddesc = undefined;
			
			var jegbg = $("#jegbgcontainer").jegbg({
				fade_speed					: 700,
				delay						: <?php echo j_get_meta('frontslider_delay', 10000) ?>,			
				content 					: content,
				autostart					: true,
				partial_load				: true
			},  function(ele, media){
				<?php if(!j_get_meta('front_slider_info_hide', false)) : ?>
				$('#homepita').fadeIn(1000);				
				$('#homepita .torapper').html(ele.title);		
				$(".homelink a").attr("href" , ele.link);
				holddesc = ele.desc;
	
				if(!$(".homeinfo").is(":visible")) {
					pitaSlideUp();
				}
				<?php endif; ?>
			});
	
			/* binding touchwipe, disable this feature if using iphone */
			if(scw(iphonewidth)) {
				$(".texthome").touchwipe({
					wipeLeft: function(e) {					
						jegbg.next();
		    			return false;
					},
					wipeRight: function() {					
						jegbg.prev();
		    			return false;
					},
					min_move_x: 20,
					min_move_y: 20,
					preventDefaultEvents: true
				});	
			}
	
			var pitaSlideUp = function(){
				jegbg.restart();
				$(".homeblock").slideUp("fast", function(){
					$("#homepita").animate({
						"right" : -288
					}, function(){
						$(".homeinfo").fadeIn("fast", function(){
							$(this).attr("style","").addClass("displayblock");
						});
						$(".homeblock").removeClass("homedesc");
						$(".homedescdetail").remove();
					});
				});
			};
	
			$(window).resize(function(){pitaSlideUp();});
			
			var pitaSlideDown = function() {
				jegbg.pause();
				$("#homepita").addClass("hptoogle");
				$(".homeblockinside").prepend("<div class='homedescdetail'>" + holddesc + "</div>");
				$(".homeblock").slideDown("fast", function(){
					$(this).addClass("homedesc");
					$(".homedescdetail").css({
						height 	: $('.homeblockinside').height() - 30,
	    				width 	: $('.homeblockinside').width() - 12
					});
					jpanel = $(".homedescdetail").jScrollPane().data().jsp;				
				});
			};
			
			$(".homeinfo").click(function(){
				$(this).fadeOut("fast");
				$("#homepita").animate({
					"right" : -5
				}, function(){
					pitaSlideDown();
				});
			});
			
			$(".homeblock .closeme, .torapper").click(function(){
				pitaSlideUp();
			});
		});
	})(jQuery);
	
</script>