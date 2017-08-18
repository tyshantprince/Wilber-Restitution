<template>
    <div>
        <button @click="toggleAddCounty" class="btn btn-link" style="color: gray"><span class="glyphicon glyphicon-plus"></span>Add Contact</button>

        <transition name="modal">
            <div class="modal-mask" @click="toggleAddCounty" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center" style="color: orange;">New Contact</h3>
                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn" style="background-color: transparent" @click="toggleAddCounty">
                            Close
                        </button>
                        <button class="btn" style="background-color: transparent; color: orange" @click="saveContact();toggleAddCounty()">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import FormReset from '../../mixins/form-reset';

    export default {
        props: ['countyId'],
        data() {
            return {
                showAddNote: false,
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
        computed:{
            active(){
                return this.$store.state.modals.addContact;
            }
        },
        watch: {
            countyId() {
                this.contact.county_id = this.countyId;
            },
        },
        methods: {
                saveContact() {
                    this.$store.dispatch('createContact', this.contact)
                        .then(() => {
                            Object.keys(this.contact).forEach(input => this.contact[input] = '');
                            this.contact.county_id = this.countyId
                        });

                },
                toggleAddCounty() {
                    this.$store.commit('toggleAddContact');
                }
        }
    }
</script>
