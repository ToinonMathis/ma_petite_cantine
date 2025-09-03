<template>
    <Head title="Recette" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="flex flex-row justify-center gap-4 gap-md-20 mb-5">
                <h1>Toutes</h1>
                <h1>Les entrées</h1>
                <h1>Les plats</h1>
                <h1>Les dessert</h1>
                <h1>Mes favorites</h1>
            </div>
            <div class="flex flex-wrap -m-2">
                <div class="p-2 w-1/1 sm:w-1/2 md:w-1/3 lg:w-1/4" v-for="n in 8"
                     :key="n">
                    <CardRecipe/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import CardRecipe from "@/pages/recipes/CardRecipe.vue";
import {onMounted, ref, type Ref } from "vue";
import * as api from '@/api/api_recipes';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Recette',
        href: '/recipe',
    },
];
const api_recipes = api.api_recipes;
const recipes: Ref<[]> = ref([]);
onMounted(async () => {
    api_recipes.getRecipes()
        .then(data => {
            recipes.value = data;
        })
        .catch(err => {
            console.error('Erreur lors de la récupération des menus :', err);
        });
});

</script>
