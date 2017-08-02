<template>
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="flex" style="">
                    <div class="flex fl-ai-b">
                        <label class="pr1">State</label>
                        <select class="form-control" @change="selectState" style="">
                            <option></option>
                            <option v-for="state in states" v-bind:value="state.name" >{{state.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <hr>
                </div>
                <div class="panels-container" id="">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <state-notes @noteDeleted="deleteNote" @new="createNote" v-if="selectedState != ''" :notes="notes"></state-notes>
                                <h1 v-else>Please Select a State</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <state-counties @newCounty="createCounty"  v-if="selectedState != ''" :counties="counties"></state-counties>
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
            'states'
        ],
        data: function () {
            return{
                selectedState: '',
                stateObj: '',
                notes: '',
                counties: ''
            }
        },
        methods: {
            selectState: function(event){
                this.selectedState = event.target.value;
                this.getStateObj(this.selectedState);
                this.getNotes();
                this.getCounties();
            },
            getStateObj: function (selectedState) {
                 this.stateObj = this.states.filter(function (state) {
                    return state.name == selectedState;
                })[0];
            },
            getNotes(){
                axios.get('state/' + this.stateObj.id + '/notes')
                    .then((response) => {
                        this.notes = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                },
            deleteNote(note){
                this.notes = _.without(this.notes, note)
            },

            createNote(note){
                axios.post('state/' + this.stateObj.id + '/notes', {body: note})
                    .then((response) => {
                        this.notes.push(response.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            getCounties(){
                axios.get('state/' + this.stateObj.id + '/counties')
                    .then((response) => {
                        this.counties = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            createCounty(county){
                axios.post('state/' + this.stateObj.id + '/counties', {name: county})
                    .then((response) => {
                        this.counties.push(response.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }

    },
    }
</script>
