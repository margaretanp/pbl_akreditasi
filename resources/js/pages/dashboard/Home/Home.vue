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
        const { data } = await axios.get("kriteria");
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
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100"
    >
        <div class="bg-white shadow-lg border-b-4 border-indigo-500">
            <div class="px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-2">
                            <span
                                class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent"
                            >
                                DASHBOARD AKREDITASI
                            </span>
                        </h1>
                        <p class="text-gray-600 text-lg">
                            Kelola dan pantau progress kriteria akreditasi Anda
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">
                                Total Kriteria
                            </p>
                            <p class="text-3xl font-bold text-gray-800">
                                {{ kriteria.total }}
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg
                                class="w-6 h-6 text-blue-600"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-400 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">
                                ACC 1
                            </p>
                            <p class="text-3xl font-bold text-blue-600">
                                {{ statusCounts.acc1 }}
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <span class="text-xl">👍</span>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">
                                ACC 2
                            </p>
                            <p class="text-3xl font-bold text-green-600">
                                {{ statusCounts.acc2 }}
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <span class="text-xl">✅</span>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">
                                Submitted
                            </p>
                            <p class="text-3xl font-bold text-purple-600">
                                {{ statusCounts.submitted }}
                            </p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <span class="text-xl">📤</span>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">
                                Revision
                            </p>
                            <p class="text-3xl font-bold text-yellow-600">
                                {{ statusCounts.revision }}
                            </p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <span class="text-xl">🔄</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input
                                type="text"
                                placeholder="🔍 Cari kriteria, dosen, status, atau komentar..."
                                class="w-full pl-12 pr-4 py-3 text-lg text-black border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300"
                            />
                            <svg
                                class="absolute left-4 top-4 w-5 h-5 text-gray-400"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-full md:w-64">
                        <select
                            class="w-full px-4 py-3 text-lg text-black border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300"
                        >
                            <option value="semua">📋 Semua Status</option>
                            <option value="acc 1">👍 ACC 1</option>
                            <option value="acc 2">✅ ACC 2</option>
                            <option value="revision">🔄 Revision</option>
                            <option value="submitted">📤 Submitted</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full" v-if="kriteria.total > 0">
                        <thead
                            class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200"
                        >
                            <tr>
                                <th
                                    class="text-left p-6 font-semibold text-gray-700 text-lg"
                                >
                                    ID
                                </th>
                                <th
                                    class="text-left p-6 font-semibold text-gray-700 text-lg"
                                >
                                    Nama Dosen
                                </th>
                                <th
                                    class="text-left p-6 font-semibold text-gray-700 text-lg"
                                >
                                    Nama Kriteria
                                </th>
                                <th
                                    class="text-left p-6 font-semibold text-gray-700 text-lg"
                                >
                                    Tanggal Submit
                                </th>
                                <th
                                    class="text-left p-6 font-semibold text-gray-700 text-lg"
                                >
                                    Status
                                </th>
                                <th
                                    class="text-center p-6 font-semibold text-gray-700 text-lg"
                                >
                                    File
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(item, index) in kriteria.data"
                                :key="item.id"
                                class="border-b border-gray-100 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300"
                                :style="{ animationDelay: index * 50 + 'ms' }"
                            >
                                <td class="p-6">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold"
                                    >
                                        {{ index + 1 }}
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ item.lecturer_name?.charAt(0) || 'D' }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-base">
                                                {{ item.lecturer_name || 'Dr. John Doe' }}
                                            </p>
                                            <p class="text-sm text-gray-500">Dosen</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <p class="font-semibold text-gray-800 text-lg">
                                        {{ item.name }}
                                    </p>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg">📅</span>
                                        <span class="text-gray-700 font-medium">
                                            {{ formatDate(item.submission_date) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <span
                                        :class="getStatusColor(item.status)"
                                        class="px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center gap-2 border"
                                    >
                                        <span class="text-lg">{{
                                            getStatusIcon(item.status)
                                        }}</span>
                                        {{ item.status || 'Submitted' }}
                                    </span>
                                </td>
                                <td class="p-6 text-center">
                                    <button
                                        @click="onDownload(item.merged_file_url)"
                                        class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300"
                                    >
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Download
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center py-16" v-else-if="!kriteria.loading">
                        <div class="text-6xl mb-4">🔍</div>
                        <p class="text-xl text-gray-500 mb-2">
                            Tidak ada data yang ditemukan
                        </p>
                        <p class="text-gray-400">
                            Coba ubah kata kunci pencarian atau filter status
                        </p>
                    </div>

                    <div class="text-center py-16" v-else>
                        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
                        <p class="text-lg text-gray-500 mt-4">Memuat data...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

tbody tr {
    animation: fadeIn 0.5s ease-out forwards;
}
</style>
