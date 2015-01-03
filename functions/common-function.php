<?php

/**  title **/
function jeg_build_titles()
{
    $separator = ' ' . stripslashes(j_get_option('separator', '-')) . ' ';

    if (function_exists('is_tag') && is_tag()) {
        printf(j__('tag_archive_title_lang'), single_tag_title('', false), $separator);
    } elseif (is_category()){
        printf(j__('post_filled_title_lang'), single_cat_title('', false), $separator);
    } elseif (is_author()){
        printf(j__('post_written_title_lang'), get_userdata(get_query_var('author'))->display_name , $separator);
    } elseif (is_archive()) {
        wp_title('');
        j_e('archive_title_lang') . $separator;
    } elseif (is_search()) {
        printf(j__('search_for_title_lang'), esc_html(get_search_query()) ,  $separator);
    } elseif (!(is_404()) && (is_single()) || (is_page())) {
        if(!is_front_page()) {
            wp_title('');
            echo ' ' . $separator;
        }
    } elseif (is_404()) {
        echo j__('not_found_lang') .  $separator;
    }

    global $paged;
    if ($paged > 1) {
        echo j__('page_title_lang'). $paged . $separator;
    }

    if (is_home() || is_front_page()) {
        bloginfo('name');
        echo " $separator ";
        bloginfo('description');
    } else {
        bloginfo('name');
    }
}

function j_failed_po() {
    j_e('portfolio_prev', "Previous Portfolio");
    j_e('portfolio_next', "Next Portfolio");
}

/**
 *
 */
function j_get_option($name, $default = false)
{
    return get_option(j_name($name), $default);
}

function j_update_option ($name, $value) {
    update_option(j_name($name), $value);
}

function j_delete_option ($name) {
    delete_option(j_name($name));
}

function j_name($name)
{
    return JEG_SHORTNAME . '_' .  $name;
}

/** themes manager **/
function j_theme_name ($key)
{
    $tmarr = j_get_option('thememanager', '');

    if(empty($tmarr)) {
        return $key;
    } else {
        if($tmarr[0]->title == 'default') {
            return $key;
        } else {
            return $key . '_' . $tmarr[0]->title;
        }
    }
}

function j_get_setup_font_name($fontkey) {
    $tmarr = j_get_option('thememanager', '');

    if(empty($tmarr))
    {
        return $fontkey;
    } else
    {
        if($tmarr[0]->title == 'default') {
            return $fontkey;
        } else {
            $name = str_replace( '_' . $tmarr[0]->title , '' , $fontkey ) . '_' . $tmarr[0]->title;
            return $name;
        }
    }

}

function j_get_themes_manager ($key, $val = false)
{
    $tm = j_theme_name ($key);
    return j_get_option($tm , $val);
}

function j_get_schema () {
    $tmarr = j_get_option('thememanager', '');

    if(isset($tmarr[0])) {
        return $tmarr[0]->schema;
    }
}

function j_convert_schema_value () {
    $value = j_get_option('thememanager');

    if(!is_object($value[0])) {
        for($i = 0; $i < sizeof($value) ; $i++) {
            $name = $value[$i];

            $value[$i] = new stdClass();
            $value[$i]->title = $name;
            $value[$i]->schema = 'light';
        }

        j_update_option('thememanager', $value);
    }
}

/** print translation **/
function j_e($name, $default = '')
{
    echo j__($name, $default);
}

/** get translation **/
function j__($name, $default = '')
{
    $translate_enable	= 	j_get_option('enable_translation');

    /**
     * $locale				=	get_locale();
     * $default_locale		=	j_get_option('default_locale');
     * if(!$translate_enable && ( $locale != $default_locale ) ) {}
     */

    if(!$translate_enable) {
        return __($name, 'jegtheme');
    } else {
        $lang = j_get_option($name);
        if(!empty($lang)) {
            return stripslashes(j_get_option($name));
        } else {
            return $default;
        }
    }
}

/** page type checker **/
function jeg_check_page_type()
{
    $type = array();

    if(is_home()) 			array_push($type, 'is_home');
    if(is_front_page()) 	array_push($type, 'is_front_page');
    if(is_404()) 			array_push($type, 'is_404');
    if(is_search()) 		array_push($type, 'is_search');
    if(is_date()) 			array_push($type, 'is_date');
    if(is_author()) 		array_push($type, 'is_author');
    if(is_category()) 		array_push($type, 'is_category');
    if(is_tag()) 			array_push($type, 'is_tag');
    if(is_tax()) 			array_push($type, 'is_tax');
    if(is_archive()) 		array_push($type, 'is_archive');
    if(is_single()) 		array_push($type, 'is_single');
    if(is_attachment()) 	array_push($type, 'is_attachment');
    if(is_page()) 			array_push($type, 'is_page');

    return implode(', ', $type);
}

function jegGenId($str)
{
    $replace	= '-';
    $trans = array(
        '&\#\d+?;'				=> '',
        '&\S+?;'				=> '',
        '\s+'					=> $replace,
        '[^a-z0-9\-\._]'		=> '',
        $replace.'+'			=> $replace,
        $replace.'$'			=> $replace,
        '^'.$replace			=> $replace,
        '\.+$'					=> ''
    );

    $str = strip_tags($str);

    foreach ($trans as $key => $val) :
        $str = preg_replace("#".$key."#i", $val, $str);
    endforeach;

    return trim(stripslashes(strtolower($str)));
}

function j_get_font_variant($fontname)
{
    include JEG_UTIL . '/googlefont.php';
    $serialize = $googlefont;
    $unserialized = unserialize($serialize);
    $items = $unserialized->items;

    foreach($items as $item) {
        if($item->family == $fontname) {
            return $item->variants;
        }
    }
}

function j_get_all_font() {
    include JEG_UTIL . '/googlefont.php';
    $serialize = $googlefont;
    $unserialized = unserialize($serialize);
    $items = $unserialized->items;

    $allfont = array();
    foreach($items as $item) {
        $allfont[$item->family] = $item->family;
    }

    return $allfont;
}

function j_get_sidebar_list () {
    global $wp_registered_sidebars;

    $sidebarlist = array();
    foreach($wp_registered_sidebars as $key => $val) {
        $sidebarlist[$val['id']] = $val['name'];
    }

    return $sidebarlist;
}


function j_get_blog_category () {
    $categories = get_categories();

    $catlist = array();
    foreach ($categories as $cat) {
        $catlist["$cat->cat_ID"] = $cat->name;
    }

    return $catlist;
}

function j_get_portfolio_category() {
    $categories = get_terms(JEG_PORTFOLIO_CATEGORY);

    $catlist = array();
    foreach ($categories as $cat) {
        $catlist["$cat->term_id"] = $cat->name;
    }

    return $catlist;
}

/** build email content from template **/
function j_build_email_content($content, $data) {
    $content = str_replace('{name}'		, $data['name'], $content);
    $content = str_replace('{email}'	, $data['email'], $content);
    $content = str_replace('{message}'	, $data['message'], $content);
    return $content;
}

function j_the_slug( $echo = false){
    $slug = basename(get_permalink());
    do_action('before_slug', $slug);
    $slug = apply_filters('slug_filter', $slug);
    if( $echo ) echo $slug;
    do_action('after_slug', $slug);
    return $slug;
}


function j_the_slug_id( $echo = false, $id){
    $slug = basename(get_permalink($id));
    do_action('before_slug', $slug);
    $slug = apply_filters('slug_filter', $slug);
    if( $echo ) echo $slug;
    do_action('after_slug', $slug);
    return $slug;
}


function jegGetCurrentUrl() {
    $pageURL = 'http';
    if (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function j_build_porto_category ($catlist) {
    $cats = array();
    foreach ($catlist as $cat) {
        $cats[] = $cat;
    }

    return implode(' ' , $cats);
}

/** new more tag **/
function j_new_excerpt_more($more) {
    global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"> ' . j__('read_more_lang') .  ' </a>';
}
add_filter('excerpt_more', 'j_new_excerpt_more');

function j_get_meta($metaname, $default = '', $postid = '') {
    if($postid == '') {
        global $post;
        $postid = $post->ID;
    }
    $meta = unserialize( get_post_meta($postid , j_name($metaname), true) );

    if(empty($meta)) {
        if($meta === 0) {
            return 0;
        } else {
            return $default;
        }
    } else {
        return $meta;
    }
}

function jlog($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function jlimitme ($type = "high", $point, $limit){
    if($type == "high") {
        return  ( $point > $limit ) ? $limit : $point;
    } else {
        return  ( $point > $limit ) ? $point : $limit;
    }
}

function jeg_posts_link_attributes() {
    return 'class="btn"';
}

function jeg_pagination($step = 2, $total = 0)
{
    global $wp_query;
    if($total == 0) {
        $totalPage = $wp_query->max_num_pages;
    }

    if($totalPage > 1) {

        if ( !$curpage = get_query_var('paged') ) {
            $curpage = 1;
        }

        $pagingCount = ( $step * 2 ) + 1;

        $html  = '<div class="btn-toolbar blogpagging"> <div class="btn-group">';
        $html .= '<button class="btn active">'  .  sprintf(j__('page_of_lang') , $curpage , $totalPage ) .  ' </button> ';

        if( $curpage > $step + 1 && $totalPage > $pagingCount ) {
            $html .= '<a href="'.get_pagenum_link(1).'" class="btn">&laquo;</a> ';
        }

        if( $curpage > 1 && $pagingCount < $totalPage ) {
            add_filter('previous_posts_link_attributes', 'jeg_posts_link_attributes');
            $html .= get_previous_posts_link('<span>&lsaquo;</span>');
        }

        for($i = jlimitme('low', $curpage - $step, 1) ; $i <= jlimitme('high', $totalPage , $curpage + $step) ; $i++){
            if($i == $curpage) {
                $html .= '<button class="btn active">'.$i.'</button>';
            } else {
                $html .= '<a href="'.get_pagenum_link($i).'" class="btn">'.$i.'</a>';
            }
        }

        if( $curpage < $totalPage && $pagingCount < $totalPage ) {
            add_filter('next_posts_link_attributes', 'jeg_posts_link_attributes');
            $html .= get_next_posts_link('<span>&rsaquo;</span>');
        }

        if( $curpage < $totalPage - 1 && $curpage + $step + 1 <= $totalPage && $pagingCount < $totalPage ) {
            $html .= '<a href="'.get_pagenum_link($totalPage).'" class="btn">&raquo;</a> ';
        }

        $html .= '</div> </div>';


        return $html;
    } else {
        return ;
    }
}

function jeg_disable_magic_quote() {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}

/** get slider **/
function j_front_shift(&$arr, $j)
{
    $arrsize = sizeof($arr);
    for($i = 0; $i < $arrsize; $i++) {
        if($arr[$i]->ID == $j) {
            array_splice($arr, $i , 1);
            break;
        }
    }
}

function j_get_front_slider ()
{
    $secfront = $front = query_posts(array(
        'post_type'				=> JEG_FRONT_POST_TYPE,
        'nopaging'				=> true,
    ));

    $result = $frontid = array();
    foreach($front as $key => $f) {
        $frontid[$f->ID] = $key;
    }

    $arrange = j_get_option('arrange_slider');
    $frontsize = sizeof($front);

    for($i = 0; $i < $frontsize; $i++) {
        /*
         * kalau arrange nya ada isi, ambil hasil dari list asli, trs yang di temporary hilangin
         * tp kalo ga ada, ambil satu persatu dari temporary itu jg
         */
        if(isset($arrange[$i])) {

            if(isset($frontid[$arrange[$i]])){
                if($front[$frontid[$arrange[$i]]]) {
                    $result[$i] = $front[$frontid[$arrange[$i]]];
                    j_front_shift($secfront, $arrange[$i]);
                } else {
                    $frontsize ++;
                }
            } else {
                $frontsize ++;
            }
        }
        else {
            $result[$i] = $secfront[0];
            array_shift($secfront);
        }
    }

    return $result;
}

/** get slider end **/

/**
 * Convert a hexa decimal color code to its RGB equivalent (http://php.net/manual/en/function.hexdec.php)
 *
 * @param string $hexStr (hexadecimal color value)
 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
 */
function j_hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}


function jShareToFacebook ($url, $title) {
    $fburl = "http://www.facebook.com/sharer.php?u=%s&amp;t=%s";
    return sprintf($fburl, urlencode($url), urlencode($title));
}

function jShareToTwitter($url, $title) {
    $twitUrl = "http://twitter.com/share?text=%s&amp;url=%s";
    if(j_get_option('twit_via')) {
        $twitUrl .= "&via=" . j_get_option("twit_via") ;
    }
    return sprintf($twitUrl, urlencode($title), urlencode($url));
}

function jShareGoogle($url) {
    $googurl = "https://plus.google.com/share?url=%s";
    return sprintf($googurl, urlencode($url));
}


function jeg_detect_ie()
{
    if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
        return true;
    else
        return false;
}

function jeg_run_music_ie()
{
    if(jeg_detect_ie()) {
        if(j_get_option('enable_ie_music', 1)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

function jisAjax() {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
}

// new implementation for getting image gallery from metabox
function jeg_get_image_gallery($id, $fieldname)
{
    $imglist = get_post_meta($id, j_name($fieldname), true);
    $galleries = json_decode($imglist, true);

    if(!empty($galleries)) {
        $result = array();

        foreach ($galleries as $gallery) {
            $image = wp_get_attachment_image_src($gallery['id'], 'full');

            $result[] = array(
                'file' 		=> $image[0],
                'desc'		=> $gallery['desc'],
                'title'		=> $gallery['title']
            );
        }

        return $result;
    } else {
        return false;
    }
}

function jeg_str_start_with($haystack, $needle)
{
    return !strncmp($haystack, $needle, strlen($needle));
}

function jeg_mobile_device()
{
    //Detect special conditions devices
    $iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $Android= stripos($_SERVER['HTTP_USER_AGENT'],"Android");
    $webOS= stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

    //do something with this information
    if( $iPod || $iPhone ) {
        return "iphone";
    } else if($iPad) {
        return "ipad";
    } else if($Android) {
        return "android";
    } else if($webOS) {
        return "webos";
    } else {
        return false;
    }

}



