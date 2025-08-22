<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const name = page.props.name;
const quote = page.props.quote;

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div class="relative hidden h-full flex-col bg-muted p-10 text-white lg:flex dark:border-r items-center justify-center">
            <img src="/images/logo-secondary.png" alt="logo de ma petite cantine" class="mb-3" style="max-width:450px;">
            <h1 class="text-center text-2xl text-secondary"> Avant de faire chauffer les fourneaux, n'oubliez pas de vous identifier</h1>
        </div>
        <div class="lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <div class="flex flex-col space-y-2 text-center">
                    <h1 class="text-3xl font-medium tracking-tight text-primary" v-if="title">{{ title }}</h1>
                    <hr class="border-muted border-2 w-50 mx-auto mt-2" />
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
<style>

</style>
