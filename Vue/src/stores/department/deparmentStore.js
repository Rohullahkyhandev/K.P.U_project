import { defineStore } from "pinia";
import router from "../../routes";
import axiosClient from "../../axios";
import { ref } from "vue";

const useDepartmentStore = defineStore("department", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let Departments = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    const department = ref({
        id: "",
        name: "",
        manager_name: "",
        manager_lname: "",
        photo: "",
        date: "",
        description: "",
        faculty_id: "",
    });

    // actions
    function createDepartment(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        }

        let formData = new FormData();
        formData.append("name", data.name);
        formData.append("manager_name", data.manager_name);
        formData.append("manager_lname", data.manager_lname);
        formData.append("photo", photo);
        formData.append("date", data.date);
        formData.append("description", data.description);
        formData.append("faculty_id", data.faculty_id);

        data = formData;

        axiosClient
            .post(`/department/create`, data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.status == 200) {
                    department.value.date = "";
                    department.value.name = "";
                    department.value.description = "";
                    department.value.manager_lname = "";
                    department.value.manager_name = "";
                    department.value.photo = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getDepartments({
        url = null,
        per_page,
        search = "",
        sortDirection,
        sortField,
    } = {}) {
        Departments.value.loading = true;
        url = url || "/department";
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
                console.log(response);
                Departments.value.loading = false;
                setFaculty(response.data);
            })
            .catch((err) => {
                Departments.value.loading = false;
                console.log(err);
            });
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

    // GET DEPARTMENT WITH OUT FACULTY
    let faculty_department = ref([]);
    function getFacultyDepartment(id) {
        console.log(id);
        axiosClient.get(`/get/departments/${id}`).then((response) => {
            faculty_department.value = response.data;
        });
    }

    // GET ALL THE DEPARTMENTS
    let all_department = ref([]);
    function getAllDepartment() {
        axiosClient.get(`/get_all/departments`).then((response) => {
            console.log(response);
            all_department.value = response.data;
        });
    }

    // GET DEPARTMENT WITH OUT FACULTY
    let department_has_out_facilities = ref([]);
    function departmentHasOutFaculties() {
        axiosClient
            .get("/get_departments_with_out_facilities")
            .then((response) => {
                department_has_out_facilities.value = response.data;
            });
    }

    function getDepartment(id) {
        axiosClient
            .get(`department/details/${id}`)
            .then(({ data }) => {
                faculty.value = data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function editDepartment(id) {
        axiosClient.get(`/department/edit/${id}`).then((response) => {
            department.value = response.data;
        });
    }

    function updateDepartment(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        }

        let formData = new FormData();
        formData.append("id", data.id);
        formData.append("name", data.name);
        formData.append("manager_name", data.manager_name);
        formData.append("manager_lname", data.manager_lname);
        formData.append("photo", photo);
        formData.append("date", data.date);
        formData.append("description", data.description);
        formData.append("faculty_id", data.faculty_id);

        data = formData;

        axiosClient
            .post(`/department/update`, data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.department.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteDepartment(id) {
        axiosClient
            .get(`/department/delete/${id}`)
            .then((res) => {
                if (res.status == 200) {
                    msg_success.value = "دیپارتمنت موفقانه حذف شد";
                }
            })
            .catch((err) => {
                msg_wrang.value = "دیپارتمنت موفقانه حذف نشد";
            });
    }

    return {
        // TODO:
        getFacultyDepartment,
        departmentHasOutFaculties,
        faculty_department,
        department_has_out_facilities,
        getAllDepartment,
        all_department,
        // -------
        getDepartments,
        getDepartment,
        createDepartment,
        deleteDepartment,
        editDepartment,
        updateDepartment,
        Departments,
        department,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useDepartmentStore;
