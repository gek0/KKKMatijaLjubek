@include('publicLayouts.header')

<!-- section tags start -->
<section class="section translucent-bg blue full-height-section">
    <div class="container object-non-visible" data-animation-effect="fadeIn">
        <h1 id="tags" class="text-center title-offtop">Lista svih tagova</h1>
        <article class="article-container padded">
            <div class="space"></div>

            {{ Form::open(array('url' => '', 'id' => 'live-search', 'role' => 'form')) }}
                <div class="row">
                    <div class="col-md-5 text-center centered-col">
                        <div class="form-group">
                            {{ Form::label('filter', 'Pronađite tag:') }}
                            {{ Form::text('filter', null, array('class' => 'form-control', 'id' => 'filter', 'placeholder' => 'Tag...')) }}
                            <span id="filter-count"></span>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}

            @if($tagsData->count() > 0)
                <div class="text-center tags-collection">
                    <ul class="tags">
                        @foreach($tagsData as $tag)
                            <a href="{{ URL::to('vijesti/tag/'.$tag->slug) }}"><li class="marginated-tags">{{ $tag->tag }}</li></a>
                        @endforeach
                    </ul>
                </div>
                <div class="space"></div>
            @else
                <div class="text-center">
                    Trenutno nema tagova vijesti.
                </div>
                <div class="space"></div>
            @endif

            <div class="text-center padded">
                <a href="{{ URL::to('vijesti') }}"><button class="btn btn-primary btn-square"><i class="fa fa-angle-left fa-med pr-10"></i> Povratak na vijesti</button></a>
            </div>

        </article> <!-- article-container end -->
    </div>
</section> <!-- section tags end -->


@include('publicLayouts.footer')

