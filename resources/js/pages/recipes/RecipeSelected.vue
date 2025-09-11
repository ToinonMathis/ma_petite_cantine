<template>
    <div class="border rounded-2xl shadow-lg bg-white">
        <div class="flex justify-between">
            <div class="bg-primary rounded-tr-none rounded-bl-none rounded-[8px] h-10 w-10 flex items-center justify-center cursor-pointer" @click="emits('return')">
                <font-awesome-icon icon="fa-solid fa-arrow-left" class="text-white"/>
            </div>
            <div class="flex gap-10 p-4">
                <div class="flex flex-col items-center">
                    <p class="font-semibold text-primary">Préparation</p>
                    <div class="flex space-x-1 mt-1 justify-center items-center">
                        <font-awesome-icon :icon="['fas','clock']" class="text-primary mr-1" />
                        <span class="text-primary">{{ props.recipe.preparation_time }} min</span>
                    </div>
                </div>
                <div class="flex flex-col items-center">
                    <p class="font-semibold text-primary">Difficulté</p>
                    <div class="flex space-x-1 mt-1 justify-center items-center">
                        <span class="text-primary"></span>
                        <font-awesome-icon
                            v-for="n in difficultyLevel(props.recipe.difficulty)"
                            :key="n"
                            :icon="['fas','fire']"
                            class="text-primary"
                        />
                    </div>
                </div>
            </div>
        </div>
        <h3 class="font-bold text-primary text-center fa-2x">{{ props.recipe.title }}</h3>
        <p class="text-center text-primary" v-if="props.recipe.description">{{ props.recipe.description }}</p>
        <div class="px-4">
            <h4 class="font-semibold text-primary mb-2">Ingrédients : </h4>
            <div class="flex flex-wrap gap-2 mb-10">
                <span
                    v-for="ingredient in props.recipe.ingredients"
                    :key="ingredient.id"
                    class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-medium"
                >
                  {{ ingredient.quantity ? ingredient.quantity + ' ' : '' }}{{ ingredient.label }}
                </span>
            </div>
        </div>
        <div v-for="step in props.recipe.steps" class="mb-4 px-4">
            <h3 class="text-primary font-semibold">ÉTAPE {{ step.step_number }} :</h3>
            <p>{{ step.description }}</p>
        </div>
    </div>
</template>
<script setup lang="ts">
import {Difficulty, Recipe} from "@/types/menu/recipe";
import {defineProps, withDefaults} from "vue";

interface Props {
    recipe?: Recipe;
}

const props = withDefaults(defineProps<Props>(), {
    recipe: () => ({} as Recipe),
});
const emits = defineEmits(["return"]);

function difficultyLevel(difficulty: Difficulty) {
    switch(difficulty) {
        case "facile": return 1;
        case "moyen": return 2;
        case "difficile": return 3;
    }
}

</script>
