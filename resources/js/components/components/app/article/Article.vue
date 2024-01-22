<template>
    <div class="post card padding-0-5">
        <h2 class="margin-top-0 fs-24">
            <a :href="url + 'article/' + article?.id">{{ article?.title }}</a>
        </h2>
        <div v-html="article?.body"></div>

        <div class="button-group">
            <a :href="url + 'article/' + article?.id" class="button primary fs-12 margin-top-0">
                <font-awesome-icon :icon="['fas', 'pencil-alt']"/>
                Edit
            </a>
            <button @click="deleteArticle" class="danger fs-12">
                <font-awesome-icon :icon="['fas', 'trash']"/>
                Delete
            </button>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Article",
    components: {
    },
    props: {
        article: {
            required: true,
        }
    },

    data() {
        return {
            articleStore: this.$store.state.article,
            url: import.meta.env.VITE_BASE_URL
        }
    },

    methods: {
        ...mapActions({
            show: 'article/getArticle',
            delete: 'article/deleteArticle'
        }),

        deleteArticle() {
            const payload = {
                title: this.$props.article.title,
                id: this.$props.article.id,
            };

            this.delete(payload);
        }
    }
}
</script>
