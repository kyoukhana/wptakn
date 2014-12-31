			</div>			
		</div>
  </div>
  <!-- curtain call :p -->
  <div class="curtain">
	<div class="curtainhead"></div>
	<div class="curtainbg"></div>  
	<div class="curtain-loader"></div>	
  </div>
  
  
  <?php 
  $musicplaylist = j_get_option('musicplaylist');
  
  if( !empty($musicplaylist) && jeg_run_music_ie() && !jeg_mobile_device() ) : 
  ?>
  <div class="mpnotif"></div>
  <div id="mplist">
  	<div id="jquery_jplayer" class="jp-jplayer"></div>
	<div id="jp_container" class="jp-audio">
		<div class="musicplaylist">
			<h2><?php j_e('music_playlist_lang'); ?></h2>
			<div class="pwdcls mpcls" alt="Close">
				<div class="icon-remove icon-white">&nbsp;</div>
			</div>
		</div>
		<div class="jp-type-playlist">
			<div class="jp-gui jp-interface">
				<ul class="jp-controls">
					<li><div href="javascript:;" data-tourl="false" class="jp-play" tabindex="1">&nbsp;</div></li>
					<li><div href="javascript:;" data-tourl="false" class="jp-pause" tabindex="1">&nbsp;</div></li>
				</ul>
				
				<div class="jp-current-time"></div>
				
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				
				<div class="jp-duration"></div>
				
				<div href="javascript:;" data-tourl="false" class="jp-mute" tabindex="1" title="mute">&nbsp;</div>
				
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
				<ul class="jp-toggles">
					<li><div href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle">&nbsp;</div></li>
					<li><div href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off">&nbsp;</div></li>
					<li><div href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">&nbsp;</div></li>
					<li><div href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">&nbsp;</div></li>
				</ul>
			</div>
			<div class="jp-playlist">
				<ul>
					<li></li>
				</ul>
			</div>
			<div class="jp-no-solution">
				<span>Update Required</span>
				To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
			</div>
		</div>
	</div>
  </div>



   <script type="text/javascript">




	var mplang = {
		playlistmuted 		: "<?php echo j_e('playlist_muted_lang', 'Music Playlist Muted')?>",
		playlistunmuted 	: "<?php echo j_e('playlist_unmuted_lang', 'Music Playlist Unmuted')?>",
		playliststartplay 	: "<?php echo j_e('playlist_start_play', 'Playlist started')?>",
	};

	var musicplayer = new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer",
		cssSelectorAncestor: "#jp_container"	
	}, <?php echo json_encode($musicplaylist); ?> , {
		swfPath: "js",
		supplied: "mp3, oga",
		wmode: "window",
		loop: true,
		volume: <?php echo j_get_option('music_volume', '2') / 10; ?>,
		ready : function() {
			<?php if(j_get_option('music_autoplay')) : ?>			
			mpnotifbox(mplang.playliststartplay);
			jQuery(this).jPlayer("play");
			<?php endif; ?>
		},
		playlistOptions: {
			enableRemoveControls: false,
			loopOnPrevious: false
		}
	});



  </script>


  
  <?php   
  endif;  
  ?>
  
  <footer>
  	
  	
	<nav class="foot-left">
		<ul>			
			<?php 
				$miscs = j_get_option('misc_icon');
				if(isset($miscs) && !empty($miscs)) : 
					foreach ($miscs as $misc) : 					
			?>



			<li>				
				<a href="<?php echo $misc->url ; ?>">
					<i class="<?php echo $misc->icon; ?>"></i>
					<div class="text-social"><?php echo trim($misc->title); ?></div>
				</a>
			</li>


			
			<?php 
					endforeach;
				endif; 
			?>


            <li>
                <a href="#" id="stopmusic" data-tourl="false" class="stp">
                    <img src="http://dev.takenbymarc.com/wp-content/themes/jphotolio_v453/css/img/bars.gif">
                </a>
            </li>


			
			<?php 			
				function languages_list_footer()
				{
					if(function_exists('icl_get_languages')) 
					{
						echo '<div class="langwrapper">';
				   		$languages = icl_get_languages('skip_missing=0&orderby=code');				    				    				  
					    if(!empty($languages))
					    {
					    	
					        foreach($languages as $l) {				        	
					            echo '<li class="avalang">';
					            	echo '<a href="' . $l['url'] . '" data-tourl="false">';
					            		echo '<i class="langflag"  style="background-image: url(' . $l['country_flag_url'] . ');"></i>';
					            		echo '<div class="text-social">' . $l['native_name'] . '</div>';
					            	echo '</a>';
					            echo '</li>';
					        }					        
					    }
					    echo '</div>';
					}
				}
				languages_list_footer();			
			?>



			
			<?php 
				if(j_get_option('show_music_icon')) :			
					if(!empty($musicplaylist) && jeg_run_music_ie() && !jeg_mobile_device()) :
						 $playlisticon = j_get_option('misc_playlist_icon');
			?>
			<li>				
				<a href="#" class="openplaylist" data-tourl="false">
					<i class="<?php echo $playlisticon[0]->icon; ?>"></i>
					<div class="text-social"><?php echo trim($playlisticon[0]->title); ?></div>
				</a>
			</li>
			<?php 	endif; 
				endif;
			?>

            <li>
                <a href="#" id='stopmusic' data-tourl="false">
                    <i class="misc-drupal"></i>
                    <div class="text-social"></div>
                </a>
            </li>
				
		</ul>
	</nav>
	<nav class="foot-right">
		<ul>
			<?php 
				$socials = j_get_option('social_icon');
				if(isset($socials) && !empty($socials)) : 
					foreach ($socials as $social) :
			?>
			<li>
				<a href="<?php echo $social->url ; ?>" target="_blank">
					<i class="<?php echo $social->icon; ?>"></i>
					<div class="text-social"><?php echo trim($social->title); ?></div>
				</a>
			</li>
			
			<?php 
					endforeach; 
				endif;
			?>
		</ul>
	</nav>
	
	<p class="footercopy">
  		<?php echo j_get_option('footer_copy'); ?>
  	</p>
	
  </footer>

  <!-- JavaScript at the bottom for fast page loading -->
  
  <!-- scripts concatenated and minified via build script --> 
  <!-- end scripts -->
  <?php if(j_get_option('google_analytic')) : ?>  
  
  	<script type="text/javascript">
	var _gaq = _gaq || [];
  		_gaq.push(['_setAccount', '<?php echo j_get_option('google_analytic');?>']);
  		_gaq.push(['_trackPageview']);

  	(function() {
    	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  	})();
	</script>
  
  <?php endif; ?>
  
  <?php if(j_get_option('additional_js')) : ?>
  <script type="text/javascript"> 
  	<?php echo j_get_option('additional_js');?> 
  </script>
  <?php endif; ?>
  
  <?php wp_footer(); ?>
</body>
</html>