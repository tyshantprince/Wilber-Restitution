<template>

    <div>

        <button @click="toggleShowAddNote" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>

        <transition name="modal">
            <div class="modal-mask" @click="toggleShowAddNote" v-if="showAddNote">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center">Delete Note</h3>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Are you sure you want to delete this note ?</h5>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn btn-default" @click="toggleShowAddNote">
                            Close
                        </button>
                        <button class="btn btn-danger" @click="deleteNote();toggleShowAddNote()">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props:['note'],
        data(){
            return {
                showAddNote: false,
                bkClass: 'bk',
                blurClass: 'blur'
            }
        },
        methods:{
            deleteNote(){
                this.$store.dispatch('deleteNote', this.note);
            },
            toggleShowAddNote(){
                this.showAddNote = !this.showAddNote;
            },
            inputFocus(){
                $("#newNote").on('shown.bs.modal', function(){
                    $(this).find('textarea[name=note]').focus();
                });
            }
        }

    }
</script>
