<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title> ~ KKK Matija Ljubek</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="kayak, canoe, kajak, kanu, matija, ljubek, klub, zagreb">
    <meta name="description" content="Kajak Kanu Klub Matija Ljubek">
    <meta name="author" content="Matija Buriša">
    <meta name="robots" content="noindex">
    <meta property="og:title" content="Kajak Kanu Klub Matija Ljubek" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="kkkmatijaljubek.hr" />
    <meta property="og:description" content="Kajak Kanu Klub Matija Ljubek" />

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
<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

<!-- header start -->
<header class="header fixed clearfix navbar navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="header-left clearfix">
                    <div class="logo smooth-scroll">
                        <a href="#banner">{{ HTML::image('css/assets/images/logo_nav.png', 'KKK Matija Ljubek Logo', array('id' => 'logo', 'title' => 'KKK Matija Ljubek', 'class' => 'img-responsive')) }}</a>
                    </div>
                    <div class="site-name-and-slogan smooth-scroll">
                        <div class="site-name"><a href="#banner">Matija Ljubek</a></div>
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
                                        <li class="active"><a href="#banner">Naslovnica</a></li>
                                        <li><a href="#about-us">O nama</a></li>
                                        <li><a href="#news">Vijesti</a></li>
                                        <li><a href="#persons">Članovi</a></li>
                                        <li><a href="#young-members">Škola</a></li>
                                        <li><a href="#contact">Kontakt</a></li>
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

<!-- section banner start -->
<section id="banner" class="carousel slide carousel-fade" data-animation-effect="fadeIn">
    <!-- indicators -->
    <ol class="carousel-indicators">
        @if($galleryCount > 0)
            @for($i = 0; $i < $galleryCount; $i++)
                @if($i == 0)
                    <li data-target="#banner" data-slide-to="{{ $i }}" class="active"></li>
                @else
                    <li data-target="#banner" data-slide-to="{{ $i }}"></li>
                @endif
            @endfor
        @else
            <li data-target="#banner" data-slide-to="0" class="active"></li>
        @endif
    </ol>

    <!-- slides -->
    <div class="carousel-inner">
        @if($galleryCount > 0)
            @for($i = 0; $i < $galleryCount; $i++)
                @if($i == 0)
                    <div class="item active">
                        <div class="fill" style="background-image:url('{{ URL::to('gallery_uploads/'.$galleryData[$i]->file_name) }}');"></div>
                        <div class="carousel-caption">
                            <h2>{{ $galleryData[$i]->caption }}</h2>
                        </div>
                    </div>
                @else
                    <div class="item">
                        <div class="fill" style="background-image:url('{{ URL::to('gallery_uploads/'.$galleryData[$i]->file_name) }}');"></div>
                        <div class="carousel-caption">
                            <h2>{{ $galleryData[$i]->caption }}</h2>
                        </div>
                    </div>
                @endif
            @endfor
        @else
            <div class="item active">
                <div class="fill" style="background-image:url('{{ URL::to('css/assets/images/no_gallery_cover_image.png') }}');"></div>
                <div class="carousel-caption">
                    <h2>Kajak Kanu Klub Matija Ljubek</h2>
                </div>
            </div>
        @endif
    </div>

    <!-- gallery controls -->
    <a class="left carousel-control" href="#banner" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#banner" data-slide="next">
        <span class="icon-next"></span>
    </a>
</section> <!-- section banner end -->

<!-- section about-us start -->
<div class="section clearfix object-non-visible" data-animation-effect="fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 id="about-us" class="title text-center">O <span>KKK Matija Ljubek</span></h1>
                <p class="lead text-center">Doma kajakaša i kanuista u gradu Zagrebu.</p>
                <div class="space"></div>
                <div class="row">
                    <div class="col-md-6">
                        {{ HTML::image('css/assets/images/matija_ljubek_main_cover.png', 'Matija Ljubek', array('title' => 'Matija Ljubek', 'class' => 'img-responsive')) }}
                        <div class="space"></div>
                    </div>
                    <div class="col-md-6">
                        <p>Kajakaštvo je zajednički naziv za sportsku granu veslanja u posebnim čamcima, tj. kajacima i kanuima gdje su veslači okrenuti u smjeru veslanja, a pokreću čamac veslima koja nemaju oslonac.</p>
                        <p>Kajakaštvo nastaje iz upotrebe kajaka i kanua u turističke i izletničke svrhe.
                            Pojedinci su pomoću takvih čamaca otkrivali prirodne ljepote, logorovali uz jezera i rijeke.</p>
                        <p>U različitim zemljama kajakaštvo se razvilo na različite načine, ali uglavnom su se za čamce uzimali prototipovi čamaca domorodaca, npr. eskimski kajak i kanu sjevernoameričkih Indijanaca.</p>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-chevron-right text-colored"></i> Kajak kanu klub "Matija Ljubek" osnovan je 16.11.2000. godine</li>
                            <li class="inner-list-style"><i class="fa fa-angle-right text-colored"></i> registriran je kao športska udruga 06.12.2000. godine</li>
                        </ul>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-chevron-right text-colored"></i> Hrvatski kajakaški savez osnovan je 26.8.1939. godine u Zagrebu</li>
                            <li class="inner-list-style"><i class="fa fa-angle-right text-colored"></i> član Međunarodne kajakaške federacije (ICF) od 31.10.1992. godine</li>
                            <li class="inner-list-style"><i class="fa fa-angle-right text-colored"></i> član Europskog kajakaškog udruženja (ECA) od 11.12.1993. godine</li>
                        </ul>
                    </div>
                </div>
                <div class="space"></div>
                <h2>Povijest kluba</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p>Kajak kanu klub "Matija Ljubek" osnovan je 16.11.2000. godine na osnivačkoj skupštini, a registriran je kao športska udruga 06.12.2000.
                            Od 2000. – 2003. predsjednik je bio prof. dr. sc. Dragan Milanović, a od 2003. predsjednik je Ivan Lončarević.
                            Štefica Mihalić dopredsjednica kluba bila je do 2014., kada njenu ulogu preuzima Mislav Mandac.</p>

                        <p>Iako je KKK "Matija Ljubek" mlad klub, od samih početaka ostvaruje zapažene rezultate, koji sa godinama postaju sve značajniji, dok se sportaši razvijaju u sve ozbiljnije natjecatelje.
                            Prvi uspjeh kluba bio je 2001., kada su juniori osvoji prvi naslov prvaka na Prvenstvu Hrvatske.
                            2002. seniori su postali viceprvaci države kao i 2003. 2004. seniori su po prvi puta državni prvaci, a 2005. opet postaju viceprvaci države.
                            2004. i 2005. postali su prvaci u kajaku prve hrvatske seniorske lige.</p>

                        <p>Nakon dugo godina osvajanja 2. mjesta u ekipnom poretku na državnom prvenstvu, 2013. godine postaju, uvjerljivije nego ikada do sada, ponovno ekipni prvaci Hrvatske, te te titule osvajaju kako i u juniorskoj tako i u seniorskoj kategoriji.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Uprava kluba
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6 uprava-col">
                                                <div class="uprava">
                                                    {{ HTML::image('css/assets/images/matija_ljubek_predsjednik.png', 'Predsjednik kluba', array('title' => 'Predsjednik kluba')) }}
                                                    <p class="name">dipl. oecc Ivan Lončarević</p>
                                                    <p class="title">Predsjednik kluba</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 uprava-col">
                                                <div class="uprava">
                                                    {{ HTML::image('css/assets/images/matija_ljubek_dopredsjednik.png', 'Dopredsjednik kluba', array('title' => 'Dopredsjednik kluba')) }}
                                                    <p class="name">Mislav Mandac</p>
                                                    <p class="title">Dopredsjednik kluba</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Dokumenti i pravilnik
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <p>Život i djelo Matije Ljubeka možete pogledati <a href="" target="_blank" title="Život i djelo">ovdje</a>.</p>
                                        <p>Pravilnik nagrade Matija Ljubek možete pogledati <a href="" target="_blank" title="Pravilnik">ovdje</a>.</p>
                                        <p>Pjesmu Matiji Ljubeku možete pogledati <a href="" target="_blank" title="Pjesma">ovdje</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- section about-us end -->

<!-- section news start -->
<div class="section translucent-bg bg-image-1 blue">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="news" class="text-center title">Zadnje vijesti</h1>
        <div class="space"></div>
        <div class="row">
            ....
        </div>
    </div>
</div>

<div class="default-bg space blue">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="link-eff cl-link-effect">
                    <a href="{{ URL::to('vijesti') }}" id="news-data-link"><h4>Prikaži sve vijesti</h4></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- section news end -->

<!-- section persons start -->
<div class="section">
    <div class="container">
        <h1 class="text-center title" id="persons">Članovi kluba</h1>
        <div class="separator"></div>
        <p class="lead text-center">Sportaši i treneri u Kajak Kanu Klub Matija Ljubek.</p>
        <br>
        <div class="row object-non-visible" data-animation-effect="fadeIn">
            ...
        </div>
    </div>
</div> <!-- section persons end -->

<!-- section young-members start -->
<div class="section translucent-bg bg-image-2 blue">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="young-members" class="title text-center">Škola kajaka i kanua</h1>
        <div class="space"></div>
        ......
    </div>
</div> <!-- section young-members end -->

<!-- section map start -->
<div class="section" id="map">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <div class="space"></div>
        <noscript>Morate imati omogućen JavaScript u Vašem internet pregledniku kako bi se prikazala mapa, hvala na razumijevanju.</noscript>
    </div>
</div> <!-- section map end -->

<!-- footer start -->
<footer id="footer">
    <div class="footer section">
        <div class="container">
            <h1 class="title text-center" id="contact">Kontaktirajte nas</h1>
            <div class="space"></div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="footer-content">
                        <p class="large">Ukoliko imate kakvo pitanje ili nas samo želite pozdraviti, pošaljite poruku preko kontakt forme ili nas posjetite na navedenoj adresi.</p>
                        <ul class="list-icons">
                            <li title="Adresa"><i class="fa fa-map-marker pr-10 fa-big text-colored"></i> Aleja Matije Ljubeka bb ŠRC Jarun, Zagreb</li>
                            <li title="Telefon"><i class="fa fa-phone pr-10 fa-big text-colored"></i> 01/3011 - 202</li>
                            <li title="Fax"><i class="fa fa-fax pr-10 fa-med text-colored"></i> 01/3011 - 202</li>
                            <li title="E-mail"><i class="fa fa-envelope pr-10 fa-med text-colored"></i> {{ HTML::mailto('kkk-matija.ljubek@zg.t-com.hr') }}</li>
                        </ul>
                        <ul class="social-links">
                            <li class="facebook"><a target="_blank" href="https://www.facebook.com/klub.matijaljubek"><i class="fa fa-facebook"></i></a></li>
                            <li class="youtube"><a target="_blank" href="https://www.youtube.com/watch?v=M0XxYLrqdjc"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="footer-content">
                        <form role="form" id="footer-form">
                            <div class="form-group has-feedback">
                                <label class="sr-only" for="name2">Ime i prezime</label>
                                <input type="text" class="form-control" id="name2" placeholder="Ime i prezime" name="name2" required>
                                <i class="fa fa-user form-control-feedback"></i>
                            </div>
                            <div class="form-group has-feedback">
                                <label class="sr-only" for="email2">E-mail adresa</label>
                                <input type="email" class="form-control" id="email2" placeholder="E-mail adresa" name="email2" required>
                                <i class="fa fa-envelope form-control-feedback"></i>
                            </div>
                            <div class="form-group has-feedback">
                                <label class="sr-only" for="message2">Poruka</label>
                                <textarea class="form-control" rows="8" id="message2" placeholder="Poruka" name="message2" required></textarea>
                                <i class="fa fa-pencil form-control-feedback"></i>
                            </div>
                            <input type="submit" value="Pošalji" class="btn btn-default btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">Copyright © {{ date('Y') }}, made with <span class="glyphicon glyphicon-heart pulseAnim text-colored"></span> by <a href="https://github.com/gek0" target="_blank">Matija</a></p>
                </div>
            </div>
        </div>
    </div>

</footer> <!-- footer end -->

<!-- scripts -->
{{ HTML::script('js/jquery.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/bootstrap.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/modernizr.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/isotope.pkgd.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/jquery.backstretch.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/jquery.appear.js', array('charset' => 'utf-8')) }}
{{ HTML::script('https://maps.googleapis.com/maps/api/js?sensor=false', array('charset' => 'utf-8')) }}
{{ HTML::script('js/gmaps.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/initJS.js', array('charset' => 'utf-8')) }}

</body>
</html>
