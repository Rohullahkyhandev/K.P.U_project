import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useBoardStore = defineStore("board", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let boards = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let board = ref({
        id: "",
        name: "",
        director: "",
        faculty: "",
        metting_place: "",
        secretary_phone: "",
        secretary: "",
        metting_place_per_month: "",
        director_phone: "",
        attachment: "",
    });

    function createBoard(data) {
        loading.value = true;
        axiosClient
            .post("/board/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                if (res.status == 200) {
                    board.value.name = "";
                    board.value.secretary = "";
                    board.value.director = "";
                    board.value.director_phone = "";
                    board.value.secretary_phone = "";
                    board.value.attachment = "";
                    board.value.faculty = "";
                    board.value.metting_place = "";
                    board.value.metting_place_per_month = "";
                }
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getBoard({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
    } = {}) {
        boards.value.loading = true;
        url = url || "/board";

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
                boards.value.loading = false;
                setBoard(response.data);
            })
            .catch((err) => {
                boards.value.loading = false;
                console.log(err);
            });
    }

    function setBoard(data) {
        if (data) {
            boards.value.data = data.data;
            boards.value.links = data.meta?.links;
            boards.value.to = data.meta.to;
            boards.value.from = data.meta.from;
            boards.value.current_page = data.meta.current_page;
            boards.value.total = data.meta.total;
        }
    }

    function editBoard(id) {
        axiosClient.get(`/board/edit/${id}`).then((res) => {
            board.value = res.data;
        });
    }

    function updateBoard(data) {
        loading.value = true;
        axiosClient
            .post("/board/update", data)
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

    function deleteBoard(id) {
        axiosClient
            .get(`/board/delete/${id}`)
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
        getBoard,
        createBoard,
        editBoard,
        updateBoard,
        deleteBoard,
        board,
        boards,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useBoardStore;
