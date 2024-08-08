import { defineStore } from "pinia";
import axiosClient from "../../../axios";
import { ref } from "vue";

const usePdcDashboadStore = defineStore("pdcDashboard", () => {
    // let masterTeacher = ref([]);
    // let doctorTeacher = ref([]);
    let labels = ref([]);
    let teacherMasters = ref([]);
    let years = ref([]);
    function getTeacherInSchlarships() {
        axiosClient
            .get("/pdc/report/teacher_in_scholarship")
            .then((response) => {
                setLabelsTeacher(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    }
    return {
        getTeacherInSchlarships,
        labels,
        teacherMasters,
        years,
    };
});

export default usePdcDashboadStore;
