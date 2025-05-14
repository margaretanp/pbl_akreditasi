<script setup>
const emit = defineEmits(["click"]);
</script>

<template>
    <div
        class="sticky top-0 w-full flex justify-end items-center p-6 bg-white shadow-md"
    >
        <button type="button" class="px-4 py-2 bg-black text-white text-md font-medium rounded-lg cursor-pointer" @click="emit('click')">Login</button>
    </div>
</template>
