/**
 *  email ajax script for main contact form
 */

jQuery(document).ready(function() {
    $("#footer-form").submit(function (event) {
        event.preventDefault();

        //disable button for another submits
        $('#contactSubmit').addClass('disabled');

        //get input fields values
        var values = {};
        $.each($(this).serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        var token = $('#footer-form > input[name="_token"]').val();

        //user output
        var outputMsg = $('#contact-output-message');
        var errorMsg = "";
        var successMsg = "<h4>E-mail je uspješno poslan</h4>";

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            headers: {'X-CSRF-Token': token},
            data: {_token: token, formData: values},
            success: function (data) {
                //check status of validation and query
                if (data.status === 'success') {
                    outputMsg.append(successMsg);
                    $('#contact-output-inner').addClass('alert-success').fadeIn();
                    $('#contact-output').fadeIn();
                    $("#footer-form").trigger('reset');
                }
                else {
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += "<h4>" + value[i] + "</h4>";
                        });
                    });

                    outputMsg.append(errorMsg);
                    $('#contact-output-inner').addClass('alert-danger').fadeIn();
                    $('#contact-output').fadeIn();
                }
            }
        });

        //restore default class, clear output and hide it
        setTimeout(function(){
            $('#contactSubmit').removeClass('disabled');
            $('#contact-output-inner').attr('class', 'alert').fadeOut();
            outputMsg.empty();
        }, 5000);  /************************************************************************************************************************/

    });
});