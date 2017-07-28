<template>
    <div class="container">
        <div class="row" style="padding-top: 35px">
            <div id="state-select">
                <fieldset >
                    <form style="display: flex">
                        <select @change="selectState" id="select-state" style="flex: 1">
                            <option></option>
                            <option v-for="state in states" v-bind:value="state.name" >{{state.name}}</option>
                        </select>
                        <div class="cubs_input">
                            <label for="cubs_no">CUBS #:</label>
                            <input type="text" name="cubs_no" id="cubs_no" maxlength=7/>
                        </div>
                    </form>
                </fieldset>
            </div><!-- end state-select div -->
        </div>

        <div class="row">
            <div class="col-xs-6">
                <h1>{{ selectedState}}</h1>
                <state-notes :notes="notes"></state-notes>
            </div>
            <div class="col-xs-6">
                County Notes
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props:[
            'states'
        ],
        data: function () {
            return{
                selectedState: '',
                notes: ''
            }
        },
        methods: {
          selectState: function(event){
              this.selectedState = event.target.value;
          },
          showStateNotes: function (selectedState) {
                var stateOfInterest = this.states.filter(function (state) {
                    return state.name == selectedState;
                });

                $.get({
                    url: '/notes/' + stateOfInterest[0].id,
                    success: function(data){
                        this.notes = data;
                    }
                });

          }
        },
    }
</script>
