<template>
    <th
        @click="$emit('click')"
        class="border border-red-200 px-2 py-3 text-left bg-gray-200 font-bold"
        style="font-size: 16px !important"
        :class="[sortField == field ? 'bg-blue-50' : '']"
    >
        <div class="flex items-center justify-between">
            <slot></slot>
            <div v-if="sortField === field" class="ml-2">
                <!--              Sort Asc-->
                <svg
                    v-if="sortDirection === 'asc'"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"
                    />
                </svg>
                <svg
                    v-else
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"
                    />
                </svg>
            </div>
        </div>
    </th>
</template>

<script setup>
const { sortField, sortDirection, field } = defineProps({
    sortField: String,
    field: String,
    sortDirection: String,
});

const click = defineEmits(["click"]);
</script>

<style scoped>
th {
    font-size: 14px !important;
}
</style>
