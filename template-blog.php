<?php
/** 
Template Name: Blog Page
 */
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}

$jdata->blogLayout 			= j_get_option('blog_layout'	, JEG_DEFAULT_LAYOUT);
$jdata->blogSidebar 		= j_get_option('blog_sidebar'	, jegGenId(JEG_DEFAULT_SIDEBAR));
$jdata->hideMeta			= j_get_option('blog_hidemeta'	, 0);
$jdata->hideComment			= j_get_option('blog_hide_comment'	, 0);
$jdata->excludeCategory		= j_get_option('blog_exclude'	);

query_posts(array(
	'category__not_in' 	=> $jdata->excludeCategory,
	'paged' 			=> get_query_var('paged'),
	"orderby"				=> "date",
	"order"					=> "DESC"
));

get_template_part( "includes/page-template" );

if(!jisAjax()) {
	get_footer();
}