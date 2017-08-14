<template>
    <div>
        <div style="display: flex; justify-content: center; align-items: baseline" class="pb-3">
            <h3 style="flex: 1;" id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Notes</span></h3>
			<span class="pr-2"><add-note></add-note></span>
		</div>

        <v-container id="notes-container">

            <v-layout v-for="(note, i) in currentStateObj.notes" :key="i" class="">
                <v-flex xs12 style="">
                    <v-card primary >
                        <v-card-title primary-title style="display: flex; align-items: baseline; justify-content: space-between">
                            <p style="word-wrap: break-word; width: 80%;">
                                {{note.body}}
                            </p>
                            <edit-note style="flex: 1" :note="note"></edit-note>
                            <delete-note style="flex: 1" :note="note" ></delete-note>
                        </v-card-title>
                        <v-card-actions>

                        </v-card-actions>
                    </v-card>
                </v-flex>
                <v-divider></v-divider>
            </v-layout>

        </v-container>
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