<style scoped>
    .contacts {
        overflow-y: scroll;
    }

    .modal-body {
        max-height: 75vh;
        overflow-y: scroll;
    }

    .collapse {
        height: 0;
    }
</style>

<template>
    <div>
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding-bottom: 10px;">
    	    <span class="state-notes-header">
		    <h3 id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Counties</span></h3>
	        </span>
            <add-county></add-county>
        </div>

        <div id="notes-container">
            <div v-for="county in currentState.counties">
                <button @click="countyClicked(county.id)" class="btn btn-primary block mb075 w100p" :id="county.id">{{ county.name}}</button>
                <div v-if="county.contacts" class="contacts-container" :class="{collapse: county.id !== currentCountyID}">
                    <add-contact class="text-center" :county-id="currentCountyID"></add-contact>
                    <hr>
                    <!--<a @click="countyClicked(county)" class="btn btn-primary mb075 w100p" data-toggle="modal" :data-target="'#create' + county.id">Add Contact</a>-->
                    <!--<a @click="newContact" :id="'addButton' + county.id" data-toggle="modal" :data-target="'#createContact' + county.id" style="margin-right: auto; padding-right: 8px">Add Contact</a>-->

                    <div v-for="contact in county.contacts">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div style="display: flex; flex-direction: column">
                                        <div class="panel panel-default text-center">
                                            <div class="panel-heading flex" style="align-items: baseline">
                                                <h5 class="panel-heading" style="flex: 3;">{{contact.contact_name}}</h5>
                                                <!--<a @click="currentContact(contact)" data-toggle="modal" :data-target="'#edit' + contact.id" style="margin-right: auto; padding-right: 8px"><span class="glyphicon glyphicon-pencil"></span></a>-->
                                                <!--<a @click="currentContact(contact)" data-toggle="modal" :data-target="'#delete' + contact.id"  style="margin-right: auto"><span class="glyphicon glyphicon-remove"></span></a>-->
                                                <edit-contact :contact="contact"></edit-contact>
                                                <delete-contact :contact="contact"></delete-contact>
                                            </div>
                                            <p v-if="contact.phone" >Phone Number: {{contact.phone}}</p>
                                            <p v-if="contact.address1" >Address: {{contact.address1}}</p>
                                            <p v-if="contact.city" >City: {{contact.city}}</p>
                                            <p v-if="contact.zip" >ZipCode: {{contact.zip}}</p>
                                            <p v-if="contact.fax" >Fax: {{contact.fax}}</p>
                                            <p v-if="contact.email" >Email: {{contact.email}}</p>
                                            <p v-if="contact.website" >website: <a :href="contact.website">{{contact.city}}</a></p>
                                            <p v-if="contact.notes" style="">Notes: {{contact.notes}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div v-else="county.contacts == ''" :class="{collapse: county.id !== currentCountyID}">
                    <a @click="newContact"  :id="'addButton' + county.id" data-toggle="modal" :data-target="'#createContact' + county.id" style="margin-right: auto; padding-right: 8px">Add Contact</a>
                    <h3>No Contacts For This County</h3>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    Vue.component('add-county', require('./add-county.vue'));
    Vue.component('add-contact', require('../county-contacts/create.vue'));

    export default {
        data() {
            return{
                selectedContact: {},
            }
        },
        computed:{
            currentState(){
                return this.$store.getters.getCurrentState;
            },
            currentCounty(){
                return this.$store.getters.getSelectedCounty;
            },
            currentCountyID(){
                return (this.$store.getters.getSelectedCounty != null) ? this.$store.getters.getSelectedCounty.id : '';
            }
        },
        methods: {
            countyClicked(id){
                if(id != this.currentCountyID){
                    this.$store.commit('setSelectedCounty', id);
                }
                else {
                    this.$store.commit('setSelectedCounty', '');
                }
//                this.selectedCounty = this.selectedCounty === id ? '' : id;
            },
            currentContact(contact){
                this.selectedContact = contact;
            },
        }
    }
</script>