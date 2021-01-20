require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router'

window.Vue = require('vue');

Vue.component('App', require('./Layout/App.vue').default);
Vue.use(VueRouter)


const app = new Vue({
    el: '#app',
    router,
});