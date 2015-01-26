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
        buttons: "bold,italic,underline,strike,|,justifyleft,justifycenter,justifyright,|,bullist,numlist,|,link,video,removeFormat"
    }
    $("#codeEditor").wysibb(lg);

});