<template>
    <Head title="Menu" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="flex flex-wrap justify-center gap-8">
                <img :src="imageMenu" alt="Menu de la semaine">
                <div
                    v-for="dayMenu in weekMenu"
                    :key="dayMenu.id"
                    class="w-full sm:w-[45%] md:w-[40%] lg:w-[25%] flex flex-col rounded-2xl shadow-md p-4 bg-white border hover:shadow-xl transition p-5"
                    :class="isToday(dayMenu.menu_date) ? 'border-blue-500 bg-blue-50' : 'border-gray-200'"
                >
                    <!-- Header du jour -->
                    <h3 class="text-lg font-semibold text-center mb-10 text-primary">
                        {{ formatDate(dayMenu.menu_date) }}
                    </h3>
                    <!-- Contenu -->
                    <div class="flex flex-col text-base divide-y divide-gray-200">
                        <p class="py-2"><span class="font-medium"><font-awesome-icon icon="leaf" class="text-primary" /> Entrée :</span> {{ dayMenu.starter }}</p>
                        <p class="py-2"><span class="font-medium"><font-awesome-icon icon="utensils" class="text-primary" /> Plat :</span> {{ dayMenu.main_course }}</p>
                        <p class="py-2"><span class="font-medium"><font-awesome-icon icon="cheese" class="text-primary" /> Laitier :</span> {{ dayMenu.dairy }}</p>
                        <p class="py-2"><span class="font-medium"><font-awesome-icon icon="cake" class="text-primary" /> Dessert :</span> {{ dayMenu.dessert }}</p>
                    </div>
                </div>
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
