import { defineStore } from 'pinia'
import { ref } from 'vue';
import router from '../../../routes'
import axiosClient from '../../../axios';

export const useDocumentStore = defineStore('document', () => {

    // received document
    let msg_success = ref('');
    let msg_wrang = ref('');
    let loading = ref(false);
    let ReceivedDocument = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });
    let receivedDocument = ref({
        source: '',
        destination: '',
        description: '',
        remark: '',
        iqdam_no: '',
        date_of_entered: '',
        document_date: '',
        entered_no: '',
        pages_no: '',
        volume: '',
        attachment: '',
    })

    // send documents
    let SendDocument = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });
    let sendDocument = ref({
        id: '',
        source: '',
        destination: '',
        description: '',
        remark: '',
        perform_branch: '',
        attachment_branch: '',
        date_of_sent: '',
        document_date: '',
        serial_no: '',
        pages_no: '',
        volume: '',
        attachment: '',
    })


    function getReceivedDocument({ url = null, per_page, search = '', sortField, sortDirection } = {}) {
        ReceivedDocument.value.loading = true;
        url = url || '/receivedDocument'

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
            ReceivedDocument.value.loading = false;
            setReceivedDocument(response.data)
        }).catch((err) => {
            ReceivedDocument.value.loading = false;
            console.log(err);
        })

    }

    function setReceivedDocument(data) {

        if (data) {
            ReceivedDocument.value.data = data.data;
            ReceivedDocument.value.links = data.meta?.links;
            ReceivedDocument.value.to = data.meta.to;
            ReceivedDocument.value.from = data.meta.from;
            ReceivedDocument.value.current_page = data.meta.current_page;
            ReceivedDocument.value.total = data.meta.total;
        }
    }

    function createReceivedDocument(data) {
        loading.value = true
        let attachment = ''
        if (data.attachment instanceof File) {
            attachment = data.attachment
        } else {
            attachment = ''
        }
        var form = new FormData();
        form.append('source', data.source);
        form.append('destination', data.destination);
        form.append('remark', data.remark);
        form.append('description', data.description);
        form.append('iqdam_no', data.iqdam_no);
        form.append('entered_no', data.entered_no);
        form.append('date_of_entered', data.date_of_entered);
        form.append('document_date', data.document_date);
        form.append('pages_no', data.pages_no);
        form.append('volume', data.volume);
        form.append('attachment', attachment);
        data = form;

        axiosClient.post('/pdc/received_document/store', data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message;
                receivedDocument.value = ''
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            })
    }

    function editReceivedDocument(id = '') {

        axiosClient.get(`/pdc/received_document/edit/${id}`)
            .then(({ data }) => {
                receivedDocument.value = data;
            }).catch((err) => {
                console.log(err);
            })
    }

    function UpdateReceivedDocument(data) {
        loading.value = true
        let attachment = ''
        if (data.attachment instanceof File) {
            attachment = data.attachment
        } else {
            attachment = ''
        }
        var form = new FormData();
        form.append('id', data.id);
        form.append('source', data.source);
        form.append('destination', data.destination);
        form.append('remark', data.remark);
        form.append('description', data.description);
        form.append('iqdam_no', data.iqdam_no);
        form.append('entered_no', data.entered_no);
        form.append('date_of_entered', data.date_of_entered);
        form.append('document_date', data.document_date);
        form.append('pages_no', data.pages_no);
        form.append('volume', data.volume);
        form.append('attachment', attachment);
        data = form;

        axiosClient.post('/pdc/received_document/update', data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message;
                router.push({ name: 'app.pdc.received_document' })
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            })
    }

    function deleteReceivedDocument(id = '') {
        ReceivedDocument.value.loading = true;
        axiosClient.get(`/pdc/received_document/delete/${id}`)
            .then((response) => {
                ReceivedDocument.value.loading = false;
                if (response.status == 200) {
                    console.log(response);
                    msg_success.value = 'مکتوب حذف شد'
                }
            }).catch((err) => {
                ReceivedDocument.value.loading = false;
                msg_wrang.value = 'مکتوب حذف نشد دوباره تلاش نماید'
            })
    }


    // send Document actions
    function getSendDocument({ url = null, per_page, search = '', sortField, sortDirection } = {}) {
        SendDocument.value.loading = true;
        url = url || '/sendDocument'

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
            SendDocument.value.loading = false;
            setSendDocument(response.data)
        }).catch((err) => {
            SendDocument.value.loading = false;
            console.log(err);
        })

    }

    function setSendDocument(data) {

        if (data) {
            SendDocument.value.data = data.data;
            SendDocument.value.links = data.meta?.links;
            SendDocument.value.to = data.meta.to;
            SendDocument.value.from = data.meta.from;
            SendDocument.value.current_page = data.meta.current_page;
            SendDocument.value.total = data.meta.total;
        }
    }

    function createSendDocument(data) {
        loading.value = true
        let attachment = ''
        if (data.attachment instanceof File) {
            attachment = data.attachment
        } else {
            attachment = ''
        }
        var form = new FormData();
        form.append('source', data.source);
        form.append('destination', data.destination);
        form.append('remark', data.remark);
        form.append('description', data.description);
        form.append('serial_no', data.serial_no);
        form.append('perform_branch', data.perform_branch);
        form.append('attachment_branch', data.attachment_branch);
        form.append('date_of_sent', data.date_of_sent);
        form.append('document_date', data.document_date);
        form.append('pages_no', data.pages_no);
        form.append('volume', data.volume);
        form.append('attachment', attachment);
        data = form;

        axiosClient.post('/pdc/send_document/store', data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message;
                sendDocument.value = '';
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            })
    }

    function editSendDocument(id = '') {

        axiosClient.get(`/pdc/send_document/edit/${id}`)
            .then(({ data }) => {
                sendDocument.value = data;
            }).catch((err) => {
                console.log(err);
            })
    }

    function UpdateSendDocument(data) {
        loading.value = true
        let attachment = ''
        if (data.attachment instanceof File) {
            attachment = data.attachment
        } else {
            attachment = ''
        }
        var form = new FormData();
        form.append('id', data.id);
        form.append('source', data.source);
        form.append('destination', data.destination);
        form.append('remark', data.remark);
        form.append('description', data.description);
        form.append('serial_no', data.serial_no);
        form.append('perform_branch', data.perform_branch);
        form.append('attachment_branch', data.attachment_branch);
        form.append('date_of_sent', data.date_of_sent);
        form.append('document_date', data.document_date);
        form.append('pages_no', data.pages_no);
        form.append('volume', data.volume);
        form.append('attachment', attachment);
        data = form;

        axiosClient.post('/pdc/send_document/update', data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message;
                router.push({ name: 'app.pdc.send_document' })
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            })
    }

    function deleteSendDocument(id = '') {
        ReceivedDocument.value.loading = true;
        axiosClient.get(`/pdc/send_document/delete/${id}`)
            .then((response) => {
                SendDocument.value.loading = false;
                if (response.status == 200) {
                    msg_success.value = 'مکتوب حذف شد'
                }
            }).catch((err) => {
                SendDocument.value.loading = false;
                msg_wrang.value = 'مکتوب حذف نشد دوباره تلاش نماید'
            })
    }



    return {
        // send part
        ReceivedDocument,
        getReceivedDocument,
        createReceivedDocument,
        editReceivedDocument,
        UpdateReceivedDocument,
        deleteReceivedDocument,
        receivedDocument,
        // end of send part
        SendDocument,
        getSendDocument,
        createSendDocument,
        editSendDocument,
        UpdateSendDocument,
        deleteSendDocument,
        sendDocument,
        // common message ref
        loading,
        msg_success,
        msg_wrang,
    }

});
