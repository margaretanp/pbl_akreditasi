<script setup>
import { useRouter } from "vue-router";
import { useI18n } from "vue-i18n";
import bgLogin from "../assets/bglogin4.mp4";
import Navbar from "../components/Navbar.vue"; // ✅ Tambahkan ini

const { t } = useI18n();
const $router = useRouter();

const onGetStarted = () => {
  $router.push({ name: "login" });
};
</script>

<template>
  <div class="w-full h-screen flex flex-col justify-center items-center relative overflow-hidden">
    <!-- ✅ Navbar -->
    <Navbar class="absolute top-0 left-0 w-full z-20" />

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

    <!-- Overlay -->
    <div class="absolute inset-0 bg-white/60 -z-10"></div>

    <!-- Main Content -->
    <div class="text-center max-w-3xl mt-20">
      <h1 class="text-5xl font-bold mt-12 mb-1 text-[#021526]">
        {{ t('title') }}
      </h1>
      <h1 class="text-5xl font-bold mb-4 text-[#021526]">
        {{ t('subtitle') }}
      </h1>

      <p class="text-xl font-bold mb-8 text-[#021526]">
        {{ t('description') }}
      </p>

      <button
        @click="onGetStarted"
        class="bg-[#021526] text-white text-lg font-bold py-3 px-8 rounded-full hover:bg-[#03346E] transition duration-300"
      >
        {{ t('get_started') }}
      </button>
    </div>
  </div>
</template>

<style scoped>
/* Tambahkan style jika diperlukan */
</style>
