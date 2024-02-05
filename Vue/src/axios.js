import axios from "axios";
import { useAuthStore } from './stores/auth'
import router from "./routes";


const axiosClient = axios.create({
    baseURL: `http://localhost/NewUnvesityPro/public/api`
})

axiosClient.interceptors.request.use((config) => {
    const authStore = useAuthStore();
    config.headers.Authorization = `Bearer ${authStore.user.token}`
    return config
})

axiosClient.interceptors.response.use(response => {
    return response
}, error => {
    if (error.response.status == 401) {
        router.push({ name: 'login' })
    }
    throw error
})


export default axiosClient;
