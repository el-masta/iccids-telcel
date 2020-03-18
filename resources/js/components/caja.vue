<template>
  <div class="card col-2 shadow p-0 m-2">
    <div class="card-body p-0">
      <div class="card-header m-0 p-1 text-center h5 bg-success">
        <strong>
          <a :href="'/caja-detalle/'+caja._id" class="text-white">{{caja._id}}</a>
        </strong>
      </div>
      <ul class="list-group">
        <li class="list-group-item p-2" v-for="estado in caja.estados">
          {{estado.estado}}:
          <strong>{{estado.cantidad}}</strong>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  props: ["caja"]
};
</script>
