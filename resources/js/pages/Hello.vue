<template>
    <div class="bg-white">
        <h1 class="text-black">Bonjour {{ name }}</h1>
        <template v-for="menu in menus">
            {{ menu.starter }}
        </template>
    </div>
</template>

<script setup>
const props = defineProps({
    name: String,
    menus: {
        type: Array,
        required: true
    }
})
</script>

<style scoped>
</style>
