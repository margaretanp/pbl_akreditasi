<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import TopNavbar from "../components/TopNavbar.vue";
import axios from "axios";

const $router = useRouter();

const onLogin = () => {
    $router.push({
        name: "login",
    });
};

const users = ref({
    data: [],
    loading: false,
})

const fetchData = async () => {
    if (users.value.data.length) return;
    users.value.loading = true;

    try {
        const { data} = await axios.get("/api/users");

        users.value.data = data.data;
    } catch (error) {
        console.error("Error fetching users:", error);
    } finally {
        users.value.loading = false;
    }
}

onMounted(() => {
    fetchData();
});
</script>

<template>
    <TopNavbar @click="onLogin" />

    <div v-for="d of users.data">
        <div class="flex flex-col gap-y-2">
            <h1 class="text-2xl font-bold text-gray-800">{{ d.name }}</h1>
            <p class="text-gray-600">{{ d.email }}</p>
            <p>{{ d.role.name }}</p>
            <p>{{ d.role.code }}</p>
        </div>
    </div>

</template>
