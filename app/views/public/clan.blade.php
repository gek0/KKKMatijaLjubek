@include('publicLayouts.header')

<!-- content directives start -->
@if($previousPerson == true)
    <div class="previousContent">
        <a href="{{ URL::to('clan/'.$previousPerson['slug']) }}" title="{{ $previousPerson['full_name'] }}"><i class="fa fa-arrow-left fa-gig"></i></a>
    </div>
@endif
@if($nextPerson == true)
    <div class="nextContent">
        <a href="{{ URL::to('clan/'.$nextPerson['slug']) }}" title="{{ $nextPerson['full_name'] }}"><i class="fa fa-arrow-right fa-gig"></i></a>
    </div>
@endif
<!-- content directives end -->

<!-- section person start -->
<section class="section translucent-bg blue full-height-section">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="person" class="text-center title-offtop">{{ $personData->person_full_name }}</h1>
        <article class="article-container">

            <div class="data_info">
                <div class="row">
                    <div class="col-md-4" title="Kategorija">
                        <span class="fa fa-star fa-big pr-10"></span>
                        <span class="info-text">{{{ $personData->category->category_name }}}</span>
                    </div>
                    <div class="col-md-4" title="Datum rođenja">
                        <span class="fa fa-calendar fa-big pr-10"></span>
                        <span class="info-text">
                            <time datetime="{{ $personData->getDateBirthdayFormatedHTML() }}">{{ $personData->getDateBirthdayFormated() }}</time>
                        </span>
                    </div>
                    <div class="col-md-4">
                        <i class="fa fa-search-plus fa-big pr-10 js-active-link" title="Povećaj font teksta" id="fontUp"></i>
                        <i class="fa fa-search-minus fa-big pr-10 js-active-link" title="Smanji font teksta" id="fontDown"></i>
                    </div>
                </div>
            </div> <!-- end data_info -->

            <div class="row padded">
                <div class="col-md-12" id="content-description-body">
                    {{ removeEmptyP(nl2p(BBCode::parse($personData->person_description))) }}
                </div>
            </div>
            <hr>

            @if($personData->images->count() > 0)
                <section id="person_image_gallery">
                    <div class="container-fluid">
                        <div class="row padded text-center">
                            <h2>Galerija slika <small id="image_gallery_counter" class="text-colored">{{ $personData->images->count() }}</small></h2>
                            @foreach($personData->images as $img)
                                <div class="col-lg-3 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                                    <a href="{{ URL::to('/person_uploads/'.$personData->id.'/'.$img->file_name) }}" data-imagelightbox="gallery-images">
                                        <img data-original="{{ URL::to('/person_uploads/'.$personData->id.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="thumbnail img-responsive lazy" />
                                    </a>
                                </div>
                                <div class="clearfix visible-xs"></div>
                            @endforeach
                        </div>
                    </div>  <!-- end image gallery -->
                </section>
            @else
                <section id="person_image_gallery">
                    <div class="container-fluid">
                        <div class="row padded text-center">
                            <h3>Trenutno nema slika.</h3>
                        </div>
                    </div>
                </section>
            @endif

            <div class="space"></div>
            <div class="text-center padded">
                <a href="{{ URL::to('/#persons') }}"><button class="btn btn-primary btn-square"><i class="fa fa-angle-left fa-med pr-10"></i> Povratak na članove</button></a>
            </div>

        </article> <!-- end article-container -->
    </div>
</section> <!-- section person end -->

@include('publicLayouts.footer')