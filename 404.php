<?php
/**
 * @author Jegbagus
 */
if(!jisAjax()) {
	get_header();
} else {
	get_template_part('includes/page-common');
}
?>

<div class="container">
	<div class="leftcontent blog-full-width">
		<div class="blogentry containerborder">
			<div class="inner-container notfound">
				
					<div class="notfoundfirst">
						404
					</div>
					<div class="notfoundsec">
						<div style="font-size: 25px; padding: 24px 0; text-align: center; ">
							<?php j_e('404_lang');?>
						</div>
						<div style="text-align: center;">
						<?php locate_template( array( 'searchform.php'), true, true ); ?>
						</div>
					</div>
				
			</div>
		</div>
	</div>	
</div>
<script type="text/javascript">
jQuery(document).ready(function($)
{
	$(window).jegdefault({
		curtain : <?php echo j_get_option('curtain', 0);?>,
		rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
		clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>"
	});
});
</script>
<?php
if(!jisAjax()) {
	get_footer();
}
?>

