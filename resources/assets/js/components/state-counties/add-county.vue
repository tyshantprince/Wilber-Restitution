<template>
    <div>
        <button @click="toggleAddCounty" class="btn btn-link" style="color: gray"><span class="glyphicon glyphicon-plus"></span>Add County</button>

        <transition name="modal">
            <div class="modal-mask" @click="toggleAddCounty" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <h3 class="text-center">New County</h3>
                    </div>
                    <div class="modal-body">
                            <input class="center-block" type="text" name="county" v-model="createdCounty" placeholder="Enter County Name">
                    </div>
                    <div class="modal-footer flex fl-jc-sb">
                        <button class="btn btn-default" @click="toggleAddCounty">
                            Close
                        </button>
                        <button class="btn btn-primary" @click="newCounty();toggleAddCounty()">
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
            }
        },
        computed:{
            active(){
                return this.$store.state.modals.addCounty;
            }
        },
        methods:{
            newCounty(){
                this.$store.dispatch('createCounty', this.createdCounty);
                this.createdCounty = ''
            },
            toggleAddCounty(){
                this.$store.commit('toggleAddCounty');
            },
            inputFocus(){
                $("#newNote").on('shown.bs.modal', function(){
                    $(this).find('textarea[name=note]').focus();
                });
            }
        }

    }
</script>
