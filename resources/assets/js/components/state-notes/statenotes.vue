<template>
    <div>
    	<span class="state-notes-header">
		<h3  id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Notes</span></h3>
	</span>

        <div id="notes-container">

            <div v-for="note in currentStateObj.notes" class="">
                <div class="panel-body">
                    <p>{{note.body}}
                        <edit-note :note="note"></edit-note>
                        <delete-note :note="note" ></delete-note>
                    </p>
                </div>
            </div>
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