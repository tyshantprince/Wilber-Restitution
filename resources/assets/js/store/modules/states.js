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
    setCurrentState({commit, state}){
        axios.get('state/' + state.selectedStateID)
            .then((response) => {
                commit('setCurrentState', response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    updateNote({commit}, note) {
        axios.patch('state/' + note.state_id + '/notes/' + note.id, {body: note.body})
            .then((response) => {
            })
            .catch((error) => {
                console.log(error);
            });
    },
    deleteNote({commit}, note) {
        axios.delete('state/' + note.state_id + '/notes/' + note.id)
            .then((response) => {
                commit('deleteNote', note);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    createNote({commit, state}, note) {
        axios.post('state/' + state.selectedStateID + '/notes', {body: note})
            .then((response) => {
                commit('createNote', response.data)
            })
            .catch((error) => {
                console.log(error);
            });
    },
    createCounty({commit, state}, county) {
        axios.post('state/' + state.selectedStateID + '/counties', {name: county})
            .then((response) => commit('createCounty', response.data))
            .catch((error) => {
                console.log(error);
            });
    },
    updateContact({commit}, contact) {
        axios.patch('county/' + contact.county_id + '/contacts/' + contact.id, contact)
            .then(response => console.log('success'))
            .catch(error => console.log(error));
    },
    deleteContact({commit}, contact) {
        axios.delete('county/' + contact.county_id + '/contacts/' + contact.id)
            .then((response) => {
                commit('deleteContact', contact);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    createContact({commit}, contact) {
        axios.post('county/' + contact.county_id + '/contacts', contact)
            .then(response => {
                commit('createContact', response.data);
            })
            .catch(error => console.log(error));
    }
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
    deleteNote(state, note) {
        state.currentState.notes = _.without(state.currentState.notes, note)
    },
    createNote(state, note) {
        state.currentState.notes.push(note);
    },
    createCounty(state, county) {
                if(typeof county.contacts === "undefined"){
                    county.contacts = [];
                }
                state.currentState.counties.push(county);
    },
    deleteContact(state, contact) {
        state.currentState.contacts = _.without(state.currentState.contacts, contact);
    },
    createContact(state, contact) {
        state.currentState.contacts.push(response.data);
    }

};


export default {
    state,
    getters,
    mutations,
    actions
}