<template>
    <form @submit.prevent="createArticle" class="content-600">
        <h2 class="h4 margin-top-2">Add New Article</h2>
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
            title: '',
            body: '',
            // Resets the quill text editor (trigger rerender)
            quillReset: 0,
        }
    },

    mounted() {
        this.initialize();
        console.log(this.articleStore)
    },

    methods: {
        ...mapActions({
            create: 'article/createArticle',
            notificationsReset: 'article/resetNotifications',
        }),

        initialize() {
            this.id = null;
            this.title = '';
            this.body = '';
        },


        createArticle() {
            this.notificationsReset()

            const article = {
                // Get the editor title
                title: this.articleStore.article.title,
                // Get the editor content
                body: this.articleStore.article.body,
            };

            // Create new article
            this.create(article)

            setTimeout(() => {
                this.closed = true;
                this.quillReset = 1;
                //this.initialize();

            }, 3000)
        },
    }
}
</script>
