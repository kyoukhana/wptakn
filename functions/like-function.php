<?php

add_action('init', 'j_set_like_cookie');
define('JEG_COOKIE_NAME', 'wp-jeg-setting');

add_action('wp_ajax_vote_post'			, 'j_ajax_vote_post');
add_action('wp_ajax_nopriv_vote_post'	, 'j_ajax_vote_post');

add_action('wp_ajax_total_vote'				, 'j_ajax_total_vote');
add_action('wp_ajax_nopriv_total_vote'		, 'j_ajax_total_vote');

function j_set_like_cookie() {
	if(!isset($_COOKIE[JEG_COOKIE_NAME])) {
		$cookieTimeout = j_get_option("cookie_timeout", time() + 24 * 60 * 60 * 30);
		setcookie(JEG_COOKIE_NAME, uniqid(), $cookieTimeout, '/');
	}
}

function j_get_like_count($postid) {
	global $wpdb;
	$themetable = $wpdb->prefix . JEG_SHORTNAME . '_post_like';
	
	$count = j_get_meta('post_initial_like', 0, $postid) + $wpdb->get_var("SELECT COUNT(id) FROM $themetable WHERE post_id = '$postid'");	
	return $count;
}

function j_ajax_total_vote () {
	$total = j_get_like_count($_REQUEST['postid']);
	jsendResponse(array(
		total	=> $total
	));
}

function j_have_voted ($postid) {
	global $wpdb;
	$ip 	= $_SERVER['REMOTE_ADDR'];
	if(isset($_COOKIE[JEG_COOKIE_NAME])) {
		if(function_exists('wpsql_real_escape_string')) {
			$cookie = wpsql_real_escape_string($_COOKIE[JEG_COOKIE_NAME]);
		} else {
			$cookie = mysql_real_escape_string($_COOKIE[JEG_COOKIE_NAME]);
		}		
	} else {
		$cookie = '';
	}
	$themetable = $wpdb->prefix . JEG_SHORTNAME . '_post_like';
	
	if(!empty($ip) && !empty($cookie)) {
		$vote = $wpdb->get_var("SELECT COUNT(id) FROM $themetable WHERE post_id = '$postid'" .  
			" AND ip = '$ip'" .
			" AND cookie = '$cookie'");
		if($vote == 0) {
			return false;
		} else {
			return true;
		}
	} else {
		return NULL;
	}
}

function j_add_vote($postid) {
	global $wpdb;
	$ip 	= $_SERVER['REMOTE_ADDR'];
	$cookie = mysql_escape_string($_COOKIE[JEG_COOKIE_NAME]);
	$themetable = $wpdb->prefix . JEG_SHORTNAME . '_post_like';
	
	if(!empty($ip) && !empty($cookie) && !empty($postid)) {
		
		if(j_have_voted($postid) === false) {
			$query = "INSERT INTO $themetable SET ";
				$query .= "post_id = '" . $postid . "', ";
				$query .= "date_time = '" . date('Y-m-d H:i:s') . "', ";
				$query .= "ip = '$ip', ";
				$query .= "cookie = '$cookie' ";
			
			$success = $wpdb->query($query);
			if($success) {
				return 3;
			} else {
				return 2;
			}
		} else {
			return 1;
		}
		
	} else {
		return 0;
	}	
}

function j_ajax_vote_post() {
	$result = j_add_vote($_REQUEST['postid']);
	switch ($result) {
		case 0 : 
			jsendResponse(array(
				'id' 		=> 0,
				'msg'		=> j__('parameter_not_complete_lang')
			));
			break;
		case 1 : 
			jsendResponse(array(
				'id' 		=> 1,
				'msg'		=> j__('have_voted_lang')
			));
			break;
		case 2 : 
			jsendResponse(array(
				'id' 		=> 2,
				'msg'		=> j__('db_error_lang')
			));
			break;
		case 3 : 
			jsendResponse(array(
				'id' 		=> 3,
				'msg'		=> j__('thanks_vote_lang'),
				'total'		=> j_get_like_count($_REQUEST['postid'])
			));
			break;
		default : 
			break;
	}
}