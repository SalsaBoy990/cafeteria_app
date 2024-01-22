<template>
    <div v-if="openAlert === true" role="alert" class="relative" :class="[color !== '' ? alertClasses : '']">
        <button v-if="showCloseButton === true" @click="hideAlert()" class="close-button topright">
            <font-awesome-icon :icon="['fa-solid', 'fa-xmark']"/>
        </button>

        <div class="h5 bold text-black">
          <font-awesome-icon :icon="['fa-solid', 'fa-exclamation-triangle']" :class="'margin-right-0-5'"/>{{ heading }}</div>
        <p class="alert-message">
            <slot></slot>
        </p>
    </div>
</template>

<script>
export default {
    name: 'Alert',
    props: [
        'showCloseButton',
        'open',
        'color',
        'heading'
    ],
    data() {
        return {
            openAlert: true,
        }
    },
    mounted() {
        this.openAlert = true;
    },
    methods: {
        showAlert() {
            this.openAlert = true;
        },

        hideAlert() {
            this.openAlert = false;
        }
    },

    computed: {
        alertClasses() {
            switch (this.$props.color) {
                case 'danger':
                    return 'alert danger';
                case 'warning':
                    return 'alert warning';
                case 'success':
                    return 'alert success';
                case 'info':
                    return 'alert info';
                default:
                    return 'alert info';
            }
        }
    }
}

</script>
