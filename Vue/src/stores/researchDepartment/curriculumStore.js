import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

const useCurriculumStore = defineStore("curriculum", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let curriculums = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 10,
        limit: null,
        total: null,
    });
    let curriculum = ref({
        id: "",
        subject_name: "",
        subject_code: "",
        subject_type: "",
        subject_credit: "",
        semester: "",
        departments: [],
    });

    function createCurriculum(data) {
        loading.value = true;
        axiosClient
            .post("/curriculum/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.status == 200) {
                    curriculum.value.subject_name = "";
                    curriculum.value.subject_code = "";
                    curriculum.value.subject_credit = "";
                    curriculum.value.subject_type = "";
                    curriculum.value.departments = "";
                    curriculum.value.semester = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getCurriculum({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        curriculums.value.loading = true;
        url = url || "/curriculum";

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
                curriculums.value.loading = false;
                setCurriculums(response.data);
            })
            .catch((err) => {
                curriculums.value.loading = false;
                console.log(err);
            });
    }

    function setCurriculums(data) {
        if (data) {
            curriculums.value.data = data.data;
            curriculums.value.links = data.meta?.links;
            curriculums.value.to = data.meta.to;
            curriculums.value.from = data.meta.from;
            curriculums.value.current_page = data.meta.current_page;
            curriculums.value.total = data.meta.total;
        }
    }

    function editCurriculum(id) {
        axiosClient.get(`/curriculum/edit/${id}`).then((res) => {
            curriculum.value = res.data;
        });
    }

    // get all the departments
    let listDepartments = ref([]);
    function getAllDepartments() {
        axiosClient.get("/curriculum/department").then((res) => {
            listDepartments.value = res.data;
        });
    }

    function updateCurriculum(data) {
        loading.value = true;
        axiosClient
            .post("/curriculum/update", data)
            .then((res) => {
                if (res.status === 200) {
                    loading.value = false;
                    msg_success.value = res.data.message;
                    router.push({ name: "app.research.curriculum.list" });
                    curriculum.value = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteCurriculum(id) {
        axiosClient
            .get(`/curriculum/delete/${id}`)
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
        getCurriculum,
        createCurriculum,
        editCurriculum,
        updateCurriculum,
        deleteCurriculum,
        getAllDepartments,
        listDepartments,
        curriculum,
        curriculums,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useCurriculumStore;
