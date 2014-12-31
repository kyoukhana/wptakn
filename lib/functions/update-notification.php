<?php
/**
 * Theme update notification
 * @author Jegbagus
 */

define('JEG_NOTIF_URL', 'http://jegtheme.com/client/update/jlio');
define('JEG_NOTIF_CACHE', 43200); // notification interval = 12 hour

// check if new template available
add_action('admin_menu'		,'jeg_theme_check');
add_action('admin_bar_menu'	,'jeg_theme_update_notification_bar', 1000);

function jeg_theme_check() {
	if(jeg_check_new_version()) {
		// $page_title, $menu_title, $capability, $menu_slug, $function = '' 
		add_dashboard_page( JEG_THEMENAME . ' Theme Updates',	 
			JEG_THEMENAME . ' <span class="update-plugins count-1"><span class="update-count">New Updates</span></span>',   
			'administrator',  
			'jeg-update-notifier',  
			'jeg_update_notifier'); 
	}
}

function jeg_theme_update_notification_bar () {
	global $wp_admin_bar, $wpdb;
	
	// only admin can update template 
	if ( !is_super_admin() || !is_admin_bar_showing() )  { 
		return;
	} else {		
		if(jeg_is_new_version()) {
			$wp_admin_bar->add_menu( array( 'id' => 'jeg_update_notifier', 'title' => '<span>' . JEG_THEMENAME . ' <span id="ab-updates">New Updates</span></span>', 'href' => get_admin_url() . 'index.php?page=jeg-update-notifier' ));
		}
	}
}

function jeg_update_notifier () {
	$jtemplate = new JTemplate(JEG_ADMIN_TEMPLATE_PATH);
	$jtemplate->render('update-theme', array(
			'data'=>j_get_option('theme_cache_content')
	), true);
}


function jeg_parse_ver ($version) {
	$ver = explode('.', $version);	
	$vercount = $ver[0] * 1000 + $ver[1] * 100 + $ver[2] * 10;
	return $vercount;
}

function jeg_check_new_version() {
	$updatedata 	= j_get_option('theme_cache_content', '');		// this will be serialized array of json
	$lastupdate 	= j_get_option('theme_cache_last_update', 0);	// theme last check
	
	if( ( time() - $lastupdate ) > JEG_NOTIF_CACHE ) {
		$updatedata = jeg_fetch_new_data();
		// save fetched content & cache last update	
		j_update_option('theme_cache_content', $updatedata);
		j_update_option('theme_cache_last_update', time());
	}
	
	return jeg_is_new_version();
}

function jeg_is_new_version () {
	$updatedata 	= j_get_option('theme_cache_content', '');
	$curversion 	= JEG_VERSION;
	
	if($updatedata == '') {
		return false;
	} else {
		if(jeg_parse_ver($curversion) < jeg_parse_ver($updatedata->version)) {
			return true;
		} else {
			return false;
		}
	}
}


function jeg_fetch_new_data () {	
	$res 	= wp_remote_get( JEG_NOTIF_URL );		// notification url
	$data	= wp_remote_retrieve_body($res);		// result will be json file format
	
	$jsondata = json_decode($data);	
	return $jsondata;
}
