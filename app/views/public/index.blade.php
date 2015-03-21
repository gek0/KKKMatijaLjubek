<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>KKK Matija Ljubek</title>
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
                                        <li><a href="#regatta-program">Raspis</a></li>
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
        @if($gallery_count > 0)
            @for($i = 0; $i < $gallery_count; $i++)
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
        @if($gallery_count > 0)
            @for($i = 0; $i < $gallery_count; $i++)
                @if($i == 0)
                    <div class="item active">
                        <div class="fill" style="background-image:url('{{ URL::to('gallery_uploads/'.$gallery_data[$i]->file_name) }}');"></div>
                        <div class="carousel-caption">
                            <h2>{{ $gallery_data[$i]->caption }}</h2>
                        </div>
                    </div>
                @else
                    <div class="item">
                        <div class="fill" style="background-image:url('{{ URL::to('gallery_uploads/'.$gallery_data[$i]->file_name) }}');"></div>
                        <div class="carousel-caption">
                            <h2>{{ $gallery_data[$i]->caption }}</h2>
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
<section class="section clearfix object-non-visible" data-animation-effect="fadeIn">
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
                                        <p>Život i djelo Matije Ljubeka možete pogledati <a href="{{ url('file_uploads/ljubek.pdf') }}" target="_blank" title="Život i djelo">ovdje</a>.</p>
                                        <p>Pravilnik nagrade Matija Ljubek možete pogledati <a href="{{ url('file_uploads/pravilnik.pdf') }}" target="_blank" title="Pravilnik">ovdje</a>.</p>
                                        <p>Pjesmu Matiji Ljubeku možete pogledati <a href="{{ url('file_uploads/pjesma.pdf') }}" target="_blank" title="Pjesma">ovdje</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- section about-us end -->

<!-- section news start -->
<section class="section translucent-bg blue">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="news" class="text-center title">Zadnje vijesti</h1>
        <div class="row">
            @if($news_data->count() > 0)
                <div id="main-news-slider" class="liquid-slider">
                    @foreach($news_data as $news)
                        <article id="news-post-{{ $news->id }}">
                            <h3 class="text-center">{{ $news->news_title }}</h3>
                            <p>{{ Str::limit(removeEmptyP(nl2p((new BBCParser)->unparse($news->news_body))), 500)  }}</p>

                            @if($news->tags->count() > 0)
                                <div class="text-center tags-collection">
                                    <ul class="tags">
                                        @foreach($news->tags as $tag)
                                            <a href="{{ URL::to('vijesti/tag/'.$tag->slug) }}"><li>{{ $tag->tag }}</li></a>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="space"></div>
                            @endif

                            <div class="text-center">
                                <a href="{{ URL::to('vijesti/'.$news->slug) }}"><button class="btn btn-primary btn-square">Pročitaj više</button></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <h3>Trenutno nema novih vijesti.</h3>
                </div>
            @endif
        </div>
    </div>
</section>

<section class="default-bg space blue">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="link-eff cl-link-effect">
                    <a href="{{ URL::to('vijesti') }}" id="news-data-link"><h4>Prikaži sve vijesti</h4></a>
                </div>
            </div>
        </div>
    </div>
</section> <!-- section news end -->

<!-- section persons start -->
<section class="section">
    <div class="container">
        <h1 class="text-center title" id="persons">Članovi kluba</h1>
        <div class="separator"></div>
        <p class="lead text-center">Sportaši i treneri u Kajak Kanu Klub Matija Ljubek.</p>
        <br>
        <div class="row object-non-visible" data-animation-effect="fadeIn">
            <div class="col-md-12">
                <!-- isotope filters start -->
                <div class="filters text-center">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#" data-filter="*">Svi</a></li>
                        @foreach($person_categories as $category)
                            <li><a href="#" data-filter=".{{ safe_name($category->category_name) }}">{{ $category->category_name }}i</a></li>
                        @endforeach
                    </ul>
                </div> <!-- isotope filters end -->

                <!-- persons list start -->
                <div class="col-md-12 text-center isotope-item-empty-filter"><h3></h3></div>

                <div class="isotope-container row grid-space-20">
                    @foreach($persons_data as $person)
                        <div class="col-sm-6 col-md-3 isotope-item {{ safe_name($person->category->category_name) }}">
                            <div class="image-box">
                                <div class="overlay-container">
                                    @if($person->images->count() > 0)
                                        {{ HTML::image('/person_uploads/'.$person->id.'/'.$person->images->first()->file_name, imageAlt($person->images->first()->file_name), array('class' => 'img-responsive lazy')) }}
                                    @else
                                        {{ HTML::image('css/assets/images/logo_main_log.png', 'Nema slike', array('class' => 'thumbnail img-responsive lazy')) }}
                                    @endif
                                    <a href="{{ URL::to('clan/'.$person->slug) }}" class="overlay">
                                        <i class="fa fa-search-plus"></i>
                                        <span>{{ $person->category->category_name }}</span>
                                    </a>
                                </div>
                                <a href="{{ URL::to('clan/'.$person->slug) }}" class="btn btn-overlay btn-block">{{ $person->person_full_name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- persons list end -->
            </div>
        </div>
    </div>
</section> <!-- section persons end -->

<!-- section young-members start -->
<section class="section translucent-bg bg-image-1 blue">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="young-members" class="title text-center">Škola kajaka i kanua</h1>
        <div class="space"></div>

        <div class="row text-center">
            <div class="col-md-12">
                <p>Pozivamo sve dječake i djevojčice uzrasta od 9 do 14 godina da nam se pridruže u školi kajaka i kanua na mirnim vodama.</p>
            </div>
        </div>
        <div class="space"></div>

        <div class="row text-center">
            <div class="col-md-12">
                <p>Primjere treninga možete pogledati <a href="{{ url('file_uploads/trening.pdf') }}" target="_blank" title="Primjeri treninga">ovdje</a>.</p>
                <p>Selekciju i metodiku poduke kanuista možete pogledati <a href="{{ url('file_uploads/poduka.pdf') }}" target="_blank" title="Poduka kanuista">ovdje</a>.</p>
                <p>Planiranje godišnjeg ciklusa treninga možete pogledati <a href="{{ url('file_uploads/planiranje.pdf') }}" target="_blank" title="Planiranje">ovdje</a>.</p>
            </div>
        </div>

    </div>
</section> <!-- section young-members end -->

<!-- section regatta-program start -->
<section class="section">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="regatta-program" class="title text-center">Raspis/Regatta program</h1>
        <div class="space"></div>
            <p>Dragi prijatelji i poštovani sportaši,<br><br>

            Pozivamo Vas na još jedno Otvoreno prvenstvo grada Zagreba i 14. međunarodnu memorijalnu utrku "Matija Ljubek"<br> koja će se održati 30. 05. 2015 na ŠRC Jarun s početkom u 10h.<br>
            Prijave za sudjelovanje moraju biti dostavljene organizatoru KKK " Matija Ljubek" najkasnije do 15.05.2015 do 16h na adresu:<br>
            KAJAK KANU KLUB "MATIJA LJUBEK" Aleja Matije Ljubeka 5, ŠRC Jarun 10 000 Zagreb, Hrvatska / Croatia Tel /fax: +385 1 301 12 02<br>
            Za ostale pojedinosti vezane za regatu slobodno nam se javite na e-mail ili putem inboxa na facebooku. Radujemo se Vašem dolasku!<br>
            Putem e-maila: {{ HTML::mailto('kkkmatijaljubek@yahoo.com') }}</p><br>

            <p>Dear Sport Friends,<br><br>

            The Kayak-Canoe club "Matija Ljubek" and town Zagreb are pleased to inform you that 14th Memorial race "Matija Ljubek" will be held at Regatta Course in Jarun Sport Centre on May 30, 2015,
            and corially invites all Sportsman of Kayaking and Canoeing to take a part in this tradicional reggata.<br>
            We are looking forward to welcome all of you to our regatta.<br>
            Your's friendly, KKK "Matija Ljubek"</p>

            <div class="space"></div>
            <p>Raspis međunarodne regate Zagreb i 14. Memorijal Matija Ljubek skinite <a href="{{ url('file_uploads/Raspis2015web.pdf') }}" target="_blank" title="Program regate">ovdje</a>.</p>
            <p>Download Regatta program and 14th Memorial Matija Ljubek race <a href="{{ url('file_uploads/Raspis2015ENweb.pdf') }}" target="_blank" title="Regatta program">here</a>.</p>
    </div>
</section> <!-- section regatta-program end -->


<!-- section map start -->
<section class="section" id="map">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <div class="space"></div>
        <noscript>Morate imati omogućen JavaScript u Vašem internet pregledniku kako bi se prikazala mapa, hvala na razumijevanju.</noscript>
    </div>
</section> <!-- section map end -->

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

                        <!-- facebook SDK container -->
                        <div class="fb-like" data-href="https://www.facebook.com/matijaljubek2000" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>

                        <div class="social-links-container">
                            <span class="social-link tooltip-bottom" data-tooltip="KKK Matija Ljubek">
                                <a href="https://www.facebook.com/matijaljubek2000" target="_blank">{{ HTML::image('css/assets/images/social_links/facebook.png', 'Facebook', array('class' => 'img-responsive')) }}</a>
                            </span>
                            <span class="social-link tooltip-bottom" data-tooltip="Sjećanje na Matiju Ljubeka">
                                <a href="https://www.youtube.com/watch?v=kOnh_5DVBMI" target="_blank">{{ HTML::image('css/assets/images/social_links/youtube.png', 'YouTube', array('class' => 'img-responsive')) }}</a>
                            </span>
                            <span class="social-link tooltip-bottom" data-tooltip="Memorijalna utrka Matija Ljubek">
                                <a href="https://www.youtube.com/watch?v=M0XxYLrqdjc" target="_blank">{{ HTML::image('css/assets/images/social_links/youtube.png', 'YouTube', array('class' => 'img-responsive')) }}</a>
                            </span>
                            <span class="social-link tooltip-bottom" data-tooltip="O Matiji Ljubeku">
                                <a href="http://en.wikipedia.org/wiki/Matija_Ljubek" target="_blank">{{ HTML::image('css/assets/images/social_links/wikipedia.png', 'Wikipedia', array('class' => 'img-responsive')) }}</a>
                            </span>
                            <span class="social-link tooltip-bottom" data-tooltip="KKK Matija Ljubek RSS">
                                <a href="{{ URL::to('rss') }}" target="_blank">{{ HTML::image('css/assets/images/social_links/rss.png', 'RSS', array('class' => 'img-responsive')) }}</a>
                            </span><br>
                            <span class="social-link tooltip-bottom" data-tooltip="Hrvatski Olimpijski Odbor">
                                <a href="http://www.hoo.hr/hr/" target="_blank">{{ HTML::image('css/assets/images/social_links/hoo.png', 'HOO', array('class' => 'img-responsive')) }}</a>
                            </span>
                            <span class="social-link tooltip-bottom" data-tooltip="International Canoe Federation">
                                <a href="http://www.canoeicf.com/icf/" target="_blank">{{ HTML::image('css/assets/images/social_links/icf.png', 'ICF', array('class' => 'img-responsive')) }}</a>
                            </span>
                            <span class="social-link tooltip-bottom" data-tooltip="Hrvatski Kajakaški Savez">
                                <a href="http://www.kajak.hr/" target="_blank">{{ HTML::image('css/assets/images/social_links/hks.png', 'HKS', array('class' => 'img-responsive')) }}</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="footer-content">
                       {{ Form::open(array('url' => 'kontakt', 'role' => 'form', 'id' => 'footer-form')) }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('full_name', 'Ime i prezime:') }}
                                        {{ Form::text('full_name', null, array('class' => 'form-control', 'placeholder' => 'Ime i prezime', 'id' => 'full_name', 'required')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('email', 'E-mail adresa:') }}
                                        {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail adresa', 'id' => 'email', 'required')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('message', 'Poruka:') }}
                                {{ Form::textarea('message', null, array('class' => 'form-control', 'placeholder' => 'Poruka', 'id' => 'message')) }}
                            </div>
                            <div class="form-group text-center captcha">
                                {{ Form::captcha() }}
                            </div>
                            <div class="text-center" id="contact-output">
                                <div class="alert" role="alert" id="contact-output-inner">
                                    <div id="contact-output-message"></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-square-alter" id="contactSubmit">Pošalji e-mail</button>
                            </div>
                       {{ Form::close() }}
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
{{ HTML::script('js/jquery.easing.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/jquery.touchSwipe.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/jquery.liquid-slider.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/jquery.lazyload.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/imagelightbox.min.js', array('charset' => 'utf-8')) }}
{{ HTML::script('https://maps.googleapis.com/maps/api/js?sensor=false', array('charset' => 'utf-8')) }}
{{ HTML::script('js/gmaps.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/emailAjax.js', array('charset' => 'utf-8')) }}
{{ HTML::script('js/initJS.js', array('charset' => 'utf-8')) }}

</body>
</html>
