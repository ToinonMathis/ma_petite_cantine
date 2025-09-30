<template>
    <Head title="Recette" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <h1 class="text-center text-primary text-2xl font-bold mb-10">Nouveau post</h1>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
</script>
<style scoped>

</style>
