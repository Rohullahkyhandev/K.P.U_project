import { defineStore } from 'pinia'
import router from '../../routes'
import axiosClient from '../../axios'
import { ref } from 'vue';

export const useDepartmentStore = defineStore('department', () => {

    let msg_success = ref('');
    let msg_wrang = ref('');
    let loading = ref(false);
    let Departments = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });

    let department = ref({
        id: '',
        name: '',
        date: '',
        description: '',
    });


    // actions
    function createDepartment(data, id) {
        loading.value = true
        axiosClient.post(`/faculty/department/create/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            });
    }

    function getDepartments({ url = null, per_page, search = '', sortDirection, sortField } = {}) {
        Departments.value.loading = true;
        url = url || '/faculty'
        const params = {
            per_page: 10
        }
        axiosClient.get(url, {
            params: {
                ...params,
                url,
                search,
                per_page,
                sortDirection,
                sortField
            }
        }).then((response) => {
            console.log(response);
            Departments.value.loading = false
            setFaculty(response.data);
        }).catch((err) => {
            Departments.value.loading = false
            console.log(err);
        })
    }

    function setFaculty(data) {
        if (data) {
            Departments.value.data = data.data;
            Departments.value.links = data.meta?.links;
            Departments.value.to = data.meta.to;
            Departments.value.from = data.meta.from;
            Departments.value.current_page = data.meta.current_page;
            Departments.value.total = data.meta.total;
        }
    }


    function getDepartment(id) {
        axiosClient.get(`department/details/${id}`)
            .then(({ data }) => {
                faculty.value = data
            }).catch((err) => {
                console.log(err);
            })
    }


    return {
        getDepartment,
        getDepartment,
        createDepartment,
        Departments,
        department,
        loading,
        msg_success,
        msg_wrang,
    }

})
