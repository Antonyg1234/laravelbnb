<template>
    <div class="row">
        <div class="col-md-8 pb-4">
            <div class="card">
                <div class="card-body">
                    <div v-if="!loading">
                        <h2>{{ bookable.title }}</h2>
                        <hr/>
                        <article>{{ bookable.description }}</article>
                    </div>
                    <div v-else>
                        Loading.........
                    </div>
                </div>
            </div>
            <review-list :bookable-id="this.$route.params.id"></review-list>
        </div>
        <div class="col-md-4 pb-4">
            <availability class="mb-4" :bookable-id="this.$route.params.id"
                        @availability="checkPrice($event)">
            </availability>
            <transition name="fade">
                <price-breakdown v-if="price" :price="price" class="mb-4"></price-breakdown>
            </transition>
            <transition name="fade">
                <button class="btn btn-outline-secondary btn-block"
                    v-if="price" @click="addToBasket" :disabled="inBasketAlready">
                    Book now
                </button>
            </transition>
            <button class="btn btn-outline-secondary btn-block"
                    v-if="inBasketAlready" @click="removeFromBasket">
                    Remove From Basket
            </button>
            <div v-if="inBasketAlready" class="mt-4 text-muted warning">
                Seems like you've already added this object to basket already. If you want to change dates remove from the basket first.
            </div>
        </div>
    </div>
</template>

<script>
import Availability from './Availability';
import ReviewList from './ReviewList';
import { mapState } from 'vuex';
import PriceBreakdown from './PriceBreakdown'

export default{
    components:{
        Availability,
        ReviewList,
        PriceBreakdown
    },
    data(){
        return{
            bookable:null,
            loading:false,
            price:null
        }
    },
    created(){
        this.loading = true;
        axios.get('/api/bookables/'+this.$route.params.id)
        .then(response=>{
            this.bookable =  response.data.data;
            this.loading = false;
        })
    },
    computed:{
        ...mapState({
            lastSearch : 'lastSearch',
        }),
        inBasketAlready(){
            if(null == this.bookable){
                return false
            }
            return this.$store.getters.inBasketAlready(this.bookable.id);
        }
    },
    //this is similar wary to code which is used up in computed properties
    // computed:mapState({
    //     lastSearch : 'lastSearch',
    //     inBasketAlready(state){
    //         if(null == this.bookable){
    //             return false
    //         }
    //         return state.basket.items.reduce((result,item) => result || item.bookable.id == this.bookable.id,false);
    //     }
    // }),
    methods:{
        async checkPrice(hasAvailability){
            if(hasAvailability){
                try{
                    this.price = (await axios.get(
                        `/api/bookable/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`
                        )).data.data;
                }catch(err){
                    this.price = null;
                }
            }else{
                this.price = null;
            }
        },
        addToBasket(){
            this.$store.dispatch('addToBasket',{
                bookable : this.bookable,
                price : this.price,
                dates : this.lastSearch
            });
        },
        removeFromBasket(){
            this.$store.dispatch("removeFromBasket",this.bookable.id);
        }
    }
}
</script>

<style scoped>
    .warning{
        font-size: 0.7rem;
    }
</style>
