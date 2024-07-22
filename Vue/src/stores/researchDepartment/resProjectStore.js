import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

const useResProjectStore = defineStore("resProject", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let resProjects = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 10,
        limit: null,
        total: null,
    });
    let resProject = ref({
        id: "",
        project_name: "",
        scope_of_project: "",
        related_images: "",
        date: "",
        lab_id: "",
    });

    function createResProject(data) {
        loading.value = true;
        axiosClient
            .post("/research_project/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.statusCode === 200) {
                    resProject.value.project_name = "";
                    resProject.value.scope_of_project = "";
                    resProject.value.related_images = "";
                    resProject.value.date = "";
                    resProject.value.lab_id = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getResProject({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        resProjects.value.loading = true;
        url = url || "/research_project";

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
                resProjects.value.loading = false;
                setResProjects(response.data);
            })
            .catch((err) => {
                resProjects.value.loading = false;
                console.log(err);
            });
    }

    function setResProjects(data) {
        if (data) {
            resProjects.value.data = data.data;
            resProjects.value.links = data.meta?.links;
            resProjects.value.to = data.meta.to;
            resProjects.value.from = data.meta.from;
            resProjects.value.current_page = data.meta.current_page;
            resProjects.value.total = data.meta.total;
        }
    }

    function editResProject(id) {
        axiosClient.get(`/research_project/edit/${id}`).then((res) => {
            resProject.value = res.data;
        });
    }

    function updateResProject(data) {
        loading.value = true;
        axiosClient
            .post("/research_project/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                resProject.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteResProject(id) {
        axiosClient
            .get(`/research_project/delete/${id}`)
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
        getResProject,
        createResProject,
        editResProject,
        updateResProject,
        deleteResProject,
        resProject,
        resProjects,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useResProjectStore;
