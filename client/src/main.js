import { createApp } from 'vue'
import App from './App.vue'
import i18n from '@/plugins/i18n'
import router from '@/router/index'

createApp(App)
    .use(i18n)
    .use(router)
    .mount('#app')