<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WelcomeCard from '@/Components/WelcomeCard.vue';

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <div>
            <WelcomeCard logoUrl="/images/logo.jpg" />
        </div>
    </AuthenticatedLayout>
</template>
