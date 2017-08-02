<template>
    <div>
    	<span class="state-notes-header">
		<h3 id="head" class="text-center header"><small>State</small> <span class="weight-normal"> Notes</span></h3>
	</span>

        <div id="notes-container">

            <div v-if="notes.length > 0" v-for="note in notes" class="panel panel-default">
                <div class="panel-body">
                    <p>{{note.body}}
                        <span class="text-right">
                            <a class="btn btn-small" data-toggle="modal" :data-target="'#' + note.id">Edit</a>
                            <a class="btn btn-small" href="">Delete</a>
                        </span>
                    </p>

                    <div class="modal fade" :id="note.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit State Note</h4>
                                </div>
                                <div class="modal-body">
                                        <textarea class="" name="note"  :id="note.id" cols="30" rows="4" v-model="note.body" style="min-width: 100%"></textarea>
                                </div>
                                <div class="modal-footer" >
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button @click="saveNote" type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="add-field right">
                <a href="#" class="btn-large" data-type="note" data-state="<?php echo $state; ?>"><span class="btn-add">New Note</span></a>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['notes'],
        data() {
            return{
            }
        },
        methods: {
            saveNote() {
                this.$emit('save');
            }
        }
    }
</script>