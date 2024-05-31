import axios from "axios";
import { useAuthStore } from "./stores/auth";
import router from "./routes";

const axiosClient = axios.create({
    // baseURL: `https://chance.kpu-conferences.com/NewUnvesityPro/public/api`
    baseURL: "http://127.0.0.1:8000/api",
});

axiosClient.interceptors.request.use((config) => {
    const authStore = useAuthStore();
    config.headers.Authorization = `Bearer ${authStore.user.token}`;
    return config;
});

axiosClient.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response.status === 401) {
            router.push({ name: "login" });
        }
        throw error;
    }
);

export default axiosClient;
