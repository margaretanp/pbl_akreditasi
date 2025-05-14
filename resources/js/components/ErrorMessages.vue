<script setup>
const props = defineProps({
    errors: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <ul class="flex flex-col gap-y-1 text-sm text-red-500">
        <li v-for="e of errors" :key="e.$uid">
            {{ e.$message }}
        </li>
    </ul>
</template>
