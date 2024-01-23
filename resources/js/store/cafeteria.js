import axios from "@/axios/api";

const apiUrl = import.meta.env.VITE_BASE_URL + import.meta.env.VITE_API_PREFIX
const baseUrl = import.meta.env.VITE_BASE_URL

export default {
    namespaced: true,
    state: {
        allocations: {},
        cafeteriaLimit: 0,
        cafeteriaSum: 0,
        pocketLimit: 0,
        pocketOneSum: 0,
        pocketTwoSum: 0,
        pocketThreeSum: 0,
        errors: {},
        message: '',
        status: '',
    },
    getters: {
        allocations(state) {
            return state.allocations
        },
        cafeteriaLimit(state) {
            return state.cafeteriaLimit
        },
        cafeteriaSum(state) {
            return state.cafeteriaSum
        },
        pocketLimit(state) {
            return state.pocketLimit
        },
        pocketOneSum(state) {
            return state.pocketOneSum
        },
        pocketThreeSum(state) {
            return state.pocketThreeSum
        },
        errors(state) {
            return state.errors
        },
        message(state) {
            return state.message
        },
        status(state) {
            return state.status
        }
    },
    mutations: {
        SET_ALLOCATIONS(state, value) {
            state.allocations = value
        },
        SET_CAFETERIA_LIMIT(state, value) {
            state.cafeteriaLimit = value
        },
        SET_CAFETERIA_SUM(state, value) {
            state.cafeteriaSum = value
        },
        SET_POCKET_LIMIT(state, value) {
            state.pocketLimit = value
        },
        SET_POCKET_ONE_SUM(state, value) {
            state.pocketOneSum = value
        },
        SET_POCKET_TWO_SUM(state, value) {
            state.pocketTwoSum = value
        },
        SET_POCKET_THREE_SUM(state, value) {
            state.pocketThreeSum = value
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
        /* Get allocations */
        async getAllocations({commit, context}) {
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios.get(apiUrl + 'allocation', {}).then((res) => {
                console.log(res);
                if (200 === res.status || 204 === res.status) {
                    commit('SET_ALLOCATIONS', res.data.result.data)
                }
                commit('SET_ERRORS', {});
                commit('SET_MESSAGE', '');
                commit('SET_STATUS', '');

            }).catch(err => {
                commit('SET_ERRORS', err.response.data.errors);
                console.error(err)
            });
        },


        /* Export allocations to CSV file */
        async exportAllocations({commit}) {
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios({
                method: 'get',
                url: apiUrl + 'allocation/download_csv',
                responseType: 'blob',
            }).then(res => {
                console.log(res)
                const fileURL = window.URL.createObjectURL(new Blob([res.data]));
                const fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', res.headers.filename);
                document.body.appendChild(fileLink);
                fileLink.click();
            }).catch(err => {
                commit('SET_ERRORS', err.response.data.errors);
                console.error(err)
            });
        },


        /* Resets all existing notifications in the state */
        resetNotifications({commit}) {
            commit('SET_MESSAGE', '');
            commit('SET_STATUS', 'success');
            commit('SET_ERRORS', {});
        },


        /* Update existing allocation */
        async updateAllocation({commit, dispatch}, data) {
            console.log(data)
            if (!data.id) {
                return false;
            }
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios({
                method: "put",
                url: apiUrl + "allocation/" + data.id,
                data,
            })
                .then(res => {
                    commit('SET_MESSAGE', 'Allocation successfully updated!');
                    commit('SET_STATUS', 'success');

                    setTimeout(() => {
                        dispatch('getAllocations');
                        dispatch('getAllocationSums');
                    }, 3000)
                })
                .catch(err => {
                    commit('SET_MESSAGE', 'Failed to save the allocation!');
                    commit('SET_STATUS', 'error');
                    commit('SET_ERRORS', err.response.data.errors);
                });
        },


        /* Reset existing allocation */
        async resetAllocation({commit, dispatch}, id) {
            if (!id) {
                return false;
            }
            const data = {
                pocket1: 0,
                pocket2: 0,
                pocket3: 0,
            }
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios({
                method: "put",
                url: apiUrl + "allocation/reset/" + id,
                data,
            })
                .then(res => {
                    commit('SET_MESSAGE', 'Successful Allocation reset!');
                    commit('SET_STATUS', 'success');

                    setTimeout(() => {
                        dispatch('getAllocations');
                        dispatch('getAllocationSums');
                    }, 3000)
                })
                .catch(err => {
                    commit('SET_MESSAGE', 'Failed to reset the allocation!');
                    commit('SET_STATUS', 'error');
                    commit('SET_ERRORS', err.response.data.errors);
                });
        },


        /* Gets allocation limits */
        async getAllocationLimits({commit}) {
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios.get(apiUrl + 'allocation/limits')
                .then(res => {
                    console.log(res)
                    commit('SET_CAFETERIA_LIMIT', res.data.result.cafeteriaLimit)
                    commit('SET_POCKET_LIMIT', res.data.result.pocketLimit)
                })
                .catch(err => {
                    commit('SET_MESSAGE', 'Failed get the limits!');
                    commit('SET_STATUS', 'error');
                    commit('SET_ERRORS', err.response.data.errors);
                });
        },

        /* Gets allocation sums */
        async getAllocationSums({commit}) {
            await axios.get(baseUrl + 'sanctum/csrf-cookie')
            await axios.get(apiUrl + 'allocation/sums')
                .then(res => {
                    console.log(res)
                    commit('SET_CAFETERIA_SUM', res.data.result.cafeteriaSum)
                    commit('SET_POCKET_ONE_SUM', res.data.result.pocketOneSum)
                    commit('SET_POCKET_TWO_SUM', res.data.result.pocketTwoSum)
                    commit('SET_POCKET_THREE_SUM', res.data.result.pocketThreeSum)
                })
                .catch(err => {
                    commit('SET_MESSAGE', 'Failed get sums!');
                    commit('SET_STATUS', 'error');
                    commit('SET_ERRORS', err.response.data.errors);
                });
        },


    }
}
