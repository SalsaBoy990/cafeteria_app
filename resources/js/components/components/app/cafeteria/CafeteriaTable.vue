<template>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>DATE</th>
            <th>POCKET_1
                <div class="fs-14 normal">Limit: <b>{{ cafeteriaStore.pocketOneSum }}</b>/{{
                        cafeteriaStore.pocketLimit
                    }}
                </div>
            </th>
            <th>POCKET_2
                <div class="fs-14 normal">Limit: <b>{{ cafeteriaStore.pocketTwoSum }}</b>/{{
                        cafeteriaStore.pocketLimit
                    }}
                </div>
            </th>
            <th>POCKET_3
                <div class="fs-14 normal">Limit: <b>{{
                        cafeteriaStore.pocketThreeSum
                    }}</b>/{{ cafeteriaStore.pocketLimit }}
                </div>
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
</template>
<script>
import {mapActions} from "vuex";

export default {
    name: "cafeteria-table",
    data() {
        return {
            cafeteriaStore: this.$store.state.cafeteria,
            user: this.$store.state.auth.user
        }
    },
    methods: {
        ...mapActions({
            getAll: 'cafeteria/getAllocations',
            reset: 'cafeteria/resetAllocation',
            update: 'cafeteria/updateAllocation',
            getLimits: 'cafeteria/getAllocationLimits',
            getSums: 'cafeteria/getAllocationSums',
        }),

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
</style>
