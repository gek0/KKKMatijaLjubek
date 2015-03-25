<?php

/**
 * link with active route state
 */
HTML::macro('smartRoute_link', function($route, $text) {
    if(Request::is($route)) {
        $active = " class='active'";
    }
    else {
        $active = "";
    }
    return '<li'.$active.'>'.link_to($route, $text).'</li>';
});

/**
 * button link
 */
HTML::macro('buttonLink', function($route, $text, $button_class = '') {
    if($button_class !== ''){
        $class = " class='".$button_class."'";
    }
    else{
        $class = "";
    }
    return '<a href="'.$route.'"><button'.$class.'>'.$text.'</button></a>';
});

/**
 * @param int $length
 * @return string
 * generate random string - default 10 chars
 */
function random_string($length = 10) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';

    for ($i = 0; $i < $length; $i++) {
        $random_string .= $chars[rand(0, strlen($chars) - 1)];
    }

    return $random_string;
}

/**
 * @param $string
 * @return string
 * safe name, no croatian letters
 */
function safe_name($string) {
    $trans = array("š" => "s", "ć" => "c", "č" => "c", "đ" => "d", "ž" => "z", " " => "_", ">" => "", "<" => "");

    return strtr(mb_strtolower($string, "UTF-8"), $trans);
}

/**
 * @param $string
 * @return string
 * string like slug URL, uses @safe_name() function
 */
function string_like_slug($string){
    $trans = array("_" => "-");

    return strtr(safe_name($string), $trans);
}

/**
 * @param $dir
 * remove directory and all its content
 */
function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file){
        if(is_dir($file)){
            rrmdir($file);
        }
        else{
            unlink($file);
        }
    }

    rmdir($dir);
}

/**
 * @param $image_name
 * @return string
 * return image name without extension for alt attribute of HTML <img> tag
 */
function imageAlt($image_name){
    return substr($image_name, 0, -4);
}

/**
 * @param $string
 * @return string
 * place BBcode parsed text to <p> HTML tags
 */
function nl2p($string) {
    $arr = explode('\n', $string);
    $out = '';
    $arr_len = count($arr);

    for($i = 0; $i < $arr_len; $i++){
        if(strlen(trim($arr[$i])) > 0) {
            $out .= '<p>'.trim($arr[$i]).'</p>';
        }
    }

    return $out;
}

/**
 * @param $content
 * @return mixed
 * remove empty <p> HTML tags left after BBcode parser
 */
function removeEmptyP($content) {
    $content = preg_replace(array(
        '#<p>\s*<(div|aside|section|article|header|footer)#',
        '#</(div|aside|section|article|header|footer)>\s*</p>#',
        '#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
        '#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
        '#<p>\s*</(div|aside|section|article|header|footer)#',
    ),
    array(
        '<$1',
        '</$1>',
        '</$1>',
        '<$1$2>',
        '</$1',
    ), $content );

    return preg_replace('#<p>(\s|&nbsp;)*+(<br\s*/*>)*(\s|&nbsp;)*</p>#i', '', $content);
}