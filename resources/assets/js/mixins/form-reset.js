export default {
    methods: {
        formReset(form){
           form.map((field) => {
                field = '';
            })
        }
    }
}
