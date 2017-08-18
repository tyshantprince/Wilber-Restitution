<style scoped>
    .collapse {
        height: 0;
    }
    .contact-grid{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto;
        align-items: start;
        grid-column-gap: 5px;
    }
    .card {
        /* Add shadows to create the "card" effect */
        border-color: black;
        box-shadow: 4px 8px 16px rgba(0,0,0,0.2);
        transition: 0.3s;
        display: grid;
        grid-template-rows: 1fr ;
    }

    /* On mouse-over, add a deeper shadow */
    .card:hover {
        box-shadow: 8px 16px 32px rgba(0,0,0,0.2);
    }
    div > p {
        font-family: Avenir, Helvetica, sans-serif
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
                <button @click="countyClicked(county.id)" class="btn block w100p" style="background-color: #ddd; margin: 2% 2%" :id="county.id"><h4 style="font-weight: 700; color: black; ">{{ county.name}}</h4></button>
                <div v-if="county.contacts" class="contacts-container" :class="{collapse: county.id !== currentCountyID}">
                    <add-contact class="text-center" :county-id="currentCountyID"></add-contact>
                    <div class="contact-grid">
                        <div class="card text-center" v-for="contact in county.contacts">
                            <h5><b>{{contact.contact_name}}</b></h5>
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

                            <!--<div class="row">-->
                                <!--<div class="col-sm-12">-->
                                    <!--<div style="display: flex; flex-direction: column">-->
                                        <!--<div class="panel panel-default text-center">-->
                                            <!--<div class="panel-heading flex" style="align-items: baseline">-->
                                                <!--<h5 class="panel-heading" style="flex: 3;">{{contact.contact_name}}</h5>-->
                                                <!--<edit-contact :contact="contact"></edit-contact>-->
                                                <!--<delete-contact :contact="contact"></delete-contact>-->
                                            <!--</div>-->
                                            <!--<p v-if="contact.phone" >Phone Number: {{contact.phone}}</p>-->
                                            <!--<p v-if="contact.address1" >Address: {{contact.address1}}</p>-->
                                            <!--<p v-if="contact.city" >City: {{contact.city}}</p>-->
                                            <!--<p v-if="contact.zip" >ZipCode: {{contact.zip}}</p>-->
                                            <!--<p v-if="contact.fax" >Fax: {{contact.fax}}</p>-->
                                            <!--<p v-if="contact.email" >Email: {{contact.email}}</p>-->
                                            <!--<p v-if="contact.website" >website: <a :href="contact.website">{{contact.city}}</a></p>-->
                                            <!--<p v-if="contact.notes" style="">Notes: {{contact.notes}}</p>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
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
                    this.$store.commit('setSelectedCountyId', id);
                }
                else {
                    this.$store.commit('setSelectedCountyId', '');
                }
            },
            currentContact(contact){
                this.selectedContact = contact;
            },
        }
    }
</script>