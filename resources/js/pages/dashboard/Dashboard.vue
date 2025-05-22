<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useToast } from 'vue-toast-notification';
import Sidebar from '../../components/Sidebar.vue';

const $toast = useToast();

const usersData = reactive({
    data: [],
    loading: false,
});

const fetchUserData = async () => {
    if (usersData.data.length > 0) return;
    usersData.loading = true;

    try {
        const { data} = await axios.get('/users');
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
    <div class="h-screen bg-gray-50 flex">
         <Sidebar />
        
        <main class="p-8">
            <router-view />
        </main>
    </div>
</template>
