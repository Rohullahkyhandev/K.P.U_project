import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";
import router from "../../routes";

export const useUserStore = defineStore("user", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let user = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    const user_data = ref({
        id: "",
        dep_id: "",
        name: "",
        email: "",
        user_type: "",
        position: "",
        password: "",
        password_confirmation: "",
        photo: "",
        faculty_id: "",
        department_id: "",
    });

    let permissions = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    let permission_list = ref([]);
    let permission_current = ref({
        administrator: false,
        view_pdc: false,
        create_pdc: false,
        delete_pdc: false,
        edit_pdc: false,
        // teacher department permissions
        view_teacher_department: false,
        create_teacher_department: false,
        delete_teacher_department: false,
        edit_teacher_department: false,
        // employee permissions
        view_employee: false,
        create_employee: false,
        edit_employee: false,
        delete_employee: false,
        // post graduated
        view_post_graduated: false,
        create_post_graduated: false,
        edit_post_graduated: false,
        delete_post_graduated: false,

        // documents
        view_document: false,
        create_document: false,
        edit_document: false,
        delete_document: false,

        // quality assurance department
        view_quality_assurance: false,
        create_quality_assurance: false,
        edit_quality_assurance: false,
        delete_quality_assurance: false,
        // research department
        view_research_department: false,
        create_research_department: false,
        edit_research_department: false,
        delete_research_department: false,
    });

    function getCurrentPermission() {
        axiosClient.get(`/user/current/permission`).then(({ data }) => {
            data.forEach((item) => {
                if (item.id === 1) {
                    permission_current.value.administrator = true;
                } else if (item.id === 4) {
                    permission_current.value.view_pdc = true;
                } else if (item.id === 5) {
                    permission_current.value.create_pdc = true;
                } else if (item.id === 6) {
                    permission_current.value.edit_pdc = true;
                } else if (item.id === 7) {
                    permission_current.value.delete_pdc = true;
                }
                // end pdc permissions
                else if (item.id === 11) {
                    permission_current.value.view_quality_assurance = true;
                } else if (item.id === 12) {
                    permission_current.value.create_quality_assurance = true;
                } else if (item.id === 13) {
                    permission_current.value.edit_quality_assurance = true;
                } else if (item.id === 14) {
                    permission_current.value.delete_quality_assurance = true;
                }
                // end of the quality assurance permissions
                else if (item.id === 14) {
                    permission_current.value.delete_quality_assurance = true;
                } else if (item.id === 20) {
                    permission_current.value.view_teacher_department = true;
                } else if (item.id === 21) {
                    permission_current.value.create_teacher_department = true;
                } else if (item.id === 22) {
                    permission_current.value.edit_teacher_department = true;
                } else if (item.id === 23) {
                    permission_current.value.delete_teacher_department = true;
                } else if (item.id === 27) {
                    permission_current.value.view_post_graduated = true;
                } else if (item.id === 28) {
                    permission_current.value.create_post_graduated = true;
                } else if (item.id === 29) {
                    permission_current.value.edit_post_graduated = true;
                } else if (item.id === 30) {
                    permission_current.value.delete_post_graduated = true;
                }
                // end of post graduated permissions
                else if (item.id === 34) {
                    permission_current.value.view_research_department = true;
                } else if (item.id === 35) {
                    permission_current.value.create_research_department = true;
                } else if (item.id === 36) {
                    permission_current.value.edit_research_department = true;
                } else if (item.id === 37) {
                    permission_current.value.delete_research_department = true;
                }
                // end of research department permissions
                else if (item.id === 41) {
                    permission_current.value.view_employee = true;
                } else if (item.id === 42) {
                    permission_current.value.create_employee = true;
                } else if (item.id === 43) {
                    permission_current.value.edit_employee = true;
                } else if (item.id === 44) {
                    permission_current.value.delete_employee = true;
                }
                // end of employees permissions
                else if (item.id === 48) {
                    permission_current.value.view_document = true;
                } else if (item.id === 49) {
                    permission_current.value.create_document = true;
                } else if (item.id === 50) {
                    permission_current.value.edit_document = true;
                } else if (item.id === 51) {
                    permission_current.value.delete_document = true;
                }
            });
        });
    }

    function getUsers({
        url = null,
        search = "",
        per_page,
        sortField,
        sortDirection,
    } = {}) {
        user.value.loading = true;
        url = url || "/user";
        const params = {
            per_page: 10,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    per_page,
                    sortField,
                    sortDirection,
                    search,
                },
            })
            .then((res) => {
                user.value.loading = false;
                setUsers(res.data);
            })
            .catch((err) => {
                user.value.loading = false;
                console.log(err);
            });
    }

    function setUsers(data) {
        if (data) {
            user.value.data = data;
            user.value.links = data.meta?.links;
            user.value.current_page = data.meta.current_page;
            user.value.from = data.meta.from;
            user.value.to = data.meta.to;
            user.value.total = data.meta.total;
            user.value.limit = data.meta.per_page;
        }
    }

    function createUser(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        } else {
            photo = "";
        }

        var form = new FormData();
        form.append("name", data.name);
        form.append("dep_id", data.dep_id);
        form.append("email", data.email);
        form.append("password", data.password);
        form.append("position", data.position);
        form.append("user_type", data.user_type);
        form.append("faculty_id", data.faculty_id);
        form.append("department_id", data.department_id);
        form.append("password_confirmation", data.password_confirmation);
        form.append("photo", photo);
        data = form;
        axiosClient
            .post("/user/create", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    const chanceDepartments = ref([]);
    function getChanceDepartments() {
        axiosClient.get("/get_chance_department").then((response) => {
            chanceDepartments.value = response.data;
            console.log(chanceDepartments.value);
        });
    }

    function getPermissions({ url = null, id, per_page } = {}) {
        permissions.value.loading = true;
        url = url || "/permission";
        const params = {
            per_page: 10,
        };

        axiosClient
            .get(url, {
                params: {
                    ...params,
                    per_page,
                    id,
                },
            })
            .then((res) => {
                console.log(res.data);
                permissions.value.loading = false;
                setPermission(res.data);
            })
            .catch((err) => {
                permissions.value.loading = false;
                console.log(err);
            });
    }

    function setPermission(data) {
        if (data) {
            permissions.value.data = data;
            permissions.value.links = data.meta?.links;
            permissions.value.current_page = data.meta.current_page;
            permissions.value.from = data.meta.from;
            permissions.value.to = data.meta.to;
            permissions.value.total = data.meta.total;
            permissions.value.limit = data.meta.per_page;
        }
    }

    function getUserPermission(id) {
        axiosClient
            .get(`/permission/list/${id}`)
            .then((res) => {
                permission_list.value = res.data;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.message;
            });
    }

    function editUser(id = "") {
        axiosClient
            .get(`/user/edit/${id}`)
            .then((res) => {
                user_data.value = res.data;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.message;
            });
    }

    function updateUser(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        } else {
            photo = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("dep_id", data.dep_id);
        form.append("name", data.name);
        form.append("email", data.email);
        form.append("password", data.password);
        form.append("position", data.position);
        form.append("user_type", data.user_type);
        form.append("faculty_id", data.faculty_id);
        form.append("department_id", data.department_id);
        form.append("password_confirmation", data.password_confirmation);
        form.append("photo", photo);
        data = form;
        axiosClient
            .post("/user/update", data)
            .then((res) => {
                loading.value = false;
                msg_success.value = res.data.message;
                router.push({ name: "app.user.list" });
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteUser(id) {
        axiosClient
            .get(`/user/delete/${id}`)
            .then((res) => {
                console.log(res);
                if (res.status === 200) {
                    msg_success.value = "یوزر موفقانه حذف گردید";
                }
            })
            .catch((err) => {
                msg_wrang.value = "یوزر  حذف نشد دوباره تلاش نماید";
            });
    }

    function createPermission(data) {
        axiosClient
            .post("/permission/store", data)
            .then((res) => {
                msg_success.value = res.data.message;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.error;
            });
    }

    function deletePermission(user_id) {
        axiosClient
            .get(`/permission/delete/${user_id}`)
            .then((res) => {
                console.log(res);
                if (res.status === 200) {
                    msg_success.value = "صلاحیت موفقانه حذف گردید";
                }
            })
            .catch((err) => {
                msg_success.value = "صلاحیت  حذف نشد دوباره تلاش نماید";
            });
    }

    return {
        getUsers,
        getPermissions,
        getChanceDepartments,
        getUserPermission,
        permission_list,
        createPermission,
        getCurrentPermission,
        permission_current,
        deletePermission,
        createUser,
        deleteUser,
        editUser,
        updateUser,
        user,
        chanceDepartments,
        loading,
        user_data,
        permissions,
        msg_success,
        msg_wrang,
    };
});
