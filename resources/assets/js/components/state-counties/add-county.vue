<template>
    <v-dialog v-model="dialog" width="500" persistent>
        <v-btn icon outline fab light small class="primary " slot="activator">
                <v-icon light>add</v-icon>
        </v-btn>
        <v-card>
            <v-card-title class="headline">Create County</v-card-title>
            <v-text-field class="px-3"
                          required
                          name=""
                          placeholder="County Name"
                          v-model="createdCounty"
            ></v-text-field>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="green--text darken-1" flat="flat" @click.native="dialog = false">Close</v-btn>
                <v-btn class="green--text darken-1" flat="flat" @click.native="newCounty();dialog = false">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <!--<div>-->
        <!--<a class="btn-large" data-toggle="modal" data-target="#newCounty"><span class="btn-add">New County</span></a>-->
        <!--<div class="modal fade" id="newCounty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
            <!--<div class="modal-dialog" role="document">-->
                <!--<div class="modal-content">-->
                    <!--<div class="modal-header">-->
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <!--<h4 class="modal-title" id="">Create New County</h4>-->
                    <!--</div>-->
                    <!--<div class="modal-body">-->
                        <!--<input class="center-block" type="text" name="county" v-model="createdCounty" placeholder="Enter County Name">-->
                    <!--</div>-->
                    <!--<div class="modal-footer" >-->
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                        <!--<button @click="newCounty" type="button" class="btn btn-primary" data-dismiss="modal">Create County</button>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
</template>

<script>
    export default {
        data(){
            return{
                createdCounty: '',
                dialog: false,
            }
        },
        methods:{
          newCounty(){
              this.$store.commit('createCounty', this.createdCounty);
          }
        }
    }
</script>
