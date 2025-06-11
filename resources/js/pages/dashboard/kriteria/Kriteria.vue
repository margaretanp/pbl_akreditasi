<script setup>
import { reactive, computed, ref } from "vue";
import axios from "axios";

import { useRoute } from "vue-router";
import { useToast } from "vue-toast-notification";

import DetailKriteriaForm from "../../../components/DetailKriteriaForm.vue";
import Button from "../../../components/Button.vue";
import Spinner from "../../../components/Spinner.vue";

const route = useRoute();
const $toast = useToast();

const kriteriaId = computed(() => {
    return route.params.id;
});

// Loading state
const isLoading = ref(false);

// Criteria configuration
const criteriaConfig = [
    {
        key: "penetapan",
        title: "Penetapan",
        jenis_criteria_id: 1,
    },
    {
        key: "perencanaan",
        title: "Perencanaan",
        jenis_criteria_id: 2,
    },
    {
        key: "pelaksanaan",
        title: "Pelaksanaan",
        jenis_criteria_id: 3,
    },
    {
        key: "evaluasi",
        title: "Evaluasi",
        jenis_criteria_id: 4,
    },
    {
        key: "peningkatan",
        title: "Peningkatan",
        jenis_criteria_id: 5,
    },
];

// Form data for each section
const formData = reactive({
    penetapan: {
        description: "",
        file: null,
        jenis_criteria_id: 1,
    },
    perencanaan: {
        description: "",
        file: null,
        jenis_criteria_id: 2,
    },
    pelaksanaan: {
        description: "",
        file: null,
        jenis_criteria_id: 3,
    },
    evaluasi: {
        description: "",
        file: null,
        jenis_criteria_id: 4,
    },
    peningkatan: {
        description: "",
        file: null,
        jenis_criteria_id: 5,
    },
});

// Handle description updates
const handleDescriptionUpdate = (sectionKey, value) => {
    formData[sectionKey].description = value;
};

// Handle file uploads
const handleFileUpdate = (sectionKey, file) => {
    formData[sectionKey].file = file;
};

// Submit a single section
const submitSection = async (sectionKey, sectionData) => {
    try {
        const submitData = new FormData();
        submitData.append("criteria_id", kriteriaId.value);
        submitData.append("jenis_criteria_id", sectionData.jenis_criteria_id);
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
            $toast.success(`${successful} detail kriteria berhasil disimpan`);
        }

        if (failed > 0) {
            $toast.error(`${failed} detail kriteria gagal disimpan`);
        }

        // Reset form if all successful
        if (failed === 0) {
            resetForm();

            $toast.success(
                "Semua data berhasil disimpan. Menggabungkan dokumen..."
            );
            try {
                await axios.post(`/kriteria/${kriteriaId.value}/merge`);
                $toast.success("File berhasil digabung dan disimpan");
                resetForm();
            } catch (mergeError) {
                console.error("Error merging file:", mergeError);
                $toast.error("Gagal menggabungkan file");
            }
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
        formData[key].description = "";
        formData[key].file = null;
    });
};
</script>

<template>
    <!-- Content wrapper -->
    <div class="min-h-screen p-4 bg-gray-100">
        <!-- Main Content -->
        <div class="flex flex-col p-6 gap-y-6 bg-white rounded-lg shadow-md">
            <div class="space-y-2">
                <h3
                    class="text-base md:text-4xl font-semibold md:font-bold text-slate-900"
                >
                    {{ `Kriteria ${kriteriaId}` }}
                </h3>
                <hr class="text-gray-300" />
            </div>

            <div class="flex flex-col gap-y-4">
                <!-- Dynamic Criteria Sections -->
                <DetailKriteriaForm
                    v-for="criteria in criteriaConfig"
                    :key="criteria.key"
                    :title="criteria.title"
                    :description="formData[criteria.key].description"
                    @update:description="
                        (value) => handleDescriptionUpdate(criteria.key, value)
                    "
                    @file-selected="
                        (file) => handleFileUpdate(criteria.key, file)
                    "
                />
            </div>

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
                <Button
                    :label="isLoading ? 'Menyimpan ...' : 'Simpan'"
                    icon-position="left"
                    @click="submitAllSections"
                    :disabled="isLoading"
                >
                    <template #icon>
                        <Spinner v-if="isLoading" class="mr-3" />
                    </template>
                </Button>
            </div>
        </div>
    </div>
</template>
