<template>
    <div class="world">
        <div class="search-area">
            <div class="cubsNumber">
                <input id="cubs" @keyup.enter ="cubsNumberEntered" @blur = "cubsNumberEntered" v-model="cubsNumber" class="form" type="text" placeholder="Cubs #">
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
                axios.get('CubsCountyLookup/' + this.cubsNumber)
                    .then( ({data}) => {
                        this.selectedState = data.stateID;
                        this.$store.commit('setSelectedCountyId', data.countyID);
                    })
                    .catch(error => console.log(error));
            }
        },
    }
</script>
