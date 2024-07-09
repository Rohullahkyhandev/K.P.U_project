import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "./routes/index.js";
import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import "vue3-toastify/dist/index.css";
import "./style.css";
import "primeicons/primeicons.css";
import App from "./App.vue";

const pinia = createPinia();
const app = createApp(App);
app.use(PrimeVue, {
    theme: {
        preset: Aura,
        options: {
            cssLayer: {
                name: "primevue",
                order: "tailwind-base, primevue, tailwind-utilities",
            },
        },
    },
})
    .use(pinia)
    .use(router)
    .mount("#app");
