<template>
    <footer class="page-footer">
        <div class="footer-content">
            <nav>
                <router-link class="nav-link" :to="{ name: 'login' }">
                    <font-awesome-icon :icon="['fas', 'user']"/>
                    Login
                </router-link>
                <router-link class="nav-link" :to="{ name: 'register' }">
                    <font-awesome-icon :icon="['fas', 'user']"/>
                    Register
                </router-link>
            </nav>

            <small>&copy; 2023 Gulácsi András. All rights reserved!</small>
        </div>
    </footer>

</template>

<script>
export default {
    name: "Footer",
}
</script>

<style scoped>

</style>
