<template>
  <div class="flex justify-end mt-6 space-x-3">
    <button
      class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400"
      @click="confirmReset"
    >
      Reset
    </button>
    <button
      class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
      @click="confirmSave"
    >
      Save
    </button>
    <button
      class="bg-[#021526] text-white px-4 py-2 rounded hover:bg-[#03346E]"
      @click="confirmSubmit"
    >
      Submit
    </button>
  </div>
</template>

<script setup>
import { reactive, toRefs } from "vue";
import Swal from "sweetalert2";

const props = defineProps({
  formData: Object,
  originalData: Object,
});
const emit = defineEmits(["update:formData"]);

function confirmReset() {
  Swal.fire({
    title: "Reset Data?",
    text: "Semua isian akan dikosongkan. Yakin ingin mereset?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, Reset",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      const resetData = Object.fromEntries(
        Object.keys(props.formData).map((key) => [key, ""])
      );
      emit("update:formData", resetData);
      Swal.fire("Direset!", "Formulir berhasil dikosongkan.", "success");
    }
  });
}

function confirmSave() {
  Swal.fire({
    title: "Simpan sebagai draft?",
    text: "Data akan disimpan namun tidak dikirim untuk divalidasi.",
    icon: "info",
    showCancelButton: true,
    confirmButtonText: "Simpan",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      saveData("draft");
    }
  });
}

function confirmSubmit() {
  Swal.fire({
    title: "Submit Data?",
    text: "Data akan disimpan dan dikirim untuk divalidasi. Lanjutkan?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Ya, Submit",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      saveData("submit");
    }
  });
}

function saveData(type) {
  const endpoint =
    type === "draft"
      ? "/api/kriteria1/save-draft"
      : "/api/kriteria1/submit-data";

  fetch(endpoint, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(props.formData),
  })
    .then((res) => res.json())
    .then((data) => {
      Swal.fire(
        "Berhasil!",
        type === "draft"
          ? "Draft berhasil disimpan."
          : "Data berhasil dikirim untuk validasi.",
        "success"
      );
    })
    .catch((err) => {
      console.error(err);
      Swal.fire("Gagal!", "Terjadi kesalahan saat menyimpan.", "error");
    });
}
</script>
