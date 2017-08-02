<template>
    <div>
    	<span class="state-notes-header">
		<h3 id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Notes</span></h3>
	</span>

        <div id="notes-container">

            <div v-if="notes.length > 0" v-for="note in stateNotes" class="panel panel-default">
                <div class="panel-body">
                    <p>{{note.body}}
                        <span class="text-right">
                            <a  @click="currentNote(note)" class="btn btn-small" data-toggle="modal" :data-target="'#edit' + note.id">Edit</a>
                            <a @click="currentNote(note)" class="btn btn-small" data-toggle="modal" :data-target="'#delete' + note.id">Delete</a>
                        </span>
                    </p>
                </div>
            </div>

            <edit-note :note="selectedNote"></edit-note>
            <delete-note @noteDeleted="deleteNote" :note="selectedNote" ></delete-note>



            <a class="btn-large" data-toggle="modal" data-target="#newNote"><span class="btn-add">New Note</span></a>

            <div class="modal fade" id="newNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="">Create New State Note</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="" name="note" id="body" cols="30" rows="4" v-model="createdNote" style="min-width: 100%"></textarea>
                        </div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button @click="newNote" type="button" class="btn btn-primary" data-dismiss="modal">Create Note</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['notes'],
        data() {
            return{
                stateNotes: this.notes,
                selectedNote: '',
                createdNote: ''
            }
        },
        watch:{
          notes(){
              this.stateNotes = this.notes;
          }
        },
        methods: {
            currentNote(note){
                this.selectedNote = note;
            },
            deleteNote(note){
                this.$emit('noteDeleted', note)
            },
            editNote() {
                this.$emit('edit', this.selectedNote);
            },
            newNote(){
                this.$emit('new', this.createdNote);
                this.createdNote = '';
            }
        },
    }
</script>