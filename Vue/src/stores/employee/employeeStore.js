import { defineStore } from "pinia";
import { ref } from "vue";
import axiosClient from "../../axios";
import { toast } from "vue3-toastify";
import router from "../../routes";

const notify = (message) => {
    toast.success(message, {
        autoClose: true,
        // delay: 3000,
        rtl: true,
        position: "top-center",
        theme: "colored",
        progress: true,
        style: { "border-radius": "12px" },
        // style,
    }); // ToastOptions
};

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

    const employee = ref({
        name: "",
        lname: "",
        fname: "",
        position: "",
        main_address: "",
        current_address: "",
        hire_date: "",
        salary: "",
        nic: "",
        email: "",
        phone: "",
        date_of_birth: "",
        photo: "",
        remark: "",
        gender: "",
    });

    function createEmployee(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        }

        var form = new FormData();
        form.append("name", data.name);
        form.append("lname", data.lname);
        form.append("fname", data.fname);
        form.append("position", data.position);
        form.append("main_address", data.main_address);
        form.append("current_address", data.current_address);
        form.append("hire_date", data.hire_date);
        form.append("salary", data.salary);
        form.append("nic", data.nic);
        form.append("gender", data.gender);
        form.append("address", data.address);
        form.append("email", data.email);
        form.append("phone", data.phone);
        form.append("date_of_birth", data.date_of_birth);
        form.append("photo", photo);
        data = form;

        axiosClient
            .post("employee/create", data)
            .then((response) => {
                loading.value = false;
                // msg_success.value = response.data.message;
                notify(response.data.message);
                if (response.status == 200) {
                    employee.value.main_address = "";
                    employee.value.name = "";
                    employee.value.lname = "";
                    employee.value.email = "";
                    employee.value.phone = "";
                    employee.value.current_address = "";
                    employee.value.hire_date = "";
                    employee.value.date_of_birth = "";
                    employee.value.nic = "";
                    employee.value.salary = "";
                }
            })
            .catch((error) => {
                loading.value = false;
                msg_wrang.value = error.response.data.message;
            });
    }

    function getEmployee({
        url = null,
        per_page,
        search = "",
        sortDirection,
        sortField,
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
                    url,
                    search,
                    per_page,
                    sortDirection,
                    sortField,
                },
            })
            .then((response) => {
                employees.value.loading = false;
                setEmployee(response.data);
            })
            .catch((err) => {
                employees.value.loading = false;
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

    function editEmployee(id) {
        axiosClient
            .get(`/employee/edit/${id}`)
            .then((response) => {
                employee.value = response.data;
            })
            .catch((error) => {
                msg_wrang.value = error.response.data.message;
            });
    }

    function updateEmployee(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("name", data.name);
        form.append("lname", data.lname);
        form.append("fname", data.fname);
        form.append("position", data.position);
        form.append("main_address", data.main_address);
        form.append("current_address", data.current_address);
        form.append("hire_date", data.hire_date);
        form.append("salary", data.salary);
        form.append("nic", data.nic);
        form.append("gender", data.gender);
        form.append("address", data.address);
        form.append("email", data.email);
        form.append("phone", data.phone);
        form.append("date_of_birth", data.date_of_birth);
        form.append("photo", photo);
        data = form;

        axiosClient
            .post("employee/update", data)
            .then((response) => {
                loading.value = false;
                // msg_success.value = response.data.message;
                notify(response.data.message);
                if (response.status == 200) {
                    employee.value.main_address = "";
                    employee.value.name = "";
                    employee.value.lname = "";
                    employee.value.email = "";
                    employee.value.phone = "";
                    employee.value.current_address = "";
                    employee.value.hire_date = "";
                    employee.value.date_of_birth = "";
                    employee.value.nic = "";
                    employee.value.salary = "";
                    employee.value.education = "";
                    employee.value.remark = "";
                    return router.push({ name: "app.employee.list" });
                }
            })
            .catch((error) => {
                loading.value = false;
                msg_wrang.value = error.response.data.message;
            });
    }

    function deleteEmployee(id) {
        axiosClient
            .get(`employee/delete/${id}`)
            .then((response) => {
                if (response.status === 200) {
                    notify("دیتا موفقانه حذف شد");
                }
            })
            .catch((error) => {
                msg_wrang.value = "دیتا حذف نشد دوباره تلاش نماید ";
            });
    }

    return {
        createEmployee,
        getEmployee,
        editEmployee,
        updateEmployee,
        deleteEmployee,
        employee,
        employees,
        msg_success,
        msg_wrang,
        loading,
    };
});

export default useEmployeeStore;
