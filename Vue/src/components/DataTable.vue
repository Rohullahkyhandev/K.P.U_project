<template>
    <div class="card overflow-x-auto">
        <OrganizationChart :value="data" collapsible>
            <template #person="slotProps">
                <div class="flex flex-col">
                    <div class="flex flex-col items-center">
                        <img
                            :alt="slotProps.node.data.name"
                            :src="slotProps.node.data.image"
                            class="mb-4 w-12 h-12"
                        />
                        <span class="font-bold mb-2">{{
                            slotProps.node.data.name
                        }}</span>
                        <span>{{ slotProps.node.data.title }}</span>
                    </div>
                </div>
            </template>
            <template #default="slotProps">
                <span>{{ slotProps.node.label }}</span>
            </template>
        </OrganizationChart>
    </div>
</template>

<script setup>
import { ref } from "vue";
import OrganizationChart from "primevue/organizationchart";

const data = ref({
    key: "0",
    type: "person",
    styleClass: "bg-indigo-100 text-white rounded-xl",
    data: {
        image: "https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png",
        name: "Amy Elsner",
        title: "CEO",
    },
    children: [
        {
            key: "0_0",
            type: "person",
            styleClass: "bg-purple-100 text-white rounded-xl",
            data: {
                image: "https://primefaces.org/cdn/primevue/images/avatar/annafali.png",
                name: "Anna Fali",
                title: "CMO",
            },
            children: [
                {
                    label: "Sales",
                    styleClass: "bg-purple-100 text-white rounded-xl",
                },
                {
                    label: "Marketing",
                    styleClass: "bg-purple-100 text-white rounded-xl",
                },
            ],
        },
        {
            key: "0_1",
            type: "person",
            styleClass: "bg-teal-100 text-white rounded-xl",
            data: {
                image: "https://primefaces.org/cdn/primevue/images/avatar/stephenshaw.png",
                name: "Stephen Shaw",
                title: "CTO",
            },
            children: [
                {
                    label: "Development",
                    styleClass: "bg-teal-100 text-white rounded-xl",
                },
                {
                    label: "UI/UX Design",
                    styleClass: "bg-teal-100 text-white rounded-xl",
                },
            ],
        },
    ],
});
</script>
