/**
 * main JS file for all Ajax calls
 */

jQuery(document).ready(function(){
    /**
     * add new user
     */
    $("#noviKorisnik").submit(function(event){
        event.preventDefault();

        //disable button click and show loader
        $('button#addUser').addClass('disabled');
        $('#noviKorisnikLoad').css('visibility', 'visible').fadeIn();

        //get input fields values
        var values = {};
        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        var token = $('#noviKorisnik > input[name="_token"]').val();

        //user output
        var outputMsg = $('#outputMsg');
        var errorMsg = "";
        var successMsg = "<h3>Korisnički račun je uspješno kreiran.</h3>";

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            headers: { 'X-CSRF-Token' : token },
            data: { _token: token, formData: values },
            success: function(data){
                outputMsg.fadeOut().empty();

                //check status of validation and query
                if(data.status === 'success'){
                    outputMsg.append(successMsg).addClass('successNotif').slideDown();

                    setTimeout(function(){
                        //enable button click and hide loader
                        $('button#addUser').attr('class', 'btn btn-primary btn-info');
                        $('#noviKorisnikLoad').css('visibility', 'hidden').fadeOut();

                        setTimeout(function() {
                            outputMsg.slideUp().empty();
                            //restore old class to output div
                            outputMsg.attr('class', 'notificationOutput');
                            $("#noviKorisnik").trigger('reset');
                        }, 2500);
                    }, 1500);
                }
                else{
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += "<h3>" + value[i] + "</h3>";
                        });
                    });
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    setTimeout(function(){
                        //enable button click and hide loader
                        $('button#addUser').attr('class', 'btn btn-primary btn-info');
                        $('#noviKorisnikLoad').css('visibility', 'hidden').fadeOut();

                        setTimeout(function() {
                            outputMsg.slideUp().empty();
                            //restore old class to output div
                            outputMsg.attr('class', 'notificationOutput');
                        }, 3500);
                    }, 1500);
                }
            }
        });
    });

    /**
     * change user settings
     */
    $("#novePostavke").submit(function(event){
        event.preventDefault();

        //disable button click and show loader
        $('button#changeData').addClass('disabled');
        $('#novePostavkeLoad').css('visibility', 'visible').fadeIn();

        //get input fields values
        var values = {};
        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        var token = $('#novePostavke > input[name="_token"]').val();
        var outputMsg = $('#outputMsg');
        var errorMsg = "";
        var successMsg = "<h3>Korisnički račun je uspješno izmjenjen.</h3>";

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            headers: { 'X-CSRF-Token' : token },
            data: { _token: token, formData: values },
            success: function(data){
                outputMsg.fadeOut().empty();

                //check status of validation and query
                if(data.status === 'success'){
                    outputMsg.append(successMsg).addClass('successNotif').slideDown();

                    setTimeout(function(){
                        //enable button click and hide loader
                        $('button#changeData').attr('class', 'btn btn-primary btn-info');
                        $('#novePostavkeLoad').css('visibility', 'hidden').fadeOut();

                        setTimeout(function() {
                            outputMsg.slideUp().empty();
                            //restore old class to output div
                            outputMsg.attr('class', 'notificationOutput');
                            $("#noviKorisnik").trigger('reset');
                        }, 2500);
                    }, 1500);
                }
                else{
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += "<h3>" + value[i] + "</h3>";
                        });
                    });
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    setTimeout(function(){
                        //enable button click and hide loader
                        $('button#changeData').attr('class', 'btn btn-primary btn-info');
                        $('#novePostavkeLoad').css('visibility', 'hidden').fadeOut();

                        setTimeout(function() {
                            outputMsg.slideUp().empty();
                            //restore old class to output div
                            outputMsg.attr('class', 'notificationOutput');
                        }, 3500);
                    }, 1500);
                }
            }
        });
    });

    /**
     * delete image from news gallery
     */
    $('.btn-delete-image').click(function(){
        var imageID = $(this).attr('id'); //image ID to delete
        var token = $('meta[name="_token"]').attr('content');
        var outputMsg = $('#outputMsg');
        var errorMsg = "";
        var successMsg = "<h3>Slika je uspješno obrisana.</h3>";

        //gallery counter
        var imageGallery = $('#news_image_gallery');
        var imageCount = parseInt($('#image_gallery_counter').html()) - 1;
        var dataURL = $('#news_image_gallery').attr('data-role-link');

        $.ajax({
            type: 'post',
            url: dataURL,
            dataType: 'json',
            headers: { 'X-CSRF-Token' : token },
            data: { imageData: imageID },
            success: function(data){
                outputMsg.fadeOut().empty();

                //check status of validation and query
                if(data.status === 'success'){
                    outputMsg.append(successMsg).addClass('successNotif').slideDown();
                    $('#img-container-'+imageID).fadeOut();   //hide parent div

                    //update gallery counter and hide gallery if counter equals 0
                    $('#image_gallery_counter').html(imageCount);
                    if(imageCount < 1){
                        imageGallery.fadeOut();
                    }

                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 2500);
                }
                else{
                    errorMsg = "<h3>" + data.errors + "</h3>";
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 2500);
                }
            }
        });
    });

    /**
     * delete image from person gallery
     */
    $('.btn-delete-image').click(function(){
        var imageID = $(this).attr('id'); //image ID to delete
        var token = $('meta[name="_token"]').attr('content');
        var outputMsg = $('#outputMsg');
        var errorMsg = "";
        var successMsg = "<h3>Slika je uspješno obrisana.</h3>";

        //gallery counter
        var imageGallery = $('#person_image_gallery');
        var imageCount = parseInt($('#image_gallery_counter').html()) - 1;
        var dataURL = $('#person_image_gallery').attr('data-role-link');

        $.ajax({
            type: 'post',
            url: dataURL,
            dataType: 'json',
            headers: { 'X-CSRF-Token' : token },
            data: { imageData: imageID },
            success: function(data){
                outputMsg.fadeOut().empty();

                //check status of validation and query
                if(data.status === 'success'){
                    outputMsg.append(successMsg).addClass('successNotif').slideDown();
                    $('#img-container-'+imageID).fadeOut();   //hide parent div

                    //update gallery counter and hide gallery if counter equals 0
                    $('#image_gallery_counter').html(imageCount);
                    if(imageCount < 1){
                        imageGallery.fadeOut();
                    }

                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 2500);
                }
                else{
                    errorMsg = "<h3>" + data.errors + "</h3>";
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 2500);
                }
            }
        });
    });

    /**
     * delete image from homepage image gallery
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

        $.ajax({
            type: 'post',
            url: dataURL,
            dataType: 'json',
            headers: { 'X-CSRF-Token' : token },
            data: { imageData: imageID },
            success: function(data){
                outputMsg.fadeOut().empty();

                //check status of validation and query
                if(data.status === 'success'){
                    outputMsg.append(successMsg).addClass('successNotif').slideDown();
                    $('#img-container-'+imageID).fadeOut();   //hide parent div

                    //update gallery counter and hide gallery if counter equals 0
                    $('#image_gallery_counter').html(imageCount);
                    if(imageCount < 1){
                        imageGallery.fadeOut();
                    }

                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 2500);
                }
                else{
                    errorMsg = "<h3>" + data.errors + "</h3>";
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 2500);
                }
            }
        });
    });

    /**
     *   edit image caption from homepage image gallery
     */
    $(".btn-edit-image").click(function(){
        var imgCaption = $(this).siblings('img:first').attr('data-caption');
        var imageID = $(this).attr('id'); //image ID to edit
        bootbox.prompt({
            title: "Tekst slike:",
            value: imgCaption,
            callback: function(result) {
                if(result !== null) {
                    var token = $('meta[name="_token"]').attr('content');
                    var imageCaption = result;
                    var outputMsg = $('#outputMsg');
                    var errorMsg = "";
                    var successMsg = "<h3>Tekst slike je uspješno izmjenjen.</h3>";
                    var dataURL = $('#image_gallery').attr('data-role-edit-link');

                    $.ajax({
                        type: 'post',
                        url: dataURL,
                        dataType: 'json',
                        headers: { 'X-CSRF-Token' : token },
                        data: { imageID: imageID, imageCaption: imageCaption },
                        success: function(data){
                            outputMsg.fadeOut().empty();

                            //check status of validation and query
                            if(data.status === 'success'){
                                outputMsg.append(successMsg).addClass('successNotif').slideDown();

                                //set new caption to DOM
                                $('.btn-edit-image').siblings('img:first').attr('data-caption', imageCaption);

                                setTimeout(function() {
                                    outputMsg.slideUp().empty();
                                    //restore old class to output div
                                    outputMsg.attr('class', 'notificationOutput');
                                }, 2500);
                            }
                            else{
                                errorMsg = "<h3>" + data.errors + "</h3>";
                                outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                                setTimeout(function() {
                                    outputMsg.slideUp().empty();
                                    //restore old class to output div
                                    outputMsg.attr('class', 'notificationOutput');
                                }, 2500);
                            }
                        }
                    });
                }
            }
        });
    });

});