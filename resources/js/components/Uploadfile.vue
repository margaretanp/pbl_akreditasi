<script setup>
import { ref } from "vue";

import Button from "./Button.vue";

const emit = defineEmits(["file-selected"]);
const fileInput = ref(null);
const selectedFile = ref(null);

const triggerInput = () => {
    fileInput.value?.click();
};

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedFile.value = file;
        emit("file-selected", file);
    }
};
</script>

<template>
    <div class="flex flex-col h-40">
        <!-- Hidden File Input -->
        <input
            type="file"
            class="hidden"
            ref="fileInput"
            @change="handleFileChange"
        />

        <!-- Button untuk memilih file -->
        <Button label="Choose File" type="button" @click="triggerInput" />

        <!-- Preview File (jika ada) -->
        <div v-if="selectedFile" class="mb-1 text-sm text-gray-700">
            <span class="font-medium">Dipilih:</span> {{ selectedFile.name }}
        </div>
    </div>
</template>
