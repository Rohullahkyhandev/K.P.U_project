import { defineStore } from "pinia";
import router from "../../routes";
import axiosClient from "../../axios";
import { pushScopeId, ref } from "vue";

export const useTeacherStore = defineStore("teacher", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let msg_dsuccess = ref("");
    let msg_dwrang = ref("");
    let msg_qsuccess = ref("");
    let msg_qwrang = ref("");
    let msg_asuccess = ref("");
    let msg_awrang = ref("");
    let msg_lsuccess = ref("");
    let msg_lwrang = ref("");
    let loading = ref(false);

    let Teachers = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let teacher_articles = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let teacher_document = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let teacher_qualification = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let teacher_literature = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let teacher = ref({
        id: "",
        name: "",
        lname: "",
        fatherName: "",
        email: "",
        phone: "",
        gender: "",
        birth_date: "",
        main_address: "",
        current_address: "",
        hire_date: "",
        nic: "",
        photo: "",
        photo_path: "",
        academic_rank: "",
        faculty_id: "",
        department_id: "",
    });

    // teacher document
    let document = ref({
        id: "",
        type: "",
        document: "",
        description: "",
        attachment_path: "",
    });

    // teacher qualification
    let qualification = ref({
        id: "",
        education_degree: "",
        graduated_year: "",
        university: "",
        country: "",
        description: "",
    });

    // teacher articles
    let article = ref({
        id: "",
        date: "",
        title: "",
        description: "",
        publisher: "",
    });

    // teacher literature
    let literature = ref({
        id: "",
        name: "",
        date: "",
        description: "",
        publisher: "",
    });

    let faculties = ref([]);
    let departments = ref([]);

    // actions
    function createTeacher(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        } else {
            photo = "";
        }

        let form = new FormData();

        form.append("name", data.name);
        form.append("lname", data.lname);
        form.append("fatherName", data.fatherName);
        form.append("email", data.email);
        form.append("phone", data.phone);
        form.append("gender", data.gender);
        form.append("birth_date", data.birth_date);
        form.append("main_address", data.main_address);
        form.append("current_address", data.current_address);
        form.append("academic_rank", data.academic_rank);
        form.append("nic", data.nic);
        form.append("photo", data.photo);
        form.append("hire_date", data.hire_date);
        form.append("faculty_id", data.faculty_id);
        form.append("department_id", data.department_id);

        data = form;
        axiosClient
            .post(`teacher/create`, data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getFaculties() {
        axiosClient
            .get("/get/faculties")
            .then((res) => {
                console.log(res);
                faculties.value = res.data.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function getDepartments(id) {
        axiosClient
            .get(`/get/departments/${id}`)
            .then((res) => {
                console.log(res);
                departments.value = res.data.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function getTeachers({
        url = null,
        perPage,
        search = "",
        sortDirection,
        sortField,
        department_id,
    } = {}) {
        Teachers.value.loading = true;
        url = url || "/teacher";
        const params = {
            perPage: 10,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    url,
                    search,
                    perPage,
                    sortDirection,
                    sortField,
                    department_id,
                },
            })
            .then((response) => {
                console.log(response);
                Teachers.value.loading = false;
                setTeacher(response.data);
            })
            .catch((err) => {
                Teachers.value.loading = false;
                console.log(err);
            });
    }

    function setTeacher(data) {
        if (data) {
            Teachers.value.data = data.data;
            Teachers.value.links = data.meta?.links;
            Teachers.value.to = data.meta.to;
            Teachers.value.from = data.meta.from;
            Teachers.value.current_page = data.meta.current_page;
            Teachers.value.total = data.meta.total;
        }
    }

    function getTeacherDetails(id) {
        axiosClient
            .get(`teacher/details/${id}`)
            .then(({ data }) => {
                teacher.value = data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function editTeacher(id) {
        axiosClient
            .get(`/teacher/edit/${id}`)
            .then((res) => {
                teacher.value = res.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function updateTeacher(data) {
        loading.value = true;
        axiosClient
            .post("/teacher/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.teacher.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteTeacher(id) {
        loading.value = true;
        axiosClient
            .get(`/teacher/delete/${id}`)
            .then((res) => {
                loading.value = false;
                if (res.status == 200) {
                    msg_success.value = " اطلاعات موفقانه حذف شد";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = ".اطلاعات  حذف نشد دوباره تلاش نماید";
            });
    }

    // get teacher according to the department
    let listDepartment = ref([]);
    function getAllDepartments() {
        axiosClient
            .get("/get_all_departments")
            .then((response) => {
                if (response.status == 200) {
                    listDepartment.value = response.data;
                }
            })
            .catch((err) => {
                console.log(err.message);
            });
    }

    //  teacher qualification, article, literature

    function createQualification(data, id) {
        loading.value = true;
        axiosClient
            .post(`/teacher/qualification/create/${id}`, data)
            .then((res) => {
                loading.value = false;
                msg_qsuccess.value = res.data.message;
                teacher_qualification.value.date = "";
                teacher_qualification.value.graduated_year = "";
                teacher_qualification.value.education_degree = "";
                teacher_qualification.value.country = "";
                teacher_qualification.value.university = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_qwrang.value = err.response.data.message;
            });
        // axiosClient.post(`‍‍‍‍‍‍‍‍‍‍‍‍‍‍/teacher/qualification/create/${id}`, data)
        //
    }

    function getQualification({
        search = "",
        per_page,
        url = null,
        sortDirection,
        sortField,
        id,
    } = {}) {
        teacher_qualification.value.loading = true;
        url = url || "/teacher/qualification";
        const params = {
            per_page: per_page,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    url,
                    search,
                    sortDirection,
                    sortField,
                    per_page,
                    id,
                },
            })
            .then((response) => {
                teacher_qualification.value.loading = false;
                setQualification(response.data);
            })
            .catch((err) => {
                teacher_qualification.value.loading = false;
                console.log(err.message);
            });
    }

    function setQualification(data) {
        if (data) {
            teacher_qualification.value.data = data.data;
            teacher_qualification.value.links = data.meta?.links;
            teacher_qualification.value.to = data.meta.to;
            teacher_qualification.value.from = data.meta.from;
            teacher_qualification.value.current_page = data.meta.current_page;
            teacher_qualification.value.total =
                data.meta.toleteacher_literature;
        }
    }

    function editQualification(id) {
        axiosClient
            .get(`/teacher/qualification/edit/${id}`)
            .then((response) => {
                qualification.value = response.data;
            })
            .catch((error) => {
                msg_qwrang.value = error.response.data.message;
            });
    }

    function updateQualification(data, id, t_id) {
        loading.value = true;
        axiosClient
            .post(`/teacher/qualification/update/${id}`, data)
            .then((res) => {
                loading.value = false;
                router.push({
                    name: "app.teacher.details",
                    params: { id: t_id },
                });
                msg_qsuccess.value = res.data.message;
            })
            .catch((err) => {
                msg_qwrang = err.response.data.message;
            });
    }

    function deleteQualification(id) {
        loading.value = true;
        axiosClient
            .get(`/teacher/qualification/delete/${id}`)
            .then((res) => {
                loading.value = false;
                if (res.status === 200) {
                    msg_qsuccess.value = "در خواست حذف شد";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_qwrang.value = "در خواست حذف نشد دوباره تلاش نماید";
            });
    }

    //  teacher article,
    function createArticle(data, id) {
        alert(id);
        loading.value = true;
        axiosClient
            .post(`/teacher/article/create/${id}`, data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                teacher_articles.value.date = "";
                teacher_articles.value.description = "";
                teacher_articles.value.title = "";
                teacher_articles.value.publisher = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getArticle({
        search = "",
        per_page,
        url = null,
        sortDirection,
        sortField,
        id,
    } = {}) {
        teacher_articles.value.loading = true;
        url = url || "/teacher/article";
        const params = {
            per_page: per_page,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    url,
                    search,
                    sortDirection,
                    sortField,
                    per_page,
                    id,
                },
            })
            .then((response) => {
                teacher_articles.value.loading = false;
                setArticle(response.data);
            })
            .catch((err) => {
                teacher_articles.value.loading = false;
                console.log(err.message);
            });
    }

    function setArticle(data) {
        if (data) {
            teacher_articles.value.data = data.data;
            teacher_articles.value.links = data.meta?.links;
            teacher_articles.value.to = data.meta.to;
            teacher_articles.value.from = data.meta.from;
            teacher_articles.value.current_page = data.meta.current_page;
            teacher_articles.value.total = data.meta.toleteacher_literature;
        }
    }

    function editArticle(id) {
        axiosClient
            .get(`/teacher/article/edit/${id}`)
            .then((response) => {
                article.value = response.data;
            })
            .catch((error) => {
                console.log(error.message);
            });
    }

    function updateArticle(data, id, a_id) {
        loading.value = true;
        axiosClient
            .post(`/teacher/article/update/${id}`, data)
            .then((res) => {
                loading.value = false;
                router.push({
                    name: "app.teacher.details",
                    params: { id: a_id },
                });
                msg_asuccess.value = res.data.message;
            })
            .catch((err) => {
                loading.value = false;
                msg_awrang.value = err.response.data.message;
            });
    }

    function deleteArticle(id) {
        axiosClient
            .get(`/teacher/article/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_asuccess.value = "در خواست حذف شد";
                }
            })
            .catch((err) => {
                msg_awrang.value = "در خواست حذف نشد دوباره تلاش نماید";
            });
    }

    //  teacher literature,

    function createLiterature(data, id) {
        loading.value = true;
        axiosClient
            .post(`/teacher/literature/create/${id}`, data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                teacher_literature.value.date = "";
                teacher_literature.value.description = "";
                teacher_literature.value.name = "";
                teacher_literature.value.publisher = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getLiterature({
        search = "",
        per_page,
        url = null,
        sortDirection,
        sortField,
        id,
    } = {}) {
        teacher_literature.value.loading = true;
        url = url || "/teacher/literature";
        const params = {
            per_page: per_page,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    url,
                    search,
                    sortDirection,
                    sortField,
                    per_page,
                    id,
                },
            })
            .then((response) => {
                teacher_literature.value.loading = false;
                setLiterature(response.data);
            })
            .catch((err) => {
                teacher_literature.value.loading = false;
                console.log(err.message);
            });
    }

    function setLiterature(data) {
        if (data) {
            teacher_literature.value.data = data.data;
            teacher_literature.value.links = data.meta?.links;
            teacher_literature.value.to = data.meta.to;
            teacher_literature.value.from = data.meta.from;
            teacher_literature.value.current_page = data.meta.current_page;
            teacher_literature.value.total = data.meta.toleteacher_literature;
        }
    }

    function editLiterature(id) {
        axiosClient
            .get(`/teacher/literature/edit/${id}`)
            .then((response) => {
                literature.value = response.data;
            })
            .catch((error) => {
                console.log(error.message);
            });
    }

    function updateLiterature(data, id, t_id) {
        loading.value = true;
        axiosClient
            .post(`/teacher/literature/update/${id}`, data)
            .then((res) => {
                loading.value = false;
                router.push({
                    name: "app.teacher.details",
                    params: { id: t_id },
                });
                msg_lsuccess.value = res.data.message;
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteLiterature(id) {
        axiosClient
            .get(`/teacher/literature/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_lsuccess.value = "در خواست حذف شد";
                }
            })
            .catch((err) => {
                msg_awrang.value = "در خواست حذف نشد دوباره تلاش نماید";
            });
    }

    //  teacher document,
    function createDocument(data, id) {
        let document = "";
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = "";
        }

        var form = new FormData();

        form.append("type", data.type);
        form.append("document", data.document);
        form.append("description", data.description);

        data = form;
        loading.value = true;
        axiosClient
            .post(`/teacher/document/create/${id}`, data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                teacher_document.value.date = "";
                teacher_document.value.description = "";
                teacher_document.value.name = "";
                teacher_document.value.publisher = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getDocument({
        search = "",
        per_page,
        url = null,
        sortDirection,
        sortField,
        id,
    } = {}) {
        teacher_document.value.loading = true;
        url = url || "/teacher/document";
        const params = {
            per_page: per_page,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    url,
                    search,
                    sortDirection,
                    sortField,
                    per_page,
                    id,
                },
            })
            .then((response) => {
                teacher_document.value.loading = false;
                setDocument(response.data);
            })
            .catch((err) => {
                teacher_literature.value.loading = false;
                console.log(err.message);
            });
    }

    function setDocument(data) {
        if (data) {
            teacher_document.value.data = data.data;
            teacher_document.value.links = data.meta?.links;
            teacher_document.value.to = data.meta.to;
            teacher_document.value.from = data.meta.from;
            teacher_document.value.current_page = data.meta.current_page;
            teacher_document.value.total = data.meta.total;
        }
    }

    function editDocument(id) {
        axiosClient
            .get(`/teacher/document/edit/${id}`)
            .then((response) => {
                document.value = response.data;
            })
            .catch((error) => {
                msg_dsuccess.value = error.response.data.message;
            });
    }

    function updateDocument(data, id, t_id) {
        loading.value = true;
        let document = "";
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = "";
        }

        var form = new FormData();

        form.append("type", data.type);
        form.append("document", document);
        form.append("description", data.description);
        data = form;

        axiosClient
            .post(`/teacher/document/update/${id}`, data)
            .then((res) => {
                console.log(res);
                loading.value = false;
                msg_dsuccess.value = res.data.message;
                router.push({
                    name: "app.teacher.details",
                    params: { id: t_id },
                });
            })
            .catch((err) => {
                msg_dwrang = err.response.data.message;
            });
    }

    function deleteDocument(id) {
        loading.value = true;
        axiosClient
            .get(`/teacher/document/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    loading.value = false;
                    msg_dsuccess.value = "اطلاعات موفقانه حذف شد";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_dwrang.value = "اطلاعات  حذف نشد دوباره تلاش نماید";
            });
    }

    return {
        getAllDepartments,
        getTeachers,
        getFaculties,
        createTeacher,
        getTeacherDetails,
        // getFacultyDepartment,
        getFaculties,
        getDepartments,
        editTeacher,
        updateTeacher,
        deleteTeacher,
        faculties,
        departments,
        listDepartment,
        Teachers,
        teacher,
        // teacher qualification
        createQualification,
        getQualification,
        deleteQualification,
        updateQualification,
        editQualification,
        // teacher article
        createArticle,
        updateArticle,
        getArticle,
        editArticle,
        deleteArticle,
        // teacher literature
        createLiterature,
        updateLiterature,
        editLiterature,
        getLiterature,
        deleteLiterature,

        // teacher document
        createDocument,
        getDocument,
        editDocument,
        updateDocument,
        deleteDocument,

        teacher_articles,
        teacher_document,
        teacher_qualification,
        teacher_literature,
        article,
        literature,
        document,
        qualification,

        // common ref
        loading,
        msg_success,
        msg_wrang,
        msg_dsuccess,
        msg_dwrang,
        msg_asuccess,
        msg_awrang,
        msg_lsuccess,
        msg_lwrang,
        msg_qsuccess,
        msg_qwrang,
    };
});
