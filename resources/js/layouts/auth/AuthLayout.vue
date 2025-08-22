<template>
    <div id="auth-layout" class="d-flex h-100">
        <!-- Colonne gauche avec logo et texte -->
        <div class="d-flex flex-column align-items-center justify-content-center w-50 p-4 bg-light">
            <img src="/images/logo-secondary.png" alt="logo de ma petite cantine" class="mb-3" style="max-width:150px;">
            <h1 class="fs-4 text-center">
                Avant de faire chauffer les fourneaux, n'oubliez pas de vous identifier
            </h1>
        </div>

        <!-- Colonne droite avec le formulaire (slot pour tes pages de login/register) -->
        <div class="d-flex align-items-center justify-content-center w-50 p-4">
            <slot />
        </div>
    </div>
</template>

<script setup>
</script>

<style scoped>
#auth-layout {
    min-height: 100vh;
}
</style>
