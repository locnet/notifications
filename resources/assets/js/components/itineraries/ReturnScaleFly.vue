<template>
    <div class="row return" v-show="returnScaleFlight == 1 ? true : false">
                                        
        <div class="col-md-12 col-xs-12">
            <div class="col-md-4 col-xs-12">
                <div v-bind:class="[inputGroup,
                            {'has-error': hasErrors.return_scale_station !== undefined }]">
                    <div class="input-group-addon">
                        <i class="fa fa-globe"></i>Ciudad escala
                    </div>
                    <input type="text" class="form-control"
                            name="return_scale_station"
                            placeholder="Ciudad escala"
                            v-bind:value="return_scale_station">
                </div>
            </div>    
        </div>

        <div class="col-md-3 col-xs-7">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.return_scale_start_date !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>Desde
                </div>
                <input type="text" class="form-control" id="return_scale_start_date"
                        name="return_scale_start_date"
                        placeholder="Fecha escala"
                        v-bind:value="return_scale_start_date" />
            </div>
        </div>
        <div class="col-md-3 col-xs-5">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.return_scale_start_hour !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" id="return_scale_start_hour" class="form-control"
                        name="return_scale_start_hour"
                        placeholder="Hora"
                        v-bind:value="return_scale_start_hour" />
            </div>
        </div>
        
        <div class="col-md-3 col-xs-7">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.return_scale_end_date !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>Hasta
                </div>
                <input type="text" class="form-control" id="return_scale_end_date"
                        name="return_scale_end_date"
                        placeholder="Hasta" 
                        v-bind:value="return_scale_end_date" />
            </div>
        </div>
        <div class="col-md-3 col-xs-5">
            <div v-bind:class="[inputGroup,
                        {'has-error': hasErrors.return_scale_end_hour !== undefined }]">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" id="return_scale_end_hour" class="form-control"
                        name="return_scale_end_hour"
                        placeholder="Hasta"
                        v-bind:value="return_scale_end_hour" />
            </div>
        </div>   
    </div>
</template>

<script>
import { eventBus } from "../../app.js";

export default {

     /**
    * para repoblar el formulario en caso de eror con los datos ya introducidos utilizamos las props
    * los valores vienen de create.blade.php mediante la funcion old()
    * 
    * 'errors' es un objeto que contiene todos los errores del formulario. Se utiliza para añadir la 
    * clase css 'has-error' al input-group.
    */
    props: ['errors','return_scale_start_date','return_scale_start_hour','return_scale_end_date',
            'return_scale_end_hour','old_return_scale','return_scale_station'],
    data(){
        return {
            inputGroup: 'input-group',
            hasErrors: JSON.parse(this.errors),
            returnScaleFlight: this.old_return_scale
        }
    },
    created() {
        // enseña o esconde el componente segun el tipo de vuelo directo o con escala
        // el listener escucha los cambios de returnFlightType, que se registra en
        // ReturnDirectFly.vue
        eventBus.$on('returnFlightType', (scale) => {
            this.returnScaleFlight = scale;
        });
    }
}
</script>
