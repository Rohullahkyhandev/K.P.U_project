import { defineStore } from "pinia";
import { ref } from "vue";
import axiosClient from "../../axios";
import { toast } from "vue3-toastify";
import router from "../../routes";

const notify = (message, type) => {
    if (type == "success") {
        toast.success(message, {
            autoClose: true,
            // delay: 3000,
            rtl: true,
            position: "top-center",
            theme: "colored",
            progress: true,
            style: { "border-radius": "12px" },
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            // style,
        }); // ToastOptions
    } else {
        toast.error(message, {
            autoClose: true,
            // delay: 3000,
            rtl: true,
            position: "top-center",
            theme: "colored",
            progress: true,
            style: { "border-radius": "12px" },
            // style,
        }); // ToastOptions
    }
};

const useDocumentStore = defineStore("document", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let type = ref("");
    let documents = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let farwarded_document = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    const document = ref({
        title: "",
        number: "",
        source: "",
        destination: "",
        type: "",
        date: "",
        attachment: "",
        description: "",
        remark: "",
        farwarded_parts: [],
        department_part: "",
    });

    function createDocument(data) {
        loading.value = true;
        let attachment = "";
        if (data.attachment instanceof File) {
            attachment = data.attachment;
        }

        const form = new FormData();
        form.append("number", data.number);
        form.append("title", data.title);
        form.append("source", data.source);
        form.append("destination", data.destination);
        form.append("type", data.type);
        form.append("date", data.date);
        form.append("department_part", data.department_part);
        form.append("attachment", attachment);
        for (let i = 0; i < data.farwarded_parts.length; i++) {
            form.append(`farwarded_parts[${i}]`, data.farwarded_parts[i]);
        }

        form.append("description", data.description);
        form.append("remark", data.remark);
        data = form;

        axiosClient
            .post("document/create", data)
            .then((response) => {
                type.value = "success";
                loading.value = false;
                // msg_success.value = response.data.message;
                notify(response.data.message, type.value);
                if (response.status == 200) {
                    document.value.source = "";
                    document.value.number = "";
                    document.value.description = "";
                    document.value.destination = "";
                    document.value.title = "";
                    document.value.type = "";
                    document.value.date = "";
                    document.value.attachment = "";
                    document.value.description = "";
                    document.value.remark = "";
                }
            })
            .catch((error) => {
                loading.value = false;
                msg_wrang.value = error.response.data.message;
            });
    }

    function getDocument({
        url = null,
        per_page,
        search = "",
        sortDirection,
        sortField,
    } = {}) {
        documents.value.loading = true;
        url = url || "/document";
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
                documents.value.loading = false;
                setDocument(response.data);
            })
            .catch((err) => {
                documents.value.loading = false;
            });
    }

    function setDocument(data) {
        if (data) {
            documents.value.data = data.data;
            documents.value.links = data.meta?.links;
            documents.value.to = data.meta.to;
            documents.value.from = data.meta.from;
            documents.value.current_page = data.meta.current_page;
            documents.value.total = data.meta.total;
        }
    }

    function getFarwardedDocument({
        url = null,
        per_page,
        search = "",
        sortDirection,
        sortField,
    } = {}) {
        farwarded_document.value.loading = true;
        documents.value.loading = true;
        url = url || "/farwarded_document";
        const params = {
            per_page: 10,
        };
        axiosClient.get(url, {
            params: {
                ...params,
                url,
                search,
                per_page,
                sortDirection,
                sortField,
            },
        });
        axiosClient
            .get("/farwarded_document")
            .then((response) => {
                farwarded_document.value.loading = false;
                setFarwardedDocument(response.data);
            })
            .catch((err) => {
                farwarded_document.value.loading = false;
                console.log(err);
            });
    }

    // save as enter document
    function saveAsEnterDocument(data) {
        loading.value = true;
        axiosClient
            .post(`/save_as_enter_document`, data)
            .then((response) => {
                loading.value = false;
                if (response.status === 200) {
                    type.value = "success";
                    notify("مکتوب موفقانه ذخیره گردید", type.value);
                    getFarwardedDocument();
                }
            })
            .catch((error) => {
                loading.value = false;
                type.value = "error";
                msg_wrang.value = error.response.data.message;
            });
    }
    function setFarwardedDocument(data) {
        if (data) {
            farwarded_document.value.data = data.data;
            farwarded_document.value.links = data.meta?.links;
            farwarded_document.value.to = data.meta.to;
            farwarded_document.value.from = data.meta.from;
            farwarded_document.value.current_page = data.meta.current_page;
            farwarded_document.value.total = data.meta.total;
        }
    }

    // update notification
    function updateNotification(id) {
        axiosClient
            .get(`/update_notification/${id}`)
            .then((response) => {
                getFarwardedDocument();
                notify("مکتوب مفقانه در لسیت تکثر اضافه شد");
                if (response.status == 200) {
                    return router.push({ name: "app.document.farwarded.list" });
                }
            })
            .catch((err) => {
                console.error(err);
            });
    }

    // get all the notifications
    let notifications = ref([]);
    function getNotification() {
        axiosClient
            .get("/notifications")
            .then((response) => {
                notifications.value = response.data.data;
            })
            .catch((err) => {
                console.log(err.response.data.message);
            });
    }

    // count notification
    let notificationCounter = ref();
    function countNotification() {
        axiosClient
            .get("/count_notification")
            .then((response) => {
                notificationCounter.value = response.data;
            })

            .catch((err) => {
                console.log(err.response.data.message);
            });
    }

    function deleteDocument(id) {
        loading.value = true;

        axiosClient
            .get(`document/delete/${id}`)
            .then((response) => {
                type.value = "success";
                loading.value = false;
                notify("مکتوب موفقانه حذف گردید", type.value);
            })
            .catch((err) => {
                loading.value = false;
                type.value = "error";
                notify(err.response.data.message, type.value);
            });
    }

    function deleteFormFarwardList(id) {
        loading.value = true;
        axiosClient
            .get(`farwarded_document/delete/${id}`)
            .then((response) => {
                if (response.status == 200) {
                    loading.value = false;
                    type.value = "success";
                    notify("مکتوب موفقانه حذف گردید", type.value);
                    getFarwardedDocument();
                }
            })
            .catch((err) => {
                loading.value = false;
                type.value = "error";
                notify(err.response.data.message, type.value);
            });
    }

    return {
        createDocument,
        getDocument,
        getFarwardedDocument,
        saveAsEnterDocument,
        getNotification,
        countNotification,
        updateNotification,
        deleteDocument,
        deleteFormFarwardList,
        farwarded_document,
        notificationCounter,
        notifications,
        msg_success,
        msg_wrang,
        loading,
        documents,
        document,
    };
});

export default useDocumentStore;
