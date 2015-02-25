<section id="news_data_all" data-role="news_data">
    @if(count($newsData->all()) > 0)
        @foreach(array_chunk($newsData->all(), 3) as $news)
            <div class="row padded">
                @foreach($news as $item)
                    <div class="col-md-4 news-all-content" id="news-{{ $item->id }}">
                        <div class="news-all-header">
                            <h3 class="news-all-header-title">{{{ $item->news_title }}}</h3>
                            @if($item->images->count() > 0)
                                {{ HTML::image('/news_uploads/'.$item->id.'/'.$item->images->first()->file_name, imageAlt($item->images->first()->file_name), array('class' => 'thumbnail img-responsive')) }}
                            @else
                                {{ HTML::image('css/assets/images/logo_main_log.png', 'Nema slike', array('class' => 'thumbnail img-responsive')) }}
                            @endif
                        </div> <!-- end news-all-header -->
                        <div class="data_info">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="glyphicon glyphicon-user" alt="Autor objave" title="Autor objave"></span>
                                    <span class="info-text">{{{ $item->author->username }}}</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="glyphicon glyphicon-calendar" alt="Datum objave" title="Datum objave"></span>
                                    <time datetime="{{ $item->getDateCreatedFormatedHTML() }}">{{ $item->getDateCreatedFormated() }}</time>
                                </div>
                            </div>
                        </div> <!-- end news info -->
                        <div class="news-all-body">
                            {{ Str::limit(BBCode::parse($item->news_body), 500) }}
                        </div> <!-- end news-all-body -->
                        <hr>
                        <div class="news-all-tools text-center">
                            <a href="{{ url('admin/vijesti/pregled/'.$item->slug) }}"><button class="btn btn-primary btn-info btn-half">Pregledaj <span class="glyphicon glyphicon-chevron-right"></span></button></a>
                          </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="pagination-layout pagination-centered">
            {{ $newsData->links() }}
        </div> <!-- end pagination -->
    @else
        <div class="text-center">
            <h3>Trenutno nema članaka.</h3>
            <a href="{{ url('admin/vijesti/nova') }}"><button class="btn btn-primary btn-info btn-half">Dodaj novi članak <span class="glyphicon glyphicon-plus"></span></button></a>
        </div>
    @endif
</section>

@if($errors->has())
    <div class="none" id="errorBag">
        @foreach($errors->all() as $error)
            <h3>{{ $error }}</h3>
        @endforeach
    </div>

    <script>
        jQuery(document).ready(function(){
            catchLaravelNotification('errorBag', 'warningNotif');
        });
    </script>
@endif
@if(Session::has('success'))
    <div class="none" id="successBag">
        <h3>{{ Session::get('success') }}</h3>
    </div>

    <script>
        jQuery(document).ready(function(){
            catchLaravelNotification('successBag', 'successNotif');
        });
    </script>
@endif

<script>
    jQuery(document).ready(function(){
        //set news header (title & logo) height equal (biggest dimension on page)
        var maxHeightHeader = 0;
        $(".news-all-header").each(function(){
            if ($(this).height() > maxHeightHeader) { maxHeightHeader = $(this).height(); }
        });
        $(".news-all-header").height(maxHeightHeader);

        //set whole news div height equal (biggest div height dimension on page)
        var maxHeightContent = 0;
        $(".news-all-content").each(function(){
            if ($(this).height() > maxHeightContent) { maxHeightContent = $(this).height(); }
        });
        $(".news-all-content").height(maxHeightContent);
    });
</script>