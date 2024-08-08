import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";
import router from "../../../routes";

export const useArchiveStore = defineStore("archive", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let Archives = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let archive = ref({
        id: "",
        subject: "",
        date: "",
        archive_file: "",
        description: "",
    });

    // actions
    function createArchive(data) {
        loading.value = true;
        let archive_file = null;
        if (data.archive_file instanceof File) {
            archive_file = data.archive_file;
        } else {
            archive_file = "";
        }

        var form = new FormData();

        form.append("subject", data.subject);
        form.append("date", data.date);
        form.append("archive_file", archive_file);
        form.append("description", data.description);

        data = form;
        axiosClient
            .post("/pdc/archive/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                archive.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getArchives({
        url = null,
        per_page,
        search = "",
        sortDirection,
        sortField,
    } = {}) {
        Archives.value.loading = true;
        url = url || "/archive";
        const params = {
            per_page: 10,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    url,
                    search,
                    per_page,
                    sortDirection,
                    sortField,
                },
            })
            .then((response) => {
                Archives.value.loading = false;
                setArchive(response.data);
            })
            .catch((err) => {
                Archives.value.loading = false;
                console.log(err);
            });
    }

    function setArchive(data) {
        if (data) {
            Archives.value.data = data.data;
            Archives.value.links = data.meta?.links;
            Archives.value.to = data.meta.to;
            Archives.value.from = data.meta.from;
            Archives.value.current_page = data.meta.current_page;
            Archives.value.total = data.meta.total;
        }
    }

    function editArchive(id) {
        axiosClient
            .get(`/pdc/archive/edit/${id}`)
            .then((res) => {
                archive.value = res.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function UpdateArchive(data) {
        loading.value = true;
        let archive_file = null;
        if (data.archive_file instanceof File) {
            archive_file = data.archive_file;
        } else {
            archive_file = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("subject", data.subject);
        form.append("date", data.date);
        form.append("archive_file", archive_file);
        form.append("description", data.description);

        data = form;
        axiosClient
            .post("/pdc/archive/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.pdc.archive.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteArchive(id) {
        Archives.value.loading = true;
        axiosClient.get(`/pdc/archive/delete/${id}`).then((res) => {
            Archives.value.loading = false;
            if (res.status == 200) {
                msg_success.value = "دیتا موفقانه حذف شد";
            }
        });
    }

    return {
        createArchive,
        getArchives,
        editArchive,
        UpdateArchive,
        deleteArchive,
        archive,
        Archives,
        loading,
        msg_success,
        msg_wrang,
    };
});
