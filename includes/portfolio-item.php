<?php
	
	global $jdata;

	if($jdata->portoLayout == Jeg_Porto_Layout::$_MASONRY) {
		$jdata->portoItemHeight = '';
	}

	$mediatype = j_get_meta('portfolio_media'); 
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
		case 'link' 	:
			$covername = "porto_link_cover";
			$imageCover = JEG_CSS_URL . 'img/cover/link.jpg';
			$icontype = " icon-share-alt  ";
			break;
	}
	
	/** get category list **/
	$catlist = array();
	$cattext = array();		
	$termlist = get_the_terms(get_the_ID(), JEG_PORTFOLIO_CATEGORY);
	
	if(!empty($termlist)) {
		foreach(get_the_terms(get_the_ID(), JEG_PORTFOLIO_CATEGORY) as $category) {
			$catlist[] = $category->term_id;
			$cattext[] = $category->name;
		}
	}
	
	$imageCover = j_get_meta($covername, $imageCover);
	
	/** like item **/
	$likecounter = j_get_like_count(get_the_ID());
	if($likecounter == 0) $likecounter = "";
	
	$voted = j_have_voted(get_the_ID()) ? "voted" : "";
	
	if($mediatype != 'link') {
	
?>

<div class="item notloaded <?php echo j_build_porto_category($catlist); ?> " data-id="<?php echo get_the_ID(); ?>" data-url="<?php echo j_the_slug();?>" data-src="<?php echo get_permalink(); ?>">
	<a href="<?php printf("%s#/%s", get_permalink($jdata->postid)  , j_the_slug());?>" data-tourl="false">
		<div class="shadow"></div>
	</a>			
	<div class="small-loader"></div>
	
	<?php if(j_get_option('portfolio_like')) : ?>
	<div class="love-this <?php echo $voted; ?>" data-id="<?php echo get_the_ID(); ?>" data-voted="<?php j_e('thanks_vote_lang');?>" data-vote="<?php j_e('likethis_lang');?>" data-counter="<?php echo $likecounter; ?>">					
		<span class="love-counter"><?php echo $likecounter; ?></span>
		<b class="icon-heart"></b>
	</div>
	<?php endif; ?>
	
	<a href="<?php printf("%s#", get_permalink($jdata->postid)); ?>" data-tourl="false">
		<div class="closeme">
			<div class="icon-remove"></div>
		</div>
	</a>
	<a href="<?php printf("%s#/%s", get_permalink($jdata->postid)  , j_the_slug());?>" data-tourl="false">
		<div class="item-wrapper" >			
			<figure>
				<img src="<?php echo jeg_get_image($imageCover, '', $jdata->portoItemWidth, $jdata->portoItemHeight)?>"/>
			</figure>
			<div class="bottom-holder">
				<div class="desc-holder">						
					<h3><?php the_title(); ?></h3>
					<h4><?php echo implode(', ' , array_map("ucfirst" , $cattext)); ?></h4>
					<i class="<?php echo $icontype; ?>"></i>
				</div>
			</div>	
		</div>
	</a>
</div>
<?php } 
	else if($mediatype == 'link') {
		$blankpage = "";
		if(j_get_meta('porto_link_blank')){
			$blankpage = ' target = "_blank" ';
		} 
?>

<div class="item notloaded <?php echo j_build_porto_category($catlist); ?> " data-id="<?php echo get_the_ID(); ?>" data-url="<?php echo j_the_slug();?>" data-src="<?php echo the_permalink(); ?>">
	<a href="<?php echo j_get_meta('porto_link_url'); ?>"  <?php echo $blankpage; ?>>
		<div class="shadow"></div>
	</a>			
	<div class="small-loader"></div>
	
	<?php if(j_get_option('portfolio_like')) : ?>
	<div class="love-this <?php echo $voted; ?>" data-id="<?php echo get_the_ID(); ?>" data-voted="<?php j_e('thanks_vote_lang');?>" data-vote="<?php j_e('likethis_lang');?>" data-counter="<?php echo $likecounter; ?>">					
		<span class="love-counter"><?php echo $likecounter; ?></span>
		<b class="icon-heart"></b>
	</div>
	<?php endif; ?>
	
	<a href="<?php echo j_get_meta('porto_link_url'); ?>"  <?php echo $blankpage; ?>>
		<div class="closeme">
			<div class="icon-remove"></div>
		</div>
	</a>
	
	<a href="<?php echo j_get_meta('porto_link_url'); ?>"  <?php echo $blankpage; ?>>
		<div class="item-wrapper" >			
			<figure>
				<img src="<?php echo jeg_get_image($imageCover, '', $jdata->portoItemWidth, $jdata->portoItemHeight)?>"/>
			</figure>
			<div class="bottom-holder">
				<div class="desc-holder">						
					<h3><?php the_title(); ?></h3>
					<h4><?php echo implode(', ' , array_map("ucfirst" , $cattext)); ?></h4>
					<i class="<?php echo $icontype; ?>"></i>
				</div>
			</div>	
		</div>
	</a>
</div>
	
<?php } ?>

