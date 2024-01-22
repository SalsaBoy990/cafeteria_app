<template>
    <section>
        <Create></Create>
        <hr>

        <div class="bar pagination margin-top-bottom-1">
            <a v-for="(link) in articleStore.links" class="bar-item button"
               :class="link.active === true ? 'active' : 'transparent'" @click="getPage(link.url)"
               v-html="link.label"></a>
        </div>

        <div class="articles-container">
            <div class="articles-grid">
                <Article v-for="article in articleStore.articles" :key="article.id" :article="article"></Article>
            </div>
        </div>

        <div class="bar pagination margin-top-bottom-1">
            <a v-for="(link) in articleStore.links" class="bar-item button"
               :class="link.active === true ? 'active' : 'transparent'" @click="getPage(link.url)"
               v-html="link.label"></a>
        </div>
    </section>
</template>

<script>
import {mapActions} from "vuex";
import Article from "./Article.vue";
import Create from "@/components/components/app/article/Create.vue";

export default {
    name: "Articles",
    components: {
        Article,
        Create,
    },
    data() {
        return {
            articleStore: this.$store.state.article,
            params: [],
        }
    },

    methods: {
        ...mapActions({
            getArticles: 'article/getArticles',
            getPage: 'article/getArticlePage',
        }),
    },

    mounted() {
        this.getArticles();
    },
}
</script>

<style scoped lang="sass">
.articles-container
    .articles-grid
        display: grid
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr))
        row-gap: 2em
        column-gap: 1em
</style>
