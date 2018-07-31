<template>
    <div class="row return" v-show="oneWayFlight == 1 ? true : false">
                                        
        <div class="col-md-12">
            <h4>Vuelo de vuelta</h4>
        </div>

        <div class="col-md-2 col-xs-6">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-hand-stop-o"></i>
                </div>
                <select name="return_scale" @change="setReturnScale" 
                        v-model="returnScale" class="form-control">
                    <option value = 0 
                        :selected ="returnScale == 0">No</option>
                    <option value = 1
                        :selected ="returnScale ==1">Si</option>
                </select>                                                    
            </div>
        </div>
        <div class="col-md-3 col-xs-7">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.return_dep_date !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>Salida
                </div>
                <input type="text" class="form-control" id="return_dep_date"
                        name="return_dep_date"
                        placeholder="Fecha salida"
                        v-bind:value="return_dep_date" />
            </div>
        </div>
        <div class="col-md-2 col-xs-5">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.return_dep_hour !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" id="return_dep_hour" class="form-control"
                        name="return_dep_hour"
                        placeholder="Hora salida"
                        v-bind:value="return_dep_hour" />
            </div>
        </div>
        
        <div class="col-md-3 col-xs-7">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.return_arr_date !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>Vuelta
                </div>
                <input type="text" class="form-control" id="return_arr_date"
                        name="return_arr_date"
                        placeholder="Fecha llegada" 
                        v-bind:value="return_arr_date" />
            </div>
        </div>
        <div class="col-md-2 col-xs-5">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.return_arr_hour !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" id="return_arr_hour" class="form-control"
                        name="return_arr_hour"
                        placeholder="Hora llegada"
                        v-bind:value="return_arr_hour" />
            </div>
        </div> 
    </div>
</template>

<script>
// import the event bus
import { eventBus }  from '../../app.js';

export default {
   
     /**
    * para repoblar el formulario en caso de eror con los datos ya introducidos utilizamos las props
    * los valores vienen de create.blade.php mediante la funcion old()
    * 
    * 'errors' es un objeto que contiene todos los errores del formulario. Se utiliza para añadir la 
    * clase css 'has-error' al input-group.
    */

    props: ['errors','old_return_scale','return_dep_date','return_dep_hour','return_arr_date',
            'return_arr_hour','old_flight_type'],
    data() {
        return {
            inputGroup: 'input-group',
            hasErrors: JSON.parse(this.errors),
            returnScale: this.old_return_scale == '' ? 0 : this.old_return_scale,
            oneWayFlight: this.old_flight_type == '' ? 1 : this.old_flight_type
        }
    },
    methods: {
        setReturnScale() {
            eventBus.$emit('returnFlightType',this.returnScale);
        }
    },
    created() {
        // listener eventBus
        eventBus.$on('flightTypeChanged', (flight) => {
            this.oneWayFlight = flight;
        });
    }
}
</script>
