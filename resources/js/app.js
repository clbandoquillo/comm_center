/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('parking-component', require('./components/ParkingComponent.vue').default);
Vue.component('ldap-component', require('./components/LDAPComponent.vue').default);
Vue.component('prices-component', require('./components/PricesComponent.vue').default);
Vue.component('swimming-component', require('./components/SwimmingComponent.vue').default);
/*
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)
//
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'*/


import Vue from 'vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
/*
import Vuetify from "vuetify";*/
//import "vuetify/dist/vuetify.min.css";

//Vue.use(Vuetify);

Vue.component('v-select', vSelect)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import BootstrapVue from 'bootstrap-vue'

import { BTable } from 'bootstrap-vue'
Vue.component('b-table', BTable)

Vue.use(BootstrapVue)

import VueGoodTablePlugin from 'vue-good-table';

// import the styles 
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueGoodTablePlugin);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
