import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";
import { cacheRenderInstance } from "vue3-toastify";

const useStudentResearchStore = defineStore("studentResearch", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let studentResearchs = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let studentResearch = ref({
        id: "",
        title: "",
        date: "",
        description: "",
        program_id: "",
        teacher_id: "",
        student_id: "",
        attachment: "",
    });

    function createStudentResearch(data, id) {
        loading.value = true;
        let attachment = null;
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        }
        let form = new FormData();
        form.append("student_id", id);
        form.append("attachment", attachment);
        form.append("title", data.title);
        form.append("description", data.description);
        form.append("date", data.date);
        form.append("program_id", data.program_id);
        form.append("teacher_id", data.teacher_id);
        data = form;
        axiosClient
            .post("/student_research/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                studentResearch.value.title = "";
                studentResearch.value.date = "";
                studentResearch.value.description = "";
                studentResearch.value.program_id = "";
                studentResearch.value.student_id = "";
                studentResearch.value.attachment = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getStudentResearch({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
        year = "",
    } = {}) {
        studentResearchs.value.loading = true;
        url = url || `/student_research`;

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
                    year,
                },
            })
            .then((response) => {
                studentResearchs.value.loading = false;
                setStudentResearch(response.data);
            })
            .catch((err) => {
                studentResearchs.value.loading = false;
                console.log(err);
            });
    }

    function setStudentResearch(data) {
        if (data) {
            studentResearchs.value.data = data.data;
            studentResearchs.value.links = data.meta?.links;
            studentResearchs.value.to = data.meta.to;
            studentResearchs.value.from = data.meta.from;
            studentResearchs.value.current_page = data.meta.current_page;
            studentResearchs.value.total = data.meta.total;
        }
    }

    function editStudentResearch(id) {
        axiosClient.get(`/student_research/edit/${id}`).then((res) => {
            studentResearch.value = res.data;
        });
    }
    // teacher data
    let teachers = ref([]);
    function getTeachers(id) {
        axiosClient
            .get(`/post/teacher/${id}`)
            .then((response) => {
                teachers.value = response.data;
            })
            .catch((error) => {
                msg_wrang.value = error.response.data.message;
            });
    }

    function updateStudentResearch(data, id) {
        loading.value = true;
        let attachment = null;
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        }
        let form = new FormData();
        form.append("id", data.id);
        form.append("attachment", attachment);
        form.append("title", data.title);
        form.append("description", data.description);
        form.append("date", data.date);
        form.append("program_id", data.program_id);
        form.append("teacher_id", data.teacher_id);
        data = form;

        axiosClient
            .get("/student_research/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({
                    name: "app.post-graduated.student.list",
                });
                studentResearch.value.title = "";
                studentResearch.value.date = "";
                studentResearch.value.description = "";
                studentResearch.value.program_id = "";
                studentResearch.value.student_id = "";
                studentResearch.value.attachment = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteStudentResearch(id) {
        axiosClient
            .get(`/student_research/delete/${id}`)
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
        getStudentResearch,
        createStudentResearch,
        editStudentResearch,
        updateStudentResearch,
        deleteStudentResearch,
        getTeachers,
        teachers,
        studentResearch,
        studentResearchs,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useStudentResearchStore;
