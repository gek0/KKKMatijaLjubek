<div class="row">
    <div class="formInput">
        <h2 class="text-center">Nova vijest</h2>
        {{ Form::open(array('url' => 'admin/vijesti/nova', 'id' => 'novaVijest', 'files' => true, 'enctype' => 'multipart/form-data', 'role' => 'form')) }}
        <div class="form-group">
            {{ Form::label('news_title', 'Naslov vijesti:') }}
            {{ Form::text('news_title', null, array('class' => 'form-control', 'placeholder' => 'Naslov vijesti', 'id' => 'news_title', 'required')) }}
        </div>
        <div class="form-group">
            {{ Form::label('news_body', 'Tekst vijesti:') }}
            {{ Form::textarea('news_body', null, array('class' => 'form-control', 'placeholder' => 'Tekst vijesti', 'id' => 'codeEditor')) }}
        </div>
        <div class="form-group">
            {{ Form::label('news_images', 'Slike vijesti:') }}
            {{ Form::file('news_images[]', array('multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'news_images', 'accept' => 'image/*')) }}
        </div>
        <div class="form-group">
            {{ Form::label('news_tags', 'Tagovi vijesti: ("Enter" za unos taga)') }}
            {{ Form::select('tags[]', array(), null, array('placeholder' => 'Tagovi vijesti', 'multiple' => 'true', 'id' => 'news_tags', 'data-role' => 'tagsinput')) }}
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block btn-lg btn-info">Objavi vijest <span class="glyphicon glyphicon-ok"></span></button>
        </div>
        {{ Form::close() }}
    </div>
</div>


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

<script>
    $("#news_images").fileinput({
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
</script>