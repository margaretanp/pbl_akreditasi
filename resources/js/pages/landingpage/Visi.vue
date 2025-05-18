<template>
    <div>
        <Navbar />

        <div
            class="p-8 max-w-3xl mx-auto flex flex-col items-center justify-center"
        >
            <h1
                class="text-3xl font-bold mb-4 text-blue-800 font-sans md:font-serif"
            >
                Visi Jurusan Teknologi Informasi
            </h1>
            <div class="mt-8 space-y-6">
                <div class="bg-gray-100 p-8 rounded-lg shadow">
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Menjadi Program Studi yang Unggul dalam Bidang Sistem
                        informasi bisnis Baik di Tingkat Nasional Maupun
                        Internasional
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
</script>

<style scoped></style>
