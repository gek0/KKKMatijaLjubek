/**
 * main JS file for all Ajax calls
 */

jQuery(document).ready(function(){
    /**
     * add new user
     */
    $("#noviKorisnik").submit(function(event){
        event.preventDefault();

        //get input fields values
        var values = {};
        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        var token = $('#noviKorisnik > input[name="_token"]').val();
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
                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                        $("#noviKorisnik").trigger('reset');
                    }, 2500);
                }
                else{
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += "<h3>" + value[i] + "</h3>";
                        });
                    });
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();
                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 5000);
                }
            }
        });
    });

    /**
     * change user settings
     */
    $("#novePostavke").submit(function(event){
        event.preventDefault();

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
                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 2500);
                }
                else{
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += "<h3>" + value[i] + "</h3>";
                        });
                    });
                    outputMsg.append(errorMsg).addClass('warningNotif').slideDown();
                    setTimeout(function() {
                        outputMsg.slideUp().empty();
                        //restore old class to output div
                        outputMsg.attr('class', 'notificationOutput');
                    }, 5000);
                }
            }
        });
    });
});