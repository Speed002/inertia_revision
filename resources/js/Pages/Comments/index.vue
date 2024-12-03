<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router, Link, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
// import { watch } from 'vue'; // this watches changes in anything you specify
// use the defineProps({}) to define the data passed from the controllers to the vue components, so to render them first as vue data before displaying them
const props = defineProps({
    comments:Array,
    can:Object
})

// this initiates the form and all the form inputs here are binded by v-model which will call the form name and the fiels (form.fieldname)
// define the form
const page = usePage()
const toast = useToast()
// this data is shared from HandleInertiaRequests.php, this is where data like shopping cart can be shared, number of users can be shared on a social media page like facebook
// remembering state is just a key, anyword can be used there.... there just has to be something, so that the state of the useForm can be used
const postForm = useForm('rememberState', {
    body : ''
})

// a custom function to manage the actions of the postForm
const createPost = () => {
    // you are calling the form you created by its name and you are initiating a function to post that form data
    // post the form
    postForm.post(route('comments.store'), {
        // preserves the page and keeps it from scrolling even after an action has been taken
        preserveScroll:true,
        // if the form data is posted successfully into the routes
        onSuccess: () => {
            // toast($page.props.message)
            // postForm.body = ''
            // or
            postForm.reset()
        }
    })
}

// this is a function that is responsible for refreshing the comments that are displayed... because are using trying to get the comments that are in the database without having to refresh the page
const refreshComments = () => {
    // referesh the comments using the router modal imported from inertia/vuejs module
    // you can also use preserveState to perserve the state of the form incase loading new data that hasnt shown yet
    router.get(route('comments.index'), {}, {
        preserveScroll:true,
        preserveState:true,
        only: ['comments']
    })
}

// the watch function seats outside, and watches the session() for any change and returns the expected value
// watch(()=>page.props.message, (message)=>{
//     // console.log(message)
//     toast(message.body, {type: message.type})
// })


</script>

<template>
    <Head title="Comments">
        <!-- you can then define the meta data to help with seo's inside the components like this. -->
        <meta description="Comments" content="This is a dashboard of the page">
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Dumping the form for more data that the form holds -->
                <!-- {{ postForm }} -->
                <!-- This will intercept the laravel controller return and return to us a value valid for our feedback. -->
                <!-- {{ $page.props.message }} -->
                <form v-on:submit.prevent="createPost" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" v-if="can.create_post">
                    <label for="body" class="sr-only">Body</label>
                    <div class="flex flex-col items-center space-y-4">
                    <!-- <label for="slider" class="text-gray-700">Volume</label> -->
                    <!-- <input v-on:change="console.log(123)" id="slider" type="range" min="0" max="100" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-500 focus:outline-none focus:ring focus:ring-blue-300"/> -->
                    </div>
                    <!-- <br> -->
                    <textarea name="body" id="body" cols="30" rows="5" v-model="postForm.body" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" v-on:focus="postForm.clearErrors()"></textarea>
                    <!-- On focus clear out all the errors: postForm.clearErrors() -->
                    <!-- Displaying the form errors incase there are any -->
                    <div v-if="postForm.errors.body" class="text-sm text-red-500">
                        {{ postForm.errors.body }}
                    </div>
                    <button type="submit"
                    class="mt-2 bg-gray-700 px-4 py-2 rounded-md font-medium text-white"
                    :disabled="postForm.processing"
                    :class="{'opacity-50':postForm.processing}"
                    >Post</button>
                </form>

                <!-- button to reload the comments manually -->
                 <div class="py-3 flex justify-center">
                    <button class="text-sm text-indigo-700" type="button" v-on:click="refreshComments">Referesh comments</button>
                 </div>

                <div v-for="comment in comments" :key="comment.id">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="font-semibold">
                           <Link :href="route('show.user', comment.user.id)">{{ comment.user.name }}</Link>
                        </div>
                        <div class="text-gray-900">{{ comment.body }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
