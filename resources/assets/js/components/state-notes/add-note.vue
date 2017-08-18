<template>
    <div>
            <button @click="toggleShowAddNote" class="btn btn-link" style="color: gray"><span class="glyphicon glyphicon-plus"></span> Add Note</button>

        <transition name="modal">
            <div class="modal-mask" @click="toggleShowAddNote" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header" >
                        <h3 class="text-center" style="color: orange">New Note</h3>
                    </div>
                    <div class="modal-body">
                        <label class="form-label text-center">
                            Body
                            <textarea rows="5" v-model="createdNote" class="form-control"></textarea>
                        </label>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn" style="background-color: transparent" @click="toggleShowAddNote">
                            Close
                        </button>
                        <button class="btn" style="color: orange; background-color: transparent" @click="addNote();toggleShowAddNote()">
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
        data(){
            return {
                createdNote: '',
            }
        },
        computed:{
            active(){
                return this.$store.state.modals.addNote;
            }
        },
        methods:{
            addNote(){
                this.$store.dispatch('createNote', this.createdNote);
                this.createdNote = '';
            },
            toggleShowAddNote(){
              this.$store.commit('toggleAddNote');
            },
        },

    }
</script>
