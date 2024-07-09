<template>
    <div v-if="isOpen == true">
        <PDFViewer
            :source="url"
            style="height: 100vh; width: 100vw"
            @download="handleDownload"
        />
    </div>
</template>

<script setup>
import PDFViewer from "pdf-viewer-vue";

// const url = "./path/document/file.pdf";

function handleDownload() {
    console.log(url);
}

const props = defineProps({
    url: {
        type: URL,
        required: true,
    },
    isOpen: {
        type: Boolean,
        required: true,
        default: true,
    },
});

</script>
