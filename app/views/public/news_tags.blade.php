@include('publicLayouts.header')

<!-- section news start -->
<section class="section translucent-bg blue full-height-section">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="news" class="text-center title-offtop">Vijesti</h1>
        <div class="text-center">
            <h3>Traženi tag: <strong>{{ $tag_data->tag }}</strong></h3>
            <a href="{{ url('tagovi') }}"><button class="btn btn-primary btn-square"><i class="fa fa-tags fa-med pr-10"></i> Lista svih tagova</button></a>
        </div>
        <div class="space"></div>

        <article class="article-container">
            @if(count($news_data->all()) > 0)
                @foreach(array_chunk($news_data->all(), 2) as $news)
                    <div class="row padded">
                        @foreach($news as $item)
                            <div class="col-md-6 news-all-content" id="news-{{ $item->id }}">
                                <div class="news-all-header">
                                    <h3 class="news-all-header-title">{{{ $item->news_title }}}</h3>
                                    @if($item->newsImage != '')
                                        {{ HTML::image('/news_uploads/'.$item->id.'/'.$item->newsImage, imageAlt($item->newsImage), array('class' => 'thumbnail img-responsive')) }}
                                    @else
                                        {{ HTML::image('css/assets/images/logo_main_log.png', 'Nema slike', array('class' => 'thumbnail img-responsive')) }}
                                    @endif
                                </div> <!-- end news-all-header -->
                                <div class="data_info_full">
                                    <div class="row text-center">
                                        <div class="col-md-6" title="Datum objave">
                                            <span class="fa fa-calendar fa-big pr-10"></span>
                                            <span class="info-text">
                                                <time datetime="{{ date('Y-m-d', strtotime($item->created_at)) }}">{{ date('d.m.Y. \u H:i\h', strtotime($item->created_at)) }}</time>
                                            </span>
                                        </div>
                                        <div class="col-md-6" title="Broj pregleda">
                                            <span class="fa fa-eye fa-big pr-10"></span>
                                            <span class="info-text">{{{ $item->num_visited }}}</span>
                                        </div>
                                    </div>
                                </div> <!-- end news info -->
                                <div class="news-all-body">
                                    {{ Str::limit(removeEmptyP(nl2p((new BBCParser)->unparse($item->news_body))), 500)  }}
                                </div> <!-- end news-all-body -->
                                <hr>
                                <div class="news-all-tools text-center">
                                    <a href="{{ url('vijesti/'.$item->slug) }}"><button class="btn btn-primary btn-square">Pročitaj članak</button></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="pagination-layout pagination-centered">
                    {{ $news_data->appends(Request::except('stranica'))->links() }}
                </div> <!-- end pagination -->
            @else
                <div class="text-center">
                    Trenutno nema vijesti s traženim tagom.
                </div>
                <div class="space"></div>
            @endif

            <div class="text-center padded">
                <a href="{{ URL::to('/#news') }}"><button class="btn btn-primary btn-square"><i class="fa fa-angle-left fa-med pr-10"></i> Povratak na zadnje vijesti</button></a>
            </div>

        </article> <!-- end article-container -->
    </div>
</section> <!-- section news end -->

@include('publicLayouts.footer')