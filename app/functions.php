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
HTML::macro('buttonLink', function($route, $text, $buttonClass = '') {
    if($buttonClass !== ''){
        $class = " class='".$buttonClass."'";
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
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $chars[rand(0, strlen($chars) - 1)];
    }

    return $randomString;
}

/**
 * @param $string
 * @return string
 * safe name, no croatian letters
 */
function safe_name($string) {
    $trans = array("š" => "s", "ć" => "c", "č" => "c", "đ" => "d", "ž" => "z", " " => "_");

    return strtr(mb_strtolower($string, "UTF-8"), $trans);
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