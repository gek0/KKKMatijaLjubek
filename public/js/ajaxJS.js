/**
 * main JS file for all Ajax calls
 */

jQuery(document).ready(function(){
    /**
     * add new user
     */
    $("#newUser").submit(function(event){
        event.preventDefault();

        //disable button click and show loader
        $('button#addUser').addClass('disabled');
        $('#newUserLoad').css('visibility', 'visible').fadeIn();

        //get input fields values
        var values = {};
        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        var token = $('#newUser > input[name="_token"]').val();

        //user output
        var outputMsg = $('#outputMsg');
        var errorMsg = "";
        var successMsg = "<h3>Korisnički račun je uspješno kreiran.</h3>";

        function restoreNotification(){
            outputMsg.fadeOut(1000, function(){
                //enable button click and hide loader
                $('button#addUser').removeClass('disabled');
                $('#newUserLoad').css('visibility', 'hidden').fadeOut();
                $("#newUser").trigger('reset');

                outputMsg.find('h3').remove();
                $('#notificationTimer').empty();

                setTimeout(function () {
                    outputMsg.attr('class', 'notificationOutput');
                }, 1000);
            });
        }

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            headers: { 'X-CSRF-Token' : token },
            data: { _token: token, formData: values },
            success: function(data){

                //check status of validation and query
                if(data.status === 'success'){
                    outputMsg.append(successMsg).addClass('successNotif').slideDown();

                    //timer
                    var numSeconds = 3;
                    var timer = 3;
                    function countDown(){
                        numSeconds--;
                        if(numSeconds == 0){
                            clearInterval(timer);
                        }
                        $('#notificationTimer').html(numSeconds);
                    }
                    timer = setInterval(countDown, 1000);

                    //hide notification if user clicked
                    $('#notifTool').click(function(){
                        restoreNotification();

                    });

                    setTimeout(function(){
                        restoreNotification();
                    }, numSeconds * 1000);
                }
                else{
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += "<h3>" + value[i] + "</h3>";
                        });
                    });
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    //timer
                    var numSeconds = 5;
                    var timer = 5;
                    function countDown(){
                        numSeconds--;
                        if(numSeconds == 0){
                            clearInterval(timer);
                        }
                        $('#notificationTimer').html(numSeconds);
                    }
                    timer = setInterval(countDown, 1000);

                    //hide notification if user clicked
                    $('#notifTool').click(function(){
                        restoreNotification();

                    });

                    setTimeout(function(){
                        restoreNotification();
                    }, numSeconds * 1000);
                }
            }
        });
    });

    /**
     * change user settings
     */
    $("#newUserSettings").submit(function(event){
        event.preventDefault();

        //disable button click and show loader
        $('button#changeData').addClass('disabled');
        $('#newUserSettingsLoad').css('visibility', 'visible').fadeIn();

        //get input fields values
        var values = {};
        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        var token = $('#newUserSettings > input[name="_token"]').val();
        var outputMsg = $('#outputMsg');
        var errorMsg = "";
        var successMsg = "<h3>Korisnički račun je uspješno izmjenjen.</h3>";

        function restoreNotification(){
            outputMsg.fadeOut(1000, function(){
                //enable button click and hide loader
                $('button#changeData').removeClass('disabled');
                $('#newUserSettingsLoad').css('visibility', 'hidden').fadeOut();
                $("#newUserSettings").trigger('reset');

                outputMsg.find('h3').remove();
                $('#notificationTimer').empty();

                setTimeout(function () {
                    outputMsg.attr('class', 'notificationOutput');
                }, 1000);
            });
        }

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            headers: { 'X-CSRF-Token' : token },
            data: { _token: token, formData: values },
            success: function(data){

                //check status of validation and query
                if(data.status === 'success'){
                    outputMsg.append(successMsg).addClass('successNotif').slideDown();

                    //timer
                    var numSeconds = 3;
                    var timer = 3;
                    function countDown(){
                        numSeconds--;
                        if(numSeconds == 0){
                            clearInterval(timer);
                        }
                        $('#notificationTimer').html(numSeconds);
                    }
                    timer = setInterval(countDown, 1000);

                    //hide notification if user clicked
                    $('#notifTool').click(function(){
                        restoreNotification();

                    });

                    setTimeout(function(){
                        restoreNotification();
                    }, numSeconds * 1000);
                }
                else{
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += "<h3>" + value[i] + "</h3>";
                        });
                    });
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    //timer
                    var numSeconds = 5;
                    var timer = 5;
                    function countDown(){
                        numSeconds--;
                        if(numSeconds == 0){
                            clearInterval(timer);
                        }
                        $('#notificationTimer').html(numSeconds);
                    }
                    timer = setInterval(countDown, 1000);

                    //hide notification if user clicked
                    $('#notifTool').click(function(){
                        restoreNotification();
                    });

                    setTimeout(function(){
                        restoreNotification();
                    }, numSeconds * 1000);
                }
            }
        });
    });

    /**
     * delete image from news/person/cover gallery
     */
    $('.btn-delete-image').click(function(){
        var imageID = $(this).attr('id'); //image ID to delete
        var token = $('meta[name="_token"]').attr('content');
        var outputMsg = $('#outputMsg');
        var errorMsg = "";
        var successMsg = "<h3>Slika je uspješno obrisana.</h3>";

        //gallery counter
        var imageGallery = $('#image_gallery');
        var imageCount = parseInt($('#image_gallery_counter').html()) - 1;
        var dataURL = $('#image_gallery').attr('data-role-link');

        function restoreNotification(){
            outputMsg.fadeOut(1000, function(){
                outputMsg.find('h3').remove();
                $('#notificationTimer').empty();

                setTimeout(function () {
                    outputMsg.attr('class', 'notificationOutput');
                }, 1000);
            });
        }

        $.ajax({
            type: 'post',
            url: dataURL,
            dataType: 'json',
            headers: { 'X-CSRF-Token' : token },
            data: { imageData: imageID },
            success: function(data){

                //check status of validation and query
                if(data.status === 'success'){
                    outputMsg.append(successMsg).addClass('successNotif').slideDown();
                    $('#img-container-'+imageID).fadeOut();   //hide parent div

                    //update gallery counter and hide gallery if counter equals 0
                    $('#image_gallery_counter').html(imageCount);
                    if(imageCount < 1){
                        imageGallery.fadeOut();
                    }

                    //timer
                    var numSeconds = 3;
                    var timer = 3;
                    function countDown(){
                        numSeconds--;
                        if(numSeconds == 0){
                            clearInterval(timer);
                        }
                        $('#notificationTimer').html(numSeconds);
                    }
                    timer = setInterval(countDown, 1000);

                    //hide notification if user clicked
                    $('#notifTool').click(function(){
                        restoreNotification();
                    });

                    setTimeout(function(){
                        restoreNotification();
                    }, numSeconds * 1000);
                }
                else{
                    errorMsg = "<h3>" + data.errors + "</h3>";
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    //timer
                    var numSeconds = 5;
                    var timer = 5;
                    function countDown(){
                        numSeconds--;
                        if(numSeconds == 0){
                            clearInterval(timer);
                        }
                        $('#notificationTimer').html(numSeconds);
                    }
                    timer = setInterval(countDown, 1000);

                    //hide notification if user clicked
                    $('#notifTool').click(function(){
                        restoreNotification();
                    });

                    setTimeout(function(){
                        restoreNotification();
                    }, numSeconds * 1000);
                }
            }
        });
    });

    /**
     *   edit image caption from homepage image gallery
     */
    $(".btn-edit-image").click(function(){
        var imgCaption = $(this).parent().children().children().attr('data-caption');
        var imageID = $(this).attr('id'); //image ID to edit
        var outputMsg = $('#outputMsg');
        var errorMsg = "";

        function restoreNotification(){
            outputMsg.fadeOut(1000, function(){
                outputMsg.find('h3').remove();
                $('#notificationTimer').empty();

                setTimeout(function () {
                    outputMsg.attr('class', 'notificationOutput');
                }, 1000);
            });
        }

        bootbox.prompt({
            title: "Tekst slike:",
            value: imgCaption,
            callback: function(result) {
                if(result == ''){
                    errorMsg = "<h3>Tekst slike je obavezan.</h3>";
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    //timer
                    var numSeconds = 5;
                    var timer = 5;
                    function countDown(){
                        numSeconds--;
                        if(numSeconds == 0){
                            clearInterval(timer);
                        }
                        $('#notificationTimer').html(numSeconds);
                    }
                    timer = setInterval(countDown, 1000);

                    //hide notification if user clicked
                    $('#notifTool').click(function(){
                        restoreNotification();
                    });

                    setTimeout(function(){
                        restoreNotification();
                    }, numSeconds * 1000);
                }
                else if(result !== null) {
                    var token = $('meta[name="_token"]').attr('content');
                    var imageCaption = result;
                    var successMsg = "<h3>Tekst slike je uspješno izmjenjen.</h3>";
                    var dataURL = $('#image_gallery').attr('data-role-edit-link');

                    $.ajax({
                        type: 'post',
                        url: dataURL,
                        dataType: 'json',
                        headers: { 'X-CSRF-Token' : token },
                        data: { imageID: imageID, imageCaption: imageCaption },
                        success: function(data){

                            //check status of validation and query
                            if(data.status === 'success'){
                                outputMsg.append(successMsg).addClass('successNotif').slideDown();

                                //set new caption to DOM
                                $('.btn-edit-image').siblings('img:first').attr('data-caption', imageCaption);

                                //timer
                                var numSeconds = 3;
                                var timer = 3;
                                function countDown(){
                                    numSeconds--;
                                    if(numSeconds == 0){
                                        clearInterval(timer);
                                    }
                                    $('#notificationTimer').html(numSeconds);
                                }
                                timer = setInterval(countDown, 1000);

                                //hide notification if user clicked
                                $('#notifTool').click(function(){
                                    restoreNotification();
                                });

                                setTimeout(function(){
                                    restoreNotification();
                                }, numSeconds * 1000);
                            }
                            else{
                                errorMsg = "<h3>" + data.errors + "</h3>";
                                outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                                //timer
                                var numSeconds = 5;
                                var timer = 5;
                                function countDown(){
                                    numSeconds--;
                                    if(numSeconds == 0){
                                        clearInterval(timer);
                                    }
                                    $('#notificationTimer').html(numSeconds);
                                }
                                timer = setInterval(countDown, 1000);

                                //hide notification if user clicked
                                $('#notifTool').click(function(){
                                    restoreNotification();
                                });

                                setTimeout(function(){
                                    restoreNotification();
                                }, numSeconds * 1000);
                            }
                        }
                    });
                }
            }
        });
    });

});