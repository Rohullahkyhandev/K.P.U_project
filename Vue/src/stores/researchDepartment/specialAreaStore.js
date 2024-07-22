import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

const useSpecialAreaStore = defineStore("specialArea", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let specialAreas = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 10,
        limit: null,
        total: null,
    });
    let specialArea = ref({
        id: "",
        related_part: "",
        related_field: "",
    });

    function createSpecialArea(data) {
        loading.value = true;
        axiosClient
            .post("/specialist_area/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.statusCode === 200) {
                    specialArea.value.related_part = "";
                    specialArea.value.related_field = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getSpecialArea({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        specialAreas.value.loading = true;
        url = url || "/specialist_area";

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
                specialAreas.value.loading = false;
                setSpecialAreas(response.data);
            })
            .catch((err) => {
                labs.value.loading = false;
                console.log(err);
            });
    }

    function setSpecialAreas(data) {
        if (data) {
            specialAreas.value.data = data.data;
            specialAreas.value.links = data.meta?.links;
            specialAreas.value.to = data.meta.to;
            specialAreas.value.from = data.meta.from;
            specialAreas.value.current_page = data.meta.current_page;
            specialAreas.value.total = data.meta.total;
        }
    }

    function editSpecialArea(id) {
        axiosClient.get(`/specialist_area/edit/${id}`).then((res) => {
            specialArea.value = res.data;
        });
    }

    function updateSpecialArea(data) {
        loading.value = true;
        axiosClient
            .post("/specialist_area/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                specialArea.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteSpecialArea(id) {
        axiosClient
            .get(`/specialist_area/delete/${id}`)
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
        getSpecialArea,
        createSpecialArea,
        editSpecialArea,
        updateSpecialArea,
        deleteSpecialArea,
        specialArea,
        specialAreas,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useSpecialAreaStore;
