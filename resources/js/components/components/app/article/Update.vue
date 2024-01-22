<template>
    <form @submit.prevent="updateArticle" class="content-600">
        <h1 class="h2 margin-top-0">{{ 'Edit: ' + articleStore.article.title }}</h1>
        <div class="editor margin-top-bottom-1">
            <div class="fs-18 bold margin-bottom-1">
                <input type="text"
                       v-model="articleStore.article.title"
                       name="title"
                       placeholder="Enter title here"
                       :class="{ 'border border-red' : articleStore.errors?.title}"
                >
                <div v-if="articleStore.errors?.title" class="margin-bottom-1" :class="['error-message']">
                    {{ articleStore.errors?.title && articleStore.errors.title[0] }}
                </div>
            </div>

            <div class="round margin-bottom-1" :class="{ 'border border-red' : articleStore.errors?.title}">
                <QuillEditor :key="quillReset"
                             v-model:content="articleStore.article.body"
                             contentType="html"
                             theme="snow">
                </QuillEditor>

                <div v-show="articleStore.errors?.body" :class="['error-message']">
                    {{ articleStore.errors?.body && articleStore.errors?.body[0] }}
                </div>
            </div>

            <div class="button-group margin-top-bottom-1">
                <button type="submit" class="primary">Save</button>
                <button @click="returnToDashboard" type="button" class="primary alt">Cancel</button>
            </div>

        </div>
    </form>
</template>

<script>
import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import Alert from "@/components/clean/Alert.vue";
import Modal from "@/components/clean/Modal.vue";
import {mapActions} from "vuex";


export default {
    name: "Create",
    components: {
        Alert,
        Modal,
        QuillEditor
    },

    computed: {
        articleStore() {
            return this.$store.state.article;
        }
    },

    data() {
        return {
            // Resets the quill text editor (trigger rerender)
            quillReset: 0,
        }
    },

    mounted() {
        this.get(this.$route.params.id)
    },

    methods: {
        ...mapActions({
            update: 'article/updateArticle',
            get: 'article/getArticle',
            notificationsReset: 'article/resetNotifications',
            returnTo: 'article/returnToPage',
            reset: 'article/resetArticle',
        }),

        initialize() {
            this.id = null;
            this.title = '';
            this.body = '';
        },

        returnToDashboard() {
            this.reset()
            this.returnTo('dashboard')
        },

        updateArticle() {
            this.notificationsReset()

            const article = {
                id: this.articleStore.article.id,
                // Get the editor title
                title: this.articleStore.article.title,
                // Get the editor content
                body: this.articleStore.article.body,
            };
            console.log(article)

            // Create new article
            this.update(article)
        },
    }
}
</script>
