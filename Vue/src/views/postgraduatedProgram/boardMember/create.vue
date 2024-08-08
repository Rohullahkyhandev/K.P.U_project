<template>
    <div class="form--padding--top">
        <form @submit.prevent="onSubmit">
            <div>
                <!-- display message area -->
                <div class="msg--success" v-if="boardMemberStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="boardMemberStore.msg_success = ''"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18 18 6M6 6l12 12"
                                />
                            </svg>
                        </div>
                        <div>
                            <span>{{ boardMemberStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="boardMemberStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="boardMemberStore.msg_wrang = ''"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18 18 6M6 6l12 12"
                                />
                            </svg>
                        </div>
                        <div>
                            <span>{{ boardMemberStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            نام <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="boardMember.name"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            تخلص<span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="boardMember.lname"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            نام پدر
                            <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="boardMember.fname"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                شماره تماس
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="boardMember.phone"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="wrapper--dev--input">
                            <div class="label--dev--width">
                                <label for="" class="form--label">
                                    ادرس ایمل
                                    <span class="label--prefix">*</span></label
                                >
                            </div>
                            <div class="input--dev--width">
                                <CustomInput
                                    type="text"
                                    v-model="boardMember.email"
                                    class="mb-2"
                                    required="required"
                                />
                            </div>
                        </div>

                        <div class="wrapper--dev--input">
                            <div class="label--dev--width">
                                <label for="" class="form--label">
                                    ادرس
                                    <span class="label--prefix">*</span></label
                                >
                            </div>
                            <div class="input--dev--width">
                                <CustomInput
                                    type="textarea"
                                    v-model="boardMember.address"
                                    class="mb-2"
                                    required="required"
                                />
                            </div>
                        </div>

                        <div class="wrapper--dev--input">
                            <div class="label--dev--width">
                                <label for="" class="form--label">
                                    بورد
                                    <span class="label--prefix">*</span></label
                                >
                            </div>
                            <div class="input--dev--width">
                                <CustomInput
                                    type="select"
                                    :select-options="boards"
                                    v-model="boardMember.board_id"
                                    class="mb-2"
                                    required="required"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="bg-gray-100 py-4 md:flex gap-5">
                    <button
                        type="submit"
                        :class="[
                            boardMemberStore.loading === true
                                ? 'footer--button--submit cursor-not-allowed'
                                : 'footer--button--submit cursor-pointer rounded ',
                        ]"
                    >
                        <span v-if="boardMemberStore.loading === true">
                            <svg
                                class="animate-spin -ml-1 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                        </span>
                        <span v-else> ثبت </span>
                    </button>
                    <button @click="closeModal" class="footer--button--cancel">
                        لغو ثبت
                    </button>
                </footer>
            </div>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import CustomInput from "../../../components/core/CustomInput.vue";
import useBoradMemberStore from "../../../stores/postgraduatedPrograms/boardMemberStore";

const boardMemberStore = useBoradMemberStore();

const props = defineProps({
    closeModal: {
        type: Function,
        required: true,
    },
});

const boardMember = computed(() => boardMemberStore.boardMember);

onMounted(() => {
    boardMemberStore.getAllBoard();
});

const boards = computed(() =>
    boardMemberStore.boardList.map((board) => ({
        key: board.id,
        text: board.name,
    }))
);

function onSubmit() {
    boardMemberStore.createBoardMember(boardMember.value);

    // for refreshing the page
    boardMemberStore.getBoardMember();
}
</script>
