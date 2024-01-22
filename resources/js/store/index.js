import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from '@/store/auth'
import article from '@/store/article'

const store = createStore({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth,
        article
    }
})
export default store
