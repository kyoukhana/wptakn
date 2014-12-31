<?php
	/**
	 * Single post template
	 * @author Jegbagus
	 */
	global $post;
	global $jdata;	
?>
<div id="post-<?php the_ID(); ?>"  <?php post_class(array('blogentry','containerborder')); ?>>
	<div class="inner-container <?php if(has_post_thumbnail()) { echo "headimg" ; } ?>">
		<div class="blog-img">
			<?php if(has_post_thumbnail()) : ?>		
			<a href="<?php the_permalink(); ?>">				
				<?php $imageHeader = j_get_post_header_image ($post, 'full'); ?>
				<img src="<?php echo jeg_get_image($imageHeader['src'], $jdata->postImageDim); ?>" alt="<?php echo $imageHeader['alt']?>">
			</a>
			<?php endif; ?>
			
			<div class="blogtitle  <?php if(has_post_thumbnail()) { echo "headingwithimage" ; } ?>">
				<?php if(!is_single() && !is_page()) : ?>
				<h2>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>			
				</h2> 
				<?php  else : ?> 
				<h1>				
					<?php the_title(); ?>
				</h1>
				<?php endif; ?> 
			</div>				
		</div>
		
				
		<?php 
		if(isset($jdata->hideMeta) && !$jdata->hideMeta) : ?>
		<div class="portfolio-meta blog-meta">
			<ul>			
				<li class="addby"><i class="icon-user"></i><?php the_author_posts_link(); ?></li>
				<li class="addtime"><i class="icon-time"></i><?php echo get_the_date(); ?></li>
				<?php if(isset($jdata->hideComment) && !$jdata->hideComment) { ?>
				<li class="commentcount"><i class="icon-comment"></i> 
					<a href="<?php the_permalink();?>#comments">
						<?php
							$zerocomment 	= j__( 'zerocomment_lang', '0 Comment');
							$onecomment 	= j__( 'onecomment_lang', '1 Comment');
							$morecomment 	= j__( 'morecomment_lang', '% Comments');
							comments_number($zerocomment, $onecomment, $morecomment); 
						?>
					</a>
				</li>
				<?php } ?>
				<div class="clearboth"></div>
			</ul>
		</div>
		<?php endif; ?>
		
		<div class="blog-container">
			<?php 			
			if(is_single() || is_page() || $jdata->fullblog){
				the_content();
				
				wp_link_pages( array( 'before' => '<div class="page-link">' . 'Pages : ', 'after' => '</div>' ) );
				 
				if(has_category()) {
					$catlink = array();
					foreach(get_the_category() as $category) {
						$catlink[] = '<a href="' . get_category_link($category->term_id) . '" title="' . $category->description . '">' . $category->name . '</a>';
					}
					$catlink = implode(' , ', $catlink);					
					printf(j__("filled_under_lang", 'jegtheme'), $catlink);	
				}
				
			} else {
				$ismore = @strpos( $post->post_content, '<!--more-->');
				
				if($ismore) {
					echo substr(the_content(), 0, $ismore);
				} else {
					the_excerpt();
				}
			}?>
		</div>
		
		<div class="bottom-bar">
			<?php if(!is_single() && !is_page()): ?> 
			<div class="blog-more" style="float: left; margin-right : 10px;">
				<ul>
					<li>
						<a href="<?php the_permalink();?>" data-rel="tooltip" title="<?php j_e("more_detail");?>">
							<i class="misc-preview"></i> 
						</a>						
					</li>
				</ul>
			</div>
			<?php endif; ?>		
			<div class="blog-like">
				<ul>
					<li>
						<a  target="_blank" href="<?php echo jShareToFacebook(get_permalink(), get_the_title()); ?>" data-rel="tooltip" title="<?php j_e("share_on_facebook_lang");?>"><i class="social-facebook"></i></a>
					</li>
					<li>
						<a target="_blank" href="<?php echo jShareToTwitter(get_permalink(), get_the_title()); ?>" data-rel="tooltip" title="<?php j_e("share_on_twitter_lang");?>"><i class="social-twitter"></i></a>
					</li>
					<li>
						<a target="_blank" href="<?php echo jShareGoogle(get_permalink()); ?>" data-rel="tooltip" title="<?php j_e("share_on_google_lang", "Share on Google Plus");?>"><i class="social-gplust"></i></a>
					</li>
				</ul>
				
			</div>
			<?php if(is_single() || $jdata->fullblog): ?> 
			<div class="postag">
				<?php the_tags('',''); ?> 
			</div>
			<?php endif; ?>
			<div class="clearbottombar"></div>
		</div>
		
		<?php 
			if(is_single()){
				add_action('previous_post_link', 'j_prev_post');
				add_action('next_post_link', 'j_next_post');

				function j_prev_post () {
					$post = get_adjacent_post( null, null , true );
					if ( ! $post ) {						
						$output = "<a href='#' class='nolink'></a>";
					} else {
						$title = $post->post_title;
						$title = apply_filters( 'the_title', $title, $post->ID );						
						$rel = $previous ? 'prev' : 'next';
						
						$output = '<a href="' . get_permalink( $post ) . '" rel="'.$rel.'">';
						$output = $output . "<span>" .  j__('prev_pos', 'Previous Post') . "</span>";
						$output = $output . "<strong>" .  $title . "</strong>";
						$output = $output . '</a>';
					}
					return $output;
				}
				
				function j_next_post () {
					$post = get_adjacent_post( null, null , false );
					if ( ! $post ) {						
						$output = "<a href='#' class='nolink'></a>";
					} else {
						$title = $post->post_title;
						$title = apply_filters( 'the_title', $title, $post->ID );						
						$rel = $previous ? 'prev' : 'next';
						
						$output = '<a href="' . get_permalink( $post ) . '" rel="'.$rel.'">';
						$output = $output . "<span>" .  j__('next_pos', 'Next Post') . "</span>";
						$output = $output . "<strong>" .  $title . "</strong>";
						$output = $output . '</a>';
					}
					return $output;
				}
		?>
		<div class="blog-next-prev">
			<div class="blog-next">		
				<?php echo previous_post_link(); ?>
			</div>
			<div class="blog-prev">
				<?php echo next_post_link(); ?>
			</div>
		</div>
		<?php 
			} 
		?>
		
		<?php 		
			// overrided : comments-functions.php
			if(isset($jdata->hideComment) && !$jdata->hideComment) {
				comments_template(); 
			}
		?>
		
	</div>
</div>