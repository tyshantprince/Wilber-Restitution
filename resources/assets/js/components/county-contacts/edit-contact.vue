<<template>
    <div>
        <button @click="toggleEditContact" class="btn btn-link"><span class="glyphicon glyphicon-pencil"></span></button>

        <transition name="modal">
            <div class="modal-mask" @click="toggleEditContact" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center">New County</h3>
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
                        <button class="btn btn-default" @click="toggleEditContact">
                            Close
                        </button>
                        <button class="btn btn-primary" @click="editContact();toggleEditContact()">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['contact'],
        computed:{
            active(){
                return this.$store.state.modals.editContact;
            }
        },
        methods: {
            editContact(){
                this.$store.dispatch('updateContact', this.contact);
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
                };
            },
            toggleEditContact() {
                this.$store.commit('toggleEditContact');
            }
        }
    }
</script>
