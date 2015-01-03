<?php
/** 
 * @author Jegbagus
 */
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}

/** ini harus nya get option dari single page itu, bukan dari global option **/
$jdata->blogLayout 			= j_get_option('blog_layout'	, JEG_DEFAULT_LAYOUT);
$jdata->blogSidebar 		= j_get_option('blog_sidebar'	, jegGenId(JEG_DEFAULT_SIDEBAR));
$jdata->hideMeta			= j_get_option('blog_hidemeta'	, 0);
$jdata->hideComment			= j_get_option('blog_hide_comment'	, 0);

get_template_part( "includes/page-template" );

if(!jisAjax()) {
	get_footer();
}