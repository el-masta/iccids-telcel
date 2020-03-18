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
            <div id="label" class="card-header h3 p-4 bg-info text-center text-white">Cajas para inspeccionar </div>
            <div class="card-body">
                <div class="row">

                    <caja v-for="caja in cajas" :caja='caja' :key='caja._id'></caja>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        const app = new Vue({
            el: '#app',
            components: {},
            data() {
                return {
                    cajas: null,
                    titulo:'Cajas de chips',
                }
            },
            mounted() {
                let url = 'api/cajas-revision';
                axios.get(url).then(response => (this.cajas = response.data));
            },
        });

    </script>
</body>

</html>
