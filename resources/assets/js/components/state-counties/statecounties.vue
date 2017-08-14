<template>
    <div>
        <div style="display: flex; justify-content: center; align-items: baseline" class="pb-3">
            <h3 style="flex: 1;" id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Counties</span>
            </h3>
            <span class="pr-2"><add-county @countyAdded="onCountyAdded" :cubsCall="cubsCall" :cubsCounty="cubsCounty"></add-county></span>
        </div>

        <div>
            <div>
                <v-expansion-panel  v-if="currentStateObj.counties" v-for="(county,i) in currentStateObj.counties" :key="i">
                    <v-expansion-panel-content ripple :id="'countyBtn' +county.id" @click.native="countyClicked(county)" >
                        <div slot="header">{{county.name}}</div>
                        <v-card>
                            <p style="text-align: center">
                                <add-contact :county="county"></add-contact>
                            </p>
                            <v-card-text v-if="county.contacts" v-for="(contact, i) in county.contacts" :key="i" class="grey lighten-3">
                                <v-card class="elevation-7">
                                    <v-card-title style="display: flex; justify-content: center; align-items: baseline">
                                        <h5 style="flex: 1;" class="text-xs-center">{{contact.contact_name}}</h5>
                                        <edit-contact :contact="contact"></edit-contact>
                                        <delete-contact :contact="contact"></delete-contact>
                                    </v-card-title>
                                    <v-divider></v-divider>
                                    <v-card-text>
                                        <div style="display: flex; flex-direction: column">
                                        </div>
                                        <p v-if="contact.phone" >Phone Number: {{contact.phone}}</p>
                                        <p v-if="contact.address1" >Address: {{contact.address1}}</p>
                                        <p v-if="contact.city" >City: {{contact.city}}</p>
                                        <p v-if="contact.zip" >ZipCode: {{contact.zip}}</p>
                                        <p v-if="contact.fax" >Fax: {{contact.fax}}</p>
                                        <p v-if="contact.email" >Email: {{contact.email}}</p>
                                        <p v-if="contact.website" >website: <a :href="contact.website">{{contact.city}}</a></p>
                                        <p v-if="contact.notes" style="">Notes: {{contact.notes}}</p>
                                        <v-divider></v-divider>
                                    </v-card-text>
                                </v-card>
                            </v-card-text>
                        </v-card>
                        <v-card v-if="county.contacts == ''">
                            <v-card-text class="grey lighten-3">
                                <v-card class="elevation-7">
                                    <v-card-title  style="display: flex; flex-direction: column; ">
                                        <h5>No Contacts For This County</h5>
                                    </v-card-title>
                                    <v-divider></v-divider>
                                    <v-card-text>
                                    </v-card-text>
                                </v-card>
                            </v-card-text>
                        </v-card>
                    </v-expansion-panel-content>
                </v-expansion-panel>
                <!--<v-card v-else>-->
                    <!--<v-card-text class="grey lighten-3">-->
                        <!--<v-card class="elevation-7">-->
                            <!--<v-card-title  style="display: flex; flex-direction: column; ">-->
                                <!--<h5>No Counties For This State</h5>-->
                            <!--</v-card-title>-->
                            <!--<v-divider></v-divider>-->
                            <!--<v-card-text>-->
                            <!--</v-card-text>-->
                        <!--</v-card>-->
                    <!--</v-card-text>-->
                <!--</v-card>-->
            </div>
        </div>
    </div>

</template>

<script>
    Vue.component('add-county', require('./add-county.vue'));
    Vue.component('add-contact', require('../county-contacts/create.vue'));
    export default {
        props:['cubsCall', 'cubsCounty'],
        data() {
            return{
                selectedCounty: '',
                selectedContact:{},
                countyAdded: false,
            }
        },
        computed: {
            currentStateObj(){
                return this.$store.getters.getCurrentState;
            }
        },
        watch:{
            cubsCall(){
            }
        },
        methods: {
            countyClicked(county){
                this.selectedCounty = this.selectedCounty == county.id ? '' : county.id;
                this.$store.commit('setSelectedCounty', county.id);
            },
            currentContact(contact){
                this.selectedContact = contact;
            },
            test(){
                console.log('test')
            },
            newCounty(){
                this.$emit('newCounty', this.createdCounty)
            },
            onCountyAdded(){
                if(this.cubsCall == false){
                    setTimeout(() =>{
                        this.selectedCounty = this.$store.getters.getSelectedCounty.id;
                        $('#countyBtn' + this.selectedCounty).find(':first').trigger('click');
                    }, 500);

                    setTimeout(() =>{
                        $('#createContact').trigger('click');
                    }, 1500);
                }
            }
        },
        updated(){
            if(this.cubsCall == true){
                if(this.currentStateObj.counties == ''){

                    this.$emit('cubsCallOver')

                }
                else{
                    this.selectedCounty = this.currentStateObj.counties.filter((county) => {
                        return this.cubsCounty == county.name;
                    })[0].id;
                    $('#countyBtn' + this.selectedCounty).find(':first').trigger('click');
                    this.$emit('cubsCallOver')
                }


//                console.log($('#countyBtn203'));
//                his.selectedCounty)

            }

        }
    }
</script>