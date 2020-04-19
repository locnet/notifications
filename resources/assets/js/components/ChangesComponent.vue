<template>
        <div class="panel-body" >
            <ul>
                
            </ul>
            <h3>Ciudad salida:{{ arrayData.departure_station }}</h3>
            <button class="btn btn-primary" @click="fetchData">click</button>
        </div>
</template>

<script>
    export default {
        props: [],
        data() {
            return {
                pnr: this.$route.params.pnr,
                arrayData: ''
            }
        },
        watch: {
            '$route'(to,from) {
                this.pnr = to.params.pnr;
            }
        },
        methods: {
            fetchData() {
                axios.get('change/'  + this.pnr)
                    .then( response => {
                        this.arrayData = response.data; console.log("arrayData: "+ this.arrayData);
                        
                    })
                    .then( data => {
                        const resultArray = [];
                        for (let key in data) {
                            resultArray.push(data[key]);
                        }
                    this.arrayData = resultArray;   
                    });
            }
        }
    }
</script>
