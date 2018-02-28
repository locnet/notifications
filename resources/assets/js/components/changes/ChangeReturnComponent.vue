<template>
    <div class="row">        
        <div class="col-md-12 col-xs-10 table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="blue">
                        <th>Vuelo de vuelta</th>
                        <th>De</th>
                        <th>A</th>
                        <th>Despega</th>
                        <th>Ateriza</th>
                    </tr>                    
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Original</strong></td>
                        <td>{{ iData.arrival_station }}</td>
                        <td>{{ iData.departure_station }}</td>
                        <td v-bind:class="[{'warning': iData.return_dep_time != cData.return_dep_time}]">
                            {{ iData.return_dep_time }}
                        </td>
                        <td v-bind:class="[{'warning': iData.return_arr_time != cData.return_arr_time}]">
                            {{ iData.return_arr_time }}
                        </td>                        
                    </tr>
                    <tr>
                        <td><strong>Cambio</strong></td>
                        <td>{{ cData.departure_station }}</td>
                        <td>{{ cData.arrival_station }}</td>
                        <td v-bind:class="[{'green': iData.return_dep_time != cData.return_dep_time}]">
                            {{ cData.return_dep_time }}
                        </td>
                        <td v-bind:class="[{'green': iData.return_arr_time != cData.return_arr_time}]">
                            {{ cData.return_arr_time }}
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
