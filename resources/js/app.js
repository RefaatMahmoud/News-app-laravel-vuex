import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";
import {routes} from "./routes"
import storeData from "./store"
import MainApp from "./components/MainApp";
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueMaterial)


const store = new Vuex.Store(storeData);

const router = new VueRouter({
    routes,
    mode: "history"
});

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const currentUser = store.state.currentUser;
    if(requiresAuth && !currentUser) {
        next('/login');
    } else if(to.path == '/login' && currentUser) {
        next('/');
    } else {
        next();
    }
});

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    store,
    components: {
        MainApp
    }
});
