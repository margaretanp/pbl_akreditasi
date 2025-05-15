<script setup>
import { useRouter } from "vue-router";
import TopNavbar from "../components/TopNavbar.vue";

const $router = useRouter();

const onLogin = () => {
    $router.push({
        name: "login",
    });
};
</script>

<template>
    <TopNavbar @click="onLogin" />

    <div class="w-full h-screen flex justify-center items-center text-4xl">Welcome to home </div>
</template>
