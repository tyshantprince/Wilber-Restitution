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

            <div v-if="counties.length > 0" v-for="county in counties">
                    <button @click="countyClicked(county)" class="btn btn-primary block mb075 w100p">{{ county.name}}</button>
                <div class="contacts-container" :class="{collapse: county.id !== selectedCounty}">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                </div>
            </div>



            <a class="btn-large" data-toggle="modal" data-target="#newCounty"><span class="btn-add">New County</span></a>

            <div class="modal fade" id="newCounty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="">Create New County</h4>
                        </div>
                        <div class="modal-body">
                            <input class="center-block" type="text" name="county" v-model="createdCounty" placeholder="Enter County Name">
                        </div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button @click="newCounty" type="button" class="btn btn-primary" data-dismiss="modal">Create County</button>
                        </div>
                    </div>
                </div>
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
                createdCounty: '',
                contacts: ''
            }
        },
        methods: {
            countyClicked(county){
                this.selectedCounty = this.selectedCounty === county.id ? '' : county.id;
                this.getContacts();
                this.$emit('county')
            },
            getContacts(){
                if(this.selectedCounty != '')
                {
                    axios.get('/county/' + this.selectedCounty + '/contacts')
                        .then((response) => {
                            this.contacts = response.data;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            },
            newCounty(){
                this.$emit('newCounty', this.createdCounty)
            }

        }
    }
</script>