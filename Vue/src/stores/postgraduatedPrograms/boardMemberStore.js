import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useBoradMemberStore = defineStore("boardMember", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let boardMembers = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let boardMember = ref({
        id: "",
        name: "",
        lname: "",
        fname: "",
        phone: "",
        email: "",
        address: "",
        board_id: "",
    });

    function createBoardMember(data) {
        loading.value = true;
        axiosClient
            .post("/board_member/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.status == 200) {
                    boardMember.value.name = "";
                    boardMember.value.lname = "";
                    boardMember.value.fname = "";
                    boardMember.value.email = "";
                    boardMember.value.phone = "";
                    boardMember.value.address = "";
                    boardMember.value.board_id = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    let boardList = ref([]);
    function getAllBoard() {
        axiosClient.get("/get_all_board_member").then((res) => {
            boardList.value = res.data;
        });
    }

    function getBoardMember({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        boardMembers.value.loading = true;
        url = url || "board_member";

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
                boardMembers.value.loading = false;
                setBoardMember(response.data);
            })
            .catch((err) => {
                boardMembers.value.loading = false;
                console.log(err);
            });
    }

    function setBoardMember(data) {
        if (data) {
            boardMembers.value.data = data.data;
            boardMembers.value.links = data.meta?.links;
            boardMembers.value.to = data.meta.to;
            boardMembers.value.from = data.meta.from;
            boardMembers.value.current_page = data.meta.current_page;
            boardMembers.value.total = data.meta.total;
        }
    }

    function editBoardMember(id) {
        axiosClient.get(`/board_member/edit/${id}`).then((res) => {
            boardMember.value = res.data;
        });
    }

    function updateBoardMember(data) {
        loading.value = true;
        axiosClient
            .post("/board_member/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                board.value = "";
                router.push({ name: "app.post-graduated.board.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteBoardMember(id) {
        axiosClient
            .get(`/board_member/delete/${id}`)
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
        getAllBoard,
        getBoardMember,
        createBoardMember,
        editBoardMember,
        updateBoardMember,
        deleteBoardMember,
        boardList,
        boardMember,
        boardMembers,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useBoradMemberStore;
