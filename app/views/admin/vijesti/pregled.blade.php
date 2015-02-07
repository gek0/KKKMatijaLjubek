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

<article class="news_data_individual" data-role="news_data">
    <div class="page-header">
        <h1>{{ $newsData->news_title }}</h1>
    </div>
    <div class="news_data_info">
        <div class="row">
            <div class="col-md-4">
                <span class="glyphicon glyphicon-user glyphicon-large" alt="Autor objave" title="Autor objave"></span>
                <span class="info-text">{{ $newsData->author->username }}</span>
            </div>
            <div class="col-md-4">
                <span class="glyphicon glyphicon-calendar glyphicon-large" alt="Datum objave" title="Datum objave"></span>
                <span class="info-text">
                    <time datetime="{{ $newsData->getDateFormated() }}">{{ $newsData->getDateFormated() }}</time>
                </span>
            </div>
            <div class="col-md-4">
                <span class="glyphicon glyphicon-eye-open glyphicon-large" alt="Broj pregleda" title="Broj pregleda"></span>
                <span class="info-text">{{ $newsData->num_visited }} pregleda</span>
            </div>
        </div>
    </div>
    <div class="row padded">
        <div class="col-md-9">
            {{ BBCode::parse($newsData->news_body) }}
        </div>
        <div class="col-md-3">
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <span class="glyphicon glyphicon-tags glyphicon-large" alt="Tagovi" title="Tagovi"></span> <span class="info-text">Tagovi članka</span>
                </div>
                <div class="sidebar-body">
                    <ul class="tags">
                        @foreach($newsData->tags as $tag)
                            <li>{{ $tag->tag }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <span class="glyphicon glyphicon-cog glyphicon-large" alt="Alati" title="Alati"></span> <span class="info-text">Admin alati</span>
                </div>
                <div class="sidebar-body">
                    <a href="{{ URL::to('admin/vijesti/izmjena/'.$newsData->id) }}" id="newsEdit"><button class="btn btn-primary btn-info btn-half"><span class="glyphicon glyphicon-pencil"></span> Uredi članak</button></a>
                    <button class="btn btn-primary btn-danger btn-half" id="newsDelete"><span class="glyphicon glyphicon-trash"></span> Obriši članak</button>
                </div>
            </div>
        </div>
    </div>

    @if($newsData->images->count() > 0)
    <section id="news_image_gallery" data-role-link="{{ URL::to('admin/vijesti/galleryimagedelete') }}">
        <hr>
        <div class="container-fluid">
            <div class="row padded text-center">
                <h2>Galerija slika  <small id="image_gallery_counter">{{ $newsData->images->count() }}</small></h2>
                    @foreach($newsData->images as $img)
                        <div class="col-lg-3 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                            <img src="{{ $img->file_location.$img->file_name }}" class="thumbnail img-responsive">
                            <button id="{{ $img->id }}" class="btn btn-danger btn-delete-image" title="Brisanje slike {{ $img->file_name }}"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                        <div class="clearfix visible-xs"></div>
                    @endforeach
            </div>
        </div>  <!-- end image gallery -->
    </section>
    @endif

</article> <!-- end article of news_data -->

{{ HTML::script('js/ajaxJS.js', array('charset' => 'utf-8')) }}

<script>
    jQuery(document).ready(function(){
        /*
        *   delete news confirm
        */
        $("#newsDelete").click(function(){
            bootbox.confirm("Stvarno želiš obrisati ovaj članak?", function(result) {
                if(result == true){
                    window.location = '{{ URL::to('admin/vijesti/brisanje/'.$newsData->id) }}';
                }
            });
        });
    });
</script>