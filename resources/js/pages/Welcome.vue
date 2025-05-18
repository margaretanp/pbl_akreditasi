<script setup>
import { useRouter } from "vue-router";
import TopNavbar from "../components/TopNavbar.vue";
import Footer from "../components/Footer.vue";
import Navbar from "@/components/Navbar.vue";
import bgLogin from "../assets/bglogin3.jpg";

const $router = useRouter();

const onLogin = () => {
    $router.push({
        name: "login",
    });
};

const onGetStarted = () => {
    $router.push({
        name: "login",
    });
};
</script>

<template>
    <Navbar />

    <div
        class="w-full h-screen flex flex-col justify-center items-center bg-white/50 relative"
    >
        <!-- Background Image -->
        <img
            :src="bgLogin"
            alt=""
            class="absolute inset-0 -z-10 w-full h-screen object-cover"
        />
        <!-- Main Content -->
        <div class="text-center z-10 flex flex-col items-center px-4">
            <h1
                class="text-5xl font-bold mb-1"
                style="color: #021526"
            >
                SISTEM AKREDITASI
            </h1>
            <h1
                class="text-5xl font-bold mb-4"
                style="color: #021526"
            >
                JURUSAN TEKNOLOGI INFORMASI
            </h1>

            <p
                class="text-xl mb-8 max-w-xl text-center font-helvetica md:font-serif"
                style="color: #021526"
            >
                Akreditasi bukan hanya penilaian formal, tetapi cerminan
                kualitas institusi. Polinema terus berkomitmen meningkatkan mutu
                pendidikan, layanan, dan tata kelola untuk meraih predikat
                akreditasi terbaik demi masa depan generasi unggul.
            </p>

            <!-- Button -->
            <button
                @click="onGetStarted"
                class="bg-[#021526] text-white text-lg font-bold py-3 px-8 rounded-full hover:bg-[#03346E] transition duration-300"
            >
                GET STARTED
            </button>
        </div>
    </div>
</template>

<style scoped>
</style>
