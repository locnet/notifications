<template>
    <div class="row outbound"  v-show="outboundScaleFlight == 1 ? true : false">
        <div class="col-md-12 col-xs-12">
            <div class="col-md-4 col-xs-12">
                <div v-bind:class="[inputGroup,
                            {'has-error': hasErrors.outbound_scale_station !== undefined }]">
                    <div class="input-group-addon">
                        <i class="fa fa-globe"></i>Ciudad escala
                    </div>
                    <input type="text" class="form-control" id="outbound_scale_station"
                            name="outbound_scale_station"
                            placeholder="Ciudad escala"
                            v-bind:value="outbound_scale_station">
                </div>
            </div>    
        </div>
        
        <div class="col-md-3 col-xs-7">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.outbound_scale_start_date !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>Desde
                </div>
                <input type="text" class="form-control" id="outbound_scale_start_date"
                        name="outbound_scale_start_date"
                        placeholder="Fecha salida"
                        v-bind:value="outbound_scale_start_date">
            </div>
        </div>
        <div class="col-md-3 col-xs-5">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.outbound_scale_start_hour !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" id="outbound_scale_start_hour" class="form-control"
                            name="outbound_scale_start_hour"
                            placeholder="Hora"
                            v-bind:value="outbound_scale_start_hour" />
            </div>
        </div>                               
        <div class="col-md-3 col-xs-7">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.outbound_scale_end_date !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>Hasta
                </div>
                <input type="text" class="form-control" id="outbound_scale_end_date"
                        name="outbound_scale_end_date"
                        placeholder="Fecha llegada" 
                        v-bind:value="outbound_scale_end_date" />
            </div>
        </div>
        <div class="col-md-3 col-xs-5">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.outbound_scale_end_hour !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" id="outbound_scale_end_hour" class="form-control"
                        name="outbound_scale_end_hour"
                        placeholder="Hasta"
                        v-bind:value="outbound_scale_end_hour" />
            </div>
        </div>
    </div>
</template>

<script>
// import the bus
import { eventBus } from '../../app.js';

export default {
     /**
    * para repoblar el formulario en caso de eror con los datos ya introducidos utilizamos las props
    * los valores vienen de create.blade.php mediante la funcion old()
    * 
    * 'errors' es un objeto que contiene todos los errores del formulario. Se utiliza para añadir la 
    * clase css 'has-error' al input-group.
    */
    props: ['errors','outbound_scale_station','outbound_scale_start_date','outbound_scale_start_hour',
    'outbound_scale_end_date','outbound_scale_end_hour','old_outbound_scale'],

    data(){
        return {
            inputGroup: 'input-group',
            hasErrors: JSON.parse(this.errors),
            outboundScaleFlight: this.old_outbound_scale
        }
    },

    created(){
        // eventBus listener
        eventBus.$on('outboundFlightType', (scale) => {
            this.outboundScaleFlight = scale;
        });
    }
}
</script>
