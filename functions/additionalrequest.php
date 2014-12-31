<?php

add_action('parse_request', 'jeg_parse_request');
add_filter('query_vars', 'jeg_query_vars');

function jeg_query_vars($vars) {
    $vars[] = 'jeg-theme';
    $vars[] = 'email-template';
    $vars[] = 'portfolio-sequence';
    return $vars;
}

function jeg_parse_request($wp) {
	if (array_key_exists('jeg-theme', $wp->query_vars) && $wp->query_vars['jeg-theme'] == 'loadcss') {				
		jeg_style_template(j_get_schema());
	} else if (array_key_exists('email-template', $wp->query_vars)) {		
		jeg_email_template();
	} else if (array_key_exists('portfolio-sequence', $wp->query_vars)) {
		jeg_change_sequence();		
	}
}


function jeg_change_sequence () 
{
	$id  	= $_REQUEST['id'];
	$dir  	= $_REQUEST['dir'];
	$target = 0;
	
	$jportfolioseq = new WP_Query(array(
		"post_type"				=> JEG_PORTFOLIO_POST_TYPE , 
		"nopaging"				=> true,
	    "orderby"				=> "date",
	    "order"					=> "DESC"
	));
	
	$result = $jportfolioseq->posts;
	$totalresult = sizeof($result);
	
	for($i = 0; $i < $totalresult; $i++) {
		if($result[$i]->ID == $id) {			
			break;
		}
	}
		
	if($dir == "up") {
		$target = $result[$i - 1]->ID;
		jeg_swap_date($result[$i], $result[$i - 1]);
	} else {
		$target = $result[$i + 1]->ID;
		jeg_swap_date($result[$i], $result[$i + 1]);
	}
		
	// redirect back to referer
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	die;
}

function jeg_swap_date($id, $target) {
	
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$posttable = $wpdb->prefix . 'posts';
	
	$sql = "UPDATE $posttable SET post_date = '" . $target->post_date . "' WHERE ID = " . $id->ID;
	dbDelta($sql);
	
	$sql = "UPDATE $posttable SET post_date = '" . $id->post_date . "' WHERE ID = " . $target->ID;
	dbDelta($sql);	
}