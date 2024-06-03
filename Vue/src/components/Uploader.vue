<template>
    <div class="container mx-auto py-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
            Upload Images
        </h2>
        <form @submit.prevent="uploadImages" class="space-y-4">
            <input
                hidden
                type="file"
                multiple
                @change="handleFiles"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
            />
            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-300 focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50"
            >
                Upload
            </button>
        </form>

        <div v-if="uploading" class="w-full bg-gray-200 rounded-full h-4 mt-4">
            <div
                :style="{ width: uploadProgress + '%' }"
                class="bg-green-500 h-2 rounded-full"
            ></div>
        </div>
        <div v-if="imagePaths.length" class="mt-6">
            <h3 class="text-lg font-semibold mb-4">Uploaded Images:</h3>
            <ul>
                <li v-for="(path, index) in imagePaths" :key="index">
                    {{ path }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axiosClient from "../axios";

const files = ref([]);
const imagePaths = ref([]);
const uploadProgress = ref(0);
const uploading = ref(false);

const handleFiles = (event) => {
    files.value = event.target.files;
};

const uploadImages = async () => {
    const formData = new FormData();

    for (let i = 0; i < files.value.length; i++) {
        formData.append("images[]", files.value[i]);
    }

    try {
        uploading.value = true;
        const response = await axiosClient.post("/upload-images", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
            onUploadProgress: (progressEvent) => {
                const total = progressEvent.total;
                const current = progressEvent.loaded;
                uploadProgress.value = Math.round((current / total) * 100);
            },
        });
        imagePaths.value = response.data.image_paths;
    } catch (error) {
        console.error(error);
    } finally {
        uploading.value = false;
        uploadProgress.value = 0;
    }
};
</script>

<style scoped>
.container {
    max-width: 600px;
}
</style>
