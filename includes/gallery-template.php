<div class="lioseparator"></div>
<div id="jeggal">
<!-- Disini masukin data nya -->
</div>
<div class="lio-loader"></div>
<script type="text/javascript" src="<?php echo JEG_JS_URL . 'jeggal.full.js';?>"></script>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		/** bind jeg default **/
		$(window).jegdefault({
			curtain 	: <?php echo j_get_option('curtain', 0);?>,
			rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
			clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>" 
		});
				
		$("#jeggal").jeggal({
			loadAnimation	: "<?php echo j_get_meta('gallery_item_transition', 'sequpfade'); ?>",	
			postid			: "<?php echo get_the_ID(); ?>",
			zoomDelay		:  <?php echo j_get_option('zoom_slide_speed', '7000'); ?>,
			use_pagging		:  <?php echo j_get_meta('image_paging', 0); ?>,
			pagging_count	:  <?php echo j_get_meta('image_per_page', 10); ?>,
			loading_text	: "<?php j_e('image_gallery_loading', 'Loading More Image'); ?>",
			lang			: {
				portfoliotitle						: "<?php j_e("protected_portfolio_lang") ?>",
				passwordplaceholder  				: "<?php j_e("password_placeholder_lang") ?>",
				submit 								: "<?php j_e("portfolio_submit_lang") ?>"
			}
		});
	});
</script>
