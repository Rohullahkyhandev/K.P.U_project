import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

const useExpDetailStore = defineStore("expDetail", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let expDetails = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 10,
        limit: null,
        total: null,
    });
    let expDetail = ref({
        id: "",
        experiment_name: "",
        related_part: "",
        related_images: "",
        standard_id: "", 
        scope_part: "",
        lab_id: "",
    });

    function createExpDetail(data) {
        loading.value = true;
        axiosClient
            .post("/experiment_detail/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.statusCode === 200) {
                    expDetail.value.experiment_name = "";
                    expDetail.value.related_part = "";
                    expDetail.value.related_images = "";
                    expDetail.value.standard_id = "";
                    expDetail.value.scope_part = "";
                    expDetail.value.lab_id = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getExpDetail({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        expDetails.value.loading = true;
        url = url || "/experiment_detail";

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
                expDetails.value.loading = false;
                setExpDetails(response.data);
            })
            .catch((err) => {
                expDetails.value.loading = false;
                console.log(err);
            });
    }

    function setExpDetails(data) {
        if (data) {
            expDetails.value.data = data.data;
            expDetails.value.links = data.meta?.links;
            expDetails.value.to = data.meta.to;
            expDetails.value.from = data.meta.from;
            expDetails.value.current_page = data.meta.current_page;
            expDetails.value.total = data.meta.total;
        }
    }

    function editExpDetail(id) {
        axiosClient.get(`/experiment_detail/edit/${id}`).then((res) => {
            expDetail.value = res.data;
        });
    }

    function updateExpDetail(data) {
        loading.value = true;
        axiosClient
            .post("/experiment_detail/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                expDetail.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteExpDetail(id) {
        axiosClient
            .get(`/experiment_detail/delete/${id}`)
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
        getExpDetail,
        createExpDetail,
        editExpDetail,
        updateExpDetail,
        deleteExpDetail,
        expDetail,
        expDetails,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useExpDetailStore;
