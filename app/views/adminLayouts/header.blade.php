<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Matija Ljubek ~ Administracija</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- scripts -->
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/modernizr.custom.js') }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js') }}
    {{ HTML::script('js/respond.min.js') }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/flat-ui.min.css') }}
    {{ HTML::style('css/layout.css') }}
<body class="cbp-spmenu-push">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
        <h2>Navigacija</h2>
        {{ HTML::smartRoute_link('admin', 'Početna') }}
        {{ HTML::smartRoute_link('admin/logout', 'Odjava') }}
    </nav>