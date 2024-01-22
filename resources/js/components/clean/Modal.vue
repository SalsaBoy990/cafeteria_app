<template>
    <div>
        <button type="button" @click.prevent="openModal" class="black-button padding-1">{{ title }}</button>
        <div v-show="modal === true" class="modal" :class="{'show': modal}">
            <div class="modal-content content-600 card card-4 animate-top relative">
                <div class="box primary round-top">
                    <button type="button" @click="closeModal"
                            class="close-button fs-18 primary topright round-top-right text-white">
                        <font-awesome-icon :icon="['fas', 'times']"/>
                    </button>
                    <h3 class="text-white">
                        <slot name="header"></slot>
                    </h3>
                </div>
                <div class="box white">
                    <slot name="body"></slot>
                </div>
                <div class="box primary round-bottom text-gray-10">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modal',
    props: {
        title: 'Open modal',
        closed: false,
    },
    data() {
        return {
            modal: false,
        }
    },
    mounted() {
    },

    watch: {
        closed(newValue, oldValue) {
            if (newValue === true) {
                this.closeModal();
            }
        }
    },
    methods: {
        openModal() {
            this.modal = true;
        },
        closeModal() {
            this.modal = false;
        }
    },
}

</script>
