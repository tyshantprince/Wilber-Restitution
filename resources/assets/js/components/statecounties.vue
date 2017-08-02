<style scoped>
    .contacts {
        overflow-y: scroll;
    }

    .modal-body {
        max-height: 75vh;
        overflow-y: scroll;
    }
</style>

<template>
    <div>
    	<span class="state-notes-header">
		<h3 id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Counties</span></h3>

	</span>

        <div id="notes-container">

            <div v-if="counties.length > 0" v-for="county in counties">
                <div class="flex">
                    <button @click="countyClicked" class="btn btn-primary fl1" data-toggle="modal" :data-target="'#contact' + county.id" style="margin-bottom: 10px">{{ county.name}}</button>
                </div>


                <div class="modal fade contacts" :id="'contact' + selectedCounty.id" tabindex="-2">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">{{selectedCounty.name}} County Contacts</h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-default">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Contact Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Zip</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="contact in contacts">
                                            <th scope="row">{{contact.contact_name}}</th>
                                            <td>{{contact.phone}}</td>
                                            <td>{{contact.address1}}</td>
                                            <td>{{contact.city}}</td>
                                            <td>{{contact.zip}}</td>
                                            <td><span class="glyphicon glyphicon-pencil"></span></td>
                                            <td><span class="glyphicon glyphicon-remove"></span></td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer" >

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="add-field right">
                <a href="#" class="btn-large" data-type="note" data-state="<?php echo $state; ?>"><span class="btn-add">New Note</span></a>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['counties'],
        data() {
            return{
                selectedCounty: '',
                contacts: ''
            }
        },
        methods: {
            countyClicked(event){
                this.selectedCounty = this.counties.filter((county) => {
                    return county.name == event.target.innerHTML;
                })[0];
                this.getContacts();
                this.$emit('county')
            },
            getContacts(){
                axios.get('/county/' + this.selectedCounty.id + '/contacts')
                    .then((response) => {
                        this.contacts = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }

        }
    }
</script>