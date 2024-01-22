import axios from "@/axios/api";
import router from '@/router'

const apiUrl = import.meta.env.VITE_BASE_URL + import.meta.env.VITE_API_PREFIX
const baseUrl = import.meta.env.VITE_BASE_URL

export default {
    namespaced: true,
    state: {
        articles: {},
        links: [],
        currentPage: 1,
        article: {
            id: null,
            title: '',
            body: '',
        },
        errors: {},
        message: '', // status message and color for the alerts
        status: '',
    },
    getters: {
        articles(state) {
            return state.articles
        },
        article(state) {
            return state.article
        },
        links(state) {
            return state.links
        },
        currentPage(state) {
            return state.currentPage
        },
        errors(state) {
            return state.errors
        },
        message(state) {
            return state.message
        },
        color(state) {
            return state.color
        }
    },
    mutations: {
        SET_ARTICLES(state, value) {
            state.articles = value
        },
        SET_ARTICLE(state, value) {
            state.article = value
        },
        SET_LINKS(state, value) {
            state.links = value
        },
        SET_CURRENT_PAGE(state, value) {
            state.currentPage = value
        },
        SET_ERRORS(state, value) {
            state.errors = value
        },
        SET_MESSAGE(state, value) {
            state.message = value
        },
        SET_STATUS(state, value) {
            state.status = value
        }
    },
    actions: {
        /* Get articles */
        async getArticlePage({commit, context}, url) {
            commit('SET_ARTICLE', {
                id: null,
                title: '',
                body: '',
            });

            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios.get(url, {}).then((res) => {
                console.log(res);
                if (200 === res.status || 204 === res.status) {
                    commit('SET_ARTICLES', res.data.result.data)
                    commit('SET_LINKS', res.data.result.meta.links)
                    commit('SET_CURRENT_PAGE', res.data.result.meta.current_page)
                }
                commit('SET_ERRORS', {});
                commit('SET_MESSAGE', '');
                commit('SET_STATUS', '');

            }).catch(err => {
                commit('SET_ERRORS', err.response.data.errors);
                console.error(err)
            });
        },


        /* Get articles */
        async getArticles({commit, context}) {
            commit('SET_ARTICLE', {
                id: null,
                title: '',
                body: '',
            });

            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios.get(apiUrl + 'article', {}).then((res) => {
                console.log(res);
                if (200 === res.status || 204 === res.status) {
                    commit('SET_ARTICLES', res.data.result.data)
                    commit('SET_LINKS', res.data.result.meta.links)
                    commit('SET_CURRENT_PAGE', res.data.result.meta.current_page)
                }
                commit('SET_ERRORS', {});
                commit('SET_MESSAGE', '');
                commit('SET_STATUS', '');

            }).catch(err => {
                commit('SET_ERRORS', err.response.data.errors);
                console.error(err)
            });
        },


        /* Get one post by id */
        async getArticle({commit}, id) {
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios.get(apiUrl + 'article/' + id).then(res => {
                if (200 === res.status || 204 === res.status) {
                    console.log(res)
                    commit('SET_ARTICLE', res.data.result)
                }
            }).catch(err => {
                commit('SET_ERRORS', err.response.data.errors);
                console.error(err)
            });
        },


        resetNotifications({commit}) {
            commit('SET_MESSAGE', '');
            commit('SET_STATUS', 'success');
            commit('SET_ERRORS', {});
        },


        resetArticle({commit}) {
            commit('SET_ARTICLE', {
                id: null,
                title: '',
                body: '',
            });
        },


        returnToPage({ context }, name = 'dashboard') {
            router.push({name: name})
        },


        /* Save new post */
        async createArticle({commit, dispatch}, data) {
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios({
                // Setup method
                method: 'post',
                // Setup rest url
                url: apiUrl + 'article',
                // Set up the post object to send
                data,
            })
                .then(res => {
                    commit('SET_MESSAGE', 'Article saved successfully!');
                    commit('SET_STATUS', 'success');

                    setTimeout(() => {
                        dispatch('getArticles');
                    }, 2000)
                })
                .catch(err => {
                    console.log(err);
                    commit('SET_MESSAGE', 'Failed to save the post!');
                    commit('SET_STATUS', 'error');
                    commit('SET_ERRORS', err.response?.data?.errors);
                })

        },


        /* Update existing post */
        async updateArticle({commit, dispatch}, data) {
            console.log(data)
            if (!data.id) {
                return false;
            }
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios({
                // Setup method
                method: "put",
                // Setup url
                url: apiUrl + "article/" + data.id,
                // Set up the post object to send
                data,
            })
                .then(res => {
                    commit('SET_MESSAGE', 'Article updated successfully!');
                    commit('SET_STATUS', 'success');
                    commit('SET_ARTICLE', {
                        id: null,
                        title: '',
                        body: '',
                    });

                    router.push({name: 'dashboard'})
                })
                .catch(err => {
                    commit('SET_MESSAGE', 'Failed to save the post!');
                    commit('SET_STATUS', 'error');
                    commit('SET_ERRORS', err.response.data.errors);
                });
        },


        /* Deletes one post */
        async deleteArticle({commit, dispatch}, {id, title}) {
            // Confirm that user wants to delete post
            const confirm = window.confirm(`Delete Article: "${title}"`);

            // If user confirms delete then proceed
            if (true === confirm) {
                await axios.get(baseUrl + 'sanctum/csrf-cookie')
                axios({
                    // Set method to delete
                    method: "delete",
                    // Set up the URL for the post to delete
                    url: apiUrl + 'article/' + id,
                })
                    .then(res => {
                        commit('SET_MESSAGE', 'Deleted the post!');
                        commit('SET_STATUS', 'success');
                        commit('SET_ARTICLE', null);

                        setTimeout(() => {
                            dispatch('getArticles');
                        }, 2000)
                    })
                    .catch(err => {
                        commit('SET_MESSAGE', 'Failed to delete the post!');
                        commit('SET_STATUS', 'error');
                        commit('SET_ERRORS', err.response?.data?.errors);
                    });
            }
        },

    }
}
