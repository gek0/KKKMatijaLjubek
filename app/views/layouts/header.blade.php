<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Matija Ljubek ~ {{ $pageTitle }}</title>

    <!-- scripts -->
    {{ HTML::script('js/jquery.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/bootstrap.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/modernizr.custom.js', array('charset' => 'utf-8')) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js') }}
    {{ HTML::script('js/respond.min.js') }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/layoutPublic.css') }}
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
