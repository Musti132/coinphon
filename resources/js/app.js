require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router'

window.Vue = require('vue');

Vue.component('App', require('./Layout/Landing/App.vue').default);
Vue.use(VueRouter)

axios.defaults.headers.common['X-XSRF-TOKEN'] = AUTH_TOKEN;

const app = new Vue({
    el: '#app',
    router,
});