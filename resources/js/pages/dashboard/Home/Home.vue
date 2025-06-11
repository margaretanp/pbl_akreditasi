<script setup>
import axios from "axios";
import { reactive, computed, onMounted } from "vue";

import { useRouter } from "vue-router"; // Import useRouter
import { useToast } from "vue-toast-notification";

import { downloadDocument } from "../../../helpers/download-url";

import Card from "./components/Card.vue";

import InputField from "../../../components/InputField.vue";
import Button from "../../../components/Button.vue";
import TablePlaceholder from "../../../components/TablePlaceholder.vue";
import DataEmpty from "../../../components/DataEmpty.vue";

const router = useRouter(); // Initialize router

const $toast = useToast();

const kriteria = reactive({
    data: [],
    total: 0,
    loading: false,
});

const fetchKriteria = async () => {
    if (kriteria.data.length > 0) return;

    kriteria.loading = true;

    try {
        const { data } = await axios.get("/kriteria");
        kriteria.data = data.data;
        kriteria.total = data.data.length;
    } catch (error) {
        console.error(error);
        $toast.error("Gagal menampilkan data kriteria");
    } finally {
        kriteria.loading = false;
    }
};

const totalValidated = computed(() => {
    return kriteria.data.filter((k) => {
        return (
            Array.isArray(k.validators) &&
            k.validators.length === 2 &&
            k.validators.every((v) => v.has_validated)
        );
    }).length;
});

const totalPending = computed(() => {
    return kriteria.data.filter((k) => {
        return (
            Array.isArray(k.validators) &&
            k.validators.length === 2 &&
            k.validators.some((v) => !v.has_validated)
        );
    }).length;
});

const totalRejected = computed(() => {
    return kriteria.data.filter((k) => k.is_rejected).length;
});

const onDownload = async (fileUrl) => {
    await downloadDocument(fileUrl, $toast);
};

// Format date function
const formatDate = (dateString) => {
    if (!dateString) return "-";
    const date = new Date(dateString);
    return date.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    });
};

onMounted(() => {
    fetchKriteria();
});
</script>

<template>
    <!-- Main content -->
    <div class="flex flex-col p-6 gap-y-6 rounded-lg shadow-md bg-white">
        <!-- Header -->
        <div class="space-y-4">
            <div class="space-y-1">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent"
                >
                    DASHBOARD AKREDITASI
                </h1>
                <p class="text-gray-600 text-lg">
                    Kelola dan pantau progress kriteria akreditasi Anda
                </p>
            </div>

            <hr class="text-gray-300" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <Card
                title="Jumlah Kriteria"
                :total-data="kriteria.total"
                icon="bi bi-award"
                icon-color="text-blue-500"
                icon-background="bg-blue-100"
            />

            <Card
                title="Tervalidasi"
                :total-data="totalValidated"
                icon="bi bi-check-lg"
                icon-color="text-green-500"
                icon-background="bg-green-100"
            />

            <Card
                title="Pending"
                :total-data="totalPending"
                icon="bi bi-hourglass-split"
                icon-color="text-yellow-500"
                icon-background="bg-yellow-100"
            />

            <Card
                title="Ditolak"
                :total-data="totalRejected"
                icon="bi bi-x-lg"
                icon-color="text-red-500"
                icon-background="bg-red-100"
            />
        </div>

        <div class="flex items-center flex-col lg:flex-row gap-4">
            <InputField
                id="search"
                placeholder="Cari data kriteria ..."
                class="w-full md:w-md"
            >
                <template #icon>
                    <i class="bi bi-search"></i>
                </template>
            </InputField>
        </div>

        <table v-if="!kriteria.loading && kriteria.total > 0">
            <thead class="text-gray-700">
                <tr>
                    <th class="w-12 text-center">No.</th>
                    <th>Nama Kriteria</th>
                    <th>Status</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody class="text-gray-500 font-medium">
                <tr v-for="(item, index) in kriteria.data" :key="item.id">
                    <td>{{ `${index + 1}.` }}</td>
                    <td>
                        {{ item.name }}
                    </td>
                    <td>
                        <div
                            class="py-1 px-1.5 w-fit font-normal rounded"
                            :class="{
                                'text-red-500 bg-red-50 border border-red-500':
                                    item.is_rejected,
                                'text-yellow-500 bg-yellow-50 border border-yellow-500':
                                    item.validators.every(
                                        (v) => !v.has_validated
                                    ),
                                'text-green-500 bg-green-50 border border-green-500':
                                    item.validators.every(
                                        (v) => v.has_validated
                                    ),
                            }"
                        >
                            <p>
                                {{
                                    item.is_rejected
                                        ? "Ditolak, perlu revisi"
                                        : item.validators.every(
                                              (v) => !v.has_validated
                                          )
                                        ? "Belum ada validasi"
                                        : item.validators.every(
                                              (v) => v.has_validated
                                          )
                                        ? "Tervalidasi penuh"
                                        : "Validasi belum lengkap"
                                }}
                            </p>
                        </div>
                    </td>
                    <td>
                        <Button
                            label="Preview"
                            variant="primaryOutlined"
                            icon-position="right"
                            @click="onDownload(item.merged_file_url)"
                        >
                            <template #icon>
                                <i class="bi bi-download ml-3"></i>
                            </template>
                        </Button>
                    </td>
                </tr>
            </tbody>
        </table>

        <TablePlaceholder v-else-if="kriteria.loading" />

        <DataEmpty v-else />
    </div>
</template>
