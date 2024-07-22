import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

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
        page: 10,
        limit: null,
        total: null,
    });
    let lab = ref({
        id: "",
        name: "",
        description: "",
    });

    function createLab(data) {
        loading.value = true;
        axiosClient
            .post("/research_lab/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.statusCode === 200) {
                    lab.value.name = "";
                    lab.value.description = "";
                }
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
    } = {}) {
        labs.value.loading = true;
        url = url || "/research_lab";

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
                labs.value.loading = false;
                setLabs(response.data);
            })
            .catch((err) => {
                labs.value.loading = false;
                console.log(err);
            });
    }

    function setLabs(data) {
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
        axiosClient.get(`/research_lab/edit/${id}`).then((res) => {
            lab.value = res.data;
        });
    }

    // get all the labs
    let all_labs = ref([]);
    function getAllLabs() {
        axiosClient.get("/research_lab/all").then((res) => {
            all_labs.value = res.data;
        });
    }

    // get all the departments
    let listDepartments = ref([]);
    function getAllDepartments() {
        axiosClient.get("/research_lab/department").then((res) => {
            listDepartments.value = res.data;
        });
    }

    function updateLab(data) {
        loading.value = true;
        axiosClient
            .post("/research_lab/update", data)
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

    function deleteLab(id) {
        axiosClient
            .get(`/research_lab/delete/${id}`)
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
        getLab,
        createLab,
        editLab,
        updateLab,
        deleteLab,
        getAllDepartments,
        getAllLabs,
        all_labs,
        listDepartments,
        lab,
        labs,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useLabStore;
