<div class="row">
    <div class="formInput">
        <h2 class="text-center">Nova vijest</h2>
        {{ Form::open(array('url' => 'admin/vijesti/nova', 'id' => 'novaVijest', 'role' => 'form')) }}
        <div class="form-group">
            {{ Form::label('news_title', 'Naslov vijesti:') }}
            {{ Form::text('news_title', null, array('class' => 'form-control', 'placeholder' => 'Naslov vijesti', 'id' => 'news_title', 'required')) }}
        </div>
        <div class="form-group">
            {{ Form::label('news_body', 'Tekst vijesti:') }}
            {{ Form::textarea('news_body', null, array('class' => 'form-control', 'placeholder' => 'Tekst vijesti', 'id' => 'codeEditor', 'required')) }}
        </div>
        <div class="form-group">
            {{ Form::label('newsTag', 'Tagovi vijesti:') }}
            {{ Form::select('tags[]', array(), null, array('placeholder' => 'Tagovi vijesti', 'multiple' => 'true', 'id' => 'newsTag', 'data-role' => 'tagsinput')) }}
        </div>

        {{ Form::close() }}
    </div>
</div>