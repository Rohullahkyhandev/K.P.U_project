import { defineStore } from "pinia";
import { ref } from "vue";

const useDocumentStore = defineStore("document", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
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

    const document = ref({
        source: "",
        destination: "",
        type: "",
        date: "",
        attachment: "",
        description: "",
        remark: "",
    });

    return {
        msg_success,
        msg_wrang,
        loading,
        documents,
        document,
    };
});

export default useDocumentStore;
