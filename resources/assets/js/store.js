import vuex from 'vuex'
import * as Vue from "vue";

Vue.use(vuex);


const state = {
    stateList: [],
    state: {},
};

const mutations = {
    init(states){
        this.stateList = states;
    },
    updateState(selectedState){
        this.state = this.stateList.filter((state) => {
            return state.name == selectedState;
        })[0];
    },
};

export default new vuex.Store({
    state,
    mutations
});