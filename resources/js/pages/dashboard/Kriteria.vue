<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md h-screen sticky top-0">
            <Sidebar />
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-auto space-y-6">
            <!-- Penetapan -->
            <fieldset class="border border-gray-300 p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #12086f"
                >
                    Penetapan
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <Editor v-model="contents.penetapan" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2">
                            Pendukung Penetapan (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="handleFileUpload('penetapan')"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Perencanaan -->
            <fieldset class="border border-gray-300 p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #12086f"
                >
                    Perencanaan
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <Editor v-model="contents.perencanaan" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2">
                            Pendukung Perencanaan (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="handleFileUpload('perencanaan')"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Pelaksanaan -->
            <fieldset class="border border-gray-300 p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #12086f"
                >
                    Pelaksanaan
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <Editor v-model="contents.pelaksanaan" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2">
                            Pendukung Pelaksanaan (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="handleFileUpload('pelaksanaan')"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Evaluasi -->
            <fieldset class="border border-gray-300 p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #12086f"
                >
                    Evaluasi
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <Editor v-model="contents.evaluasi" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2">
                            Pendukung Evaluasi (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="handleFileUpload('evaluasi')"
                        />
                    </div>
                </div>
            </fieldset>

            <!-- Peningkatan -->
            <fieldset class="border border-gray-300 p-4 rounded-md bg-white">
                <legend
                    class="text-md text-white font-semibold px-2 rounded"
                    style="background-color: #12086f"
                >
                    Peningkatan
                </legend>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <Editor v-model="contents.peningkatan" />
                    </div>
                    <div class="w-1/4">
                        <h2 class="text-md font-semibold mb-2">
                            Pendukung Peningkatan (Upload File)
                        </h2>
                        <UploadFile
                            @file-selected="handleFileUpload('peningkatan')"
                        />
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</template>

<script setup>
import Editor from "../../components/Editor.vue";
import UploadFile from "../../components/UploadFile.vue";
import Sidebar from "../../components/Sidebar.vue";
import { reactive } from "vue";

const contents = reactive({
    penetapan: "",
    perencanaan: "",
    pelaksanaan: "",
    evaluasi: "",
    peningkatan: "",
});

const files = reactive({
    penetapan: null,
    perencanaan: null,
    pelaksanaan: null,
    evaluasi: null,
    peningkatan: null,
});

function handleFileUpload(section) {
    return (file) => {
        files[section] = file;
        console.log(`File uploaded for ${section}:`, file);
    };
}
</script>
