import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

const useCommitMemberStore = defineStore("commitMember", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let commitMembers = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let commitMember = ref({
        id: "",
        name: "",
        lname: "",
        email: "",
        phone: "",
        address: "",
        commit_id: "",
    });

    function createCommitMember(data) {
        loading.value = true;
        axiosClient
            .post("/post_committee_member/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                commitMember.value.name = "";
                commitMember.value.email = "";
                commitMember.value.address = "";
                commitMember.value.phone = "";
                commitMember.value.commit_id = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    let allCommit = ref([]);
    function getAllCommit() {
        axiosClient
            .get("/get_all_committees")
            .then((response) => {
                allCommit.value = response.data;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.message;
            });
    }

    function getCommitMember({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        commitMembers.value.loading = true;
        url = url || "/post_committee_member";

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
                commitMembers.value.loading = false;
                setCommitMember(response.data);
            })
            .catch((err) => {
                commitMembers.value.loading = false;
                console.log(err);
            });
    }

    function setCommitMember(data) {
        if (data) {
            commitMembers.value.data = data.data;
            commitMembers.value.links = data.meta?.links;
            commitMembers.value.to = data.meta.to;
            commitMembers.value.from = data.meta.from;
            commitMembers.value.current_page = data.meta.current_page;
            commitMembers.value.total = data.meta.total;
        }
    }

    function editCommitMember(id) {
        axiosClient.get(`/post_committee_member/edit/${id}`).then((res) => {
            commitMember.value = res.data;
        });
    }

    function updateCommitMember(data) {
        loading.value = true;
        axiosClient
            .post("/post_committee_member/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                commitMember.value.name = "";
                commitMember.value.email = "";
                commitMember.value.address = "";
                commitMember.value.phone = "";
                commitMember.value.commit_id = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteCommitMember(id) {
        axiosClient
            .get(`/post_committee_member/delete/${id}`)
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
        getCommitMember,
        getAllCommit,
        createCommitMember,
        editCommitMember,
        updateCommitMember,
        deleteCommitMember,
        commitMember,
        commitMembers,
        allCommit,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useCommitMemberStore;
