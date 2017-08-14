<template>
    <v-dialog  v-model="dialog" width="500" persistent>
        <v-btn icon fab small class="" slot="activator">
            <v-icon class="">create</v-icon>
        </v-btn>
        <v-card>
            <v-card-title class="headline">Edit Contact</v-card-title>
            <v-text-field class="px-3" placeholder="Name" required v-model="contact.contact_name"></v-text-field>
            <v-text-field class="px-3" placeholder="phone" v-model="contact.phone"></v-text-field>
            <v-text-field class="px-3" placeholder="address1" v-model="contact.address1"></v-text-field>
            <v-text-field class="px-3" placeholder="city" v-model="contact.city"></v-text-field>
            <v-text-field class="px-3" placeholder="zip" v-model="contact.zip"></v-text-field>
            <v-text-field class="px-3" placeholder="fax" v-model="contact.fax"></v-text-field>
            <v-text-field class="px-3" placeholder="email" v-model="contact.email"></v-text-field>
            <v-text-field class="px-3" placeholder="website" v-model="contact.website"></v-text-field>
            <v-text-field class="px-3" placeholder="fee" v-model="contact.fee"></v-text-field>
            <v-text-field class="px-2" label="notes" v-model="contact.notes" textarea></v-text-field>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="green--text darken-1" flat="flat" @click.native="dialog = false">Close</v-btn>
                <v-btn class="green--text darken-1" flat="flat" @click.native="newCounty();dialog = false">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <!--<div class="modal fade" :id="'edit' + contact.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
        <!--<div class="modal-dialog" role="document">-->
            <!--<div class="modal-content">-->
                <!--<div class="modal-header">-->
                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <!--<h4 class="modal-title">Edit County Contact</h4>-->
                <!--</div>-->
                <!--<div class="modal-body ">-->

                    <!--<label for="name">Name</label>-->
                    <!--<input id="name" class="form-control" type="text" v-model="contact.name">-->

                    <!--<label for="phone">Phone</label>-->
                    <!--<input id="phone" class="form-control" type="text" v-model="contact.phone">-->

                    <!--<label for="address1">Address</label>-->
                    <!--<input id="address1" class="form-control" type="text" v-model="contact.address1">-->

                    <!--<label for="city">City</label>-->
                    <!--<input id="city" class="form-control" type="text" v-model="contact.city">-->

                    <!--<label for="zip">Zipcode</label>-->
                    <!--<input id="zip" class="form-control" type="text" v-model="contact.zip">-->

                    <!--<label for="fax">Fax</label>-->
                    <!--<input id="fax" class="form-control" type="text" v-model="contact.fax">-->

                    <!--<label for="email">Email</label>-->
                    <!--<input id="email" class="form-control" type="text" v-model="contact.email">-->

                    <!--<label for="website">Website</label>-->
                    <!--<input id="website" class="form-control" type="text" v-model="contact.website">-->

                    <!--<label for="fee">Fee</label>-->
                    <!--<input id="fee" class="form-control" type="text" v-model="contact.fee">-->

                    <!--<label for="notes">Notes</label>-->
                    <!--<textarea id="notes" class="form-control"  cols="30" rows="4" v-model="contact.notes" style="min-width: 100%"></textarea>-->

                <!--</div>-->
                <!--<div class="modal-footer" >-->
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <!--<button @click="editContact" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
</template>

<script>
    export default {
        props:['contact'],
        data(){
            return{
                dialog: false,
            }
        },
        methods:{
            editContact(){
                this.$store.commit('updateContact', this.contact);
            }
        }
    }
</script>
