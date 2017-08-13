
<template>
    <div>
    	<div style="display: flex; justify-content: center; align-items: baseline" class="pb-3">
			<h3 style="flex: 1;" id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Counties</span>
			</h3>
			<span class="pr-2"><add-county></add-county></span>
		</div>

		<div>
			<div>
				<v-expansion-panel>
					<v-expansion-panel-content  ripple v-for="(county,i) in currentStateObj.counties" :key="i">
						<div slot="header">{{county.name}}</div>
						<v-card v-for="(contact, i) in county.contacts" :key="i">
							<v-card-text class="grey lighten-3">
								<v-card class="elevation-7">
									<v-card-title style="display: flex; justify-content: center; align-items: baseline">
										<h5 style="flex: 1;" class="text-xs-center">{{contact.contact_name}}</h5>
										<edit-contact :contact="contact"></edit-contact>
										<!--<delete-contact :contact="contact"></delete-contact>-->

										<v-btn icon outline fab small class="" slot="activator">
											<v-icon>cancel</v-icon>
										</v-btn>

									</v-card-title>
									<v-divider></v-divider>
									<v-card-text>
										<div style="display: flex; flex-direction: column">
												<!--<a @click="currentContact(contact)" data-toggle="modal" :data-target="'#edit' + contact.id" style="margin-right: auto; padding-right: 8px"><span class="glyphicon glyphicon-pencil"></span></a>-->
												<!--<a @click="currentContact(contact)" data-toggle="modal" :data-target="'#delete' + contact.id"  style="margin-right: auto"><span class="glyphicon glyphicon-remove"></span></a>-->
											</div>
											<p v-if="contact.phone" >Phone Number: {{contact.phone}}</p>
											<p v-if="contact.address1" >Address: {{contact.address1}}</p>
											<p v-if="contact.city" >City: {{contact.city}}</p>
											<p v-if="contact.zip" >ZipCode: {{contact.zip}}</p>
											<p v-if="contact.fax" >Fax: {{contact.fax}}</p>
											<p v-if="contact.email" >Email: {{contact.email}}</p>
											<p v-if="contact.website" >website: <a :href="contact.website">{{contact.city}}</a></p>
											<p v-if="contact.notes" style="">Notes: {{contact.notes}}</p>
										<v-divider></v-divider>
									</v-card-text>
								</v-card>
							</v-card-text>
						</v-card>
					</v-expansion-panel-content>
				</v-expansion-panel>
			</div>
		</div>

        <!--<div id="notes-container">-->
            <!--<div v-for="county in currentStateObj.counties">-->
                <!--<button @click="countyClicked(county)" class="btn btn-primary block mb075 w100p">{{ county.name}}</button>-->
                <!--<div class="contacts-container" :class="{collapse: county.id !== selectedCounty}">-->
                    <!--<hr>-->
                    <!--<div v-for="contact in county.contacts">-->
                            <!--<div class="row">-->
                                <!--<div class="col-sm-12">-->
                                    <!--<div style="display: flex; flex-direction: column">-->
                                        <!--<div class="panel panel-default text-center">-->
                                            <!--<div class="panel-heading flex" style="align-items: baseline">-->
                                                <!--<h5 class="panel-heading" style="flex: 3;">{{contact.contact_name}}</h5>-->
                                                <!--<a @click="currentContact(contact)" data-toggle="modal" :data-target="'#edit' + contact.id" style="margin-right: auto; padding-right: 8px"><span class="glyphicon glyphicon-pencil"></span></a>-->
                                                <!--<a @click="currentContact(contact)" data-toggle="modal" :data-target="'#delete' + contact.id"  style="margin-right: auto"><span class="glyphicon glyphicon-remove"></span></a>-->
                                            <!--</div>-->
                                            <!--<p v-if="contact.phone" >Phone Number: {{contact.phone}}</p>-->
                                            <!--<p v-if="contact.address1" >Address: {{contact.address1}}</p>-->
                                            <!--<p v-if="contact.city" >City: {{contact.city}}</p>-->
                                            <!--<p v-if="contact.zip" >ZipCode: {{contact.zip}}</p>-->
                                            <!--<p v-if="contact.fax" >Fax: {{contact.fax}}</p>-->
                                            <!--<p v-if="contact.email" >Email: {{contact.email}}</p>-->
                                            <!--<p v-if="contact.website" >website: <a :href="contact.website">{{contact.city}}</a></p>-->
                                            <!--<p v-if="contact.notes" style="">Notes: {{contact.notes}}</p>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<delete-contact :contact="selectedContact"></delete-contact>-->
        <!--</div>-->
    </div>

</template>

<script>
    Vue.component('add-county', require('./add-county.vue'));

    export default {
        props: ['currentStateObj'],
        data() {
            return{
                selectedCounty: {},
                selectedContact:{},
            }
        },
        methods: {
            countyClicked(county){
                this.selectedCounty = this.selectedCounty === county.id ? '' : county.id;
            },
            currentContact(contact){
                this.selectedContact = contact;
            }
//            newCounty(){
//                this.$emit('newCounty', this.createdCounty)
//            }
//
        }
    }
</script>