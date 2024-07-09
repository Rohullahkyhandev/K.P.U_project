import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useGraduatedStudent = defineStore("graduatedStudent", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let graduatedStudents = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let graduatedStudent = ref({
        id: "",
        percentage: "",
        graduated_year: "",
        diplome_id: "",
        thesis_mark: "",
        thesis_guide_teacher: "",
        attribute: "",
        student_id: "",
    });

    function createGraduatedStudent(data) {
        loading.value = true;
        // data.value.student_id = id;
        axiosClient
            .post("/graduated_student/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                graduatedStudent.value.attribute = "";
                graduatedStudent.value.diploma_id = "";
                graduatedStudent.value.graduation_year = "";
                graduatedStudent.value.percentage = "";
                graduatedStudent.value.thesis_guide_teacher = "";
                graduatedStudent.value.thesis_mark = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getGraduatedStudent({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
        program_id = "",
        year = "",
    } = {}) {
        graduatedStudents.value.loading = true;
        url = url || `/graduated_student/${program_id}`;

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
                graduatedStudents.value.loading = false;
                setGraduatedStudent(response.data);
            })
            .catch((err) => {
                graduatedStudents.value.loading = false;
                console.log(err);
            });
    }

    function setGraduatedStudent(data) {
        if (data) {
            graduatedStudents.value.data = data.data;
            graduatedStudents.value.links = data.meta?.links;
            graduatedStudents.value.to = data.meta.to;
            graduatedStudents.value.from = data.meta.from;
            graduatedStudents.value.current_page = data.meta.current_page;
            graduatedStudents.value.total = data.meta.total;
        }
    }

    function editGraduatedStudent(id) {
        axiosClient.get(`/graduated_student/edit/${id}`).then((res) => {
            graduatedStudent.value = res.data;
        });
    }

    function updateGraduatedStudent(data, id) {
        loading.value = true;

        axiosClient
            .post("/graduated_student/update", data)
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

    function deleteGraduatedStudent(id) {
        axiosClient
            .get(`/graduated_student/delete/${id}`)
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
        getGraduatedStudent,
        createGraduatedStudent,
        editGraduatedStudent,
        updateGraduatedStudent,
        deleteGraduatedStudent,
        graduatedStudent,
        graduatedStudents,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useGraduatedStudent;
