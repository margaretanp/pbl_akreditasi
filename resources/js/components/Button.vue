<script setup>
const props = defineProps({
    label: {
        type: String,
        default: "Button",
    },
})
</script>

<template>
    <button
        type="button"
        class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
    >
        {{ label }}
    </button>
</template>