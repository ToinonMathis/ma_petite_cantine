<template>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
        <div class="flex flex-wrap -m-2">
            <template v-for="recipe in recipes" :key="recipe.id">
                <div class="p-2 w-1/1 sm:w-1/2 md:w-1/3 lg:w-1/4" @click="selectRecipe(recipe.id)">
                    <CardRecipe
                        :recipe="recipe"
                    />
                </div>
            </template>
        </div>
    </div>
</template>
<script setup lang="ts">
import { defineProps, withDefaults, computed } from "vue";
import { Recipe } from "@/types/menu/recipe";
import CardRecipe from "@/pages/recipes/CardRecipe.vue";

interface Props {
    recipes?: Recipe[];
}

const props = withDefaults(defineProps<Props>(), {
    recipes: () => [] as Recipe[],
});
const emits = defineEmits( ['selectRecipe'])

const viewRecipes = computed(() => props.recipes);

function selectRecipe(id: number) {
    emits('selectRecipe', id);
}
</script>

