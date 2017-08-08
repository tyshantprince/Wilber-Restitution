<template>
    <div class="modal fade" :id="'createContact' + countyId" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create County Contact</h4>
                </div>
                <div class="modal-body ">

                    <label>Name</label>
                    <input name="name" class="form-control" type="text" v-model="contact.contact_name">

                    <label>Phone</label>
                    <input name="phone" class="form-control" type="text" v-model="contact.phone">

                    <label>Address</label>
                    <input name="address1" class="form-control" type="text" v-model="contact.address1">

                    <label>City</label>
                    <input name="city" class="form-control" type="text" v-model="contact.city">

                    <label>Zipcode</label>
                    <input name="zip" class="form-control" type="text" v-model="contact.zip">

                    <label>Fax</label>
                    <input name="fax" class="form-control" type="text" v-model="contact.fax">

                    <label>Email</label>
                    <input name="email" class="form-control" type="text" v-model="contact.email">

                    <label>Website</label>
                    <input name="website" class="form-control" type="text" v-model="contact.website">

                    <label>Fee</label>
                    <input name="fee" class="form-control" type="text" v-model="contact.fee">

                    <label>Notes</label>
                    <textarea name="notes" class="form-control"  cols="30" rows="4" v-model="contact.notes" style="min-width: 100%"></textarea>

                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click="saveContact" type="button" class="btn btn-primary make-contact" data-dismiss="modal">Save Contact</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['countyId'],
        data() {
            return {
                contact: {
                    contact_name: '',
                    phone: '',
                    ext: '',
                    address1: '',
                    address2: '',
                    city: '',
                    zip: '',
                    fax: '',
                    email: '',
                    website: '',
                    fee: '',
                    notes: '',
                    county_id: '',
                },
            }
        },
        watch: {
            countyId() {
                this.contact.county_id = this.countyId;
            }
        },
        methods: {
            saveContact() {
                this.$store.dispatch('createContact', this.contact);
                this.contact = {
                    contact_name: '',
                    phone: '',
                    ext: '',
                    address1: '',
                    address2: '',
                    city: '',
                    zip: '',
                    fax: '',
                    email: '',
                    website: '',
                    fee: '',
                    notes: '',
                    county_id: this.countyId
                };
            }
        }
    }
</script>
