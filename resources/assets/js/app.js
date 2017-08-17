
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.toastr = require('toastr');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store/index';

Vue.component('restitution', require('./components/restitution.vue'));
Vue.component('state-notes', require('./components/state-notes/statenotes.vue'));
Vue.component('state-counties', require('./components/state-counties/statecounties.vue'));
Vue.component('edit-note', require('./components/state-notes/edit-note.vue'));
Vue.component('delete-note', require('./components/state-notes/delete-note.vue'));
Vue.component('add-note', require('./components/state-notes/add-note.vue'));
Vue.component('delete-contact', require('./components/county-contacts/delete-contact.vue'));
Vue.component('edit-contact', require('./components/county-contacts/edit-contact.vue'));
Vue.component('add-county', require('./components/state-counties/add-county.vue'));
Vue.component('add-contact', require('./components/county-contacts/create.vue'));
Vue.component('searching', require('./components/searching-modal.vue'));


const app = new Vue({
    store,
    el: '#app'
});
