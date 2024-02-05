<template>
    <div>
        <label class="sr-only">{{ label }}</label>
        <div class="mt-1 flex shadow rounded-md">
            <span v-if="prepend"
                class="inline-flex items-center px-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                {{ prepend }}
            </span>
            <template v-else-if="type === 'select'">
                <select dir="ltr" :id="id" :value="props.modelValue" @change="onChange($event.target.value)"
                    :required="required" :name="name" :class="inputClasses">
                    <option value="" disabled selected class="flex items-center justify-between float-end"> انتخاب
                        {{
                            label
                        }}
                    </option>
                    <option v-for="option in selectOptions" :value="option.key" :key="option">
                        {{ option.text }}
                    </option>
                </select>
            </template>
            <template v-else-if="type === 'textarea'">
                <textarea :type="type" :id="id" :required="required" :class="inputClasses" :name="name"
                    :value="props.modelValue" @input="emit('update:modelValue', $event.target.value)">
                </textarea>
            </template>
            <template v-else-if="type === 'file'">
                <input :type="type" :id="id" :required="required" @input="emit('change', $event.target.files[0])"
                    :class="inputClasses" :name="name" :value="props.modelValue">
            </template>
            <template v-else-if="type === 'checkbox'">
                <input :type="type" :id="id" :value="props.modelValue"
                    @input="emit('update:modelValue', $event.target.value)" :class="inputClasses">
            </template>
            <template v-else>
                <input :type="type" :name="name" :required="required" :value="props.modelValue"
                    @input="emit('update:modelValue', $event.target.value)" :class="inputClasses" :placeholder="label"
                    step="0.01" />
            </template>
            <span v-if="append"
                class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                {{ append }}
            </span>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue"


const props = defineProps({

    modelValue: [String, File, Number],
    label: String,
    type: {
        type: String,
        default: 'text'
    },

    name: String,
    required: Boolean,
    prepend: {
        type: String,
        default: ''
    },
    append: {
        type: String,
        default: ''
    },

    selectOptions: Array,
})


const id = computed(() => {
    if (props.id) return props.id;
    return `id-${Math.floor(1000000 + Math.random() * 1000000)}`;
})


const inputClasses = computed(() => {
    const cls = [
        `block w-full px-3 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm`,
    ];
    if (props.append && !props.prepend) {
        cls.push(`rounded-l-md`)
    } else if (props.prepend && !props.append) {
        cls.push(`rounded-r-md`)
    } else if (!props.prepend && !props.append) {
        cls.push('rounded-md')
    }
    return cls.join(' ');
})

const emit = defineEmits(['update:modelValue', 'change'])

function onChange(value) {
    emit('update:modelValue', value)
    emit('change', value)
}

</script>
