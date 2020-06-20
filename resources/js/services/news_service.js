import {http} from "./http_service";
import store from "../store";

export function create(data) {
    let api_url = `${store.state.baseApiUrl}/news`;
    return http().post(api_url, data, {
        headers: {
            Authorization: `Bearer ${store.state.currentUser.token}`,
            Accept: "application/json"
        }
    }).then(response => {
            return response
        },
        error => {
            return error.response.data
        }
    )
}


export function get() {
    let api_url = `${store.state.baseApiUrl}/news`;
    return http().get(api_url, {
        headers: {
            Authorization: `Bearer ${store.state.currentUser.token}`
        }
    }).then(response => {
        return response.data.data
    }).catch(error => {
        alert(error)
    })
}

export function remove(id) {
    let api_url = `${store.state.baseApiUrl}/news/${id}`;
    return http().delete(api_url,{
        headers: {
            Authorization: `Bearer ${store.state.currentUser.token}`
        }
    }).then(response => {
       return response
    }).catch(error => {
        alert(error)
    })
}
