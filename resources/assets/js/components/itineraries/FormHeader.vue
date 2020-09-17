<template>
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.title !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-info-circle"></i>Titulo
                </div>
                <input type="text" name="title" class="form-control"
                    placeholder="Titlu" v-bind:value="old_title" />
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-retweet"></i>Tipo vuelo
                </div>
                <select name="return_flight" class="form-control" @change="setFlightType"
                        v-model="flightType">
                    <option value=0 :selected="flightType == 0">Solo ida</option>
                    <option value=1 :selected="flightType == 1">Ida y vuelta</option>
                </select>                                                    
            </div>
        </div>
       
        <div class="col-md-4 col-xs-6">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.departure_station !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-globe"></i>Desde
                </div>
                <input type="text" name="departure_station" class="form-control"
                            placeholder="Salida de" 
                            v-bind:value="old_departure_station"/>
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.arrival_station !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-globe"></i>Hasta
                </div>
                <input type="text" name="arrival_station" class="form-control"
                            placeholder="LLegada a"
                            v-bind:value="old_arrival_station" />
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.carrier!== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-plane"></i>Linea aerea
                </div>
                <input type="text" name="carrier" class="form-control"
                            placeholder="Compania"
                            v-bind:value="old_carrier" />
            </div>
        </div>
    </div>
</template>

<script>
// import event bus
import { eventBus } from '../../app.js';

export default {
    /**
    * para repoblar el formulario en caso de eror con los datos ya introducidos utilizamos las props
    * los valores vienen de create.blade.php mediante la funcion old()
    * 
    * 'errors' es un objeto que contiene todos los errores del formulario. Se utiliza para añadir la 
    * clase css 'has-error' al input-group.
    */

    props: ['old_title','old_return_flight','old_departure_station','old_arrival_station',
            'old_carrier','errors'],
    data() {
        return {
            inputGroup: 'input-group',
            hasErrors: JSON.parse(this.errors),
            flightType: this.old_return_flight == '' ? 1 : this.old_return_flight          // para eventBus

        }
    },
    methods: {
        // emitimos el tipo de vuelo, el listener esta en ReturnScaleFly.vue
        setFlightType() {
            eventBus.$emit('flightTypeChanged',this.flightType);
            // en el caso de que la escala del vuelo de vuelta esta visible cambiamos el estado
            eventBus.$emit('returnFlightType',0);
        }
    },
    created(){
        this.setFlightType();
    }
}
</script>

