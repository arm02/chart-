<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Charts</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        {!! Charts::assets() !!}


    </head>
    <body>
        <br>
        <center>
            <div class="container">
            <div class="row">
            <div class="col-md-4 col-md-offset-4">

            <h3>Laporan Traffic Perusahaan X</h3>

            <form method="get" action="{{url('search')}}">            
            <label>Pilih Bulan</label>
            <div class="form-inline">
            <div class="form-group">
            <select class="form-control" name="query" required>
              <option disabled selected>Pilih Satu!</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>               
            </div>
                <input type="hidden" name="search" value="1">
                <button class="btn btn-primary" type="submit">Submit</button>            
            </div>            
            </form>       

        </div>
        </center>
        <br>
        <br>
        <center>
            {!! $chart->render() !!}
            <!-- {!! $chart2->render() !!}
            {!! $chart3->render() !!} -->
            </center>

        <div class="row">
            <br>
            <br>
            <center>                
            <div class="col-md-5 col-md-offset-1">
                {!! $chart2->render() !!}
            </div>

            <div class="col-md-5">
                {!! $chart3->render() !!}
            </div>        
            </center>
        </div>

          
            <br>
            <br>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>