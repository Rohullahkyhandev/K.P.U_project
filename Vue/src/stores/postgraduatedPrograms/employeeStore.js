import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useEmployeeStore = defineStore("employee", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let employees = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let employee = ref({
        id: "",
        name: "",
        lname: "",
        fname: "",
        email: "",
        phone: "",
        nic: "",
        salary: "",
        hire_date: "",
        position: "",
        remark: "",
        fire_date: "",
        program_id: "",
        current_place: "",
        main_place: "",
    });

    function createEmployee(data) {
        loading.value = true;
        axiosClient
            .post("/employee/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                employee.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getEmployee({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
        program_id = "",
    } = {}) {
        employees.value.loading = true;
        url = url || "/employee";

        const params = {
            per_page: 10,
        };

        axiosClient
            .get(url, {
                params: {
                    ...params,
                    search,
                    per_page,
                    sortDirection,
                    sortField,
                    program_id,
                },
            })
            .then((response) => {
                employees.value.loading = false;
                setEmployee(response.data);
            })
            .catch((err) => {
                employees.value.loading = false;
                console.log(err);
            });
    }

    function setEmployee(data) {
        if (data) {
            employees.value.data = data.data;
            employees.value.links = data.meta?.links;
            employees.value.to = data.meta.to;
            employees.value.from = data.meta.from;
            employees.value.current_page = data.meta.current_page;
            employees.value.total = data.meta.total;
        }
    }

    function editLab(id) {
        axiosClient.get(`/employee/edit/${id}`).then((res) => {
            employee.value = res.data;
        });
    }

    function updateEmployee(data) {
        loading.value = true;
        axiosClient
            .post("/employee/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.post-graduated.employee.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteEmployee(id) {
        axiosClient
            .get(`/employee/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_success.value = "اطلاعات موفقانه حذف شد";
                }
            })
            .catch((err) => {
                msg_wrang.value = "اطلاعات حذف نشد دوباره تلاش نماید";
            });
    }

    return {
        getEmployee,
        createEmployee,
        editEmployee,
        updateEmployee,
        deleteEmployee,
        employee,
        employees,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useEmployeeStore;
