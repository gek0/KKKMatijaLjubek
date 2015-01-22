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