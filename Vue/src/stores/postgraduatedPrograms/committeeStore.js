import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

const useCommitStore = defineStore("post/commit", () => {
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
        director: "",
        faculty: "",
        metting_place: "",
        secretary_phone: "",
        secretary: "",
        metting_place_per_month: "",
        director_phone: "",
        attachment: "",
    });

    function createCommit(data) {
        loading.value = true;
        axiosClient
            .post("/post_committee/create", data)
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
        url = url || "/post_committee";

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
        axiosClient.get(`/post_committee/edit/${id}`).then((res) => {
            commit.value = res.data;
        });
    }

    function updateCommit(data) {
        loading.value = true;
        axiosClient
            .post("/post_committee/update", data)
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
            .get(`/post_committee/delete/${id}`)
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
