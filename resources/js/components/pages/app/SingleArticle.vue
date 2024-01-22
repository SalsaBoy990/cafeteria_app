<template>
    <div class="container relative">
        <div class="" style="position: fixed; top: 5em; left: 2em;">
            <Alert v-if="articleStore.message !== ''" :heading="articleStore.status" :showCloseButton="true"
                   :color="articleStore.status">
                {{ articleStore.message }}
            </Alert>
        </div>

        <div class="padding-1">
            <Update></Update>
        </div>
    </div>
</template>
<script>
import Update from "@/components/components/app/article/Update.vue";
import Alert from "@/components/clean/Alert.vue";

export default {
    name: "single-article",
    components: {
        Alert,
        Update
    },
    data() {
        return {
            articleStore: this.$store.state.article,
            user: this.$store.state.auth.user
        }
    }
}
</script>
<style scoped lang="sass">
.dashboard
    .dashboard-container
        display: flex
        flex-direction: row
        flex-wrap: wrap
        gap: 2em

        aside
            width: 400px
            @media screen and (max-width: 700px)
                width: 100%

        main
            width: calc(100% - 432px)
            @media screen and (max-width: 900px)
                width: 100%
</style>
