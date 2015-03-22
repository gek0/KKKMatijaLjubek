<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>KKK Matija Ljubek :: {{ $page_title }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="kayak, canoe, kajak, kanu, matija, ljubek, klub, zagreb">
    <meta name="description" content="Kajak Kanu Klub Matija Ljubek">
    <meta name="author" content="Matija Buriša">
    <meta property="og:title" content="Kajak Kanu Klub Matija Ljubek" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="kkkmatijaljubek.hr" />
    <meta property="og:description" content="Kajak Kanu Klub Matija Ljubek" />

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
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/respond.min.js', array('charset' => 'utf-8')) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/layoutPublic.min.css') }}
</head>

<body class="no-trans">
<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

<!-- facebook SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0&appId=283742071785556";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- end facebook SDK -->

<!-- header start -->
<header class="header fixed clearfix navbar navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="header-left clearfix">
                    <div class="logo smooth-scroll">
                        {{ HTML::image('css/assets/images/logo_nav.png', 'KKK Matija Ljubek Logo', array('id' => 'logo', 'title' => 'KKK Matija Ljubek', 'class' => 'img-responsive')) }}
                    </div>
                    <div class="site-name-and-slogan smooth-scroll">
                        <div class="site-name">Matija Ljubek</div>
                        <div class="site-slogan">Kajak Kanu Klub</div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="header-right clearfix">
                    <div class="main-navigation animated">
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                        <span class="sr-only">Navigacija</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="collapse navbar-collapse scrollspy smooth-scroll" id="navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="active"><a href="{{ URL::to('/') }}#banner">Naslovnica</a></li>
                                        <li><a href="{{ URL::to('/') }}#about-us">O nama</a></li>
                                        <li><a href="{{ URL::to('/') }}#news">Vijesti</a></li>
                                        <li><a href="{{ URL::to('/') }}#persons">Članovi</a></li>
                                        <li><a href="{{ URL::to('/') }}#young-members">Škola</a></li>
                                        <li><a href="{{ URL::to('/') }}#regatta-program">Raspis</a></li>
                                        <li><a href="{{ URL::to('/') }}#contact">Kontakt</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav> <!-- end navigation -->
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div>
</header> <!-- end header -->