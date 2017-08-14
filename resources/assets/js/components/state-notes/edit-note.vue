<template>

        <v-dialog v-model="dialog" width="500" persistent>
            <v-btn icon fab small class="" slot="activator">
                <v-icon class="">create</v-icon>
            </v-btn>
            <v-card>
                <v-card-title class="headline">Edit Note</v-card-title>
                <v-text-field class="px-2"
                        name=""
                        label="Body"
                        textarea
                        v-model="note.body"
                        autofocus
                ></v-text-field>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="green--text darken-1" flat="flat" @click.native="dialog = false">Close</v-btn>
                    <v-btn class="green--text darken-1" flat="flat" @click.native="editNote();dialog = false">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>


    <!--<div class="modal fade" :id="'edit' + note.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
        <!--<div class="modal-dialog" role="document">-->
            <!--<div class="modal-content">-->
                <!--<div class="modal-header">-->
                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <!--<h4 class="modal-title">Edit State Note</h4>-->
                <!--</div>-->
                <!--<div class="modal-body">-->
                    <!--<textarea class="" name="note"  :id="note.id" cols="30" rows="4" v-model="note.body" style="min-width: 100%"></textarea>-->
                <!--</div>-->
                <!--<div class="modal-footer" >-->
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <!--<button @click="editNote" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
</template>

<script>
    export default {
        props:['note'],
        data(){
            return{
                dialog: false
            }
        },
        methods:{
            editNote(){
               this.$store.commit('updateNote', this.note)
            },
        }
    }
</script>
