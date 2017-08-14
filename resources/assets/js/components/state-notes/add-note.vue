<template>
    <div>
            <button @click="toggleShowAddNote" class="btn btn-link"><span class="glyphicon glyphicon-plus"></span></button>

        <transition name="modal">
            <div class="modal-mask" @click="close" v-if="showAddNote">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center">New Note</h3>
                    </div>
                    <div class="modal-body">
                        <label class="form-label text-center">
                            Body
                            <textarea rows="5" class="form-control"></textarea>
                        </label>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn btn-danger" @click="toggleShowAddNote">
                            Close
                        </button>
                        <button class="btn btn-primary" @click="toggleShowAddNote">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </transition>

        <!--<transition name="fade">-->
            <!--<div class="customModal" id="newNote" v-if="showAddNote">-->
                <!--<div class="modal-dialog customModal " role="document">-->
                        <!--<div class="modal-header">-->
                            <!--<button type="button" @click="toggleShowAddNote" class="close" ><span>&times;</span></button>-->
                            <!--<h4 class="modal-title" id="">Create New State Note</h4>-->
                        <!--</div>-->
                        <!--<div class="modal-body">-->
                            <!--<textarea class="" name="note" id="body" cols="30" rows="4" v-model="createdNote" style="min-width: 100%"></textarea>-->
                        <!--</div>-->
                        <!--<div class="modal-footer" >-->
                            <!--<button @click="toggleShowAddNote" type="button" class="btn btn-default">Close</button>-->
                            <!--<button @click="addNote(); toggleShowAddNote();" id="create" type="button" class="btn btn-primary">Create Note</button>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
        <!--</transition>-->

    </div>
</template>

<script>
    export default {
        data(){
            return {
                createdNote: '',
                showAddNote: false,
                bkClass: 'bk',
                blurClass: 'blur'
            }
        },
        methods:{
            addNote(){
                this.$store.dispatch('createNote', this.createdNote);
                this.createdNote = '';
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
