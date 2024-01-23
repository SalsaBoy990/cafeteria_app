<template>
    <footer class="page-footer">
        <div class="footer-content">
            <nav>
                <router-link class="nav-link" :to="{ name: 'home' }">
                    <font-awesome-icon :icon="['fas', 'home']"/>
                    Home
                </router-link>

                <router-link class="nav-link" :to="{ name: 'cafeteria' }">
                    <font-awesome-icon :icon="['fas', 'money-bill']"/>
                    Cafeteria
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
