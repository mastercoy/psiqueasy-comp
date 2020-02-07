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


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(Vuelidate);
Vue.use(Toasted);
Vue.use(VueRouter);
Vue.use(VueTheMask);

const router = new VueRouter({
    mode: "history",
    base: process.env.APP_URL,
    routes
});


Vue.component("modulo-clinica", require("./components/modulo_clinica.vue"));


const app = new Vue({
    el: "#app",
    router,
    store
});
