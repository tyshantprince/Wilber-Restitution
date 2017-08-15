import Vue from 'vue';
import Vuex from 'vuex';
// import * as actions from './actions';
// import * as getters from './getters';
import states from './modules/states';
import modals from './modules/modals';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        states,
        modals,
    },
})