<?php 
	
	global $post;
	
	$res = array();
	$locs = j_get_option('mapdata');
	if(!empty($locs)) :
		foreach ($locs as $i => $l) :		
			$res[$i] = array(
				"x"			=> $l->x,
				"y"			=> $l->y,
				"title"		=> $l->title,
				"address"	=> array($l->firstlane, $l->secondlane),
				"phone"		=> explode(",",$l->phone)
			);
		endforeach;	
	endif;
	
	$usemap = j_get_option('use_contact_map', 1);
?>

<div id="contact_block">
	<div id="contact_canvas"></div>
	<div class="contact_helper">
		<div class="btn-group">
			<button class="btn contactotop"><i class="icon-chevron-up"></i></button>
			<button class="btn contacttobottom"><i class="icon-chevron-down"></i></button>
			<button class="btn cntactocenter"><i class="icon-screenshot"></i></button>
		</div>
	</div>
	<div class="contact_form">
		<div class="contact_form_inner">
			<h1><?php j_e('contact_us_lang'); ?></h1>
			<div class="contact_content">
				<div class="contact_left">	
					<h2><?php j_e('contact_detail_lang'); ?></h2>	
					<div class="contact_note">
                        <img class="aligncenter size-medium wp-image-1026" alt="DSC08952_mini" src="http://www.takenbymarc.com/wp-content/uploads/2014/01/DSC08952_mini-300x200.jpg" width="300" height="200" />
					</div>
					<ul>
						<li>
							<i class="icon-envelope"></i>
							<div class="loc-content">
								<div><?php echo j_get_option('email_from'); ?></div>
							</div>
						</li>
						<?php if($usemap) : ?>
						<li class="view-map">
							<i class="icon-map-marker"></i>
							<div class="loc-content">
								<div><?php j_e('click_view_map'); ?></div>
							</div>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="contact_right contact-wrapper">
					<h2><?php j_e('contact_form_lang'); ?></h2>
					<form id="contactform">
						<div class="input-wrapper">
							<label for="contact_name"><?php j_e('contact_lang', 'Name')?> : <span class="contact_error"></span> </label>
							<input id="contact_name" class="textfield" type="text" value="" name="contact_name">
						</div>
						<div class="input-wrapper">
							<label for="contact_email"><?php j_e('contact_email', 'Your email')?> : <span class="contact_error"></span> </label>
							<input id="contact_email" class="textfield" type="text" value="" name="contact_email">
						</div>
						<div class="input-wrapper">
							<label for="contact_message"><?php j_e('contact_message');?> : <span class="contact_error"></span> </label>
							<textarea id="contact_message" class="required" name="contact_message"></textarea>
						</div>
						<div class="input-wrapper contact_button">
							<button class="btn btn-inverse"><i class="icon-white icon-ok"></i> <?php j_e('contact_send') ?></button>
							<div class="contact_loader">&nbsp;</div>
						</div>
					</form>
				</div>
			</div>
			<?php if($usemap) { ?>
			<div class="icon-white icon-chevron-right hideform">hidethis</div>
			<?php } ?>
		</div>
		<div class="contactflag">
			<div class="contactflagwrapper">
				<div class="misc-mail"></div>
			</div>
		</div>
	</div>

	<?php if($usemap) { ?>
	<div class="contact_location">
		<div class="contact_location_inner">
			<h1><?php j_e('contact_location_lang'); ?></h1>
			<div class="icon-white icon-chevron-left hidelocation">hidethis</div>
			<div class="locationlist">
				<?php foreach($res as $index => $loc) : ?>
				<div data-alt="<?php j_e('getdirection_lang', 'Click to get direction'); ?>" class="locdetail" data-x="<?php echo $loc['x']?>" data-y="<?php echo $loc['y']?>" data-index="<?php echo $index; ?>">
					<h2><?php echo $loc['title'] ?></h2>
					<ul>
						<?php if(isset($loc['address'])) : ?>
						<li>
							<i class="icon-map-marker icon-standard"></i>
							<div class="loc-content">
								<?php foreach($loc['address'] as $address) : ?>
								<div><?php echo $address?></div>
								<?php endforeach; ?>
							</div>
						</li>
						<?php endif; ?>

						<?php if(!empty($loc['phone'][0])) : ?>
						<li>
							<i class="phone-icon"></i>
							<div class="loc-content">
								<?php foreach($loc['phone'] as $phone) : ?>
								<div><?php echo $phone; ?></div>
								<?php endforeach; ?>
							</div>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endforeach;?>
			</div>
		</div>
		<div class="locationflag">
			<div class="locationflagwrapper">
				<div class="misc-safari"></div>
			</div>
		</div>
	</div>
	<?php } ?>

	<div id="jeg-loader"></div>
</div>

<?php if(!$usemap) : ?>
<style>
#contact_canvas {
	background-attachment: fixed;
	background-clip: border-box;
	background-color: transparent;
	background-origin: padding-box;

	background-repeat : no-repeat;
	background-attachment : fixed;
	background-position: center center;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;

	background-image: url("<?php echo j_get_option('contact_picture_background'); ?>");
}

@media only screen and (max-width:767px) {
	#contact_block #contact_canvas {
		display: none;
	}
}
</style>
<?php endif; ?>

<!-- responsive item -->
<script type="text/javascript" src="<?php echo JEG_JS_URL . 'jegcontact.js';?>"></script>
<script type="text/javascript">
jQuery(document).ready(function($)
{
	function resize_window(selector)
	{
		$(window).resize(function(){
			var wh = $(window).height();

			var hh = $("header").height();
			var fh = $("footer").height();
			
			ch = wh - hh - fh + 5;
			$(selector).height(ch);	
		});

		$(window).resize();
	}
	
	resize_window("#contact_canvas");

	/** bind jeg default **/
	$(window).jegdefault({
		curtain : <?php echo j_get_option('curtain', 0);?>,
		rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
		clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>" 
	});

	var jegcontact = $("#contact_block").jegcontact({
		location			: <?php echo json_encode($res)?>,
		zoomfactor			: <?php echo j_get_option('zoomfactor', 10);?>,
		cantgetdirection 	: "<?php j_e('cantgetdirection_lang'); ?>",
		dummyposition		: "<?php j_e('dummyposition_lang'); ?>",
		geonotsupport		: "<?php j_e('geonotsupport_lang'); ?>",
		entername			: "<?php j_e('entername_lang'); ?>",
		nameminlength		: "<?php j_e('nameminlength_lang'); ?>",
		enteremail			: "<?php j_e('enteremail_lang'); ?>",
		validemail			: "<?php j_e('validemail_lang'); ?>",
		entermessage		: "<?php j_e('entermessage_lang'); ?>",
		messageminlength	: "<?php j_e('messageminlength_lang'); ?>",
		sendmessage			: "<?php j_e('sendmessage_lang'); ?>",
		messagesent			: "<?php j_e('messagesent_lang'); ?>",
		failsentmessage		: "<?php j_e('failsentmessage'); ?>",
		showmapfirst		: "<?php echo j_get_option("show_contact_map", 0); ?>",
		usemap				: "<?php echo $usemap ?>"
	});
	
	/* remove binding element */
	$("#main").bind('remove', function(ev){
		if (ev.target === this) {
			
		}
	});
});
</script>
