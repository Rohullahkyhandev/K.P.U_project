import { defineStore } from 'pinia'
import axiosClient from '../../../axios'
import router from "../../../routes";
import { ref } from 'vue'

export const usePlanStore = defineStore('plan', () => {

    let msg_success = ref('');
    let msg_wrang = ref('');
    let loading = ref(false);
    let plans = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 10,
        limit: null,
        total: null,
    });
    let plan = ref({
        id: '',
        subject: '',
        description: '',
        date: '',
        document: ''
    })

    function createPlan(data) {
        loading.value = true
        let document = '';
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = '';
        }

        var form = new FormData();
        form.append('subject', data.subject);
        form.append('date', data.date);
        form.append('description', data.description);
        form.append('document', document);

        data = form;

        axiosClient.post('/pdc/plan/create', data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message;
                plan.value = ''
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message
            })
    }



    function getPlan({ url = null, per_page, search = '', sortField, sortDirection } = {}) {
        plans.value.loading = true;
        url = url || '/plan'

        const params = {
            per_page: 10,
        }

        axiosClient.get(url, {
            params: {
                ...params,
                search,
                per_page,
                sortDirection,
                sortField
            }
        }).then((response) => {
            plans.value.loading = false;
            setPlan(response.data)
        }).catch((err) => {
            plans.value.loading = false;
            console.log(err);
        })

    }

    function setPlan(data) {
        if (data) {
            plans.value.data = data.data;
            plans.value.links = data.meta?.links;
            plans.value.to = data.meta.to;
            plans.value.from = data.meta.from;
            plans.value.current_page = data.meta.current_page;
            plans.value.total = data.meta.total;
        }
    }

    function editPlan(id) {

        axiosClient.get(`/pdc/plan/edit/${id}`)
            .then((res) => {
                plan.value = res.data;
            })
    }

    function updatePlan(data) {
        loading.value = true
        let document = '';
        if (data.document instanceof File) {
            document = data.document;
        } else {
            document = '';
        }

        var form = new FormData();
        form.append('id', data.id);
        form.append('subject', data.subject);
        form.append('date', data.date);
        form.append('description', data.description);
        form.append('document', document);

        data = form;

        axiosClient.post('/pdc/plan/update', data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message;
                plan.value = ''
                router.push({ name: "app.pdc.plan.list" });
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message
            })
    }

    function deletePlan(id) {
        axiosClient.get(`/pdc/plan/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_success.value = 'پلان موفقانه حذف شد'
                }
            }).catch((err) => {
                msg_wrang.value = 'پلان حذف نشد دوباره تلاش نماید'
            })
    }



    return {
        getPlan,
        createPlan,
        editPlan,
        updatePlan,
        deletePlan,
        plan,
        plans,
        loading,
        msg_success,
        msg_wrang
    };


});
