import Vue from 'vue';
import Vuex from 'vuex';
import states from './modules/states';
import modals from './modules/modals';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        states,
        modals,
    },
})