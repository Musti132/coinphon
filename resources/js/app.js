require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router'
import Vuesax from 'vuesax'

import 'vuesax/dist/vuesax.min.css' //Vuesax styles

window.Vue = require('vue');

Vue.component('App', require('./Layout/Landing/App.vue').default);
Vue.use(VueRouter)
Vue.use(Vuesax)

const app = new Vue({
    el: '#app',
    router,
});