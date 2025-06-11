<script setup>
import { onMounted } from "vue";

import Sidebar from "../../components/Sidebar.vue";
import { useCurrentUserStore } from "../../store/currentUser";

const currentUserStore = useCurrentUserStore();

onMounted(() => currentUserStore.getCurrentUser());
</script>

<template>
    <div class="h-screen w-full flex bg-gray-50">
        <Sidebar class="shrink-0" />

        <!-- Konten utama halaman -->
        <main class="min-h-screen w-full p-6 overflow-y-auto bg-gray-100">
            <!-- Tempat konten utama -->
            <router-view />
        </main>
    </div>
</template>
