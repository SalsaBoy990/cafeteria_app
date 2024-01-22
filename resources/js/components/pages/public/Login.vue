<template>
    <main class="card content-600">
        <div class="header padding-left-1-5">
            <h1 class="h3 padding-top-0-5">Sign in</h1>
        </div>
        <div class="padding-left-right-1-5 padding-bottom-1-5">

            <form action="javascript:void(0)" method="post">
                <div v-if="Object.keys(validationErrors).length > 0">
                    <div class="alert error" role="alert">
                        <ul class="margin-0 no-bullets padding-left-0">
                            <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                        </ul>
                    </div>
                </div>

                <label for="email" class="bold">Email</label>
                <input type="email" v-model="auth.email" name="email" id="email" class="">

                <label for="password" class="bold">Password</label>
                <input type="password" v-model="auth.password" name="password" id="password" class="form-control">

                <button type="submit" :disabled="processing" @click="login" id="login-button" class="primary submit">
                    {{ processing ? "Please wait" : "Login" }}
                </button>

                <div class="text-center">
                    <label>Don't have an account?
                        <router-link :to="{name:'register'}">Register Now!</router-link>
                    </label>
                </div>
            </form>
        </div>

    </main>
</template>
<script>
import {mapActions} from 'vuex'
import Alert from "@/components/clean/Alert.vue";

export default {
    name: "login",
    components: {
        Alert
    },
    data() {
        return {
            auth: {
                email: import.meta.env.VITE_USERNAME,
                password: import.meta.env.VITE_PASSWORD,
            },
            validationErrors: {},
            processing: false,
        }
    },
    methods: {

        ...mapActions({
            signIn: 'auth/login'
        }),

        async login() {
            this.validationErrors = {}
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/login', this.auth).then(({data}) => {
                this.signIn()
            }).catch(({response}) => {
                console.log(response)
                if (response.status === 422) {
                    this.validationErrors = response.data.errors
                } else {
                    this.validationErrors = {}
                    this.validationErrors =  response.data.errors
                    console.log(response)
                }
            }).finally(() => {
                this.processing = false
            })
        },

    }
}
</script>
