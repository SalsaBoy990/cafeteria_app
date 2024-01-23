<template>
    <div class="container relative">

        <div class="alert__fixed">
            <Alert :key="cafeteriaStore.message" v-if="cafeteriaStore.message !== ''" :heading="cafeteriaStore.message" :showCloseButton="false"
                   :color="cafeteriaStore.status">
                <ul v-if="cafeteriaStore.errors" class="no-bullets padding-left-0 margin-0">
                    <li v-for="error in cafeteriaStore.errors">
                        {{ error instanceof Array ? error[0] : error }}
                    </li>
                </ul>
            </Alert>
        </div>

        <div class="padding-1">
            <h1 class="h2 margin-top-bottom-0">Manage Cafeteria</h1>

            <div class="uppercase fs-12 text-right">Annual Cafeteria limit</div>
            <div class="fs-18 text-right"><b>{{ cafeteriaStore.cafeteriaSum }}</b>/{{ cafeteriaStore.cafeteriaLimit }}
            </div>

            <CafeteriaTable></CafeteriaTable>

            <button type="button" @click="exportAllocationsToCSV" class="danger alt">
                <font-awesome-icon :icon="['fas', 'download']"/>
                Export data to CSV
            </button>

        </div>
    </div>
</template>
<script>
import Alert from "@/components/clean/Alert.vue";
import CafeteriaTable from "@/components/components/app/cafeteria/CafeteriaTable.vue";
import {mapActions} from "vuex";

export default {
    name: "dashboard",
    components: {
        Alert,
        CafeteriaTable
    },
    data() {
        return {
            cafeteriaStore: this.$store.state.cafeteria,
            user: this.$store.state.auth.user
        }
    },
    methods: {
        ...mapActions({
            export: 'cafeteria/exportAllocations',
        }),

        exportAllocationsToCSV() {
            this.export();
        },
    },
}
</script>
<style scoped lang="sass">
.alert__fixed
    position: fixed
    bottom: 0
    left: 2em
    min-width: 320px
</style>
