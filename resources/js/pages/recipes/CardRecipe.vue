<template>
    <div class="bg-white rounded-[10px]">
        <div
            class="relative rounded-t-[10px] overflow-hidden w-full h-40 bg-cover bg-center p-3 text-white"
            :style="{ backgroundImage: `url(${recipe?.image ?? '/images/recette1.png'})` }"
        >
            <div class="absolute inset-0 bg-black bg-black/25"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex justify-end">
                    <font-awesome-icon
                        icon="star"
                        size="xl"
                        class="cursor-pointer"
                        :class="props.recipe.favorite ? 'text-yellow-300' : 'text-white'"
                        @click.stop="changeFavorite(props.recipe.id)"
                    />
                </div>
                <div class="text-center">
                    <h2 class="text-lg font-bold">{{ props.recipe?.title ?? 'Sans titre' }}</h2>
                </div>
            </div>
        </div>
        <div class="p-3">
            <h2 class="text-lg font-bold" style="font-family: 'Cinzel',serif;">{{ props.recipe?.title ?? 'Sans titre' }}</h2>
            <p class="text-sm">{{ props.recipe?.description ?? 'Sans titre' }}</p>
        </div>
    </div>
</template>
<script setup lang="ts">
import { type Recipe } from "@/types/menu/recipe";
import {api_recipes} from "@/api/api_recipes";

const props = defineProps<{
    recipe: Recipe | null;
}>();
const emits = defineEmits(['newFav', 'oldFav']);

function changeFavorite(id) {
    if(props.recipe?.favorite) {
        api_recipes.removeFavoriteRecipe(id).then(() => {
            emits("oldFav", id);
        });
    } else {
        api_recipes.addFavoriteRecipe(id).then(() => {
            emits("newFav", id);
        });
    }
}
</script>
<style scoped>

</style>
