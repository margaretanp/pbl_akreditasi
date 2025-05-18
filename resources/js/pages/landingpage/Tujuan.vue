<template>
    <div>
        <Navbar />

        <div
            class="p-8 max-w-3xl mx-auto flex flex-col items-center justify-center"
        >
            <h1
                class="text-3xl font-bold mb-6 text-blue-800 font-sans md:font-serif"
            >
                Misi Jurusan Teknologi Informasi
            </h1>

            <div class="mt-6 w-full">
                <div
                    class="bg-gray-100 p-8 rounded-xl shadow hover:shadow-lg transition-shadow duration-300"
                >
                    <ol
                        class="list-decimal list-inside space-y-4 text-gray-700 leading-relaxed text-justify font-sans"
                    >
                        <li>
                            Menghasilkan lulusan bidang sistem informasi bisnis
                            yang sesuai kebutuhan, beretika dan bermoral baik,
                            berpengetahuan dan berketerampilan tinggi, siap
                            bekerja dan/atau berwirausaha yang mampu bersaing
                            dalam skala nasional dan global;
                        </li>
                        <li>
                            Menghasilkan penelitian terapan bidang sistem
                            informasi bisnis yang berskala nasional dan
                            internasional, meningkatkan efektivitas, efisiensi,
                            dan produktivitas dalam dunia usaha dan industri,
                            serta mengarah pada pencapaian Hak atas Kekayaan
                            Intelektual (HaKI), perolehan paten, dan
                            kesejahteraan masyarakat;
                        </li>
                        <li>
                            Menghasilkan pengabdian kepada masyarakat yang
                            dilaksanakan melalui penerapan dan penyebarluasan
                            ilmu pengetahuan dan teknologi serta pemberian
                            layanan hasil secara profesional dalam bidang sistem
                            informasi bisnis sehingga bermanfaat secara langsung
                            dalam meningkatkan kesejahteraan masyarakat;
                        </li>
                        <li>
                            Menghasilkan sistem manajemen pendidikan bidang
                            sistem informasi bisnis yang memenuhi
                            prinsip-prinsip tata kelola yang baik;
                        </li>
                        <li>
                            Terwujudnya kerja sama yang saling menguntungkan
                            dengan berbagai pihak baik di dalam maupun di luar
                            negeri pada bidang sistem informasi bisnis untuk
                            meningkatkan daya saing.
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
