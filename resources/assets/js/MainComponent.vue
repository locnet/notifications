<template>        
            
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Notificaciones activas</h4>
        </div>

        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li role="presentation" v-bind:class="{active: viewFilter == 'all'}"
                                        @click="setFilter('all')">
                    <a href="#">Todos</a>
                </li>
                <li role="presentation" v-bind:class="{active: viewFilter == 'pending'}" 
                                        @click="setFilter('pending')">
                    <a href="#">Pendientes</a>
                    </li>
                <li role="presentation"  v-bind:class="{active: viewFilter == 'closed'}"
                                        @click="setFilter('closed')">
                    <a href="#">Cerrados</a>
                </li>
            </ul>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center animated fadeIn">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>PASAGERO</th>
                            <th>LOCALIZADOR</th>
                            <th class="hidden-xs">DETALLES</th>
                            <th>STATUS</th>
                            <th>DETALLES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(pnr,index) in pnrsData" v-show="checkStatus(pnr.status)" :key="index">
                            <td>{{ pnr.passenger }}</td>
                            <td>{{ pnr.pnr.toUpperCase() }}</td>
                            <td class="hidden-xs">{{ pnr.comments.substring(0,80) }}</td>
                            <td v-bind:class="{ pending: !isActive(pnr.status),
                                                closed: isActive(pnr.status) } ">
                                {{ pnr.status == 0 ? 'Cerrado' : 'Pendiente' }}
                            </td>
                            <td><a v-bind:href="baseUrl + '/' + pnr.id"
                                        @click="viewDetails = !viewDetails"
                                        style="cursor:pointer">Detalles</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>                            
        </div>
    </div>          
        
</template>

<script>
    import ChangesComponent from './components/ChangesComponent.vue';
    
    export default {
        props: ['itinerary', 'changes','pnrs','baseUrl'],
        data() {
            return {
                jsonData: JSON.parse(this.itinerary),
                jsonChanges: JSON.parse(this.changes),
                pnrsData: JSON.parse(this.pnrs),
                viewDetails:true,                
                viewFilter: 'all'
            }
        },
        methods: {
            isActive(status) {
                // evalua el status y devuelve true o false
                return status == 0;
            },
         checkStatus(status) {
                // en function del valor del "status" en la base de datos se
                // configura el color y el texto de la celda "status"

                if (this.viewFilter == 'all') {
                    // se muestran todas las notificationes
                    return true;
                } else if (this.viewFilter == 'pending') {
                    // se muestran solo las notificaciones pendientes
                    this.filter = 'pending';
                    if (status == 1) {
                        return true;
                    }
                    return false;
                } else {                
                    // se muestran la notificaiones cerradas
                    this.viewFilter = 'closed';
                    if (this.viewFilter == 'closed' && status == 0) {
                        return true;
                    }
                    return false;
                }
            },
            setFilter(filter) {
                this.viewFilter = filter;
            }            
        },
        mounted() {
            console.log("Main component mounted");
        },
        components: {
            AppChangesComponent: ChangesComponent
        }
    }
</script>
<style>
.fade-enter {
    opacity: 0;
}
.fade-enter-active {
    transition: opacity 1s;
}
.fade-leave {

}
.fade-leave-active {
    transition: opacity 1s;
    opacity: 0;
}

.slide-enter {
    opacity: 0;
}
.slide-enter-active {
    animation: slide-in 1s ease-out forwards;
    transition: opacity .5s;
}
.slide-leave {

}
.slide-leave-active {
     animation: slide-out 1s ease-out forwards;
     transition: opacity 3s;
     opacity: 0;
}
@keyframes slide-in {
    from {
        transform: translateY(20px);
    }
    to {
        transform: translateY(0);
    }
}

@keyframes slide-out {
    from {
        transform: translateY(0);
    }
    to {
        transform: translateY(20px);
    }
}
</style>
