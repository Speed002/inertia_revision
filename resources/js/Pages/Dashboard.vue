<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// use the defineProps({}) to define the data passed from the controllers to the vue components, so to render them first as vue data before displaying them
defineProps({
    greeting:String
})

</script>

<template>
    <Head title="Dashboard">
        <!-- you can then define the meta data to help with seo's inside the components like this. -->
        <meta description="Dasboard" content="This is a dashboard of the page">
    </Head>


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">{{ greeting }}</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
