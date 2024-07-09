import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";

const useCommitStore = defineStore("postCommit", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let commits = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let commit = ref({
        id: "",
        name: "",
        topic: "",
        date: "",
        description: "",
        attachment: "",
    });

    function createCommit(data) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }

        var form = new FormData();
        form.append("name", data.name);
        form.append("topic", data.topic);
        form.append("date", data.date);
        form.append("description", data.description);
        form.append("attachment", attachment);

        data = form;

        axiosClient
            .post("/pdc/commit/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                commit.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getCommit({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        commits.value.loading = true;
        url = url || "pdc/commit";

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
                commits.value.loading = false;
                setCommit(response.data);
            })
            .catch((err) => {
                commits.value.loading = false;
                console.log(err);
            });
    }

    function setCommit(data) {
        if (data) {
            commits.value.data = data.data;
            commits.value.links = data.meta?.links;
            commits.value.to = data.meta.to;
            commits.value.from = data.meta.from;
            commits.value.current_page = data.meta.current_page;
            commits.value.total = data.meta.total;
        }
    }

    function editCommit(id) {
        axiosClient.get(`/pdc/commit/edit/${id}`).then((res) => {
            commit.value = res.data;
        });
    }

    function updateCommit(data) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("name", data.name);
        form.append("topic", data.topic);
        form.append("date", data.date);
        form.append("description", data.description);
        form.append("attachment", attachment);

        data = form;

        axiosClient
            .post("/pdc/commit/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                commit.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteCommit(id) {
        axiosClient
            .get(`/pdc/commit/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_success.value = "پلان موفقانه حذف شد";
                }
            })
            .catch((err) => {
                msg_wrang.value = "پلان حذف نشد دوباره تلاش نماید";
            });
    }

    return {
        getCommit,
        createCommit,
        editCommit,
        updateCommit,
        deleteCommit,
        commit,
        commits,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useCommitStore;
