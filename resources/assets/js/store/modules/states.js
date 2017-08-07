const state = {
    stateList: [],
    currentState:{},
    selectedStateID: '',
    selectedCountyID: '',
};

const getters = {
    getSelectedState: (state) => {
        return _.find(state.stateList, {id: state.selectedStateID});
    },
    getCurrentState: (state) => {
        return state.currentState;
    },
    getSelectedCounty: (state) => {
        if(state.selectedStateID != '')
        {
            return _.find(getters.getCurrentState(state).counties, {id: state.selectedCountyID})
        }
    },
};

const actions = {
    setCurrentState({ commit, state } ){
        axios.get('state/' + state.selectedStateID)
            .then((response) => {
                commit('setCurrentState', response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
};

const mutations = {
    setSelectedState(state, id){
        state.selectedStateID = id;
    },
    setSelectedCounty(state, id) {
        state.selectedCountyID =  id;
    },
    setCurrentState(state, data){
        state.currentState = data;
    },
    updateNote(state, note) {
        axios.patch('state/' + note.state_id + '/notes/' + note.id, {body: note.body})
            .then((response) => {})
            .catch((error) => {
                console.log(error);
            });
    },
    deleteNote(state, note) {
        axios.delete('state/' + note.state_id + '/notes/' + note.id)
            .then((response) => {
                getters.getCurrentState(state).notes = _.without(getters.getCurrentState(state).notes, note)
            })
            .catch((error) => {
                console.log(error);
            });
    },
    createNote(state, note) {
        axios.post('state/' + state.selectedStateID + '/notes', {body: note})
            .then((response) => {
                getters.getCurrentState(state).notes.push(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    createCounty(state, county) {
        axios.post('state/' + state.selectedStateID + '/counties', {name: county})
            .then((response) => {
                if(typeof response.data.contacts === "undefined"){
                    response.data.contacts = [];
                }
                getters.getCurrentState(state).counties.push(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    updateContact(state, contact) {
        axios.patch('county/' + contact.county_id + '/contacts/' + contact.id, contact)
            .then(response => console.log('success'))
            .catch(error => console.log(error));
    },
    deleteContact(state, contact) {
        axios.delete('county/' + contact.county_id + '/contacts/' + contact.id)
            .then((response) => {
                getters.getSelectedCounty(state).contacts = _.without(getters.getSelectedCounty(state).contacts, contact);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    createContact(state, contact) {

        axios.post('county/' + contact.county_id + '/contacts', contact)
            .then(response => {
                getters.getSelectedCounty(state).contacts.push(response.data);
            })
            .catch(error => console.log(error));
    }

};


export default {
    state,
    getters,
    mutations,
    actions
}