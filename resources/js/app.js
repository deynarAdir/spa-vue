require('./bootstrap');

window.Vue = require('vue');
var VueTruncate = require('vue-truncate-filter')
Vue.use(VueTruncate)

import VueRouter from 'vue-router';
import Vuex from 'vuex';
Vue.use(VueRouter);
Vue.use(Vuex);
import { routes } from './routes';
import StoreData from './store.js';
import MainApp from './components/MainApp.vue';
import { initialize } from './helpers/general.js';
//importando vuelidate
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
	routes,
	mode: 'history'
});

initialize(store,router);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
    	MainApp
    }
});
