<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img src="/images/logo-secondary.png" alt="logo de ma petite cantine" class="mb-3" style="max-width:150px;">
</template>
