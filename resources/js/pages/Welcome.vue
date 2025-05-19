<script setup>
import { useRouter } from "vue-router";
import { NButton } from "naive-ui";
import Footer from "../components/Footer.vue";
import Navbar from "@/components/Navbar.vue";
import bgLogin from "../assets/bglogin4.mp4"; // Video background

const $router = useRouter();

const onLogin = () => {
    $router.push({ name: "login" });
};

const onGetStarted = () => {
    $router.push({ name: "login" });
};
</script>

<template>
    <Navbar />

<<<<<<< HEAD
    <div class="w-full h-screen flex flex-col justify-center items-center relative overflow-hidden">
        <!-- VIDEO Background -->
        <video
            autoplay
            muted
            loop
            playsinline
            class="absolute inset-0 w-full h-full object-cover -z-10"
        >
            <source :src="bgLogin" type="video/mp4" />
        </video>
=======
        <img :src="bgLogin" alt="" class="absolute isolated -z-10 w-full h-full object-cover object-center">
    <!-- Main Content -->
    <div class="text-center z-10">
      <h1 class="text-5xl font-bold mb-4 text-white">AKREDITASI</h1>
      <p class="text-xl mb-8 text-white-200 max-w-xl">
        Akreditasi bukan hanya penilaian formal, tetapi cerminan kualitas institusi. Polinema terus berkomitmen meningkatkan mutu pendidikan, layanan, dan tata kelola untuk meraih predikat akreditasi terbaik demi masa depan generasi unggul.
      </p>
      <n-button
      type="info"
       size="large"
       round
        @click="onGetStarted"
        class="bg-white text-blue-700 text-lg font-bold py-3 px-8 rounded-full hover:bg-blue-100 transition duration-300">GET STARTED</n-button>
>>>>>>> feat/landingpage

        <!-- Overlay (opsional buat lebih gelap biar teks kelihatan) -->
        <div class="absolute inset-0 bg-white/20 -z-10"></div>

        <!-- Main Content -->
        <div class="text-center z-10 flex flex-col items-center px-4">
            <h1 class="text-5xl font-bold mb-1 text-[#021526]">
                SISTEM AKREDITASI
            </h1>
            <h1 class="text-5xl font-bold mb-4 text-[#021526]">
                JURUSAN TEKNOLOGI INFORMASI
            </h1>

            <p class="text-xl mb-8 max-w-xl font-helvetica md:font-serif text-[#021526]">
                Akreditasi bukan hanya penilaian formal, tetapi cerminan
                kualitas institusi. Polinema terus berkomitmen meningkatkan mutu
                pendidikan, layanan, dan tata kelola untuk meraih predikat
                akreditasi terbaik demi masa depan generasi unggul.
            </p>

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
