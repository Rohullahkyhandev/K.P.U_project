import { createApp } from "vue";
import { createPinia } from "pinia";
import CKEditor from "@ckeditor/ckeditor5-vue";
import router from "./routes/index.js";

import "./style.css";
import App from "./App.vue";

const pinia = createPinia();
const app = createApp(App);

app.use(CKEditor).use(pinia).use(router).mount("#app");
