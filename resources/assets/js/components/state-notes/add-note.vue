<template>
    <div>
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
                        <button @click="addNote" id="create" type="button" class="btn btn-primary" data-dismiss="modal">Create Note</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                createdNote: '',
            }
        },
        methods:{
            addNote(){
                this.$store.dispatch('createNote', this.createdNote);
                this.createdNote = '';
            }
        }

    }
</script>
