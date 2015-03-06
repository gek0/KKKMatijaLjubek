@include('publicLayouts.header')

<!-- section news start -->
<section class="section translucent-bg blue full-height-section">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="news" class="text-center title-offtop">Vijesti</h1>

        @if(count($newsData->all()) > 0)
            @foreach(array_chunk($newsData->all(), 2) as $news)
                <div class="row padded">
                    @foreach($news as $item)
                        ...
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="text-center">
                Trenutno nema vijesti.
            </div>
            <div class="space"></div>
        @endif

        <div class="text-center padded">
            <a href="{{ URL::to('/#news') }}"><button class="btn btn-primary btn-square"><i class="fa fa-angle-left fa-med pr-10"></i> Povratak na zadnje vijesti</button></a>
        </div>

    </div>
</section> <!-- section news end -->

@include('publicLayouts.footer')