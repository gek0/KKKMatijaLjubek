@include('publicLayouts.header')

<!-- section news start -->
<section class="section translucent-bg blue full-height-section">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="news" class="text-center title-offtop">Vijesti</h1>

        <section id="news_sort">
            <div class="row text-center" id="person_sort">
                <div class="col-md-12">
                    <a href="{{ url('tagovi') }}"><button class="btn btn-primary btn-square"><i class="fa fa-tags fa-med pr-10"></i> Lista svih tagova</button></a>
                </div>
                <div class="space"></div>
                <div class="formSort padded">
                    {{ Form::open(array('url' => 'vijesti/sort', 'method' => 'GET', 'id' => 'formSort', 'role' => 'form')) }}
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('sort_option', 'Sortiranje vijesti:') }}<br>
                                {{ Form::select('sort_option', array('Vrsta sortiranja...' => $sort_data),
                                                  $sort_category, array('class' => 'selectpicker show-tick', 'data-style' => 'btn-square', 'title' => 'Vrsta sortiranja...', 'data-size' => '5'))
                                }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('news_text_sort', 'Pretraga po tekstu vijesti:') }}
                                {{ Form::text('news_text_sort', $news_text_sort, array('id' => 'news_text', 'class' => 'form-control', 'placeholder' => 'Tekst vijesti...')) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </section> <!-- end news_sort section -->
        <div class="space"></div>

        <article class="article-container">
            @if(count($news_data->all()) > 0)
                @foreach(array_chunk($news_data->all(), 2) as $news)
                    <div class="row padded">
                        @foreach($news as $item)
                            <div class="col-md-6 news-all-content" id="news-{{ $item->id }}">
                                <div class="news-all-header">
                                    <h3 class="news-all-header-title">{{{ $item->news_title }}}</h3>
                                    @if($item->images->count() > 0)
                                        {{ HTML::image('/news_uploads/'.$item->id.'/'.$item->images->first()->file_name, imageAlt($item->images->first()->file_name), array('class' => 'thumbnail img-responsive')) }}
                                    @else
                                        {{ HTML::image('css/assets/images/logo_main_log.png', 'Nema slike', array('class' => 'thumbnail img-responsive')) }}
                                    @endif
                                </div> <!-- end news-all-header -->
                                <div class="data_info_full">
                                    <div class="row text-center">
                                        <div class="col-md-6" title="Datum objave">
                                            <span class="fa fa-calendar fa-big pr-10"></span>
                                            <span class="info-text">
                                                <time datetime="{{ $item->getDateCreatedFormatedHTML() }}">{{ $item->getDateCreatedFormated() }}</time>
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
                    Trenutno nema vijesti.
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