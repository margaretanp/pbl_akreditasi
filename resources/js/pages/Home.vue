<script setup>
import { useRouter } from "vue-router";
import TopNavbar from "../components/TopNavbar.vue";
import Footer from "../components/Footer.vue";
import Navbar from "@/components/Navbar.vue";
import bgLogin from "../assets/bgLogin.png";

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
            class="absolute inset-0 -z-10 w-full h-full object-cover"
        />
        <!-- Main Content -->
        <div class="text-center z-10 flex flex-col items-center px-4">
            <h1
                class="text-5xl font-bold mb-4 font-sans md:font-serif"
                style="color: #12086f"
            >
                SISTEM AKREDITASI
            </h1>
            <h1
                class="text-5xl font-bold mb-4 font-sans md:font-serif"
                style="color: #12086f"
            >
                JURUSAN TEKNOLOGI INFORMASI
            </h1>

            <p
                class="text-xl mb-8 text-gray-700 max-w-xl text-center font-sans md:font-serif"
            >
                Akreditasi bukan hanya penilaian formal, tetapi cerminan
                kualitas institusi. Polinema terus berkomitmen meningkatkan mutu
                pendidikan, layanan, dan tata kelola untuk meraih predikat
                akreditasi terbaik demi masa depan generasi unggul.
            </p>

            <!-- Button -->
            <button
                @click="onGetStarted"
                class="bg-white text-[#4361ee] text-lg font-bold py-3 px-8 rounded-full hover:bg-blue-100 transition duration-300"
            >
                GET STARTED
            </button>

            <!-- Social Media Icons -->
            <div class="flex justify-center mt-8 gap-4">
                <a class="text-gray-400 hover:text-white transition-colors">
                    <!-- Twitter SVG -->
                </a>
                <a class="text-gray-400 hover:text-white transition-colors">
                    <!-- YouTube SVG -->
                </a>
                <a class="text-gray-400 hover:text-white transition-colors">
                    <!-- Facebook SVG -->
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <Footer />
</template>

<style scoped>
/* Add CSS for background decorative elements that can be added later */
</style>
