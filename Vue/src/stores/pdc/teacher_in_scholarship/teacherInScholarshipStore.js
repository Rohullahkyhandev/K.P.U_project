import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";
import router from "../../../routes";

const useTeacherInScholarship = defineStore("teacher_in_scholarship", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);

    let teacherInScholarships = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let teacherInScholarship = ref({
        id: "",
        country_name: "",
        edu_degree: "",
        edu_maqta: "",
        sent_date: "",
        back_date: "",
        document: "",
        teacher_id: "",
        faculty_id: "",
        department_id: "",
    });

    let teacher_department = ref([]);
    function getTeacher(id) {
        axiosClient
            .get(`/pdc/get_teacher/${id}`)
            .then((res) => {
                teacher_department.value = res.data;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.message;
            });
    }

    function updateTeacherinfo(data) {
        loading.value = true;
        axiosClient
            .post("/pdc/teacher_in_scholarship/update_info", data)
            .then((response) => {
                loading.value = false;
                msg_success.value = response.data.message;
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function createTeacherInScholarship(data) {
        loading.value = true;
        let document = "";
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = "";
        }
        var form = new FormData();
        form.append("teacher_id", data.teacher_id);
        form.append("faculty_id", data.faculty_id);
        form.append("department_id", data.department_id);
        form.append("country_name", data.country_name);
        form.append("edu_degree", data.edu_degree);
        form.append("edu_maqta", data.edu_maqta);
        form.append("sent_date", data.sent_date);
        form.append("back_date", data.back_date);
        form.append("document", document);
        data = form;

        axiosClient
            .post("/pdc/teacher_in_scholarship/create", data)
            .then((res) => {
                console.log(res);
                loading.value = false;
                msg_success.value = res.data.message;
                teacherInScholarship.value.teacher_id = "";
                teacherInScholarship.value.back_date = "";
                teacherInScholarship.value.sent_date = "";
                teacherInScholarship.value.department_id = "";
                teacherInScholarship.value.country_name = "";
                teacherInScholarship.value.document = "";
                teacherInScholarship.value.edu_degree = "";
                teacherInScholarship.value.edu_maqta = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getTeacherInScholarship({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        teacherInScholarships.value.loading = true;
        url = url || "/pdc/teacher_in_scholarship";

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
                },
            })
            .then((response) => {
                console.log(response.data);
                teacherInScholarships.value.loading = false;
                setTeacherInScholarship(response.data);
            })
            .catch((err) => {
                teacherInScholarships.value.loading = false;
                console.log(err);
            });
    }

    function setTeacherInScholarship(data) {
        if (data) {
            teacherInScholarships.value.data = data.data;
            teacherInScholarships.value.links = data.meta?.links;
            teacherInScholarships.value.to = data.meta.to;
            teacherInScholarships.value.from = data.meta.from;
            teacherInScholarships.value.current_page = data.meta.current_page;
            teacherInScholarships.value.total = data.meta.total;
        }
    }

    function editTeacherInScholarship(id) {
        axiosClient
            .get(`/pdc/teacher_in_scholarship/edit/${id}`)
            .then((res) => {
                teacherInScholarship.value = res.data;
            });
    }

    function updateTeacherInScholarship(data, id) {
        loading.value = true;
        let document = "";
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("country_name", data.country_name);
        form.append("edu_degree", data.edu_degree);
        form.append("edu_maqta", data.edu_maqta);
        form.append("sent_date", data.sent_date);
        form.append("back_date", data.back_date);
        form.append("country_name", data.country_name);
        form.append("country_name", data.country_name);
        form.append("teacher_id", data.teacher_id);
        form.append("department_id", data.department_id);
        form.append("faculty_id", data.faculty_id);
        form.append("document", document);

        data = form;

        axiosClient
            .post("/pdc/teacher_in_scholarship/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.pdc.teacher_in_scholarship.list" });

                teacherInWorkshop.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteTeacherInScholarship(id) {
        axiosClient
            .get(`/pdc/teacher_in_scholarship/delete/${id}`)
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
        getTeacher,
        createTeacherInScholarship,
        getTeacherInScholarship,
        editTeacherInScholarship,
        updateTeacherInScholarship,
        deleteTeacherInScholarship,
        getTeacherInScholarship,
        updateTeacherinfo,
        teacher_department,
        teacherInScholarship,
        teacherInScholarships,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useTeacherInScholarship;
