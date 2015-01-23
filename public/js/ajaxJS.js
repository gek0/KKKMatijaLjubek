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
});