<script setup>
import { reactive, computed, ref } from "vue";
import axios from "axios";

import { useRoute } from "vue-router";
import { useToast } from "vue-toast-notification";

import TextArea from "../../components/TextArea.vue";
import UploadFile from "../../components/Uploadfile.vue";
import Button from "../../components/Button.vue";

const route = useRoute();
const $toast = useToast();

const kriteriaId = computed(() => {
    return route.params.id;
});

// Loading state
const isLoading = ref(false);

// Form data for each section
const formData = reactive({
    penetapan: {
        description: "",
        file: null,
        jenis_kriteria_id: 1,
    },
    perencanaan: {
        description: "",
        file: null,
        jenis_kriteria_id: 2,
    },
    pelaksanaan: {
        description: "",
        file: null,
        jenis_kriteria_id: 3,
    },
    evaluasi: {
        description: "",
        file: null,
        jenis_kriteria_id: 4,
    },
    peningkatan: {
        description: "",
        file: null,
        jenis_kriteria_id: 5,
    },
});

// Handle file uploads
const handleFileUpdate = (section, file) => {
    formData[section].file = file;
};

// Submit a single section
const submitSection = async (sectionKey, sectionData) => {
    try {
        const submitData = new FormData();
        submitData.append("kriteria_id", kriteriaId.value);
        submitData.append("jenis_kriteria_id", sectionData.jenis_kriteria_id);
        submitData.append("description", sectionData.description);

        if (sectionData.file) {
            submitData.append("file_url", sectionData.file);
        }

        const response = await axios.post("/detail-kriteria", submitData);

        if (response.data.status === "success") {
            $toast.success(
                `${
                    sectionKey.charAt(0).toUpperCase() + sectionKey.slice(1)
                } berhasil disimpan`
            );
            return response.data.data;
        }
    } catch (error) {
        console.error(`Error submitting ${sectionKey}:`, error);

        if (error.response?.status === 422) {
            // Validation errors
            const errors = error.response.data.errors || {};
            Object.keys(errors).forEach((key) => {
                errors[key].forEach((message) => {
                    $toast.error(message);
                });
            });
        } else if (error.response?.status === 403) {
            $toast.error("Anda tidak memiliki izin untuk menyimpan data ini");
        } else {
            $toast.error(
                `Gagal menyimpan ${sectionKey}: ${
                    error.response?.data?.message || error.message
                }`
            );
        }
        throw error;
    }
};

// Submit all sections
const submitAllSections = async () => {
    isLoading.value = true;

    try {
        const submissions = [];

        // Submit each section that has data
        for (const [sectionKey, sectionData] of Object.entries(formData)) {
            if (sectionData.description.trim() || sectionData.file) {
                submissions.push(submitSection(sectionKey, sectionData));
            }
        }

        if (submissions.length === 0) {
            $toast.error("Tidak ada data untuk disimpan");
            return;
        }

        // Wait for all submissions to complete
        const results = await Promise.allSettled(submissions);

        const successful = results.filter(
            (result) => result.status === "fulfilled"
        ).length;
        const failed = results.filter(
            (result) => result.status === "rejected"
        ).length;

        if (successful > 0) {
            $toast.success(`${successful} section berhasil disimpan`);
        }

        if (failed > 0) {
            $toast.error(`${failed} section gagal disimpan`);
        }

        // Reset form if all successful
        if (failed === 0) {
            resetForm();
        }
    } catch (error) {
        console.error("Error in bulk submission:", error);
        $toast.error("Terjadi kesalahan saat menyimpan data");
    } finally {
        isLoading.value = false;
    }
};

// Reset form
const resetForm = () => {
    Object.keys(formData).forEach((key) => {
        formData[key].text = "";
        formData[key].file = null;
    });
};

// Load existing data (optional)
// const loadExistingData = async () => {
//     try {
//         const response = await axios.get(
//             `/api/detail-kriteria?kriteria_id=${kriteriaId.value}`,
//             {
//                 headers: {
//                     Authorization: `Bearer ${localStorage.getItem("token")}`,
//                 },
//             }
//         );

//         if (response.data.status === "success") {
//             // Map existing data back to form
//             response.data.data.forEach((item) => {
//                 const sectionMap = {
//                     1: "penetapan",
//                     2: "perencanaan",
//                     3: "pelaksanaan",
//                     4: "evaluasi",
//                     5: "peningkatan",
//                 };

//                 const section = sectionMap[item.jenis_kriteria_id];
//                 if (section && formData[section]) {
//                     formData[section].text = item.deskripsi || "";
//                 }
//             });
//         }
//     } catch (error) {
//         console.error("Error loading existing data:", error);
//     }
// };

// onMounted(() => {
//     loadExistingData();
// });
</script>

<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-auto space-y-6">
            <h2
                class="text-base md:text-5xl font-bold text-[#021526] font-poopins"
            >
                {{ `Kriteria ${kriteriaId}` }}
            </h2>

            <!-- Penetapan -->
            <fieldset class="border border-[#021526] p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #021526"
                >
                    Penetapan
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1 text-black">
                        <TextArea v-model="formData.penetapan.description" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2 text-[#021526]">
                            Pendukung Penetapan (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="
                                (file) => handleFileUpdate('penetapan', file)
                            "
                            accept=".pdf,.jpg,.jpeg,.png,.gif,.bmp,.txt"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Perencanaan -->
            <fieldset class="border border-[#021526] p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #021526"
                >
                    Perencanaan
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1 text-black">
                        <TextArea v-model="formData.perencanaan.description" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2 text-[#021526]">
                            Pendukung Perencanaan (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="
                                (file) => handleFileUpdate('perencanaan', file)
                            "
                            accept=".pdf,.jpg,.jpeg,.png,.gif,.bmp,.txt"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Pelaksanaan -->
            <fieldset class="border border-[#021526] p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #021526"
                >
                    Pelaksanaan
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1 text-black">
                        <TextArea v-model="formData.pelaksanaan.description" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2 text-[#021526]">
                            Pendukung Pelaksanaan (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="
                                (file) => handleFileUpdate('pelaksanaan', file)
                            "
                            accept=".pdf,.jpg,.jpeg,.png,.gif,.bmp,.txt"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Evaluasi -->
            <fieldset class="border border-[#021526] p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #021526"
                >
                    Evaluasi
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1 text-black">
                        <TextArea v-model="formData.evaluasi.description" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2 text-[#021526]">
                            Pendukung Evaluasi (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="
                                (file) => handleFileUpdate('evaluasi', file)
                            "
                            accept=".pdf,.jpg,.jpeg,.png,.gif,.bmp,.txt"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Peningkatan -->
            <fieldset class="border border-[#021526] p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #021526"
                >
                    Peningkatan
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1 text-black">
                        <TextArea v-model="formData.peningkatan.description" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2 text-[#021526]">
                            Pendukung Peningkatan (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="
                                (file) => handleFileUpdate('peningkatan', file)
                            "
                            accept=".pdf,.jpg,.jpeg,.png,.gif,.bmp,.txt"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Action Buttons -->
            <div class="flex gap-4 justify-end">
                <Button
                    @click="resetForm"
                    type="button"
                    variant="primaryOutlined"
                    size="normal"
                    :disabled="isLoading"
                    class="px-6 py-2 border border-[#021526] text-[#021526] rounded hover:bg-gray-50 disabled:opacity-50"
                >
                    Reset
                </Button>
                <Button @click="submitAllSections" :disabled="isLoading">
                    <span v-if="isLoading" class="animate-spin">⏳</span>
                    {{ isLoading ? "Menyimpan..." : "Simpan Semua" }}
                </Button>
            </div>
        </div>
    </div>
</template>
