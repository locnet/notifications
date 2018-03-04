<template>
    <div class="col-md-4 col-xs-12 animated fadeIn" style="height: 250px">
        <div class="col-md-12 col-xs-12">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-search"></i>Filtra
                </div>
                <input type="text" class="form-control"
                        placeholder="Filtra por nombre"
                        v-bind:value="nameFilter">
            </div>
        </div>
      
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="blue">
                    <th>Nombre / Telefono / Localizador</th>
                </tr>                  
            </thead>
            <tbody>
                <tr >
                    <td>
                        <ul class="list-group">
                            <li v-for="(p,index) in pax" :key="index"
                                v-on:click="showPaxPnrs(p.id), selectedItem = p.id" 
                                style="cursor:pointer"
                                v-bind:class="[liStyle, {active: selectedItem == p.id}]">
                                {{ p.passenger }} / {{ p.phone}} / {{ p.pnr }}
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
// import bus event
import { eventBus } from "../../app.js";

export default {
  props: ["passengers"],
  data() {
    return {
      pax: JSON.parse(this.passengers),  // pasamos los pasageros a json
      liStyle: 'list-group-item',        // estilo css
      selectedItem: 0,                      // utilizado para cambiar el background del item selecionado
      nameFilter: 'adrian',
      namesArray: () => {
          for (var p in pax) {
              this.push(p.passenger);
          }
      }
    };
  },
  methods: {
    showPaxPnrs(id) {
      // cambio el background del td clickeado
      this.firstItem = id;

      // pedimos todos los pnr que tiene este pasagero 
      axios.get("pnr/details/" + id).then(response => {
        // mandamos todo la respuesta por event bus al PnrComponent
        eventBus.$emit("paxWasClicked", response.data);
      });
    },
   
  }
};
</script>