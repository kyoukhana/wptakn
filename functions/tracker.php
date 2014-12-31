<?php

add_action('wp_footer', 'j_track_hit');


function j_is_bot($user_agent)
{
	if(empty($ua)) {
		return true;
	}	
	
	$bots = Array(
			"google", 
			"bot", 
			"yahoo", 
			"spider", 
			"archiver", 
			"curl", 
			"python", 
			"nambu", 
			"twitt", 
			"perl",
			"sphere", 
			"PEAR", 
			"java", 
			"wordpress", 
			"radian", 
			"crawl", 
			"yandex", 
			"eventbox", 
			"monitor", 
			"mechanize", 			
			"InternetSeer"
			);

	foreach($bots as $bot)
	{
		if(strpos($ua , $bot) !== false)
		{
			return true;
		}
	}

	return false;
}

function j_getBrowser()
{
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version= "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	}
	elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	}
	elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}

	// Next get the name of the useragent yes seperately and for good reason
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
	{
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	}
	elseif(preg_match('/Firefox/i',$u_agent))
	{
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	}
	elseif(preg_match('/Chrome/i',$u_agent))
	{
		$bname = 'Google Chrome';
		$ub = "Chrome";
	}
	elseif(preg_match('/Safari/i',$u_agent))
	{
		$bname = 'Apple Safari';
		$ub = "Safari";
	}
	elseif(preg_match('/Opera/i',$u_agent))
	{
		$bname = 'Opera';
		$ub = "Opera";
	}
	elseif(preg_match('/Netscape/i',$u_agent))
	{
		$bname = 'Netscape';
		$ub = "Netscape";
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
			$version= $matches['version'][0];
		}
		else {
			$version= $matches['version'][1];
		}
	}
	else {
		$version= $matches['version'][0];
	}

	// check if we have a number
	if ($version==null || $version=="") {$version="?";}
		
	return array(
        'userAgent' 	=> $u_agent,
        'name'      	=> $bname,
        'version'   	=> $version,
        'platform'  	=> $platform,
        'pattern'    	=> $pattern
	);
}

function j_search_engine_query_string($url = false) {

	if(!$url && !$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false) {
		return '';
	}

	$parts_url = parse_url($url);
	$query = isset($parts_url['query']) ? $parts_url['query'] : (isset($parts_url['fragment']) ? $parts_url['fragment'] : '');
	if(!$query) {
		return '';
	}
	parse_str($query, $parts_query);
	return isset($parts_query['q']) ? $parts_query['q'] : (isset($parts_query['p']) ? $parts_query['p'] : '');
}

function j_track_hit() 
{		
	if(j_get_option('track_hit') == 1)
	{
		
		if( j_is_bot($_SERVER['HTTP_USER_AGENT']) &&  !j_get_option('track_bot')) {
			return;
		} 
		
		global $wpdb;
		$themetable = $wpdb->prefix . JEG_SHORTNAME . '_tracker';
		
		$ip 			= $_SERVER['REMOTE_ADDR'];
		$access 		= jegGetCurrentUrl();
		$referrer 		= mysql_escape_string($_SERVER['HTTP_REFERER']);

		$browser 		= j_getBrowser();
		$useragent 		= "{$browser['name']} {$browser['version']}";
		$platform 		= $browser['platform'];
		$searchkeyword	= mysql_escape_string(j_search_engine_query_string($_SERVER['HTTP_REFERER']));

		$query = "INSERT INTO $themetable SET ";
		$query .= "ip = '" . $ip . "', ";
		$query .= "access = '" . $access . "', ";
		$query .= "time = NOW(), ";
		$query .= "referrer = '$referrer' , ";
		$query .= "useragent = '$useragent' , ";
		$query .= "platform = '$platform' , ";
		$query .= "searchkeyword = '$searchkeyword' ";
	
		$wpdb->query($query);
	}
}