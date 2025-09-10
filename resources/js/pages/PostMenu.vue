<template>
    <Head title="Recette" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-lg mx-auto mt-8">
            <div
                v-bind="getRootProps()"
                class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-primary hover:bg-primary/10 transition"
            >
                <input v-bind="getInputProps()" />
                <div class="flex flex-col items-center justify-center space-y-2">
                    <svg
                        v-if="!acceptedFiles.length"
                        class="w-12 h-12 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M4 12l8-8 8 8"/>
                    </svg>
                    <p class="text-gray-600">
                        {{ isDragActive ? "Déposez vos fichiers ici..." : "Glissez-déposez vos fichiers ou cliquez pour sélectionner" }}
                    </p>
                </div>
            </div>

            <!-- Liste des fichiers acceptés -->
            <ul v-if="acceptedFiles.length" class="mt-4 space-y-2">
                <li
                    v-for="file in acceptedFiles"
                    :key="file.name"
                    class="flex items-center justify-between p-2 bg-gray-50 rounded shadow-sm"
                >
                    <span>{{ file.name }}</span>
                    <span class="text-gray-400 text-sm">{{ (file.size / 1024).toFixed(1) }} KB</span>
                </li>
            </ul>

            <!-- Bouton pour ouvrir le sélecteur manuellement -->
            <button
                @click="open"
                class="mt-4 w-full py-2 px-4 bg-primary text-white rounded hover:bg-primary-dark transition"
            >
                Sélectionner un fichier
            </button>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { useDropzone } from 'vue3-dropzone';

function onDrop(acceptedFiles: File[], rejectedFiles: any[]) {
    console.log('Accepted:', acceptedFiles);
    console.log('Rejected:', rejectedFiles);
}

const { getRootProps, getInputProps, acceptedFiles, isDragActive, open } = useDropzone({
    onDrop,
});

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Recette', href: '/recipe' },
];
</script>
