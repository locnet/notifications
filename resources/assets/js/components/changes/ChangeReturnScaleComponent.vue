<template>
    <div class="row">        
        <div class="col-md-12 col-xs-10 table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="blue">
                        <th>Escala vuelo de vuelta</th>
                        <th>Ciudad de escala</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                    </tr>                    
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Original</strong></td>
                        <td>{{ iData.return_scale_station }}</td>
                        <td v-bind:class="[{'warning': iData.return_scale_start_time != cData.return_scale_start_time}]">
                            {{ iData.return_scale_start_time }}
                        </td>
                        <td v-bind:class="[{'warning': iData.return_scale_end_time != cData.return_scale_end_time}]">
                            {{ iData.return_scale_end_time }}
                        </td>                        
                    </tr>
                    <tr>
                        <td><strong>Cambio</strong></td>
                        <td>{{ cData.return_scale_station }}</td>
                        <td v-bind:class="[{'green': iData.return_scale_start_time != cData.return_scale_start_time}]">
                            {{ cData.return_scale_start_time }}
                        </td>
                        <td v-bind:class="[{'green': iData.return_scale_end_time != cData.return_scale_end_time}]">
                            {{ cData.return_scale_end_time }}
                        </td>  
                    </tr>
                </tbody>
            </table>
        </div>  
    </div>    
</template>

<script>
export default {
    props: ['itinerary','change'],
    data() {
        return {
            iData:JSON.parse(this.itinerary),
            cData: JSON.parse(this.change),                   
        }
    }
}
</script>
