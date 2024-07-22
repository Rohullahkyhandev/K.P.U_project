import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

const useTeacherResearchStore = defineStore("teacherResearch", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let teacherResearchs = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 10,
        limit: null,
        total: null,
    });
    let teacherResearch = ref({
        id: "",
        name: "",
        lname: "",
        fname: "",
        academic_rank: "",
        education_degree: "",
        research_title: "",
        faculty_id:"",
        department_id:""
    });

    function createTeacherResearch(data) {
        loading.value = true;
        axiosClient
            .post("/teacher_research/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.statusCode === 200) {
                    teacherResearch.value.name = "";
                    teacherResearch.value.lname = "";
                    teacherResearch.value.fname = "";
                    teacherResearch.value.academic_rank = "";
                    teacherResearch.value.education_degree = "";
                    teacherResearch.value.research_title = "";
                    teacherResearch.value.faculty_id = "";
                    teacherResearch.value.department_id = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getTeacherResearch({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        teacherResearchs.value.loading = true;
        url = url || "/teacher_research";

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
                teacherResearchs.value.loading = false;
                setTeacherResearchs(response.data);
            })
            .catch((err) => {
                teacherResearchs.value.loading = false;
                console.log(err);
            });
    }

    function setTeacherResearchs(data) {
        if (data) {
            teacherResearchs.value.data = data.data;
            teacherResearchs.value.links = data.meta?.links;
            teacherResearchs.value.to = data.meta.to;
            teacherResearchs.value.from = data.meta.from;
            teacherResearchs.value.current_page = data.meta.current_page;
            teacherResearchs.value.total = data.meta.total;
        }
    }

    function editTeacherResearch(id) {
        axiosClient.get(`/teacher_research/edit/${id}`).then((res) => {
            teacherResearch.value = res.data;
        });
    }

    // get all the departments
    let listDepartments = ref([]);
    function getAllDepartments() {
        axiosClient.get("/teacher_research/department").then((res) => {
            listDepartments.value = res.data;
        });
    }

    function updateTeacherResearch(data) {
        loading.value = true;
        axiosClient
            .post("/teacher_research/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                teacherResearch.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteTeacherResearch(id) {
        axiosClient
            .get(`/teacher_research/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_success.value = "دیتا موفقانه حذف شد";
                }
            })
            .catch((err) => {
                msg_wrang.value = "دیتا حذف نشد دوباره تلاش نماید";
            });
    }

    return {
        getTeacherResearch,
        createTeacherResearch,
        editTeacherResearch,
        updateTeacherResearch,
        deleteTeacherResearch,
        getAllDepartments,
        listDepartments,
        teacherResearch,
        teacherResearchs,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useTeacherResearchStore;
