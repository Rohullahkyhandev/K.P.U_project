import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

const useClassRoomStore = defineStore("classRoom", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let classRooms = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    let classRoom = ref({
        id: "",
        number: "",
        max_quantity: "",
        equipment: "",
        program_id: "",
    });

    function createClassRoom(data) {
        loading.value = true;
        axiosClient
            .post("/class_room/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                classRoom.value.equipment = "";
                classRoom.value.max_quantity = "";
                classRoom.value.number = "";
                classRoom.value.program_id = "";
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function getClassRoom({
        url = null,
        per_page,
        search = "",
        sortField,
        sortDirection,
        program_id = "",
    } = {}) {
        classRooms.value.loading = true;
        url = url || "/class_room";

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
                },
            })
            .then((response) => {
                classRooms.value.loading = false;
                setClassRoom(response.data);
            })
            .catch((err) => {
                classRooms.value.loading = false;
                console.log(err);
            });
    }

    function setClassRoom(data) {
        if (data) {
            classRooms.value.data = data.data;
            classRooms.value.links = data.meta?.links;
            classRooms.value.to = data.meta.to;
            classRooms.value.from = data.meta.from;
            classRooms.value.current_page = data.meta.current_page;
            classRooms.value.total = data.meta.total;
        }
    }

    function editClassRoom(id) {
        axiosClient.get(`/class_room/edit/${id}`).then((res) => {
            classRoom.value = res.data;
        });
    }

    function updateClassRoom(data) {
        loading.value = true;
        axiosClient
            .post("/class_room/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.post-graduated.class_room.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteClassRoom(id) {
        axiosClient
            .get(`/class_room/delete/${id}`)
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
        getClassRoom,
        createClassRoom,
        editClassRoom,
        updateClassRoom,
        deleteClassRoom,
        classRoom,
        classRooms,
        loading,
        msg_success,
        msg_wrang,
    };
});

export default useClassRoomStore;
