<div class="container containerborder">
	<div class="inner-container">
		<h1 class="page-title"><?php the_title(); ?></h1>				
		<div class="portolio-content row">
			<div class="portfolio-meta">
				<ul>			
					<li>
						<i class="icon-user"></i>
						<?php the_author_posts_link(); ?>
					</li>
					<li>
						<i class="icon-time"></i>
						<?php echo get_the_date(); ?>
					</li>
					<?php 
						/** category **/
						$catlist = array();	
						if(isset($_REQUEST['id'])) {
							$term = get_the_terms($_REQUEST['id'], JEG_PORTFOLIO_CATEGORY);
							if(!empty($term)) {
								echo '<li class="meta-last-child"><i class="icon-tags"></i>';
								
								foreach(get_the_terms($_REQUEST['id'], JEG_PORTFOLIO_CATEGORY) as $category) {
									$catlist[] = $category->name;
								}
								
								echo implode(', ', $catlist);
								
								echo '</li>';
							}
						}
					?>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="portfolio-sidebar span3">
				<?php 
					if(j_get_option('social_sharer')) {
				?>
				<div class="single-portfolio-like" data-url="<?php echo get_permalink(get_the_ID()); ?>" data-cover="<?php echo j_get_meta('porto_gallery_cover', '', get_the_ID()); ?>">
					<div class="wrapper-social">
						<div class="facebook-sharer"></div>
						<div class="twitter-sharer"></div>
						<div class="clearboth"></div>
						<div class="pinterest-sharer"></div>
						<div class="google-sharer" id="google-sharer"></div>
					</div>
				</div>
				<?php 
					}
				?>
				<div class="portfolio-article">
					<?php the_content(); ?>
				</div>				
			</div>
			<?php
			
			if(!post_password_required($post)) :
					
				  $mediatype = j_get_meta('portfolio_media', get_the_ID());
				  $width = 835;
				  $height = 600;
				  
				  
				  /** media type GALLERY **/
				  if($mediatype == "gallery") {
				  	
				  	$galleryMedia = array();
				  	
				  	$imglist = get_post_meta(get_the_ID(), j_name('porto_image_gallery'), true);
				  	$galleries = json_decode($imglist, true);
				  	
				  	if(!empty($galleries)) {
				  		// pake builder image list								
						foreach ($galleries as $gallery) {
							$image = wp_get_attachment_image_src($gallery['id'], 'full');
							
							$galleryMedia[] = array(
								'file' 		=> $image[0], 
								'desc'		=> $gallery['desc'],
								'title'		=> $gallery['title']
							);
						}
				  	} else {
					  	$galleries = get_children(
							array(	'order'				=> 'ASC', 
									'orderby'			=>'menu_order', 
									'post_parent' 		=> get_the_ID(), 
									'post_type' 		=> 'attachment', 
									'post_mime_type' 	=>'image'
							)
                        );
						foreach ($galleries as $gallery) {
							$galleryMedia[] = array('file' => $gallery->guid, 'desc'=> get_post_meta($gallery->ID, '_wp_attachment_image_alt', true));
                        }
                    }
			?>

                <?php if(j_get_option('portfolio_expand_script', 1) == 0) { ?>

                    <div class="item-gallery gallery-main span9 flexslider newfotorama" data-type="gallery">
                        <?php foreach ($galleryMedia as $img) : ?>
                        <img src="<?php echo $img['file']; ?>" />
                        <?php endforeach; ?>
                    </div>

                <?php } else { ?>

                    <div class="gallery-main span9 flexslider newflexslider" data-type="gallery">
                        <ul class="slides">
                            <?php foreach ($galleryMedia as $img) : ?>
                                <li>
                                    <a data-alt="<?php j_e('click_to_zoom_lang'); ?>" class="item-gallery-image" href="#" data-title="<?php echo $img['title'] ?>" data="<?php echo $img['file'] ?>" data-tourl="false">
                                        <img title="<?php echo $img['title']; ?>" alt="<?php echo $img['title']; ?>" src="<?php echo jeg_get_image($img['file'], '', $width, $height); ?>" />
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                <?php } ?>

			<?php } else if($mediatype == "youtube") { 
				$youtube	= j_get_meta('porto_youtube_url', '', get_the_ID()); 
			?>
			<div class="gallery-main span9" data-type="youtube">	
				<div class="video-container" data-src="<?php echo $youtube; ?>"></div>
			</div>	
			<?php } else if($mediatype == "vimeo") {
				$vimeo	= j_get_meta('porto_vimeo_url', '', get_the_ID()); 
			?>
			<div class="gallery-main span9" data-type="vimeo">
				 <div class="video-container" data-src="<?php echo $vimeo; ?>"></div>
			</div>
			<?php } else if($mediatype == "html-5-video") {
				$mp4	= j_get_meta('porto_video_mp4', '', get_the_ID());
				$ogg	= j_get_meta('porto_video_ogg', '', get_the_ID());
				$webm	= j_get_meta('porto_video_webm', '', get_the_ID());
				$cover	= j_get_meta('porto_video_cover', '', get_the_ID()); 
			?>
			<div class="gallery-main span9" data-type="video">
				<video id="player" poster="<?php echo jeg_get_image($cover, '', $width, $height); ?>" controls="controls" preload="none">
					<?php if(!empty($mp4)) : ?>			
					<source type="video/mp4" src="<?php echo $mp4; ?>" />
					<?php endif; ?>
					
					<?php if(!empty($webm)) : ?>
					<source type="video/webm" src="<?php echo $webm; ?>" />
					<?php endif; ?>
					
					<?php if(!empty($ogg)) : ?>
					<source type="video/ogg" src="<?php echo $ogg; ?>" />
					<?php endif; ?>
					
					<!-- Fallback flash player for no-HTML5 browsers with JavaScript turned off -->
					<object width="<?php echo $width ?>" height="<?php echo $height; ?>" type="application/x-shockwave-flash" data="<?php echo JEG_CSS_URL . 'mediaelement/flashmediaelement.swf'; ?>"> 		
						<param name="movie" value="<?php echo JEG_CSS_URL . 'mediaelement/flashmediaelement.swf'; ?>" /> 
						<param name="flashvars" value="controls=true&file=<?php echo $mp4; ?>" /> 		
						<!-- Image fall back for non-HTML5 browser with JavaScript turned off and no Flash player installed -->
						<img src="<?php echo jeg_get_image($cover, '', $width, $height); ?>" title="<?php j_e('no_playback_lang')?>" />
					</object>
				</video>
			</div>
			<?php } else if($mediatype == "music") {
				$audio	= j_get_meta('porto_music_mp3', '', get_the_ID());
				$cover	= j_get_meta('porto_music_cover', '', get_the_ID());  
			?>
			<div class="gallery-main span9" data-type="audio">
				<audio id="audioplayer" src="<?php echo $audio; ?>" type="audio/mp3" controls="controls">
					<object width="<?php echo $width ?>" height="<?php echo $height; ?>" type="application/x-shockwave-flash" data="<?php echo JEG_CSS_URL . 'mediaelement/flashmediaelement.swf'; ?>"> 		
						<param name="movie" value="<?php echo JEG_CSS_URL . 'mediaelement/flashmediaelement.swf'; ?>" /> 
						<param name="flashvars" value="controls=true&file=<?php echo $audio; ?>" /> 		
						<!-- Image fall back for non-HTML5 browser with JavaScript turned off and no Flash player installed -->
						<img src="<?php echo jeg_get_image($cover, '', $width, $height); ?>" title="<?php j_e('no_playback_lang')?>" />
					</object>
				</audio>
				<img src="<?php echo jeg_get_image($cover, '', $width, $height); ?>" />
			</div>
			<?php } else if($mediatype == "before-after") {
						$bi				= jeg_get_image_gallery(get_the_ID(), 'porto_before_gallery');
						$ai				= jeg_get_image_gallery(get_the_ID(), 'porto_after_gallery');
			?>
			<div class="gallery-main span9" data-type="ba">
				<div class="ba-gallery">
					<?php if(!empty($bi)) : 
							for($i = 0; $i < sizeof($bi) ; $i++) : ?>
						<img src="<?php echo jeg_get_image($bi[$i]['file'], '', $width, $height); ?>" alt='<?php echo jeg_get_image($ai[$i]['file'], '', $width, $height); ?>' title="<?php echo $bi[$i]['title'] ?>">
					<?php 	endfor; 
						endif; ?>
				</div>
			</div>
			<?php 
					} 
				endif;
			?>			
		</div>
		
		<h2 class="project-title"><?php j_e("more_in_portfolio_lang"); ?></h2>	
			<div class="btn-group gallery-navigator">
	          <button class="btn btn-prev"><i class="icon-chevron-left"></i> <?php j_e("previous_lang"); ?> </button>
	          <button class="btn btn-next"> <?php j_e("next_lang"); ?> <i class="icon-chevron-right"></i></button>
		    </div>
		<div class="es-carousel-wrapper portfolio-gallery carousel ">
			<div class="es-carousel">
				<ul>
					<?php 
						$portfolioItem = query_posts(array(
							'post_type'				=> JEG_PORTFOLIO_POST_TYPE , 
							'nopaging'				=> true
						));
						if(have_posts()) {
							while(have_posts()) {						
								the_post();
								$height = 180; 
								$width 	= 180;
								
								$mediatype = j_get_meta('portfolio_media', get_the_ID()); 
								$icontype = "" ; $covername = "" ; $imageCover = "";
								
								switch($mediatype) {
									case 'gallery'	:
										$covername = "porto_gallery_cover";
										$imageCover = JEG_CSS_URL . 'img/cover/gallery.jpg';
										$icontype = " icon-picture "; 
										break;
									case 'youtube' 	:
										$covername = "porto_youtube_cover";
										$imageCover = JEG_CSS_URL . 'img/cover/youtube.jpg';
										$icontype = " icon-film "; 
										break;
									case 'vimeo' 	:
										$covername = "porto_vimeo_cover";
										$imageCover = JEG_CSS_URL . 'img/cover/vimeo.jpg';
										$icontype = " icon-film ";
										break;
									case 'html-5-video' :
										$covername = "porto_video_cover";
										$imageCover = JEG_CSS_URL . 'img/cover/video.jpg';
										$icontype = " icon-film ";
										break;
									case 'music' 	:
										$covername = "porto_music_cover";
										$imageCover = JEG_CSS_URL . 'img/cover/music.jpg';
										$icontype = " icon-headphones ";
										break;									
								}
								
							/** get category list **/
							$catlist = array();	
							$termlist = get_the_terms(get_the_ID(), JEG_PORTFOLIO_CATEGORY);
							
							if(!empty($termlist)) {
								foreach($termlist as $category) {
									$catlist[] = $category->name;
								}
							}
								
							$imageCover = j_get_meta($covername, $imageCover);
					?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<div class="shadow"></div>
								<img src="<?php echo jeg_get_image($imageCover, '', $width, $height)?>"></img>
								<div class="desc-holder">						
									<h3><?php the_title(); ?></h3>
									<h4><?php echo implode(', ' , array_map("ucfirst" , $catlist)); ?></h4>
									<i class="<?php echo $icontype; ?>"></i>
								</div>
							</a>
						</li>
					<?php 
							}
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo JEG_JS_URL . 'jeggallery.full.js';?>"></script>
<script type="text/javascript">
setTimeout(function(){
	jQuery(document).ready(function($)
	{
		$(window).jegdefault({
			curtain : <?php echo j_get_option('curtain', 0); ?>,
			rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
			clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>"		
		});
		
		/** jeg folio **/
		$("body").jegfolio({
			direction_nav	:  <?php echo j_get_option('direction_nav', 0); ?>,
			control_nav		:  <?php echo j_get_option('control_nav', 1); ?>,
            expand_script   : <?php echo j_get_option('portfolio_expand_script', 1); ?>
		});
	});
}, 200);
</script>