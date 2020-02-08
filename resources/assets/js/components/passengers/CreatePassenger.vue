<template>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="col-md-12">
                <h4>Localizador reserva</h4>
            </div>
            <div class="col-md-12 col-xs-12">
                <div v-bind:class="[inputGroup,
                    {'has-error': hasErrors.loc !== undefined }]">
                    <div class="input-group-addon">
                        <i class="fa fa-ticket"></i>
                    </div>
                    <input type="text" class="form-control" id ="loc"
                            name="loc"
                            placeholder="Localizador"
                            v-bind:value="loc">
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="col-md-12">
                <h4>Telefono movil</h4>
            </div>
            <div class="col-md-12 col-xs-12">
                <div v-bind:class="[inputGroup,
                    {'has-error': hasErrors.mobil !== undefined }]">
                    <div class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                    </div>
                    <input type="text" class="form-control" id="mobil"
                            name="mobil"
                            placeholder="Telefono pasagero"
                            v-bind:value="mobil">                                                   
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="col-md-12">
                <h4>Telefono fijo</h4>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" id="fijo"
                            name="fijo"
                            placeholder="Telefono pasagero"
                            v-bind:value="fijo">                                                   
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="col-md-12">
                <h4>Linea aerea</h4>
            </div>
            <div class="col-md-12 col-xs-12">
                <div v-bind:class="[inputGroup,
                    {'has-error': hasErrors.company !== undefined }]">
                    <div class="input-group-addon">
                        <i class="fa fa-plane"></i>
                    </div>
                    <select name="company" class="form-control">
                        <option value= 'none' :selected="old_company == 0">Escoje una compania</option>
                        <option value = "BlueAir" :selected="old_company == 'BlueAir'">BlueAir</option>
                        <option value = "RyanAir" :selected="old_company == 'RyanAir'">RyanAir</option>
                        <option value = "Easyjet" :selected="old_company == 'Easyjet'">Easyjet</option>
                        <option value = "Transavia" :selected="old_company == 'Transavia'">Transavia</option>
                    </select>                                                    
                </div>
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
    props: ['errors', 'old_loc', 'old_mobil', 'old_fijo', 'old_company'],
    data() {
        return {
            inputGroup: 'input-group',
            hasErrors: JSON.parse(this.errors),
            loc: this.old_loc == '' ? null : this.old_loc,
            mobil: this.old_mobil == '' ? null : this.old_mobil,
            fijo: this.old_fijo == '' ? null : this.old_fijo,
            company: this.old_company == '' ? null : this.old_company
        }
    },
    methods: {
        
    },
    mounted() {
        console.log(this.company);
    }
}
</script>
