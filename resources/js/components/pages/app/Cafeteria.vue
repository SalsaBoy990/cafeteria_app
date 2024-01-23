<template>
    <div class="container relative">

        <div class="alert__fixed">
            <Alert v-if="cafeteriaStore.message !== ''" :heading="cafeteriaStore.message" :showCloseButton="true"
                   :color="cafeteriaStore.status">
                <ul v-if="cafeteriaStore.errors" class="no-bullets padding-left-0 margin-0">
                    <li v-for="error in cafeteriaStore.errors">
                        {{ error }}
                    </li>
                </ul>
            </Alert>
        </div>

        <div class="padding-1">
            <h1 class="h2 margin-top-bottom-0">Manage Cafeteria</h1>

            <div class="uppercase fs-12 text-right">Annual Cafeteria limit</div>
            <div class="fs-18 text-right"><b>{{ cafeteriaStore.cafeteriaSum }}</b>/{{ cafeteriaStore.cafeteriaLimit }}
            </div>

            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>DATE</th>
                    <th>POCKET_1
                        <div class="fs-14 normal">Limit: <b>{{ cafeteriaStore.pocketOneSum }}</b>/{{ cafeteriaStore.pocketLimit }}</div>
                    </th>
                    <th>POCKET_2
                        <div class="fs-14 normal">Limit: <b>{{ cafeteriaStore.pocketTwoSum }}</b>/{{ cafeteriaStore.pocketLimit }}</div>
                    </th>
                    <th>POCKET_3
                        <div class="fs-14 normal">Limit: <b>{{ cafeteriaStore.pocketThreeSum }}</b>/{{ cafeteriaStore.pocketLimit }}</div>
                    </th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="allocation in cafeteriaStore.allocations">
                    <td>{{ allocation.id }}</td>
                    <td>{{ allocation.date }}</td>
                    <td>
                        <input type="number" v-model="allocation.pocket1" name="pocket1">
                    </td>
                    <td>
                        <input type="number" v-model="allocation.pocket2" name="pocket2">
                    </td>
                    <td>
                        <input type="number" v-model="allocation.pocket3" name="pocket3">
                    </td>
                    <td>
                        <div class="button-group">
                            <button type="button" class="primary" @click="updateAllocation(allocation)">Update</button>
                            <button type="reset" class="info alt" @click="resetAllocation(allocation.id)">Reset</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <button type="button" @click="exportAllocationsToCSV" class="danger alt">
                <font-awesome-icon :icon="['fas', 'download']"/>
                Export data to CSV
            </button>

        </div>
    </div>
</template>
<script>
import Alert from "@/components/clean/Alert.vue";
import {mapActions} from "vuex";

export default {
    name: "dashboard",
    components: {
        Alert,
    },
    data() {
        return {
            cafeteriaStore: this.$store.state.cafeteria,
            user: this.$store.state.auth.user
        }
    },
    methods: {
        ...mapActions({
            getAll: 'cafeteria/getAllocations',
            export: 'cafeteria/exportAllocations',
            reset: 'cafeteria/resetAllocation',
            update: 'cafeteria/updateAllocation',
            getLimits: 'cafeteria/getAllocationLimits',
            getSums: 'cafeteria/getAllocationSums',
        }),

        exportAllocationsToCSV() {
            this.export();
        },

        updateAllocation(allocation) {
            this.update(allocation)
        },

        resetAllocation(id) {
            this.reset(id)
        }
    },

    mounted() {
        this.getAll();
        this.getSums();
        this.getLimits();
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
