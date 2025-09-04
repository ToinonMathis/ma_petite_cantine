<template>
    <div class="border p-4 rounded-lg hover:shadow-lg">
        <h3 class="font-bold">{{ recipe.title }}</h3>
        <p>Type : {{ recipe.type }}</p>
        <p v-if="recipe.description">{{ recipe.description }}</p>
        <img v-if="recipe.image" :src="recipe.image" alt="Image de la recette" class="mt-2 rounded"/>
    </div>
</template>
<script setup lang="ts">
import {Recipe} from "@/types/menu/recipe";
import {defineProps, withDefaults} from "vue";

interface Props {
    recipe?: Recipe;
}

const props = withDefaults(defineProps<Props>(), {
    recipe: () => ({} as Recipe),
});
</script>
