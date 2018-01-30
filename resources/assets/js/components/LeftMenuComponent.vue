<template>
    <div class="left-menu">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" 
                    data-toggle="collapse" 
                    data-target="#left-navbar-collapse" 
                    aria-expanded="false">
                    <i class="fa fa-arrow-circle-down"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="left-navbar-collapse">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation">
                    <a v-bind:href="homeUrl"><i class="fa fa-home"></i>Inicio</a>
                </li>
                <li role="presentation">
                    <a href="" class="dropdown-toggle" 
					            	    data-toggle="dropdown">
					            	    <span class="fa fa-plane"></span>
					            	    Itinerarios<span class="caret"></span>
					            	</a>
                    <ul class="dropdown-menu">
                        <li><a v-bind:href="itinerariesCreate">Nuevo</a></li>
                        <li><a v-bind:href="itinerariesAll">Todos</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href=""><i class="fa fa-user"></i>Pasageri</a></li>
                <li role="presentacion"><a href=""><i class="fa fa-plane"></i>Itinerarios</a></li>
            </ul>
        </div>
    </div>
    
</template>

<script>
    export default {
        props: ['homeUrl','changesUrl','passengersUrl', 'itinerariesCreate','itinerariesAll'],
        data() {
            return {
                
            }
        },
        mounted() {
            console.log('Left menu url: '+this.homeUrl);
        }
    }
</script>