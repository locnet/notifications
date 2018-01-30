<template>
    <div class="col-md-12 col-xs-12">
        <ul v-for="(value,key) in oldComments">
            <li v-for="v in value">{{ v }}</li>
        </ul>
        <form class="form-horizontal">
            <div class="col-md-12 col-xs-12">
                <div class="input-group">
                    <textarea  rows="6" cols="200" v-model="comments" class="form-control" name="comments"
                                style="width:100%"></textarea>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                    <button @click.stop.prevent="saveComments" class="btn btn-primary">Guarda</button>
            </div>
            <div class="col-md-6 col-xs-12">
                <p>Status : {{ status }}</p>
            </div>
        </form>
             <div class="col-md-3 col-xs-6"></div>
                <a v-bind:href="close_notification_url"
                    v-if="pnrData.status == 1">
                    <button class="btn btn-warning">Cerrar notificacion</button></a>
            </div>
       
           
    </div>
</template>

<script>
    export default {
        props: ['pnr','old_comments','close_notification_url'],
        data() {
            return {
                pnrData: JSON.parse(this.pnr),          // el pnr
                comments: '',                           // v-model textarea
                status: ' sin guardar',
                oldComments: ''
            }
        },
        methods: {
            saveComments() {
                // guarda un nuevo comentario en la base de datos pnrs de forma asincrona
                axios.patch('change/update/',{
                        id: this.pnrData.id,            // id pnr a actualizar
                        comment: this.comments          // nuevo comentario

                    }).then( response => {
                        console.log(response);
                        this.status = " El comentario ha sido guardado!";      
                        // añado el nuevo comentario a los antiguos
                        this.oldComments.item.push(this.comments);
                        // despues de guardar el comentario reseteo el textarea
                        this.comments = '';                      
                        
                    }).catch(error => {
                            console.log(error.response)
                        }
                    );
            },
            parseComments(unparsedText) {
                var c = {};
                c.item = [];
                var text = unparsedText;

                // los antiguos comentarios vienen en un solo string, delimitados por '&'
                // hay que separarlos para poder ser leidos

                while (text.indexOf('&') != -1) {                    
                    var semicolon = text.indexOf(';');   // separacion entre fecha y comentario
                    var slash = text.indexOf('&');       // separacion entre comentarios

                    var f = text.substring(0,semicolon); // la fecha
                    
                    var t = text.substring(semicolon + 1, slash); // texto comentario
                    c.item.push(f + " " + t);                    
                    // despues de añadir al objeto quito el comentario del string y 
                    // paso al siquiente
                    text = text.substring(slash + 1,text.lenght);

                }
                return c;
            }
        },
        created() {
            // al crear el componente hay que formatear los comentarios antiguos
            this.oldComments = this.parseComments(this.old_comments);
            console.log("url: " + this.close_notification_url);
        }
    }
</script>