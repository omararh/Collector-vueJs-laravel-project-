import { createRouter, createWebHistory } from 'vue-router';
import MenuPage from '@/pages/costumer/MenuPage';
import HomePage from '@/pages/costumer/HomePage';
import ItemPage from '@/pages/costumer/ItemPage';
import basketPage from '@/pages/costumer/BasketPage';
import CommandPage from '@/pages/costumer/CommandPage';
import LogInPage from '@/pages/costumer/LogInPage';
import SignInPage from '@/pages/costumer/SignInPage';
import CommandsListPage from '@/pages/costumer/CommandsListPage';
import DashboardPage from '@/pages/admin/DashboardPage';
import OrdersHistoryPage from '@/pages/admin/OrdersHistoryPage';

const routes = [{
        path: '/menu',
        name: 'MenuPage',
        component: MenuPage,
    },
    {
        path: '/',
        name: 'homePage',
        component: HomePage,
    },
    {
        path: '/item/:itemId',
        name: 'ItemPage',
        component: ItemPage,
    },
    {
        path: '/basket',
        name: 'BasketPage',
        component: basketPage,
    },
    {
        path: '/command',
        name: 'CommandPage',
        component: CommandPage
    },
    {
        path: '/logIn',
        name: 'LogInPage',
        component: LogInPage
    },
    {
        path: '/signIn',
        name: 'SignInPage',
        component: SignInPage
    },
    {
        path: '/commands',
        name: 'CommandsListPage',
        component: CommandsListPage
    },
    {
        path: '/dashboard',
        name: 'DashboardPage',
        component: DashboardPage
    },
    {
        path: '/OrdersHistoryPage',
        name: 'OrdersHistoryPage',
        component: OrdersHistoryPage
    }

];

const router = createRouter({
    history: createWebHistory('/'),
    routes
});

export default router;