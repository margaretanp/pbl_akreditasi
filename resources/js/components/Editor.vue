<template>
  <textarea
    v-model="content"
    class="w-full h-40 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 resize-y"
    placeholder="Tulis di sini..."
  ></textarea>
</template>

<script setup>
import { ref } from 'vue'

const content = ref('')
</script>

<style scoped>
textarea {
  resize: vertical;
}
</style>
