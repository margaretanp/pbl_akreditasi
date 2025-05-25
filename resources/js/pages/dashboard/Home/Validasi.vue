<script setup>
import { ref, computed } from "vue";

const search = ref("");
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
</script>

<template>
    <div
        class="flex flex-col h-screen w-screen bg-base-100 p-0 m-0 overflow-hidden"
    >
        <!-- Header Section - Compact -->
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

        <!-- Search Bar - Compact -->
        <div class="px-4 py-2">
            <input
                v-model="search"
                type="text"
                placeholder="Cari nama dosen, kriteria, atau status..."
                class="input input-bordered w-full text-lg"
            />
        </div>

        <!-- Table Container - Takes all remaining space -->
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
                            <button class="btn btn-lg btn-info">Preview</button>
                        </td>
                    </tr>
                    <tr v-if="filteredData.length === 0">
                        <td
                            colspan="4"
                            class="text-center text-gray-500 py-4 text-xl"
                        >
                            Data tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>