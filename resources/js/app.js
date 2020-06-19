import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";
import {routes} from "./routes"
import storeData from "./store"
import MainApp from "./components/MainApp";
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueMaterial)

const store = new Vuex.Store(storeData);

const router = new VueRouter({
    routes,
    mode: "history"
});

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
