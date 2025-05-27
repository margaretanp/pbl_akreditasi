<script setup>
import { useRoute } from 'vue-router'
import Navbar from './components/Navbar.vue'

const route = useRoute()
</script>

<template>
  <div class="flex min-h-screen">
    <Sidebar /> <!-- Tetap fixed di kiri -->
    <div class="flex-1">
      <router-view /> <!-- Isi halaman -->
    </div>
  </div>
</template>

