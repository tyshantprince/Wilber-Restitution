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
                                    <state-notes :currentStateObj="currentStateObj"></state-notes>
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
                                    <state-counties :currentStateObj="currentStateObj" v-if="selectedState"></state-counties>
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
                cubsNumber: '',
            }
        },
        watch: {
            selectedState(){
                this.$store.commit('updateCurrentState', this.selectedState)
            },
        },
        created(){
            this.$store.commit('init', this.items);
        }
    }
</script>

