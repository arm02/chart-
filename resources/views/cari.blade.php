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