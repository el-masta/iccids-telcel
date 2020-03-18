<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Llamadas</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <div class="flex-center position-ref full-height" id="app">
        <nav-bar :titulo='titulo'></nav-bar>
        <div class="p-4 bg-white mt-5 shadow">
            <div class="row">
                <tel v-for="tel in tels" :tel="tel" :key="tel.id" ></tel>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                titulo : 'LLAMADAS',
                tels : [
                    {id: 'ZPHEZDTKGUZLSO85',nombre:'Hisense',marcar:'329 431',colgar:'361 1132',borrar:'500 431',
                    img:'hisense.jpeg'},
                    {id: 'LBY9X18628G10826',nombre:'Huawey Y6',marcar:'329 431',colgar:'352 1215',borrar:'500 431',
                    img:'y6.jpeg'},
                    {id: 'TC4YY170321003538',nombre:'Mtt',marcar:'201 282',colgar:'237 697',borrar:'390 280',
                    img:'mtt.jpg'},
                    {id: 'LGH7352c7ce80',nombre:'LG-G4',marcar:'380 620',colgar:'534 1415',borrar:'880 620',
                    img:'lg-g4.jpg'},
                    {id: '47f5f2d6',nombre:'Lenovo K5',marcar:'365 720',colgar:'555 1700',borrar:'860 745',
                    img:'lenovo-k5.jpeg'},
                ],
            },
            methods: {}
        });
    </script>
</body>
</html>