import { router, usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";


const page = usePage()
const toast = useToast()
// export keyword enables us to ship the plugin in the entire application
// plugins should always be exported
export const notifications = () => {
    // this plugin is initiated on router finish
    router.on('finish', () => {
        // on changing router, there should be some change
        // console.log(123)
        // this holds the session message shared abroad and interacts with inertia to intercept it
        const notification = page.props.message
        if(notification?.body && notification?.type){
            toast(notification.body, {type:notification.type})
        }

    })
}
