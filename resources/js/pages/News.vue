<template>
    <Head title="Recette" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <h1 class="mb-10 text-center text-2xl font-bold text-primary">Posts</h1>
            <div class="flex flex-col items-center gap-10" v-for="i in 10">
                <Post/>
            </div>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Head } from '@inertiajs/vue3';
import Post from "@/pages/news/Post.vue";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Recette',
        href: '/recipe',
    },
];
</script>
<style scoped>
.post {
    max-width: 500px;
}
</style>
