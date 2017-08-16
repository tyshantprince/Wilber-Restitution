<template>
    <div>
        <button @click="toggleEditNote" class="btn btn-link"><span class="glyphicon glyphicon-pencil"></span></button>
        <transition name="modal">
            <div class="modal-mask" @click="toggleEditNote" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center">Edit Note</h3>
                    </div>
                    <div class="modal-body">
                        <label class="form-label text-center">
                            Body
                            <textarea rows="5" v-model="note.body" class="form-control"></textarea>
                        </label>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn btn-default" @click="toggleEditNote">
                            Close
                        </button>
                        <button class="btn btn-primary" @click="editNote();toggleEditNote()">
                            Save
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
                return this.$store.state.modals.editNote;
            }
        },
        methods:{
            editNote(){
                this.$store.dispatch('updateNote', this.note)
            },
            toggleEditNote(){
                this.$store.commit('toggleEditNote');
            },
        }

    }
</script>
