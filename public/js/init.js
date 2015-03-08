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
     *   toogle tags-collection container view
     */
    $("#toogle-tags-collection").click(function(event){
        event.preventDefault();

        //update element value
        if($(this).children().attr('class') == 'glyphicon glyphicon-chevron-down'){
            $(this).children().attr('class', 'glyphicon glyphicon-chevron-up');
        }
        else if($(this).children().attr('class') == 'glyphicon glyphicon-chevron-up'){
            $(this).children().attr('class', 'glyphicon glyphicon-chevron-down');
        }

        $("#tags-collection").toggle(250);
    });

    /*
     *   add selected tag to tags input
     */
    $("#tags-collection ul li").click(function() {
        $('#news_tags').tagsinput('add', $(this).text());
        $(this).fadeOut(300, function(){ $(this).remove(); }); //remove used tag from DOM
    });
});


/*
 *   catch laravel form/route notifications
 */
function catchLaravelNotification(errorHtmlSourceID, notificationType) {
    var outputMsg = $('#outputMsg');
    var errorMsg = $('#'+errorHtmlSourceID).html();
    outputMsg.append(errorMsg).addClass(notificationType).slideDown();

    //timer
    var numSeconds = 5;
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
            setTimeout(function () {
                outputMsg.empty().attr('class', 'notificationOutput');
            }, 2000);
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


(function($){
    $(document).ready(function(){
        /*
         *  image lightbox gallery
         */
        //activity indicator
        var activityIndicatorOn = function(){
                $( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo('body');
            },
            activityIndicatorOff = function(){
                $('#imagelightbox-loading').remove();
            },
        //overlay
            overlayOn = function(){
                $( '<div id="imagelightbox-overlay"></div>' ).appendTo('body');
            },
            overlayOff = function(){
                $('#imagelightbox-overlay').remove();
            },
        //close button
            closeButtonOn = function(instance){
                $( '<button type="button" id="imagelightbox-close" title="Zatvori"></button>' ).appendTo('body').on('click touchend', function(){ $(this).remove(); instance.quitImageLightbox(); return false; });
            },
            closeButtonOff = function(){
                $('#imagelightbox-close').remove();
            },
        //arrows
            arrowsOn = function(instance, selector){
                var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left" title="Prethodna"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right" title="Sljedeća"></button>');
                $arrows.appendTo('body');

                $arrows.on('click touchend', function(e){
                    e.preventDefault();

                    var $this = $(this),
                        $target	= $(selector + '[href="' + $('#imagelightbox').attr('src') + '"]'),
                        index = $target.index(selector);

                    if ($this.hasClass('imagelightbox-arrow-left')) {
                        index = index - 1;
                        if (!$(selector).eq(index).length)
                            index = $(selector).length;
                    } else {
                        index = index + 1;
                        if (!$(selector).eq(index).length)
                            index = 0;
                    }

                    instance.switchImageLightbox(index);
                    return false;
                });
            },
            arrowsOff = function(){
                $('.imagelightbox-arrow').remove();
            };

        //run gallery
        var selector = 'a[data-imagelightbox="gallery-images"]';
        var instance = $(selector).imageLightbox({
            onStart:		function() { overlayOn(); closeButtonOn(instance); arrowsOn(instance, selector); },
            onEnd:			function() { overlayOff(); closeButtonOff(); arrowsOff(); activityIndicatorOff(); },
            onLoadStart: 	function() { activityIndicatorOn(); },
            onLoadEnd:	 	function() { activityIndicatorOff(); $('.imagelightbox-arrow').css('display', 'block'); }
        });



    });
})(this.jQuery);