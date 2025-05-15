<script setup>
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
});

defineEmits(["update:modelValue", "blur"]);
</script>

<template>
    <div>
        <label :for="props.id">{{ props.label }}</label>
        <input
            :type="props.type"
            :id="props.id"
            :name="props.id"
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
            :class="`mt-2 w-full px-3 py-2 border border-gray-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-offset-2 rounded-md ${
                isError
                    ? 'focus-visible:ring-red-500'
                    : 'focus-visible:ring-blue-500'
            }`"
        />
    </div>
</template>
