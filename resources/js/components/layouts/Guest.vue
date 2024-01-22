<template>
    <div class="spa-container relative" :class="{ dark: this.darkModeOn === true}">
        <Header @darkmodechanged="onDarkModeChange"></Header>

        <router-view></router-view>

        <span v-if="showScrollToTopButton() === true"
              class="light-gray pointer scroll-to-top-button padding-0-5 round"
              role="button" aria-label="To the top button"
              title="Toggle table of content"
              @click="scrollToTop">
            <font-awesome-icon :icon="['fas', 'chevron-up']"/>
        </span>

        <Footer/>
    </div>
</template>
<script>
import Header from '@/components/components/public/Header.vue';
import Footer from "@/components/components/public/Footer.vue";
import {debounce} from "lodash";

export default {
    name: "guest-layout",
    data() {
        return {
            darkModeOn: localStorage.getItem('darkMode') === 'true',
            scrollTop: 0,
            threshold: 800,
        }
    },

    beforeMount() {
        // remove previous
        window.removeEventListener("wheel", this.setScrollToTop);
    },

    mounted() {
        // listen to scroll event
        window.addEventListener("wheel",
            this.setScrollToTop);
    },

    components: {
        Header,
        Footer
    },

    methods: {
        // change in dark/light mode (event emitted from Header -> observed here)
        onDarkModeChange(val) {
            console.log(val);
            this.darkModeOn = val;
        },

        // to the top
        scrollToTop() {
            this.scrollTop = 0;
            document.body.scrollTop = 0;
        },

        // only show the button if scrolled over the threshold
        showScrollToTopButton() {
            return this.scrollTop > this.threshold
        },

        // delay invoking the method (only invokes the last callback after the timeout to have less function calls)
        setScrollToTop: debounce(function () {
            this.scrollTop = document.body.scrollTop;
            console.log(document.body.scrollTop);
        }, 300),

    }
}
</script>
