<template>
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="flex" style="">
                    <div class="flex fl-ai-b">
                        <label class="pr1">State</label>
                        <select name="stateDropdown" class="form-control" v-model="selectedState">
                            <option></option>
                            <option v-for="state in data" v-bind:value="state.id" >{{state.name}}</option>
                        </select>
                    </div>
                    <input @keyup.enter="cubsNumberEntered" v-model="cubsNumber" style="margin-left: auto" class="" type="text" placeholder="Cubs #">
                </div>
                <div class="row">
                    <hr>
                </div>
                <div class="panels-container" id="">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <state-notes v-if="selectedState"></state-notes>
                                <h1 v-else>Please Select a State</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <state-counties :cubsNumber="cubsNumber" :cubsCounty="cubsCounty" v-if="selectedState"></state-counties>
                                <h1 v-else>Please Select a State</h1>
                            </div>
                        </div>
                    </div>
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
                cubsCity : '',
                cubsState : '',
                cubsCounty: '',
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
            findStateFromAbbr(abbr){
                let stateIWant = this.data.filter((state) => {
                    return state.abbr == abbr
                })[0];
                this.selectedState = stateIWant.id;
            },
        },
    }
</script>
