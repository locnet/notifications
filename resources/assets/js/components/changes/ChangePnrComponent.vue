<template>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr class="text-center">
                    <td>Localizador: {{ pnrData.pnr }}</td>
                    <td><i class="fa fa-user"></i>{{ pnrData.passenger }}</td>
                    <td><i class="fa fa-ticket"></i>{{ pnrData.phone }}</td>
                    <td>Creado en: {{ pnrData.created_at }}</td>
                    <td v-bind:class="{ pending: !isActive(pnrData.status),
                                        closed: isActive(pnrData.status) }">
                        {{ pnrData.status == 0 ? 'Cerrado' : 'Pendiente' }}
                    </td>
                    <td v-on:click="goToCopyPage" style="cursor:pointer"><i class="fa fa-copy"></i>Copiar</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props:['pnr','copyUrl'],
    data() {
        return {
            pnrData: JSON.parse(this.pnr)
        }
    },
    methods:{
        isActive(status) {
            // evalua el status y devuelve true o false
            return status == 0;
        },
        goToCopyPage() {
            window.location.href = this.copyUrl;
        }
    },
    mounted(){
    
    }
}
</script>
