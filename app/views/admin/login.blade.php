Hello from login page

{{ Form::open(array('url' => 'admin/login', 'role' => 'form', 'id' => 'admin_login')) }}
<div class='input-form-group'>
    <div class='signup-head'>
        <div class='logo-title'></div>
        <h2 class="form-signup-heading">Prijava korisnika</h2>
    </div>

    <div class='inner'>
        <div class="form-group">
            {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Korisničko ime', 'id' => 'username', 'required')) }}
        </div>
        <div class="form-group">
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Lozinka', 'id' => 'password', 'required')) }}
        </div>
        {{ Form::submit('Login', array('class' => 'btn btn-primary btn-lg btn-block')) }}
    </div>
</div>
{{ Form::close() }}