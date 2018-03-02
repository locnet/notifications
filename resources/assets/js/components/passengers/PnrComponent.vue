<template>
    <div v-if="passengerName.length > 0" class="col-md-6 col-xs-12 animated fadeIn">
        <ol class="list-group">
            <li v-for="(l,index) in length" :key="index" 
                class="list-group-item"
                style="cursor:pointer"
                @click="showPnrDetails(pnrObject[index].id)">
                {{ pnrObject[index].pnr }}
            </li>
        </ol>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="blue">
                    <th>Segmento</th>
                    <th>Salida</th>
                    <th>Llegada</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>IDA</td>
                    <td>{{ outbound_dep_time }}</td>
                    <td>{{ outbound_arr_time }}</td>
                </tr>
                <tr>
                    <td>VUELTA</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
// event bus

import { eventBus } from '../../app.js';

export default {
    data() {
        return {
            pnr: 'AAAAAA',
            flight: 'Madrid -Bucuresti',
            pnrObject: {},
            length: 0,
            passengerName: '',
            departureStation:'',
            arrivalStation: '',
            outbound_dep_time: '',
            outbound_arr_time:'',
            return_dep_time: '',
            return_arr_time:''
        }
    },
    methods: {
        showPnrDetails(id) {
            console.log("id: " + id);
            var d = {};
            // solicitamos los detalles del localizador 
            axios.get('pnr/details/' + id)
            .then( response => {
                d = response.data;
                this.departureStation = d.departure_station;
                this.arrivalStation = d.arrival_station;
                this.outbound_dep_time = d.outbound_dep_time;
                this.outbound_arr_time = d.outbound_arr_time;
                console.log(d);
            })
        }
    },
    created() {
        eventBus.$on('paxWasClicked', (data) => {
            // la propiedad "data" es un objeto que contiene otros objetos que son los localizadores (pnr)
            // que pertenecen a un usuario en particular

            this.pnrObject = data;    // el objeto

            this.passengerName = this.pnrObject[0].passenger;
            this.pnr = data[0].pnr;
            this.length = data.length;    // longitud objeto, utilizado para reiteracion por el objeto
        });
    }
}
</script>