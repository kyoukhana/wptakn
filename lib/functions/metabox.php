<?php
/**
 * Metabox function
 * metabox used on 
 * 	- portfolio
 *  - front slider
 *  - pages
 * @author Jegbagus
 */

add_action('save_post'	, 'j_save_page_meta');
add_action('save_post'	, 'j_save_portfolio_meta');
add_action('save_post'	, 'j_save_frontslider_meta');
add_action('save_post'	, 'j_save_blogpost_meta');
add_action('admin_init'	, 'j_create_page_metabox');
add_action('admin_init'	, 'j_create_portfolio_metabox');
add_action('admin_init'	, 'j_create_frontslider_metabox');
add_action('admin_init'	, 'j_create_blogpost_metabox');

// create like metabox
// add_action('admin_init'	, 'create_like_metabox');

define('JEG_META_TEMPLATE_PATH'	, JEG_ADMIN_TEMPLATE_PATH . 'metabox/');
define('JEG_META_NONCE_ACTION'	, 'modify_metabox');

$jtemplate = new JTemplate(JEG_META_TEMPLATE_PATH);

function j_build_metabox_content($key, $arrContent){
	global $jtemplate;
	$html = '';
	
	foreach($arrContent as $content) {
		if($content['type'] == 'text') {
			$html .= $jtemplate->render('type-text', $content);
		}
		if($content['type'] == 'select') {
			$html .= $jtemplate->render('type-select', $content);
		}
		if($content['type'] == 'textarea') {
			$html .= $jtemplate->render('type-textarea', $content);
		}
		if($content['type'] == 'checkbox') {
			$html .= $jtemplate->render('type-checkbox', $content);
		}
		if($content['type'] == 'radio') {
			$html .= $jtemplate->render('type-radio', $content);
		}
		if($content['type'] == 'multicheckbox') {
			$html .= $jtemplate->render('type-multicheckbox', $content);
		}
		if($content['type'] == 'upload') {
			$html .= $jtemplate->render('type-upload', $content);
		} 
		if($content['type'] == 'warning') {
			$html .= $jtemplate->render('type-warning', $content);
		}
		if($content['type'] == 'heading') {
			$html .= $jtemplate->render('type-heading', $content);
		}
		if($content['type'] == 'slider') {
			$html .= $jtemplate->render('type-slider', $content);
		}
		if($content['type'] == 'imagegallery') {
			$content['imagelist'] = jeg_get_paged_image(false);
			$html .= $jtemplate->render('type-gallery', $content);
		}
	}
	
	$data['metakey'] 		= $key;
	$data['metaoption']		= $html;
	return $jtemplate->render('content', $data);	
}

function j_build_metabox ($arrs , $type) {
	global $jtemplate;
	$data = array();
		
	$data['key'] 	 	= $jtemplate->render('tablist', array_keys($arrs));	
	
	// build content	
	$data['content'] = '';
	foreach ($arrs as $key => $content) {
		$data['content'] .= j_build_metabox_content($key, $content);
	}
	
	if($type == JEG_PORTFOLIO_POST_TYPE) {
		$data['portfoliomedia'] = j_meta_default_value('portfolio_media', 'gallery');
		$jtemplate->render('portfoliometabox', $data, true);
	} else if($type == JEG_FRONT_POST_TYPE) {
		$data['frontslidermedia'] = j_meta_default_value('frontslider_media', 'image');
		$jtemplate->render('frontslidermetabox', $data, true);
	}else {
		$jtemplate->render('metabox', $data, true);
	}
}

function j_build_simple_metabox($arrs, $name) {
	global $jtemplate;
	$data = array();
	
	$data['content'] = '';
	$data['content'] .= j_build_metabox_content($name, $arrs);	
	$jtemplate->render('simple-metabox', $data, true);
}

function j_meta_default_value($id, $default) {
	global $post;
	$metavalue = get_post_meta($post->ID, j_name($id), true);	
	if(!empty($metavalue)) {
		return unserialize($metavalue);
	} else {
		return $default;
	}
}


function j_create_metabox_nonce($id) {
	return  wp_nonce_field(JEG_META_NONCE_ACTION, $id . '_nonce');
}


function j_save_simple_meta_data($arrs, $postid, $type = 'page') {
	if ( !current_user_can( 'edit_page', $postid ))
		return ;
	
	// disable magic quote for saving json 
	jeg_disable_magic_quote();
		
	foreach ($arrs as $option) {
			
		if($option['type'] == 'warning' || $option['type'] == 'heading') {
			continue;
		}
		
		if ( !wp_verify_nonce($_POST[$option['id'] . '_nonce'], JEG_META_NONCE_ACTION) ) {
			return null;	   	
		}
		
		$value = $_POST[$option['id']];
		
		if(empty($value)) {
			if($option['type'] == "checkbox") {
				update_post_meta($postid, $option['id'], serialize(false));
			} else {
				delete_post_meta($postid, $option['id'], get_post_meta($postid, $option['id'], true));
			}
		} else {
			$metavalue = get_post_meta($postid, $option['id'], true);
			if($metavalue) {
				update_post_meta($postid, $option['id'], serialize($value));
			} else {
				add_post_meta($postid, $option['id'], serialize($value), true);
			}
		}
	}
}

function j_save_meta_data ($arrs, $postid, $type = 'page') {
	
	if ( !current_user_can( 'edit_page', $postid ))
		return ;		
	
	foreach ($arrs as $options) {		
		foreach ($options as $option) {
								
			if($option['type'] == 'warning' || $option['type'] == 'heading') {
				continue;
			}
			
			if(!$option['type'] == 'nononce') {
				if ( !wp_verify_nonce($_POST[$option['id'] . '_nonce'], JEG_META_NONCE_ACTION) ) {
					return null;	   	
				}
			}
								
			if(empty($_POST[$option['id']])) {
				if($option['type'] == "checkbox") {
					update_post_meta($postid, $option['id'], serialize(0));
				} else {
					delete_post_meta($postid, $option['id'], get_post_meta($postid, $option['id'], true));
				}
			} else {
				$value = $_POST[$option['id']];
				$metavalue = get_post_meta($postid, $option['id'], true);
				
				if($option['type'] == "imagegallery") 
				{
					update_post_meta($postid, $option['id'], $value);
				} else 
				{
					if($metavalue)
					{
						update_post_meta($postid, $option['id'], serialize($value));
					} else {
						add_post_meta($postid, $option['id'], serialize($value), true);
					}
				}
				
			}
		}
	}
	return true;
}

/*** portfolio meta ***/

function j_get_portfolio_meta() {
	
	global $post;	
	
	$gallery = array(
		array (
			'type'			=> 'warning',
			'title'			=> 'Attention',
			'content'		=> 'To insert image gallery, <a title="Add Media" class="attachgallery" href="#">Click Here <img width="15" height="15" src="' . JEG_ADMIN_CSS_URL . 'images/media-button.png' . '"></a>  or you can click Upload/Insert link above and do as you normally do for inserting gallery.'
		) ,		
		array (
			'id' 			=> j_name('porto_gallery_cover'),
			'type'			=> 'upload',
			'title'			=> 'Gallery image cover',
			'description'	=> 'Please upload your image cover for this gallery. Image cover will show as a preview of portfolio. ',
			'default'		=> j_meta_default_value('porto_gallery_cover', '')
		) ,		
		array (
			'id' 			=> j_name('porto_gallery_download_url'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio file to be downloaded',
			'description'	=> 'Upload portfolio file that can be donwloaded by your client. example : zip file of your work for client.',
			'default'		=> j_meta_default_value('porto_gallery_download_url', '')
		) ,
		array (
			'id' 			=> j_name('porto_gallery_crop'),
			'type'			=> 'checkbox',
			'title'			=> 'Show full image (not cropped)',
			'description'	=> 'Check this option if you want to show full image size inside portfolio container instead of croped image that will fill all portfolio region' ,
			'default'		=> j_meta_default_value('porto_gallery_crop', 0)
		),
		array (
			'id' 			=> j_name('porto_image_gallery'),
			'type'			=> 'imagegallery',
			'title'			=> 'Image gallery for portfolio',
			'description'	=> 'build your image gallery for portfolio, you can arrange the file & upload file here.' ,
			'default'		=> get_post_meta($post->ID, j_name('porto_image_gallery'), true)
		),
	);		
	
	$youtube = array(
		array (
			'id' 			=> j_name('porto_youtube_url'),
			'type'			=> 'text',
			'title'			=> 'Youtube video URL',
			'description'	=> 'This theme will parse youtube url video automatically, so you don\'t need to insert embeed video or find video id by yourself.  Just simply insert youtube video url. <br> ex :www.youtube.com/watch?v=qDpDZclBCo8',
			'default'		=> j_meta_default_value('porto_youtube_url', '')
		),
		array (
			'id' 			=> j_name('porto_youtube_cover'),
			'type'			=> 'upload',
			'title'			=> 'Youtube image cover',
			'description'	=> 'Please upload your image cover for this video portfolio. Image cover will show as a preview of portfolio.',
			'default'		=> j_meta_default_value('porto_youtube_cover', '')
		),
		array (
			'id' 			=> j_name('porto_youtube_download_url'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio file to be downloaded',
			'description'	=> 'Upload portfolio file that can be donwloaded by your client. example : zip file of your work for client.',
			'default'		=> j_meta_default_value('porto_youtube_download_url', '')
		)
	);
	
	$vimeo = array(
		array (
			'id' 			=> j_name('porto_vimeo_url'),
			'type'			=> 'text',
			'title'			=> 'Vimeo video URL',
			'description'	=> 'This theme will parse your vimeo video url automatically. ex : http://vimeo.com/11320958.',
			'default'		=> j_meta_default_value('porto_vimeo_url', '')
		),
		array (
			'id' 			=> j_name('porto_vimeo_cover'),
			'type'			=> 'upload',
			'title'			=> 'Vimeo image cover',
			'description'	=> 'Please upload your image cover for this video portfolio. Image cover will show as a preview of portfolio. ',
			'default'		=> j_meta_default_value('porto_vimeo_cover', '')
		),
		array (
			'id' 			=> j_name('porto_vimeo_download_url'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio file to be downloaded',
			'description'	=> 'Upload portfolio file that can be donwloaded by your client. example : zip file of your work for client.',
			'default'		=> j_meta_default_value('porto_vimeo_download_url', '')
		)
	);
	
	$video = array(
		array (
			'type'			=> 'warning',
			'title'			=> 'Info',
			'content'		=> 'HTML 5 Video offer 3 file type you can choose. <br> For maximum compatibility we recommended to fill all video type. <ol><li>Safari / IOS (like iPad or iPhone device) will use MP4 video format. </li><li>Firefox, Opera, Chrome will use OGG video format. and WEBM is newest video encoding.</li><li>This theme also provide callback for older browser that will use flash instead of HTML 5.</li></ol>'
		) ,	
		array (
			'id' 			=> j_name('porto_video_mp4'),
			'type'			=> 'upload',
			'title'			=> 'MP4 Video Type',
			'description'	=> 'MP4 Video type will be used when portfolio runing on Safari or IOS device.',
			'default'		=> j_meta_default_value('porto_video_mp4', '')
		),
		array (
			'id' 			=> j_name('porto_video_ogg'),
			'type'			=> 'upload',
			'title'			=> 'OGG / OGV video type',
			'description'	=> 'OGG Video type will be used when portfolio runing on Firefox, Opera, Chrome browser.',
			'default'		=> j_meta_default_value('porto_video_ogg', '')
		),
		array (
			'id' 			=> j_name('porto_video_webm'),
			'type'			=> 'upload',
			'title'			=> 'WEBM Video Type',
			'description'	=> 'New WEBM video format.',
			'default'		=> j_meta_default_value('porto_video_webm', '')
		),
		array (
			'id' 			=> j_name('porto_video_cover'),
			'type'			=> 'upload',
			'title'			=> 'HTML 5 video image cover',
			'description'	=> 'Please upload your image cover for this video portfolio.',
			'default'		=> j_meta_default_value('porto_video_cover', '')
		),
		array (
			'id' 			=> j_name('porto_video_download_url'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio file to be downloaded',
			'description'	=> 'Upload portfolio file that can be donwloaded by your client. example : zip file of your work for client.',
			'default'		=> j_meta_default_value('porto_video_download_url', '')
		)
	);
	
	$music = array(
		array (
			'id' 			=> j_name('porto_music_mp3'),
			'type'			=> 'upload',
			'title'			=> 'MP3 File type',
			'description'	=> 'Please upload your mp3 file for this music portfolio. ',
			'default'		=> j_meta_default_value('porto_music_mp3', '')
		),
		array (
			'id' 			=> j_name('porto_music_ogg'),
			'type'			=> 'upload',
			'title'			=> 'OGG File type',
			'description'	=> 'Please upload your OGG file for this music portfolio. OGG will be used for playing music on firefox.',
			'default'		=> j_meta_default_value('porto_music_ogg', '')
		),
		array (
			'id' 			=> j_name('porto_music_cover'),
			'type'			=> 'upload',
			'title'			=> 'Music image cover',
			'description'	=> 'Please upload your image cover for this music portfolio. Image cover will show as a preview of portfolio.',
			'default'		=> j_meta_default_value('porto_music_cover', '')
		),
		array (
			'id' 			=> j_name('porto_audio_download_url'),
			'type'			=> 'upload',
			'title'			=> 'Portfolio file to be downloaded',
			'description'	=> 'Upload portfolio file that can be donwloaded by your client. example : zip file of your work for client.',
			'default'		=> j_meta_default_value('porto_audio_download_url', '')
		)
	);
	
	$link = array(
		array (
			'id' 			=> j_name('porto_link_cover'),
			'type'			=> 'upload',
			'title'			=> 'Image link cover',
			'description'	=> 'Please upload your image cover for this link portfolio. Image cover will show as a preview of portfolio.',
			'default'		=> j_meta_default_value('porto_link_cover', '')
		),
		array (
			'id' 			=> j_name('porto_link_url'),
			'type'			=> 'text',
			'title'			=> 'URL Link to other page',
			'description'	=> 'you can point portfolio page to other page.',
			'default'		=> j_meta_default_value('porto_link_url', '')
		),
		array (
			'id' 			=> j_name('porto_link_blank'),
			'type'			=> 'checkbox',
			'title'			=> 'Open link on new tab',
			'description'	=> 'check this option if you want to open portfolio item on new tab (only applicable for external website)' ,
			'default'		=> j_meta_default_value('porto_link_blank', 0)
		),
	);
	
	return array(
		'Gallery'				=> $gallery,
		'Youtube'				=> $youtube,
		'Vimeo'					=> $vimeo,
		'HTML 5 Video'			=> $video,
		'Music'					=> $music,
		'Link'					=> $link
	);
	
}

function j_get_like_meta() {
	$likeitem = array(
		array (
			'id' 			=> j_name('post_initial_like'),
			'type'			=> 'text',
			'title'			=> 'Initial number of like',
			'description'	=> 'Initial number of like on portfolio item',
			'default'		=> j_meta_default_value('post_initial_like', '')
		)
	);
	
	return $likeitem;
}

function j_save_portfolio_meta() {
	global $post;
	if(isset($post->post_type) && $post->post_type == JEG_PORTFOLIO_POST_TYPE){
		// portfolio metabox
		
		if(!empty($post->ID)) {
			j_save_meta_data(j_get_portfolio_meta(), $post->ID, JEG_PORTFOLIO_POST_TYPE);
	
			// portfolio media
			j_save_meta_data(array( array (array (
								'id' 			=> j_name('portfolio_media'),
								'type'			=> 'nononce',
								'default'		=> j_meta_default_value('portfolio_media', 'gallery')
							))), $post->ID, JEG_PORTFOLIO_POST_TYPE);
	
			// like metabox
			j_save_simple_meta_data(j_get_like_meta(), $post->ID, JEG_PORTFOLIO_POST_TYPE);
		}
	}
}

function jeg_portfolio_meta() {
	j_build_metabox(j_get_portfolio_meta(), JEG_PORTFOLIO_POST_TYPE);
}

function jeg_like_meta() {
	j_build_simple_metabox(j_get_like_meta(), 'likemeta');
}

function j_create_portfolio_metabox() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( JEG_THEME . '_portfolio_meta' , 
					  JEG_THEMENAME . ' Portfolio Media' , 
					  'jeg_portfolio_meta',
					  JEG_PORTFOLIO_POST_TYPE,
					  'normal',
					  'high');
			
		add_meta_box( JEG_THEME . '_like_meta' , 
					  JEG_THEMENAME . ' Dummy Like' , 
					  'jeg_like_meta',
					  JEG_PORTFOLIO_POST_TYPE,
					  'side',
					  'low');		
	}
}

/*** front slider meta box ***/

function get_frontslider_meta() {	
	$image = array(	
		array (
			'id' 			=> j_name('frontslider_image'),
			'type'			=> 'upload',
			'title'			=> 'Front Slider Image',
			'description'	=> 'Upload your front slider image, this image can also from other website.',
			'default'		=> j_meta_default_value('frontslider_image', '')
		),
		array (
			'id' 			=> j_name('frontslider_nocrop'),
			'type'			=> 'checkbox',
			'title'			=> 'Show full image with out croping zone',
			'description'	=> 'disable this option will crop image, and fill all screen' ,
			'default'		=> j_meta_default_value('frontslider_nocrop', 0)
		),
		array (
			'id' 			=> j_name('frontslider_pos'),
			'type'			=> 'select',
			'title'			=> 'Select Front Image Position',
			'description'	=> 'Select front image position when loading, you can choose 3 image position. This position will also apply for responsive front slider image',
			'option'		=> array('top'=>'top','center'=>'center','bottom'=>'bottom'),
			'default'		=> j_meta_default_value('frontslider_pos', 'center')
		),
		array (
			'id' 			=> j_name('frontslider_image_link'),
			'type'			=> 'text',
			'title'			=> 'Link to other page',
			'description'	=> 'Link to other page from this slider, must be absolute url. Can be internal url to point other page, or link to other website.',
			'default'		=> j_meta_default_value('frontslider_image_link', '')
		)
			
	);
	
	$youtube = array(
		array (
			'id' 			=> j_name('frontslider_youtube_url_link'),
			'type'			=> 'text',
			'title'			=> 'Link to other page',
			'description'	=> 'Link to other page from this slider, must be absolute url. Can be internal url to point other page, or link to other website.',
			'default'		=> j_meta_default_value('frontslider_youtube_url_link', '')
		),
		array (
			'id' 			=> j_name('frontslider_youtube_url'),
			'type'			=> 'text',
			'title'			=> 'Youtube video URL',
			'description'	=> 'This theme will parse youtube url video automatically, so you don\'t need to insert embeed video or find video id by yourself.  Just simply insert youtube video url. <br> ex :www.youtube.com/watch?v=qDpDZclBCo8',
			'default'		=> j_meta_default_value('frontslider_youtube_url', '')
		),
		array (
			'type'			=> 'heading',
			'title'			=> 'Youtube Mobile Fallback (On mobile device, youtube player will be replaced using this image)'
		),
		array (
			'id' 			=> j_name('frontslider_youtube_image'),
			'type'			=> 'upload',
			'title'			=> 'Front Slider Image',
			'description'	=> 'Upload your front slider image, this image can also from other website.',
			'default'		=> j_meta_default_value('frontslider_youtube_image', '')
		),
		array (
			'id' 			=> j_name('frontslider_youtube_nocrop'),
			'type'			=> 'checkbox',
			'title'			=> 'Show full image with out croping zone',
			'description'	=> 'disable this option will crop image, and fill all screen' ,
			'default'		=> j_meta_default_value('frontslider_youtube_nocrop', 0)
		),
		array (
			'id' 			=> j_name('frontslider_youtube_pos'),
			'type'			=> 'select',
			'title'			=> 'Select Front Image Position',
			'description'	=> 'Select front image position when loading, you can choose 3 image position. This position will also apply for responsive front slider image',
			'option'		=> array('top'=>'top','center'=>'center','bottom'=>'bottom'),
			'default'		=> j_meta_default_value('frontslider_youtube_pos', 'center')
		)
		
	);	
	
	$video = array(
		array (
			'id' 			=> j_name('frontslider_video_link'),
			'type'			=> 'text',
			'title'			=> 'Link to other page',
			'description'	=> 'Link to other page from this slider, must be absolute url. Can be internal url to point other page, or link to other website.',
			'default'		=> j_meta_default_value('frontslider_video_link', '')
		),
		array (
			'type'			=> 'warning',
			'title'			=> 'Info',
			'content'		=> 'HTML 5 Video offer 3 file type you can choose. <br> For maximum compatibility we recommended to fill all video type. <ol><li>Safari / IOS (like iPad or iPhone device) will use MP4 video format. </li><li>Firefox, Opera, Chrome will use OGG video format. and WEBM is newest video encoding.</li><li>This theme also provide callback for older browser that will use flash instead of running using browser capability.</li></ol>'
		) ,	
		array (
			'id' 			=> j_name('frontslider_video_mp4'),
			'type'			=> 'upload',
			'title'			=> 'MP4 Video Type',
			'description'	=> 'MP4 Video type will be used when portfolio runing on Safari or IOS device.',
			'default'		=> j_meta_default_value('frontslider_video_mp4', '')
		),
		array (
			'id' 			=> j_name('frontslider_video_ogg'),
			'type'			=> 'upload',
			'title'			=> 'OGG / OGV video type',
			'description'	=> 'OGG Video type will be used when portfolio runing on Firefox, Opera, Chrome browser.',
			'default'		=> j_meta_default_value('frontslider_video_ogg', '')
		),
		array (
			'id' 			=> j_name('frontslider_video_webm'),
			'type'			=> 'upload',
			'title'			=> 'WEBM Video Type',
			'description'	=> 'New WEBM video format. ',
			'default'		=> j_meta_default_value('frontslider_video_webm', '')
		),
		
		array (
			'type'			=> 'heading',
			'title'			=> 'HTML 5 Mobile Fallback (On mobile device, HTML player will be replaced using this image)'
		),
		array (
			'id' 			=> j_name('frontslider_html_image'),
			'type'			=> 'upload',
			'title'			=> 'Front Slider Image',
			'description'	=> 'Upload your front slider image, this image can also from other website.',
			'default'		=> j_meta_default_value('frontslider_html_image', '')
		),
		array (
			'id' 			=> j_name('frontslider_html_nocrop'),
			'type'			=> 'checkbox',
			'title'			=> 'Show full image with out croping zone',
			'description'	=> 'disable this option will crop image, and fill all screen' ,
			'default'		=> j_meta_default_value('frontslider_html_nocrop', 0)
		),
		array (
			'id' 			=> j_name('frontslider_html_pos'),
			'type'			=> 'select',
			'title'			=> 'Select Front Image Position',
			'description'	=> 'Select front image position when loading, you can choose 3 image position. This position will also apply for responsive front slider image',
			'option'		=> array('top'=>'top','center'=>'center','bottom'=>'bottom'),
			'default'		=> j_meta_default_value('frontslider_html_pos', 'center')
		)
	);	
		
	return array(
		'Image'					=> $image,
		'Youtube'				=> $youtube,
		'HTML 5 Video'			=> $video,
	);
}

function j_save_frontslider_meta() {
	global $post;
	if(isset($post->post_type) && $post->post_type == JEG_FRONT_POST_TYPE){
		j_save_meta_data(get_frontslider_meta(), $post->ID, JEG_FRONT_POST_TYPE);
		j_save_meta_data(array( array (array (
							'id' 			=> j_name('frontslider_media'),
							'type'			=> 'nononce',			
							'default'		=> j_meta_default_value('frontslider_media', 'image')
						))), $post->ID, JEG_FRONT_POST_TYPE);				
	}
}

function jeg_frontslider_meta() {
	j_build_metabox(get_frontslider_meta(), JEG_FRONT_POST_TYPE);
}

function j_create_frontslider_metabox() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( JEG_THEME . '_frontslider_meta' , 
					  JEG_THEMENAME . ' Front Slider Media' , 
					  'jeg_frontslider_meta',
					  JEG_FRONT_POST_TYPE,
					  'normal',
					  'high');
	}
}



/*** page meta ***/
function j_get_page_meta() {
	
	global $post;
	
	$blog = array(		
		array (
			'type'			=> 'warning',
			'title'			=> 'Info',
			'content'		=> 'This setting intend to be empty, you can find all blog setting on ' . JEG_THEMENAME . ' Settings &raquo; Page setting &raquo; Blog '
		),
	);
	
	$single = array(
		array (
			'id' 			=> j_name('single_layout'),
			'type'			=> 'radio',
			'title'			=> 'Page Layout',
			'description'	=> 'Choose your page layout',
			'option'		=> array(
				Jeg_Sidebar::$_RIGHT		=> 'Right sidebar layout',
				Jeg_Sidebar::$_LEFT 		=> 'Left sidebar layout',
				Jeg_Sidebar::$_FULLWIDTH 	=> 'Fullwidth no sidebar',
			),
			'default'		=> j_meta_default_value('single_layout', JEG_DEFAULT_LAYOUT)
		),
		array (
			'id' 			=> j_name('single_sidebar'),
			'type'			=> 'select',
			'title'			=> 'Page Sidebar',
			'description'	=> 'Select sidebar that match with your page. You can create sidebar at ' . JEG_THEMENAME . ' setting &raquo; General Setting &raquo; Sidebar. <br>Fullwidth layout will not show sidebar.',
			'option'		=> j_get_sidebar_list(),
			'default'		=> j_meta_default_value('single_sidebar', jegGenId(JEG_DEFAULT_SIDEBAR))
		),
		array (
			'id' 			=> j_name('single_hidemeta'),
			'type'			=> 'checkbox',
			'title'			=> 'Hide page meta',
			'description'	=> 'Hide page meta detail. Check this if you don\'t want to show meta detail of this post. Including who write post and when post is published' ,
			'default'		=> j_meta_default_value('single_hidemeta', 0)
		),
		array (
			'id' 			=> j_name('single_hidecomment'),
			'type'			=> 'checkbox',
			'title'			=> 'Hide page comment',
			'description'	=> 'Disable comment on this page. This option will override global comment setting.' ,
			'default'		=> j_meta_default_value('single_hidecomment', 1)
		),
		array (
			'id' 			=> j_name('single_stop_music'),
			'type'			=> 'checkbox',
			'title'			=> 'Stop Music on this page',
			'description'	=> 'Enable this option if you want to stop music when user reach this page.' ,
			'default'		=> j_meta_default_value('single_stop_music', 0)
		)
	);
	
	$portfolio = array(
		array (
			'type'			=> 'heading',
			'title'			=> 'Portfolio Item Option'
		),
		array (
			'id' 			=> j_name('portfolio_filter'),
			'type'			=> 'checkbox',
			'title'			=> 'Show portfolio filter',
			'description'	=> 'Show portfolio filter in top of portfolio item' ,
			'default'		=> j_meta_default_value('portfolio_filter', 1)
		),
		array (
			'id' 			=> j_name('portfolio_image_caption'),
			'type'			=> 'checkbox',
			'title'			=> 'Show portfolio image caption',
			'description'	=> 'When portfolio expanded, show portfolio image caption bellow image' ,
			'default'		=> j_meta_default_value('portfolio_image_caption', 0)
		),		
		array(
			'type'			=> 'heading',
			'title'			=> 'Portfolio Paging'
		),
		array (
			'id' 			=> j_name('portfolio_paging'),
			'type'			=> 'checkbox',
			'title'			=> 'Use pagging for portfolio',
			'description'	=> 'If your portfolio has a large number of portfolio, you may interested to use this feature, but if not, its better to not to use this option' ,
			'default'		=> j_meta_default_value('portfolio_paging', 0)
		),		
		array (
			'id' 			=> j_name('portfolio_per_page'),
			'type'			=> 'text',
			'title'			=> 'Number of portfolio per page',
			'description'	=> 'Number of portfolio per ajax load',
			'default'			=> j_meta_default_value('portfolio_per_page', 10)
		),
		array (
			'type'			=> 'heading',
			'title'			=> 'Portfolio Layout'
		),
		array (
			'id' 			=> j_name('portfolio_layout'),
			'type'			=> 'radio',
			'title'			=> 'Portfolio Item Layout',
			'description'	=> 'Choose your portfolio layout',
			'option'		=> array(
				Jeg_Porto_Layout::$_MASONRY		=> 'Masonry Layout',
				Jeg_Porto_Layout::$_CLEAN		=> 'Normal Layout'
			),
			'default'		=> j_meta_default_value('portfolio_layout', Jeg_Porto_Layout::$_MASONRY)
		),
		array (
			'id' 			=> j_name('portfolio_exclude'),
			'type'			=> 'multicheckbox',
			'title'			=> 'Exclude portfolio category',
			'description'	=> 'Exclude selected portfolio category, it will helpfull if you want to separate portfolio into several page. Like "Ourdoor Photography Portfolio", and "Indoor Photography Portfolio"',
			'option'		=> j_get_portfolio_category(),
			'default'		=> j_meta_default_value('portfolio_exclude', array())
		),
		array (
			'id' 			=> j_name('portfolio_item_width'),
			'type'			=> 'slider',
			'title'			=> 'Item Width',
			'description'	=> 'Width of portfolio item',
			'option'		=> array(
				'max'		=> 500,
				'min'		=> 100,
				'step'		=> 1,		
				'size'		=> 'px'	
			),
			'default'		=> j_meta_default_value('portfolio_item_width', 180)
		),
		array (
			'id' 			=> j_name('portfolio_item_height'),
			'type'			=> 'slider',
			'title'			=> 'Item Height',
			'description'	=> 'Only aplicable when you choose Normal Portfolio Item Layout',
			'option'		=> array(
				'max'		=> 500,
				'min'		=> 100,
				'step'		=> 1,		
				'size'		=> 'px'
			),
			'default'		=> j_meta_default_value('portfolio_item_height', 210)
		),
		array (
			'id' 			=> j_name('portfolio_item_transition'),
			'type'			=> 'select',
			'title'			=> 'Item load transition',
			'description'	=> 'Transition when portfolio item finish loaded',
			'option'		=> array(
				'normal'	=> 	'Normal (No transition)',
				'fade'		=> 	'Fade transition',
				'seqfade'	=> 	'Sequence Fade',
				'sequpfade'	=> 	'Sequence Up & Fade',
				'upfade'	=> 	'Up Fade',
				'randomfade'=> 	'Random Fade',
				'randomupfade'=> 'Random Up Fade'
			),
			'default'		=> j_meta_default_value('portfolio_item_transition', 'sequpfade')
		),
		array (
			'type'			=> 'heading',
			'title'			=> 'Expand Portfolio Option'
		),
		array (
			'id' 			=> j_name('portfolio_theatherMode'),
			'type'			=> 'radio',
			'title'			=> 'Portfolio Expanded Mode',
			'description'	=> 'Portfolio will expanded after user clicked item. This option will control how expanded option will show',
			'option'		=> array(
				0	=> 'Inline Expanded Mode',
				1	=> 'Theater Mode'
			),
			'default'		=> j_meta_default_value('portfolio_theatherMode', 0)
		),
		array (
			'id' 			=> j_name('portfolio_galdim'),
			'type'			=> 'slider',
			'title'			=> 'Gallery tile dimension',
			'description'	=> 'Only applicable if you choose Inline expand Mode. <br/>This option will control width of gallery container where image, video or other media showed when item expanded. Size of this option based on width of tiles (Item width). When you choose 3 tile, its mean when item expanded, gallery container width is 3 times width of tile. If your item width is very small, its good idea to increase gallery width. By default this option size is 3 tile.',
			'option'		=> array(
				'max'		=> 6,
				'min'		=> 1,
				'step'		=> 1,
				'size'		=> 'tile'
			),
			'default'		=> j_meta_default_value('portfolio_galdim', 3)
		),
		array (
			'id' 			=> j_name('portfolio_description'),
			'type'			=> 'checkbox',
			'title'			=> 'Show portfolio description',
			'description'	=> 'You can hide portfolio description by turn this option off. if this option turned off, below option (Description tile dimension) won\'t have any effect' ,
			'default'		=> j_meta_default_value('portfolio_description', 1)
		),
		array (
			'id' 			=> j_name('portfolio_descdim'),
			'type'			=> 'slider',
			'title'			=> 'Description tile dimension',
			'description'	=> 'Only applicable if you choose Inline expand Mode. <br/> If your item size is very small, its good idea to increase desciption size. By default it size will range 1 tile, but you can increase it until 3 tile.',
			'option'		=> array(
				'max'		=> 3,
				'min'		=> 1,
				'step'		=> 1,
				'size'		=> 'tile'
			),
			'default'		=> j_meta_default_value('portfolio_descdim', 1)
		),
		array (
			'id' 			=> j_name('portfolio_wide_height'),
			'type'			=> 'slider',
			'title'			=> 'Height of expanded portfolio',
			'description'	=> 'Only applicable if you choose Inline expand Mode. <br/> This option will control height of expanded portfolio.',
			'option'		=> array(
				'max'		=> 800,
				'min'		=> 50,
				'step'		=> 1,
				'size'		=> 'px'
			),
			'default'		=> j_meta_default_value('portfolio_wide_height', 550)
		)
	);
	
	$frontslider = array(
		array (
			'id' 			=> j_name('frontslider_title'),
			'type'			=> 'text',
			'title'			=> 'Front Slide Title',
			'description'	=> 'Front slide main title',
			'default'		=> j_meta_default_value('frontslider_title', 'Your Company Name')
		),
		array (
			'id' 			=> j_name('frontslider_alt'),
			'type'			=> 'text',
			'title'			=> 'Front Slide Alt',
			'description'	=> 'Front slide alt title',
			'default'		=> j_meta_default_value('frontslider_alt', 'Your Company Slogan and Service')
		),
		array (
			'id' 			=> j_name('frontslider_delay'),
			'type'			=> 'slider',
			'title'			=> 'Slide Delay',
			'description'	=> 'slide transition delay between item',
			'option'		=> array(
				'max'		=> 30000,
				'min'		=> 1000,
				'step'		=> 1000,
				'size'		=> 'milisecond'
			),
			'default'		=> j_meta_default_value('frontslider_delay', 10000)
		),
		array (
			'id' 			=> j_name('front_slider_info_hide'),
			'type'			=> 'checkbox',
			'title'			=> 'Hide front slider info box',
			'description'	=> 'if you don\'t have plan to show info of slider, you can turn this option on to hide info box of front slider' ,
			'default'		=> j_meta_default_value('front_slider_info_hide', 0)
		),
	);
		
	$contact = array(
		array (
			'type'			=> 'warning',
			'title'			=> 'Info',
			'content'		=> 'This setting intend to be empty, you can find all contact setting and creating contact location on ' . JEG_THEMENAME . ' settings &raquo; Contact &amp; Email Detail '
		)		
	);
	
	$framepage = array(
		array (
			'id' 			=> j_name('frame_url'),
			'type'			=> 'text',
			'title'			=> 'Frame url',
			'description'	=> 'Url for frame content, URL must be same as content domain',
			'default'		=> j_meta_default_value('frame_url', '')
		)
	);
	
	$imagegallery = array(
		array(
			'type'			=> 'heading',
			'title'			=> 'Image Gallery Paging'
		),
		array (
			'id' 			=> j_name('image_paging'),
			'type'			=> 'checkbox',
			'title'			=> 'Use pagging for image gallerys',
			'description'	=> 'If your Image gallery has a large number of image, you may interested to use this feature, but if not, its better to not to use this option' ,
			'default'		=> j_meta_default_value('image_paging', 0)
		),		
		array (
			'id' 			=> j_name('image_per_page'),
			'type'			=> 'text',
			'title'			=> 'Number of portfolio per page',
			'description'	=> 'Number of portfolio per ajax load',
			'default'			=> j_meta_default_value('image_per_page', 10)
		),
		array(
			'type'			=> 'heading',
			'title'			=> 'Image Gallery Size'
		),
		array (
			'id' 			=> j_name('gallery_item_width'),
			'type'			=> 'slider',
			'title'			=> 'Gallery image Width',
			'description'	=> 'Width of gallery image',
			'option'		=> array(
				'max'		=> 500,
				'min'		=> 100,
				'step'		=> 1,		
				'size'		=> 'px'	
			),
			'default'		=> j_meta_default_value('gallery_item_width', 180)
		),
		array (
			'id' 			=> j_name('gallery_item_height'),
			'type'			=> 'slider',
			'title'			=> 'Gallery Item Height',
			'description'	=> 'Only aplicable when you choose Normal Gallery image layout',
			'option'		=> array(
				'max'		=> 500,
				'min'		=> 100,
				'step'		=> 1,		
				'size'		=> 'px'
			),
			'default'		=> j_meta_default_value('gallery_item_height', 210)
		),		
		array (
			'id' 			=> j_name('gallery_item_transition'),
			'type'			=> 'select',
			'title'			=> 'Image load transition',
			'description'	=> 'Transition when image finish loaded',
			'option'		=> array(
				'normal'	=> 	'Normal (No transition)',
				'fade'		=> 	'Fade transition',
				'seqfade'	=> 	'Sequence Fade',
				'sequpfade'	=> 	'Sequence Up & Fade',
				'upfade'	=> 	'Up Fade',
				'randomfade'=> 	'Random Fade',
				'randomupfade'=> 'Random Up Fade'
			),
			'default'		=> j_meta_default_value('gallery_item_transition', 'sequpfade')
		),
		array (
			'id' 			=> j_name('galery_image_gallery'),
			'type'			=> 'imagegallery',
			'title'			=> 'Image gallery',
			'description'	=> 'build your image gallery, you can arrange the file & upload file here.' ,
			'default'		=> get_post_meta($post->ID, j_name('galery_image_gallery'), true)
		),
	);
	
	$sitemap = array(
		array (
			'type'			=> 'warning',
			'title'			=> 'Info',
			'content'		=> '<br/>Sitemap page is very useful for SEO. 
			<br/>It will help all your page, portfolio, front slider and every ajax content to be crawled and indexed on google or other sitemap. 
			<br/>Best implementation for this page is to put one icon left bottom that point to this page so it will have this link on every page'
		),
	);
	
	return array(
		'Default (Single Page)'	=> $single,
		'Blog Page'				=> $blog,
		'Front Slider'			=> $frontslider,
		'Portfolio'				=> $portfolio,
		'Contact'				=> $contact,
		'Framed Page'			=> $framepage,
		'Image Gallery'			=> $imagegallery,
		'Sitemap Page'			=> $sitemap
	);
}


function jeg_page_meta() {
	j_build_metabox(j_get_page_meta(), 'page');
}

function j_create_page_metabox () {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( JEG_THEME . '_page_meta' , 
					  JEG_THEMENAME . ' Page Setting' , 
					  'jeg_page_meta',
					  'page',
					  'normal',
					  'high');
	}
}

function j_save_page_meta($postid) {
	global $post;
	if(isset($post->post_type) && $post->post_type == 'page'){
		j_save_meta_data(j_get_page_meta(), $post->ID, 'page');
	}
}

/** blog post **/

function j_save_blogpost_meta () {
	global $post;
	
	if(isset($post->post_type) && $post->post_type == 'post'){
		j_save_meta_data(j_get_blog_meta(), $post->ID, 'post');
	}
}

function j_get_blog_meta() {
	$musicplayer = array(
		array (
			'id' 			=> j_name('single_stop_music'),
			'type'			=> 'checkbox',
			'title'			=> 'Stop Music on this blog post',
			'description'	=> 'Enable this option if you want to stop music when user reach this blog post.' ,
			'default'		=> j_meta_default_value('single_stop_music', 0)
		)
	);
	
	return array(
		'Music Player'		=> $musicplayer		
	);
}

function jeg_blog_meta() {
	j_build_metabox(j_get_blog_meta(), 'post');
}

function j_create_blogpost_metabox () {	
	if ( function_exists('add_meta_box') ) {
		add_meta_box( JEG_THEME . '_page_meta' , 
					  JEG_THEMENAME . ' Blog Metabox' , 
					  'jeg_blog_meta',
					  'post',
					  'normal',
					  'high');
	}
}