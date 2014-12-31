<?php
/** 
 * this is last file that will execute if none of any file match with page defined
 * primary usage is for blog page
 * 
 * @author Jegbagus
 */
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}


$jdata->blogLayout 			= j_get_option('blog_layout'	, JEG_DEFAULT_LAYOUT);
$jdata->blogSidebar 		= j_get_option('blog_sidebar'	, jegGenId(JEG_DEFAULT_SIDEBAR));
$jdata->hideMeta			= j_get_option('blog_hidemeta'	, 0);
$jdata->excludeCategory		= j_get_option('blog_exclude'	);
$jdata->hideComment			= j_get_option('blog_hide_comment'	, 0);

query_posts(array(
	'category__not_in' 	=> $jdata->excludeCategory,
	'paged' 			=> get_query_var('paged')
));

get_template_part( "includes/page-template" );

if(!jisAjax()) {
	get_footer();
}