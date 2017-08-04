<template>
    <div class="modal fade" :id="'delete' + note.id" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete State Note</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this note?</p>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click="deleteNote" type="button" class="btn btn-danger" data-dismiss="modal">Yes I am</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['note'],
        methods:{
            deleteNote(){
                this.$store.commit('deleteNote', this.note);
            },
        },

    }
</script>
