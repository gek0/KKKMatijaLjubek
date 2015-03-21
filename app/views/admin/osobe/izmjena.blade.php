<div class="row">
    <div class="formInput">
        <h2 class="text-center">Izmjena osobe<br> <b>{{ $person_data->person_full_name }}</b></h2>
        {{ Form::open(array('url' => 'admin/osobe/izmjena/'.$person_data->slug, 'id' => 'izmjeniOsobu', 'files' => true, 'role' => 'form')) }}
            <div class="form-group">
                {{ Form::label('person_full_name', 'Ime i prezime:') }}
                {{ Form::text('person_full_name', $person_data->person_full_name, array('class' => 'form-control', 'placeholder' => 'Ime i prezime', 'id' => 'person_full_name', 'required')) }}
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('person_category', 'Kategorija osobe:') }}<br>
                        {{ Form::select('person_category', array('Izaberi kategoriju osobe...' => $person_categories),
                                                  $person_data->category_id, array('class' => 'selectpicker show-tick', 'data-style' => 'btn-info', 'title' => 'Odaberi kategoriju osobe...', 'data-size' => '5'))
                        }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('person_birthday', 'Datum rođenja osobe:') }}
                        {{ Form::text('person_birthday', $person_data->getDateBirthdayInput(), array('class' => 'form-control', 'placeholder' => 'Datum rođenja', 'id' => 'person_birthday', 'required')) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('person_description', 'Opis osobe:') }}
                {{ Form::textarea('person_description', $person_data->person_description, array('class' => 'form-control', 'placeholder' => 'Opis osobe', 'id' => 'codeEditor')) }}
            </div>
            <div class="form-group">
                {{ Form::label('person_images', 'Dodaj nove slike osobe:') }}
                {{ Form::file('person_images[]', array('multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'person_images', 'accept' => 'image/*')) }}
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block btn-lg btn-info">Izmjeni osobu <span class="glyphicon glyphicon-ok"></span></button>
            </div>
        {{ Form::close() }}
    </div>
</div>

{{-- include session notification output --}}
@include('admin.notification')

<script type="text/javascript">
    $("#person_images").fileinput({
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
         *   bootstrap datepicker
         */
        $('#person_birthday').datepicker({
            format: 'dd.mm.yyyy'
        });
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