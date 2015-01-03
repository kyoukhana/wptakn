<div class="pagemetawrapper" style="display : none;">
	<div class="pagemetatitle">
	<?php 
		if(j_get_option('enable_seo')) {
			echo jeg_build_titles();
		} else {
			wp_title();
		}
	?>
	</div>
	<div class="pagemetalang">
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
	</div>
</div>