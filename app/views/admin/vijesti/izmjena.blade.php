<div class="row">
    <div class="formInput">
        <h2 class="text-center">Izmjena vijesti<br> <b>{{ $news_data->news_title }}</b></h2>
        {{ Form::open(array('url' => 'admin/vijesti/izmjena/'.$news_data->slug, 'id' => 'izmjeniVijest', 'files' => true, 'role' => 'form')) }}
        <div class="form-group">
            {{ Form::label('news_title', 'Naslov vijesti:') }}
            {{ Form::text('news_title', $news_data->news_title, array('class' => 'form-control', 'placeholder' => 'Naslov vijesti', 'id' => 'news_title', 'required')) }}
        </div>
        <div class="form-group">
            {{ Form::label('news_body', 'Tekst vijesti:') }}
            {{ Form::textarea('news_body', $news_data->news_body, array('class' => 'form-control', 'placeholder' => 'Tekst vijesti', 'id' => 'codeEditor')) }}
        </div>
        <div class="form-group">
            {{ Form::label('news_images', 'Dodaj nove slike vijesti:') }}
            {{ Form::file('news_images[]', array('multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'news_images', 'accept' => 'image/*')) }}
        </div>
        <div class="form-group">
            {{ Form::label('news_tags', 'Tagovi vijesti: ("Enter" za unos taga)') }}
            {{ Form::select('tags[]', array(), null, array('placeholder' => 'Tagovi vijesti', 'multiple' => 'true', 'id' => 'news_tags', 'data-role' => 'tagsinput')) }}
        </div>

        <button class="btn btn-primary btn-info" id="toogle-tags-collection">Lista postojećih tagova <span class="glyphicon glyphicon-chevron-down"></span></button>
        <div class="form-group text-center" id="tags-collection">
            <ul class="tags">
                @if($tag_collection->count() > 0)
                    <h4>Klik na tag za odabir:</h4>
                    <ul class="tags">
                        @foreach($tag_collection as $tag)
                            <li>{{ $tag->tag }}</li>
                        @endforeach
                    </ul>
                @else
                    <h4>Trenutno nema tagova.</h4>
                @endif
            </ul>
        </div><hr>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block btn-lg btn-info">Izmjeni vijest <span class="glyphicon glyphicon-ok"></span></button>
        </div>
        {{ Form::close() }}
    </div>
</div>

{{-- include session notification output --}}
@include('admin.notification')

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

    jQuery(document).ready(function(){
        /*
        *   fill tags input with news tags data if any
        */
        var tagsData = {{ $news_tags }};
        var numOfTags = tagsData.length;

        $('#news_tags').tagsinput('add', '');
        for(var i = 0; i < numOfTags; i++){
            $('#news_tags').tagsinput('add', tagsData[i]);
        }
    });

    jQuery(window).load(function() {
        /*
         *   BBCode editor returning blank text on refresh, FF bug
         */
        var editor = $("#codeEditor");
        var editorLength = editor.val().length;
        if(editorLength < 1){
            editor.sync();
        }
    });
</script>