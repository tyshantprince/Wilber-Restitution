<template>
    <div>
        <a @click="focus" class="btn-large" data-toggle="modal" data-target="#newCounty">New County</a>
        <div class="modal fade" id="newCounty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="">Create New County</h4>
                    </div>
                    <div class="modal-body">
                        <input class="center-block" type="text" name="county" v-model="createdCounty" placeholder="Enter County Name">
                    </div>
                    <div class="modal-footer" >
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button @click="newCounty" id="makeCounty" type="button" class="btn btn-primary" data-dismiss="modal">Create County</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                createdCounty: '',
            }
        },
        methods:{
          newCounty(){
              this.$store.dispatch('createCounty', this.createdCounty);
              this.createdCounty = '';
          },
            focus(){
                setTimeout(() => {
                    $('input[name=county]').focus();
                }, 500)
            }
        }
    }
</script>
