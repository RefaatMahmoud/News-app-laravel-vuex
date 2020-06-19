export default {
    state: {
        welcomeMessage: "Hello From Vuex"
    },
    getters: {
        welcome(state) {
            return state.welcomeMessage;
        }
    },
    actions: {},
    mutations: {}
}
