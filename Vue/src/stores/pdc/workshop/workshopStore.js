import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";

const useWorkShopStore = defineStore("workshop", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let workshops = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let workshop = ref({
        id: "",
        topic: "",
        start_time: "",
        end_time: "",
        description: "",
        document: "",
    });

    function createWorkshop(data) {
        loading.value = true;
        let document = "";
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = "";
        }

        var form = new FormData();
        form.append("topic", data.topic);
        form.append("start_time", data.start_time);
        form.append("end_time", data.end_time);
        form.append("description", data.description);
        form.append("document", document);

        data = form;

        axiosClient
            .post("/pdc/workshop/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                workshop.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getWorkshop({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        workshops.value.loading = true;
        url = url || "pdc/workshop";

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
                workshops.value.loading = false;
                setWorkshop(response.data);
            })
            .catch((err) => {
                workshops.value.loading = false;
                console.log(err);
            });
    }

    function setWorkshop(data) {
        if (data) {
            workshops.value.data = data.data;
            workshops.value.links = data.meta?.links;
            workshops.value.to = data.meta.to;
            workshops.value.from = data.meta.from;
            workshops.value.current_page = data.meta.current_page;
            workshops.value.total = data.meta.total;
        }
    }

    function editWorkshop(id) {
        axiosClient.get(`/pdc/workshop/edit/${id}`).then((res) => {
            workshop.value = res.data;
        });
    }

    function updateWorkshop(data) {
        loading.value = true;
        let document = "";
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("topic", data.topic);
        form.append("start_time", data.start_time);
        form.append("end_time", data.end_time);
        form.append("description", data.description);
        form.append("document", document);

        data = form;

        axiosClient
            .post("/pdc/workshop/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                workshop.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteWorkshop(id) {
        axiosClient
            .get(`/pdc/workshop/delete/${id}`)
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
        getWorkshop,
        createWorkshop,
        editWorkshop,
        updateWorkshop,
        deleteWorkshop,
        workshop,
        workshops,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useWorkShopStore;
