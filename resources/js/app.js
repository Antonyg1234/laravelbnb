require('./bootstrap');

import VueRouter from 'vue-router';
import router from './routes';
import Vuex from 'vuex';
import IndexComponent from './Index';
import moment from 'moment';
import StarRating from './shared/components/StarRating';
import FatalError from './shared/components/FatalError';
import ValidationErrors from './shared/components/ValidationErrors';
import Success from './shared/components/Success';
import storeDefinition from './store';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuex);
//Filter global registration
Vue.filter("fromNow", value => moment(value).fromNow());
//Global Component registration
Vue.component('star-rating', StarRating);
Vue.component('fatal-error', FatalError);
Vue.component('v-errors', ValidationErrors);
Vue.component('success', Success);

const store = new Vuex.Store(storeDefinition);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        'app-index': IndexComponent
    },
    beforeCreate() {
        this.$store.dispatch('loadStoreState');
    }
});