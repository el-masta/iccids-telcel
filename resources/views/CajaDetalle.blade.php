<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cajas-Inspección</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
    <div class="flex-center position-ref full-height" id="app">
        <nav-bar :titulo='titulo'></nav-bar>
        <div class="container card p-4 bg-white mt-5 shadow">
            <div id="label" class="card-header h3 p-4 bg-info text-center text-white">{{$caja}} </div>
            <div class="card-body">
                <table class="table">
                <tr>
                  <th>IccId</th>
                  <th>Estado</th>
                </tr>
                @foreach ($chips as $chip)
                @if ($chip['estado']=='VALIDO')
                <tr class="table-success">
                @else
                <tr class="table-warning">
                @endif
                  <td class="h5">{{$chip['_id']}}</td>
                  <td class="h5">{{$chip['estado']}}</td>
                </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>
