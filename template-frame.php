<?php
/** 
Template Name: Frame template
 */
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}
get_template_part( "includes/frame-template" );

if(!jisAjax()) {
	get_footer();
}