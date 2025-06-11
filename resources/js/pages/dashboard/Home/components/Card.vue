<script setup>
const props = defineProps({
    title: {
        type: String,
        default: "Title",
    },
    totalData: {
        type: Number,
        default: 0,
    },
    icon: {
        type: String,
        default: "bi bi-question-lg",
    },
    iconColor: {
        type: String,
        default: "text-blue-500",
    },
    iconBackground: {
        type: String,
        default: "bg-blue-100",
    },
});
</script>

<template>
    <div class="p-4 rounded-md bg-white border border-gray-300">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">
                    {{ props.title }}
                </p>
                <p class="text-4xl font-bold text-gray-800">
                    {{ props.totalData }}
                </p>
            </div>

            <i
                :class="`${props.icon} ${props.iconColor} text-4xl ${props.iconBackground} p-4 rounded-full`"
            ></i>
        </div>
    </div>
</template>
