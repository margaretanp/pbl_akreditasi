<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useToast } from 'vue-toast-notification';

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
    <div>This is dashboard page</div>
    
    <table class="w-full">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in usersData.data" :key="user.id">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role.name }}</td>
            </tr>
        </tbody>
    </table>
</template>
