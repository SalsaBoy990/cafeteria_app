import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from '@/store/auth'
import article from '@/store/article'
import cafeteria from "@/store/cafeteria.js";

const store = createStore({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth,
        article,
        cafeteria
    }
})
export default store
