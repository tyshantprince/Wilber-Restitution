const state = {
    addNote: false,
    editNote: false,
    deleteNote: false,
    addCounty: false,
    addContact: false,
    editContact: false,
    deleteContact: false,
}

const getters = {

}

const actions = {

}

const mutations = {
    toggleAddNote(state){
        state.addNote = !state.addNote;
    },
    toggleEditNote(state){
        state.editNote = !state.editNote ;
    },
    toggleDeleteNote(state){
        state.deleteNote = !state.deleteNote;
    },
    toggleAddCounty(state){
        state.addCounty =  !state.addCounty ;
    },
    toggleAddContact(state){
        state.addContact = !state.addContact;
    },
    toggleEditContact(state){
        state.editContact = !state.editContact;
    },
    toggleDeleteContact(state){
        state.deleteContact = !state.deleteContact;
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}