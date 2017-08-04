<template>
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="flex" style="">
                    <div class="flex fl-ai-b">
                        <label class="pr1">State</label>
                        <select class="form-control" v-model="selectedState">
                            <option></option>
                            <option v-for="state in data" v-bind:value="state.name" >{{state.name}}</option>
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
                                <state-notes :currentStateObj="currentStateObj" v-if="selectedState"></state-notes>
                                <h1 v-else>Please Select a State</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <state-counties :currentStateObj="currentStateObj" v-if="selectedState"></state-counties>
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
            }
        },
        watch: {
            selectedState(){
                this.$store.commit('updateCurrentState', this.selectedState)
            },
        },
        computed:{
            currentStateObj(){
                return this.$store.state.states.currentState;
            }
        },
        created(){
            this.$store.commit('init', this.data);
        }
    }
</script>
