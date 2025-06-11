<script setup>
import axios from "axios";
import { ref, computed, defineEmits, reactive, onMounted } from "vue";
import { useRouter } from "vue-router"; // Import useRouter
import { useCurrentUserStore } from "../../../store/currentUser";
import { useToast } from "vue-toast-notification";

const router = useRouter(); // Initialize router

const $toast = useToast();

const currentUser = useCurrentUserStore();
const userId = computed(() => currentUser.currentUser.name);

const kriteria = reactive({
    data: [],
    total: 0,
    loading: false,
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
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">
                                Submitted
                            </p>
                            <p class="text-3xl font-bold text-green-600">
                                {{}}
                            </p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg
                                class="w-6 h-6 text-green-600"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-gray-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">
                                Draft
                            </p>
                            <p class="text-3xl font-bold text-gray-600">{{}}</p>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-full">
                            <svg
                                class="w-6 h-6 text-gray-600"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                                ></path>
                                <path
                                    fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
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
                                {{}}
                            </p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <svg
                                class="w-6 h-6 text-yellow-600"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
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
                                placeholder="🔍 Cari kriteria, status, atau komentar..."
                                class="w-full pl-12 pr-4 py-3 text-lg border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300"
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
                            class="w-full px-4 py-3 text-lg border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300"
                        >
                            <option value="semua">📋 Semua Status</option>
                            <option value="Submitted">✅ Submitted</option>
                            <option value="Draft">📝 Draft</option>
                            <option value="Revision">🔄 Revision</option>
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
                                    Nama Kriteria
                                </th>
                                <th
                                    class="text-left p-6 font-semibold text-gray-700 text-lg"
                                >
                                    File
                                </th>
                                <!--<th
                                    class="text-left p-6 font-semibold text-gray-700 text-lg"
                                >
                                    Status
                                </th>
                                <th
                                    class="text-left p-6 font-semibold text-gray-700 text-lg"
                                >
                                    Komentar
                                </th>
                                <th
                                    class="text-center p-6 font-semibold text-gray-700 text-lg"
                                >
                                    Aksi
                                </th> -->
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
                                    <p
                                        class="font-semibold text-gray-800 text-lg"
                                    >
                                        {{ item.name }}
                                    </p>
                                </td>
                                <!-- <td class="p-6">
                                    <span
                                        :class="getStatusColor(item.status)"
                                        class="px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center gap-2 border"
                                    >
                                        <span class="text-lg">{{
                                            getStatusIcon(item.status)
                                        }}</span>
                                        {{ item.status }}
                                    </span>
                                </td> -->
                                <!-- <td class="p-6">
                                    <template
                                        v-if="
                                            item.status ===
                                                StatusEnum.REVISION &&
                                            item.komentar
                                        "
                                    >
                                        <button
                                            @click="
                                                openKomentarModal(item.komentar)
                                            "
                                            class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300"
                                        >
                                            💬 Lihat Komentar
                                        </button>
                                    </template>
                                    <template v-else>
                                        <span class="text-gray-400 text-lg"
                                            >-</span
                                        >
                                    </template>
                                </td> -->
                                <!-- <td class="p-6">
                                    <div class="flex gap-3 justify-center">
                                        <button
                                            @click="onEdit(item)"
                                            :disabled="
                                                item.status ===
                                                StatusEnum.SUBMITTED
                                            "
                                            :class="
                                                item.status ===
                                                StatusEnum.SUBMITTED
                                                    ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                                    : 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1'
                                            "
                                            class="px-4 py-2 rounded-xl font-semibold transition-all duration-300"
                                        >
                                            ✏️ Edit
                                        </button>
                                        <button
                                            @click="openDeleteModal(item)"
                                            class="bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300"
                                        >
                                            🗑️ Hapus
                                        </button>
                                    </div>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center py-16" v-else>
                        <div class="text-6xl mb-4">🔍</div>
                        <p class="text-xl text-gray-500 mb-2">
                            Tidak ada data yang ditemukan
                        </p>
                        <p class="text-gray-400">
                            Coba ubah kata kunci pencarian atau filter status
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div
            v-if="isDeleteModalOpen"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4"
        >
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-100"
            >
                <div
                    class="bg-gradient-to-r from-red-500 to-pink-600 text-white p-6 rounded-t-2xl"
                >
                    <div class="flex items-center justify-center mb-4">
                        <div
                            class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-8 h-8"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"
                                    clip-rule="evenodd"
                                ></path>
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 012 0v4a1 1 0 11-2 0V7zm5 1a1 1 0 10-2 0v4a1 1 0 102 0V8z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-center">
                        Konfirmasi Hapus
                    </h2>
                </div>

                <div class="p-6">
                    <p class="text-center text-gray-700 mb-6 text-lg">
                        Apakah Anda yakin ingin menghapus
                        <strong class="text-red-600">{{
                            deleteTarget?.nama
                        }}</strong
                        >?
                    </p>
                    <div class="flex gap-4">
                        <button
                            @click="closeModals"
                            class="flex-1 px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl font-semibold transition-all duration-300 transform hover:-translate-y-1"
                        >
                            Batal
                        </button>
                        <button
                            @click="confirmDelete"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300"
                        >
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div
            v-if="isKomentarModalOpen"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4"
        >
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 scale-100"
            >
                <div
                    class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-t-2xl"
                >
                    <div class="flex items-center justify-center mb-4">
                        <div
                            class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-8 h-8"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-center">
                        Komentar Revisi
                    </h2>
                </div>

                <div class="p-8">
                    <div
                        class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-6"
                    >
                        <p
                            class="text-gray-800 text-lg leading-relaxed whitespace-pre-line"
                        >
                            {{ komentarContent }}
                        </p>
                    </div>
                    <div class="flex justify-center">
                        <button
                            @click="closeModals"
                            class="px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
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
