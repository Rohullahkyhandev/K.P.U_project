import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useStudentStore = defineStore("studnetStore", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let studnets = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let student = ref({
        id: "",
        name: "",
        lname: "",
        fname: "",
        phone: "",
        email: "",
        kankor_id: "",
        kankor_mark: "",
        bachelor_field: "",
        nic: "",
        address: "",
        admission_year: "",
        blood_group: "",
        program_id: "",
    });

    function createStudent(data) {
        loading.value = true;

        axiosClient
            .post("/studnet/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                student.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getStudent({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
        program_id = "",
        year = "",
    } = {}) {
        studnets.value.loading = true;
        url = url || `/studnet/${program_id}`;

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
                    year,
                },
            })
            .then((response) => {
                studnets.value.loading = false;
                setStudent(response.data);
            })
            .catch((err) => {
                studnets.value.loading = false;
                console.log(err);
            });
    }

    function setStudent(data) {
        if (data) {
            studnets.value.data = data.data;
            studnets.value.links = data.meta?.links;
            studnets.value.to = data.meta.to;
            studnets.value.from = data.meta.from;
            studnets.value.current_page = data.meta.current_page;
            studnets.value.total = data.meta.total;
        }
    }

    function editStudent(id) {
        axiosClient.get(`/studnet/edit/${id}`).then((res) => {
            student.value = res.data;
        });
    }

    function updateStudent(data, id) {
        loading.value = true;

        axiosClient
            .post("/student/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({
                    name: "app.post-graduated.student.list",
                });
                student.value = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteStudent(id) {
        axiosClient
            .get(`/studnet/delete/${id}`)
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
        getStudent,
        createStudent,
        editStudent,
        updateStudent,
        deleteStudent,
        student,
        studnets,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useStudentStore;
