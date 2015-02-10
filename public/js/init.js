/**
 * main JS file for initialization
 */
jQuery(document).ready(function(){

    /*
    *   navigation
    */
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showNavigation'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');

        //navigation button
        var childClass = $(this).children().attr('class');
        if(childClass == 'glyphicon glyphicon-menu-hamburger') {
            $(this).children().attr('class', 'glyphicon glyphicon-remove');
        }
        else{
            $(this).children().attr('class', 'glyphicon glyphicon-menu-hamburger');
        }
    };

    /*
    *   BBcode editor
    */
    var lg = {
        lang: "hr",
        buttons: "bold,italic,underline,strike,sup,sub,|,justifyleft,justifycenter,justifyright,|,table,bullist,numlist,fontcolor,|,link,video,removeFormat"
    }
    $("#codeEditor").wysibb(lg);


    /*
     *   bootstrap image gallery
     */
    /*$('.thumbnail').click(function(){
        $('.modal-body').empty();
        var title = $(this).parent('a').attr("title");
        $('.modal-title').html(title);
        $($(this).parents('a').html()).appendTo('.modal-body');
        $('#myModal').modal({show:true});
    });*/

});


/*
 *   catch laravel form/route notifications
 */
function catchLaravelNotification(errorHtmlSourceID, notificationType) {
    var outputMsg = $('#outputMsg');
    var errorMsg = $('#'+errorHtmlSourceID).html();
    outputMsg.append(errorMsg).addClass(notificationType).slideDown();

    setTimeout(function () {
        outputMsg.slideUp().empty();
        outputMsg.attr('class', 'notificationOutput');
    }, 3500);
}

/*
 *   date and time
 */
function startTime() {
    var e = new Date;
    var t = e.getHours();
    var n = e.getMinutes();
    var r = e.getSeconds();
    var i = e.getDay();
    var s = e.getMonth();
    var o = e.getFullYear();
    n = checkTime(n);
    r = checkTime(r);
    $('#time-data').html(i + "." + s + "." + o + ". " + t + ":" + n + ":" + r);
    var u = setTimeout(function() {
        startTime()
    }, 500)
}

function checkTime(e) {
    if (e < 10) {
        e = "0" + e;
    }
    return e;
}
startTime();