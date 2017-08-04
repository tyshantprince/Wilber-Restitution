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

}



export default{
    state,
    getters,
    mutations
}