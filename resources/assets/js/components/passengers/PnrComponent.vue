<template>
    <div v-if="showDetails" class="col-md-6 col-xs-12  animated fadeIn">
        
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr class="blue">
                    <th style="width:20%">Segmento</th>
                    <th style="width:40%">Salida</th>
                    <th style="width:40%">Llegada</th>
                </tr>
            </thead> 
            <tbody>
                <tr>
                    <td>IDA</td>
                    <td><strong>{{ departureStation }}:  </strong>{{ outbound_dep_time }}</td>
                    <td><strong>{{ arrivalStation }}: </strong>{{  outbound_arr_time }}</td>
                </tr>
                <tr v-if="return_dep_time">
                    <td>VUELTA</td>
                    <td><strong>{{ arrivalStation }}: </strong>{{ return_dep_time }}</td>
                    <td><strong>{{ departureStation }}: </strong>{{  return_arr_time }}</td>
                </tr>
            </tbody>
        </table>
        <div class="col-12">
            <div class="form-group">
                <a v-bind:href=" baseUrl + '/' + pnrId">                                                                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-database"></i>Ver detalles
                    </button>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
// event bus

import { eventBus } from '../../app.js';

export default {
    props:  ['baseUrl'],
    data() {
        return {
            departureStation:'',
            arrivalStation: '',
            outbound_dep_time: '',
            outbound_arr_time:'',
            return_dep_time: '',
            return_arr_time:'',
            showDetails: false,
            pnrId: ''
        }
    },
    methods: {
        showPnrDetails(id) {            
            
            console.log("id: " + this.pnrId);

            // el boton de los detalles necesita el id del itinerario para ver los detalles
            // del itinerario 
            this.pnrId = id;

            var d = {};
            // solicitamos los detalles del localizador 
            axios.get('pnr/details/' + id)
                .then( response => {
                    d = response.data;
                })
        }
    },
    created() {
        eventBus.$on('paxWasClicked', (data) => {
            // enseño la tabla de los detalles
            this.showDetails = true;            

            // la propiedad "data" es un objeto que contiene otros objetos que 
            // son los localizadores (pnr)
            // que pertenecen a un usuario en particular
            console.log(data);
            this.departureStation = data.departure_station;
            this.arrivalStation = data.arrival_station;
            this.departureStation = data.departure_station;
            this.arrivalStation = data.arrival_station;
            this.outbound_dep_time = data.outbound_dep_time;
            this.outbound_arr_time = data.outbound_arr_time;
            this.return_dep_time = data.return_dep_time;
            this.return_arr_time = data.return_arr_time;           
        });

        // el id del pnr, viene de PassangersComponent.vue
        eventBus.$on('pnrId', (data) => {
            this.pnrId = data;
        });
    }
}
</script>