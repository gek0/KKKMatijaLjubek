 <div class="row">
    <div class="col-md-6">
        <div class="formInput">
            <h2 class="text-center">Izmjeni korisničke postavke</h2>
            {{ Form::open(array('url' => 'admin/korisnik/postavke', 'id' => 'novePostavke', 'role' => 'form')) }}
                <div class="form-group">
                    {{ Form::label('username', 'Korisničko ime:') }}
                    {{ Form::text('username', Auth::user()->username, array('class' => 'form-control', 'placeholder' => 'Korisničko ime', 'id' => 'username', 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'E-mail adresa:') }}
                    {{ Form::email('email', Auth::user()->email, array('class' => 'form-control', 'placeholder' => 'E-mail adresa', 'id' => 'email', 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Nova lozinka:') }}
                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Lozinka', 'id' => 'password', 'autocomplete' => 'off')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('passwordAgain', 'Ponovite lozinku:') }}
                    {{ Form::password('passwordAgain', array('class' => 'form-control', 'placeholder' => 'Ponovite loziku', 'id' => 'passwordAgain', 'autocomplete' => 'off')) }}
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-info" id="changeData">Prihvati promjene <span class="glyphicon glyphicon-ok"></span></button>
                    <div class="loader" id="novePostavkeLoad">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            {{ Form::close() }}
        </div> <!-- end user settings form -->
    </div>
    <div class="col-md-6">
        <div class="formInput">
            <h2 class="text-center">Dodaj novog korisnika</h2>
            {{ Form::open(array('url' => 'admin/korisnik/novi', 'id' => 'noviKorisnik', 'role' => 'form')) }}
            <div class="form-group">
                {{ Form::label('newUsername', 'Korisničko ime:') }}
                {{ Form::text('newUsername', null, array('class' => 'form-control', 'placeholder' => 'Korisničko ime', 'id' => 'newUsername', 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('newEmail', 'E-mail adresa:') }}
                {{ Form::email('newEmail', null, array('class' => 'form-control', 'placeholder' => 'E-mail adresa', 'id' => 'newEmail', 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('newPassword', 'Lozinka:') }}
                {{ Form::password('newPassword', array('class' => 'form-control', 'placeholder' => 'Lozinka', 'id' => 'newPassword', 'autocomplete' => 'off', 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('newPasswordAgain', 'Ponovite lozinku:') }}
                {{ Form::password('newPasswordAgain', array('class' => 'form-control', 'placeholder' => 'Ponovite loziku', 'id' => 'newPasswordAgain', 'autocomplete' => 'off',  'required')) }}
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-info" id="addUser">Dodaj korisnika <span class="glyphicon glyphicon-user"></span></button>
                <div class="loader" id="noviKorisnikLoad">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            {{ Form::close() }}
        </div> <!-- end new user form -->
    </div>
</div>

{{ HTML::script('js/ajaxJS.js', array('charset' => 'utf-8')) }}