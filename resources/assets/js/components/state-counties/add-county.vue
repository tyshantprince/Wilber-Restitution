<template>
    <div>
        <button @click="toggleShowAddNote" class="btn btn-link"><span class="glyphicon glyphicon-plus"></span></button>

        <transition name="modal">
            <div class="modal-mask" @click="toggleShowAddNote" v-if="showAddNote">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center">New County</h3>
                    </div>
                    <div class="modal-body">
                            <input class="center-block" type="text" name="county" v-model="createdCounty" placeholder="Enter County Name">
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button class="btn btn-default" @click="toggleShowAddNote">
                            Close
                        </button>
                        <button class="btn btn-primary" @click="newCounty();toggleShowAddNote()">
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
                createdCounty: '',
                showAddNote: false,
                bkClass: 'bk',
                blurClass: 'blur'
            }
        },
        methods:{
            newCounty(){
                this.$store.dispatch('createCounty', this.createdCounty).then(() => {
                    $('#' + this.$store.getters.getSelectedCounty.id).click();
                    this.$emit('countyAdded')
                });
                this.createdCounty = ''
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
