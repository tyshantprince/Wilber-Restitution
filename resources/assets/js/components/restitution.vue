<style scoped>
    .list-group > button{
        border-color: #dddddd;
        font-size: 24px;
        font-weight: 500;
    }
</style>
<template>
    <div class="world">
        <div class="title">
            <h1>Restitution <span class="helper">Helper</span></h1>
        </div>
        <div class="search-area">
            <div class="cubsNumber">
                <input id="cubs" @keyup.enter ="cubsNumberEntered" v-model="cubsNumber" class="form" type="text" placeholder="Cubs #">
            </div>
            <div class="select-state">
                <select class="form-control" name="stateDropdown" v-model="selectedState">
                    <option value="">Please Select State</option>
                    <option v-for="state in stateList" :value="state.id" >{{state.name}}</option>
                </select>
                <searching></searching>
            </div>
        </div>
        <div class="main">
        <div class="state-notes">
            <!--<div class="panel panel-default" style="border-color: #dddddd">-->
                <!--<div class="panel-heading">-->
                    <state-notes v-show="selectedState"></state-notes>
                    <div v-show="!selectedState">
                        <h1 class="text-center" style="padding: 50px 50px">Ready, Set, Restitution</h1>
                    </div>
                <!--</div>-->
            <!--</div>-->
        </div>
        <div class="state-counties">
            <!--<div class="panel panel-default" style="border-color: #dddddd">-->
                <!--<div class="panel-heading">-->
                    <state-counties v-show="selectedState"></state-counties>
                    <div class="top-states" v-show="!selectedState">
                        <h4 class="text-center">Top States</h4>
                        <div class="list-group" >
                            <button @click="selectedState=45" type="button" class="list-group-item">Texas</button>
                            <button @click="selectedState=26" type="button" class="list-group-item">Missouri</button>
                            <button @click="selectedState=11" type="button" class="list-group-item">Georgia</button>
                            <button @click="selectedState=48" type="button" class="list-group-item">Virginia</button>
                            <button @click="selectedState=14" type="button" class="list-group-item">Illinois</button>
                        </div>
                    </div>
                <!--</div>-->
            <!--</div>-->
        </div>
        </div>
        <div class="footer">
            <h5 class="text-left">v.1.0</h5>
            <h5 class="text-right">© 2017 | Wilber & Associates | Restitution <span style="color: orange;">Helper</span></h5>
        </div>
    </div>
</template>

<script>

    export default {
        props:['stateList'],
        data() {
            return{
                selectedState: '',
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
                if(this.cubsNumber)
                {
                    this.$store.commit('toggleSearching');
                    axios.get('CubsCountyLookup/' + this.cubsNumber)
                        .then( ({data}) => {
                            this.selectedState = data.stateID;
                            this.$store.commit('setSelectedCountyId', data.countyID);
                            this.$store.commit('toggleSearching');
                        })
                        .catch(error => {
                            this.$store.commit('toggleSearching');
                            toastr.error(error.response.data.error);
                        });
                    }
                }
        },
    }
</script>
