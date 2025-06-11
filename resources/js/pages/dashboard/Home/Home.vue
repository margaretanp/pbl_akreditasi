<script setup>
import axios from "axios";
import { reactive, computed, onMounted } from "vue";

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

// Status counters
const statusCounts = computed(() => {
    const counts = {
        submitted: 0,
        revision: 0,
        acc1: 0,
        acc2: 0,
    };

    kriteria.data.forEach((item) => {
        switch (item.status?.toLowerCase()) {
            case "submitted":
                counts.submitted++;
                break;
            case "revision":
                counts.revision++;
                break;
            case "acc 1":
                counts.acc1++;
                break;
            case "acc 2":
                counts.acc2++;
                break;
        }
    });

    return counts;
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

// Status styling functions
const getStatusColor = (status) => {
    switch (status?.toLowerCase()) {
        case "acc 1":
            return "bg-blue-100 text-blue-800 border-blue-200";
        case "acc 2":
            return "bg-green-100 text-green-800 border-green-200";
        case "revision":
            return "bg-yellow-100 text-yellow-800 border-yellow-200";
        case "submitted":
            return "bg-purple-100 text-purple-800 border-purple-200";
        default:
            return "bg-gray-100 text-gray-800 border-gray-200";
    }
};

const getStatusIcon = (status) => {
    switch (status?.toLowerCase()) {
        case "acc 1":
            return "👍";
        case "acc 2":
            return "✅";
        case "revision":
            return "🔄";
        case "submitted":
            return "📤";
        default:
            return "📋";
    }
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
                    <th class="w-12 text-center">No.</th>
                    <th>Nama Kriteria</th>
                    <th>Pembuat</th>
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
                    <td>{{ item.validators?.created_by }}</td>
                    <td>
                        {{ item.is_rejected ? "Ditolak" : "Tervalidasi" }}
                    </td>
                    <td>{{  }}</td>
                </tr>
            </tbody>
        </table>

        <TablePlaceholder v-else-if="kriteria.loading" />

        <DataEmpty v-else />
    </div>
</template>
