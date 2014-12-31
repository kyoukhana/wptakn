<?php
/** testimoni **/
function jeg_testimonial( $atts ) {
	extract(shortcode_atts(
		array( 'author' => '' , 'occupation' => '', 'organization' => '', 'image' => '', 'testimoni' => ''), 
		$atts
	));
	
	if($occupation != '') {
		$author .= ' - ' . $occupation;  
	}
	
	if($organization != '') {
		$author .= ', ' . $organization;  
	}
	
	$html = '<div class="testibox">
				<div class="testiimage">
					<img src="' . jeg_get_image($image, null, 120, 120) . '"/>
				</div>
				<div class="testicontent">
					<div class="testitext">
						<div class="testiwrapper">
						<p>' . $testimoni . '</p>
						</div>
					</div>
					<div class="testimeta">
						<author>'. $author .'</author>
					</div>
				</div>
			</div>';
	
	return $html;
}
add_shortcode('testimonial', 'jeg_testimonial');



/** html5 audio **/
function jeg_html5audio( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'size' => '' , 'mp3' => '', 'image' => '', 'clearbottom' => 'false'), 
		$atts
	));
	
	$flashfallback = JEG_CSS_URL . 'mediaelement/flashmediaelement.swf';
	
	$html = '<div class="blog-gallery-type video-wrapper ' . $size .  ' " data-type="audio">
				<audio id="audioplayer" src="' . $mp3 . '" type="audio/mp3" controls="controls">
				<object width="640" height="360" type="application/x-shockwave-flash" data="' . $flashfallback . '"> 		
					<param name="movie" value="' . $flashfallback . '" /> 
					<param name="flashvars" value="controls=true&file=' . $mp3 . '" />
					<img src="' . $flashfallback . '" alt="Here we are" title="No video playback capabilities" />
				</object>
				</audio>
				<img title="" alt ="" src=" ' . $image . ' " />
			</div>';
	
	if($clearbottom == 'true') {
		$html .= '<div class="clearboth">&nbsp;</div>';
	}
	return $html;
}
add_shortcode('html5audio', 'jeg_html5audio');

/** html5 video **/
function jeg_html5video( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'size' => '' , 'mp4' => '', 'webm' => '', 'ogg' => '' , 'image' => '', 'clearbottom' => 'false'), 
		$atts
	));
	
	$media = '';
	if($mp4 != '') {
		$media .= '<source type="video/mp4" src="'. $mp4 .'" />';
	}
	if($webm != '') {
		$media .= '<source type="video/webm" src="'. $webm .'" />';
	}
	if($ogg != '') {
		$media .= '<source type="video/ogg" src="'. $ogg .'" />';
	}
	
	$flashfallback = JEG_CSS_URL . 'mediaelement/flashmediaelement.swf';
	
	$html = '<div class="blog-gallery-type video-wrapper ' . $size . '" data-type="video">
				<video id="player" poster="' . $image . '" controls="controls" preload="none">
					' . $media . '
					<object width="100%" height="100%" type="application/x-shockwave-flash" data="' . $flashfallback . '"> 
						<param name="movie" value="' . $flashfallback . '" /> 
						<param name="flashvars" value="controls=true&file=' . $mp4 . '" />
						<img src="' . $image . '" alt="Here we are" title="No video playback capabilities" />
					</object>
				</video>
			</div>';
	
	if($clearbottom == 'true') {
		$html .= '<div class="clearboth">&nbsp;</div>';
	}
	
	return $html;
}
add_shortcode('html5video', 'jeg_html5video');

/** youtube **/
function jeg_youtube( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'size' => '', 'src' => '' , 'clearbottom' => 'false'), 
		$atts
	));
		
	$html = "<div data-type='youtube' class='video-wrapper blog-gallery-type $size'> 
		<div data-src='$src' class='video-container'></div>
	</div>";
	
	if($clearbottom == 'true') {
		$html .= '<div class="clearboth">&nbsp;</div>';
	}
	
	return $html;
}
add_shortcode('youtube', 'jeg_youtube');

/** vimeo **/
function jeg_vimeo( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'type' => '' , 'size' => '', 'src' => '' , 'clearbottom' => 'false'), 
		$atts
	));
		
	$html = "<div data-type='vimeo' class='video-wrapper blog-gallery-type $size'> 
		<div data-src='$src' class='video-container'></div>
	</div>";	
	
	if($clearbottom == 'true') {
		$html .= '<div class="clearboth">&nbsp;</div>';
	}
	
	return $html;
	
}
add_shortcode('vimeo', 'jeg_vimeo');


/** tab **/
function jeg_tab( $atts, $content = null ) {
	return 
	'<div class="tab-wrapper" data-tab="tab">		
		' . do_shortcode($content) . '		
	</div>';
}
add_shortcode('tab-wrapper', 'jeg_tab');

/** tab body wrapper **/
function jeg_tab_body_wrapper( $atts, $content = null ) {
	return '<div class="tab-content">' . do_shortcode($content) . '</div>';
}
add_shortcode('tab-body-wrapper', 'jeg_tab_body_wrapper');

/** tab body **/
function jeg_tab_body( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'class' => ''), $atts
	));
	return '<div class="tab-pane ' . $class . '"><p>' . do_shortcode($content) . '</p></div>';
}
add_shortcode('tab-body', 'jeg_tab_body');

/** tab title wrapper **/
function jeg_tab_title_wrapper( $atts, $content = null ) {
	return '<ul class="nav nav-tabs">' . do_shortcode($content) . '</ul>';
}
add_shortcode('tab-title-wrapper', 'jeg_tab_title_wrapper');

/** tab title **/
function jeg_tab_title( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'class' => ''), $atts
	));
	return '<li class="' . $class . '"><a href="#">' . $content . '</a></li>';
}
add_shortcode('tab-title', 'jeg_tab_title');



/* accordion */
function jeg_accordion( $atts, $content = null ) {
	return '<div class="accordion" data-accordion="accordion">' . do_shortcode($content) . '</div>';
}
add_shortcode('accordion-wrapper', 'jeg_accordion');

/* accordion title */
function jeg_accor_title( $atts, $content = null ) {
	return '<div class="accordion-group"><div class="accordion-heading"><a href="#" class="accordion-toggle active">' . $content . '</a></div>';
}
add_shortcode('accordion-title', 'jeg_accor_title');

/* accordion body */
function jeg_accor_body( $atts, $content = null ) {
	return '<div class="accordion-body"><div class="accordion-inner">' . do_shortcode($content) . '</div></div></div>';
}
add_shortcode('accordion-body', 'jeg_accor_body');



/* alert */
function jeg_alert( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'style' => '', 'title' => ''), $atts
	));
	
	$alertstyle = '';
	switch ($style) {
		case 'warning' : 
			$alertstyle = 'alert-block';
			break;
		case 'error' :
			$alertstyle = 'alert-error'; 
			break;
		case 'success' : 
			$alertstyle = 'alert-success';			
			break;
		case 'info' : 
			$alertstyle = 'alert-info';
			break;
	}
	
	return "<div class='alert $alertstyle'><a class='close' data-dismiss='alert'>×</a><strong>$title</strong> $content </div>";
}
add_shortcode('alert', 'jeg_alert');


/* qoute */
function jeg_quote( $atts ) {
	extract(shortcode_atts(
		array( 'author' => '', 'content' => ''), $atts
	));
	return '<blockquote> ' . do_shortcode($content) . ' <author> ' . $author. ' </author> </blockquote>';
}
add_shortcode('quote', 'jeg_quote');


/* icon */
function jeg_icon( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'color' => '', 'style' => ''), $atts
	));
			
	return "<i class='$color $style'></i>";	
}
add_shortcode('icon', 'jeg_icon');


/* button */
function jeg_button( $atts, $content = null ) {
	extract(shortcode_atts(
		array( 'url' => '', 'style' => ''), $atts
	));
	
	$tag = 'button';
	if($url != '') {
		$tag = 'a';
	}
	
	return "<$tag href='$url' class='btn btn-$style'>" . do_shortcode($content) . "</$tag>";	
}
add_shortcode('button', 'jeg_button');


function jeg_shortcode_portfolio($atts, $content = null) {
	extract(shortcode_atts(
		array( 'id' => ''), $atts
	));

	$post = get_post($id);
	$output = '';
	
	if(!$post || $post->post_type != JEG_PORTFOLIO_POST_TYPE) {
		return __('Not a portfolio file');
	} else {
		$mediatype = j_get_meta('portfolio_media', '', $id);
		
		if($mediatype == 'gallery') {
			
			$galleries = jeg_get_image_gallery($id, 'porto_image_gallery');
			$selector = "gallery-{$post->post_name}";
			
			$output .= "<div id='$selector' class='carousel es-carousel-wrapper blog-gallery'> 
								<div class='es-carousel'> 
									<ul>";	
			
			if($galleries !== false) {
				
				foreach ($galleries as $gallery) : 
					$thumbfile = jeg_get_image($gallery['file'], '', intval(get_option('thumbnail_size_w')), intval(get_option('thumbnail_size_h')));
					$output .= "<li>
									<a href='" . $gallery['file'] . "' data-title='" . $gallery['title'] . "' data-tourl='false'>
										<span></span>
										<img src='" . $thumbfile  . "' alt='". get_post_meta($id, '_wp_attachment_image_alt', true) ."'/>						
									</a>
								</li>";
				endforeach;
				
			} else {
				
				$galleries = get_children(
					array(	'order'				=> 'ASC',
							'orderby'			=>'menu_order', 
							'post_parent' 		=> $id, 
							'post_type' 		=> 'attachment', 
							'post_mime_type' 	=>'image'
					));
				
				$i = 0;
				foreach ( $galleries as $id => $attachment ) {
					$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url ($id) : get_attachment_link($id);
					$image = wp_get_attachment_image_src($id, 'thumbnail');
					$attach =& get_post($id);
					$output .= "<li>
									<a href='" . $attachment->guid . "' data-title='" . $attach->post_title . "' data-tourl='false'>
										<span></span>
										<img src='" . $image[0]  . "' alt='". get_post_meta($id, '_wp_attachment_image_alt', true) ."'/>						
									</a>
								</li>";
				}
			
			}
			
			$output .= "</ul>
						</div>
						<div>
							<div class='btn-prev'>Prev</div>
							<div class='btn-next'>Next</div>
						</div>
					</div>";
				
			return $output;
			
		} else {
			return __('Unable to display portfolio type : ' . $mediatype);
		}
	}
}

add_shortcode('portfolio', 'jeg_shortcode_portfolio');

/** override gallery plugin **/
function jeg_gallery( $output, $attr) {	
    global $post;
    
    if(!$post || $post->post_type == JEG_PORTFOLIO_POST_TYPE || $post->post_type == JEG_FRONT_POST_TYPE ) {
    	return "<div class='hideme'></div>";
    }
    
	static $instance = 0;
	$instance++;
	$output = '';
	
	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'columns'    => 3,
		'size'		 => 'post-gallery',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';
	
	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, 'thumbnail', true) . "\n";
		return $output;
	}	

	$selector = "gallery-{$instance}";
	$output .= "<div id='$selector' class='carousel es-carousel-wrapper blog-gallery'> 
					<div class='es-carousel'> 
						<ul>";	
	
	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url ($id) : get_attachment_link($id);
		$image = wp_get_attachment_image_src($id, 'thumbnail');
		$attach = get_post($id);
		$output .= "<li>
						<a href='" . $link . "' data-title='" . $attach->post_title . "' data-tourl='false'>
							<span></span>
							<img src='" . $image[0]  . "' alt='". get_post_meta($id, '_wp_attachment_image_alt', true) ."'/>						
						</a>
					</li>";
	}

	$output .= "</ul>
			</div>
			<div>
				<div class='btn-prev'>Prev</div>
				<div class='btn-next'>Next</div>
			</div>
		</div>";
	
	return $output;
}

if(j_get_option('page_gallery', 1)) {
	add_filter( 'post_gallery', 'jeg_gallery', 10, 2 );
}

