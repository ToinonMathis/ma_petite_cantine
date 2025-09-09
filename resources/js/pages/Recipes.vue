<template>
    <Head title="Recette" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-row overflow-x-auto p-2 gap-3 mb-5">
            <Button
                text-label="Toutes"
                :theme="recipeType === 'all' ? 'primary' : 'primaryOutline'"
                @click="recipeType = 'all'"
            />
            <Button
                text-label="Entrées"
                :theme="recipeType === 'entrée' ? 'primary' : 'primaryOutline'"
                @click="recipeType = 'entrée'"
            />
            <Button
                text-label="Plats"
                :theme="recipeType === 'plat' ? 'primary' : 'primaryOutline'"
                @click="recipeType = 'plat'"
            />
            <Button
                text-label="Desserts"
                :theme="recipeType === 'dessert' ? 'primary' : 'primaryOutline'"
                @click="recipeType = 'dessert'"
            />
            <Button
                text-label="Favoris"
                :theme="recipeType === 'favori' ? 'primary' : 'primaryOutline'"
                @click="recipeType = 'favori'"
            />
        </div>
        <RecipeList
            :recipes="viewRecipes"
            @selectRecipe="selectRecipe"
            v-if="!recipeSelected"
        />
        <RecipeSelected v-if="recipeSelected" :recipe="recipeSelected" @return="recipeSelected = null"/>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {computed, onMounted, ref, type Ref} from "vue";
import * as api from '@/api/api_recipes';
import type { Recipe } from "@/types/menu/recipe.ts";
import Button from "@/components/_custom/Button.vue";
import RecipeList from "@/pages/recipes/RecipeList.vue";
import RecipeSelected from "@/pages/recipes/RecipeSelected.vue";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Recette',
        href: '/recipe',
    },
];
const api_recipes = api.api_recipes;
const recipes: Ref<Recipe[]> = ref([]);
const recipeSelected: Ref<Recipe | null> = ref(null);
const recipeType: Ref<string> = ref('all');
const viewRecipes: Ref<Recipe[]> = computed(() =>{
    if(recipeType.value === 'all') {
        return recipes.value
    } else if(recipeType.value === 'entrée') {
        return recipes.value.filter((recipe: Recipe) => recipe.type === "entrée");
    } else if(recipeType.value === 'plat') {
        return recipes.value.filter((recipe: Recipe) => recipe.type === "plat");
    } else if(recipeType.value === 'dessert') {
        return recipes.value.filter((recipe: Recipe) => recipe.type === "dessert");
    } else if(recipeType.value === 'favori') {
        return recipes.value
    }
});
onMounted(async () => {
    api_recipes.getRecipes()
        .then(data => {
            recipes.value = data;
            console.log(recipes.value)
        })
        .catch(err => {
            console.error('Erreur lors de la récupération des menus :', err);
        });
});

function selectRecipe(id) {
    const found = recipes.value.find((recipe: Recipe) => recipe.id === id);
    recipeSelected.value = found ?? null;
}
</script>
