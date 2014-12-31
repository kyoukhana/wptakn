<?php

add_action( 'after_setup_theme', 'jegtheme_setup' );

function jeg_setup_setting() 
{
	// setup all setting
	$allsetting = jeg_admin_panel::getInstance()->get_all_setting();
	
	foreach($allsetting as $setting) {
		 if(!empty($setting['item'])) {
			foreach($setting['item'] as $items) {
				foreach($items as $item) {
					if($item['type'] != 'heading' || $item['type'] != 'try_email' || $item['type'] != 'arrange_slider') {
						if($item['value'] ) j_update_option($item['id'], $item['value']);
					}
				}
			}
		 }
	}
	
	// setup theme
	$basetheme = new stdClass();
	$basetheme->title = 'default';
	$basetheme->schema = 'light';
	j_update_option('thememanager', array($basetheme));
	
	// setup font	
	j_update_option('heading_font', 		array('name' => 'PT Sans Narrow','variant' => '700', 'face' => '', 'facefont' => array('','','','')));
	j_update_option('heading_alt_font', 	array('name' => 'Overlock','variant' => 'italic', 'face' => '', 'facefont' => array('','','','')));
	j_update_option('body_font', 			array('name' => 'PT Sans Narrow','variant' => 'regular', 'face' => '', 'facefont' => array('','','','')));
	j_update_option('front_slider_font', 	array('name' => 'PT Sans Narrow','variant' => '700', 'face' => '', 'facefont' => array('','','','')));
	 
	// redirect request 
	header( 'Location: '.admin_url().'admin.php?page='.JEG_OPTION_PAGE.'&activated=true' ) ;	
}

function j_themes_option_name ($tmarr, $key)
{
	$option = '';	
	if(empty($tmarr)) {
		$option = $key;
	} else {
		if($tmarr->title == 'default') {
			$option = $key;
		} else {
			$option = $key . '_' . $tmarr->title;			
		}
	}
	
	return $option;
}

function j_get_themes_option($tmarr, $key) {
	$option = j_themes_option_name($tmarr, $key);
	return j_get_option($option);
}

function update_font_to4500 () {
	// update heading font 
	$tmarr = j_get_option('thememanager', '');
	
	foreach($tmarr as $tm) {
		$headingfont = array(
			'name' 		=> j_get_themes_option($tm, 'heading_font'),
			'variant' 	=> j_get_themes_option($tm, 'heading_font_variant'),
			'face' 		=> j_get_themes_option($tm, 'heading_font_face'),
			'facefont' 	=> array(j_get_themes_option($tm, 'heading_font_facefile'), '', '', '')
		);
		j_update_option(j_themes_option_name($tm, 'heading_font'), $headingfont);
		
		$headingalt = array(
			'name' 		=> j_get_themes_option($tm, 'heading_alt_font'),
			'variant' 	=> j_get_themes_option($tm, 'heading_alt_font_variant'),
			'face' 		=> j_get_themes_option($tm, 'heading_alt_font_face'),
			'facefont' 	=> array(j_get_themes_option($tm, 'heading_alt_font_facefile'), '', '', '')
		);
		j_update_option(j_themes_option_name($tm, 'heading_alt_font'), $headingfont);
		
		$bodyfont = array(
			'name' 		=> j_get_themes_option($tm, 'body_font'),
			'variant' 	=> j_get_themes_option($tm, 'body_font_variant'),
			'face' 		=> j_get_themes_option($tm, 'body_font_face'),
			'facefont' 	=> array(j_get_themes_option($tm, 'body_font_facefile'), '', '', '')
		);
		j_update_option(j_themes_option_name($tm, 'body_font'), $headingfont);
		
		$frontsliderfont = array(
			'name' 		=> j_get_themes_option($tm, 'front_slider_font'),
			'variant' 	=> j_get_themes_option($tm, 'front_slider_font_variant'),
			'face' 		=> j_get_themes_option($tm, 'body_font_face'),
			'facefont' 	=> array(j_get_themes_option($tm, 'body_font_facefile'), '', '', '')
		);
		j_update_option(j_themes_option_name($tm, 'front_slider_font'), $headingfont);
	}
	
}

function jegtheme_setup() 
{
	$themestatus 	= j_get_option( 'setup_status' );	
	if($themestatus !== '1') {
		global $wpdb;
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		// post like
		$themetable = $wpdb->prefix . JEG_SHORTNAME . '_post_like';
				
		if($wpdb->get_var("show tables like '$themetable'") != $themetable) {
			$sql = "CREATE TABLE " . $themetable . " (
				`id` bigint(11) NOT NULL AUTO_INCREMENT,
				`post_id` int(11) NOT NULL,
				`date_time` datetime NOT NULL,
				`ip` varchar(20) NOT NULL,
				`cookie` varchar(25) NOT NULL,
				PRIMARY KEY (`id`)
			)";
		}
		
		dbDelta($sql);
		
		j_update_option( 'setup_status', '1' );
		j_update_option( 'version' , JEG_VERSION );
		
		// upgrading themes option 
		j_update_option( 'upgrade_thememanager' , 1 );
		j_update_option( 'updateto4500' , 1 );		
		
		/** add default option value here **/
		jeg_setup_setting();		
	} else {
		$upgrademanager 	= j_get_option( 'upgrade_thememanager' );	
		if($upgrademanager !== '1') {
			j_convert_schema_value();	
			j_update_option( 'upgrade_thememanager' , 1 );
		}
		
		$updateto4500 = j_get_option( 'updateto4500' );
		if($updateto4500 !== '1') {
			update_font_to4500();
			j_update_option( 'updateto4500' , 1 );
		}
	}
}