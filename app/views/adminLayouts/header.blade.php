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

    <!--[if IE]><link rel="shortcut icon" href="{{ asset('favicon.ico') }}"><![endif]-->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('apple-touch-icon-precomposed.png') }}">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="canonical" href="{{ Request::url() }}" />

    <!-- scripts -->
    {{ HTML::script('js/jquery.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/bootstrap.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/modernizr.custom.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/fileinput.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/bootbox.js', array('charset' => 'utf-8')) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js') }}
    {{ HTML::script('js/respond.min.js') }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/layoutAdmin.css') }}
    {{ HTML::style('wysibb/theme/default/wbbtheme.css') }}
    {{ HTML::style('css/fileinput.css') }}
<body class="cbp-spmenu-push">
    <!-- notifications -->
    <div class="notificationOutput" id="outputMsg"></div>
    <header>
        <!-- navigation -->
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1" role="navigation">
            <h2>Administracija</h2>
            {{ HTML::smartRoute_link('admin', 'Početna') }}
            {{ HTML::smartRoute_link('admin/naslovnica', 'Naslovnica') }}
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