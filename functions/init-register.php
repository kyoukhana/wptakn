<?php

/**
 * - Register Menu Option
 * - register sidebar
 * - Register font on head section
 * - set content width
 * 
 * @author Jegbagus
 */

// Add Theme Support for menu & automatic feed
add_theme_support( 'menus' );
add_theme_support( 'automatic-feed-links' );

// Locale & Translation
load_theme_textdomain( 'jegtheme' , get_template_directory()  . '/lang' );

// Register Menu
if(function_exists('register_nav_menu')):	
	
	// centered menu disabled, menu go to right
	if (j_get_option('centered_menu', 1)) :
		register_nav_menu( 'top_left_menu', 	__( 'Top Left Menu'	, 'jegtheme' ));
		register_nav_menu( 'top_right_menu'	, 	__( 'Top Right Menu'	, 'jegtheme' ));
		register_nav_menu( 'mobile_menu'	, 	__( 'Mobile Menu'	, 'jegtheme' ));
	else :	
		register_nav_menu( 'top_left_menu', 	__( 'Top  Menu'	, 'jegtheme' ));
		register_nav_menu( 'mobile_menu', 	__( 'Mobile Menu'	, 'jegtheme' ));
	endif;
	
endif;

function jeg_menu($pos)
{
	if(function_exists('wp_nav_menu') && has_nav_menu('top_right_menu') && $pos == "topright"):
		wp_nav_menu(
			array(
				'theme_location' => 'top_right_menu',
				'menu_class' => 'menu', 
				'walker' => new jeg_top_menu_walker()
			)
		);
	elseif (function_exists('wp_nav_menu') && has_nav_menu('top_left_menu') && $pos == "topleft") :
		wp_nav_menu(
			array(
				'theme_location' => 'top_left_menu',
				'menu_class' => 'menu', 
				'walker' => new jeg_top_menu_walker()
			)
		);
	elseif (function_exists('wp_nav_menu') && has_nav_menu('bottom_left_menu') && $pos == "bottomleft") :
		wp_nav_menu(
			array(
				'theme_location' => 'bottom_left_menu',
				'walker' => new jeg_bottom_menu_walker(),
				'depth' => 1 
			)
		);
	elseif (function_exists('wp_nav_menu') && has_nav_menu('bottom_right_menu') && $pos == "bottomright") :
		wp_nav_menu(
			array(
				'theme_location' => 'bottom_right_menu',
				'walker' => new jeg_bottom_menu_walker(),
				'depth' => 1
			)
		);
	else : 
		/** don't show anything **/
	endif ;
}

function jeg_responsive_menu () 
{
	$responsemenu = "";
	
	if(has_nav_menu('mobile_menu')) {
		$responsemenu .= wp_nav_menu(
			array(
				'theme_location' => 'mobile_menu',
				'walker' => new jeg_responsive_menu_walker(),
				'depth' => 0, 
				'container'	=> '',
				'items_wrap' => '%3$s'
			)
		);
	} else {
		if(function_exists('wp_nav_menu') && ( has_nav_menu('top_right_menu') || has_nav_menu('top_left_menu') ) ) :
			if(has_nav_menu('top_left_menu')) :
				$responsemenu .= wp_nav_menu(
					array(
						'theme_location' => 'top_left_menu',
						'walker' => new jeg_responsive_menu_walker(),
						'depth' => 0, 
						'container'	=> '',
						'items_wrap' => '%3$s'
					)
				);
			endif;	
		 	if(has_nav_menu('top_right_menu')) :
		 		$responsemenu .= wp_nav_menu(
					array(
						'theme_location' => 'top_right_menu',
						'walker' => new jeg_responsive_menu_walker(),
						'depth' => 0, 
						'container'	=> '',
						'items_wrap' => '%3$s'
					)
				);
		 	endif;	
		endif;
	}
	
	return $responsemenu;
}

class jeg_responsive_menu_walker extends Walker_Nav_Menu {
	
	function start_lvl( &$output, $depth = 0, $args = array() ) {}
	function end_lvl( &$output, $depth = 0, $args = array() ) {}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
				
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' value="'   . esc_attr( $item->url        ) .'"' : '';
		
		$item_output = '';
		$item_output .= '<option '. $attributes .'>'		
			. str_repeat("&nbsp;&nbsp;", $depth) 
			. " " 
			. apply_filters( 'the_title', $item->title, $item->ID );
			
		$item_output .= '</option>';
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// menu walker extends
class jeg_bottom_menu_walker extends Walker_Nav_Menu
{
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 )
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
				
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		
		$attributes  = ! empty( $item->attr_title ) ? ' data-rel="tooltip" title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' 					 . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    					 . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'     				 . esc_attr( $item->url        ) .'"' : '';
		
		$nav_description = ! empty($item->description) ? '<span>' . esc_attr( $item->description ) . '</span>' : '';
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) ;
		$item_output .= $nav_description . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// menu walker extends
class jeg_top_menu_walker extends Walker_Nav_Menu
{
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 )
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'bgnav';
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		$nav_description = ! empty($item->description) ? '<span>' . esc_attr( $item->description ) . '</span>' : '';
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . '<h3>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</h3>' ;
		$item_output .= $nav_description . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"submenu\">\n";
	}
}

/** Side bar Begin ! **/
add_action('init', 'jeg_init_sidebar');

function jeg_init_sidebar() {
	$userSidebar = j_get_option("sidebar");
	if(empty($userSidebar)) $userSidebar = array();
	$jegSidebar = array_merge(array(JEG_DEFAULT_SIDEBAR), $userSidebar);
	jeg_register_sidebars($jegSidebar);
}

function jeg_register_sidebars($sidebars) {
	foreach($sidebars as $sidebar) {
		register_sidebar(array(
			'name'			=> $sidebar,
			'id' 			=> jegGenId($sidebar),
			'before_widget' => '<div class="containerborder %2$s" id="%1$s"><div class="inner-container">',
	        'after_widget' 	=> '</div></div>',
	        'before_title'	=> '<h3>',
	        'after_title' 	=> '</h3><div class="widget-line"></div>',
		));
	}
}


/** register menu head **/
add_action('wp_head', 'jeg_put_og_image');

function jeg_put_og_image() {
	global $post;
	$posttype = $post->post_type;	
	$cover = '';
	
	if($posttype == 'page' || $posttype == 'post') {
		if(has_post_thumbnail()) {
			$imagecover = j_get_post_header_image ($post, 'full');
			$cover = $imagecover['src'];
		}
	} else if ($posttype == JEG_PORTFOLIO_POST_TYPE) {
		$mediatype = j_get_meta('portfolio_media', '', $post->ID);
		switch($mediatype) {
			case 'gallery'	:
				$cover = j_get_meta('porto_gallery_cover', '', $post->ID);
				break;
			case 'youtube'	:
				$cover = j_get_meta('porto_youtube_cover', '', $post->ID);
				break;
			case 'vimeo'	:
				$cover = j_get_meta('porto_vimeo_cover', '', $post->ID);
				break;
			case 'html-5-video'	:
				$cover = j_get_meta('porto_video_cover', '', $post->ID);
				break;
			case 'music'	:
				$cover = j_get_meta('porto_music_cover', '', $post->ID);
				break;
		}
	}
	
	
	if($cover !== '') {
		echo '<meta property="og:image" content="' . $cover . '"/>';
	}
}



/** register menu head **/
add_action('wp_head', 'jeg_attach_font');

function jeg_build_fontface($face, $ff) {
	$css = 
	"@font-face {
		font-family: '". $face ."';
		src: url('". $ff['0'] ."');
		src: local('?'), url('" . $ff[1] . "') format('woff'), url('" . $ff[2] . "') format('truetype'), url('" . $ff[3] . "') format('svg');
	}";	
	return $css;
}


function jeg_attach_font() 
{
	$fontarray = array(
		array(
			'font' => j_get_themes_manager('heading_font')
		),
		array(
			'font' => j_get_themes_manager('heading_alt_font')
		),
		array(
			'font' => j_get_themes_manager('body_font')
		),
		array(
			'font' => j_get_themes_manager('front_slider_font')
		),
	);	
	
	$fontstring = "";
	if(!empty($fontarray)) {
		foreach ($fontarray as $f) {	
			$font = $f['font'];
			if(!empty($font['name'])) {
				$fn = urlencode($font['name']) . ':' . $font['variant'];
				$fontstring .= "\t\n<link href='http://fonts.googleapis.com/css?family=" . $fn .  "&amp;v1' rel='stylesheet' type='text/css'>";
			} else if(!empty($font['face'])) {
				$fontstring .= "\n<style type='text/css'>\n
					". jeg_build_fontface($font['face'], $font['facefont']) . "						
				</style>";
			} else {
				// nothing todo
			}			 
		}
	}
	
	echo $fontstring . "\n";
}

/** set content width **/
if ( ! isset( $content_width ) ) $content_width = 962;

/** don't show header **/
add_action('init', 'jeg_hide_admin');


function jeg_hide_admin() {
	show_admin_bar( false );
}
