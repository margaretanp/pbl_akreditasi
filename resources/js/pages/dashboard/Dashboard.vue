<script setup>
import axios from "axios";
import { onMounted, reactive } from "vue";

import Sidebar from "../../components/Sidebar.vue";
import { useCurrentUserStore } from "../../store/currentUser";

const currentUserStore = useCurrentUserStore();

onMounted(() => currentUserStore.getCurrentUser());
</script>

<template>
    <div class="h-screen bg-gray-50 flex">
        <Sidebar />

        <!-- Konten utama halaman -->
        <main class="bg-gray-50 flex-1 overflow-y-auto">
            <!-- Tempat konten utama -->
            <router-view />
        </main>
    </div>
</template>
