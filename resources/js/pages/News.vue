<template>
    <Head title="Recette" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4" v-if="posts.length > 0">
            <h1 class="mb-10 text-center text-2xl font-bold text-primary">Posts</h1>
            <div class="flex flex-col items-center gap-10" v-for="post in posts">
                <PostComponent
                    :post="post"
                    @like="like"
                />
            </div>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PostComponent from "@/pages/news/Post.vue";
import type {Post} from "@/types/post"
import {onMounted, ref, Ref} from "vue";
import {api_posts} from "@/api/api_posts";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Recette',
        href: '/recipe',
    },
];
const posts: Ref<Post[]> = ref([]);

onMounted(() => {
    api_posts.getPosts().then((response) =>{
        posts.value = response;
    });
});
function like(idPost) {
    const post = posts.value.find(p => p.id === idPost);
    if (!post) return;
    console.log(posts.value)
    // Basculer l'état 'user_has_liked'
    post.user_has_liked = !post.user_has_liked;
    console.log(posts.value)
}
</script>
<style scoped>
.post {
    max-width: 500px;
}
</style>
