import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";
import router from "../../../routes";

const useCriteriaStore = defineStore("main_criteria", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let criterias = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let criteria = ref({
        id: "",
        year: new Date().getFullYear() - 621,
        number: "",
        description: "",
        attachment: "",
        related_part: "",
    });

    function createCriteria(data) {
        loading.value = true;
        criterias.value.loading = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }

        var form = new FormData();
        form.append("year", data.year);
        form.append("number", data.number);
        form.append("description", data.description);
        form.append("related_part", data.related_part);
        form.append("attachment", attachment);

        data = form;

        axiosClient
            .post("/criteria/create", data)
            .then((res) => {
                loading.value = false;
                criterias.value.loading = false;
                msg_success.value = res.data.message;
                criteria.value.number = "";
                criteria.value.description = "";
                criteria.value.related_part = "";
                criteria.value.attachment = "";
            })
            .catch((err) => {
                loading.value = false;
                criterias.value.loading = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getCriteria({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        criterias.value.loading = true;
        url = url || "/criteria";

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
                criterias.value.loading = false;
                serCriteria(response.data);
            })
            .catch((err) => {
                workshops.value.loading = false;
                console.log(err);
            });
    }

    function serCriteria(data) {
        if (data) {
            criterias.value.data = data.data;
            criterias.value.links = data.meta?.links;
            criterias.value.to = data.meta.to;
            criterias.value.from = data.meta.from;
            criterias.value.current_page = data.meta.current_page;
            criterias.value.total = data.meta.total;
        }
    }
    function editCriteria(id) {
        axiosClient
            .get(`/criteria/edit/${id}`)
            .then((res) => {
                criteria.value = res.data;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.message;
            });
    }

    function updateCriteria(data, id) {
        loading.value = true;
        criterias.value.loading = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("year", data.year);
        form.append("number", data.number);
        form.append("description", data.description);
        form.append("related_part", data.related_part);
        form.append("attachment", attachment);

        data = form;

        axiosClient
            .post("/criteria/update", data)
            .then((res) => {
                loading.value = false;
                criterias.value.loading = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.pdc.workshop.list" });
                criteria.value.number = "";
                criteria.value.description = "";
                criteria.value.related_part = "";
                criteria.value.attachment = "";
            })
            .catch((err) => {
                loading.value = false;
                criterias.value.loading = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteCriteria(id) {
        axiosClient
            .get(`/criteria/delete/${id}`)
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
        getCriteria,
        createCriteria,
        editCriteria,
        updateCriteria,
        deleteCriteria,
        criteria,
        criterias,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useCriteriaStore;
