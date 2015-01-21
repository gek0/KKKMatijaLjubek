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
        if(childClass == 'fui-list-columned') {
            $(this).children().attr('class', 'fui-cross');
        }
        else{
            $(this).children().attr('class', 'fui-list-columned');
        }
    };

});