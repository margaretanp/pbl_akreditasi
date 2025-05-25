<script setup>
import { ref, computed, defineEmits } from "vue";

const emit = defineEmits(["edit-item"]);

const StatusEnum = Object.freeze({
  SUBMITTED: "Submitted",
  DRAFT: "Draft",
  REVISION: "Revision",
});

const search = ref("");
const data = ref([
  { id: 1, nama: "Kriteria 1", status: StatusEnum.SUBMITTED, komentar: "" },
  { id: 2, nama: "Kriteria 2", status: StatusEnum.SUBMITTED, komentar: "" },
  { id: 3, nama: "Kriteria 3", status: StatusEnum.DRAFT, komentar: "" },
  { id: 4, nama: "Kriteria 4", status: StatusEnum.SUBMITTED, komentar: "" },
  { id: 5, nama: "Kriteria 5", status: StatusEnum.DRAFT, komentar: "" },
  { id: 6, nama: "Kriteria 6", status: StatusEnum.REVISION, komentar: "Harap perbaiki bagian C." },
  { id: 7, nama: "Kriteria 7", status: StatusEnum.SUBMITTED, komentar: "" },
  { id: 8, nama: "Kriteria 8", status: StatusEnum.DRAFT, komentar: "" },
  { id: 9, nama: "Kriteria 9", status: StatusEnum.SUBMITTED, komentar: "" },
]);

const filteredData = computed(() =>
  data.value.filter(
    (item) =>
      item.nama.toLowerCase().includes(search.value.toLowerCase()) ||
      item.status.toLowerCase().includes(search.value.toLowerCase()) ||
      (item.komentar && item.komentar.toLowerCase().includes(search.value.toLowerCase()))
  )
);

const isDeleteModalOpen = ref(false);
const deleteTarget = ref(null);

function openDeleteModal(item) {
  deleteTarget.value = item;
  isDeleteModalOpen.value = true;
}

function confirmDelete() {
  if (!deleteTarget.value) return;
  setTimeout(() => {
    data.value = data.value.filter((d) => d.id !== deleteTarget.value.id);
    isDeleteModalOpen.value = false;
    deleteTarget.value = null;
  }, 500);
}

function closeModals() {
  isDeleteModalOpen.value = false;
  deleteTarget.value = null;
  isKomentarModalOpen.value = false;
  komentarContent.value = "";
}

function onEdit(item) {
  emit("edit-item", item);
}

// Modal Komentar
const isKomentarModalOpen = ref(false);
const komentarContent = ref("");

function openKomentarModal(komentar) {
  komentarContent.value = komentar;
  isKomentarModalOpen.value = true;
}
</script>

<template>
  <div class="flex flex-col h-screen w-screen bg-base-100 overflow-auto">
    <div class="px-4 pt-2 pb-1 border-b border-base-content/10">
      <h1 class="text-3xl font-bold">AKREDITASI</h1>
    </div>

    <div class="p-6">
      <input
        v-model="search"
        type="text"
        placeholder="Cari kriteria, status, atau komentar..."
        class="input input-bordered w-full text-base"
      />
    </div>

    <div class="flex-1 overflow-auto px-4 pb-10">
      <div class="overflow-x-auto">
        <table class="table table-zebra min-w-[700px] w-full text-sm">
          <thead class="bg-base-200 sticky top-0 z-10">
            <tr>
              <th class="w-[60px] px-2 py-2 text-left">ID</th>
              <th class="w-[200px] px-2 py-2 text-left">Nama</th>
              <th class="w-[120px] px-2 py-2 text-left">Status</th>
              <th class="w-[180px] px-2 py-2 text-left">Komentar</th>
              <th class="w-[150px] px-2 py-2 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in filteredData" :key="item.id">
              <td class="px-2 py-2">{{ item.id }}</td>
              <td class="px-2 py-2 truncate">{{ item.nama }}</td>
              <td class="px-2 py-2">
                <span
                  :class="{
                    'text-green-600 font-semibold': item.status === StatusEnum.SUBMITTED,
                    'text-gray-500 italic': item.status === StatusEnum.DRAFT,
                    'text-yellow-600 font-semibold': item.status === StatusEnum.REVISION,
                  }"
                >
                  {{ item.status }}
                </span>
              </td>
              <td class="px-2 py-2">
                <template v-if="item.status === StatusEnum.REVISION && item.komentar">
                  <button class="btn btn-sm btn-outline btn-info" @click="openKomentarModal(item.komentar)">
                    Lihat Komentar
                  </button>
                </template>
                <template v-else>
                  <span class="text-gray-400">-</span>
                </template>
              </td>
              <td class="px-2 py-2">
                <div class="flex flex-wrap gap-2">
                  <button
                    class="btn btn-sm btn-primary"
                    :disabled="item.status === StatusEnum.SUBMITTED"
                    @click="onEdit(item)"
                  >
                    Edit
                  </button>
                  <button class="btn btn-sm btn-error" @click="openDeleteModal(item)">
                    Hapus
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="filteredData.length === 0">
              <td colspan="5" class="text-center text-gray-500 py-4">
                Data tidak ditemukan.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Hapus -->
    <div
      v-if="isDeleteModalOpen"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
      <div class="bg-white rounded-lg p-6 max-w-sm w-full">
        <h2 class="text-xl font-semibold mb-4 text-center text-red-600">Konfirmasi Hapus</h2>
        <p class="mb-6 text-center">
          Apakah kamu yakin ingin menghapus <strong>{{ deleteTarget?.nama }}</strong>?
        </p>
        <div class="flex justify-center gap-6">
          <button class="btn btn-ghost" @click="closeModals">Batal</button>
          <button class="btn btn-error" @click="confirmDelete">Hapus</button>
        </div>
      </div>
    </div>

    <!-- Modal Komentar -->
    <div
      v-if="isKomentarModalOpen"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
      <div class="bg-white rounded-lg p-6 max-w-lg w-full">
        <h2 class="text-xl font-semibold mb-4 text-center text-info">Komentar</h2>
        <p class="mb-6 text-center text-gray-700 whitespace-pre-line">
          {{ komentarContent }}
        </p>
        <div class="flex justify-center">
          <button class="btn btn-primary" @click="closeModals">Tutup</button>
        </div>
      </div>
    </div>
  </div>
</template>
