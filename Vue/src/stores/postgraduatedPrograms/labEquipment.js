import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useLabEquipmentStore = defineStore("lab_equipment", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let lab_equipments = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let lab_equipment = ref({
        id: "",
        name: "",
        quantity: "",
        entry_date: "",
        description: "",
        lab_id: "",
    });

    function createEquipment(data) {
        loading.value = true;
        axiosClient
            .post("/lab_equipment/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                lab_equipment.value.name = "";
                lab_equipment.value.description = "";
                lab_equipment.value.entry_date = "";
                lab_equipment.value.quantity = "";
                lab_equipment.value.program_id = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getEquipment({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
        program_id = "",
    } = {}) {
        lab_equipments.value.loading = true;
        url = url || "/lab_equipment";

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
                lab_equipments.value.loading = false;
                setLab(response.data);
            })
            .catch((err) => {
                lab_equipments.value.loading = false;
                console.log(err);
            });
    }

    let listLabs = ref([]);
    function getAllLab() {
        axiosClient.get("get_all_lab").then((response) => {
            listLabs.value = response.data;
        });
    }

    function setLab(data) {
        if (data) {
            lab_equipments.value.data = data.data;
            lab_equipments.value.links = data.meta?.links;
            lab_equipments.value.to = data.meta.to;
            lab_equipments.value.from = data.meta.from;
            lab_equipments.value.current_page = data.meta.current_page;
            lab_equipments.value.total = data.meta.total;
        }
    }

    function editEquipment(id) {
        axiosClient.get(`/lab_equipment/edit/${id}`).then((res) => {
            lab_equipment.value = res.data;
        });
    }

    function updateEquipment(data) {
        loading.value = true;
        axiosClient
            .post("/lab_equipment/update", data)
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

    function deleteEquipment(id) {
        axiosClient
            .get(`/lab_equipment/delete/${id}`)
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
        getAllLab,
        getEquipment,
        createEquipment,
        editEquipment,
        updateEquipment,
        deleteEquipment,
        lab_equipment,
        lab_equipments,
        listLabs,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useLabEquipmentStore;
