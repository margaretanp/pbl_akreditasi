<script setup>
import ErrorMessages from './ErrorMessages.vue';

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    placeholder: {
        type: String,
        default: "",
    },
    min: {
        type: String,
        default: null,
    },
    max: {
        type: String,
        default: null,
    },
    modelValue: {
        type: [String, Number],
        default: "",
    },
    isError: {
        type: Boolean,
        default: false,
    },
    errors: {
        type: Array,
        default: () => [],
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    isError: {
        type: Boolean,
        default: false,
    },
    errors: {
        type: Array,
        default: () => [],
    },
});

defineEmits(["update:modelValue", "blur"]);
</script>

<template>
    <div>
        <label :for="props.id" class="font-medium text-gray-800">{{ props.label }}</label>
        <input
            :class="`mt-2 w-full px-3 py-2 border border-gray-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-offset-2 rounded-md ${
                isError
                    ? 'focus-visible:ring-red-500'
                    : 'focus-visible:ring-blue-500'
            }`"
            :id="props.id"
            :name="props.id"
            :type="props.type"
            :min="
                props.type === 'number' || props.type === 'date'
                    ? props.min
                    : null
            "
            :max="
                props.type === 'number' || props.type === 'date'
                    ? props.max
                    : null
            "
            :value="modelValue"
            :placeholder="props.placeholder"
            :disabled="props.disabled"
            @input="$emit('update:modelValue', $event.target.value)"
            @blur="$emit('blur', $event.target.value)"
        />

        <ErrorMessages v-if="isError" :errors="props.errors" />
    </div>
</template>
