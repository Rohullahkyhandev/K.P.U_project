import { defineStore } from "pinia";
import axiosClient from "../../axios";
import axios from "axios";
import { ref } from "vue";

const usePdcTeacherInCommitReport = defineStore(
    "PdcTeacherInCommitReport",
    () => {
        let loading = ref(false);
        let msg_wrang = ref("");
        let msg_success = ref("");

        let report_data = ref({
            type: "",
            report_data: "",
            report_format: "",
        });

        let commits = ref([]);
        function getCommits() {
            axiosClient.get("/pdc/get_commits").then((response) => {
                commits.value = response.data;
            });
        }

        // teacher report
        let teacherlist = ref([]);
        function getTeacherList() {
            axiosClient.get("/teacher/report").then((response) => {
                teacherlist.value = response.data;
            });
        }

        return {
            teacherlist,
            getTeacherList,
            // for the test
            report_data,
            getCommits,
            commits,
            loading,
            msg_success,
            msg_wrang,
        };
    }
);

export default usePdcTeacherInCommitReport;
