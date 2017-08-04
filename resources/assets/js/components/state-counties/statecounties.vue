<style scoped>
    .contacts {
        overflow-y: scroll;
    }

    .modal-body {
        max-height: 75vh;
        overflow-y: scroll;
    }

    .collapse {
        height: 0;
    }
</style>

<template>
    <div>
    	<span class="state-notes-header">
		    <h3 id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Counties</span></h3>
	    </span>

        <div id="notes-container">

            <div v-for="county in currentStateObj.counties">
                    <button @click="countyClicked(county)" class="btn btn-primary block mb075 w100p">{{ county.name}}</button>
                <div v-if="county.contacts.length > 0" class="contacts-container" :class="{collapse: county.id !== selectedCounty}">
                    <div v-for="contact in county.contacts">
                        <div class="panel panel-default">
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-block" style="display: flex; align-items: flex-start; flex-wrap: wrap; justify-content: space-between; align-items: flex-end">
                                                <div v-for="(key, val) in contact" class="card-text" >
                                                    <div v-if="key != '' && val != 'id' && val != 'user_id' && val != 'county_id' " class="">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                {{val}}
                                                            </div>
                                                            <div class="panel-body">
                                                                {{key}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else :class="{collapse: county.id !== selectedCounty}">
                    No Contacts For This County
                </div>
            </div>
        </div>
        <add-county></add-county>
    </div>

</template>

<script>
    Vue.component('add-county', require('./add-county.vue'));

    export default {
        props: ['currentStateObj'],
        data() {
            return{
                selectedCounty: {},
            }
        },
        methods: {
            countyClicked(county){
                this.selectedCounty = this.selectedCounty === county.id ? '' : county.id;
            },
//            newCounty(){
//                this.$emit('newCounty', this.createdCounty)
//            }
//
        }
    }
</script>