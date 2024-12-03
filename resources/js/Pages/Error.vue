<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3'

defineProps({
    status: Object
})
</script>

<template>
    <Head :title="status" />
    <GuestLayout>
        <div v-if="status == 419">
            Error: {{ status }} Request timeout, please login again!
        </div>

        <div v-if="status == 404">
            Error: {{ status }} Page not found!
        </div>

        <div v-if="status == 500">
            Error: {{ status }} Network Error!
        </div>

        <!-- and others can follow/ -->
    </GuestLayout>
</template>
