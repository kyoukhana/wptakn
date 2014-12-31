<?php
add_action('wp_ajax_get_portfolio_item'			, 'jeg_get_portfolio_item');
add_action('wp_ajax_nopriv_get_portfolio_item'	, 'jeg_get_portfolio_item');

add_action('wp_ajax_resparser'					, 'jeg_resparser');
add_action('wp_ajax_nopriv_resparser'			, 'jeg_resparser');

add_action('wp_ajax_contact'					, 'jeg_send_contact');
add_action('wp_ajax_nopriv_contact'				, 'jeg_send_contact');

add_action('wp_ajax_font_variant'				, 'jeg_ajax_font_variant');
add_action('wp_ajax_nopriv_font_variant'		, 'jeg_ajax_font_variant');

add_action('wp_ajax_get_gallery'				, 'jeg_get_gallery');
add_action('wp_ajax_nopriv_get_gallery'			, 'jeg_get_gallery');

add_action('wp_ajax_portfolio_load_more'				, 'jeg_portfolio_more');
add_action('wp_ajax_nopriv_portfolio_load_more'			, 'jeg_portfolio_more');

/** get page image **/
add_action('wp_ajax_get_paged_image'			, 'jeg_get_paged_image');
add_action('wp_ajax_nopriv_get_paged_image'		, 'jeg_get_paged_image');

add_action('wp_ajax_portfolio_change_sequence'				, 'jeg_change_sequence');
add_action('wp_ajax_nopriv_portfolio_change_sequence'		, 'jeg_change_sequence');

$ajxtpl = new JTemplate(JEG_ADMIN_TEMPLATE_PATH . 'metabox/');

function jeg_get_paged_image($render = "") 
{
	global $ajxtpl;
	$page  = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
			
	$statement = array (
			'post_type' 		=> 'attachment',
			'post_mime_type' 	=> 'image',
			'post_status' 		=> 'inherit', 
			'posts_per_page' 	=> 14,
			'paged' 			=> $page 
	);
	$result = new WP_Query($statement);
	
	$data = array();
	$data['images'] 		= $result->posts;
	$data['pages'] 			= $result->max_num_pages;
	$data['totalpost'] 		= $result->found_posts;	
	$data['curpage']	 	= $page;
	
	if($render === "") {
		$ajxtpl->render('helper-image-paging', $data, true);
	} else {
		return $ajxtpl->render('helper-image-paging', $data);
	}
	exit;
}


/*** get font variant **/
function jeg_ajax_font_variant () {
	$fontname = $_REQUEST['font'];
	
	include JEG_UTIL . '/googlefont.php';
	$serialize = $googlefont;
	
	$unserialized = unserialize($serialize);
	$items = $unserialized->items;
	
	foreach($items as $item) {
		if($item->family == $fontname) {		
			jsendResponse($item->variants);
		}
	}
}

define('JEG_PORTFOLIO_TEMPLATE_PATH'	, JEG_ADMIN_TEMPLATE_PATH . 'portfolio/');
$jptemplate = new JTemplate(JEG_PORTFOLIO_TEMPLATE_PATH);

/**
 * portfolio load more
 */
function jeg_portfolio_more ()
{
	
	global $jptemplate;
	global $wp_query;
	
	$id  	= isset($_REQUEST['id']) ? $_REQUEST['id'] : 1;
	$page  	= isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
	$cat 	= $_REQUEST['cat'];
	
	$data = array();
	$data['portoLayout']	 = j_get_meta('portfolio_layout', JEG_DEFAULT_PORTO_LAYOUT, $id);
	$data['portoItemWidth']  = j_get_meta('portfolio_item_width' , 180, $id);
	$data['portoItemHeight'] = j_get_meta('portfolio_item_height', 210, $id);
	$data['portoExclude']	 = j_get_meta('portfolio_exclude', null, $id);
	$data['postid']			 = $id;
	
	if(empty($cat)) {
		$data['portfolioitem'] = query_posts(array(
			'post_type'				=> JEG_PORTFOLIO_POST_TYPE , 
			'posts_per_page'		=> j_get_meta('portfolio_per_page', 10, $id),
			'paged'					=> $page,
			'tax_query'				=> array(
		        array(
		            'taxonomy' 	=>  JEG_PORTFOLIO_CATEGORY,
		            'terms' 	=>  $data['portoExclude'],   
		            'field' 	=> 'id',
		            'operator' 	=> 'NOT IN' 
		        )
		    ),
		    "orderby"				=> "date",
		    "order"					=> "DESC"
		));
	} else {
		$data['portfolioitem'] = query_posts(array(
			'post_type'				=> JEG_PORTFOLIO_POST_TYPE , 
			'posts_per_page'		=> j_get_meta('portfolio_per_page', 10, $id),
			'paged'					=> $page,
			'tax_query'				=> array(
		        array(
		            'taxonomy' 	=>  JEG_PORTFOLIO_CATEGORY,
		            'terms' 	=>  $data['portoExclude'],   
		            'field' 	=> 'id',
		            'operator' 	=> 'NOT IN' 
		        )
		    ),
		    'tax_query'				=> array(
		        array(
		            'taxonomy' 	=>  JEG_PORTFOLIO_CATEGORY,
		            'terms' 	=>  $cat,   
		            'field' 	=> 'id',
		            'operator' 	=> 'IN' 
		        )
		    ),
		    "orderby"				=> "date",
		    "order"					=> "DESC"
		));
	}
	
	$html = $jptemplate->render('portfolio', $data);
	
	jsendResponse(array(
		'pagenext'	=> $page + 1,
		'totalpage'	=> $wp_query->max_num_pages,
		'category'	=> 0,
		'html'		=> $html
	));
	
	echo $html;
	exit;
}

/** 
 * build smtp function 
 **/

add_action('init', 'jeg_email_init');

function jeg_email_init() 
{	
	add_action( 'phpmailer_init'		,'j_phpmailer_init');
		
	if(j_get_option('use_smtp')) {
		add_action( 'phpmailer_init'		,'j_phpmailer_smtp_init');
		add_filter( 'wp_mail_from'			,'j_mail_from');
		add_filter( 'wp_mail_from_name'		,'j_mail_from_name');
	}
}

function j_phpmailer_init($phpmailer) 
{
	$phpmailer->ContentType = 'text/html';
}

function j_phpmailer_smtp_init($phpmailer) 
{
	$phpmailer->IsSMTP();
	$phpmailer->Host =  j_get_option('smtp_host');
	$phpmailer->Port = 	j_get_option('smtp_port');
	$phpmailer->SMTPAuth = true;
	if ( $phpmailer->SMTPAuth ) {
		$phpmailer->Username = j_get_option('smtp_user');
		$phpmailer->Password = j_get_option('smtp_pass');
	}	
	
	$enablesmtpdebug = (bool) j_get_option('enable_smtp_loging');
	$phpmailer->SMTPDebug = $enablesmtpdebug;
	$phpmailer->SMTPSecure = j_get_option('smtp_prefix');
}

function j_mail_from( $from ) {	
	return j_get_option('email_from');
}

function j_mail_from_name( $from_name ) {		
	return wp_specialchars_decode(j_get_option('email_from_name'), ENT_QUOTES);
}

/**
 * send contact
 */ 
function jeg_send_contact() 
{
	if(isset($_REQUEST["name"]) && $_REQUEST["name"] &&
		isset($_REQUEST["email"]) && $_REQUEST["email"] &&
		isset($_REQUEST["message"]) && $_REQUEST["message"]) { 

			$jtemplate = new JTemplate(JEG_ADMIN_TEMPLATE_PATH);
			
			$email_from 			= j_get_option('email_from');
			$email_from_name 		= j_get_option('email_from_name');
			$email_subject 			= j_get_option('email_subject');
			
			$data = array(
				'name'		=> $_REQUEST['name'],
				'email'		=> $_REQUEST['email'],
				'message' 	=> $_REQUEST['message']
			);
			
			$template_data = array(
				'header_logo' 	=> j_get_option('email_logo'),
				'head_color' 	=> j_get_option('email_head_color'),
				'body_color' 	=> j_get_option('email_body_color'),
				'body_text' 	=> j_get_option('email_body_text_color'),
				'footer_text'	=> j_get_option('email_footer_text'),
				'body_text'		=> j_get_option('email_body_text')
			);
			
			$email_subject			= j_build_email_content($email_subject, $data);
			$email_body				= j_build_email_content($jtemplate->render('email-template', $template_data), $data);
			$email_headers 			=  sprintf("From: %s <%s>\r\n", $email_from_name, $email_from);
			$email_headers 		   	.= sprintf("Reply-To: %s\r\n", $data['email']);
			$email_headers 		   	.= sprintf("Return-Path : %s\r\n", $data['email']);
			$email_headers 		   	.= sprintf("CC : %s\r\n", $email_from);
			
			$wpstatus = false;
			$wpstatus = wp_mail ($_REQUEST['email'], $email_subject, $email_body, $email_headers);
			
			if($wpstatus) {
				jsendResponse(array(
					'status'	=> 1					
				));
			} else {
				jsendResponse(array(
					'status'	=> 0			
				));
			}
	} else {
		jsendResponse(array(
			'status'	=> 0			
		));
	}
}

/** js send response **/
function jsendResponse($param) {
	// need to add chunk to prevent error of zlib output (http://core.trac.wordpress.org/ticket/18525)	
	/* remove chunk
	if(is_array($param)) {
		array_push($param, array('chunk'=> str_repeat(chr(0), 4096)));
	}
	*/
	
	echo json_encode($param);
	die();
}

/** resparser **/
function iscurlinstalled() {
	if  ( in_array  ( 'curl', get_loaded_extensions() ) )
		return true;
	else
		return false;
}

function j_get_user_cookie() {
	$cookies = array();
	foreach($_COOKIE as $key=>$value) {		
		$cookies[] = new WP_Http_Cookie(array(
			'name'	=> $key,
			'value'	=> $value
		));
	}
	
	return $cookies;
}

function j_parse_content($content, $url)
{
	include_once JEG_UTIL .  "simplehtmldom/simple_html_dom.php";
	
	$html = new simple_html_dom();
	$html->load($content);
		
	$main = $html->find('#main',0)->innertext;		
	$title = $html->find('title',0)->plaintext;
	
	$langwrapper = "";
	$langwrap = $html->find('.langwrapper', 0);
	if(isset($langwrap)) {	
		$langwrapper = $html->find('.langwrapper', 0)->innertext;	
	}
	
	jsendResponse(array(
		'main'		=> $main,
		'title'		=> $title,
		'url'		=> $url,
		'wraplang'	=> $langwrapper, 		
		'id'		=> 1
	));
}

function jeg_parse_url($reqUrl) 
{
	$host 	= preg_replace('/^www\./i', '', $_SERVER['HTTP_HOST']);
	$src 	= preg_replace('/https?:\/\/(?:www\.)?' . $host . '/i', '', $reqUrl);
	
	// cannot direct access & referer must be our host & must be ajax
	if(!array_key_exists('HTTP_REFERER', $_SERVER) 
		|| (! preg_match('/^https?:\/\/(?:www\.)?' . $host . '(?:$|\/)/i', $_SERVER['HTTP_REFERER'])) 
		|| !jisAjax()){
		return false;
	} else {
		if(preg_match('/^https?:\/\/[^\/]+/i', $src)){
			return false;
		} else {
			return $reqUrl;
		}
	}	
}

function j_find_ip() {
	if(getenv("HTTP_CLIENT_IP"))
		return getenv("HTTP_CLIENT_IP"); 
	else if(getenv("HTTP_X_FORWARDED_FOR"))
		return getenv("HTTP_X_FORWARDED_FOR"); 
	else 
        return getenv("REMOTE_ADDR"); 
} 

add_action('http_request_timeout', 'jeg_set_http_timeout');

function jeg_set_http_timeout() {
	return 5;
}

function jeg_resparser()
{
	$url = $_REQUEST['requri'];
	$referrer = $_REQUEST['cururl'];
	$requestUrl = jeg_parse_url($url);		
	
	$requestUrl = $url;
	
	if($requestUrl === false) {
		// request come from outside server / request get content outside the server
		jsendResponse(array(
			'id'	=> 0,
			'msg'	=> "fail to serve request"
		));
	} else {
		$http = new WP_Http();
		$ip = j_find_ip();
		
		$args = array(
			'cookies'				=> j_get_user_cookie()	,	
			'headers'				=> array("REMOTE_ADDR" => $ip, 
							   			"HTTP_X_FORWARDED_FOR" => $ip),
		); 
		
		$result = $http->request( $requestUrl, $args );
		j_parse_content($result['body'], $requestUrl);
	}
	die;
}

function jeg_get_gallery() {
	global $jptemplate;
	
	if(isset($_REQUEST['id'])){
		$post = get_post($_REQUEST['id']);
		
		if(!empty($post->post_password) && !isset($_REQUEST['password'])) {
			jsendResponse(array("status" => 2));
		} else if(!empty($post->post_password) && ($_REQUEST['password'] != $post->post_password)) {
			jsendResponse(array("status" => 3));
		} else {
			$data = array();
			$data['postid']	= $_REQUEST['id'];
			$data['use_paging']	= j_get_meta('image_paging', 0, $data['postid']);
			
			jsendResponse(array(
				"status"	=> 1,
				"content" 	=> $jptemplate->render('imagegallery', $data)				
			));			
		}
	} else {
		jsendResponse(array("exit" => "Incomplete Parameter"));		
	}
}

/** end of resparser **/
function jeg_get_portfolio_item() {
	global $jptemplate;
	
	if(isset($_REQUEST['id'])){
		$post = get_post($_REQUEST['id']);
		
		if(!$post || $post->post_type != JEG_PORTFOLIO_POST_TYPE) {
			jsendResponse(array("status" => 4));
		} else {
			
			if(!empty($post->post_password) && !isset($_REQUEST['password'])) {
				jsendResponse(array("status" => 2));
			} else if(!empty($post->post_password) && ($_REQUEST['password'] != $post->post_password)) {
				jsendResponse(array("status" => 3));
			} else {
				$data = array(); 
				$html = "";
											
				/** category **/
				$data['catlist'] = array();
				
				/** title & content **/
				$data['title']		= $post->post_title;
				$data['content']	= apply_filters('the_content', $post->post_content);				
				
				/** dimension **/
				$data['width'] 		= $_REQUEST['width'];
				$data['height'] 	= $_REQUEST['height'];
				
				// porfolio type
				$mediatype = j_get_meta('portfolio_media', '', $_REQUEST['id']); 
				$data['socialblock']		= $jptemplate->render('socialblock', array(
					'title' => $data['title'],
					'id' => $_REQUEST['id']
				), false);
				
				$termlist = get_the_terms($_REQUEST['id'], JEG_PORTFOLIO_CATEGORY);	
				if(!empty($termlist)) {
					foreach(get_the_terms($_REQUEST['id'], JEG_PORTFOLIO_CATEGORY) as $category) {						
						$data['category'][] = $category->name;
					}
				}
				
				switch($mediatype) {
					case 'gallery'	:
						// get image gallery from new implementation for image gallery
						$galleries = jeg_get_image_gallery($_REQUEST['id'], 'porto_image_gallery');
						
						if($galleries !== false) {
							$data['gallery'] = $galleries;
						} else {
							
							// pake gallery biasa
							$galleries = get_children(
								array(	'order'				=> 'ASC', 
										'orderby'			=>'menu_order', 
										'post_parent' 		=> $_REQUEST['id'], 
										'post_type' 		=> 'attachment', 
										'post_mime_type' 	=>'image' )
							);
								
							foreach ($galleries as $gallery) {
								$data['gallery'][] = array(
									'file' 		=> $gallery->guid, 
									'desc'		=> get_post_meta($gallery->ID, '_wp_attachment_image_alt', true),
									'title'		=> $gallery->post_title
								);
							}
						}
						
						$data['image_cover']		= j_get_meta('porto_gallery_cover', '', $_REQUEST['id']);
						$data['download_url'] 		= j_get_meta('porto_gallery_download_url', '', $_REQUEST['id']);
						$data['croped_image']		= ((bool)j_get_meta('porto_gallery_crop', false, $_REQUEST['id']));
						$data['image_caption']		= j_get_meta('portfolio_image_caption', 0 ,$_REQUEST['id']);
												
						$data['type']	= 'gallery';
						$html = $jptemplate->render('gallery', $data);
						break;
					case 'youtube' 	:
						$data['image_cover']	= j_get_meta('porto_youtube_cover', '', $_REQUEST['id']);
						$data['youtube']		= j_get_meta('porto_youtube_url', '', $_REQUEST['id']);
						$data['download_url'] 	= j_get_meta('porto_youtube_download_url', '', $_REQUEST['id']); 
						$data['type']		= 'youtube';
						$html = $jptemplate->render('youtube', $data);
						break;
					case 'vimeo' 	:
						$data['image_cover']	= j_get_meta('porto_vimeo_cover', '', $_REQUEST['id']);
						$data['vimeo']			= j_get_meta('porto_vimeo_url', '', $_REQUEST['id']);
						$data['download_url'] 	= j_get_meta('porto_vimeo_download_url', '', $_REQUEST['id']); 
						$data['type']	= 'vimeo';
						$html = $jptemplate->render('vimeo', $data);
						break;
					case 'html-5-video' :
						$data['image_cover']	= j_get_meta('porto_video_cover', '', $_REQUEST['id']);	
						$data['mp4']			= j_get_meta('porto_video_mp4', '', $_REQUEST['id']);
						$data['ogg']			= j_get_meta('porto_video_ogg', '', $_REQUEST['id']);
						$data['webm']			= j_get_meta('porto_video_webm', '', $_REQUEST['id']);
						$data['cover']			= j_get_meta('porto_video_cover', '', $_REQUEST['id']);
						$data['download_url'] 	= j_get_meta('porto_video_download_url', '', $_REQUEST['id']);
						$data['type']	= 'video';
						$html = $jptemplate->render('video', $data);
						break;
					case 'music' 	:
						$data['image_cover']	= j_get_meta('porto_music_cover', '', $_REQUEST['id']);
						$data['audio']			= j_get_meta('porto_music_mp3', '', $_REQUEST['id']);
						$data['audio_ogg']		= j_get_meta('porto_music_ogg', '', $_REQUEST['id']);
						$data['cover']			= j_get_meta('porto_music_cover', '', $_REQUEST['id']); 
						$data['download_url'] 	= j_get_meta('porto_audio_download_url', '', $_REQUEST['id']);
						$data['type']	= 'audio';
						$html = $jptemplate->render('audio', $data);
						break;
				}
				
				jsendResponse(array(
					"status"	=> 1,
					"content" 	=> $html , 
					"title"		=> $data['title'] ,
					"type"		=> $data['type'],
					"love"		=> j_get_like_count($_REQUEST['id']),
					"voted"		=> j_have_voted($_REQUEST['id'])
				));			
			}
		}
	} else {
		jsendResponse(array("exit" => "Incomplete Parameter"));		
	}
}