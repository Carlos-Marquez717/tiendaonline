<template>
    <div class="flex items-center min-h-screen p-6 background">
        <div class="flex-1 h-auto max-w-4xl mx-auto overflow-hidden bg-black rounded-lg shadow-xl p-6">
            <slot />
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>


<style>
.background {
    background-image: url('/images/fondo.jpg');

    height: 100vh; /* Asegura que cubra toda la altura de la ventana */
}

</style>
