<template>
    <Head title="Recette" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <h1 class="text-center text-primary text-2xl font-bold mb-10">Nouveau post</h1>
            <p>{{ post.image ? post.image.name : 'Aucun fichier' }}</p>

            <div class="rounded-2xl border bg-white shadow-lg post p-4">
                <Input
                    label="Titre"
                    v-model="post.title"
                    type="text"
                />
                <Input
                    label="Description du post"
                    v-model="post.content"
                    type="textarea"
                />
                <Input
                    label="Image du post"
                    v-model="post.image"
                    type="file"
                />
                <Button
                    text-label="Enregistrer"
                    @click="submitPost"
                />
                <Button
                    text-label="voir la modal"
                    @click="showModal = true"
                />
            </div>
            <Modal id="Test" title="test" v-model="showModal" closable="true">
                <template #body>
                    <p>TEst</p>
                </template>
            </Modal>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Input from "@/components/_custom/Input.vue";
import Button from "@/components/_custom/Button.vue";
import {ref, Ref} from "vue";
import {CreatePost} from "@/types/post";
import {api_posts} from "@/api/api_posts";
import Modal from '@/components/_custom/Modal.vue';

const post: Ref<CreatePost> = ref({
    title: '',
    content: '',
    image: null,
});
const showModal = ref(false);


function submitPost() {
    try {
        const formData = new FormData();
        formData.append("title", post.value.title);
        formData.append("content", post.value.content);
        if (post.value.image instanceof File) {
            formData.append("image", post.value.image);
        }
        api_posts.post(formData)
    } catch (error) {
        console.error("Erreur création post :", error);
    }
}
</script>
<style scoped>

</style>
