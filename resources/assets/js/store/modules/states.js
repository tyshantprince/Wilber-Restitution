const state = {
    stateList: [],
    currentState:{},
    selectedStateID: '',
    selectedCountyID: '',
};

const getters = {
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
        return new Promise((resolve, reject) => {
            axios.get('state/' + state.selectedStateID)
                .then((response) => {
                    commit('setCurrentState', response.data);
                    resolve();
                })
                .catch((error) => {
                    console.log(error);
                });
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
        return new Promise((resolve, reject) => {
            axios.post('state/' + state.selectedStateID + '/counties', {name: county})
                .then((response) => {
                    commit('createCounty', response.data);
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        })

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
        county.contacts = [];
        state.currentState.counties.push(county);
        state.selectedCountyID =  county.id;
    },
    deleteContact(state, contact) {
        getters.getSelectedCounty(state).contacts = _.without(getters.getSelectedCounty(state).contacts, contact);
    },
    createContact(state, contact) {
        getters.getSelectedCounty(state).contacts.push(contact);
    }

};


export default {
    state,
    getters,
    mutations,
    actions
}