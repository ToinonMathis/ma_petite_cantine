<template>
    <div class="rounded-2xl border bg-white shadow-lg post">
        <div class="p-2">
            <p class="text-primary">Isa</p>
        </div>
        <img
            src="https://www.instantprint.co.uk/umbraco-media/12420/social-media-image-sizes-for-twitterx-2024.png"
            alt=""
            class="image-post"
        />
        <i class="fa-solid fa-heart"></i>
        <div class="flex gap-1 p-3">
            <font-awesome-icon :icon="['far', 'heart']" size="lg" />
            <font-awesome-icon :icon="['far', 'comment']" size="lg" />
            <font-awesome-icon :icon="['far', 'paper-plane']" size="lg" />
        </div>
        <div class="flex flex-col gap-1 p-3">
            <p>Petite description</p>
            <p>Afficher les commentaires</p>
            <p>Ajouter un commentaire...</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post"
}
</script>

<style scoped>

</style>
