import { defineStore } from "pinia";
import router from "../../routes";
import axiosClient from "../../axios";
import { ref } from "vue";

export const useFacultyStore = defineStore("faculty", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let Faculties = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let faculty = ref({
        id: "",
        director_name: "",
        director_lname: "",
        photo: "",
        name: "",
        date: "",
        description: "",
    });

    let faculty_department = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    // actions
    function createFaculty(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        }

        let formData = new FormData();
        formData.append("photo", photo);
        formData.append("name", data.name);
        formData.append("director_name", data.director_name);
        formData.append("director_lname", data.director_lname);
        formData.append("date", data.date);
        formData.append("description", data.description);
        data = formData;
        axiosClient
            .post("/faculty/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.status === 200) {
                    faculty.value.name = "";
                    faculty.value.director_name = "";
                    faculty.value.director_lname = "";
                    faculty.value.description = "";
                    faculty.value.photo = "";
                    faculty.value.date = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getFaculties({
        url = null,
        per_page,
        search = "",
        sortDirection,
        sortField,
    } = {}) {
        Faculties.value.loading = true;
        url = url || "/faculty";
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
                Faculties.value.loading = false;
                setFaculty(response.data);
            })
            .catch((err) => {
                Faculties.value.loading = false;
                console.log(err);
            });
    }

    function setFaculty(data) {
        if (data) {
            Faculties.value.data = data.data;
            Faculties.value.links = data.meta?.links;
            Faculties.value.to = data.meta.to;
            Faculties.value.from = data.meta.from;
            Faculties.value.current_page = data.meta.current_page;
            Faculties.value.total = data.meta.total;
        }
    }

    function getFaculty(id) {
        axiosClient
            .get(`faculty/details/${id}`)
            .then(({ data }) => {
                faculty.value = data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function getFacultyDepartment({
        url = null,
        per_page,
        search = "",
        sortDirection,
        sortField,
        id,
    } = {}) {
        faculty_department.value.loading = true;
        url = url || "/department";
        const params = {
            per_page: 10,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    url,
                    id,
                    search,
                    per_page,
                    sortDirection,
                    sortField,
                },
            })
            .then((response) => {
                console.log(response);
                faculty_department.value.loading = false;
                setFacultyDepartment(response.data);
            })
            .catch((err) => {
                faculty_department.value.loading = false;
                console.log(err);
            });
    }

    function setFacultyDepartment(data) {
        if (data) {
            faculty_department.value.data = data.data;
            faculty_department.value.links = data.meta?.links;
            faculty_department.value.to = data.meta.to;
            faculty_department.value.from = data.meta.from;
            faculty_department.value.current_page = data.meta.current_page;
            faculty_department.value.total = data.meta.total;
        }
    }

    let listFaculty = ref([]);
    function getAllFaculty() {
        axiosClient
            .get("/get_all_faculty")
            .then((response) => (listFaculty.value = response.data));
    }

    function editFaculty(id) {
        axiosClient
            .get(`/faculty/edit/${id}`)
            .then((res) => {
                faculty.value = res.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function updateFaculty(data, id) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        }

        let formData = new FormData();
        formData.append("id", id);
        formData.append("photo", photo);
        formData.append("name", data.name);
        formData.append("director_name", data.director_name);
        formData.append("director_lname", data.director_lname);
        formData.append("date", data.date);
        formData.append("description", data.description);
        data = formData;
        axiosClient
            .post("/faculty/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.faculty.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteFaculty(id) {
        axiosClient
            .get(`/faculty/delete/${id}`)
            .then((res) => {
                console.log(res);
                if (res.status == 200) {
                    msg_success.value = "موفقانه حذف شد";
                }
            })
            .catch((err) => {
                msg_wrang.value = "فاکولته موفقانه حذف نشد";
            });
    }

    return {
        getAllFaculty,
        getFaculty,
        getFaculties,
        createFaculty,
        getFacultyDepartment,
        faculty_department,
        editFaculty,
        updateFaculty,
        deleteFaculty,
        listFaculty,
        Faculties,
        faculty,
        loading,
        msg_success,
        msg_wrang,
    };
});
