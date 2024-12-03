import './bootstrap';
import '../css/app.css';
import "vue-toastification/dist/index.css";

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Toast from "vue-toastification";
import { notifications } from './plugins/notifications';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// this function initiates the app creation process
createInertiaApp({
    // this function then creates a title for the entire app and defines how that title is supposed to be displayed
    title: (title) => `${title} - ${appName}`,
    // this function then resolves the vue files paths inside Pages/** */.vue to vue components to be rendered as pages
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    // the function then sets up the entire app with its modals and modules defining which imported module will be used in the App
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast)
            .use(notifications)
            .use(ZiggyVue)
            .mount(el);
    },
    // since this function is a main function like int main{} in c, like a class in java, it can the define a progress bar inside the entire app and define how the progress bar should look like.
    progress: {
        color: '#4B5563',
    }
});
