@include('publicLayouts.header')

<!-- content directives start -->
@if($previousNews == true)
    <div class="previousContent">
        <a href="{{ URL::to('vijesti/'.$previousNews['slug']) }}" title="{{ $previousNews['news_title'] }}"><i class="fa fa-arrow-left fa-gig"></i></a>
    </div>
@endif
@if($nextNews == true)
    <div class="nextContent">
        <a href="{{ URL::to('vijesti/'.$nextNews['slug']) }}" title="{{ $nextNews['news_title'] }}"><i class="fa fa-arrow-right fa-gig"></i></a>
    </div>
@endif
<!-- content directives end -->

<!-- section news start -->
<section class="section translucent-bg blue full-height-section">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="news" class="text-center title-offtop">{{ $newsData->news_title }}</h1>
        <article class="article-container">

            <div class="data_info">
                <div class="row">
                    <div class="col-md-4" title="Datum objave">
                        <span class="fa fa-calendar fa-big pr-10"></span>
                        <span class="info-text">
                            <time datetime="{{ $newsData->getDateCreatedFormatedHTML() }}">{{ $newsData->getDateCreatedFormated() }}</time>
                        </span>
                    </div>
                    <div class="col-md-4" title="Broj pregleda">
                        <span class="fa fa-eye fa-big pr-10"></span>
                        <span class="info-text">{{{ $newsData->num_visited }}}</span>
                    </div>
                    <div class="col-md-4">
                        <i class="fa fa-search-plus fa-big pr-10 js-active-link" title="Povećaj font teksta" id="fontUp"></i>
                        <i class="fa fa-search-minus fa-big pr-10 js-active-link" title="Smanji font teksta" id="fontDown"></i>
                    </div>
                </div>
            </div> <!-- end data_info -->

            <div class="row padded">
                <div class="col-md-9" id="content-description-body">
                    {{ removeEmptyP(nl2p((new BBCParser)->parse($newsData->news_body))) }}
                </div>
                <div class="col-md-3">
                    <div class="sidebar-content">
                        <div class="sidebar-header" title="Tagovi članka">
                            <i class="fa fa-tags fa-big pr-10"></i> <span class="info-text">Tagovi članka <small>({{ $newsData->tags->count() }})</small></span>
                        </div>
                        <div class="sidebar-body">
                            @if($newsData->tags->count() > 0)
                                <ul class="tags">
                                    @foreach($newsData->tags as $tag)
                                        <a href="{{ URL::to('vijesti/tag/'.$tag->slug) }}"><li>{{ $tag->tag }}</li></a>
                                    @endforeach
                                </ul>
                            @else
                                <p>Trenutno nema tagova.</p>
                            @endif
                        </div>
                    </div>
                    <div class="sidebar-content">
                        <div class="sidebar-header" title="Društvene mreže">
                            <i class="fa fa-facebook fa-big pr-10"></i>
                            <i class="fa fa-twitter fa-big pr-10"></i>
                            <span class="info-text">Društvene mreže</span>
                        </div>
                        <div class="sidebar-body line-fx">
                            {{ Shareable::facebook($options = array('url' => Request::url())) }}
                            {{ Shareable::twitter($options = array('url' => Request::url(),
                                                                    'text' => Str::limit($newsData->news_title, 50)
                                                             )
                                                  ) }}
                        </div>
                    </div>
                    @if(Auth::user())
                        <div class="sidebar-content">
                            <div class="sidebar-header" title="Admin alati">
                                <i class="fa fa-cog fa-big pr-10"></i> <span class="info-text">Admin alati</span>
                            </div>
                            <div class="sidebar-body text-center">
                                <a href="{{ URL::to('admin/vijesti/izmjena/'.$newsData->slug) }}" target="_blank"><button class="btn btn-primary btn-square"><i class="fa-med pr-10 fa fa-pencil"></i> Uredi članak</button></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <hr>

            @if($newsData->images->count() > 0)
                <section id="news_image_gallery">
                    <div class="container-fluid">
                        <div class="row padded text-center">
                            <h2>Galerija slika <small id="image_gallery_counter" class="text-colored">{{ $newsData->images->count() }}</small></h2>
                            @foreach($newsData->images as $img)
                                <div class="col-lg-3 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                                    <a href="{{ URL::to('/news_uploads/'.$newsData->id.'/'.$img->file_name) }}" data-imagelightbox="gallery-images">
                                        <img data-original="{{ URL::to('/news_uploads/'.$newsData->id.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="thumbnail img-responsive lazy" />
                                    </a>
                                </div>
                                <div class="clearfix visible-xs"></div>
                            @endforeach
                        </div>
                    </div>  <!-- end image gallery -->
                </section>
            @else
                <section id="news_image_gallery">
                    <div class="container-fluid">
                        <div class="row padded text-center">
                            <h3>Trenutno nema slika.</h3>
                        </div>
                    </div>
                </section>
            @endif

            <div class="space"></div>
            <div class="text-center padded">
                <a href="{{ URL::previous() }}"><button class="btn btn-primary btn-square"><i class="fa fa-angle-left fa-med pr-10"></i> Povratak na vijesti</button></a>
            </div>

        </article> <!-- end article-container -->
    </div>
</section> <!-- section news end -->

@include('publicLayouts.footer')