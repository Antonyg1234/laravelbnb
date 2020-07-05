import VueRouter from 'vue-router';
import BookableComponent from './bookable/Bookable';
import Book from './book/Book';
import Review from './review/Review';
import Basket from './basket/Basket';

const routes = [{
        path: '/',
        component: BookableComponent,
        name: 'home'
    },
    {
        path: '/bookable/:id',
        component: Book,
        name: 'bookable'
    },
    {
        path: '/review/:id',
        component: Review,
        name: 'review'
    },
    {
        path: '/basket',
        component: Basket,
        name: 'basket'
    }
];

const router = new VueRouter({
    routes: routes,
    mode: "history"
});

export default router;