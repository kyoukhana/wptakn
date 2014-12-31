<?php	
	the_post();
	$postImageDim 		= "post-feature-image-wide";
?>

<style type="text/css">
	.sitemaprow {
		width: 100%;
	}
 	.sitemaprow .span3 {
 		width: 205px;
 	}
</style>

<div class="container">
	<div class="blog-full-width">
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
				
				<div class="blog-container">
					<?php
						the_content();
					?>
					<div class="row sitemaprow">
						<div class="span3 sitemapcat">
							<h3> <?php j_e('sitemap_portfolio', 'Portfolio'); ?> </h3>
							<hr class="hr-margin">
							<ul class="list-chevron">
								<?php 
									$statement = new WP_Query(array(
										'post_type'				=> JEG_PORTFOLIO_POST_TYPE , 
										'nopaging'				=> true,
									    "orderby"				=> "date",
									    "order"					=> "DESC"
									));
									$result = $statement->posts;
									
									foreach($result as $res) : 
								?>								
								<li><a href="<?php echo get_permalink($res->ID)?>"><?php echo $res->post_title?></a></li>								
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="span3 sitemapcat">
							<h3> <?php j_e('sitemap_frontslider', 'Front Slider'); ?> </h3>
							<hr class="hr-margin">
							<ul class="list-chevron">
								<?php 
									$statement = new WP_Query(array(
										'post_type'				=> JEG_FRONT_POST_TYPE , 
										'nopaging'				=> true,
									    "orderby"				=> "date",
									    "order"					=> "DESC"
									));
									$result = $statement->posts;
									
									foreach($result as $res) : 
								?>								
								<li><a href="<?php echo get_permalink($res->ID)?>"><?php echo $res->post_title?></a></li>								
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="span3 sitemapcat">
							<h3> <?php j_e('sitemap_page', 'Page'); ?> </h3>
							<hr class="hr-margin">
							<ul class="list-chevron">
								<?php 
									$statement = new WP_Query(array(
										'post_type'				=> "page" , 
										'nopaging'				=> true,
									    "orderby"				=> "date",
									    "order"					=> "DESC"
									));
									$result = $statement->posts;
									
									foreach($result as $res) : 
								?>								
								<li><a href="<?php echo get_permalink($res->ID)?>"><?php echo $res->post_title?></a></li>								
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="span3 sitemapcat">
							<h3> <?php j_e('sitemap_blog', 'Blog'); ?> </h3>
							<hr class="hr-margin">
							<ul class="list-chevron">
								<?php 
									$statement = new WP_Query(array(
										'nopaging'				=> true,
									    "orderby"				=> "date",
									    "order"					=> "DESC"
									));
									$result = $statement->posts;
									
									foreach($result as $res) : 
								?>								
								<li><a href="<?php echo get_permalink($res->ID)?>"><?php echo $res->post_title?></a></li>								
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="span3 sitemapcat">
							<h3> <?php j_e('sitemap_portfolio_category', 'Portfolio Category'); ?> </h3>
							<hr class="hr-margin">
							<ul class="list-chevron">
								<?php 
									$terms = get_terms(JEG_PORTFOLIO_CATEGORY);
									foreach ($terms as $term) :
								?>								
								<li><a href="<?php echo  get_term_link($term->slug, JEG_PORTFOLIO_CATEGORY)?>"><?php echo $term->name?></a></li>								
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="span3 sitemapcat">
							<h3> <?php j_e('sitemap_blog_category', 'Blog Category'); ?> </h3>
							<hr class="hr-margin">
							<ul class="list-chevron">
								<?php 
									$categories = get_categories(array(
										'type' 			=> 'post',
										'taxonomy'		=> 'category'
									));
									foreach ($categories as $category) :

								?>								
								<li><a href="<?php echo  get_category_link($category->term_id)?>"><?php echo $category->name?></a></li>								
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="span3 sitemapcat">
							<h3> <?php j_e('sitemap_blog_tag', 'Blog Tag'); ?> </h3>
							<hr class="hr-margin">
							<ul class="list-chevron">
								<?php
									$tagterm = get_terms('post_tag');
									foreach ($tagterm as $term) :
								?>								
								<li><a href="<?php echo  get_term_link($term->slug, 'post_tag')?>"><?php echo $term->name?></a></li>								
								<?php endforeach; ?>				
								
							</ul>
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 20px;"></div>
				</div>
			</div>				
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		/** bind jeg default **/
		$(window).jegdefault({
			curtain 	: <?php echo j_get_option('curtain', 0);?>,
			rightclick 	: <?php echo j_get_option('rightclick', 1);?>,
			clickmsg	: "<?php echo j_e('disableclick', 'Right click disabled'); ?>" 
		});
		$(".sitemaprow").isotope({
			animationEngine: "jquery",
            itemSelector: ".sitemapcat",
            masonry: {
				columnWidth: 1
			}
		});
	});
</script>