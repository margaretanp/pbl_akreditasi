<template>
  <textarea
    v-model="content"
    class="w-full h-40 p-3 border border-[#021526] rounded-md focus:outline-none focus:ring-2 focus:ring-[#03346E] resize-y"
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
