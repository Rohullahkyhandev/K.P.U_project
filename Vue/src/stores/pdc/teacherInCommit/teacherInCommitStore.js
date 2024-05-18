import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";

const useTeacherInCommit = defineStore("teacher_in_commit", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let teacher_in_commits = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let teacher_in_commit = ref({
        id: "",
        commit_id: "",
        teacher_id: "",
        attachment: "",
    });

    function createTeacherInCommit(data) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }

        var form = new FormData();
        form.append("teacher_id", data.teacher_id);
        form.append("commit_id", data.commit_id);
        form.append("attachment", attachment);

        data = form;

        axiosClient
            .post("/pdc/teacher_in_commit/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                teacher_in_commit.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getTeacherInCommit({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        teacher_in_commits.value.loading = true;
        url = url || "pdc/teacher_in_commit";

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
                teacher_in_commits.value.loading = false;
                setTeacherInCommit(response.data);
            })
            .catch((err) => {
                teacher_in_commits.value.loading = false;
                console.log(err);
            });
    }

    function setTeacherInCommit(data) {
        if (data) {
            teacher_in_commits.value.data = data.data;
            teacher_in_commits.value.links = data.meta?.links;
            teacher_in_commits.value.to = data.meta.to;
            teacher_in_commits.value.from = data.meta.from;
            teacher_in_commits.value.current_page = data.meta.current_page;
            teacher_in_commits.value.total = data.meta.total;
        }
    }

    function editTeacherInCommit(id) {
        axiosClient.get(`/pdc/teacher_in_commit/edit/${id}`).then((res) => {
            teacher_in_commit.value = res.data;
        });
    }

    function updateTeacherInCommit(data) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("teacher_id", data.teacher_id);
        form.append("commit_id", data.commit_id);
        form.append("attachment", attachment);

        data = form;

        axiosClient
            .post("/pdc/teacher_in_commit/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                teacher_in_commit.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteTeacherInCommit(id) {
        axiosClient
            .get(`/pdc/teacher_in_commit/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_success.value = "اطلاعات  موفقانه حذف شد";
                }
            })
            .catch((err) => {
                msg_wrang.value = "اطلاعات حذف نشد دوباره تلاش نماید";
            });
    }

    // external data;
    let teachers = ref([]);
    function getTeachers() {
        axiosClient
            .get("/pdc/get_teachers")
            .then((response) => {
                teachers.value = response.data;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.message;
            });
    }

    let commits = ref([]);
    function getCommits() {
        axiosClient
            .get("/pdc/get_commits")
            .then((response) => {
                commits.value = response.data;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.message;
            });
    }

    return {
        getCommits,
        getTeachers,
        getTeacherInCommit,
        createTeacherInCommit,
        editTeacherInCommit,
        updateTeacherInCommit,
        deleteTeacherInCommit,
        teacher_in_commit,
        teacher_in_commits,
        teachers,
        commits,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useTeacherInCommit;
