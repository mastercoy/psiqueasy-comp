/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import VueRouter from "vue-router";
import Vue from "vue";
import routes from "./routes";
import store from "./store";
//  BIBLIOTECAS ESTRAS PARA O PROJETO
import Toasted from "vue-toasted";
import Vuelidate from "vuelidate";
import VueTheMask from "vue-the-mask";
import FullCalendar from 'vue-full-calendar';
import FullCalendarCss from "fullcalendar/dist/fullcalendar.min.css";




Vue.use(FullCalendar, FullCalendarCss);
Vue.use(Vuelidate);
Vue.use(Toasted);
Vue.use(VueRouter);
Vue.use(VueTheMask);
// Vue.use(Loading);

const router = new VueRouter({
    mode: "history",
    base: process.env.APP_URL,
    routes
});

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         if (store.getters.isLoggedIn) {
//             next();
//             return;
//         }
//         console.log("Você não tem permissão para acessar essa página!");
//         next("/login");
//     } else {
//         next();
//     }
// });


Vue.component("modulo-clinica", require("./components/modulo_clinica.vue"));


const app = new Vue({
    el: "#app",
    router,
    store
});
