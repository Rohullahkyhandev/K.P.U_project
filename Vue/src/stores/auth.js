import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import axiosClient from '../axios'
import router from '../routes'


export const useAuthStore = defineStore('authenticate', () => {

    let user = ref({
        data: {},
        token: sessionStorage.getItem('TOKEN')
    });
    let loading = ref(false);
    let msg_wrang = ref('');
    let msg_success = ref('');


    function login(data) {
        loading.value = true;
        axiosClient.post('/login', data)
            .then(({ data }) => {
                loading.value = false
                setToken(data.token);
                router.push({ name: 'app.dashboard' })
            }).catch((error) => {
                loading.value = false
                msg_wrang.value = error.response.data.message;
            })
    }

    function setToken(token) {
        user.value.token = token;
        if (token) {
            sessionStorage.setItem('TOKEN', token)
        } else {
            sessionStorage.removeItem('TOKEN')
        }
    }

    function getUser() {
        axiosClient.get('/current/user')
            .then(({ data }) => {
                user.value.data = data;
            }).catch((error) => {
                console.log(error);
            })
    }

    function logout() {
        axiosClient.get('/logout')
            .then(() => {
                sessionStorage.removeItem('TOKEN');
                router.push({ name: 'login' })
            }).catch((error) => {
                console.log(error);
            })
    }

    return {
        user,
        loading,
        msg_success,
        msg_wrang,
        login,
        getUser,
        logout,
    }

})
