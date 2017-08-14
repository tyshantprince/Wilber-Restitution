<template>
    <v-dialog v-model="dialog" width="500" persistent>
        <v-btn id="addCounty" icon fab light class="" slot="activator">
            <v-icon light>add</v-icon>
        </v-btn>
        <v-card>
            <v-card-title class="headline">Create County</v-card-title>
            <v-text-field class="px-3"
                          required
                          name="county"
                          placeholder="County Name"
                          v-model="createdCounty"
                          autofocus
            ></v-text-field>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn class="green--text darken-1" flat="flat" @click.native="dialog = false">Close</v-btn>
                <v-btn class="green--text darken-1" flat="flat" @click.native="newCounty();dialog = false">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props:['cubsCounty', 'cubsCall'],
        data(){
            return{
                createdCounty: (this.cubsCall) ? this.cubsCounty : '',
                dialog: false,
            }
        },
        methods:{
            newCounty(){
                this.$store.dispatch('createCounty', this.createdCounty);
                this.createdCounty = '';
                this.$emit('countyAdded');
            }
        }
    }
</script>