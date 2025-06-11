<script setup>
import axios from "axios";
import { reactive, onMounted } from "vue";

import { useRouter } from "vue-router"; // Import useRouter
import { useToast } from "vue-toast-notification";

import { downloadDocument } from "../../../helpers/download-url";

import Card from "./components/Card.vue";

import InputField from "../../../components/InputField.vue";
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

const onDownload = async (fileUrl) => {
    await downloadDocument(fileUrl, $toast);
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
                title="Total Kriteria"
                :total-data="kriteria.total"
                icon="bi bi-award"
                icon-color="text-blue-500"
                icon-background="bg-blue-100"
            />

            <Card
                title="Total Kriteria"
                :total-data="kriteria.total"
                icon="bi bi-award"
                icon-color="text-blue-500"
                icon-background="bg-blue-100"
            />

            <Card
                title="Total Kriteria"
                :total-data="kriteria.total"
                icon="bi bi-award"
                icon-color="text-blue-500"
                icon-background="bg-blue-100"
            />

            <Card
                title="Total Kriteria"
                :total-data="kriteria.total"
                icon="bi bi-award"
                icon-color="text-blue-500"
                icon-background="bg-blue-100"
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
                    <th>No.</th>
                    <th>Nama Kriteria</th>
                    <th>Status</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody class="text-gray-500 font-medium">
                <tr v-for="(item, index) in kriteria.data" :key="item.id">
                    <td>{{ index + 1 }}</td>
                    <td>
                        {{ item.name }}
                    </td>
                    <td>
                        {{ item.is_rejected ? 'Ditolak' : 'Tervalidasi' }}
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <TablePlaceholder v-else-if="kriteria.loading" />

        <DataEmpty v-else />
    </div>
</template>
