<template>
    <div class="col-md-4 col-xs-12 animated fadeIn">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="blue">
                    <th>Nombre / Telefono</th>
                </tr>                  
            </thead>
            <tbody>
                <tr >
                    <td>
                        <ul class="list-group">
                            <li v-for="(p,index) in pax" :key="index"
                                v-on:click="showPaxPnrs(p.id), firstItem = p.id" 
                                style="cursor:pointer"
                                v-bind:class="[liStyle, {active: firstItem == p.id}]">
                                {{ p.passenger }} / {{ p.phone}}
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
      firstItem: 0                       // utilizado para cambiar el background del item selecionado
    };
  },
  methods: {
    showPaxPnrs(id) {
      // cambio el background del td clickeado
      this.firstItem = id;

      // pedimos todos los pnr que tiene este pasagero 
      axios.get("passenger/pnrs/" + id).then(response => {
        // mandamos todo la respuesta por event bus al PnrComponent
        eventBus.$emit("paxWasClicked", response.data);
      });
    }
  }
};
</script>