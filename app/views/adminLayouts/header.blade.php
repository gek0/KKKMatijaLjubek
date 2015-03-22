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
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="keywords" content="kayak, canoe, kajak, kanu, matija, ljubek, klub, zagreb">
    <meta name="description" content="Kajak Kanu Klub Matija Ljubek administracija">
    <meta name="author" content="Matija Buriša">
    <meta name="robots" content="noindex">
    <meta property="og:title" content="Kajak Kanu Klub Matija Ljubek, administracija" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="kkkmatijaljubek.hr" />
    <meta property="og:description" content="Kajak Kanu Klub Matija Ljubek, administracija" />

    <!-- favicons and apple icon -->
    <!--[if IE]><link rel="shortcut icon" href="{{ asset('favicon.ico') }}"><![endif]-->
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('touch-icon-ipad-retina.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('touch-icon-iphone-6-plus.png') }}">
    <link rel="canonical" href="{{ Request::url() }}" />

    <!-- scripts -->
    {{ HTML::script('js/jquery.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/bootstrap.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/modernizr.custom.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/fileinput.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/bootbox.js', array('charset' => 'utf-8')) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/respond.min.js', array('charset' => 'utf-8')) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/layoutAdmin.min.css') }}
    {{ HTML::style('wysibb/theme/default/wbbtheme.css') }}
</head>
<body class="cbp-spmenu-push">
    <!-- notifications -->
    <div class="notificationOutput" id="outputMsg">

        <div class="notificationTools" id="notifTool">
            <span class="glyphicon glyphicon-remove glyphicon-large" id="notificationRemove"></span>
            <span id="notificationTimer"></span>
        </div>
    </div>
    <header>
        <!-- navigation -->
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1" role="navigation">
            <h2>Administracija</h2>
            {{ HTML::smartRoute_link('admin', 'Početna') }}
            {{ HTML::smartRoute_link('admin/naslovnica', 'Slike naslovnice') }}
            {{ HTML::smartRoute_link('admin/vijesti', 'Vijesti') }}
                <ul>
                    {{ HTML::smartRoute_link('admin/vijesti/nova', 'Nova vijest') }}
                </ul>
            {{ HTML::smartRoute_link('admin/osobe', 'Osobe') }}
                <ul>
                    {{ HTML::smartRoute_link('admin/osobe/nova', 'Nova osoba') }}
                </ul>
            {{ HTML::smartRoute_link('admin/korisnik/postavke', 'Korisničke postavke') }}
            {{ HTML::smartRoute_link('logout', 'Odjava') }}
        </nav>
    </header> <!-- end header -->