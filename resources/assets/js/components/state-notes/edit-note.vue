<template>

    <v-dialog v-model="dialog" width="500" persistent>
        <v-btn icon fab small class="" slot="activator">
            <v-icon class="">create</v-icon>
        </v-btn>
        <v-card>
            <v-card-title class="headline">Edit Note</v-card-title>
            <v-text-field class="px-2"
                          name=""
                          label="Body"
                          textarea
                          v-model="note.body"
                          autofocus
            ></v-text-field>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="green--text darken-1" flat="flat" @click.native="dialog = false">Close</v-btn>
                <v-btn class="green--text darken-1" flat="flat" @click.native="editNote();dialog = false">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props:['note'],
        data(){
            return{
                dialog: false
            }
        },
        methods:{
            editNote(){
                this.$store.dispatch('updateNote', this.note)
            },
        }
    }
</script>
