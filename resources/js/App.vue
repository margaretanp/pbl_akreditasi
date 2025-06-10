<script setup>
import { useRoute } from "vue-router";
import Navbar from "./components/Navbar.vue";

const route = useRoute();
</script>

<template>
    <div>
        <div>
            <router-view />
        </div>
    </div>
</template>
