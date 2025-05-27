<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useToast } from 'vue-toast-notification';

import Sidebar from '../../components/Sidebar.vue';
import Navbar from '../../components/Navbar.vue'; // Tambahkan ini

const $toast = useToast();

const usersData = reactive({
    data: [],
    loading: false,
});

const fetchUserData = async () => {
    if (usersData.data.length > 0) return;
    usersData.loading = true;

    try {
        const { data } = await axios.get('/users');
        if (data.status === 'success') {
            usersData.data = data.data;
        } else {
            throw new Error(data.message || 'Failed to fetch user data');
        }
    } catch (error) {
        console.error(error);
        $toast.error("Gagal memuat data pengguna");
    } finally {
        usersData.loading = false;
    }
};

onMounted(fetchUserData);
</script>

<template>
  <div class="flex min-h-screen">
    <!-- Sidebar fixed -->
    <Sidebar />

    <!-- Konten utama -->
    <div class="flex-1 flex flex-col">
      <!-- Navbar di bagian atas -->
      <Navbar />

      <!-- Konten utama halaman -->
      <main class="bg-gray-50 flex-1 overflow-y-auto">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4">
          Dashboard / Dashboard
        </h1>

        <!-- Tempat konten utama -->
        <router-view />
      </main>
    </div>
  </div>
</template>
