import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";
import router from "../../../routes";

const useSubCriteriaStore = defineStore("sub_criteria", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let subCriterias = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let subCriteria = ref({
        id: "",
        criteria_id: "id",
        number: "",
        description: "",
        related_part: "",
        attachment: "",
    });

    function createSubCriteria(data, id) {
        alert(id);
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }

        var form = new FormData();
        form.append("criteria_id", id);
        form.append("number", data.number);
        form.append("description", data.description);
        form.append("related_part", data.related_part);
        form.append("attachment", attachment);

        data = form;

        axiosClient
            .post("/sub_criteria/create", data)
            .then((res) => {
                loading.value = false;
                subCriteria.value.attachment = "";
                msg_success.value = res.data.message;
                subCriteria.value.number = "";
                subCriteria.value.description = "";
                subCriteria.value.related_part = "";
                subCriteria.value.attachment = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getsubCriteria({
        url = null,
        id = "",
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        subCriterias.value.loading = true;
        url = url || "/sub_criteria";

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
                    id,
                },
            })
            .then((response) => {
                subCriterias.value.loading = false;
                setSubCriteria(response.data);
            })
            .catch((err) => {
                subCriterias.value.loading = false;
                console.log(err);
            });
    }

    const criteria = ref({
        id: "",
        number: "",
        year: "",
    });
    function getCriteria(id) {
        axiosClient.get(`/get_criteria/${id}`).then((res) => {
            criteria.value = res.data;
        });
    }

    function setSubCriteria(data) {
        if (data) {
            subCriterias.value.data = data.data;
            subCriterias.value.links = data.meta?.links;
            subCriterias.value.to = data.meta.to;
            subCriterias.value.from = data.meta.from;
            subCriterias.value.current_page = data.meta.current_page;
            subCriterias.value.total = data.meta.total;
        }
    }
    function editSubCriteria(id) {
        axiosClient.get(`/sub_criteria/edit/${id}`).then((res) => {
            subCriteria.value = res.data;
        });
    }

    function updateSubCriteria(data, id) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        } else {
            attachment = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("criteria_id", data.criteria_id);
        form.append("number", data.number);
        form.append("related_part", data.related_part);
        form.append("attachment", attachment);

        data = form;

        axiosClient
            .post("/sub_criteria/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.pdc.workshop.list" });
                subCriteria.value.number = "";
                subCriteria.value.description = "";
                subCriteria.value.related_part = "";
                subCriteria.value.attachment = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteSubCriteria(id) {
        axiosClient
            .get(`/sub_criteria/delete/${id}`)
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
        getsubCriteria,
        createSubCriteria,
        editSubCriteria,
        updateSubCriteria,
        deleteSubCriteria,
        getCriteria,
        criteria,
        subCriteria,
        subCriterias,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useSubCriteriaStore;
