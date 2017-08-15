<template>

    <div>

        <button @click="toggleDeleteContact" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button>

        <transition name="modal">
            <div class="modal-mask" @click="toggleDeleteContact" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center">Delete Contact</h3>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Are you sure you want to delete this contact ?</h5>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn btn-default" @click="toggleDeleteContact">
                            Close
                        </button>
                        <button class="btn btn-danger" @click="deleteContact();toggleDeleteContact()">
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
                bkClass: 'bk',
                blurClass: 'blur'
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
            },
            inputFocus(){
                $("#newNote").on('shown.bs.modal', function(){
                    $(this).find('textarea[name=note]').focus();
                });
            }
        }

    }
</script>
