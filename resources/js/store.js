import { getLocalUser } from "./helper/auth";
import axios from "axios";

const user = getLocalUser();

export default {
    state: {
        baseApiUrl: "http://localhost:8000/api",
        currentUser: user,
        isLoggedIn: !!user,
        auth_error: null,
        news: []
    },
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        getNews(state) {
            return state.news;
        },
        baseApiUrl(state) {
            return state.baseApiUrl;
        }
    },
    mutations: {
        login(state) {
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.currentUser = payload.data;
            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        getNews(state, payload) {
            state.news = payload;
        },
        createNew(state, payload) {
            state.news.push(payload);
        },
        removeNew(state, id) {
            state.news = state.news.filter(item => item.id != id);
        },
        updateNew(state,data){
            state.news = state.news.map( (item) => {
                if(item.id == data.id){
                    item = data;
                }
            })
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getNews(context) {
            let api_url = `${context.state.baseApiUrl}/news`;
            axios
                .get(api_url, {
                    headers: {
                        Authorization: `Bearer ${context.state.currentUser.token}`
                    }
                })
                .then(response => {
                    context.commit("getNews", response.data.data);
                })
                .catch(error => console.log(error));
        },
        createNew(context, data) {
            let api_url = `${context.state.baseApiUrl}/news`;
            axios
                .post(api_url, data, {
                    headers: {
                        Authorization: `Bearer ${context.state.currentUser.token}`
                    }
                })
                .then(response => {
                    context.commit("createNew", response.data.data);
                })
                .catch(error => console.log(error));
        },
        updateNew(context, data) {
            let api_url = `${context.state.baseApiUrl}/news/${data.id}`;
            axios
                .patch(api_url, data, {
                    headers: {
                        Authorization: `Bearer ${context.state.currentUser.token}`
                    }
                })
                .then((response) => {
                    context.commit('updateNew',response.data.data)
                })
                .catch(error => console.log(error));
        },
        removeNew(context, id) {
            let api_url = `${context.state.baseApiUrl}/news/${id}`;
            let confirm = window.confirm("Are you sure to delete this new");
            if (confirm) {
                axios
                    .delete(api_url, {
                        headers: {
                            Authorization: `Bearer ${context.state.currentUser.token}`
                        }
                    })
                    .then(context.commit("removeNew", id))
                    .catch(error => console.log(error));
            }
        }
    }
};
