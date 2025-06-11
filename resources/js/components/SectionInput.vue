<!-- src/components/SectionInput.vue -->
<template>
  <fieldset class="border border-[#021526] p-4 rounded-md bg-white">
    <legend
      class="text-md text-white font-semibold px-2 rounded"
      style="background-color: #021526"
    >
      {{ title }}
    </legend>
    <div class="flex gap-4">
      <div class="flex-1 text-black">
        <Editor v-model="modelValue" />
      </div>
      <div class="w-1/4">
        <h2 class="text-md font-semibold mb-2 text-[#021526]">
          Pendukung {{ title }} (Upload File)
        </h2>
        <UploadFile @file-selected="onFileUpload" />
      </div>
    </div>
  </fieldset>
</template>

<script setup>
defineProps({
  title: String,
  modelValue: String,
});
const emit = defineEmits(["update:modelValue", "file-selected"]);

function onFileUpload(file) {
  emit("file-selected", file);
}
</script>
