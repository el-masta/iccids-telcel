<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<?php
    $tabla=[];
    $totalc=[
        'agencia'=>'TOTAL',
        'nuevos'=>0,
        'validos'=>0,
        'reservados'=>0,
        'portados'=>0,
        'usados'=>0,
        'baja'=>0,
        'robo'=>0,
        'devueltos'=>0,
        'desconocidos'=>0,
        'total'=>0
    ];
    foreach($totales as $agencia){
        $renglon=[
            'agencia'=>'',
            'nuevos'=>0,
            'validos'=>0,
            'reservados'=>0,
            'portados'=>0,
            'usados'=>0,
            'baja'=>0,
            'robo'=>0,
            'devueltos'=>0,
            'desconocidos'=>0,
            'total'=>0
        ];
        $renglon['agencia']=$agencia['_id'];
        foreach($agencia['estados'] as $estado){
            if($estado['estado']=='NUEVO') {$renglon['nuevos']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['nuevos']+=$estado['cantidad'];}
            if($estado['estado']=='VALIDO') {$renglon['validos']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['validos']+=$estado['cantidad'];}
            if($estado['estado']=='RESERVADO') {$renglon['reservados']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['reservados']+=$estado['cantidad'];}
            if($estado['estado']=='PORTADO') {$renglon['portados']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['portados']+=$estado['cantidad'];}
            if($estado['estado']=='USADO') {$renglon['usados']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['usados']+=$estado['cantidad'];}
            if($estado['estado']=='BAJA') {$renglon['baja']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['baja']+=$estado['cantidad'];}
            if($estado['estado']=='ROBO') {$renglon['robo']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['robo']+=$estado['cantidad'];}
            if($estado['estado']=='DEVUELTO') {$renglon['devueltos']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['devueltos']+=$estado['cantidad'];}
            if($estado['estado']=='DESCONOCIDO') {$renglon['desconocidos']
            =$estado['cantidad'];$renglon['total']+=$estado['cantidad'];$totalc['desconocidos']+=$estado['cantidad'];}
        }

        $totalc['total']+=$renglon['total'];
        $tabla[]=$renglon;
    }
    $tabla[]=$totalc
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ICCID's</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script>window.App ={ datos: {!! json_encode($tabla) !!}, }</script>
</head>

<body>
    <div class="flex-center position-ref full-height" id="app">
        <nav-bar :titulo="titulo"></nav-bar>
        <div class="container card p-4 bg-white mt-5 shadow">
            <div class="card-header h3 p-4 bg-info text-center text-white">ICCID's registrados</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr class="text-center">
                            <th>Agencia</th>
                            <th>Nuevo</th>
                            <th>Válido</th>
                            <th>Reservado</th>
                            <th>Portado</th>
                            <th>Usado</th>
                            <th>Baja</th>
                            <th>Robado</th>
                            <th>Devuelto</th>
                            <th>Desconocido</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($tabla as $dato)
                        <tr>
                            <td class="font-weight-bolder">{{ $dato['agencia'] }}</td>
                            <td class="text-right text-muted">{{number_format($dato['nuevos'])}}</td>
                            <td class="text-right text-muted">{{number_format($dato['validos'])}}</td>
                            <td class="text-right text-muted">{{number_format($dato['reservados'])}}</td>
                            <td class="text-right text-muted">{{number_format($dato['portados'])}}</td>
                            <td class="text-right text-muted">{{number_format($dato['usados'])}}</td>
                            <td class="text-right text-muted">{{number_format($dato['baja'])}}</td>
                            <td class="text-right text-muted">{{number_format($dato['robo'])}}</td>
                            <td class="text-right text-muted">{{number_format($dato['devueltos'])}}</td>
                            <td class="text-right text-muted">{{number_format($dato['desconocidos'])}}</td>
                            <td class="text-right font-weight-bolder text-muted">{{number_format( $dato['total'] )}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-3 mt-2">
                    <input type="text" ref="iccabuscar" class="form-control" id="iccid" placeholder="ICCID">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary m-2" @click="activar">Encontrar</button>
                </div>
                <iccidgral :esvisible='datosVisibles' ref="iccidgral"></iccidgral>
            </div>
            <div class="row">
                <button class="btn btn-primary m-2" @click="verCajas">Ver cajas para inspección</button>
            </div>
            <div class="row">
                <button class="btn btn-primary m-2" @click="verLlamadas">Llamadas de interconexión</button>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                tabla : App.datos,
                datosVisibles: false,
                iccabuscar: '',
                titulo:"ICCID's",
            },
            methods: {
                activar: function () {
                    this.datosVisibles = true;
                    this.iccabuscar = app.$refs.iccabuscar.value;
                    this.$emit('buscar', this.iccabuscar);
                },
                verCajas: function () {
                    location.href = "/cajas-revision";
                },
                verLlamadas: function () {
                    location.href = "/llamadas";
                }
            }
        });
    </script>
</body>

</html>