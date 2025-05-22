<script setup>
import { ref, computed } from "vue";

const search = ref("");
const data = [
    { id: 1, nama: "Kriteria 1", status: "Aktif" },
    { id: 2, nama: "Kriteria 2", status: "Aktif" },
    { id: 3, nama: "Kriteria 3", status: "Draft" },
    { id: 4, nama: "Kriteria 4", status: "Aktif" },
    { id: 5, nama: "Kriteria 5", status: "Draft" },
    { id: 6, nama: "Kriteria 6", status: "Aktif" },
    { id: 7, nama: "Kriteria 7", status: "Aktif" },
    { id: 8, nama: "Kriteria 8", status: "Draft" },
    { id: 9, nama: "Kriteria 9", status: "Aktif" },
];

const filteredData = computed(() =>
    data.filter(
        (item) =>
            item.nama.toLowerCase().includes(search.value.toLowerCase()) ||
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
            <h1 class="text-3xl font-bold">AKREDITASI</h1>
            <div class="flex gap-4 mt-1 text-lg">
                <span class="flex items-center gap-1">
                    <i class="fas fa-database"></i> DataBoxed
                </span>
                <span class="flex items-center gap-1">
                    <i class="fas fa-list"></i> Kriteria
                </span>
                <span class="flex items-center gap-1">
                    <i class="fas fa-video"></i> Videos
                </span>
            </div>
        </div>

        <!-- Search Bar - Compact -->
        <div class="px-4 py-2">
            <input
                v-model="search"
                type="text"
                placeholder="Cari kriteria atau status..."
                class="input input-bordered w-full text-lg"
            />
        </div>

        <!-- Table Container - Takes all remaining space -->
        <div class="flex-1 overflow-auto px-0">
            <table class="table table-zebra w-full text-xl">
                <thead class="sticky top-0 bg-base-100 z-10 text-xl">
                    <tr>
                        <th class="text-left p-3">ID_Kriteria</th>
                        <th class="text-left p-3">Nama_kriteria</th>
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
                        <td class="p-3">{{ item.id }}</td>
                        <td class="p-3">{{ item.nama }}</td>
                        <td class="p-3">
                            <span
                                :class="
                                    item.status === 'Aktif'
                                        ? 'text-green-600 font-semibold text-xl'
                                        : 'text-gray-500 italic text-xl'
                                "
                            >
                                {{ item.status }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <button class="btn btn-lg btn-primary">Edit</button>
                            <button class="btn btn-lg btn-error">Hapus</button>
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
