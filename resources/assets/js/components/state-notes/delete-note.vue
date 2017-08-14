<template>

    <v-dialog v-model="dialog" width="400" persistent>
        <v-btn icon fab small class="" slot="activator">
            <v-icon class="">cancel</v-icon>
        </v-btn>
        <v-card>
            <v-card-title class="headline">Delete Note</v-card-title>
            <p class="px-2">Are you sure you want to delete this note?</p>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="grey--text darken-1" flat="flat" @click.native="dialog = false">Close</v-btn>
                <v-btn class="red--text darken-1" flat="flat" @click.native="deleteNote();dialog = false">Delete</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: ['note'],
        data(){
            return{
                dialog: false
            }
        },
        methods:{
            deleteNote(){
                this.$store.dispatch('deleteNote', this.note);
            },
        },
    }
</script>