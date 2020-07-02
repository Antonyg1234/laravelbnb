export default {
    data() {
        errors: null
    },
    methods: {
        errorFor(field) {
            return null != this.errors && this.errors[field] ? this.errors[field] : null
        }
    }
}