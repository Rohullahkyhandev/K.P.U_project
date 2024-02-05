import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './routes/index.js'

import './style.css'
import App from './App.vue'

const pinia = createPinia();

createApp(App)
    .use(pinia)
    .use(router)
    .mount('#app')