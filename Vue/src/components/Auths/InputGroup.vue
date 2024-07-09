<script setup lang="ts">
const props = defineProps({
    modelValue: [String],
    label: String,
    type: {
        type: String,
        default: "text",
    },
    placeholder: String,
});

const emit = defineEmits(["update:modelValue", "change"]);
</script>

<template>
    <div class="mb-4" dir="rtl">
        <label class="mb-2.5 block font-medium text-black">{{
            props.label
        }}</label>
        <div class="relative">
            <input
                :type="props.type"
                :value="props.modelValue"
                @input="emit('update:modelValue', $event.target.value)"
                :placeholder="props.placeholder"
                class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary text-black"
            />

            <span class="absolute left-4 top-4">
                <slot></slot>
            </span>
        </div>
    </div>
</template>
