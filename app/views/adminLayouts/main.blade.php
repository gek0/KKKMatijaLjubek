{{ $header }}
<section id="admin_content" class="container-fluid">
    <div id="navigation_menu">
        <button role="button" aria-label="Navigacija" class="btn btn-info btn-iconic" id="showNavigation" title="Navigacija"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
    </div>
    <div id="navigation_data">
        <div id="time-data" data-role="clock" class="pull-right"></div>
    </div>
    <hr>

    {{ $content }}
</section> <!-- end section#content -->
{{ $footer }}