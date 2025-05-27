<template>
  <div class="p-6 space-y-4">
    <h1 class="text-2xl font-bold text-purple-700">VALIDASI AKREDITASI</h1>
    <p class="text-gray-600">Sistem Validasi Dokumen Akreditasi Program Studi</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-green-700 font-semibold">Disetujui</p>
            <p class="text-2xl font-bold text-black">{{ jumlahDisetujui }}</p>
          </div>
          <CheckCircleIcon class="w-8 h-8 text-green-600" />
        </div>
      </div>

      <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded shadow">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-yellow-700 font-semibold">Pending</p>
            <p class="text-2xl font-bold text-black">{{ jumlahPending }}</p>
          </div>
          <ClockIcon class="w-8 h-8 text-yellow-600" />
        </div>
      </div>

      <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-red-700 font-semibold">Ditolak</p>
            <p class="text-2xl font-bold text-black">{{ jumlahDitolak }}</p>
          </div>
          <XCircleIcon class="w-8 h-8 text-red-600" />
        </div>
      </div>

      <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded shadow">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-blue-700 font-semibold">Total</p>
            <p class="text-2xl font-bold text-black">{{ total }}</p>
          </div>
          <FilterIcon class="w-8 h-8 text-blue-600" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { CheckCircleIcon, ClockIcon, XCircleIcon, FilterIcon } from 'lucide-vue-next'

const jumlahDisetujui = ref(0)
const jumlahPending = ref(0)
const jumlahDitolak = ref(0)
const total = ref(0)

onMounted(() => {
  const data = [
    { status: 'disetujui' },
    { status: 'pending' },
    { status: 'pending' },
    { status: 'ditolak' },
    { status: 'disetujui' },
    { status: 'ditolak' },
    { status: 'pending' },
    { status: 'disetujui' },
    { status: 'disetujui' },
  ]

  jumlahDisetujui.value = data.filter(d => d.status === 'disetujui').length
  jumlahPending.value = data.filter(d => d.status === 'pending').length
  jumlahDitolak.value = data.filter(d => d.status === 'ditolak').length
  total.value = data.length
})
</script>
