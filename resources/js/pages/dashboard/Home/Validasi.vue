<script setup>
import { ref, computed } from "vue";

const search = ref("");
const showModal = ref(false);
const selectedItem = ref(null);
const catatan = ref("");
const selectedStatus = ref("semua");

const data = [
    { id: 1, namaDosen: "Dr. Ahmad Fauzi", namaKriteria: "Kriteria 1 - Visi, Misi, dan Tujuan", status: "Menunggu", tanggal: "2024-01-15" },
    { id: 2, namaDosen: "Prof. Siti Nurhaliza", namaKriteria: "Kriteria 2 - Tata Pamong dan Kerjasama", status: "Disetujui", tanggal: "2024-01-14" },
    { id: 3, namaDosen: "Dr. Budi Santoso", namaKriteria: "Kriteria 3 - Mahasiswa", status: "Ditolak", tanggal: "2024-01-13" },
    { id: 4, namaDosen: "Dr. Maya Sari", namaKriteria: "Kriteria 4 - Sumber Daya Manusia", status: "Menunggu", tanggal: "2024-01-12" },
    { id: 5, namaDosen: "Prof. Joko Widodo", namaKriteria: "Kriteria 5 - Keuangan", status: "Disetujui", tanggal: "2024-01-11" },
    { id: 6, namaDosen: "Dr. Andi Wijaya", namaKriteria: "Kriteria 6 - Sarana dan Prasarana", status: "Menunggu", tanggal: "2024-01-10" },
    { id: 7, namaDosen: "Dr. Lina Marlina", namaKriteria: "Kriteria 7 - Penelitian", status: "Disetujui", tanggal: "2024-01-09" },
    { id: 8, namaDosen: "Prof. Rudi Hartono", namaKriteria: "Kriteria 8 - Pengabdian Masyarakat", status: "Ditolak", tanggal: "2024-01-08" },
    { id: 9, namaDosen: "Dr. Dewi Fortuna", namaKriteria: "Kriteria 9 - Luaran dan Capaian", status: "Menunggu", tanggal: "2024-01-07" },
];

const filteredData = computed(() => {
    let filtered = data.filter(
        (item) =>
            item.namaDosen.toLowerCase().includes(search.value.toLowerCase()) ||
            item.namaKriteria.toLowerCase().includes(search.value.toLowerCase())
    );
    
    if (selectedStatus.value !== "semua") {
        filtered = filtered.filter(item => item.status === selectedStatus.value);
    }
    
    return filtered;
});

const statusCounts = computed(() => {
    return {
        total: data.length,
        menunggu: data.filter(item => item.status === "Menunggu").length,
        disetujui: data.filter(item => item.status === "Disetujui").length,
        ditolak: data.filter(item => item.status === "Ditolak").length
    };
});

function openModal(item) {
    selectedItem.value = item;
    catatan.value = "";
    showModal.value = true;
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    showModal.value = false;
    selectedItem.value = null;
    catatan.value = "";
    document.body.style.overflow = 'auto';
}

function updateStatus(status) {
    if (selectedItem.value) {
        selectedItem.value.status = status;
        closeModal();
    }
}

function getStatusIcon(status) {
    switch (status) {
        case 'Disetujui': return '✓';
        case 'Ditolak': return '✗';
        case 'Menunggu': return '⏳';
        default: return '•';
    }
}
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <!-- Header Section -->
        <div class="bg-white shadow-lg border-b-4 border-indigo-500">
            <div class="px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-2">
                            <span class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">
                                VALIDASI AKREDITASI
                            </span>
                        </h1>
                        <p class="text-gray-600 text-lg">Sistem Validasi Kriteria Akreditasi Perguruan Tinggi</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="text-center p-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl shadow-lg">
                            <div class="text-2xl font-bold">{{ statusCounts.total }}</div>
                            <div class="text-sm opacity-90">Total Kriteria</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Filters and Search -->
        <div class="px-8 py-6">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input
                                v-model="search"
                                type="text"
                                placeholder="🔍 Cari nama dosen atau kriteria..."
                                class="w-full pl-12 pr-4 py-3 text-black border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300"
                            />
                            <svg class="absolute left-4 top-4 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-full md:w-64">
                        <select 
                            v-model="selectedStatus"
                            class="w-full px-4 py-3 text-black border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300"
                        >
                            <option value="semua">📋 Semua Status</option>
                            <option value="Menunggu">⏳ Menunggu</option>
                            <option value="Disetujui">✅ Disetujui</option>
                            <option value="Ditolak">❌ Ditolak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                            <tr>
                                <th class="text-left p-6 font-semibold text-gray-700 text-lg">Nama Dosen</th>
                                <th class="text-left p-6 font-semibold text-gray-700 text-lg">Kriteria Akreditasi</th>
                                <th class="text-left p-6 font-semibold text-gray-700 text-lg">Tanggal Submit</th>
                                <th class="text-left p-6 font-semibold text-gray-700 text-lg">Status</th>
                                <th class="text-center p-6 font-semibold text-gray-700 text-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(item, index) in filteredData"
                                :key="item.id"
                                class="border-b border-gray-100 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300"
                                :style="{ animationDelay: index * 50 + 'ms' }"
                            >
                                <td class="p-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ item.namaDosen.charAt(0) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-lg">{{ item.namaDosen }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <p class="text-gray-800 font-medium text-lg">{{ item.namaKriteria }}</p>
                                </td>
                                <td class="p-6">
                                    <p class="text-gray-600 text-lg">{{ item.tanggal }}</p>
                                </td>
                                <td class="p-6">
                                    <span 
                                        :class="{
                                            'bg-green-100 text-green-800 border border-green-200': item.status === 'Disetujui',
                                            'bg-red-100 text-red-800 border border-red-200': item.status === 'Ditolak',
                                            'bg-yellow-100 text-yellow-800 border border-yellow-200': item.status === 'Menunggu'
                                        }"
                                        class="px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center gap-2"
                                    >
                                        <span class="text-lg">{{ getStatusIcon(item.status) }}</span>
                                        {{ item.status }}
                                    </span>
                                </td>
                                <td class="p-6 text-center">
                                    <button 
                                        @click="openModal(item)"
                                        class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 text-lg"
                                    >
                                        👁️ Preview
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="filteredData.length === 0" class="text-center py-16">
                        <div class="text-6xl mb-4">🔍</div>
                        <p class="text-xl text-gray-500 mb-2">Tidak ada data yang ditemukan</p>
                        <p class="text-gray-400">Coba ubah kata kunci pencarian atau filter status</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl max-h-[95vh] overflow-hidden transform transition-all duration-300 scale-100">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">Detail Validasi Kriteria Akreditasi</h2>
                            <p class="opacity-90">Review dan validasi dokumen kriteria</p>
                        </div>
                        <button 
                            @click="closeModal"
                            class="text-white hover:bg-white/20 rounded-full p-2 transition-colors duration-200"
                        >
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-8 overflow-y-auto max-h-[70vh]" v-if="selectedItem">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column - Info -->
                        <div class="space-y-6">
                            <!-- Dosen Info Card -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                    <span class="text-2xl">👤</span>
                                    Informasi Dosen
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                            {{ selectedItem.namaDosen.charAt(0) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-xl text-gray-800">{{ selectedItem.namaDosen }}</p>
                                            <p class="text-gray-600">Dosen Pengampu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kriteria Info Card -->
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                    <span class="text-2xl">📋</span>
                                    Kriteria Akreditasi
                                </h3>
                                <p class="text-lg text-gray-800 font-medium">{{ selectedItem.namaKriteria }}</p>
                                <p class="text-gray-600 mt-2">Tanggal Submit: {{ selectedItem.tanggal }}</p>
                            </div>

                            <!-- Notes Card -->
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                    <span class="text-2xl">📝</span>
                                    Catatan Validasi
                                </h3>
                                <textarea 
                                    v-model="catatan"
                                    placeholder="Berikan catatan untuk validasi kriteria ini..."
                                    class="text-black w-full p-4 border border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition-all duration-300 resize-none"
                                    rows="4"
                                ></textarea>
                            </div>

                            <!-- Action Buttons -->
                            <div class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl p-6 border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                    <span class="text-2xl">⚡</span>
                                    Aksi Validasi
                                </h3>
                                <div class="flex gap-4">
                                    <button 
                                        @click="updateStatus('Disetujui')"
                                        class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2"
                                    >
                                        <span class="text-xl">✓</span>
                                        ACC Diterima
                                    </button>
                                    <button 
                                        @click="updateStatus('Ditolak')"
                                        class="flex-1 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2"
                                    >
                                        <span class="text-xl">✗</span>
                                        ACC Ditolak
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - PDF Viewer -->
                        <div class="bg-gray-50 rounded-xl p-6 border-2 border-dashed border-gray-300">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <span class="text-2xl">📄</span>
                                Dokumen Kriteria
                            </h3>
                            <div class="bg-white rounded-lg border-2 border-gray-200 h-[500px] flex items-center justify-center">
                                <div class="text-center text-gray-500">
                                    <div class="text-6xl mb-4">📄</div>
                                    <p class="text-xl mb-2">Preview Dokumen</p>
                                    <p class="text-gray-400">{{ selectedItem.namaKriteria }}.pdf</p>
                                    <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                                        Download PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 flex justify-end gap-4">
                    <button 
                        @click="closeModal"
                        class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl font-semibold transition-all duration-300 transform hover:-translate-y-1"
                    >
                        Tutup
                    </button>
                    <button 
                        class="px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300"
                    >
                        💾 Simpan Validasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

tbody tr {
    animation: fadeIn 0.5s ease-out forwards;
}

.modal-enter-active, .modal-leave-active {
    transition: all 0.3s ease;
}

.modal-enter-from, .modal-leave-to {
    opacity: 0;
    transform: scale(0.9);
}
</style>