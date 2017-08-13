<template>
    <div>
        <div style="display: flex; justify-content: center; align-items: baseline" class="pb-3">
            <h3 style="flex: 1;" id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Notes</span></h3>
			<span class="pr-2"><add-note></add-note></span>
		</div>

        <div id="notes-container">

            <div v-for="note in currentStateObj.notes" class="">
                <div class="panel-body">
                    <p>{{note.body}}
                        <edit-note :note="note"></edit-note>
                        <delete-note :note="note" ></delete-note>
                    </p>
                    <v-divider></v-divider>
                </div>
            </div>

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