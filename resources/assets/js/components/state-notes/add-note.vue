<template>
    <div>

        <v-dialog primary v-model="dialog" width="500" persistent>
            <v-btn icon fab light class="" slot="activator">
                <v-icon light>add</v-icon>
            </v-btn>

            <v-card>
                <v-card-title class="headline">Create Note</v-card-title>
                <v-text-field class="px-2"
                              name="create"
                              label="Body"
                              textarea
                              v-model="createdNote"
                ></v-text-field>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="green--text darken-1" flat="flat" @click.native="dialog = false">Close</v-btn>
                    <v-btn class="green--text darken-1" flat="flat" @click.native="create();dialog = false">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                createdNote: '',
                dialog: false,
            }
        },
        watch:{
            dialog(){
            }
        },
        methods:{
            create(){
                this.$store.dispatch('createNote', this.createdNote);
                this.createdNote = '';
            }
        }
    }
</script>