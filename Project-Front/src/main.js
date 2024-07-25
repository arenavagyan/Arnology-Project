import './assets/main.css'
import { createApp,ref } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

const localhost = ref('127.0.0.1:8000')
const app = createApp(App)

app.use(router)

app.mount('#app')
app.use(createPinia())

export default localhost