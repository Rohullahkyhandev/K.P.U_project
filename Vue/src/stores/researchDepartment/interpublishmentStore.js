import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useInterpubStore = defineStore("publishment", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let publishments = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 10,
        limit: null,
        total: null,
    });
    let publishment = ref({
        id: "",
        author: "",
        author_assesstance: "",
        title: "",
        journal_name: "",
        journal_link_website: "",
        attachment: "",
        faculty_id: "",
        department_id: "",
    });

    function createPublishment(data) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        }

        let form = new FormData();
        form.append("author", data.author);
        form.append("author_assesstance", data.author_assesstance);
        form.append("title", data.title);
        form.append("journal", data.journal_name);
        form.append("journal_website_link", data.journal_link_website);
        form.append("faculty_id", data.faculty_id);
        form.append("attachment", attachment);
        form.append("department_id", data.department_id);
        data = form;

        axiosClient
            .post("/international_publisher/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                getPublishment();
                if (res.status == 200) {
                    publishment.value.title = "";
                    publishment.value.author = "";
                    publishment.value.author_assesstance = "";
                    publishment.value.journal_name = "";
                    publishment.value.journal_link_website = "";
                    publishment.value.faculty_id = "";
                    publishment.value.department_id = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getPublishment({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        publishments.value.loading = true;
        url = url || "/international_publisher";

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
                publishments.value.loading = false;
                setPublishments(response.data);
            })
            .catch((err) => {
                publishments.value.loading = false;
                console.log(err);
            });
    }

    function setPublishments(data) {
        if (data) {
            publishments.value.data = data.data;
            publishments.value.links = data.meta?.links;
            publishments.value.to = data.meta.to;
            publishments.value.from = data.meta.from;
            publishments.value.current_page = data.meta.current_page;
            publishments.value.total = data.meta.total;
        }
    }

    function editPublishment(id) {
        axiosClient.get(`/international_publisher/edit/${id}`).then((res) => {
            publishment.value = res.data;
        });
    }

    function updatePublishment(data) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        }

        let form = new FormData();
        form.append("id", data.id);
        form.append("author", data.author);
        form.append("author_assesstance", data.author_assesstance);
        form.append("title", data.title);
        form.append("journal", data.journal_name);
        form.append("journal_website_link", data.journal_link_website);
        form.append("faculty_id", data.faculty_id);
        form.append("attachment", attachment);
        form.append("department_id", data.department_id);
        data = form;
        axiosClient
            .post("/international_publisher/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                publishment.value = "";
                router.push({ name: "app.research.interpub.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deletePublishment(id) {
        axiosClient
            .get(`/international_publisher/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_success.value = "دیتا موفقانه حذف شد";
                }
            })
            .catch((err) => {
                msg_wrang.value = "دیتا حذف نشد دوباره تلاش نماید";
            });
    }

    // get all the departments
    let listDepartments = ref([]);
    function getAllDepartments() {
        axiosClient.get("/curriculum/department").then((res) => {
            listDepartments.value = res.data;
        });
    }
    return {
        getPublishment,
        createPublishment,
        editPublishment,
        updatePublishment,
        deletePublishment,
        getAllDepartments,
        listDepartments,
        publishment,
        publishments,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useInterpubStore;
