<template>
    <!-- Overlay -->
    <transition name="fade">
        <div
            v-if="modelValue"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            @click.self="closable && close()"
        >
            <!-- Conteneur de la modale -->
            <transition name="scale">
                <div
                    v-if="modelValue"
                    class="bg-white rounded-2xl shadow-xl w-full mx-4"
                    style="max-width: 900px;"
                >
                    <!-- Header -->
                    <div v-if="title || $slots.header" class="flex items-center justify-between border-b p-4">
                        <slot name="header">
                            <h3 class="text-lg font-semibold">{{ title }}</h3>
                            <button
                                v-if="closable"
                                @click="close"
                                class="text-gray-400 hover:text-gray-600"
                            >
                                ✕
                            </button>
                        </slot>
                    </div>

                    <!-- Body -->
                    <div :class="{'p-4': !disableBodyClass}">
                        <slot name="body"></slot>
                    </div>

                    <!-- Footer -->
                    <div
                        v-if="$slots.footer"
                        class="flex justify-end gap-2 border-t p-4 bg-gray-50 rounded-b-2xl"
                    >
                        <slot name="footer"></slot>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script setup lang="ts">
const props = defineProps({
    modelValue: { type: Boolean, required: true },
    title: { type: String, default: "" },
    closable: { type: Boolean, default: true },
    disableBodyClass: { type: Boolean, default: false}
});

const emits = defineEmits(["update:modelValue", "hidden"]);

function close() {
    emits("update:modelValue", false);
    setTimeout(() => emits("hidden"), 200); // délai pour la transition
}
</script>

<style>
/* Transition du fond */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Transition d’apparition de la modale */
.scale-enter-active,
.scale-leave-active {
    transition: transform 0.2s ease, opacity 0.2s ease;
}
.scale-enter-from,
.scale-leave-to {
    transform: scale(0.95);
    opacity: 0;
}
</style>
