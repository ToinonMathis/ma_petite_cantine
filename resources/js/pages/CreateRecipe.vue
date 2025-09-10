<template>
    <Head title="Recette" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="m-20">
            <h1 class="text-center">Creation de recette</h1>
            <div class="border rounded-2xl shadow-lg bg-white p-4">
                <h2 class="mb-5">Informations principales</h2>
                <Input
                    label="Titre"
                    type="text"
                    v-model="recipe.title"
                    placeholder="Ma tarte aux fraises"
                />
                <Input
                    label="Description"
                    type="text"
                    v-model="recipe.description"
                    placeholder="Ma tarte aux fraises"
                />
                <Input
                    label="Type"
                    type="select"
                    :options="recipeTypes"
                    v-model="recipe.type"
                    placeholder="Ma tarte aux fraises"
                />
                <Input
                    label="Temps de préparation"
                    type="number"
                    v-model="recipe.preparation_time"
                    placeholder="Ma tarte aux fraises"
                />
                <Input
                    label="Difficulté"
                    type="select"
                    :options="difficulties"
                    v-model="recipe.difficulty"
                    placeholder="Ma tarte aux fraises"
                />
                <Input
                    label="Image"
                    type="file"
                    v-model="recipe.image"
                    placeholder="Ma tarte aux fraises"
                />
            </div>
            <div class="border rounded-2xl shadow-lg bg-white p-4 mt-5 flex flex-col">
                <h2 class="mb-5">Ingrédients</h2>
                <div v-for="(ingredient, index) in recipe.ingredients" :key="index" class="flex gap-10">
                    <Input
                        label="Nom de l'ingrédient"
                        type="text"
                        placeholder="Ma tarte aux fraises"
                        v-model="recipe.ingredients[index].label"
                        class="w-1/2"
                    />
                    <Input
                        label="Quantité"
                        type="text"
                        placeholder="Ma tarte aux fraises"
                        v-model="recipe.ingredients[index].quantity"
                        class="w-1/2"
                    />
                </div>
                <Button
                    text-label="Ajouter un ingrédient"
                    theme="primary"
                    @click="addIngredient"
                    class="ml-auto"
                />
            </div>
            <div class="border rounded-2xl shadow-lg bg-white p-4 mt-5 flex flex-col">
                <h2 class="mb-5">Étapes</h2>
                <div v-for="(step, index) in recipe.steps" :key="index" class="flex gap-10">
                    <Input
                        label="Titre de l'étape"
                        type="text"
                        placeholder="Mélanger les ingrédients"
                        v-model="recipe.steps[index].title"
                        class="w-1/2"
                    />
                    <Input
                        label="Description"
                        type="text"
                        placeholder="Décrire ce qu'il faut faire"
                        v-model="recipe.steps[index].description"
                        class="w-1/2"
                    />
                </div>
                <Button
                    text-label="Ajouter une étape"
                    theme="primary"
                    @click="addStep"
                    class="ml-auto mt-4"
                />
            </div>
            {{ recipe }}
            <div class="flex gap-5 mt-5">
                <Button
                    text-label="Vider les champs"
                    theme="danger"
                    @click="deleteRecipe"
                />
                <Button
                    text-label="Enregistrer"
                    theme="primary"
                    @click="submit"
                />
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Input from "@/components/_custom/Input.vue";
import Button from "@/components/_custom/Button.vue";
import { Head } from '@inertiajs/vue3';
import { BreadcrumbItem } from "@/types/index.js";
import type { Option } from "@/types/option";
import type { RecipeCreate, RecipeIngredientCreate, RecipeStepCreate } from "@/types/menu/recipeCreate";
import { ref, Ref } from "vue";
import {Difficulty, RecipeType} from "@/types/menu/recipe";
import {api_recipes} from "@/api/api_recipes"

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Recette', href: '/recipe' },
];

// Options pour select
const recipeTypes: Option[] = [
    { id: 'entrée', label: 'Entrée' },
    { id: 'plat', label: 'Plat' },
    { id: 'dessert', label: 'Dessert' }
];
const difficulties: Option[] = [
    { id: 'facile', label: 'Facile' },
    { id: 'moyen', label: 'Moyen' },
    { id: 'difficile', label: 'Difficile' }
];

// Initialisation de la recette vide
const recipeEmpty: RecipeCreate = {
    title: '',
    description: '',
    type: '' as RecipeType,
    preparation_time: 0,
    difficulty: '' as Difficulty,
    image: null,
    ingredients: [] as RecipeIngredientCreate[],
    steps: [] as RecipeStepCreate[]
};

const recipe: Ref<RecipeCreate> = ref({ ...recipeEmpty });

// Fonctions pour ajouter ingrédients / étapes
function addIngredient() {
    recipe.value.ingredients.push({ label: '', quantity: '' } as RecipeIngredientCreate);
}
function addStep() {
    recipe.value.steps.push({ step_number: recipe.value.steps.length + 1, description: '', advice: '', duration: null } as RecipeStepCreate);
}
function deleteRecipe() {
    recipe.value = { ...recipeEmpty };
}
async function submit() {
    try {
        await api_recipes.submitRecipe(recipe.value);
        alert('Recette enregistrée !');
    } catch (error) {
        console.error(error);
        alert('Erreur lors de l\'enregistrement.');
    }
}

</script>
