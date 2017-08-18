<template>
    <div>
        <button @click="toggleDeleteNote" class="btn btn-link" style="color: gray"><span class="glyphicon glyphicon-trash"></span></button>
        <transition name="modal">
            <div class="modal-mask" @click="toggleDeleteNote" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center" style="color: orange">Delete Note</h3>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Are you sure you want to delete this note ?</h5>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn"  style="background-color: transparent" @click="toggleDeleteNote">
                            Close
                        </button>
                        <button class="btn"  style="color: red; background-color: transparent" @click="deleteNote();toggleDeleteNote()">
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
        computed:{
            active(){
                return this.$store.state.modals.deleteNote;
            }
        },
        methods:{
            deleteNote(){
                this.$store.dispatch('deleteNote', this.note);
            },
            toggleDeleteNote(){
                this.$store.commit('toggleDeleteNote')
            },
        }

    }
</script>
