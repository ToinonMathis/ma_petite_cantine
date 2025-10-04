<template>
    <Head title="Menu" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col rounded-xl overflow-x-auto">
            <div class="flex justify-center items-center">
                <img
                    :src="imageMenu"
                    alt="Menu de la semaine"
                    class="max-h-[85vh] max-w-[90vw] object-contain rounded-2xl shadow-lg"
                />
            </div>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {onMounted, ref, Ref} from "vue";
import {DayMenu} from "@/types/menu/dayMenu";
import * as api from '@/api/api_menus';

const formatDate = (dateStr: string) => {
    return new Date(dateStr).toLocaleDateString("fr-FR", {
        weekday: "short",
        day: "2-digit",
        month: "short"
    });
};
const isToday = (dateStr: string) => {
    const today = new Date().toISOString().split("T")[0];
    return today === dateStr;
};

const api_menu = api.api_menus;
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Menu',
        href: '/menu',
    },
];
const days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];
const weekMenu: Ref<DayMenu | []> = ref([]);
const imageMenu: Ref<string> = ref("");

onMounted(async () => {
    api_menu.getMenus()
        .then(data => {
            imageMenu.value = data;
        })
        .catch(err => {
            console.error('Erreur lors de la récupération des menus :', err);
        });
});
</script>
