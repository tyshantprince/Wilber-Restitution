
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('restitution', require('./components/restitution.vue'));
Vue.component('state-notes', require('./components/statenotes.vue'));
Vue.component('state-counties', require('./components/statecounties.vue'));
Vue.component('contacts', require('./components/contacts.vue'));
Vue.component('edit-note', require('./components/edit-note.vue'));
Vue.component('delete-note', require('./components/delete-note.vue'));

Vue.use('BootstrapVue');


const app = new Vue({
    el: '#app'
});
