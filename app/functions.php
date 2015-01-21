<?php
/**
 * link with active route state
 */
HTML::macro('smartRoute_link', function($route, $text) {
    if( Request::is($route) || Request::is($route.'/*') ) {
        $active = " class='active'";
    }
    else {
        $active = "";
    }
    return '<li'.$active.'>'.link_to($route, $text).'</li>';
});