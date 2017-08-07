<template>
    <div class="modal fade" :id="'edit' + contact.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit County Contact</h4>
                </div>
                <div class="modal-body ">

                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" v-model="contact.contact_name">

                    <label for="phone">Phone</label>
                    <input id="phone" class="form-control" type="text" v-model="contact.phone">

                    <label for="address1">Address</label>
                    <input id="address1" class="form-control" type="text" v-model="contact.address1">

                    <label for="city">City</label>
                    <input id="city" class="form-control" type="text" v-model="contact.city">

                    <label for="zip">Zipcode</label>
                    <input id="zip" class="form-control" type="text" v-model="contact.zip">

                    <label for="fax">Fax</label>
                    <input id="fax" class="form-control" type="text" v-model="contact.fax">

                    <label for="email">Email</label>
                    <input id="email" class="form-control" type="text" v-model="contact.email">

                    <label for="website">Website</label>
                    <input id="website" class="form-control" type="text" v-model="contact.website">

                    <label for="fee">Fee</label>
                    <input id="fee" class="form-control" type="text" v-model="contact.fee">

                    <label for="notes">Notes</label>
                    <textarea id="notes" class="form-control"  cols="30" rows="4" v-model="contact.notes" style="min-width: 100%"></textarea>

                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click="editContact" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['contact'],
        methods:{
            editContact(){
                this.$store.commit('updateContact', this.contact);
            }
        }
    }
</script>
