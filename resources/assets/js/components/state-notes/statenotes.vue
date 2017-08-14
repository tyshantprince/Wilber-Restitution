<template>
    <div>
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
    	    <span class="state-notes-header">
		    <h3 id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Notes</span></h3>
	        </span>
            <add-note></add-note>
        </div>

        <div id="notes-container">

            <div v-for="note in currentState.notes" class="panel panel-default">
                <div class="panel-body">
                    <p>{{note.body}}
                        <span class="text-right">
                            <a @click="chooseNote(note)" class="btn btn-small" data-toggle="modal" :data-target="'#edit' + note.id" :name="'edit' + note.id">Edit</a>
                            <a @click="chooseNote(note)" class="btn btn-small" data-toggle="modal" :data-target="'#delete' + note.id" :name="'delete' + note.id">Delete</a>
                        </span>
                    </p>
                </div>
            </div>

            <edit-note :note="currentNote"></edit-note>
            <delete-note :note="currentNote" ></delete-note>

        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return{
                currentNote: {}
            }
        },
        computed:{
            currentState(){
                return this.$store.getters.getCurrentState;
            }
        },
        methods: {
            chooseNote(note)
            {
                this.currentNote = note;
                this.addFocus(note)
            },
            addFocus(note){
                setTimeout((note) => {
                    $('#' + note.id).focus();
                }, 500, note)
            },
        },
    }
</script>