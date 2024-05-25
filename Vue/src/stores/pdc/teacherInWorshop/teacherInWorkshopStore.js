import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";
import router from "../../../routes";

const useTeacherInWorkshop = defineStore("teacher_in_workshop", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let teacherInWorkshops = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let teacherInWorkshop = ref({
        id: "",
        teacher_id: "",
        workshop_id: "",
        document: "",
    });

    function createTeacherInWorkshop(data) {
        loading.value = true;
        let document = "";
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = "";
        }

        var form = new FormData();
        form.append("teacher_id", data.teacher_id);
        form.append("workshop_id", data.workshop_id);
        form.append("document", document);

        data = form;

        axiosClient
            .post("/pdc/teacher_in_workshop/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                teacherInWorkshop.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    const workshops = ref([]);
    function getWorkshops() {
        axiosClient.get("/get_workshop").then((response) => {
            workshops.value = response.data;
        });
    }

    function getTeacherInWorkshop({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        teacherInWorkshops.value.loading = true;
        url = url || "/teacher_in_workshop";

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
                console.log(response.data);
                teacherInWorkshops.value.loading = false;
                setTeacherInWorkshop(response.data);
            })
            .catch((err) => {
                teacherInWorkshops.value.loading = false;
                console.log(err);
            });
    }

    function setTeacherInWorkshop(data) {
        if (data) {
            teacherInWorkshops.value.data = data.data;
            teacherInWorkshops.value.links = data.meta?.links;
            teacherInWorkshops.value.to = data.meta.to;
            teacherInWorkshops.value.from = data.meta.from;
            teacherInWorkshops.value.current_page = data.meta.current_page;
            teacherInWorkshops.value.total = data.meta.total;
        }
    }

    function editTeacherInWorkshop(id) {
        axiosClient.get(`/pdc/teacher_in_workshop/edit/${id}`).then((res) => {
            teacherInWorkshop.value = res.data;
        });
    }

    function updateTeacherInWorkshop(data, id) {
        loading.value = true;
        let document = "";
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("teacher_id", data.teacher_id);
        form.append("workshop_id", data.workshop_id);
        form.append("document", document);

        data = form;

        axiosClient
            .post("/pdc/teacher_in_workshop/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.pdc.teacher_in_workshop.list" });

                teacherInWorkshop.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteTeacherInWorkshop(id) {
        axiosClient
            .get(`/pdc/teacher_in_workshop/delete/${id}`)
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
        createTeacherInWorkshop,
        getTeacherInWorkshop,
        editTeacherInWorkshop,
        updateTeacherInWorkshop,
        deleteTeacherInWorkshop,
        getWorkshops,
        teacherInWorkshop,
        teacherInWorkshops,
        workshops,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useTeacherInWorkshop;
