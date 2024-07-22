<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10 mr-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-20"
                enter-to="opacity-50"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/25"></div>
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            dir="rtl"
                            class="w-full max-w-4xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <DialogTitle
                                as="h3"
                                class="text--header flex items-end"
                            >
                                <span
                                    class="border-b text-xl border-block w-full text-start mb-2 mr-3 p-2"
                                >
                                    {{ title }}
                                </span>
                            </DialogTitle>
                            <div
                                class="mt-6 flex items-center justify-center mb-4"
                            >
                                <!-- form area -->
                                <slot></slot>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
    closeModal: {
        type: Function,
        required: true,
    },

    title: {
        type: String,
        required: true,
    },
});
</script>
