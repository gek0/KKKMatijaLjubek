<div class="row">
    <div class="formInput">
        <h2 class="text-center">Novi sportaš/trener</h2>
        {{ Form::open(array('url' => 'admin/osobe/nova', 'id' => 'novaOsoba', 'files' => true, 'role' => 'form')) }}
            <div class="form-group">
                {{ Form::label('person_full_name', 'Ime i prezime:') }}
                {{ Form::text('person_full_name', null, array('class' => 'form-control', 'placeholder' => 'Ime i prezime', 'id' => 'person_full_name', 'required')) }}
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('person_category', 'Kategorija osobe:') }}<br>
                        {{ Form::select('person_category', array('Izaberi kategoriju osobe...' => $person_categories),
                                                  null, array('class' => 'selectpicker show-tick', 'data-style' => 'btn-info', 'title' => 'Odaberi kategoriju osobe...', 'data-size' => '5'))
                        }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('person_birthday', 'Datum rođenja osobe:') }}
                        {{ Form::text('person_birthday', null, array('class' => 'form-control', 'placeholder' => 'Datum rođenja', 'id' => 'person_birthday', 'required')) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('person_description', 'Opis osobe:') }}
                {{ Form::textarea('person_description', null, array('class' => 'form-control', 'placeholder' => 'Opis osobe', 'id' => 'codeEditor')) }}
            </div>
            <div class="form-group">
                {{ Form::label('person_images', 'Slike osobe:') }}
                {{ Form::file('person_images[]', array('multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'person_images', 'accept' => 'image/*')) }}
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block btn-lg btn-info">Dodaj osobu <span class="glyphicon glyphicon-ok"></span></button>
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
</script>