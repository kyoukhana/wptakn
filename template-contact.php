<?php
/*
Template Name: Contact Page
*/
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}

get_template_part('includes/contact-template'); 

if(!jisAjax()) {
	get_footer();
}