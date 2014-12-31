<?php
/*
Template Name: Image Gallery
*/
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}
get_template_part( "includes/gallery-template" );

if(!jisAjax()) {
	get_footer();
}