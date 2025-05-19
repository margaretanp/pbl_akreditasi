<template>
    <div class="w-full h-screen flex-col items-center bg-white">
        
        <Navbar />
        
        <div
            class="p-8 max-w-3xl mx-auto items-center justify-center"
        >
        <br /><br />
        <br /><br />
        <br />
            <h1
                class="text-3xl font-bold mb-1 text-center"
                style="color: #021526"
            >
                MISI JURUSAN TEKNOLOGI INFORMASI
            </h1>

            <div class="mt-6 w-full">
                <div
                    class="bg-gray-100 p-8 rounded-xl shadow shadow-lg transition-shadow duration-300"
                >
                    <ol
                        class="list-decimal list-inside space-y-4 text-gray-700 leading-relaxed text-justify font-sans"
                    >
                        <li>
                            Melaksanakan pendidikan vokasi yang inovatif
                            berdasarkan pada sistem pendidikan terapan dengan
                            memanfaatkan kemajuan teknologi, sehingga mampu
                            menghasilkan lulusan yang memiliki kompetensi di
                            bidang sistem informasi bisnis dan siap bersaing di
                            tingkat nasional dan global.
                        </li>
                        <li>
                            Menyelenggarakan penelitian terapan berbasis produk
                            dan jasa bidang Sistem Informasi Bisnis.
                        </li>
                        <li>
                            Melaksanakan pengabdian masyarakat dengan
                            menggunakan kemajuan bidang Sistem Informasi Bisnis
                            untuk meningkatkan kesejahteraan.
                        </li>
                        <li>
                            Mewujudkan kerjasama yang saling menguntungkan
                            dengan berbagai pihak baik di dalam maupun di luar
                            negeri pada bidang Sistem Informasi Bisnis.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
</script>

<style scoped></style>
