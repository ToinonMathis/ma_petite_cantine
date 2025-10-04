<template>
    <div class="rounded-2xl border bg-white shadow-lg post max-w-[400px]" v-if="props.post">
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
            <font-awesome-icon :class="{'text-red-600' : props.post.user_has_liked}" :icon="[props.post.user_has_liked ? 'fas' : 'far', 'heart']" @click="like(props.post.id)"/>
            <font-awesome-icon :icon="['far', 'comment']" @click="showModal = true"/>
            <font-awesome-icon :icon="['far', 'paper-plane']" />
        </div>

        <!-- Description & commentaires -->
        <div class="flex flex-col gap-1 p-3 text-sm text-gray-700">
            <p><b class="text-primary">{{ props.post.title }}</b> - {{ props.post.content }}</p>

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
    <Modal
       id="Test"
       v-model="showModal"
       :closable="true"
       :disableBodyClass="true"
    >
        <template #body>
            <img
                :src="post.image_url"
                alt="Post Image"
                class="w-full h-auto max-w-[50%] max-h-[80vh] object-contain rounded-tl-2xl rounded-bl-2xl"
            />
        </template>
    </Modal>
</template>

<script lang="ts" setup>
import {computed, defineProps, ref} from 'vue';
import {Post} from "@/types/post";
import {api_posts} from "@/api/api_posts";
import Modal from "@/components/_custom/Modal.vue";
const props = defineProps<{ post: Post }>();
const emits = defineEmits(['like']);

const showModal = ref(false);

const post = computed(() => {
    return props.post;
})

function like(postId) {
    if(! props.post.user_has_liked) {
        api_posts.like(postId).then((response) => {
            emits('like', postId)
        });
    } else {
        api_posts.unlike(postId).then((response) => {
            emits('like', postId)
        });
    }
}
</script>

<style scoped>

</style>
