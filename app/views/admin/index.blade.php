<section id="admin-home">
    <div class="row text-center padded">
        <div class="col-md-12">
            <h1>Dobrodošao/la u KKK Matija Ljubek Administraciju</h1>
            <h3>Koristi navigaciju ili donje linkove.</h3>
        </div>
    </div>
    <div class="row text-center padded">
        <div class="col-md-6 marginated-center">
            <a href="{{ url('admin/vijesti') }}"><button class="btn btn-info btn-half btn-iconic"><span class="glyphicon glyphicon-pencil pr-10"></span> Pregledaj vijesti</button></a>
        </div>
        <div class="col-md-6 marginated-center">
            <a href="{{ url('admin/osobe') }}"><button class="btn btn-info btn-half btn-iconic"><span class="glyphicon glyphicon-user pr-10"></span> Pregledaj osobe</button></a>
        </div>
        <div class="col-md-6 marginated-center">
            <a href="{{ url('admin/naslovnica') }}"><button class="btn btn-info btn-half btn-iconic"><span class="glyphicon glyphicon-picture pr-10"></span> Slike naslovnice</button></a>
        </div>
        <div class="col-md-6 marginated-center">
            <a href="{{ url('admin/korisnik/postavke') }}"><button class="btn btn-info btn-half btn-iconic"><span class="glyphicon glyphicon-cog pr-10"></span> Korisničke postavke</button></a>
        </div>
    </div>
</section> <!-- section admin-home end -->