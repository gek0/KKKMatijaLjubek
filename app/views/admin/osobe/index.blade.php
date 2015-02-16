<section id="persons_data_all" data-role="persons_data">
    @if(count($personsData->all()) > 0)
        @foreach(array_chunk($personsData->all(), 3) as $person)
            <div class="row padded">
                @foreach($person as $item)
                    <div class="col-md-4 persons-all-content" id="person-{{ $item->id }}">
                        <div class="persons-all-header">
                            <h3 class="persons-all-header-title">{{{ $item->person_full_name }}}</h3>
                            @if($item->images->count() > 0)
                                {{ HTML::image('/person_uploads/'.$item->id.'/'.$item->images->first()->file_name, imageAlt($item->images->first()->file_name), array('class' => 'circle-thumbnail img-responsive img-circle')) }}
                            @else
                                {{ HTML::image('css/assets/images/logo_main_log.png', 'Nema slike', array('class' => 'thumbnail img-responsive')) }}
                            @endif
                        </div> <!-- end news-all-header -->
                        <div class="data_info">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="glyphicon glyphicon-star" alt="Kategorija osobe" title="Kategorija osobe"></span>
                                    <span class="info-text">{{{ $item->category->category_name }}}</span>
                                </div>
                            </div>
                        </div> <!-- end news info -->
                        <hr>
                        <div class="persons-all-tools text-center">
                            <a href="{{ url('admin/osobe/pregled/'.$item->id) }}"><button class="btn btn-primary btn-info btn-half">Pregledaj <span class="glyphicon glyphicon-chevron-right"></span></button></a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="pagination-layout pagination-centered">
            {{ $personsData->links() }}
        </div> <!-- end pagination -->
    @else
        <div class="text-center">
            <h3>Trenutno nema sportaša i trenera.</h3>
            <a href="{{ url('admin/osobe/nova') }}"><button class="btn btn-primary btn-info btn-half">Dodaj novu osobu <span class="glyphicon glyphicon-plus"></span></button></a>
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