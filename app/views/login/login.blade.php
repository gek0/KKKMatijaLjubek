<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Matija Ljubek ~ Prijava</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="keywords" content="kayak, canoe, kajak, kanu, matija, ljubek, klub, zagreb">
    <meta name="description" content="Kajak Kanu Klub Matija Ljubek administracija">
    <meta name="author" content="Matija Buriša">
    <meta name="robots" content="noindex">
    <meta property="og:title" content="Kajak Kanu Klub Matija Ljubek, administracija" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="kkkmatijaljubek.hr" />
    <meta property="og:description" content="Kajak Kanu Klub Matija Ljubek, administracija" />

    <!-- favicons and apple icon -->
    <!--[if IE]><link rel="shortcut icon" href="{{ asset('favicon.ico') }}"><![endif]-->
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('touch-icon-ipad-retina.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('touch-icon-iphone-6-plus.png') }}">
    <link rel="canonical" href="{{ Request::url() }}" />

    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js') }}
    {{ HTML::script('js/respond.min.js') }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/layoutAdmin.min.css') }}
</head>
<body>
    <!-- notifications -->
    <div class="notificationOutput" id="outputMsg">

        <div class="notificationTools" id="notifTool">
            <span class="glyphicon glyphicon-remove glyphicon-large" id="notificationRemove"></span>
            <span id="notificationTimer"></span>
        </div>
    </div>

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
                        {{ HTML::image('css/assets/images/logo_main_log.png', 'Logo', array('title' => 'KKK Matija Ljubek', 'class' => 'img-responsive')) }}
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
                                <button type="submit" class="btn btn-primary btn-info" id="loginSubmit">Prijava</button>
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

    <!-- scripts -->
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/modernizr.custom.js') }}

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
            var token = $('#adminLogin > input[name="_token"]').val();

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
                        $('button#loginSubmit').removeClass('disabled');
                        $('#adminLoginLoad').css('visibility', 'hidden').fadeOut();

                        //redirect to intended page
                        window.location = "<?php echo $intended_url; ?>";
                    }
                    else {
                        errorMsg = '<h3>' + data.errors + '</h3>';
                        outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                        //timer
                        var numSeconds = 3;
                        function countDown(){
                            numSeconds--;
                            if(numSeconds == 0){
                                clearInterval(timer);
                            }
                            $('#notificationTimer').html(numSeconds);
                        }
                        var timer = setInterval(countDown, 1000);

                        function restoreNotification(){
                            outputMsg.fadeOut(1000, function(){
                                //enable button click and hide loader
                                $('button#loginSubmit').removeClass('disabled');
                                $('#adminLoginLoad').css('visibility', 'hidden').fadeOut();

                                setTimeout(function () {
                                    outputMsg.empty().attr('class', 'notificationOutput');
                                }, 1000);
                            });
                        }

                        //hide notification if user clicked
                        $('#notifTool').click(function(){
                            restoreNotification();
                        });

                        setTimeout(function () {
                            restoreNotification();
                        }, numSeconds * 1000);
                    }
                }
            });
        });
    });
</script>
</body>
</html>