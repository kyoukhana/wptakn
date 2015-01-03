<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <?php
    $postid = $wp_query->post->ID;
     
    ?>

    <?php if ( $postid===22 ) { ?>
        <meta property="og:title" content="Marc Mikhail Photography"/>
        <meta property="og:description" content="Wedding Photography by Hamilton based Photographer Marc Mikhail.  Because your wedding is better than her's."/>
        <meta property="og:url" content="http://www.takenbymarc.com/"/>
        <meta property="og:image" content="http://www.takenbymarc.com/wp-content/uploads/2014/02/new-logofb1.png"/>
  <?} else { ?>
      <meta property="og:url" content="<?php the_permalink() ?>"/>
        <meta property="og:title" content="<?php single_post_title(''); ?>" />
        <meta property="og:description" content="<?php echo $excerpt; ?>" />
        <meta property="og:type" content="article" />
     <?php } ?>

    <title>
	<?php
	 	if(j_get_option('enable_seo')) {
	 		echo jeg_build_titles();
	 	} else {
	 		wp_title();
	 	}
	?>
	</title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php
		// responsive option 
		if(j_get_option('responsive', 1)) : ?>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" /> 
  	<?php endif; ?>
  	
  	<?php if(j_get_option('apps_capable')) : ?>
  	<meta name="apple-mobile-web-app-capable" content="yes" /> 
 	<?php endif; ?>
 	
 	<?php if(j_get_option('enable_seo')) : ?>
 	
	<meta name="keywords" content="<?php echo j_get_option('seo_keyword');?>"/>
	<meta name="revisit-after" content="1 days" />
 	<?php endif; ?>
 	
 	<!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
 	<?php if(j_get_option('website_favico')) : ?>
 	<link rel="shortcut icon" type="image/x-icon" href="<?php echo j_get_option('website_favico'); ?>" />
 	<?php endif; ?>
 	<?php if(j_get_option('touch_icon')) : ?> 	
 	<link rel="apple-touch-icon-precomposed" href="<?php echo j_get_option('touch_icon'); ?>">
 	<?php endif; ?>   
 	
  	<!-- All JavaScript at the bottom, except this Modernizr build.
       Modernizr enables HTML5 elements & feature detects for optimal performance.
       Create your own custom Modernizr build: www.modernizr.com/download/ --> 
  	<script type="text/javascript">
		var base_url	 = "<?php echo home_url(); ?>",
			template_url = "<?php echo get_template_directory_uri(); ?>",
			template_css = "<?php echo JEG_CSS_URL; ?>",
			lib_url	 	 = "<?php echo JEG_UTIL_URL; ?>",
			admin_url	 = "<?php echo admin_url("admin-ajax.php"); ?>",
			jcurtain	 = "<?php echo j_get_option('curtain', 0); ?>",
			curtainstyle = "<?php echo j_get_option('curtain_effect', 'slide');?>";	
  	</script>  	
  	<?php wp_head(); ?>

    <a link rel='stylesheet' href="<?php echo get_template_directory_uri(); ?>/css/custom.css" media='all' />

</head>
<body <?php body_class(); ?>>

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]--> 
  <header>		
		<nav>
			<div class="navleft">
				<div class="navleft-wrapper">
					<?php echo jeg_menu("topleft"); ?>
				</div>			
			</div>
			<?php if (j_get_option('centered_menu', 1)) : ?>
			<div class="navright">
				<div class="navright-wrapper">
					<?php echo jeg_menu("topright"); ?>
				</div>			
			</div>
			<?php endif; ?>
		</nav>		
		<div class="logo">
			<a href="<?php echo home_url();?>">
				<!-- Logo masuk sini -->
				<img alt="<?php bloginfo('name'); echo " "; bloginfo('description'); ?>" src="<?php echo j_get_option('website_logo');?>" />
			</a>
		</div>
		<div class="navselect">
			<select>
				<option value="#!/"><?php j_e('navigate_lang') ?></option>
				<?php echo jeg_responsive_menu(); ?>
			</select>
		</div>		
  </header>
  
  <div class="notification" data-small-menu="<?php echo j_get_option('small_menu', 0); ?>">
	<div class="notification-wrapper">
		<div class="notification-belt">&nbsp;</div>
		<div class="notification-content"></div>
		<div class="closeme" style="display: block;">
			<div class="icon-remove"></div>
		</div>
	</div>
  </div>
  
  	
  <div role="main" id="wmainouter">
  	<div id="wmain">
  		<div class="main-<?php the_ID(); ?>">
  
  
