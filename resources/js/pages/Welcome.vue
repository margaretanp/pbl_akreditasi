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

    <!-- Overlay untuk gelapkan video (opsional) -->
    <div class="absolute inset-0 bg-white/20 -z-10"></div>

    <!-- Main Content -->
    <div class="text-center max-w-3xl">
      <h1 class="text-5xl font-bold mt-12 mb-1 text-[#021526]">
        SISTEM AKREDITASI
      </h1>
      <h1 class="text-5xl font-bold mb-4 text-[#021526]">
        JURUSAN TEKNOLOGI INFORMASI
      </h1>

      <p class="text-xl font-bold mb-8 text-[#021526]">
        Akreditasi bukan hanya penilaian formal, tetapi cerminan kualitas institusi. Polinema terus berkomitmen meningkatkan mutu pendidikan, layanan, dan tata kelola untuk meraih predikat akreditasi terbaik demi masa depan generasi unggul.
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
