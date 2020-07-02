<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">Check Availability
            <span class="text-success" v-if="hasAvailability">(AVAILABLE)</span>
            <span class="text-danger" v-if="noAvailability">(NOT AVAILABLE)</span>
        </h6>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="from">From</label>
                <input
                    name="from"
                    type="text"
                    class="form-control form-control-sm"
                    placeholder="Start Date"
                    v-model="from"
                    :class="[{'is-invalid': errorFor('from')}]"
                />
                <v-errors :errors="errorFor('from')"></v-errors>
            </div>
            <div class="form-group col-md-6">
                <label for="to">To</label>
                <input
                    name="to"
                    type="text"
                    class="form-control form-control-sm"
                    placeholder="End Date"
                    v-model="to"
                    :class="[{'is-invalid': errorFor('to')}]"
                />
                <v-errors :errors="errorFor('to')"></v-errors>
            </div>
            <button class="btn btn-secondary btn-block" @click="check" :disabled="loading">Check!</button>
        </div>
    </div>
</template>
<script>

import { is422 } from './../shared/utils/response';
import validationErrors from './../shared/mixins/validationErrors';

export default{
    mixins : [ validationErrors ],
    props:{
        bookableId: [String,Number]
    },
    data(){
        return{
            from: this.$store.lastSearch.from,
            to: this.$store.lastSearch.to,
            loading:false,
            status:null,
        }
    },
    methods:{
        check(){
            this.loading = true;
            this.errors = null;

            this.$store.dispatch('setLastSearch',{
                from : this.from,
                to : this.to
            });

            axios.get(
                `/api/bookable/${this.bookableId}/availability?from=${this.from}&to=${this.to}`
            )
            .then(response => {
                this.status =  response.status
            })
            .catch(error => {
                if(is422(error)){
                    this.errors = error.response.data.errors;
                }
                this.status = error.response.status
            })
            .then(() => (this.loading =  false));
        }
    },
    computed:{
        hasErrors(){
            return this.errors != null && 422 == this.status;
        },
        hasAvailability(){
            return 200 == this.status;
        },
        noAvailability(){
            return 404 == this.status;
        }
    }
}
</script>
<style scoped>
label {
    font-size: 0,7rem;
    text-transform: uppercase;
}
</style>
