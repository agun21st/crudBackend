
require('./bootstrap');

import Vue from 'vue';
// User Class import
import User from './Helpers/User';
window.User = User;

const router = new VueRouter({
    base: '/',
    routes,
    mode: 'history',
    history: true,
});

const app = new Vue({
    el: '#app',
});