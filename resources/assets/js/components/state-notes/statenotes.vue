<template>
    <div>
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding-bottom: 10px;">
    	    <span class="state-notes-header">
		    <h3 id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Notes</span></h3>
	        </span>
            <add-note></add-note>
        </div>

        <div id="notes-container">
            <div v-for="note in currentState.notes" class="panel panel-default" style="border-color: orange">
                <div class="panel-body" style="display: flex; align-items: baseline">
                    <p style="flex: 4">{{note.body}}</p>
                    <button @click="selectedNote = note; toggleEditNote()" class="btn btn-link" style="color: gray"><span class="glyphicon glyphicon-pencil"></span></button>
                    <button @click="selectedNote = note; toggleDeleteNote()" class="btn btn-link" style="color: gray"><span class="glyphicon glyphicon-trash"></span></button>
                </div>
            </div>
            <edit-note :note="selectedNote"></edit-note>
            <delete-note :note="selectedNote" ></delete-note>

        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                selectedNote: ''
            }
        },
        computed:{
            currentState(){
                return this.$store.getters.getCurrentState;
            }
        },
        methods:{
            toggleEditNote(){
                this.$store.commit('toggleEditNote')
            },
            toggleDeleteNote(){
                this.$store.commit('toggleDeleteNote')
            }
        }
    }
</script>