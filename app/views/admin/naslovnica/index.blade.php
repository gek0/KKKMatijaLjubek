<article class="data_individual" data-role="gallery_data">
    <div class="row">
        <div class="formInput">
            <h2 class="text-center">Slike naslovnice</h2>
            {{ Form::open(array('url' => 'admin/naslovnica', 'id' => 'novaNaslovnica', 'files' => true, 'role' => 'form')) }}
                <div class="form-group">
                    {{ Form::label('gallery_images', 'Dodaj nove slike za naslovnicu:') }}
                    {{ Form::file('gallery_images[]', array('multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'gallery_images', 'accept' => 'image/*', 'required')) }}
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block btn-lg btn-info">Dodaj slike <span class="glyphicon glyphicon-ok"></span></button>
                </div>
            {{ Form::close() }}
        </div>
    </div>

    @if($galleryData->count() > 0)
        <section id="image_gallery" data-role-link="{{ URL::to('admin/naslovnica/gallery-image-delete') }}">
            <hr>
            <div class="container-fluid">
                <div class="row padded text-center">
                    <h2>Galerija slika <small id="image_gallery_counter">{{ $galleryData->count() }}</small></h2>
                    @foreach($galleryData as $img)
                        <div class="col-lg-3 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                            <img data-original="{{ URL::to('/gallery_uploads/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="thumbnail img-responsive lazy" />
                            <button id="{{ $img->id }}" class="btn btn-danger btn-delete-image" title="Brisanje slike {{ $img->file_name }}"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                        <div class="clearfix visible-xs"></div>
                    @endforeach
                </div>
            </div>  <!-- end image gallery -->
        </section>
    @endif
</article> <!-- end gallery_data section -->

{{-- include session notification output --}}
@include('admin.notification')

{{ HTML::script('js/ajaxJS.js', array('charset' => 'utf-8')) }}
<script>
    $("#gallery_images").fileinput({
        showUpload: false,
        layoutTemplates: {
            main1: "{preview}\n" +
            "<div class=\'input-group {class}\'>\n" + "   " +
                "<div class=\'input-group-btn\'>\n" +
                    "{browse}\n" + "" +
                    "{remove}\n" +
                "</div>\n" +
                "{caption}\n" +
            "</div>"
        }
    });

    jQuery(document).ready(function(){
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