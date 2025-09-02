<template>
    <Head title="Recette" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <h1>TEST</h1>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Recette',
        href: '/recipe',
    },
];

</script>
