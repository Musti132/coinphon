import VueRouter from 'vue-router'

import Home from './Pages/Home.vue'
import Login from './Pages/Login'
import topbar from 'topbar'


export const routes = [
    {
        path: '/',
        component: Home,
        name: 'dashboard'
    },
    {
        path: '/home',
        component: Home,
        name: 'home'
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/wallet',
        name: 'wallet',
    },
    {
        path: '/orders',
        name: 'orders',
    },
    {
        path: '/developer',
        name: 'developer',
    },

];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
    linkExactActiveClass: "active",
});

topbar.config({
    autoRun: true,
    barThickness: 2,
    barColors: {
        '1': '#195CFF',
    },
    shadowBlur: 10,
    shadowColor: 'rgba(0,   0,   0,   .6)'
})

router.beforeResolve((to, from, next) => {
    if (to.name) {
        topbar.show()
    }
    next()
})

router.afterEach((to, from) => {
    topbar.hide()
})

export default router;