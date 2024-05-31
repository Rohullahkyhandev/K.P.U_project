import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useProgramStore = defineStore("postPrograms", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let programs = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let program = ref({
        id: "",
        program_name: "",
        degree_type: "",
        description: "",
        program_duration: "",
    });

    let listProgram = ref([]);
    function getAllPrograms() {
        axiosClient
            .get("/get_all_program")
            .then((response) => {
                listProgram.value = response.data;
            })
            .catch((error) => {
                msg_wrang.value = error.response.data.message;
            });
    }

    function createProgram(data) {
        loading.value = true;

        axiosClient
            .post("/program/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                program.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getProgram({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        programs.value.loading = true;
        url = url || "/program";

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
                programs.value.loading = false;
                setProgram(response.data);
            })
            .catch((err) => {
                programs.value.loading = false;
                console.log(err);
            });
    }

    function setProgram(data) {
        if (data) {
            programs.value.data = data.data;
            programs.value.links = data.meta?.links;
            programs.value.to = data.meta.to;
            programs.value.from = data.meta.from;
            programs.value.current_page = data.meta.current_page;
            programs.value.total = data.meta.total;
        }
    }

    function editProgram(id) {
        axiosClient.get(`/postgraduated/program/edit/${id}`).then((res) => {
            program.value = res.data;
        });
    }

    function updateProgram(data, id) {
        loading.value = true;

        axiosClient
            .post("/postgraduated/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.pdc.workshop.list" });
                program.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteProgram(id) {
        axiosClient
            .get(`/postgraduated/program/delete/${id}`)
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
        getAllPrograms,
        getProgram,
        createProgram,
        editProgram,
        updateProgram,
        deleteProgram,
        listProgram,
        program,
        programs,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useProgramStore;
