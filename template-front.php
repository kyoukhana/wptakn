<?php
/*
Template Name: Front Slider
*/

if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}

$jdata->frontslidetitle			= j_get_meta('frontslider_title');
$jdata->frontslidealt			= j_get_meta('frontslider_alt');

$jdata->frontItem = j_get_front_slider(); 
get_template_part( "includes/front-template" );

if(!jisAjax()) {
	get_footer();
}