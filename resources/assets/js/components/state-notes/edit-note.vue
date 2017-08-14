<template>

    <div>

        <button @click="toggleShowAddNote" class="btn btn-link"><span class="glyphicon glyphicon-pencil"></span></button>

        <transition name="modal">
            <div class="modal-mask" @click="toggleShowAddNote" v-if="showAddNote">
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
                        <button class="btn btn-default" @click="toggleShowAddNote">
                            Close
                        </button>
                        <button class="btn btn-primary" @click="editNote();toggleShowAddNote()">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <!--<div class="modal fade" :id="'edit' + note.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
        <!--<div class="modal-dialog" role="document">-->
            <!--<div class="modal-content">-->
                <!--<div class="modal-header">-->
                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <!--<h4 class="modal-title">Edit State Note</h4>-->
                <!--</div>-->
                <!--<div class="modal-body">-->
                    <!--<textarea class="" name="note"  :id="note.id" cols="30" rows="4" v-model="note.body" style="min-width: 100%"></textarea>-->
                <!--</div>-->
                <!--<div class="modal-footer" >-->
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <!--<button @click="editNote" id="edit" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
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
            editNote(){
                this.$store.dispatch('updateNote', this.note)
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
