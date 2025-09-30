<template>
    <div>
        <div class="flex flex-col border rounded-2xl shadow-lg bg-white p-4">
            <div class="flex items-center w-full mb-5">
                <!-- Icône -->
                <font-awesome-icon icon="comments" class="w-8 h-8 text-gray-600 mr-4" />

                <!-- Texte -->
                <h1 class="font-semibold text-gray-600">Commentaires</h1>

                <!-- Ligne horizontale qui prend tout l'espace restant -->
                <div class="flex-1 border-b-2 border-gray-300 ml-4"></div>
            </div>
            <div class="p-5 border-2 rounded-2xl bg-gray-100">
                <div class="text-primary text-xl font-semibold">La recette est terminée !</div>
                <div class="flex items-center">
                    <div class="text-3xl font-bold mr-5 text-gray-700">Donnez votre avis</div>
                    <font-awesome-icon
                        v-for="i in 5"
                        :key="i"
                        icon="star"
                        size="xl"
                        class="cursor-pointer"
                        :class="i <= (hoverRating || currentRating) ? 'text-primary' : 'text-white'"
                        @mouseenter="hoverRating = i"
                        @mouseleave="hoverRating = 0"
                        @click="currentRating = i"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {ref} from "vue";

const currentRating = ref(0) // note sélectionnée
const hoverRating = ref(0)   // note survolée
</script>

<style scoped>

</style>
