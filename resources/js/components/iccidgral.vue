<template>
    <div class="col-7 " v-show="$attrs.esvisible">
        <div class="row bg-primary text-white  p-2 7 text-center">
            <div class="col-12">ICCID: <span v-text="id"></span></div>
        </div>
        <div class="row">
            <div class="col-4 mb-4">
                <ul class="list-group mb-2">
                    <li class="list-group-item lh-condensed">
                        <small class="text-muted">Agencia:</small>
                        <p class="h6" v-text="agencia"></p>

                    <li class="list-group-item lh-condensed">
                        <small class="text-muted">Estado:</small>
                        <p class="h6" v-text="estado" :class="color"></p>
                    </li>
                    <li class="list-group-item lh-condensed">
                        <small class="text-muted">Registro:</small>
                        <p class="h6" v-text="creado"></p>

                    <li class="list-group-item lh-condensed">
                        <small class="text-muted">Modificado:</small>
                        <p class="h6" v-text="modificado">2</p>

                    <li class="list-group-item lh-condensed">
                        <small class="text-muted">Caja:</small>
                        <p class="h6" v-text="caja"></p>
                    </li>
                </ul>
            </div>
            <div class="col-4">
                <h4 class="mb-3 mt-3 h5 text-muted">Portaciones:</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item lh-condensed" v-for="porta in portaciones" :key="porta.fecha">
                        <small class="text-muted" v-text="porta.fecha"></small>
                        <p class="h6" v-text="porta.numero"></p>
                    </li>
                </ul>
            </div>
            <div class="col-4">
                <h4 class="mb-3 mt-3 h5 text-muted">Revisiones:</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item lh-condensed"  v-for="revision in revisiones" :key="revision.fecha">
                        <small class="text-muted" v-text="revision.fecha"></small>
                        <p class="h6"  v-text="revision.estado"></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                id: "",
                agencia: "",
                estado: "",
                creado: "",
                modificado: "",
                caja: "",
                revisiones: [],
                portaciones: [],
                color: "",

            }
        },
        methods: {
            encontrarIccid(iccid) {
                let me = this;
                let url = 'api/iccids/encontrar/'+iccid
                axios.get(url).then(function (response) {
                        me.id = response.data[0]._id;
                        me.agencia = response.data[0].agencia;
                        me.estado = response.data[0].estado;
                        me.creado = response.data[0].creado;
                        me.modificado = response.data[0].modificado;
                        me.caja = response.data[0].caja;
                        me.revisiones= response.data[0].revisiones;
                        me.portaciones= response.data[0].portaciones;
                        if (me.estado=='BAJA' || me.estado=='ROBO'){me.color="text-danger"}
                        else if (me.estado=='VALIDO'){me.color="text-success"}
                        else {me.color=""}
                    })
                    .catch(function (error) {
                        // handle error
                        me.id="NO ENCONTRADO";
                        me.agencia = "";
                        me.estado = "";
                        me.creado = "";
                        me.modificado = "";
                        me.caja = "";
                        me.revisiones= [];
                        me.portaciones= [];
                    });
            },
        },
        created: function(){
            this.$parent.$on('buscar',this.encontrarIccid)
        },
    }

</script>
