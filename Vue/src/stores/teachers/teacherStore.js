import { defineStore } from "pinia";
import router from "../../routes";
import axiosClient from "../../axios";
import { pushScopeId, ref } from "vue";

export const useTeacherStore = defineStore("teacher", () => {
    let stepOne = ref(false);
    let stepTwo = ref(false);
    let stepThree = ref(false);

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
        code_bast: "",
        lname: "",
        fatherName: "",
        grandFathername: "",
        email: "",
        phone: "",
        gender: "",
        birth_date: "",
        main_address: "",
        current_address: "",
        hire_date: "",
        nic: "",
        education_field: "",
        photo: "",
        photo_path: "",
        academic_rank: "",
        faculty_id: "",
        department_id: "",
        teaching_status: "",
        program_id: "",
        related_part: "",
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
        education_: "",
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
        form.append("code_bast", data.code_bast);
        form.append("lname", data.lname);
        form.append("fatherName", data.fatherName);
        form.append("grandFathername", data.grandFathername);
        form.append("email", data.email);
        form.append("phone", data.phone);
        form.append("gender", data.gender);
        form.append("birth_date", data.birth_date);
        form.append("main_address", data.main_address);
        form.append("current_address", data.current_address);
        form.append("academic_rank", data.academic_rank);
        form.append("nic", data.nic);
        form.append("teaching_status", data.teaching_status);
        form.append("related_part", data.related_part);
        form.append("part", data.part);
        form.append("education_field", data.education_field);
        form.append("photo", data.photo);
        form.append("hire_date", data.hire_date);
        form.append("faculty_id", data.faculty_id);
        form.append("department_id", data.department_id);
        form.append("program_id", data.program_id);

        data = form;
        axiosClient
            .post(`teacher/create`, data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.status == 200) {
                    stepOne.value = true;
                    (teacher.value.name = ""),
                        (teacher.value.code_bast = ""),
                        (teacher.value.lname = ""),
                        (teacher.value.fatherName = ""),
                        (teacher.value.grandFathername = ""),
                        (teacher.value.email = ""),
                        (teacher.value.phone = ""),
                        (teacher.value.gender = ""),
                        (teacher.value.birth_date = ""),
                        (teacher.value.main_address = ""),
                        (teacher.value.current_address = ""),
                        (teacher.value.hire_date = ""),
                        (teacher.value.nic = ""),
                        (teacher.value.education_field = ""),
                        (teacher.value.photo = ""),
                        (teacher.value.photo_path = ""),
                        (teacher.value.academic_rank = ""),
                        (teacher.value.faculty_id = ""),
                        (teacher.value.department_id = ""),
                        (stepOne.value = true);
                    setTimeout(() => {
                        router.push({
                            name: "app.teacher.qualification.create",
                            params: { id: res.data.teacher_id },
                        });
                    }, 1000);
                }
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
                faculties.value = res.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function getDepartments(id = "") {
        axiosClient
            .get(`/get/departments/${id}`)
            .then((res) => {
                console.log(res);
                departments.value = res.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function getTeachers({
        url = null,
        per_page,
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
                    per_page,
                    sortDirection,
                    sortField,
                    department_id,
                },
            })
            .then((response) => {
                console.log(response);
                Teachers.value.loading = false;
                console.log(response.data);
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

    //  get teacher acc department
    const department_teacher = ref([]);
    function getDepartmentTeacher(id) {
        axiosClient
            .get(`/department/teacher/${id}`)
            .then((response) => {
                department_teacher.value = response.data;
            })
            .catch((error) => {
                msg_wrang.value = error.response.data.message;
            });
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
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        } else {
            photo = "";
        }

        let form = new FormData();

        form.append("id", data.id);
        form.append("name", data.name);
        form.append("code_bast", data.code_bast);
        form.append("lname", data.lname);
        form.append("fatherName", data.fatherName);
        form.append("grandFathername", data.grandFathername);
        form.append("email", data.email);
        form.append("phone", data.phone);
        form.append("gender", data.gender);
        form.append("birth_date", data.birth_date);
        form.append("main_address", data.main_address);
        form.append("current_address", data.current_address);
        form.append("academic_rank", data.academic_rank);
        form.append("nic", data.nic);
        form.append("education_field", data.education_field);
        form.append("teaching_status", data.teaching_status);
        form.append("related_part", data.related_part);
        form.append("photo", photo);
        form.append("hire_date", data.hire_date);
        form.append("faculty_id", data.faculty_id);
        form.append("department_id", data.department_id);
        form.append("program_id", data.program_id);

        data = form;
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
            .get("/get/departments")
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
                stepTwo.value = true;
                msg_qsuccess.value = res.data.message;
                teacher_qualification.value.date = "";
                teacher_qualification.value.graduated_year = "";
                teacher_qualification.value.education_ = "";
                teacher_qualification.value.country = "";
                teacher_qualification.value.university = "";
                setTimeout(() => {
                    return router.push({
                        name: "app.teacher.document.create",
                        params: { id: id },
                    });
                }, 1000);
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
                    router.push({
                        name: "app.teacher.details",
                        params: { id: id },
                    });
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
                stepThree.value = true;
                msg_success.value = res.data.message;
                teacher_document.value.date = "";
                teacher_document.value.description = "";
                teacher_document.value.name = "";
                teacher_document.value.publisher = "";
                setTimeout(() => {
                    router.push({ name: "app.teacher.list" });
                }, 1000);
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

    // teacher promotions
    let msg_psuccess = ref("");
    let msg_pwrang = ref("");
    let promotion = ref({
        date: "",
        last_academic_rank: "",
        now_academic_rank: "",
        teacher_id: "",
        attachment: [],
    });
    let promotions = ref({
        data: [],
        links: {},
        to: 0,
        from: 0,
        current_page: 0,
        total: 0,
        loading: false,
    });

    function createPromotion(data, id) {
        loading.value = true;
        // let attachment = "";
        // if (data.attachment instanceof File) {
        //     attachment = data.attachment;
        // } else {
        //     attachment = "";
        // }

        let form = new FormData();
        for (let i = 0; i < data.attachment.length; i++) {
            form.append("attachment[]", data.attachment[i]);
        }
        form.append("date", data.date);
        form.append("last_academic_rank", data.last_academic_rank);
        form.append("now_academic_rank", data.now_academic_rank);
        form.append("teacher_id", id);
        data = form;

        axiosClient
            .post("/teacher/promotion/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
            })
            .catch((err) => {
                loading.value = false;

                msg_wrang.value = err.response.data.message;
            });
    }

    function getPromotions({
        url = null,
        sortField,
        sortDirection,
        search = "",
        id,
    }) {
        promotion.value.loading = false;
        url = url || "/teacher/promotion";
        const params = {
            per_page: 10,
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
                promotions.value.loading = false;
                setPromotion(response.data);
            })
            .catch((error) => {
                promotions.value.loading = false;
                msg_pwrang.value = error.response.data.message;
            });
    }

    function setPromotion(data) {
        if (data) {
            promotions.value.data = data.data;
            promotions.value.links = data.meta?.links;
            promotions.value.to = data.meta.to;
            promotions.value.from = data.meta.from;
            promotions.value.current_page = data.meta.current_page;
            promotions.value.total = data.meta.total;
        }
    }

    function editPromotion(id) {
        axiosClient
            .get(`/teacher/promotion/edit/${id}`)
            .then((response) => {
                promotion.value = response.data;
            })
            .catch((error) => {
                msg_psuccess.value = error.response.data.message;
            });
    }

    function updatePromotion(data, id, t_id) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }
        let form = FormData();
        form.append("date", data.date);
        form.append("last_academic_rank", data.last_academic_rank);
        form.append("now_academic_rank", data.now_academic_rank);
        form.append("teacher_id", data.teacher_id);
        form.append("attachment", attachment);
        data = form;
        axiosClient
            .post(`/teacher/promotion/create/${id}`, promotion.value)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deletePromotion(id) {
        loading.value = true;
        axiosClient
            .get(`/teacher/promotion/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    loading.value = false;
                    msg_psuccess.value = "اطلاعات موفقانه حذف شد";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_pwrang.value = "اطلاعات  حذف نشد دوباره تلا�� نماید";
            });
    }

    return {
        stepOne,
        stepTwo,
        stepThree,

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
        // teacher promotion
        createPromotion,
        getPromotions,
        editPromotion,
        updatePromotion,
        deletePromotion,
        // department teacher
        getDepartmentTeacher,
        department_teacher,

        teacher_articles,
        teacher_document,
        teacher_qualification,
        teacher_literature,
        article,
        literature,
        document,
        qualification,
        promotion,
        promotions,

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
        msg_psuccess,
        msg_pwrang,
    };
});
