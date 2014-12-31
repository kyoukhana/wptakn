<?php
/**
* @author jegbagus
*/
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}

/** ini harus nya get option dari single page itu, bukan dari global option **/
$jdata->blogLayout 			= j_get_meta('single_layout', JEG_DEFAULT_LAYOUT);
$jdata->blogSidebar 		= j_get_meta('single_sidebar', jegGenId(JEG_DEFAULT_SIDEBAR));
$jdata->hideMeta			= j_get_meta('single_hidemeta', false);
$jdata->hideComment			= j_get_meta('single_hidecomment', false);

get_template_part( "includes/page-template" );

if(!jisAjax()) {
	get_footer();
}