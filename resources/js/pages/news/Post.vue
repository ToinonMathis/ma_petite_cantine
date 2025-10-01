<template>
    <div class="rounded-2xl border bg-white shadow-lg post" v-if="props.post">
        <!-- Header -->
        <div class="p-2 flex items-center gap-2">
            <div class="rounded-full w-7 h-7 bg-primary flex items-center justify-center">
                <font-awesome-icon :icon="['fas','user']" class="text-white text-sm" />
            </div>
            <p class="text-primary font-medium text-sm">{{ props.post.user.name }}</p>
        </div>

        <!-- Image du post -->
        <img
            :src="post.image_url"
            alt="Post Image"
            class="image-post w-full"
        />

        <!-- Actions -->
        <div class="flex gap-3 p-3 text-xl">
            <font-awesome-icon :icon="['far', 'heart']" />
            <font-awesome-icon :icon="['far', 'comment']" />
            <font-awesome-icon :icon="['far', 'paper-plane']" />
        </div>

        <!-- Description & commentaires -->
        <div class="flex flex-col gap-1 p-3 text-sm text-gray-700">
            <p>{{ props.post.content }}</p>

            <!-- Affichage des commentaires -->
            <div v-if="props.post.comments.length">
                <p v-for="comment in props.post.comments" :key="comment.id" class="text-gray-600">
                    <span class="font-medium">{{ comment.user.name }}:</span> {{ comment.content }}
                </p>
            </div>

            <!-- Ajout d'un champ commentaire -->
            <p class="text-gray-400">Ajouter un commentaire...</p>
        </div>
    </div>
</template>

<script lang="ts" setup>
import {computed, defineProps} from 'vue';
import {Post} from "@/types/post";
const props = defineProps<{ post: Post }>();

const post = computed(() => {
    return props.post;
})

</script>

<style scoped>

</style>
