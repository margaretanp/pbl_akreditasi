<template>
  <div class="flex flex-col h-40">
    <!-- Hidden File Input -->
    <input
      type="file"
      class="file-input"
      ref="fileInput"
      @change="handleFileChange"
    />

    <!-- Preview File (jika ada) -->
    <div v-if="selectedFile" class="mb-1 text-sm text-gray-700">
      <span class="font-medium">Dipilih:</span> {{ selectedFile.name }}
    </div>

    <!-- Button untuk memilih file -->
    <button
      type="button"
      class="mb-1 py-1 px-2 bg-[#021526] text-white rounded hover:bg-[#03346E] transition text-sm"
      @click="triggerInput"
    >
      Choose File
    </button>

    <!-- Area klik dengan ikon, fleksibel agar tinggi tersisa -->
    <div
      class="border-dashed border-2 border-[#021526] flex-1 flex items-center justify-center cursor-pointer hover:bg-[#03346E] transition rounded-lg"
      @click="triggerInput"
    >
      <span class="text-[#021526] text-3xl select-none">+</span>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const emit = defineEmits(["file-selected"]);
const fileInput = ref(null);
const selectedFile = ref(null);

function triggerInput() {
  fileInput.value?.click();
}

function handleFileChange(event) {
  const file = event.target.files[0];
  if (file) {
    selectedFile.value = file;
    emit("file-selected", file);
  }
}
</script>

<style scoped>
.file-input {
  display: none;
}
</style>
