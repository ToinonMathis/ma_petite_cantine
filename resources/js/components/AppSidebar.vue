<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import {Link, usePage} from '@inertiajs/vue3';

const page = usePage();

const mainNavItems: NavItem[] = [
    { title: "Menu de la semaine", href: '/menu', icon: 'fa-utensils' },
    { title: "Les recettes d'Isa", href: '/recipes', icon: 'fa-kitchen-set' },
    { title: "Les petites nouvelles", href: '/news', icon: 'fa-newspaper' },
];
const adminNavItems: NavItem[] = [
    { title: "Création de recette", href: '/create-recipe', icon: 'fa-pen-to-square' },
    { title: "Post du menu de la semaine", href: '/post-menu', icon: 'fa-download' },
    { title: "Nouveau Post", href: '/post-create', icon: 'fa-images' },
];

const footerNavItems: NavItem[] = [
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child class="h-50 flex items-center justify-center">
                        <Link :href="route('menu')">
                            <img src="/images/logo-primary.png" alt="logo de ma petite cantine" style="max-height: 100%">
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>
        <SidebarContent v-if="page.props.auth.user.is_admin === 1">
            <NavMain :items="adminNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
