<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router, Link } from '@inertiajs/vue3';

// use the defineProps({}) to define the data passed from the controllers to the vue components, so to render them first as vue data before displaying them
const props = defineProps({
    comments:Array,
    user:Object
})

// this function will load the data lazily after a button is clicked

const loadComments = () => {
    router.get(route('show.user', props.user), {}, {
        only: ['comments']
    })
}

</script>

<template>
    <Head :title="user.name">
        <!-- you can then define the meta data to help with seo's inside the components like this. -->
        <meta description="Comments" content="This is a dashboard of the page">
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comments</h2>
        </template>

        <!-- button to reload the comments manually -->
        <div class="py-3 flex justify-center">
            <button class="text-sm text-indigo-700" type="button" v-on:click="loadComments">Load comments</button>
        </div>

        <div class="py-6">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div v-for="comment in comments" :key="comment.id">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="font-semibold" id="name">
                           {{ comment.user.name }}
                        </div>
                        <div class="text-gray-900">{{ comment.body }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
#name{
    color: brown;
}
</style>
