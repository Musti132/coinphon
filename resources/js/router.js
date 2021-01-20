import VueRouter from 'vue-router'

import Home from './Pages/Home.vue'

export const routes = [{
        path: '/',
        component: Home
    },

];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
    linkExactActiveClass: "active",
})

export default router;