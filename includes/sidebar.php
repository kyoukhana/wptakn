<?php 
	/**
	 * @author Jegbagus
	 */	
	global $jdata;
	add_filter('widget_text', 'do_shortcode');
?>

<?php if(Jeg_Sidebar::get_sidebar($jdata->blogLayout) != Jeg_Sidebar::$_FULLWIDTH) : ?>
<div class="span4 sidebar">
	<?php  if(function_exists('dynamic_sidebar')) { dynamic_sidebar($jdata->blogSidebar ); } ?>
</div>
<?php endif; ?>