const state = {
    stateList: [],
    currentState: {}
}

const getters = {
    currentState: state => state.currentState
}

const mutations = {
    init(state, payload)
    {
        state.stateList = payload;
    },
    updateCurrentState(state, name)
    {
        state.currentState = state.stateList.filter((stateInList) => {
           return stateInList.name == name;
        })[0];
        // TODO: make request to get state attributes;
    },
    updateNote(state, note)
    {
        axios.patch('state/' + note.state_id + '/notes/' + note.id, {body: note.body})
            .then((response) => {
                console.log(state.currentState);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    deleteNote(state,note)
    {
        axios.delete('state/' + note.state_id + '/notes/' + note.id)
            .then((response) => {
                state.currentState.notes = _.without(state.currentState.notes, note)
            })
            .catch((error) => {
                console.log(error);
            });
    },
    createNote(state, note){
      axios.post('state/' + state.currentState.id + '/notes', {body: note})
          .then((response) => {
            state.currentState.notes.push(response.data);
          })
          .catch((error) => {
              console.log(error);
          });
    },
    createCounty(state, county){
        axios.post('state/' + state.currentState.id + '/counties', {name: county})
            .then((response) => {
                state.currentState.counties.push(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    updateContact(state, contact){
        console.log(contact);
      axios.patch('county/' + contact.county_id + '/contacts/' + contact.id, {
          contact_name: contact.contact_name,
          phone: contact.phone,
          ext: contact.ext,
          address1: contact.address1,
          address2: contact.address2,
          city: contact.city,
          zip: contact.zip,
          fax: contact.fax,
          email: contact.email,
          website: contact.website,
          fee: contact.fee,
          notes: contact.notes,
          })
          .then(response => {
                console.log('success')
              }
          )
          .catch((error) => {
              console.log(error);
          });

    },
    deleteContact(state, contact){
      axios.delete('county/' + contact.county_id + '/contacts/' + contact.id)
          .then((response) => {
            state.currentState.counties.map((county) => {
                if (county.id === contact.county_id){
                    county.contacts = _.without(county.contacts, contact);
                }
            })
          })
          .catch((error) => {
              console.log(error);
          });
    },

}



export default{
    state,
    getters,
    mutations
}