<template>
    <div class="col columna text-center">
        <div class="card">
            <img v-bind:src="'img/' + tel.img" class="imgtel mt-2 mx-auto">
            <div class="card-body">
                <p class="h5 card-title">{{tel.nombre}}</p>
                <p class="card-text">{{tel.id}}</p>
                <button class="btn btn-primary" @click="cicloLlamadas">{{txtboton}}</button>
                <div class="bg-info text-white p-2 mt-3"><small>{{estado}}</small></div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['tel'],
        data: function () {
            return {
                estado: 'En espera...',
                txtboton: 'Iniciar llamadas',
                numero: '',
                totalmarcadas: 0,
                segundos: 0,
            }
        },
        methods: {

            // Ciclo para ejecutar llamadas
            cicloLlamadas: async function cicloLlamadas() {
                let resp;
                const self = this; // Accede a varibles de data y a los otros métodos
                // Ciclo de 60 llamadas
                while (self.totalmarcadas <60){
                    self.totalmarcadas += 1;
                    resp = await self.hacerLlamada();
                    resp = await self.sleep(1000);
                }
                self.estado = 'Llamadas terminadas';
                return true;
            },

            // Obtiene el número de la API e inicia la llamada
            hacerLlamada: async function hacerLlamada() {
                let resp;
                const self = this; // Accede a varibles de data y a los otros métodos
                self.segundos = 70; // duracion de la llamada
                const url = '/api/damenumero';
                // Obtener numero
                resp = await axios.get(url).then(response => (self.numero = response.data._id));
                resp = await self.iniciarLlamada();
                // Mostrar segundos para terminar
                while (self.segundos >0){
                    self.estado = `${self.totalmarcadas} - Llamando a: ${self.numero} (${self.segundos})`;
                    self.segundos -= 1;
                    resp = await self.sleep(1000);
                }
                resp = await self.terminarLlamada();
                self.estado = 'En espera...';
                return true;
            },

            // Inicia una llamada
            iniciarLlamada: async function iniciarLlamada() {
                let resp;
                let orden
                const self = this; // Accede a varibles de data y a los otros métodos
                self.estado = `Iniciando llamada: ${self.numero}`;
                // Abriendo Dialer
                orden = `adb -s ${this.tel.id} shell monkey -p com.aamir.simpledialler 1`;
                resp = await this.shell(orden);
                // Borrando número residual en dialer
                resp = await this.sleep(1000);
                orden = `adb -s ${this.tel.id} shell input tap ${self.tel.borrar}`;
                resp = await this.shell(orden);
                // Escribiendo numero
                resp = await this.sleep(250)
                orden = `adb -s ${this.tel.id} shell input text ${self.numero}`;
                resp = await this.shell(orden);
                // Marcando
                resp = await this.sleep(500)
                orden = `adb -s ${this.tel.id} shell input tap ${self.tel.marcar}`;
                resp = await this.shell(orden);
                resp = await this.sleep(250)
                return true;
            },

            // Termina la llamada
            terminarLlamada: async function terminarLlamada() {
                let resp;
                // Manda orden al shell a traves de api
                const orden = `adb -s ${this.tel.id} shell input tap ${this.tel.colgar}`;
                resp = this.shell(orden);
                // Marca numero en BD como liberado
                const url = `/api/liberanumero/${this.numero}`;
                resp = await axios.get(url);
                // Actualiza estado
                this.estado = 'En espera...'
                return true;
            },

            // Función para definir tiempos de espera
            sleep: async function sleep(time) {
                const prom = await new Promise((resolve) => setTimeout(resolve, time));
                return true;
            },

            // Envía orden al shell a través de la API
            shell: async function shell(ordenShell) {
                const url = 'api/shell';
                const resp = await axios.post(url, { orden: ordenShell });
                return true;
            },

        },
    }

</script>

<style scoped>
    .imgtel {
        width: 196px;
        height: 196px;
    }

    .columna {
        min-width: 240px;
        flex:1;
    }

</style>
