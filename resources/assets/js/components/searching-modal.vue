<template>
    <div>
        <transition name="modal">
            <div class="modal-mask" v-if="active">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Searching...</h4>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        computed:{
            active(){
                return this.$store.state.modals.searching;
            }
        },

    }
</script>
