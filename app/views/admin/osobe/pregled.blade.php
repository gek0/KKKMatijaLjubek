<article class="data_individual" data-role="person_data">
    <div class="page-header">
        <h1>{{{ $person_data->person_full_name }}}</h1>
    </div>
    <div class="data_info">
        <div class="row">
            <div class="col-md-4">
                <span class="glyphicon glyphicon-star glyphicon-large" title="Kategorija osobe"></span>
                <span class="info-text">{{{ $person_data->category->category_name }}}</span>
            </div>
            <div class="col-md-4">
                <span class="glyphicon glyphicon-calendar glyphicon-large" title="Datum rođenja"></span>
                <span class="info-text">
                    <time datetime="{{ $person_data->getDateBirthdayFormatedHTML() }}">{{ $person_data->getDateBirthdayFormated() }}</time>
                </span>
            </div>
        </div>
    </div>
    <div class="row padded">
        <div class="col-md-9">
            {{ removeEmptyP(nl2p((new BBCParser)->parse($person_data->person_description))) }}
        </div>
        <div class="col-md-3">
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <span class="glyphicon glyphicon-cog glyphicon-large" title="Alati"></span> <span class="info-text">Admin alati</span>
                </div>
                <div class="sidebar-body">
                    <a href="{{ URL::to('admin/osobe/izmjena/'.$person_data->slug) }}" id="personEdit"><button class="btn btn-primary btn-info btn-half"><span class="glyphicon glyphicon-pencil"></span> Uredi osobu</button></a>
                    <button class="btn btn-primary btn-danger btn-half" id="personDelete"><span class="glyphicon glyphicon-trash"></span> Obriši osobu</button>
                </div>
            </div>
        </div>
    </div>

    @if($person_data->images->count() > 0)
        <section id="image_gallery" data-role-link="{{ URL::to('admin/osobe/gallery-image-delete') }}">
            <hr>
            <div class="container-fluid">
                <div class="row padded text-center">
                    <h2>Galerija slika  <small id="image_gallery_counter">{{ $person_data->images->count() }}</small></h2>
                    @foreach($person_data->images as $img)
                        <div class="col-lg-3 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                            <a href="{{ URL::to('/person_uploads/'.$person_data->id.'/'.$img->file_name) }}" data-imagelightbox="gallery-images">
                                <img data-original="{{ URL::to('/person_uploads/'.$person_data->id.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="thumbnail img-responsive lazy" />
                            </a>
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
                    window.location = '{{ URL::to('admin/osobe/brisanje/'.$person_data->slug) }}';
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