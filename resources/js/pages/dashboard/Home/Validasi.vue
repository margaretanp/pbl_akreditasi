<script setup>
import { ref, computed } from "vue";

const search = ref("");
const showModal = ref(false);
const selectedItem = ref(null);
const catatan = ref("");

const data = [
    { id: 1, namaDosen: "Dr. Ahmad Fauzi", namaKriteria: "Kriteria 1", status: "Menunggu" },
    { id: 2, namaDosen: "Prof. Siti Nurhaliza", namaKriteria: "Kriteria 2", status: "Disetujui" },
    { id: 3, namaDosen: "Dr. Budi Santoso", namaKriteria: "Kriteria 3", status: "Ditolak" },
    { id: 4, namaDosen: "Dr. Maya Sari", namaKriteria: "Kriteria 4", status: "Menunggu" },
    { id: 5, namaDosen: "Prof. Joko Widodo", namaKriteria: "Kriteria 5", status: "Disetujui" },
    { id: 6, namaDosen: "Dr. Andi Wijaya", namaKriteria: "Kriteria 6", status: "Menunggu" },
    { id: 7, namaDosen: "Dr. Lina Marlina", namaKriteria: "Kriteria 7", status: "Disetujui" },
    { id: 8, namaDosen: "Prof. Rudi Hartono", namaKriteria: "Kriteria 8", status: "Ditolak" },
    { id: 9, namaDosen: "Dr. Dewi Fortuna", namaKriteria: "Kriteria 9", status: "Menunggu" },
];

const filteredData = computed(() =>
    data.filter(
        (item) =>
            item.namaDosen.toLowerCase().includes(search.value.toLowerCase()) ||
            item.namaKriteria.toLowerCase().includes(search.value.toLowerCase()) ||
            item.status.toLowerCase().includes(search.value.toLowerCase())
    )
);

function openModal(item) {
    selectedItem.value = item;
    catatan.value = "";
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
    selectedItem.value = null;
    catatan.value = "";
}

function updateStatus(status) {
    if (selectedItem.value) {
        selectedItem.value.status = status;
        showModal.value = false;
    }
}
</script>

<template>
    <div class="flex flex-col h-screen w-screen bg-base-100 p-0 m-0 overflow-hidden">
        <!-- Header -->
        <div class="px-4 pt-2 pb-1 border-b border-base-content/10">
            <h1 class="text-3xl font-bold">VALIDASI</h1>
            <div class="flex gap-4 mt-1 text-lg">
                <span class="flex items-center gap-1">
                    <i class="fas fa-check-circle"></i> Validasi Kriteria
                </span>
                <span class="flex items-center gap-1">
                    <i class="fas fa-user-check"></i> Review Dosen
                </span>
                <span class="flex items-center gap-1">
                    <i class="fas fa-eye"></i> Preview
                </span>
            </div>
        </div>

        <!-- Search -->
        <div class="px-4 py-2">
            <input
                v-model="search"
                type="text"
                placeholder="Cari nama dosen, kriteria, atau status..."
                class="input input-bordered w-full text-lg"
            />
        </div>

        <!-- Table -->
        <div class="flex-1 overflow-auto px-0">
            <table class="table table-zebra w-full text-xl">
                <thead class="sticky top-0 bg-base-100 z-10 text-xl">
                    <tr>
                        <th class="text-left p-3">Nama Dosen</th>
                        <th class="text-left p-3">Nama Kriteria</th>
                        <th class="text-left p-3">Status</th>
                        <th class="text-left p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in filteredData"
                        :key="item.id"
                        class="hover"
                    >
                        <td class="p-3">{{ item.namaDosen }}</td>
                        <td class="p-3">{{ item.namaKriteria }}</td>
                        <td class="p-3">
                            <span
                                :class="{
                                    'text-green-600 font-semibold text-xl': item.status === 'Disetujui',
                                    'text-red-600 font-semibold text-xl': item.status === 'Ditolak',
                                    'text-yellow-600 font-semibold text-xl': item.status === 'Menunggu'
                                }"
                            >
                                {{ item.status }}
                            </span>
                        </td>
                        <td class="p-3">
                            <button 
                                @click="openModal(item)"
                                class="btn btn-lg btn-info"
                            >
                                Preview
                            </button>
                        </td>
                    </tr>
                    <tr v-if="filteredData.length === 0">
                        <td colspan="4" class="text-center text-gray-500 py-4 text-xl">
                            Data tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl w-11/12 max-w-5xl max-h-[90vh] overflow-y-auto">
                <!-- Header -->
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800">Detail Validasi Kriteria Akreditasi</h2>
                    <button 
                        @click="closeModal"
                        class="text-gray-500 hover:text-gray-700 text-2xl font-bold"
                    >
                        ×
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-6" v-if="selectedItem">
                    <!-- Nama Dosen -->
                    <div class="flex">
                        <div class="w-32 font-semibold text-gray-700">Nama Dosen :</div>
                        <div class="flex-1 text-gray-900">{{ selectedItem.namaDosen }}</div>
                    </div>

                    <!-- Nama Kriteria -->
                    <div class="flex">
                        <div class="w-32 font-semibold text-gray-700">Kriteria :</div>
                        <div class="flex-1 text-gray-900">{{ selectedItem.namaKriteria }}</div>
                    </div>

                    <!-- Catatan -->
                    <div class="flex">
                        <div class="w-32 font-semibold text-gray-700">Catatan Validasi :</div>
                        <div class="flex-1">
                            <textarea 
                                v-model="catatan"
                                placeholder="Catatan untuk validasi kriteria"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                rows="4"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Status ACC -->
                    <div class="flex items-center">
                        <div class="w-32 font-semibold text-gray-700">Status ACC :</div>
                        <div class="flex-1 flex gap-4">
                            <button 
                                @click="updateStatus('Disetujui')"
                                class="flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors"
                            >
                                <span class="text-lg">✓</span>
                                ACC Diterima
                            </button>
                            <button 
                                @click="updateStatus('Ditolak')"
                                class="flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors"
                            >
                                <span class="text-lg">✗</span>
                                ACC Ditolak
                            </button>
                        </div>
                    </div>

                    <!-- PDF Viewer -->
                    <div>
                        <div class="font-semibold text-gray-700 mb-2">Dokumen Kriteria:</div>
                        <iframe
                            :src="'/pdf/' + selectedItem.namaKriteria + '.pdf'"
                            class="w-full h-[500px] border rounded-lg"
                        ></iframe>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 p-6 border-t border-gray-200">
                    <button 
                        @click="closeModal"
                        class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors"
                    >
                        Tutup
                    </button>
                    <button 
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                    >
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
