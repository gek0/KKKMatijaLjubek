<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>KKK Matija Ljubek :: 404</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicons and apple icon -->
    <!--[if IE]><link rel="shortcut icon" href="{{ asset('favicon.ico') }}"><![endif]-->
    <link rel="apple-touch-icon" href="{{ asset('touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('touch-icon-ipad-retina.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('touch-icon-iphone-6-plus.png') }}">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="canonical" href="{{ Request::url() }}" />

    <!-- scripts -->
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/respond.min.js', array('charset' => 'utf-8')) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/layoutPublic.css') }}
</head>
<body class="no-trans">
    <!-- section exception start -->
    <section class="exception translucent-bg blue full-height-section">
        <div class="container exception-container">
            {{ HTML::image('css/assets/images/logo_main_log.png', 'KKK Matija Ljubek logo', array('id' => 'exception-logo', 'class' => 'img-responsive')) }}
                <div class="space"></div>
            <h1 id="exception" class="title text-center">{{{ $exception }}}</h1>
                <div class="space"></div>

            <div class="text-center">
                <a href="{{ URL::previous() }}"><button class="btn btn-primary btn-square">Povratak na prethodnu stranicu</button></a>
            </div>
        </div>
    </section> <!-- section exception end -->

    <footer>
        <div class="subfooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">Copyright © {{ date('Y') }}, made with <span class="glyphicon glyphicon-heart pulseAnim text-colored"></span> by <a href="https://github.com/gek0" target="_blank">Matija</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- scripts -->
    {{ HTML::script('js/jquery.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/bootstrap.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/modernizr.js', array('charset' => 'utf-8')) }}
</body>
</html>
