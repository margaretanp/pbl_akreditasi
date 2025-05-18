<script setup>
import { useRouter } from "vue-router";
import { NButton } from "naive-ui";
import Footer from "../components/Footer.vue";

import bgLogin from "../assets/bg-login.jpg"

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
  <!-- <TopNavbar @click="onLogin" /> -->
    
    <div class="w-full h-screen max-h-screen flex flex-col justify-center items-center bg-black/50">

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

      
      <!-- Social Media Icons -->
      <div class="flex justify-center mt-8 gap-4">
        <a class="text-white-300 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
          </svg>
        </a>
        <a class="text-white-300 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
          </svg>
        </a>
        <a class="text-white-300 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
          </svg>
        </a>
      </div>
    </div>

    <!-- Footer -->
    <Footer></Footer>
  </div>
</template>

<style scoped>
/* Add CSS for background decorative elements that can be added later */
</style>
