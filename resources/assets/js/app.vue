<template>
    <v-app class="">
        <main>
            <v-container>
                <v-layout row>
                    <v-flex xs9>
                        <v-select
                                v-bind:items="items"
                                v-model="selectedState"
                                label="Select"
                                itemText="name"
                                prepend-icon="search"
                                autocomplete
                        ></v-select>
                    </v-flex>
                    <v-flex xs2 offset-xs1>
                        <v-text-field
                                @keyup.enter="cubsNumberEntered"
                                v-model="cubsNumber"
                                name="cubsNumber"
                                label="Cubs #"
                                id="testing"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs6>
                        <v-card light class="">
                            <v-card-text>
                                <div v-if="selectedState">
                                    <state-notes></state-notes>
                                </div>
                                <div v-else>
                                    <h4 class="">Please Select A State</h4>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs6>
                        <v-card light class="">
                            <v-card-text>
                                <div v-if="selectedState">
                                    <state-counties @cubsCallOver="cubsCallEnded"  :cubsCall="cubsCall" :cubsCounty="cubsCounty"></state-counties>
                                </div>
                                <div v-else>
                                    <h4 class="">Please Select A State</h4>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </main>
    </v-app>
</template>

<script>
    export default {
        props:[
            'items'
        ],
        computed:{
            currentStateObj(){
                return this.$store.state.states.currentState;
            }
        },
        data() {
            return{
                selectedState: '',
                apiKey : 'AIzaSyAAK-Blg6TN6PMjZdPkahbMs-CKRx-aXbY',
                cubsCity : '',
                cubsState : '',
                cubsCounty: '',
                cubsNumber: '',
                cubsCall: false
            }
        },
        watch: {
            selectedState(){
                this.$store.commit('setSelectedState', this.selectedState.id);
                this.$store.dispatch('setCurrentState');
            },
        },
        methods:{
            cubsNumberEntered(){
                this.cubsCall = true;
                this.callToCubs()
                    .then(() => this.cubsCountyLookup())
                    .then(() => this.findStateFromAbbr(this.cubsState));
            },

            callToCubs(){

                return new Promise((resolve, reject) => {
                    axios.get('https://cubsapi.wilbergroup.com/v1/get_claimant_info?wilber_file_number=' + this.cubsNumber)
                        .then(({data:{data}}) => {
                            this.cubsCity = (data.c1.city);
                            this.cubsState = (data.c1.state);
                            resolve();
                        })
                })
            },
            cubsCountyLookup() {
                return new Promise((resolve, reject) => {
                    axios.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + this.cubsCity + ',' + this.cubsState + '&key=' + this.apiKey)
                        .then((response) => {
                            this.cubsCounty = response.data.results[0].address_components.filter((info) => {
                                return info.types[0] === 'administrative_area_level_2';
                            })[0].long_name;
                            resolve();
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                })

            },
            cubsCallEnded(){
                this.cubsCounty = '';
                this.cubsCall = false;
            },
            findStateFromAbbr(abbr){
                let stateIWant = this.items.filter((state) => {
                    return state.abbr == abbr
                })[0];
                this.selectedState = stateIWant;
            },
        },
    }
</script>