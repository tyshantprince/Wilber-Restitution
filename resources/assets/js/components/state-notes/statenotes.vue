<template>
    <div>
    	<span class="state-notes-header">
		<h3 id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Notes</span></h3>
	</span>

        <div id="notes-container">

            <div v-for="note in currentStateObj.notes" class="panel panel-default">
                <div class="panel-body">
                    <p>{{note.body}}
                        <span class="text-right">
                            <a @click="chooseNote(note)" class="btn btn-small" data-toggle="modal" :data-target="'#edit' + note.id">Edit</a>
                            <a @click="chooseNote(note)" class="btn btn-small" data-toggle="modal" :data-target="'#delete' + note.id">Delete</a>
                        </span>
                    </p>
                </div>
            </div>

            <edit-note :note="currentNote"></edit-note>
            <delete-note :note="currentNote" ></delete-note>

            <add-note></add-note>

        </div>
    </div>

</template>

<script>
    export default {
        props:['currentStateObj'],
        data() {
            return{
                currentNote: {}
            }
        },
        methods: {
            chooseNote(note)
            {
                this.currentNote = note;
            }

        },
    }
</script>