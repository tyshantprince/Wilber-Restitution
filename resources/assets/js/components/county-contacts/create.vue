<template>
    <div>

        <v-dialog v-model="dialog" width="500" persistent>
            <v-btn id="createContact" icon fab class="" slot="activator">
                <v-icon light>add</v-icon>
            </v-btn>

            <v-card>
                <v-card-title class="headline">Create Contact</v-card-title>
                <v-text-field class="px-3" label="Name" required v-model="contact.contact_name" autofocus></v-text-field>
                <v-text-field class="px-3" label="phone" v-model="contact.phone"></v-text-field>
                <v-text-field class="px-3" label="address1" v-model="contact.address1"></v-text-field>
                <v-text-field class="px-3" label="city" v-model="contact.city"></v-text-field>
                <v-text-field class="px-3" label="zip" v-model="contact.zip"></v-text-field>
                <v-text-field class="px-3" label="fax" v-model="contact.fax"></v-text-field>
                <v-text-field class="px-3" label="email" v-model="contact.email"></v-text-field>
                <v-text-field class="px-3" label="website" v-model="contact.website"></v-text-field>
                <v-text-field class="px-3" label="fee" v-model="contact.fee"></v-text-field>
                <v-text-field class="px-2" label="notes" v-model="contact.notes" textarea></v-text-field>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="green--text darken-1" flat="flat" @click.native="dialog = false">Close</v-btn>
                    <v-btn class="green--text darken-1" flat="flat" @click.native="newContact();dialog = false">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        props: ['county'],
        data() {
            return {
                contact: {
                    contact_name: '',
                    phone: '',
                    address1: '',
                    city: '',
                    zip: '',
                    fax: '',
                    email: '',
                    website: '',
                    fee: '',
                    notes: '',
                    county_id: this.county.id
                },
                dialog: false,
            }
        },
        methods: {
            newContact() {
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
                    county_id: this.countyId,
                };
            }
        }
    }
</script>