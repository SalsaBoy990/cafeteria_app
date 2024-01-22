import axios from "@/axios/api";
import router from '@/router'

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: {}
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        SET_USER(state, value) {
            state.user = value
        }
    },
    actions: {
        login({commit}) {
            return axios.get(import.meta.env.VITE_BASE_URL + 'api/v1/user').then(({data}) => {
                commit('SET_USER', data)
                commit('SET_AUTHENTICATED', true)
                router.push({name: 'dashboard'})
            }).catch(({response: {data}}) => {
                commit('SET_USER', {})
                commit('SET_AUTHENTICATED', false)
            })
        },
        logout({commit}) {
            commit('SET_USER', {})
            commit('SET_AUTHENTICATED', false)
        }
    }
}
