import VueRouter from 'vue-router';
import BookableComponent from './bookable/Bookable';
import Book from './book/Book';
import Review from './review/Review';


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
];

const router = new VueRouter({
    routes: routes,
    mode: "history"
});

export default router;