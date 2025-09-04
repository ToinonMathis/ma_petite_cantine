<template>
    <div
        class="relative rounded-[10px] overflow-hidden w-full h-48 bg-cover bg-center p-3 text-white"
        :style="{ backgroundImage: `url(${recipe?.image ?? '/images/recette1.png'})` }"
    >
    <div class="absolute inset-0 bg-black bg-black/25"></div>
        <div class="relative z-10 flex flex-col justify-between h-full">
            <div class="flex justify-end">
                <font-awesome-icon icon="star" class="text-yellow-300 w-5 h-5" />
            </div>
            <div class="text-center">
                <h2 class="text-lg font-bold">{{ props.recipe?.title ?? 'Sans titre' }}</h2>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { type Recipe } from "@/types/menu/recipe";

const props = defineProps<{
    recipe: Recipe | null;
}>();
</script>
<style scoped>

</style>
