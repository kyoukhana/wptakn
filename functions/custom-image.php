<?php

add_action('init', 'jeg_theme_image_sizes');
 
function jeg_theme_image_sizes () 
{
	if (function_exists('add_theme_support')) {
		add_theme_support ( 'post-thumbnails' );
	}
}

function j_get_image_dim() {
	if(j_get_schema() == "dark") {
		return array (
			"post-feature-image" 		=> array(734, 300),
			"post-feature-image-wide" 	=> array(1134, 300),
			"post-gallery"				=> array(180, 180)
		);
	} else {
		return array (
			"post-feature-image" 		=> array(722, 300),
			"post-feature-image-wide" 	=> array(1122, 300),
			"post-gallery"				=> array(180, 180)
		);
	}
}


/** 
 * get post thumbnail image, and return array of attribute  
 **/
function j_get_post_header_image($post, $size){
	$attachment_id 	= get_post_thumbnail_id($post->ID);
	$image = wp_get_attachment_image_src($attachment_id, $size);	
	if ( $image ) {
		list($src, $width, $height) = $image;
		$attachment = get_post($attachment_id);
		$default_attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size",
			'alt'	=> trim(strip_tags( get_the_title() ))
		);
		if ( empty($default_attr['alt']) )
			$default_attr['alt'] = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption
		if ( empty($default_attr['alt']) )
			$default_attr['alt'] = trim(strip_tags( $attachment->post_title )); // Finally, use the title
			
		return $default_attr;
	} else {
		return NULL;
	}	
}

function j_build_image ($arrs) {
	$html = "<img ";
	
	foreach( $arrs as $name => $value ) {
		$html .= " $name=" . '"' . $value . '"';
	} 
	$html .= " />";
	
	return $html;
}

function j_get_post_header_img_src($post) {
	
}

/**
 * get image size of given url (only work for internal image)
 * @param unknown_type $url
 */
function j_get_image_size($url) 
{
	//validate inputs
	if(!$url) return false;	
	
	//define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	//check if $img_url is local
	if(strpos( $url, $upload_url ) === false) return false;	
	
	//define path of image
	$rel_path = str_replace( $upload_url, '', $url);
	$img_path = $upload_dir . $rel_path;
	
	//check if img path exists, and is an image indeed
	if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
	
	//get image info
	$info = pathinfo($img_path);
	$ext = $info['extension'];
	return getimagesize($img_path);
}

/**
 * get image after resizing
 * @param $img 	image url
 * @param $dim	defined image dimension
 * @param $w	image width
 * @param $h	image height
 * @param $a	align
 * @param $zc	zoom crop
 */
function jeg_get_image($img = '', $dim = '',  $w = false, $h = false , $nocrop = false , $fillcolor = "000000") 
{
	if($dim != '') :
		$imageDim = j_get_image_dim();
		if(isset($imageDim[$dim])) : 
			$w = $imageDim[$dim][0];
			$h = $imageDim[$dim][1];
		endif;
	endif;
	
	$fillcolor = j_get_option('uncroped_bg_color', '000000');
	
	if($nocrop) {
		return j_nocrop_resize($img, $w, $h, $fillcolor);
	} else {
		return j_aq_resize($img, $w, $h, true);
	}
}

function j_resize_img($source_image, $destination, $tn_w, $tn_h, $quality = 100, $fillcolor)
{
    $info = getimagesize($source_image);
    $imgtype = image_type_to_mime_type($info[2]);

    #assuming the mime type is correct
    switch ($imgtype) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($source_image);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($source_image);
            break;
        case 'image/png':
            $source = imagecreatefrompng($source_image);
            break;
        default:
        	return;
    }

    #Figure out the dimensions of the image and the dimensions of the desired thumbnail
    $src_w = imagesx($source);
    $src_h = imagesy($source);

    #Do some math to figure out which way we'll need to crop the image
    #to get it proportional to the new size, then crop or adjust as needed
    $x_ratio = $tn_w / $src_w;
    $y_ratio = $tn_h / $src_h;

    if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
        $new_w = $src_w;
        $new_h = $src_h;
    } elseif (($x_ratio * $src_h) < $tn_h) {
        $new_h = ceil($x_ratio * $src_h);
        $new_w = $tn_w;
    } else {
        $new_w = ceil($y_ratio * $src_w);
        $new_h = $tn_h;
    }

    $newpic = imagecreatetruecolor(round($new_w), round($new_h));
    imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
    $final = imagecreatetruecolor($tn_w, $tn_h);
    
    $fillbg = j_hex2RGB($fillcolor);
    $backgroundColor = imagecolorallocate($final, $fillbg['red'], $fillbg['green'], $fillbg['blue']);
    imagefill($final, 0, 0, $backgroundColor);
    imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
       
    if (imagejpeg($final, $destination, $quality)) {
        return true;
    }
    return false;
}

/**
 * get image without croped region, but add background to fill image background
 * @param unknown_type $url
 * @param unknown_type $width
 * @param unknown_type $height
 */
function j_nocrop_resize ($url, $width, $height, $fillcolor) 
{
	// validate inputs
	if(!$url OR !$width ) return false;
	
	// define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	//check if $img_url is local
	if(strpos( $url, $upload_url ) === false) return false;
	
	// define path of image
	$rel_path = str_replace( $upload_url, '', $url);
	$img_path = $upload_dir . $rel_path;
	
	// check if img path exists, and is an image indeed
	if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
	
	// get image info
	$info = pathinfo($img_path);
	$ext = $info['extension'];
	
	// use this to check if cropped image already exists, so we can return that instead
	$suffix = "{$width}x{$height}-{$fillcolor}";
	$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
	$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
	
	if(file_exists($destfilename) && getimagesize($destfilename)) {
		$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
	} 
	else {		
		// do real resizing
		j_resize_img($img_path, $destfilename, $width, $height, 90, $fillcolor);
		
		// get image url
		$resized_rel_path = str_replace( $upload_dir, '', $destfilename);
		$img_url = $upload_url . $resized_rel_path;
	}
	
	return $img_url;
}

/**
* Title		: Aqua Resizer
* Description	: Resizes WordPress images on the fly
* Version	: 1.1.4
* Author	: Syamil MJ
* Author URI	: http://aquagraphite.com
* License	: WTFPL - http://sam.zoy.org/wtfpl/
* Documentation	: https://github.com/sy4mil/Aqua-Resizer/
*
* @param string $url - (required) must be uploaded using wp media uploader
* @param int $width - (required)
* @param int $height - (optional)
* @param bool $crop - (optional) default to soft crop
* @param bool $single - (optional) returns an array if false
* @uses wp_upload_dir()
* @uses image_resize_dimensions()
* @uses image_resize()
*
* @return str|array
*/

function j_aq_resize( $url, $width, $height = null, $crop = null ) {
	
	//validate inputs
	if(!$url OR !$width ) return false;
	
	//define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	//check if $img_url is local
	if(strpos( $url, $upload_url ) === false) return false;
	
	//define path of image
	$rel_path = str_replace( $upload_url, '', $url);
	$img_path = $upload_dir . $rel_path;
	
	//check if img path exists, and is an image indeed
	if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
	
	//get image info
	$info = pathinfo($img_path);
	$ext = $info['extension'];
	list($orig_w,$orig_h) = getimagesize($img_path);
	
	//get image size after cropping
	$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
	$dst_w = $dims[4];
	$dst_h = $dims[5];
	
	//use this to check if cropped image already exists, so we can return that instead
	$suffix = "{$dst_w}x{$dst_h}";
	$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
	$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
	
	//if orig size is smaller
	if($width >= $orig_w || $height >= $orig_h) {
		// if originial image is smaller, than we need to no crop resize function
		$fillcolor = j_get_option('uncroped_bg_color', '000000');	
		return j_nocrop_resize($url, $width, $height, $fillcolor);
	}
	//else check if cache exists
	if(file_exists($destfilename) && getimagesize($destfilename)) {
		$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
	} 
	//else, we resize the image and return the new resized image url
	else {
		$resized_img_path = jeg_image_resize_hub( $img_path, $dst_w, $dst_h, $crop );
		$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
		$img_url = $upload_url . $resized_rel_path;
	}	
	
	return $img_url;
}

/**
 * @todo fix image resize hub 
 */
function jeg_image_resize_hub($img_path, $width, $height, $crop) {
	$resized_img_path  = '';
	
	if(function_exists('wp_get_image_editor')) {
		$image = wp_get_image_editor($img_path);
		$image->resize($width, $height, $crop);
		
		$resized_img_path = $image->generate_filename();
		$image->save($resized_img_path);	
	} else {		
		$resized_img_path = image_resize( $img_path, $width, $height, $crop );
	}
	
	return $resized_img_path;
}