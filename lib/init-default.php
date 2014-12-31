<?php

add_action('init','jeg_init_default');

function jeg_is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

function jeg_init_default() {	
	if(!jeg_is_login_page()) {
		
		/** enqueue style **/
		wp_enqueue_style ('jeg-def-style'	, 	get_template_directory_uri() . '/style.css', null, JEG_VERSION);
		wp_enqueue_style ('jeg-bootstrap'	, 	JEG_CSS_URL . 'bootstrap.css', null, JEG_VERSION);
		wp_enqueue_style ('jeg-style'		, 	JEG_CSS_URL . 'style.css', null, JEG_VERSION);
			
		if(j_get_option('responsive', 1)){
			wp_enqueue_style ('jeg-bootstrap-responsive'	, 	JEG_CSS_URL . 'bootstrap-responsive.css', null, JEG_VERSION);
			wp_enqueue_style ('jeg-style-responsive'		, 	JEG_CSS_URL . 'style-responsive.css', null, JEG_VERSION);
		}
		
		wp_enqueue_style ('jeg-plugin'		, 	JEG_CSS_URL . 'plugin.css', null, JEG_VERSION);
		wp_enqueue_style ('jeg-mediaplayer'	, 	JEG_CSS_URL . 'mediaelement/mediaelementplayer.css', null, JEG_VERSION);
		wp_enqueue_style ('jeg-playlist'	, 	JEG_CSS_URL . 'blue.monday/jplayer.blue.monday.css', null, JEG_VERSION);
		
		if(j_get_schema() == 'dark') {
			wp_enqueue_style ('jeg-dark-schema', JEG_CSS_URL . 'dark.css', null, JEG_VERSION);
		}				
				
		wp_enqueue_style ('jeg-additional-style' , 	home_url() . '/index.php?jeg-theme=loadcss', null);
		
		/** enqueue script **/
		wp_enqueue_script('jquery');
	   	wp_enqueue_script('modernizr'		, JEG_JS_URL . 'libs/modernizr-2.5.3.min.js'	, null , JEG_VERSION);
	   	wp_enqueue_script('jeg-plugin'		, JEG_JS_URL . 'plugins.js'						, null , JEG_VERSION);
	   	wp_enqueue_script('jeg-script'		, JEG_JS_URL . 'script.full.js'					, null , JEG_VERSION);
	   	wp_enqueue_script('jeg-youtube_api'	, 'http://www.youtube.com/player_api');
	   	
	   	/** @todo unenque this script if we are not using contact **/
	   	$usemap = j_get_option('use_contact_map', 1);	   	
	   	if($usemap == 1) {
	   		wp_enqueue_script('jeg-google-map'	, 'http://maps.google.com/maps/api/js?sensor=false');
	   	}
	   	
	   	$shareoption = j_get_option('social_sharer');	   
	   	if($shareoption == 1){
		   	wp_enqueue_script('facebook'		, 'http://connect.facebook.net/en_US/all.js#xfbml=1'); 
		   	wp_enqueue_script('tweet-button'	, 'http://platform.twitter.com/widgets.js');
		   	wp_enqueue_script('google-botton'	, 'https://apis.google.com/js/plusone.js');
	   	}
	   	
	  	if ( is_singular() && get_option( 'thread_comments' ) ) {
	  		wp_enqueue_script( 'comment-reply' );
	  	}
	}
}