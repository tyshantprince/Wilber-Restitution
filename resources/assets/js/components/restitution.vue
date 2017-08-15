<template>
    <!--<div class="row">-->
        <!--<div class="col-md-12">-->
        <!--<div class="panel panel-default">-->
            <!--<div class="panel-body">-->
                <!--<div class="flex" style="">-->
                    <!--<div class="flex fl-ai-b">-->

                    <!--</div>-->
                <!--</div>-->
                <!--<div class="row">-->
                    <!--<hr>-->
                <!--</div>-->
                <!--<div class="panels-container" id="">-->
                    <!--<div class="col-md-6">-->
                        <!--<div class="panel panel-default">-->
                            <!--<div class="panel-heading">-->
                                <!--<state-notes v-if="selectedState"></state-notes>-->
                                <!--<h1 v-else>Please Select a State</h1>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="col-md-6">-->
                        <!--<div class="panel panel-default">-->
                            <!--<div class="panel-heading">-->
                                <!--<state-counties ref="stateCounties" v-if="selectedState"></state-counties>-->
                                <!--<h1 v-else>Please Select a State</h1>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <!--</div>-->
    <!--</div>-->
    <div class="world">
        <div class="search-area">
            <div class="cubsNumber">
                <input id="cubs" @keyup.enter="cubsNumberEntered" v-model="cubsNumber" class="form" type="text" placeholder="Cubs #">
            </div>
            <div class="select-state">
                <select class=""  name="stateDropdown" v-model="selectedState">
                    <option></option>
                    <option v-for="state in data" v-bind:value="state.id" >{{state.name}}</option>
                </select>
            </div>
        </div>
        <div class="main">
        <div class="state-notes">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <state-notes v-if="selectedState"></state-notes>
                    <h1 v-else>Please Select a State</h1>
                </div>
            </div>
        </div>
        <div class="state-counties">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <state-counties ref="stateCounties" v-if="selectedState"></state-counties>
                    <h1 v-else>Please Select a State</h1>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>

    export default {
        props:[
            'data'
        ],
        data() {
            return{
                selectedState: '',
                apiKey : 'AIzaSyAAK-Blg6TN6PMjZdPkahbMs-CKRx-aXbY',
                cubsNumber: ''
            }
        },
        watch: {
            selectedState() {
                this.$store.commit('setSelectedState', this.selectedState);
                this.$store.dispatch('setCurrentState');
            },
        },
        methods: {
            cubsNumberEntered(){
                this.callToCubs()
                    .then((location) => this.cubsCountyLookup(location))
                    .then((county) => this.findOrCreateCounty(county));
            },

            callToCubs(){
                return new Promise((resolve, reject) => {
                    axios.get('https://cubsapi.wilbergroup.com/v1/get_claimant_info?wilber_file_number=' + this.cubsNumber)
                        .then(({data:{data}}) => {
                            resolve([data.c1.city, this.setStateFromAbbr(data.c1.state)]);
                        })
                })
            },
            cubsCountyLookup(location) {
                return new Promise((resolve, reject) => {
                    axios.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + location[0] + ',' + location[1] + '&key=' + this.apiKey)
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
            setStateFromAbbr(abbr){
                let stateIWant = this.data.filter((state) => {
                    return state.abbr == abbr
                })[0];
                this.selectedState = stateIWant.id;
                return stateIWant.name;
                // tell the store to set the state to whatever I find
                // return the state I find

                // The store does not have access to state list
            },
            findOrCreateCounty(county){
                let countyObj = _.find(this.$store.getters.getCurrentState.counties, {name: county})
                if(countyObj != null){
                    this.$store.commit('setSelectedCounty', countyObj.id)
                }
                else
                {
                    this.$store.dispatch('createCounty', county)
                }
            }
        },
    }
</script>
