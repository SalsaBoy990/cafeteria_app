import {createWebHistory, createRouter} from 'vue-router'
import store from '@/store'

/* Guest Component */
const Login = () => import('@/components/pages/public/Login.vue')

const Register = () => import('@/components/pages/public/Register.vue')

const Home = () => import('@/components/pages/app/Home.vue')
/* Guest Component */


/* Layouts */
const AppLayout = () => import('@/components/layouts/App.vue')
const GuestLayout = () => import('@/components/layouts/Guest.vue')
/* Layouts */


/* Authenticated Component */
const Dashboard = () => import('@/components/pages/app/Dashboard.vue')
const SingleArticle = () => import('@/components/pages/app/SingleArticle.vue')
/* Authenticated Component */


const routes = [
    {
        path: "/home",
        component: AppLayout,
        meta: {
            middleware: "auth",
        },
        children: [
            {
                name: "home",
                path: '/home',
                component: Home,
                meta: {
                    title: `Home`
                }
            }
        ]
    },

    {
        path: "/login",
        component: GuestLayout,
        meta: {
            middleware: "guest",
        },
        children: [
            {
                name: "login",
                path: '/login',
                component: Login,
                meta: {
                    title: `Login`
                }
            }
        ]
    },

    {
        path: "/register",
        component: GuestLayout,
        meta: {
            middleware: "guest",
        },
        children: [
            {
                name: "register",
                path: '/register',
                component: Register,
                meta: {
                    title: `Register`
                }
            }
        ]
    },

    {
        path: "/",
        component: AppLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            }
        ]
    },


    {
        path: "/article/:id",
        component: AppLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "article",
                path: '/article/:id',
                component: SingleArticle,
                meta: {
                    title: `Single Article`
                }
            }
        ]
    },

]
const router = createRouter({
    history: createWebHistory(),
    routes,
})
router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware === "guest") {
        if (store.state.auth.authenticated) {
            next({name: "dashboard"})
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({name: "login"})
        }
    }
})
export default router
