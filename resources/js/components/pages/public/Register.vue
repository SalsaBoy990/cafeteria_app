<template>
    <main class="card content-600">
        <div class="header padding-left-1-5">
            <h1 class="h3 padding-top-0-5">Register</h1>
        </div>
        <div class="padding-left-right-1-5 padding-bottom-1-5">

            <form action="javascript:void(0)" @submit="register" method="post">
                <div v-if="Object.keys(validationErrors).length > 0">
                    <div class="alert error" role="alert">
                        <ul class="margin-0">
                            <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                        </ul>
                    </div>
                </div>

                <label for="name" class="bold">Name</label>
                <input type="text" name="name" v-model="user.name" id="name" placeholder="Enter name">

                <label for="email" class="bold">Email</label>
                <input type="text" name="email" v-model="user.email" id="email" placeholder="Enter Email">

                <label for="password" class="bold">Password</label>
                <input type="password" name="password" v-model="user.password" id="password"
                       placeholder="Enter Password">

                <label for="password_confirmation" class="bold">Confirm Password</label>
                <input type="password" name="password_confirmation" v-model="user.password_confirmation"
                       id="password_confirmation" placeholder="Enter Password" class="">

                <button type="submit" :disabled="processing" id="register-button" class="primary submit">
                    {{ processing ? "Please wait" : "Register" }}
                </button>

                <div class="text-center">
                    <label>Already have an account?
                        <router-link :to="{name:'login'}">Login Now!</router-link>
                    </label>
                </div>
            </form>
        </div>

    </main>
</template>
<script>
import {mapActions} from 'vuex'

export default {
    name: 'register',
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            validationErrors: {},
            processing: false
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        async register() {
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/register', this.user).then(response => {
                this.validationErrors = {}
                this.signIn()
            }).catch(({response}) => {
                if (response.status === 422) {
                    this.validationErrors = response.data.errors
                } else {
                    this.validationErrors = {}
                    alert(response.data.message)
                }
            }).finally(() => {
                this.processing = false
            })
        }
    }
}
</script>
