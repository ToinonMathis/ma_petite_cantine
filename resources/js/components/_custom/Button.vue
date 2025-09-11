<template>
    <button
        :class="classes"
        :disabled="disable || loading"
    >
        <!-- Icône si on en a une -->
        <span v-if="iconLabel && !loading" class="material-icons">
          {{ iconLabel }}
        </span>

        <!-- Loader si loading -->
        <LoaderCircle
            v-if="loading"
            class="w-5 h-5 animate-spin"
        />

        <!-- Texte -->
        <span>{{ textLabel }}</span>
    </button>
</template>
<script setup lang="ts">
import { computed, defineProps } from 'vue'
import { LoaderCircle } from 'lucide-vue-next' // icône de chargement par ex.

type Theme = 'primary' | 'primaryOutline' | 'grayLight' | 'secondary' | 'danger' | 'outline'

interface Props {
    theme?: Theme
    textLabel?: string
    iconLabel?: string // nom de l'icône (facultatif si tu gères un set d’icônes)
    disable?: boolean
    loading?: boolean
}

const props = withDefaults(defineProps<Props>(), {
    theme: 'primary',
    textLabel: '',
    iconLabel: '',
    disable: false,
    loading: false
})

// classes dynamiques
const classes = computed(() => {
    const base = 'inline-flex items-center gap-2 rounded-xl px-4 py-2 font-medium transition disabled:opacity-50 disabled:cursor-not-allowed'
    const variants: Record<Theme, string> = {
        primary: 'bg-primary text-white custom-button',
        primaryOutline:'border border-primary text-primary custom-button',
        grayLight: 'bg-gray-300 text-black hover:bg-gray-400 custom-button',
        secondary: 'bg-secondary text-white hover:bg-secondary custom-button',
        danger: 'bg-red-600 text-white hover:bg-red-700 custom-button',
        outline: 'border border-gray-400 text-gray-700 hover:bg-gray-100 custom-button'
    }
    return `${base} ${variants[props.theme]}`
})
</script>
<style scoped>

</style>
