<template>

    <div>


        <transition name="modal">
            <div class="modal-mask" @click="toggleDeleteContact" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center" style="color: orange">Delete Contact</h3>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Are you sure you want to delete this contact ?</h5>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn" style="background-color: transparent" @click="toggleDeleteContact">
                            Close
                        </button>
                        <button class="btn" style="background-color: transparent; color: red" @click="deleteContact();toggleDeleteContact()">
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
        props:['contact'],
        data(){
            return {
                showAddNote: false,
            }
        },
        computed:{
            active(){
                return this.$store.state.modals.deleteContact;
            }
        },
        methods:{
            deleteContact(){
                this.$store.dispatch('deleteContact', this.contact);
            },
            toggleDeleteContact(){
                this.$store.commit('toggleDeleteContact')
            }
        }

    }
</script>
