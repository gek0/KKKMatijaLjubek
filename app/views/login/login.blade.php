<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Matija Ljubek ~ Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">

    <!-- scripts -->
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/modernizr.custom.js') }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js') }}
    {{ HTML::script('js/respond.min.js') }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/animate.css') }}
    {{ HTML::style('css/layoutAdmin.css') }}
</head>
<body>
    <!-- notifications -->
    <div class="notificationOutput" id="outputMsg"></div>

    <!-- login container -->
    <div class="container" id="login-block">
        <div class="row">
            <div class="loginMainBox">
                <div class="page-icon-shadow animated bounceInDown"></div>
                <div class="login-box clearfix animated flipInY">
                    <div class="page-icon animated bounceInDown">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="login-logo">
                        {{ HTML::image('css/img/logo_main_log.png', 'Logo', array('title' => 'KKK Matija Ljubek')) }}
                    </div>
                    <hr />
                    <div class="login-form">
                        {{ Form::open(array('url' => 'login', 'role' => 'form', 'id' => 'adminLogin')) }}
                            <div class="form-group-login">
                                {{ Form::label('username', 'Korisničko ime:') }}
                                {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Korisničko ime', 'id' => 'username', 'required')) }}
                            </div>
                            <div class="form-group-login">
                                {{ Form::label('password', 'Lozinka:') }}
                                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Lozinka', 'id' => 'password', 'required')) }}
                            </div>
                            <div class="form-group-login text-center">
                                <div class="checkbox checkbox-info">
                                    {{ Form::checkbox('rememberMe', 1, true, array('id' => 'rememberMe')) }}
                                    {{ Form::label('rememberMe', 'Zapamti me?', array('class' => 'checkbox-inline')) }}
                                </div>
                            </div><br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-info" id="loginSubmit">Login</button>
                                <div class="loader" id="adminLoginLoad">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end login container -->

<script>
    jQuery(document).ready(function() {
        $("#adminLogin").submit(function (event) {
            event.preventDefault();

            //disable button click and show loader
            $('button#loginSubmit').addClass('disabled');
            $('#adminLoginLoad').css('visibility', 'visible').fadeIn();

            //get input fields values
            var values = {};
            $.each($(this).serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            var token = $('#novePostavke > input[name="_token"]').val();

            //user output
            var outputMsg = $('#outputMsg');
            var errorMsg = "";

            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                dataType: 'json',
                headers: {'X-CSRF-Token': token},
                data: {_token: token, formData: values},
                success: function (data) {
                    //check status of validation and query
                    if (data.status === 'success') {
                        //enable button click and hide loader
                        $('button#loginSubmit').attr('class', 'btn btn-primary btn-info');
                        $('#adminLoginLoad').css('visibility', 'hidden').fadeOut();

                        //redirect to intended page
                        window.location = "<?php echo $intendedUrl; ?>";
                    }
                    else {
                        errorMsg = '<h3>' + data.errors + '</h3>';
                        outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                        setTimeout(function(){
                            //enable button click and hide loader
                            $('button#loginSubmit').attr('class', 'btn btn-primary btn-info');
                            $('#adminLoginLoad').css('visibility', 'hidden').fadeOut();

                            setTimeout(function() {
                                outputMsg.slideUp().empty();
                                //restore old class to output div
                                outputMsg.attr('class', 'notificationOutput');
                            }, 1500);
                        }, 1500);
                    }
                }
            });
        });
    });
</script>
</body>
</html>