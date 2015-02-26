<article class="data_individual" data-role="person_data">
    <div class="page-header">
        <h1>{{{ $personData->person_full_name }}}</h1>
    </div>
    <div class="data_info">
        <div class="row">
            <div class="col-md-4">
                <span class="glyphicon glyphicon-star glyphicon-large" alt="Kategorija osobe" title="Kategorija osobe"></span>
                <span class="info-text">{{{ $personData->category->category_name }}}</span>
            </div>
            <div class="col-md-4">
                <span class="glyphicon glyphicon-calendar glyphicon-large" alt="Datum rođenja" title="Datum rođenja"></span>
                <span class="info-text">
                    <time datetime="{{ $personData->getDateBirthdayFormated() }}">{{ $personData->getDateBirthdayFormated() }}</time>
                </span>
            </div>
        </div>
    </div>
    <div class="row padded">
        <div class="col-md-9">
            {{ removeEmptyP(nl2p(BBCode::parse($personData->person_description))) }}
        </div>
        <div class="col-md-3">
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <span class="glyphicon glyphicon-cog glyphicon-large" alt="Alati" title="Alati"></span> <span class="info-text">Admin alati</span>
                </div>
                <div class="sidebar-body">
                    <a href="{{ URL::to('admin/osobe/izmjena/'.$personData->slug) }}" id="personEdit"><button class="btn btn-primary btn-info btn-half"><span class="glyphicon glyphicon-pencil"></span> Uredi osobu</button></a>
                    <button class="btn btn-primary btn-danger btn-half" id="personDelete"><span class="glyphicon glyphicon-trash"></span> Obriši osobu</button>
                </div>
            </div>
        </div>
    </div>

    @if($personData->images->count() > 0)
        <section id="person_image_gallery" data-role-link="{{ URL::to('admin/osobe/gallery-image-delete') }}">
            <hr>
            <div class="container-fluid">
                <div class="row padded text-center">
                    <h2>Galerija slika  <small id="image_gallery_counter">{{ $personData->images->count() }}</small></h2>
                    @foreach($personData->images as $img)
                        <div class="col-lg-3 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                            <img data-original="{{ URL::to('/person_uploads/'.$personData->id.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="thumbnail img-responsive lazy" />
                            <button id="{{ $img->id }}" class="btn btn-danger btn-delete-image" title="Brisanje slike {{ $img->file_name }}"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                        <div class="clearfix visible-xs"></div>
                    @endforeach
                </div>
            </div>  <!-- end image gallery -->
        </section>
    @endif
</article> <!-- end article of person_data -->

{{-- include session notification output --}}
@include('admin.notification')

{{ HTML::script('js/ajaxJS.js', array('charset' => 'utf-8')) }}
<script>
    jQuery(document).ready(function(){
        /*
         *   delete person confirm
         */
        $("#personDelete").click(function(){
            bootbox.confirm("Stvarno želiš obrisati ovu osobu?", function(result) {
                if(result == true){
                    window.location = '{{ URL::to('admin/osobe/brisanje/'.$personData->slug) }}';
                }
            });
        });

        /*
         *   add lazy loading to images out of screen viewport
         */
        $(function() {
            $("img.lazy").lazyload({
                effect : "fadeIn"
            });
        });
    });
</script>