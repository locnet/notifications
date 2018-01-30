<template>
    <div class="row outbound">
        <div class="col-md-12">
            <h4>Vuelo de ida</h4>
        </div>
        
        <div class="col-md-3 col-xs-7">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.outbound_dep_date !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>Salida
                </div>
                <input type="text" class="form-control" id="outbound_dep_date"
                        name="outbound_dep_date"
                        placeholder="Fecha salida"
                        v-bind:value="outbound_dep_date">
            </div>
        </div>
        <div class="col-md-2 col-xs-5">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.outbound_dep_hour !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" id="outbound_dep_hour" class="form-control"
                            name="outbound_dep_hour"
                            placeholder="Hora salida"
                            v-bind:value="outbound_dep_hour" />
            </div>
        </div>                               
        <div class="col-md-3 col-xs-7">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.outbound_arr_date !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>Llegada
                </div>
                <input type="text" class="form-control" id="outbound_arr_date"
                        name="outbound_arr_date"
                        placeholder="Fecha llegada" 
                        v-bind:value="outbound_arr_date" />
            </div>
        </div>
        <div class="col-md-2 col-xs-5">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.outbound_arr_hour !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" id="outbound_arr_hour" class="form-control"
                        name="outbound_arr_hour"
                        placeholder="Hora llegada"
                        v-bind:value="outbound_arr_hour" />
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-hand-stop-o"></i>
                </div>
                <select name="outbound_scale" @change="setOutboundScale" 
                        v-model="outboundScale" class="form-control">
                    <option value = 0 
                        :selected ="outboundScale == 0">No</option>
                    <option value = 1
                        :selected ="outboundScale == 1">Si</option>
                </select>                                                    
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
    props: ['errors','outbound_dep_date','outbound_dep_hour','outbound_arr_date','outbound_arr_hour',
            'old_outbound_scale'],
    data() {
        return {
            inputGroup: 'input-group',
            hasErrors: JSON.parse(this.errors),
            outboundScale: this.old_outbound_scale == '' ? 0 : this.old_outbound_scale
        }
    },
    methods: {
        // emitimos catre eventBus el tipo de vuelo, con escala o directo
        // al cambiar el select outbound_scale enseña/esconde el div del vuelo escala
        // el listener esta en OutboundScaleFly
        setOutboundScale() {
                eventBus.$emit('outboundFlightType',this.outboundScale);
            }
    }
}
</script>
