<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-secondary p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <header class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
        </header>
        <div class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
            <main class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
                <div class="flex-1 pb-12 lg:p-20 dark:text-[#EDEDEC] flex flex-col items-center justify-center">
                    <img src="/images/logo-primary.png" alt="logo de ma petite cantine" class="mb-3" style="max-width:400px;">
                    <h1 class="text-3xl font-medium text-center text-primary">Attachez vos tabliers, ça va chauffer ...</h1>
                    <Form method="get" :action="route('login')">
                        <Button type="submit" class="w-full mt-4" :tabindex="1">
                            C'est parti !
                        </Button>
                    </Form>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
