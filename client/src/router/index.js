import { createRouter, createWebHistory } from 'vue-router';
import MenuPage from '@/pages/costumer/MenuPage';
import HomePage from '@/pages/costumer/HomePage';


const routes = [{
        path: '/menu',
        name: 'MenuPage',
        component: MenuPage,
    },
    {
        path: '/',
        name: 'homePage',
        component: HomePage,
    }


];

const router = createRouter({
    history: createWebHistory('/'),
    routes
});

export default router;