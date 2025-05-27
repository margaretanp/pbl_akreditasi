<template>
  <navbar/>
  <div class="w-full min-h-screen flex-col items-center bg-white">

    <div class="p-8 max-w-3xl mx-auto items-center justify-center pt-24">
      <h1 class="text-4xl font-bold mb-1 text-center" style="color: #021526">
        {{ t('menu.profil') }}
      </h1>
      <h2 class="text-2xl font-bold mb-4 text-center" style="color: #021526">
        {{ t('profil.subtitle') }}
      </h2>

      <div class="mt-8 space-y-6 w-full">
        <div class="bg-gray-100 p-8 rounded-xl shadow-lg transition-shadow duration-300">
          <p class="text-gray-700 leading-relaxed text-justify font-sans">
            {{ t('profil.description') }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>

<style scoped></style>
