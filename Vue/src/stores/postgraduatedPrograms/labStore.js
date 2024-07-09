import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useLabStore = defineStore("lab", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let labs = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let lab = ref({
        id: "",
        name: "",
        establishment_date: "",
        experiment: "",
        description: "",
        program_id: "",
    });

    function createLab(data) {
        loading.value = true;
        axiosClient
            .post("/lab/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                lab.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getLab({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
        program_id = "",
    } = {}) {
        labs.value.loading = true;
        url = url || "/lab";

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
                    program_id,
                },
            })
            .then((response) => {
                labs.value.loading = false;
                setLab(response.data);
            })
            .catch((err) => {
                labs.value.loading = false;
                console.log(err);
            });
    }

    function setLab(data) {
        if (data) {
            labs.value.data = data.data;
            labs.value.links = data.meta?.links;
            labs.value.to = data.meta.to;
            labs.value.from = data.meta.from;
            labs.value.current_page = data.meta.current_page;
            labs.value.total = data.meta.total;
        }
    }

    function editLab(id) {
        axiosClient.get(`/lab/edit/${id}`).then((res) => {
            lab.value = res.data;
        });
    }

    function updateLab(data) {
        loading.value = true;
        axiosClient
            .post("/lab/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.post-graduated.lab.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteLab(id) {
        axiosClient
            .get(`/lab/delete/${id}`)
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
        getLab,
        createLab,
        editLab,
        updateLab,
        deleteLab,
        lab,
        labs,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useLabStore;
