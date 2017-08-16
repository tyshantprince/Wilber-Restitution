<template>
    <div class="world">
        <div class="search-area">
            <div class="cubsNumber">
                <input id="cubs" @keyup.enter="cubsNumberEntered" v-model="cubsNumber" class="form" type="text" placeholder="Cubs #">
            </div>
            <div class="select-state">
                <select class="" name="stateDropdown" v-model="selectedState">
                    <option value="">Please Select State</option>
                    <option v-for="state in stateList" :value="state.id" >{{state.name}}</option>
                </select>
            </div>
        </div>
        <div class="main">
        <div class="state-notes">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <state-notes v-show="selectedState"></state-notes>
                    <h1 v-show="!selectedState">Please Select a State</h1>
                </div>
            </div>
        </div>
        <div class="state-counties">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <state-counties v-show="selectedState"></state-counties>
                    <h1 v-show="!selectedState">Please Select a State</h1>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>

    export default {
        props:['stateList'],
        data() {
            return{
                selectedState: '',
                apiKey : 'AIzaSyAAK-Blg6TN6PMjZdPkahbMs-CKRx-aXbY',
                cubsNumber: ''
            }
        },
        watch: {
            selectedState() {
                if (this.$store.state.states.selectedStateID == this.selectedState) return false;
                this.$store.commit('setSelectedStateId', this.selectedState);
                this.$store.dispatch('setCurrentState');
            },
        },
        methods: {
            cubsNumberEntered(){
                // Three possible errors
                // 1. Can't find cubs number
                // 2. Claim doesn't have a loss location
                // 3. Google can't find the county
                this.callToCubs()
                        // LOOKUP STATE BY ABBREVIATION AND SET THE FREAKING STATE
                    .then((location) => this.setStateFromAbbr(location))
                        // get the city and state
                        // set the current state to be the returned value (this is async)
                    .then((location) => this.cubsCountyLookup(location))
                        // go grab the county from google, and look to see if it exists
                        // PROBLEM is that the state ajax hasn't yet returned
                        // County is duplicated as a result

//                    .catch((error) => this.displayError(error))
                    .then((county) => this.findOrCreateCounty(county));
            },

            callToCubs(){
                return new Promise((resolve, reject) => {
                    axios.get('https://capi.wilbergroup.com/v1/get_claim_details?wilber_file_number=' + this.cubsNumber)
                        .then(({data:{data}}) => {
                            // delay the resoving of this until
                            // the state is ajaxed in

                            let location = {
                                city: data.meta.loss_location_city,
                                state: data.meta.loss_location_state,
                            };
                            resolve(location);
                        }).
                        catch(() => {
                            reject('Cubs number not found.');
                        });
                })
            },
            cubsCountyLookup(location) {
                return new Promise((resolve, reject) => {
                    axios.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + location.city + ',' + location.state + '&key=' + this.apiKey)
                        .then((response) => {
                            var county = response.data.results[0].address_components.filter((info) => {
                                return info.types[0] === 'administrative_area_level_2';
                            })[0].long_name;
                            resolve(county);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                })

            },
            setStateFromAbbr(location){
                return new Promise((resolve, reject) => {
                    let state= _.find(this.stateList, {abbr: location.state});

                    if (state === null) {
                        reject('Invalid state abbreviation in loss location.')
                    }

                    this.$store.commit('setSelectedStateId', state.id);
                    this.$store.dispatch('setCurrentState').then(() => resolve(location));
                    this.selectedState = state.id;
                });
            },

            findOrCreateCounty(county) {
                let countyObj = _.find(this.$store.getters.getCurrentState.counties, {name: county});
                if(countyObj != null){
                    this.$store.commit('setSelectedCountyId', countyObj.id)
                }
                else
                {
                    this.$store.dispatch('createCounty', county);
                }
            }
        },
    }
</script>
